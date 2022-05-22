<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Themes;
use App\Models\ThemesImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ThemesImageController extends Controller
{
    public function featured(Request $request)
    {
        $image_id = $request->image_id;
        $theme_id = $request->theme_id;

        $theme = Themes::find($theme_id);
        if (!$theme || !isset($theme->image) || empty($theme->image->where('id', $image_id))) {
            return response()->json(['message' => 'İşlem yapmak istediğiniz tema ve resim bulunamadı.'], 422);
        }

        ThemesImage::where('id', '!=', $image_id)->update(['featured' => 0]);
        $themeImage = ThemesImage::find($image_id);
        $themeImage->featured = 1;
        $themeImage->update();

        return response()->json(['message' => 'Tema ana resmi seçildi.'], 200);
    }

    public function remove(Request $request)
    {
        $image_id = $request->image_id;

        $themeImage = ThemesImage::find($image_id);
        if (!$themeImage) {
            return response()->json(['message' => 'Parametre Hatalı!'], 422);
        }

        Storage::disk('public')->delete("themes/" . $themeImage->name);
        $themeImage->delete();

        return response()->json(['message' => 'Resim başarıyla silindi.'], 200);
    }
}
