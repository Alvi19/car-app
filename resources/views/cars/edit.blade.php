<x-app-layout>
    <div class="py-12">
        <div class="dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 dark:bg-gray-800 border-b border-gray-200">
                <h2 class="font-semibold text-xl mb-6 text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Edit Car') }}
                </h2>
                <form method="POST" action="{{ route('cars.update', $car->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <div class="mb-4">
                                <label for="brand"
                                    class="block text-sm font-bold text-gray-700 dark:text-gray-200">Merk</label>
                                <input type="text" name="brand" id="brand" value="{{ $car->brand }}"
                                    class="form-input dark:bg-gray-800 text-white mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
                                @error('brand')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="model"
                                    class="block text-sm font-bold text-gray-700 dark:text-gray-200">Model</label>
                                <input type="text" name="model" id="model" value="{{ $car->model }}"
                                    class="form-input dark:bg-gray-800 text-white mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
                                @error('model')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="photo"
                                    class="block text-gray-700 text-sm font-bold mb-2 dark:text-gray-200">Photo</label>
                                <input type="file" name="photo" id="photo"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                @error('photo')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                                @if ($car->photo)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/photos/' . $car->photo) }}"
                                            alt="{{ $car->brand }} - {{ $car->model }}"
                                            class="h-100 w-80 object-cover rounded">
                                    </div>
                                @else
                                    <p class="text-sm text-gray-500 dark:text-gray-300 mt-2">No photo available</p>
                                @endif
                            </div>
                        </div>

                        <div>
                            <div class="mb-4">
                                <label for="license_plate"
                                    class="block text-sm font-bold text-gray-700 dark:text-gray-200">Plat Nomor</label>
                                <input type="text" name="license_plate" id="license_plate"
                                    value="{{ $car->license_plate }}"
                                    class="form-input dark:bg-gray-800 text-white mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
                                @error('license_plate')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="rental_rate_per_day"
                                    class="block text-sm font-bold text-gray-700 dark:text-gray-200">Rental Rate
                                    (per day)</label>
                                <input type="number" name="rental_rate_per_day" id="rental_rate_per_day"
                                    value="{{ $car->rental_rate_per_day }}"
                                    class="form-input dark:bg-gray-800 text-white mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
                                @error('rental_rate_per_day')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center mt-6">
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Update Car
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
