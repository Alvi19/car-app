<x-app-layout>
    <div class="py-12">
        <div class="dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 dark:bg-gray-800 border-b border-gray-200">
                <h2 class="font-semibold text-xl mb-6 text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Booking Car Rental') }}
                </h2>
                <form method="POST" action="{{ route('rentals.store') }}">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="mb-4">
                            <label for="car_id" class="block text-sm font-bold text-gray-700 dark:text-gray-200">Select
                                Car</label>
                            <select name="car_id" id="car_id"
                                class="dark:bg-gray-800 text-white shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                @foreach ($availableCars as $car)
                                    <option value="{{ $car->id }}">{{ $car->brand }} - {{ $car->model }}
                                    </option>
                                @endforeach
                            </select>
                            @error('car_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="start_date"
                                class="block text-sm font-bold text-gray-700 dark:text-gray-200">Star
                                Date</label>
                            <input type="date" name="start_date" id="start_date" value="{{ old('start_date') }}"
                                class="dark:bg-gray-800 form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
                            @error('start_date')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="end_date" class="block text-sm font-bold text-gray-700 dark:text-gray-200">End
                                Date</label>
                            <input type="date" name="end_date" id="end_date" value="{{ old('end_date') }}"
                                class="dark:bg-gray-800 form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
                            @error('end_date')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="flex items-center mt-6">
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Add Car
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
