<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('perPage', 10);
        $rooms = Room::orderBy('RoomID', 'asc')
            ->paginate($perPage)
            ->appends(['perPage' => $perPage]);

        return view('admin.room.index', compact('rooms', 'perPage'));
    }
    public function create()
    {
        return view('admin.room.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'price_per_night' => 'required|numeric|min:0',
            'status' => 'required|in:Available,Occupied,Maintenance',
            'region' => 'required|string|max:10',
        ]);

        Room::create([
            'PricePerNight' => $request->price_per_night,
            'Status' => $request->status ?? 'Available',
            'Region' => $request->region,
        ]);

        return redirect()->route('admin.room.index')->with('success', 'Thêm phòng thành công!');
    }
    public function show(string $RoomID)
    {
        $room = Room::findOrFail($RoomID);
        $bookings = Booking::where('RoomID', $RoomID)->get();

        // Pass data to the view
        return view('admin.room.detail', compact('room', 'bookings'));
    }
    public function available($RoomID)
    {
        $room = Room::findOrFail($RoomID);
        $room->update(['Status' => 'Available']);
        return redirect()->route('admin.room.index')->with('success', 'Room is now available.');
    }

    public function occupied($RoomID)
    {
        $room = Room::findOrFail($RoomID);
        $room->update(['Status' => 'Occupied']);
        return redirect()->route('admin.room.index')->with('success', 'Room is now occupied.');
    }
    public function maintenance($RoomID)
    {
        $room = Room::findOrFail($RoomID);
        $room->update(['Status' => 'Maintenance']);
        return redirect()->route('admin.room.index')->with('success', 'Room is under maintenance.');
    }
    public function destroy($RoomID)
    {
        $supplier = Room::findOrFail($RoomID);
        $supplier->delete();

        return redirect()->route('admin.room.index')
            ->with('success', 'Xóa nhà cung cấp thành công!');
    }
}
