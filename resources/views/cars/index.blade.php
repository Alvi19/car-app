<x-app-layout>
    <div class="py-12">
        <div class="dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                <h2 class="font-semibold text-xl mb-6 text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Cars Management') }}
                </h2>
                <div class="navbar ">
                    <div class="flex-1">
                        <a href="{{ route('cars.create') }}" class="btn btn-outline btn-success">
                            <i class="fa-solid fa-circle-plus"></i> {{ __('Add New Car') }}
                        </a>
                    </div>
                    <div class="flex-none gap-2">
                        <div class="form-control">
                            <form action="{{ route('cars.index') }}" method="GET">
                                <input type="text" name="search" placeholder="Search"
                                    class="input input-bordered w-24 md:w-auto" value="{{ request('search') }}" />
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-6">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="dark:bg-gray-700">
                        <tr>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Merk
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Model
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Photo
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Plat Nomor
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Rental Rate per Day
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Status
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($cars as $car)
                            <tr>
                                <td
                                    class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-200">
                                    {{ $car->brand }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                    {{ $car->model }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    @if ($car->photo)
                                        <img src="{{ asset('storage/photos/' . $car->photo) }}"
                                            alt="{{ $car->brand }} - {{ $car->model }}" class="object-cover rounded"
                                            style="width: 100px; height: 100px;">
                                    @else
                                        <span class="text-sm text-gray-500 dark:text-gray-300">No photo available</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                    {{ $car->license_plate }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                    {{ $car->rental_rate_per_day }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <label class="cursor-pointer label">
                                        <input type="checkbox" class="toggle toggle-accent" name="is_available"
                                            id="toggle-{{ $car->id }}" {{ $car->is_available ? 'checked' : '' }}
                                            onchange="toggleAvailability({{ $car->id }}, this)">
                                    </label>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="{{ route('cars.edit', $car->id) }}" class="btn btn-outline btn-warning">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <form action="{{ route('cars.destroy', $car->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline btn-error"><i
                                                class="fa-solid fa-trash-can"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function toggleAvailability(carId, element) {
            const isChecked = element.checked;
            const toggle = document.getElementById(`toggle-${carId}`);

            fetch(`/toggle-availability/${carId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        is_available: isChecked
                    })
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data.message);
                })
                .catch(error => {
                    console.error('Error:', error);
                    toggle.checked = !isChecked;
                });
        }
    </script>

    <style>
        .toggle {
            -webkit-appearance: none;
            appearance: none;
            width: 40px;
            height: 20px;
            background-color: #dc2626;
            border-radius: 20px;
            position: relative;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .toggle:checked {
            background-color: #3b82f6;
        }

        .toggle::before {
            content: '';
            position: absolute;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            left: 2px;
            top: 2px;
            background-color: #fff;
            transition: transform 0.3s ease;
        }

        .toggle:checked::before {
            transform: translateX(20px);
        }
    </style>

</x-app-layout>
