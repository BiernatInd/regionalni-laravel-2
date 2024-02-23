<?php

namespace App\Http\Controllers\AdminPanel\Gallery;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gallery\GalleryList;
use App\Models\Gallery\GalleryListImages;

class GalleryController extends Controller
{
    public function galleryAdd(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $photo = $request->file('photo');

        $slug = GalleryList::max('slug') + 1;

        $path = public_path('gallery-photos/' . $slug);
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $fileName = '1.webp'; 

        $image = imagecreatefromstring(file_get_contents($photo));
        imagejpeg($image, $path . '/' . $fileName, 90); 

        imagedestroy($image);

        $galleryPhoto = new GalleryList();
        $galleryPhoto->image_path = url('gallery-photos/' . $slug . '/' . $fileName);
        $galleryPhoto->slug = $slug;
        $galleryPhoto->save();

        return response()->json(['message' => 'Zdjęcie dodane pomyślnie', 'slug' => $slug]);
    }

    public function galleryAddPhotos(Request $request, $slug)
{
    $request->validate([
        'photos.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
    ]);

    $path = public_path("gallery-photos-collection/$slug");

    if (!file_exists($path)) {
        mkdir($path, 0777, true);
    }

    $uploadedPhotos = [];

    $existingPhotos = GalleryListImages::where('slug', $slug)->count();

    foreach ($request->file('photos') as $photo) {
        $fileName = ($existingPhotos + count($uploadedPhotos) + 1) . '.webp';
        $image = imagecreatefromstring(file_get_contents($photo));
        imagejpeg($image, $path . '/' . $fileName, 90);
        imagedestroy($image);

        $galleryPhoto = new GalleryListImages();
        $galleryPhoto->image_path = url("gallery-photos-collection/$slug/$fileName");
        $galleryPhoto->slug = $slug;
        $galleryPhoto->save();

        $uploadedPhotos[] = $fileName;
    }

    return response()->json(['message' => 'Zdjęcia dodane pomyślnie', 'uploadedPhotos' => $uploadedPhotos]);
    }

    public function downloadGalleryList()
    {
        $gallery = GalleryList::all();

        return response()->json(['gallery' => $gallery]);
    }

    public function downloadGalleryListCollection($slug)
    {
$gallery = GalleryListImages::where('slug', $slug)->get();

if ($gallery->isEmpty()) {
    return response()->json(['error' => 'No gallery found'], 404);
}

return response()->json(['gallery' => $gallery]);
    }

    public function deleteGallery($slug) {
        $gallery = GalleryList::where('slug', $slug)->first();
    
        if (!$gallery) {
            return response()->json(['error' => 'Artykuł nie został znaleziony.'], 404);
        }
    
        GalleryListImages::where('slug', $slug)->delete();
    
        $gallery->delete();
    
        return response()->json(['message' => 'Artykuł oraz powiązane treści i obrazy zostały pomyślnie usunięte.']);
    }

    public function deleteGalleryCollection($id)
    {
        $gallery = GalleryListImages::find($id);

        if (!$gallery) {
            return response()->json(['error' => 'Produkt nie został znaleziony.'], 404);
        }

        $gallery->delete();

        return response()->json(['message' => 'Produkt został pomyślnie usunięty.']);
    }
}
