<?php

namespace App\Http\Controllers;

use App\Infographic;
use Illuminate\Http\Request;

class InfographicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $infographics = Infographic::all();

        return view('infographic.index', [
            'infographics' => $infographics
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('infographic.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $info = new Infographic();

        $info::create([
            'title' => $request->title,
            'description' => $request->description,
            'lang' => $request->lang
        ]);

        return redirect()->back()->with('success', 'Информация успешно добавлена');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Infographic  $infographic
     * @return \Illuminate\Http\Response
     */
    public function show(Infographic $infographic)
    {
        return view('infographic.show', [
            'infographic' => $infographic
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Infographic  $infographic
     * @return \Illuminate\Http\Response
     */
    public function edit(Infographic $infographic)
    {
        return view('infographic.edit', [
            'infographic' => $infographic
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Infographic  $infographic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Infographic $infographic)
    {
        $infographic->update([
            'title' => $request->title ?? $infographic->title,
            'description' => $request->description ?? $infographic->description,
            'lang' => $request->lang ?? $infographic->lang
        ]);

        return redirect()->back()->with('success', 'Информация успешно обновлена');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Infographic  $infographic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Infographic $infographic)
    {
        if($infographic->delete()){
            Infographic::query()->where(['id' => $infographic->id])->delete();
        }


        return redirect()->back()->with('success', 'Информация успешно удалена');
    }
}
