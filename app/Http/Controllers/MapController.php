<?php

namespace App\Http\Controllers;

use App\Map;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class MapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $maps = Map::all();

        return view('map.index', [
            'maps' => $maps
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('map.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->hasFile('image')) {

            $image_link = $request->file('image');
            $extensionImage = $image_link->getClientOriginalExtension();
            Storage::disk('public')->put($image_link->getFilename() . '.' . $extensionImage, File::get($image_link));

            Map::create([
                'floor' => $request->floor,
                'image' => '/uploads/' . $image_link->getFilename() . '.' . $extensionImage,
            ]);

            return redirect()->back()->with('success', 'Карта успешно добавлена');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Map  $map
     * @return \Illuminate\Http\Response
     */
    public function show(Map $map)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Map  $map
     * @return \Illuminate\Http\Response
     */
    public function edit(Map $map)
    {
        $map = Map::find($map->id);

        return view('map.edit', [
            'map' => $map
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Map  $map
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Map $map)
    {
        $image_link = $request->file('image');

        if (null !== $image_link) {
            $extensionImage = $image_link->getClientOriginalExtension();
            Storage::disk('public')->put($image_link->getFilename().'.'.$extensionImage,  File::get($image_link));
        } else {
            $img = $map->image;
        }

        $map->update([
            'floor' => $request->floor ?? $map->floor,
            'image' => $img ?? '/uploads/' . $image_link->getFilename() . '.' . $extensionImage,
        ]);

        return redirect()->back()->with('success', 'Карта успешно обновлена');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Map  $map
     * @return \Illuminate\Http\Response
     */
    public function destroy(Map $map)
    {
        //
    }
}
