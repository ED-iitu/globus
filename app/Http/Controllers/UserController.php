<?php
/**
 * Created by PhpStorm.
 * User: eduard
 * Date: 23.05.2021
 * Time: 04:37
 */

namespace App\Http\Controllers;

use App\Facility;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;


class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('user.index', [
            'users' => $users
        ]);
    }

    public function create()
    {
        $facilities = Facility::all()->where('lang', '=', 'ru');

        return view('user.create', [
            'facilities' => $facilities
        ]);
    }

    public function store(Request $request)
    {

        $user = new User();

        $user::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'facility_id' => $request->facility_id
        ]);

        $user_id = User::select('id')->where('email', $request->email)->first();

        $user->facilities()->attach($request->facility_id, [
            'user_id' => $user_id->id,
            'facility_id' => $request->facility_id
        ]);


        return redirect()->back()->with('success', 'Пользователь успешно добавлен');
    }

    public function destroy(User $user)
    {
        if($user->delete()){
            User::query()->where(['id' => $user->id])->delete();
        }


        return redirect()->back()->with('success', 'Пользователь успешно удалена');
    }

}