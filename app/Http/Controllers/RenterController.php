<?php

namespace App\Http\Controllers;

use App\Renter;
use Illuminate\Http\Request;

class RenterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $renters = Renter::all();

        return view('renter.index' , [
           'renters' => $renters
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('renter.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $renter = new Renter();

        $renter::create([
            'title' => $request->title,
            'description' => $request->description,
            'phone' => $request->phone,
            'lang' => $request->lang
        ]);

        return redirect()->back()->with('success', 'Информация успешно добавлена');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Renter  $renter
     * @return \Illuminate\Http\Response
     */
    public function show(Renter $renter)
    {
        return view('renter.show', [
            'renter' => $renter
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Renter  $renter
     * @return \Illuminate\Http\Response
     */
    public function edit(Renter $renter)
    {
        return view('renter.edit', [
            'renter' => $renter
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Renter  $renter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Renter $renter)
    {
        $renter->update([
            'title' => $request->title ?? $renter->title,
            'description' => $request->description ?? $renter->description,
            'phone' => $request->phone ?? $renter->phone,
            'lang' => $request->lang ?? $renter->lang
        ]);

        return redirect()->back()->with('success', 'Информация успешно обновлена');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Renter  $renter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Renter $renter)
    {
        if($renter->delete()){
            Renter::query()->where(['id' => $renter->id])->delete();
        }


        return redirect()->back()->with('success', 'Информация успешно удалена');
    }

    public function renterInfo(Request $request)
    {
        $lang = $request->lang ?? 'ru';

        $renter = Renter::query()->where('lang', '=', $lang)->orderBy('created_at', 'DESC')->get();

        if (count($renter) == 0) {
            return response([
                'error' => "Not found",
            ], 404);
        }

        return response([
            'data' => $renter,
            'phone' => $renter[0]->phone
        ], 200);
    }
}
