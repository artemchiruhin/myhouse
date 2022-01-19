<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Status;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $statuses = Status::all();
        if(isset($request->status)) {
            $orders = Order::where('status_id', $request->status)->get();
        }
        if(!isset($request->status) || $request->status === 'all') {
            $orders = Order::all();
        }
        return view('admin.orders.orders', compact('orders', 'statuses'));
    }

    public function editStatus($id)
    {
        $order = Order::findOrFail($id);
        if($order->status->title !== 'Новый') {
            return redirect()->back();
        }
        $statuses = Status::whereNotIn('title', ['Новый'])->get();
        return view('admin.orders.change-status', compact('order', 'statuses'));
    }
    public function updateStatus($id, Request $request)
    {
        $request->validate(['status' => 'exists:statuses,id']);
        $status = Status::find($request->get('status'));
        if($status->title === 'Обработка данных' && !$request->get('comment')) {
            return redirect(route('admin.orders.change-status-order', $id))->withErrors([
                'comment' => 'Заполните данное поле.'
            ])->withInput();
        } else {
            $order = Order::find($id);
            $order->status_id = $request->get('status');
            $order->comment = $request->get('comment');
            $order->save();
            return redirect(route('admin.orders.orders'))->with(['orderStatusChanged' => 'Статус изменен.']);
        }
    }
}
