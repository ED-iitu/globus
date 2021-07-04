<?php

namespace App\Http\Controllers;

use App\Facility;
use App\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class FacilityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $facilities = Facility::all();

        return view('facility.index', [
            'facilities' => $facilities
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('facility.create', [
            'categories' => $categories
        ]);
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
//            $validated = $request->validate([
//                'logo'  => 'dimensions:min_width=250,min_height=500',
//                'image' => 'dimensions:min_width=250,min_height=500'
//            ]);


            $image_link = $request->file('image');
            $extensionImage = $image_link->getClientOriginalExtension();
            Storage::disk('public')->put($image_link->getFilename() . '.' . $extensionImage, File::get($image_link));

            $logo = $request->file('logo');
            $extensionLogo = $logo->getClientOriginalExtension();
            Storage::disk('public')->put($logo->getFilename() . '.' . $extensionLogo, File::get($logo));

            Facility::create([
                'name'        => $request->name,
                'description' => $request->description,
                'lang'        => $request->lang,
                'logo'        => '/uploads/' . $logo->getFilename() . '.' . $extensionLogo,
                'image'       => '/uploads/' . $image_link->getFilename() . '.' . $extensionImage,
                'floor'       => $request->floor,
                'work_time'   => $request->work_time,
                'order'       => $request->order,
                'category_id' => $request->category_id,
                'social_url'  => $request->social_url,
                'web_url'     => $request->web_url,
                'map_coords'  => $request->map_coords
            ]);

            return redirect()->back()->with('success', 'Заведение успешно добавлена');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function show(Facility $facility)
    {
        $facility = Facility::find($facility->id);

        return view('facility.show', [
            'facility' => $facility
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function edit(Facility $facility)
    {
        $categories = Category::all();

        return view('facility.edit', [
           'categories' => $categories,
           'facility' => $facility
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Facility $facility)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function destroy(Facility $facility)
    {
        if($facility->delete()){
            Facility::query()->where(['id' => $facility->id])->delete();
        }


        return redirect()->back()->with('success', 'Заведение успешно удалено');
    }

    public function getAll(Request $request)
    {
        $lang = $request->lang ?? 'ru';
        $paginate = $request->paginate ?? 6;

        $facilities = Facility::query()->where('lang', '=', $lang)->orderBy("order", "ASC")->paginate($paginate);

        if (!$facilities) {
            return response(['error' => 'Список заведений пуст'], 404);
        }

        return response([
            'facilities' => $facilities,
        ], 200);
    }

    public function getFacilityById(Request $request)
    {

        $catId = $request->category_id ?? null;
        $lang = $request->lang ?? 'ru';
        $id = $request->id ?? null;

        if (null !== $catId) {
            $facility = Facility::query()->where(['category_id' => $catId, 'lang' => $lang])->first();

            if (!$facility) {
                return response(['error' => 'Заведение не найдено'], 404);
            }

            return response([
                'facility' => $facility,
            ], 200);
        }

        if (null !== $id) {
            $facility = Facility::query()->where(['id' => $id, 'lang' => $lang])->first();

            if (!$facility) {
                return response(['error' => 'Заведение не найдено'], 404);
            }

            return response([
                'facility' => $facility,
            ], 200);
        } else {
            return response([
                'error' => "ID or category_id required",
            ], 403);
        }
    }
}
