<?php

namespace App\Http\Controllers;

use App\Models\House;
use App\Models\Order;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RentController extends Controller
{
    public function index($id)
    {
        $house = House::findOrFail($id);
        return view('user.rent', compact('house'));
    }

    public function rentHouse($id, Request $request)
    {
        $validatedFields = $request->validate(['date_from' => 'required|date|after:today',
            'date_to' => 'required|date|after:date_from']);
        $house = House::find($id);
        if(!$house) return redirect(route('index'));
        $orders = Order::where('house_id', $house->id)->where('date_to', '>', date('Y-m-d'))->get();
        foreach ($orders as $order)
            if($request->date_from > $order->date_from && $request->date_from < $order->date_to
            || $request->date_to > $order->date_from && $request->date_to < $order->date_to
            || $request->date_from < $order->date_from && $request->date_to > $order->date_to)
                return redirect()->back()->withErrors(['date_exists' => 'В выбранные даты дом занят.'])->withInput();
        $days = date_diff(date_create($request->date_to), date_create($request->date_from))->days;
        $cost = $days * $house->price_per_day;
        Order::create(['house_id' => $house->id,'user_id' => Auth::id(),'cost' => $cost,
            'date_from' => $validatedFields['date_from'],'date_to' => $validatedFields['date_to']]);
        return redirect(route('index'))->with(['orderAccepted' => 'Заказ принят.']);
    }
}
