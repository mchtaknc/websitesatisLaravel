<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Packages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PackagesController extends Controller
{
    private $messages = [
        'required'  => ':attribute doldurulması zorunludur.',
        'unique'    => 'Bu :attribute daha önce alınmış.',
    ];

    private $attributes = [
        'name'              => 'Paket adı',
        'description'       => 'Paket açıklaması',
        'specifications'    => 'Paket özellikleri',
        'price'             => 'Paket fiyatı',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.packages.index')->with('packages', Packages::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPackagePrice(Request $request)
    {
        $package = Packages::find($request->package);
        if (!$package) {
            return response()->json('', 422);
        }
        return response()->json($package->price, 200);
    }
    public function create()
    {
        return view('admin.packages.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'description' => 'required',
                'specifications' => 'required',
                'price' => 'required',
            ],
            $this->messages,
            $this->attributes
        )->validate();

        $packages = new Packages;
        $packages->name = $request->input('name');
        $packages->slug = Str::slug($request->input('name'));
        $packages->description = $request->input('description');
        $packages->specifications = $request->input('specifications');
        $packages->price = str_replace(',', '', $request->input('price'));

        $packages->save();

        return redirect()->route('admin.packages')->with('success', 'Paket başarıyla eklendi.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $package = Packages::find($id);
        if ($package) {
            return view('admin.packages.edit')->with('package', $package);
        }
        return redirect()->route('admin.packages')->withErrors(['Hata' => "Paket bulunamadı."]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $package = Packages::find($id);
        if (!$package) {
            return redirect()->route('admin.packages')->withErrors(['Hata' => 'Paket bulunamadı.']);
        }

        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'description' => 'required',
                'specifications' => 'required',
                'price' => 'required',
            ],
            $this->messages,
            $this->attributes
        )->validate();

        $package->name = $request->input('name');
        $package->slug = Str::slug($request->input('name'));
        $package->description = $request->input('description');
        $package->specifications = $request->input('specifications');
        $package->price = str_replace(',', '', $request->input('price'));

        $package->save();

        return redirect()->route('admin.packages')->with('success', 'Paket başarıyla güncellendi.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $package = Packages::find($id);
        if ($package) {
            $package->delete();
            return redirect()->route('admin.packages')->with('success', 'Paket başarıyla silindi.');
        }
        return redirect()->route('admin.packages')->withErrors(['Hata' => 'Paket bulunamadı.']);
    }
}
