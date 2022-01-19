<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\House;
use Illuminate\Http\Request;

class HouseController extends Controller
{
    public function index()
    {
        $houses = House::paginate(7);
        return view('admin.houses.houses', compact('houses'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.houses.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validatedFields = $request->validate([
            'title' => 'required|max:100','description' => 'required|max:255',
            'address' => 'required|max:255','rooms' => 'required|numeric|integer|min:1',
            'category_id' => 'required|exists:categories,id','price_per_day' => 'required|numeric|min:1',
            'image' => 'required|image:jpg, jpeg, png, bmp|max:2048']);
        $image = $request->file('image');
        $path = $image->store('houses');
        $validatedFields['image'] = $path;
        House::create($validatedFields);
        return redirect(route('admin.houses.houses'))->with(['houseCreated' => 'Дом успешно добавлен.']);
    }

    public function edit($id)
    {
        $categories = Category::all();
        $house = House::findOrFail($id);
        return view('admin.houses.edit', compact('house', 'categories'));
    }

    public function update($id, Request $request)
    {
        $validatedFields = $request->validate(['title' => 'required|max:100','description' => 'required|max:255',
            'address' => 'required|max:255','rooms' => 'required|numeric|integer',
            'category_id' => 'required|exists:categories,id','price_per_day' => 'required|numeric',
            'image' => 'image:jpg, jpeg, png, bmp|max:2048']);
        $house = House::find($id);
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $path = $image->store('houses');
            $house->image = $path;
        }
        $house->title = $validatedFields['title'];
        $house->description = $validatedFields['description'];
        $house->address = $validatedFields['address'];
        $house->rooms = $validatedFields['rooms'];
        $house->category_id = $validatedFields['category_id'];
        $house->price_per_day = $validatedFields['price_per_day'];
        $house->save();
        return redirect(route('admin.houses.houses'))->with(['houseUpdated' => 'Запись обновлена.']);
    }

    public function destroy($id)
    {
        $house = House::find($id);
        if($house) {
            $house->delete();
            return redirect()->route('admin.houses.houses')->with(['houseDeleted' => 'Дом удален.']);
        }
        return redirect()->route('admin.houses.houses')->withErrors(['houseError' => 'При удалении произошла ошибка']);
    }
}
