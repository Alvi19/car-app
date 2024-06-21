<x-app-layout>
    <div class="py-12">
        <div class="dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 dark:bg-gray-800 border-b border-gray-200">
                <h2 class="font-semibold text-xl mb-6 text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Car Return Rental') }}
                </h2>
                <form method="POST" action="{{ route('returns.store') }}">
                    @csrf
                    <div class="class="grid grid-cols-1 md:grid-cols-2 gap-4"">

                        <div class="mb-4">
                            <label for="rental_id" class="block text-sm font-bold text-gray-700 dark:text-gray-200">Plat
                                Nomor</label>
                            <select name="rental_id" id="rental_id"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                @foreach ($rentals as $rental)
                                    <option value="{{ $rental->id }}">
                                        {{-- {{ $rental->car->brand }} --}}
                                        {{-- {{ $rental->car->model }} ({{ $rental->start_date }} - {{ $rental->end_date }}) --}}
                                        {{ $rental->car->license_plate }}
                                    </option>
                                @endforeach
                            </select>
                            @error('rental_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="return_date"
                                class="block text-sm font-bold text-gray-700 dark:text-gray-200">Return
                                Date</label>
                            <input type="date" name="return_date" id="return_date"
                                class="form-input dark:bg-gray-800 text-white mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
                            @error('return_date')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>
                    <div class="flex items-center justify-between">
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Return Car
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
