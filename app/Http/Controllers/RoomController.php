<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\ApartmentType;
use App\Models\BedType;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RoomController extends Controller
{
    public function index()
    {
        return view('rooms.index', [
            'rooms' => Room::with(['apartmentType', 'bedType'])->paginate(12)
        ]);
    }

    public function browse()
    {
        return view('rooms.browse', [
            'rooms' => Room::with(['apartmentType', 'bedType'])
                ->where('status', 'available')
                ->latest()
                ->paginate(12),
            'apartmentTypes' => ApartmentType::all(),
            'bedTypes' => BedType::all()
        ]);
    }

    public function search(Request $request)
    {
        $query = Room::query()->with(['apartmentType', 'bedType']);

        if ($request->filled('apartment_type')) {
            $query->where('apartment_type_id', $request->apartment_type);
        }

        if ($request->filled('bed_type')) {
            $query->where('bed_type_id', $request->bed_type);
        }

        if ($request->filled('guests')) {
            $query->where('capacity', '>=', $request->guests);
        }

        return view('rooms.browse', [
            'rooms' => $query->paginate(12),
            'apartmentTypes' => ApartmentType::all(),
            'bedTypes' => BedType::all()
        ]);
    }

    public function show(Room $room)
    {
        return view('rooms.show', [
            'room' => $room->load(['apartmentType', 'bedType'])
        ]);
    }
} 