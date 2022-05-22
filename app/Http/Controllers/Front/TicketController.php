<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\TicketReplies;
use App\Models\Tickets;
use DB;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    //
    public function index()
    {
        return view('front.dashboard.tickets', ['tickets', Tickets::all()]);
    }

    public function tickets(Request $request)
    {
        $columns = array(
            'uniqid',
            'title',
            'resolved',
            'creator',
            'created_at',
        );
        $totalData = DB::table('tickets')->where('user', '=', auth()->user()->id)->count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $tickets = DB::table('tickets')
            ->join('users', function ($join) {
                $join->on('tickets.user', '=', 'users.id')
                    ->where('users.id', '=', auth()->user()->id);
            });
        if (empty($request->input('search.value'))) {
                $tickets = $tickets->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get(['users.id', 'users.name as creator', 'users.created_at as user_created_at', 'tickets.*']);
        } else {
            $search = $request->input('search.value');
            $tickets = $tickets->where('tickets.uniqid', 'LIKE', "%{$search}%")
                ->orWhere('tickets.title', 'LIKE', "%{$search}%")
                ->orWhere('users.name', 'LIKE', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get(['users.id', 'users.name as creator', 'users.created_at as user_created_at', 'tickets.*']);
            $totalFiltered = $tickets->count();
        }

        if ($request->last_order != '' && $request->last_order) {
            $tickets = $tickets->take(10);
        }

        $data = array();
        if (!empty($tickets)) {
            foreach ($tickets as $ticket) {
                $ticketRows = array();
                $status = '';
                if ($ticket->resolved == 1) {
                    $status = '<span class="badge badge-danger">Kapalı</span>';
                } elseif ($ticket->resolved == 0) {
                    $status = '<span class="badge badge-success">Açık</span>';
                }

                $ticketRows[] = $ticket->uniqid;
                $ticketRows[] = $ticket->title;
                $ticketRows[] = $status;
                $ticketRows[] = $ticket->creator;
                $ticketRows[] = date('d-m-Y H:i:s', strtotime($ticket->created_at));
                $ticketRows[] = '<a href="' . route('ticket.show', $ticket->uniqid) . '" class="btn btn-success btn-sm">Görüntüle</a>';
                $data[] = $ticketRows;
            }
        }
        $json_data = array(
            "draw" => intval($request->get('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );
        echo json_encode($json_data);
    }

    public function create()
    {
        return view('front.dashboard.ticket-add');
    }

    public function show($uniqid)
    {
        $ticket = DB::table('tickets')->join('users', function ($join) {
            $join->on('users.id', '=', 'tickets.user')->where('users.id', '=', auth()->user()->id);
        })->where('tickets.uniqid', $uniqid)->first(['tickets.uniqid','tickets.title','tickets.id', 'tickets.created_at', 'tickets.init_msg as message', 'users.name as username', 'users.created_at as user_created_at']);
        if (!$ticket) {
            return redirect()->route('tickets');
        }
        $ticketReplies = DB::table('ticket_replies')->join('tickets', function ($join) {
            $join->on('tickets.id', '=', 'ticket_replies.ticket_id');
        })->join('users', function ($join) {
            $join->on('users.id', '=', 'ticket_replies.user');
        })->where('ticket_replies.ticket_id', $ticket->id)->orderBy('ticket_replies.created_at','desc')->get([
            'ticket_replies.user',
            'ticket_replies.id',
            'ticket_replies.text as message',
            'ticket_replies.created_at',
            'users.name as creator',
            'users.role'
        ]);
        return view('front.dashboard.ticket-show', ['ticket' => $ticket, 'ticketReplies' => $ticketReplies]);
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'subject' => 'required',
                'message' => 'required',
            ],
            [
                'subject.required' => 'Talep konusu giriniz.',
                'message.required' => 'Talep detayını giriniz.'
            ]
        );
        $ticket = Tickets::create([
            'uniqid' => uniqid(),
            'user' => auth()->user()->id,
            'title' => $request->subject,
            'init_msg' => $request->message,
            'last_reply' => 0,
            'user_read' => 0,
            'admin_read' => 0,
            'resolved' => 0
        ]);
        return redirect()->route('ticket.show',$ticket->uniqid);
    }

    public function storeReply(Request $request,$id)
    {
        $request->validate(
            [
                'message' => 'required',
            ],
            [
                'message.required' => 'Mesaj metni giriniz.',
            ]
        );
        $ticket = Tickets::find($id);

        if(!$ticket) {
            return redirect()->route('tickets');
        }
        $ticket->update(['resolved' => 0]);
        TicketReplies::create([
            'user' => auth()->user()->id,
            'text' => $request->message,
            'ticket_id' => $id
        ]);

        return redirect()->route('ticket.show',$ticket->uniqid);
    }
}
