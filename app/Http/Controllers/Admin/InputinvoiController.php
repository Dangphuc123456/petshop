<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderItem;
use App\Models\Supplier;
use App\Models\Suppliers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class InputinvoiController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('perPage', 10);
        $purchaseOrders = PurchaseOrder::orderBy('order_date', 'desc')
            ->paginate($perPage)
            ->appends(['perPage' => $perPage]);
        $suppliers = Supplier::all();
        $pets = Pet::all();
        return view('admin.inputinvoi.index', compact('purchaseOrders', 'perPage', 'suppliers', 'pets'));
    }
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            // Thêm đơn hàng
            $purchaseOrderData = [
                'supplier_id' => $request->input('supplier_id'),
                'order_date' => $request->input('order_date'),
                'invoice_file' => $request->input('invoice_file'),
                'total_amount' => 0,
            ];
            $purchaseOrder = PurchaseOrder::create($purchaseOrderData);

            // Thêm chi tiết đơn hàng
            $purchaseOrderItemData = [
                'purchase_order_id' => $purchaseOrder->purchase_order_id,
                'pet_id' => $request->input('pet_id'),
                'quantity' => $request->input('quantity'),
                'price' => $request->input('price'),
            ];
            $purchaseOrderItem = PurchaseOrderItem::create($purchaseOrderItemData);

            // Cập nhật số lượng trong bảng pets
            $pet = Pet::find($request->input('pet_id'));
            if ($pet) {
                $pet->quantity_in_stock += $request->input('quantity');
                $pet->save();
            }

            // Tính tổng tiền của đơn hàng
            $totalAmount = 0;
            $purchaseOrderItems = PurchaseOrderItem::where('purchase_order_id', $purchaseOrder->purchase_order_id)->get();
            foreach ($purchaseOrderItems as $item) {
                $totalAmount += $item->quantity * $item->price;
            }

            // Cập nhật tổng tiền vào bảng purchase_orders
            $purchaseOrder->total_amount = $totalAmount;
            $purchaseOrder->save();

            DB::commit();

            return redirect()->route('admin.inputinvoi.index')->with('success', 'Thêm đơn hàng mua thành công!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Đã xảy ra lỗi, vui lòng thử lại!');
        }
    }
    public function show($purchase_order_id)
    {
        $purchaseOrder = PurchaseOrder::with('supplier')->findOrFail($purchase_order_id);

        $purchaseOrderItems = PurchaseOrderItem::where('purchase_order_id', $purchase_order_id)->get();

        return view('admin.inputinvoi.detail', compact('purchaseOrder', 'purchaseOrderItems'));
    }

    public function edit($purchase_order_id)
    {
        $purchase = PurchaseOrder::findOrFail($purchase_order_id);
        $suppliers = Supplier::all();
        $purchaseOrderItems = $purchase->items;
        $pets = Pet::all();

        return view('admin.inputinvoi.edit', compact('purchase', 'suppliers', 'purchaseOrderItems', 'pets'));
    }
    // Cập nhật dữ liệu sau khi chỉnh sửa
    public function update(Request $request, $purchase_order_id)
    {
        $request->validate([
            'supplier_id' => 'required|exists:suppliers,supplier_id',
            'order_date' => 'required|date',
            'invoice_file' => 'nullable|string|max:255',
            'items' => 'required|array|min:1',
            'items.*.pet_id' => 'required|exists:pets,pet_id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();

        try {
            // Lấy đơn hàng cần cập nhật
            $purchaseOrder = PurchaseOrder::findOrFail($purchase_order_id);

            // Trừ kho cũ trước khi xóa chi tiết đơn hàng
            $oldItems = PurchaseOrderItem::where('purchase_order_id', $purchaseOrder->purchase_order_id)->get();
            foreach ($oldItems as $oldItem) {
                $pet = Pet::find($oldItem->pet_id);
                if ($pet) {
                    $pet->quantity_in_stock -= $oldItem->quantity;
                    $pet->save();
                }
            }

            // Xóa các chi tiết đơn hàng cũ
            PurchaseOrderItem::where('purchase_order_id', $purchaseOrder->purchase_order_id)->delete();

            // Cập nhật thông tin đơn hàng
            $purchaseOrder->supplier_id = $request->input('supplier_id');
            $purchaseOrder->order_date = $request->input('order_date');
            $purchaseOrder->invoice_file = $request->input('invoice_file');
            // Thêm lại các chi tiết đơn hàng mới và cộng kho
            $totalAmount = 0;
            foreach ($request->input('items') as $item) {
                $purchaseOrderItem = new PurchaseOrderItem();
                $purchaseOrderItem->purchase_order_id = $purchaseOrder->purchase_order_id;
                $purchaseOrderItem->pet_id = $item['pet_id'];
                $purchaseOrderItem->quantity = $item['quantity'];
                $purchaseOrderItem->price = $item['price'];
                $purchaseOrderItem->save();

                $pet = Pet::find($item['pet_id']);
                if ($pet) {
                    $pet->quantity_in_stock += $item['quantity'];
                    $pet->save();
                }

                $totalAmount += $item['quantity'] * $item['price'];
            }

            // Cập nhật tổng tiền
            $purchaseOrder->total_amount = $totalAmount;
            // Lưu lại đơn hàng
            $purchaseOrder->save();

            DB::commit();

            return redirect()->route('admin.inputinvoi.index')->with('success', 'Cập nhật đơn hàng thành công!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Đã xảy ra lỗi, vui lòng thử lại!')->withInput();
        }
    }

    public function destroy($purchase_order_id)
    {
        $purchaseOrder = PurchaseOrder::find($purchase_order_id);

        if (!$purchaseOrder) {
            return redirect()->back()->with('error', 'Đơn hàng không tồn tại.');
        }
        $purchaseOrder->details()->delete();

        $purchaseOrder->delete();

        return redirect()->route('inputinvoi.index')->with('success', 'Xóa đơn hàng và chi tiết thành công.');
    }
}
