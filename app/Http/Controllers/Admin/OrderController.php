<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Pet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('perPage', 10);
        $orders = Order::orderBy('order_date', 'desc')
            ->paginate($perPage)
            ->appends(['perPage' => $perPage]);

        return view('admin.order.index', compact('orders', 'perPage'));
    }

    public function confirm($order_id)
    {
        $order = Order::find($order_id);

        if ($order) {
            $order->status = 'Đã xác nhận';
            $order->save();

            return redirect()->route('admin.order.index')->with('success', 'Xác nhận đơn hàng thành công.');
        } else {
            return redirect()->route('admin.order.index')->with('error', 'Không tìm thấy đơn hàng.');
        }
    }

    public function delivered($order_id)
    {
        // Find the order by its ID
        $order = Order::findOrFail($order_id);

        // Update the order status
        $order->update([
            'status' => 'Hoàn thành', // Assuming 'Status' is the field indicating the order status
        ]);


        return redirect()->route('admin.order.index')->with('success', 'Đã giao hàng thành công.');
    }
    public function delivery($order_id)
    {
        // Find the order by its ID
        $order = Order::findOrFail($order_id);

        // Update the order status
        $order->update([
            'status' => 'Đang giao hàng', // Assuming 'Status' is the field indicating the order status
        ]);


        return redirect()->route('admin.order.index')->with('success', 'Đơn hàng đã đang được giao.');
    }

    public function cancel($order_id)
    {
        $order = Order::findOrFail($order_id);
        $order->status = 'Đã hủy';
        $order->save();

        return redirect()->route('admin.order.index')->with('success', 'Đơn hàng đã bị hủy.');
    }

    public function show($order_id)
    {
        $order = Order::findOrFail($order_id);
        $order_items = OrderItem::where('order_id', $order_id)->get();

        return view('admin.order.detail', compact('order', 'order_items'));
    }

    public function create(Request $request)
    {
        $query = Pet::query();
        if ($request->has('search') && $request->search != '') {
            $query->where('pet_id', $request->search);
        }
        $pets = $query->get();

        return view('admin.order.create', compact('pets'));
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_name' => 'required|string',
            'phone'         => 'required',
            'address'       => 'required',
            'items'         => 'required|array',
        ]);

        DB::transaction(function () use ($data) {
            // Tạo Order
            $order = Order::create([
                'customer_name'  => $data['customer_name'],
                'phone'          => $data['phone'],
                'address'        => $data['address'],
                'total_amount'   => 0,
                'status'         => 'Hoàn thành',
                'order_date'     => now(),
                'payment'        => 'cash',
            ]);

            $total = 0;

            // Tạo mỗi OrderItem, phần trừ-kho sẽ tự chạy trong Observer
            foreach ($data['items'] as $petId => $item) {
                $qty = (int) data_get($item, 'quantity', 0);
                if ($qty <= 0) continue;

                $pet = Pet::findOrFail($petId);
                if ($qty > $pet->quantity_in_stock) {
                    throw new \Exception("Pet #{$petId} chỉ còn {$pet->quantity_in_stock} trong kho.");
                }

                OrderItem::create([
                    'order_id'    => $order->order_id,
                    'pet_id'      => $pet->pet_id,
                    'quantity'    => $qty,
                    'price'       => $pet->price,
                    'description' => $pet->description,
                    'image_url'   => $pet->image_url,
                ]);

                $total += $pet->price * $qty;
            }

            // Cập nhật tổng tiền
            $order->update(['total_amount' => $total]);
        });

        return redirect()
            ->route('admin.order.create')
            ->with('success', 'Tạo đơn hàng thành công!');
    }
}
