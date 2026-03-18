<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\Controller;
use App\Models\MongoDB\Image;
use App\Http\Requests\Admin\ImageRequest;
use App\Services\ImageService;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
  public function __construct(private Image $image, private ImageService $imageService){}

  public function store(ImageRequest $request)
  {            
    try{
      $data = $request->validated();

      $filename = $this->imageService->uploadImage($request->file('image'));
  
      $this->image->create([
        'filename' => $filename
      ]);
  
      return response()->json([
        'imageGallery' => view('components.image-gallery', ['filename' => $filename])->render(),
      ], 200);
    }
    catch(\Exception $e){
  return response()->json([
    'message' => $e->getMessage(), 
  ], 500);
}
  }

  public function showThumb($filename)
  {
    try{
      $disk = Storage::disk('public');
      $path = "images/gallery/thumbnail/{$filename}";

      if ($disk->exists($path)) {
        return response($disk->get($path), 200)->header('Content-Type', 'image/webp');
      }else{
        return response()->json([
          'message' => \Lang::get('admin/notification.error'),
        ], 500);
      }
    }
    catch(\Exception $e){
      return response()->json([
        'message' => \Lang::get('admin/notification.error'),
      ], 500);
    }
  }

  public function refreshGallery()
  {
    $view = view('components.image-gallery')->render();
    
    return response()->json([
        'imageGallery' => $view
    ]);
}

  public function destroy($filename)
  {
    try{
      $this->imageService->deleteImage($filename);
      $this->image->where('filename', $filename)->delete();

      return response()->json([
        'imageGallery' => view('components.image-gallery')->render(),
      ], 200);
    }
    catch(\Exception $e){
    return response()->json([
        'message' => $e->getMessage(), 
    ], 500);
}
  }
}