<?php

namespace App\Http\Controllers;

use App\About;
use App\Infographic;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isEmpty;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $abouts = About::all();

        return view('about.index', [
            'abouts' => $abouts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('about.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $about = new About();

        $about::create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'Информация успешно добавлена');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\About  $about
     * @return \Illuminate\Http\Response
     */
    public function show(About $about)
    {
        return view('about.show', [
            'about' => $about
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\About  $about
     * @return \Illuminate\Http\Response
     */
    public function edit(About $about)
    {
        return view('about.edit', [
            'about' => $about
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\About  $about
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, About $about)
    {
        $about->update([
            'title' => $request->title ?? $about->title,
            'deescription' => $request->description ?? $about->description,
        ]);

        return redirect()->back()->with('success', 'Информация успешно обновлена');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\About  $about
     * @return \Illuminate\Http\Response
     */
    public function destroy(About $about)
    {
        if($about->delete()){
            About::query()->where(['id' => $about->id])->delete();
        }


        return redirect()->back()->with('success', 'Информация успешно удалена');
    }

    public function aboutInfo(Request $request)
    {
        $lang = $request->lang ?? 'ru';

        $about = About::query()->where('lang', '=', $lang)->get();

        if (count($about) == 0) {
            return response([
                'error' => "Not Found",
            ], 404);
        }

        $info = Infographic::query()->where('lang', '=', $lang)->get();

        return response([
            'about' => $about,
            'infographics' => $info
        ], 200);
    }
}
