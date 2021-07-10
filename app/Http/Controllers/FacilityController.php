<?php

namespace App\Http\Controllers;

use App\Facility;
use App\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use DB;
use function PHPUnit\Framework\isEmpty;

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

//            $validated = $request->validate([
//                'logo'  => 'dimensions:min_width=250,min_height=500',
//                'image' => 'dimensions:min_width=250,min_height=500'
//            ]);


            $image_link = $request->file('image') ?? $facility->image;

            if (!is_string($image_link)) {
                $extensionImage = $image_link->getClientOriginalExtension();
                Storage::disk('public')->put($image_link->getFilename() . '.' . $extensionImage, File::get($image_link));

                $image_link = '/uploads/' . $image_link->getFilename() . '.' . $extensionImage;
            }


            $logo = $request->file('logo') ?? $facility->logo;

            if (!is_string($logo)) {
                $extensionLogo = $logo->getClientOriginalExtension();
                Storage::disk('public')->put($logo->getFilename() . '.' . $extensionLogo, File::get($logo));

                $logo = '/uploads/' . $logo->getFilename() . '.' . $extensionLogo;
            }


            $facility->update([
                'name'        => $request->name ?? $facility->name,
                'description' => $request->description ?? $facility->description,
                'lang'        => $request->lang ?? $facility->lang,
                'logo'        =>  $logo ?? $facility->logo,
                'image'       =>  $image_link ?? $facility->image,
                'floor'       => $request->floor ?? $facility->floor,
                'work_time'   => $request->work_time ?? $facility->work_time,
                'order'       => $request->order ?? $facility->order,
                'category_id' => $request->category_id ?? $facility->category_id,
                'social_url'  => $request->social_url ?? $facility->social_url,
                'web_url'     => $request->web_url ?? $facility->web_url,
                'map_coords'  => $request->map_coords ?? $facility->map_coords
            ]);

            return redirect()->back()->with('success', 'Заведение успешно обновлено');

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

    public function getByCategory(Request $request)
    {
        $lang = $request->lang ?? 'ru';

        $categories = Category::with('facility')->withCount('facility')
            ->orderBy('id','desc')
            ->where('lang','=', $lang)
            ->whereHas('facility', function($query){
                $query->where('lang','ru');
            })
            ->get();


        if (count($categories) == 0) {
            return response([
                'error' => 'Не найден список категорий',
            ], 404);
        }

        return response([
            'items' => $categories,
        ], 200);
    }

    public function getAll(Request $request)
    {
        $lang = $request->lang ?? 'ru';
        $catId = $request->category_id ?? null;
        $paginate = $request->paginate ?? 6;
        $data = [];

        if (null !== $catId) {
            $facilities = Facility::query()->where(['category_id' => $catId, 'lang' => $lang])->orderBy("order", "ASC")->paginate($paginate);

            if ($facilities->isEmpty()) {
                return response(['error' => 'Список заведений пуст'], 404);
            }

            return response([
                'facilities' => $facilities,
            ], 200);
        }

        $facilities = Facility::query()->where('lang', '=', $lang)->orderBy("order", "ASC")->paginate($paginate);

        if ($facilities->isEmpty()) {
            return response(['error' => 'Список заведений пуст'], 404);
        }

        foreach ($facilities as $facility) {
            $myString = $facility->social_url;
            $myArray  = explode(',', $myString);

            foreach ($myArray as $link) {
                if (str_contains($link, 'instagram')) {
                    $data['instagram'] = $link;
                } elseif (str_contains($link, 'facebook')) {
                    $data['facebook'] = $link;
                } elseif (str_contains($link, 'vk')) {
                    $data['vk'] = $link;
                }
            }

            $facility->social_url = $data;
        }


        return response([
            'facilities' => $facilities,
        ], 200);
    }

    public function getFacilityById(Request $request)
    {
        $lang = $request->lang ?? 'ru';
        $id = $request->id ?? null;


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

    public function map(Request $request)
    {
        $floor = $request->get('floor') ?? 1;
        $lang = $request->get('lang') ?? 'ru';
        $response = [];

        $floor = strval($floor);

        $data = Facility::query()->where(['floor' => $floor, 'lang' => $lang])->get();


        foreach ($data as $facility) {
            $response[] = [
                "id" => strtolower($facility->name),
                "name" => $facility->name,
                "text" => $facility->description,
                "d" => $facility->map_coords,
                "logo" => $facility->logo,
                "img" => $facility->image
            ];
        }

        dd($response);

        return response([
            'Data' => $response,
        ], 200);
    }
}
