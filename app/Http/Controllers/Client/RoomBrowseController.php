<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\ApartmentType;
use App\Models\BedType;
use Illuminate\Http\Request;

class RoomBrowseController extends Controller
{
    public function index(Request $request)
    {
        $query = Room::with(['apartmentType', 'bedType', 'amenities'])->where('status', 'available');

        // Filter by apartment type
        if ($request->filled('apartment_type')) {
            $query->where('apartment_type_id', $request->apartment_type);
        }

        // Filter by bed type
        if ($request->filled('bed_type')) {
            $query->where('bed_type_id', $request->bed_type);
        }

        // Filter by capacity
        if ($request->filled('capacity')) {
            $query->where('capacity', '>=', $request->capacity);
        }

        // Filter by price range
        if ($request->filled('price_min')) {
            $query->where('price_per_night', '>=', $request->price_min);
        }
        if ($request->filled('price_max')) {
            $query->where('price_per_night', '<=', $request->price_max);
        }

        $rooms = $query->latest()->paginate(12);
        $apartmentTypes = ApartmentType::all();
        $bedTypes = BedType::all();

        return view('client.rooms.browse', compact('rooms', 'apartmentTypes', 'bedTypes'));
    }

    public function show(Room $room)
    {
        $room->load(['apartmentType', 'bedType', 'amenities']);
        return view('client.rooms.show', compact('room'));
    }
} 