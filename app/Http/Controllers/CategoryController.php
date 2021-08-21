<?php

namespace App\Http\Controllers;

use App\Category;
use App\Facility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Mail;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();

        return view('category.index', [
           'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create');
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

            Category::create([
                'title' => $validated['title'],
                'lang' => $request->lang,
                'image' => '/uploads/' . $image_link->getFilename() . '.' . $extensionImage,
            ]);

            return redirect()->back()->with('success', 'Категория успешно добавлена');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        $category = Category::find($category->id);

        return view('category.show', [
           'category' => $category
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $category = Category::find($category->id);

        return view('category.edit', [
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $image_link = $request->file('image');

        if (null !== $image_link) {
            $extensionImage = $image_link->getClientOriginalExtension();
            Storage::disk('public')->put($image_link->getFilename().'.'.$extensionImage,  File::get($image_link));
        } else {
            $img = $category->image;
        }

        $category->update([
            'title' => $request->title,
            'lang'  => $request->lang,
            'image' => $img ?? '/uploads/' . $image_link->getFilename() . '.' . $extensionImage,
        ]);

        return redirect()->back()->with('success', 'Категория успешно обновлена');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {

        if($category->delete()){
            Category::query()->where(['id' => $category->id])->delete();
        }


        return redirect()->back()->with('success', 'Категория успешно удалена');
    }


    public function getAll(Request $request)
    {
        $lang = $request->lang ?? 'ru';

        $categories = Category::all()->where('lang', '=', $lang);

        if (!$categories) {
            return response(['error' => 'Список категорий пуст'], 404);
        }

        return response([
            'categories' => $categories,
        ], 200);
    }
}
