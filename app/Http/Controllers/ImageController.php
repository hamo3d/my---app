<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */


//    كود مختصر لانشاء  مودل وكنترولر وسيدير وفاكتور
//php artisan make:model Category -mcrfs


    public function index()
    {
        $data = Image::all();
        return response()->json(['status' => true, 'message' => 'success', 'data' => $data], Response::HTTP_OK);

    }


    public function store(Request $request)
    {
        //


        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $image = $request->file('image');
        $path = 'uploads/images';
        $imageName = time() + rand(1, 1000000) . '.' . $image->getClientOriginalExtension();
        $imageFullPath = $path . $imageName;
        Storage::disk('public')->put($path . $imageName, file_get_contents($image));

        $image = new Image();
        $image->image = $imageFullPath;
        $image->save();
        return response()->json([
            'message' => 'Image uploaded successfully.',
            'success' => $image ? "true" : 'false',
            'data' => $image,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Image $image)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Image $image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //

        $image = Image::findOrFail($id);
        Image::where('id', $image->id);
        $deleted = $image->delete();
        return response()->json(['status' => $deleted, 'message' => $deleted ? 'success' : 'failed'], $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }
}
