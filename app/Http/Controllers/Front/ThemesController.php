<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Packages;
use App\Models\Themes;
use App\Models\ThemesCategory;
use Illuminate\Http\Request;

class ThemesController extends Controller
{
    public function index(Request $request)
    {
        if(!empty($request->get('kategori'))) {
            $themes = Themes::with('category')->whereHas('category', function ($query) use ($request) {
                $query->where('slug', $request->get('kategori'));
            })->paginate(10, ['*'], 'sayfa');
            $categories = ThemesCategory::all();
            $categoryName =  optional($categories->where('slug', request()->get('kategori'))->first())->slug;
        } else {
            $themes = Themes::paginate(10, ['*'], 'sayfa');
            $categories = ThemesCategory::all();
            $categoryName = "";
        }

        return view('front.themes')->with([
            'themes' => $themes,
            'categories' => $categories,
            'categoryName' => $categoryName
        ]);
    }

    public function show($id)
    {
        $theme = Themes::find($id);
        if (empty($theme)) {
            return redirect()->route('home');
        }
        return view('front.theme')->with([
            'theme' => $theme
        ]);
    }
}
