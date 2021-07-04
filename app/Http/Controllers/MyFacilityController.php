<?php
/**
 * Created by PhpStorm.
 * User: eduard
 * Date: 23.05.2021
 * Time: 14:51
 */

namespace App\Http\Controllers;


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
}