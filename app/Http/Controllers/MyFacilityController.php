<?php
/**
 * Created by PhpStorm.
 * User: eduard
 * Date: 23.05.2021
 * Time: 14:51
 */

namespace App\Http\Controllers;


use App\Facility;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyFacilityController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('my.index', [
            'user' => $user
        ]);
    }

    public function show($id)
    {
        $facility = Facility::query()->where('id', '=', $id)->where('lang','=', 'ru')->first();


        return view('my.show', [
            'facility' => $facility
        ]);
    }

    public function edit($id)
    {
        $facility = Facility::query()->where('id', '=', $id)->where('lang','=', 'ru')->first();
        $categories = Category::all();

        return view('my.edit', [
            'facility' => $facility,
            'categories' => $categories
        ]);
    }

    public function update(Request $request, $id)
    {
        $facility = Facility::query()->where('id', '=', $id)->where('lang','=', 'ru')->first();


        return redirect()->back()->with('success', 'Данные успешно обновленны');
    }
}