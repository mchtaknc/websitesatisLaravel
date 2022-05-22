@extends('front.dashboard')
@section('dashboard-content')
    <div class="tickets nuhost-filter-list-container">
        <div class="tickets-head" style="border-bottom: 1px solid #ddd">
            <h5>Talebi Görüntüle</h5>
        </div>
        <h4 class="pt-3">{{"#".$ticket->uniqid." - ".$ticket->title}}</h4>
        <button class="btn btn-flat btn-domain-check replybtn"><i class="fa fa-pencil-alt"></i> Cevap Yaz</button>
        <form class="custom-form replyForm mt-4" action="{{route('ticket.storeReply',$ticket->id)}}" method="post" style="display: {{$errors->has('message') ? 'block' : 'none'}}">
            @csrf
            @method('POST')
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="form-row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="col-label-form-sm">Mesaj</label>
                        <textarea cols="5" rows="10" class="form-control form-control-sm @error('message') is-invalid @enderror" name="message">{{ old('message') }}</textarea>
                        <span class="invalid-feedback" role="alert"><strong>{{$errors->first('message')}}</strong></span>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-success btn-sm">Kaydet</button>
        </form>
    </div>
    <div class="ticket-messages">
        @foreach($ticketReplies as $ticketReply)
            <div class="card my-2">
                <div class="card-header bg-transparent">
                    <span>{{$ticketReply->role == 'admin' && $ticketReply->user != auth()->user()->id ? 'Yetkili' : $ticketReply->creator}}</span>
                    <span class="date">{{date('d/m/Y (H:i)',strtotime($ticketReply->created_at))}}</span>
                </div>
                <div class="card-body">
                    {{$ticketReply->message}}
                </div>
            </div>
        @endforeach
        <div class="card my-2">
            <div class="card-header bg-transparent">
                <span>{{$ticket->username}}</span>
                <span class="date">{{date('d/m/Y (H:i)',strtotime($ticket->created_at))}}</span>
            </div>
            <div class="card-body">
                {{$ticket->message}}
            </div>
        </div>
    </div>
@endsection
@section('js')
    @push('js')
        <script>
            $(function(){
                $(".replybtn").click(function(e){
                    e.preventDefault();
                    $(".replyForm").slideToggle();
                });
            });
        </script>
    @endpush
@endsection
