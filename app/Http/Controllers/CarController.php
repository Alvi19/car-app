<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        if ($search) {
            $cars = Car::whereRaw('LOWER(brand) LIKE ?', ['%' . strtolower($search) . '%'])
                ->orWhereRaw('LOWER(model) LIKE ?', ['%' . strtolower($search) . '%'])
                ->orWhereRaw('LOWER(license_plate) LIKE ?', ['%' . strtolower($search) . '%'])
                ->orderBy('id', 'desc')
                ->get();
        } else {
            $cars = Car::orderBy('id', 'desc')->get();
        }

        return view('cars.index', compact('cars'));
    }

    public function create()
    {
        return view('cars.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'brand' => 'required|string',
            'model' => 'required|string',
            'license_plate' => 'required|string|unique:cars',
            'rental_rate_per_day' => 'required|numeric',
            'is_available' => 'boolean',
            'photo' => 'image' // tambahkan validasi untuk foto
        ]);

        // Handle photo upload
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $filename = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/photos', $filename); // simpan foto ke storage
            $validatedData['photo'] = $filename; // simpan nama file foto ke database
        }

        Car::create($validatedData);

        return redirect()->route('cars.index')
            ->with('success', 'Car added successfully.');
    }

    public function show(Car $car)
    {
        return view('cars.show', compact('car'));
    }

    public function edit(Car $car)
    {
        return view('cars.edit', compact('car'));
    }

    public function update(Request $request, Car $car)
    {
        $validatedData = $request->validate([
            'brand' => 'required|string',
            'model' => 'required|string',
            'license_plate' => 'required|string|unique:cars,license_plate,' . $car->id,
            'rental_rate_per_day' => 'required|numeric',
            'is_available' => 'boolean',
            'photo' => 'image' // tambahkan validasi untuk foto
        ]);

        // Handle photo update
        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($car->photo) {
                Storage::delete('public/photos/' . $car->photo);
            }

            $image = $request->file('photo');
            $filename = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/photos', $filename); // simpan foto ke storage
            $validatedData['photo'] = $filename; // simpan nama file foto ke database
        }

        $car->update($validatedData);

        return redirect()->route('cars.index')
            ->with('success', 'Car updated successfully.');
    }

    public function destroy(Car $car)
    {
        if ($car->photo) {
            Storage::delete('public/photos/' . $car->photo);
        }

        $car->delete();

        return redirect()->route('cars.index')
            ->with('success', 'Car deleted successfully.');
    }

    public function toggleAvailability(Car $car)
    {
        $car->update(['is_available' => request()->is_available]);

        return response()->json(['message' => 'Car availability toggled successfully']);
    }
}
