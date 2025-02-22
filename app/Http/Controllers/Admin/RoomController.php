<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::latest()->paginate(10);
        return view('admin.rooms.index', compact('rooms'));
    }

    public function create()
    {
        $amenities = \App\Models\Amenity::all();
        $bedTypes = \App\Models\BedType::all();
        return view('admin.rooms.create', compact('amenities', 'bedTypes'));
    }

    public function show(Room $room)
    {
        $room->load('amenities');
        return view('admin.rooms.show', compact('room'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price_per_night' => 'required|numeric|min:0',
            'capacity' => 'required|integer|min:1',
            'bed_type_id' => 'required|exists:bed_types,id',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'amenities' => 'array',
            'amenities.*' => 'exists:amenities,id'
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('rooms', 'public');
            $validated['image_path'] = $imagePath;
        }

        // Add default apartment_type_id
        $validated['apartment_type_id'] = 1;

        $room = Room::create($validated);

        // Sync amenities
        if ($request->has('amenities')) {
            $room->amenities()->sync($request->amenities);
        }

        return redirect()->route('admin.rooms.index')
            ->with('success', 'Room created successfully.');
    }

    public function edit(Room $room)
    {
        return view('admin.rooms.edit', compact('room'));
    }

    public function update(Request $request, Room $room)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price_per_night' => 'required|numeric|min:0',
            'capacity' => 'required|integer|min:1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($room->image_path) {
                Storage::disk('public')->delete($room->image_path);
            }
            $imagePath = $request->file('image')->store('rooms', 'public');
            $validated['image_path'] = $imagePath;
        }

        $room->update($validated);

        return redirect()->route('admin.rooms.index')
            ->with('success', 'Room updated successfully.');
    }

    public function destroy(Room $room)
    {
        if ($room->image_path) {
            Storage::disk('public')->delete($room->image_path);
        }
        
        $room->delete();

        return redirect()->route('admin.rooms.index')
            ->with('success', 'Room deleted successfully.');
    }
} 