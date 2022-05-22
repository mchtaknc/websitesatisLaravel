<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Packages;
use App\Models\Themes;
use App\Models\ThemesCategory;
use App\Models\ThemesImage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ThemesController extends Controller
{
    private $messages = [
        'required'  => ':attribute zorunludur.',
        'unique'    => 'Bu :attribute daha önce alınmış.',
        'file.*.mimes' => 'Yalnızca JPG ve PNG uzantılı dosyalar yüklenebilir.',
        'file.*.image' => 'Dosya türü resim olmalıdır.',
        'file.*.max' => 'Dosya boyutu maksimum 3MB olmalıdır.'
    ];

    private $attributes = [
        'category'                => 'Tema kategorisi',
        'package'                 => 'Tema paketi',
        'name'                    => 'Tema adı',
        'file.*'                   => 'Resim',
        'description'             => 'Tema açıklaması',
        'featured_specifications' => 'Öne çıkan özellikleri',
        'demo_link'               => 'Demo linki'
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.themes.index')->with('themes', Themes::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.themes.add')->with('categories', ThemesCategory::all())->with('packages', Packages::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = array();
        $validator = Validator::make(
            $request->all(),
            [
                'category' => 'required',
                'package' => 'required',
                'name' => 'required',
                'file' => 'required',
                'file.*' => 'required|mimes:jpg,jpeg,svg,png|max:3048',
                'description' => 'required',
                'demo_link' => 'required',
            ],
            $this->messages,
            $this->attributes
        )->validate();

        $theme = new Themes;
        $theme->category_id = $request->input('category');
        $theme->package_id = $request->input('package');
        $theme->name = $request->input('name');
        $theme->slug = Str::slug($request->input('name'));
        $theme->description = $request->input('description');
        $theme->featured_specifications = $request->input('featured_specifications');
        $theme->demo_link = $request->input('demo_link');

        $theme->save();

        if ($request->has('file')) {
            foreach ($request->file as $image) {
                $name = $image->getClientOriginalName();
                $extension = $image->getClientOriginalExtension();
                $sluggy = Str::slug(pathinfo($name, PATHINFO_FILENAME));
                $new_name = $sluggy . '.' . $extension;
                $image->storeAs('public/themes/', $new_name);

                $themeImage = new ThemesImage;
                $themeImage->theme_id = $theme->id;
                $themeImage->name = $new_name;
                $themeImage->save();
            }
        }

        return redirect()->route('admin.themes')->with('success', 'Tema başarıyla eklendi.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $theme = Themes::find($id);
        if ($theme) {
            return view('admin.themes.edit')->with('theme', $theme)->with('categories', ThemesCategory::all())->with('packages', Packages::all());
        }
        return redirect()->route('admin.themes')->withErrors(['Hata' => 'Tema bulunamadı.']);
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
        $theme = Themes::find($id);
        if (!$theme) {
            return redirect()->route('admin.themes')->withErrors(['Hata' => 'Tema bulunamadı.']);
        }

        $validator = Validator::make(
            $request->all(),
            [
                'category' => 'required',
                'package' => 'required',
                'name' => 'required',
                'file.*' => 'image|mimes:png,jpeg,jpg,svg|max:3048',
                'description' => 'required',
                'demo_link' => 'required',
            ],
            $this->messages,
            $this->attributes
        )->validate();

        $theme->category_id = $request->input('category');
        $theme->package_id = $request->input('package');
        $theme->name = $request->input('name');
        $theme->slug = Str::slug($request->input('name'));
        $theme->description = $request->input('description');
        $theme->featured_specifications = $request->input('featured_specifications');
        $theme->demo_link = $request->input('demo_link');

        $theme->save();

        if ($request->has('file')) {
            foreach ($request->file as $image) {
                $name = $image->getClientOriginalName();
                $extension = $image->getClientOriginalExtension();
                $sluggy = Str::slug(pathinfo($name, PATHINFO_FILENAME));
                $new_name = $sluggy . '.' . $extension;
                $image->storeAs('public/themes/', $new_name);

                $themeImage = new ThemesImage;
                $themeImage->theme_id = $theme->id;
                $themeImage->name = $new_name;
                $themeImage->save();
            }
        }

        return redirect()->route('admin.themes')->with('success', 'Tema başarıyla güncellendi.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $theme = Themes::find($id);
        if ($theme) {
            if (isset($theme->image) && $theme->image->isNotEmpty()) {
                foreach ($theme->image as $image) {
                    Storage::disk('public')->delete("themes/" . $image->name);
                    $image->delete();
                }
            }
            $theme->delete();
            return redirect()->route('admin.themes')->with('success', 'Tema başarıyla silindi.');
        }
        return redirect()->route('admin.themes')->withErrors(['Hata' => 'Tema bulunamadı.']);
    }
}
