<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.categories', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $validatedFields = $request->validate([
            'title' => 'required|max:100|unique:categories',
        ]);
        $validatedFields['slug'] = Str::slug($validatedFields['title']);

        $category = Category::create($validatedFields);
        if($category) {
            return redirect(route('admin.categories.categories'))->with([
                'categoryCreated' => 'Категория успешно создана.'
            ]);
        }

        return redirect(route('admin.categories.create-category'))->withErrors([
            'formError' => 'Произошла ошибка при сохранении категории.'
        ]);
    }

    public function edit($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        return view('admin.categories.edit', compact('category'));
    }

    public function update($slug, Request $request)
    {
        $validatedFields = $request->validate([
            'title' => 'required|max:100|unique:categories',
        ]);
        $validatedFields['slug'] = Str::slug($validatedFields['title']);

        $category = Category::where('slug', $slug)->first();
        $category->title = $validatedFields['title'];
        $category->slug = $validatedFields['slug'];
        $category->save();
        return redirect(route('admin.categories.categories'))->with([
            'categoryUpdated' => 'Категория обновлена.'
        ]);
    }

    public function destroy($slug)
    {
        $category = Category::where('slug', $slug);
        if($category) {
            $category->delete();
            return redirect()->route('admin.categories.categories')->with(['categoryDeleted' => 'Категория удалена.']);
        }
        return redirect()->route('admin.categories.categories')->withErrors(['categoryError' => 'При удалении произошла ошибка']);
    }
}
