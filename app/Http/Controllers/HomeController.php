<?php

namespace App\Http\Controllers;

use App\Facility;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $FacilitiesCount = Facility::all()->where('lang', '=', 'ru')->count();
        $userCount = User::all()->where('role', '=', 2)->count();

        return view('home', [
            'facilitiesCount' => $FacilitiesCount,
            'userCount' => $userCount
        ]);
    }
}
