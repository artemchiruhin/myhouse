<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\House;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        if(isset($request->category)) {
            $houses = House::where('category_id', $request->category)->paginate(5);
        }
        if(!isset($request->category) || $request->category === 'all') {
            $houses = House::paginate(7);
        }
        return view('index', compact('categories', 'houses'));
    }

    public function profile()
    {
        $user = Auth::user();
        $orders = Order::where('user_id', $user->id)->get();
        return view('user.profile', compact('user', 'orders'));
    }

    public function admin()
    {
        return view('admin.index');
    }
}
