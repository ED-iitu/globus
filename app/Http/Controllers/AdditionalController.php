<?php

namespace App\Http\Controllers;

use App\Additional;
use Illuminate\Http\Request;

class AdditionalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $additionals = Additional::all();

        return view('additional.index', [
            'additionals' => $additionals
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('additional.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $additional = new Additional();

        $additional::create([
            'lang' => $request->lang,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'Информация успешно добавлена');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Additional  $additional
     * @return \Illuminate\Http\Response
     */
    public function show(Additional $additional)
    {
        return view('additional.show', [
            'additional' => $additional
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Additional  $additional
     * @return \Illuminate\Http\Response
     */
    public function edit(Additional $additional)
    {
        return view('additional.edit', [
            'additional' => $additional
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Additional  $additional
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Additional $additional)
    {
        $additional->update([
            'lang' => $request->title ?? $additional->lang,
            'description' => $request->description ?? $additional->description,
        ]);

        return redirect()->back()->with('success', 'Информация успешно обновлена');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Additional  $additional
     * @return \Illuminate\Http\Response
     */
    public function destroy(Additional $additional)
    {
        if($additional->delete()){
            Additional::query()->where(['id' => $additional->id])->delete();
        }


        return redirect()->back()->with('success', 'Информация успешно удалена');
    }

    public function getAdditionalInfo(Request $request)
    {
        $lang = $request->lang ?? 'ru';

        $additional = Additional::query()->where('lang', '=', $lang)->get();

        return response([
            'data' => $additional,
        ], 200);
    }
}
