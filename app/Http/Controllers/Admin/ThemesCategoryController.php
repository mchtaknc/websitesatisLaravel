<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ThemesCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ThemesCategoryController extends Controller
{
    private $messages = [
        'required' => ':attribute doldurulması zorunludur.',
        'unique' => 'Bu :attribute daha önce alınmış.',
    ];

    private $attributes = [
        'name' => 'Kategori adı',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.themes.category.index')->with('categories', ThemesCategory::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.themes.category.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make(
            $request->all(),
            [
                'name' => 'required',
            ],
            $this->messages,
            $this->attributes
        )->validate();

        $category = new ThemesCategory;
        $category->name = $request->input('name');
        $category->slug = Str::slug($request->input('name'));

        $category->save();

        return redirect()->route('admin.themes.category')->with('success', 'Kategori başarıyla eklendi.');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = ThemesCategory::find($id);
        if ($category) {
            return view('admin.themes.category.edit')->with('category', $category);
        }
        return redirect()->route('admin.themes.category')->withErrors(['Hata' => 'Kategori bulunamadı.']);
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
        $category = ThemesCategory::find($id);
        if (!$category) {
            return redirect()->route('admin.themes.category')->withErrors(['Hata' => 'Kategori bulunamadı.']);
        }
        Validator::make(
            $request->all(),
            [
                'name' => 'required',
            ],
            $this->messages,
            $this->attributes
        )->validate();

        $category->name = $request->input('name');
        $category->slug = Str::slug($request->input('name'));

        $category->save();

        return redirect()->route('admin.themes.category')->with('success', 'Kategori başarıyla güncellendi.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = ThemesCategory::find($id);
        if ($category) {
            if (isset($category->themes) && $category->themes->isNotEmpty()) {
                return redirect()->route('admin.themes.category')->withErrors(['Hata' => 'Kategoriyi silebilmek için lütfen bağlı olduğu tema kategorisinde değişiklik yapınız.']);
            }
            $category->delete();
            return redirect()->route('admin.themes.category')->with('success', 'Kategori başarıyla silindi.');
        }
        return redirect()->route('admin.themes.category')->withErrors(['Hata' => 'Kategori bulunamadı.']);
    }
}
