<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarReturn;
use App\Models\Rental;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ReturnController extends Controller
{
    public function index()
    {
        $carReturns = CarReturn::with(['rental.car'])
            ->whereHas('rental', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->paginate(10); // Sesuaikan pagination sesuai kebutuhan

        return view('returns.index', compact('carReturns'));
    }

    public function create()
    {
        $returnedRentalIds = CarReturn::pluck('rental_id');
        $rentals = Rental::where('user_id', Auth::id())
            ->whereNotIn('id', $returnedRentalIds)
            ->with('car')
            ->get();

        return view('returns.create', compact('rentals'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'rental_id' => 'required|exists:rentals,id',
            'return_date' => 'required|date',
        ]);

        $rental = Rental::with('car')->findOrFail($request->rental_id);

        $startDate = Carbon::parse($rental->start_date);
        $endDate = Carbon::parse($request->return_date);

        $days = $startDate->diffInDays($endDate);

        $totalAmount = $days * $rental->car->rental_rate_per_day;

        CarReturn::create([
            'rental_id' => $rental->id,
            'return_date' => $request->return_date,
            'total_amount' => $totalAmount,
        ]);

        return redirect()->route('returns.index')
            ->with('success', 'Car returned successfully.');
    }
}
