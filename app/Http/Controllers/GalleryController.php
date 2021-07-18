<?php

namespace App\Http\Controllers;

use App\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $galleries = Gallery::all();

        return view('gallery.index', [
            'galleries' => $galleries
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('gallery.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $main_image = $request->file('main_image');
        $mainImageExtensionImage = $main_image->getClientOriginalExtension();
        Storage::disk('public')->put($main_image->getFilename() . '.' . $mainImageExtensionImage, File::get($main_image));

        if($request->hasfile('filename'))
        {
            foreach($request->file('filename') as $image)
            {
                $extensionImage = $image->getClientOriginalExtension();
                Storage::disk('public')->put($image->getFilename() . '.' . $extensionImage, File::get($image));

                $data[] = '/uploads/' . $image->getFilename() . '.' . $extensionImage;
            }
        }

        $gallery= new Gallery();
        $gallery->title = $request->title;
        $gallery->main_image = '/uploads/' . $main_image->getFilename() . '.' . $mainImageExtensionImage;
        $gallery->images=json_encode($data);


        $gallery->save();

        return back()->with('success', 'Your images has been successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $gallery)
    {

       // dd($gallery);
        $images = $gallery->images;

        $images = json_decode($images);
        return view('gallery.show', [
            'gallery' => $gallery,
            'images' => $images
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(Gallery $gallery)
    {
        $gallery = Gallery::find($gallery->id);

        $images = $gallery->images;

        $images = json_decode($images);

        return view('gallery.edit', [
            'gallery' => $gallery,
            'images' => $images
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gallery $gallery)
    {
        if ($request->file('main_image')) {
            $main_image = $request->file('main_image');
            $mainImageExtensionImage = $main_image->getClientOriginalExtension();
            Storage::disk('public')->put($main_image->getFilename() . '.' . $mainImageExtensionImage, File::get($main_image));


            $galleryImage = '/uploads/' . $main_image->getFilename() . '.' . $mainImageExtensionImage;

        } else {
            $galleryImage = $gallery->main_image;
        }


        if($request->hasfile('filename'))
        {
            foreach($request->file('filename') as $image)
            {
                $extensionImage = $image->getClientOriginalExtension();
                Storage::disk('public')->put($image->getFilename() . '.' . $extensionImage, File::get($image));

                $data[] = '/uploads/' . $image->getFilename() . '.' . $extensionImage;
            }

            $images = json_encode($data);
        } else {
            $images = $gallery->images;
        }


        $gallery->update([
            'title' => $request->title ?? $gallery->title,
            'main_image' => $galleryImage,
            'images' => $images
        ]);

        return back()->with('success', 'Your images has been successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $gallery)
    {
        if($gallery->delete()){
            Gallery::query()->where(['id' => $gallery->id])->delete();
        }


        return redirect()->back()->with('success', 'Галерея успешно удалена');
    }

    public function galleryList(Request $request)
    {
        $lang = $request->lang ?? 'ru';
        $galleries = Gallery::query()->where('lang', '=', $lang)->get();
        $data = [];


        foreach ($galleries as $gallery) {
            $data[] = [
                'title' => $gallery->title,
                'image' => $gallery->main_image,
                'date' => $gallery->created_at
            ];
        }

        return response([
            'data' => $data,
        ], 200);
    }

    public function getGalleryById($id)
    {
        $galleries = Gallery::query()->where('id', '=', $id)->get();

        $data = [];


        foreach ($galleries as $gallery) {
            $data[] = [
                'title' => $gallery->title,
                'images' => $gallery->images,
                'date' => $gallery->created_at
            ];
        }

        return response([
            'data' => $data,
        ], 200);
    }
}
