<?php

namespace App\Http\Controllers;

use App\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $promotions = Promotion::all();

        return view('promotion.index', [
            'promotions' => $promotions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('promotion.create');
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
            $validated = $request->validate([
                'title' => 'string|max:300',
                'image' => 'mimes:jpeg,png|max:1014',
            ]);


            $image_link = $request->file('image');
            $extensionImage = $image_link->getClientOriginalExtension();
            Storage::disk('public')->put($image_link->getFilename() . '.' . $extensionImage, File::get($image_link));

            Promotion::create([
                'title' => $validated['title'],
                'description' => $request->description,
                'lang' => $request->lang,
                'link' => $request->link,
                'image' => '/uploads/' . $image_link->getFilename() . '.' . $extensionImage,
            ]);

            return redirect()->back()->with('success', 'Акция успешно добавлена');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function show(Promotion $promotion)
    {
        $promotion = Promotion::find($promotion->id);

        return view('promotion.show', [
            'promotion' => $promotion
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function edit(Promotion $promotion)
    {
        $promotion = Promotion::find($promotion->id);

        return view('promotion.edit', [
            'promotion' => $promotion
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Promotion $promotion)
    {
        $image_link = $request->file('image');

        if (null !== $image_link) {
            $extensionImage = $image_link->getClientOriginalExtension();
            Storage::disk('public')->put($image_link->getFilename().'.'.$extensionImage,  File::get($image_link));
        } else {
            $img = $promotion->image;
        }

        $promotion->update([
            'title' => $request->title ?? $promotion->title,
            'lang'  => $request->lang ?? $promotion->lang,
            'description' => $request->description ?? $promotion->description,
            'image' => $img ?? '/uploads/' . $image_link->getFilename() . '.' . $extensionImage,
        ]);

        return redirect()->back()->with('success', 'Акция успешно обновлена');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Promotion $promotion)
    {
        if($promotion->delete()){
            Promotion::query()->where(['id' => $promotion->id])->delete();
        }


        return redirect()->back()->with('success', 'Акция успешно удалена');
    }


    public function getAll(Request $request)
    {
        $lang = $request->lang ?? 'ru';
        $paginate = $request->paginate ?? 6;

        $promotions = Promotion::query()->where('lang', '=', $lang)->paginate($paginate);

        if (!$promotions) {
            return response(['error' => 'Список акций пуст'], 404);
        }

        return response([
            'promotions' => $promotions,
        ], 200);
    }

    public function getById(Request $request)
    {
        $lang = $request->lang ?? 'ru';
        $id = $request->id;

        if (null == $id) {
            return response(['error' => 'Не передан ID акции'], 400);
        }

        $promotion = Promotion::query()->where(['id' => $id, 'lang' => $lang])->first();


       // dd($promotion);

        return response([
            'promotion' => $promotion,
        ], 200);

    }

}
