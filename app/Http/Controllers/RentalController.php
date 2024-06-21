<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Rental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RentalController extends Controller
{
    public function index()
    {
        $rentals = Rental::where('user_id', Auth::id())->get();
        return view('rentals.index', compact('rentals'));
    }

    public function create()
    {
        $availableCars = Car::where('is_available', true)
            ->whereNotIn('id', function ($query) {
                $query->select('car_id')
                    ->from('rentals')
                    ->whereRaw('DATE(end_date) >= CURRENT_DATE');
            })
            ->get();

        return view('rentals.create', compact('availableCars'));
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'car_id' => 'required|exists:cars,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $validator->after(function ($validator) use ($request) {
            $carId = $request->input('car_id');
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');

            // Validate car availability
            if (!$this->isCarAvailable($carId, $startDate, $endDate)) {
                $validator->errors()->add('car_id', 'The selected car is not available for the given dates.');
            }
        });

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $requestData = $request->all();
        $requestData['user_id'] = Auth::id();

        // Buat rental baru
        Rental::create($requestData);

        // Update status is_available mobil yang telah disewa
        $rentedCar = Car::find($request->input('car_id'));
        if ($rentedCar) {
            $rentedCar->is_available = false;
            $rentedCar->save();
        }

        return redirect()->route('rentals.index')
            ->with('success', 'Car rental booked successfully.');
    }


    public function show(Rental $rental)
    {
        return view('rentals.show', compact('rental'));
    }

    private function isCarAvailable($carId, $startDate, $endDate)
    {
        // Check if there are any overlapping rentals for the selected car and dates
        $count = Rental::where('car_id', $carId)
            ->where(function ($query) use ($startDate, $endDate) {
                $query->where(function ($q) use ($startDate, $endDate) {
                    $q->where('start_date', '<=', $startDate)
                        ->where('end_date', '>=', $startDate);
                })
                    ->orWhere(function ($q) use ($startDate, $endDate) {
                        $q->where('start_date', '<=', $endDate)
                            ->where('end_date', '>=', $endDate);
                    });
            })
            ->count();

        return $count === 0;
    }
}
