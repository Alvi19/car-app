<x-app-layout>

    <div class="py-12">
        <div class="dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                <h2 class="font-semibold text-xl mb-6 text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Rental Management') }}
                </h2>
                <div class="navbar ">
                    <div class="flex-1">
                        <a href="{{ route('rentals.index') }}"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Back to Rentals
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

            <!-- Table to display cars -->
            <div class="p-6">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="dark:bg-gray-700">
                        <tr>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Car
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Plat Nomor
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Start Date
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                End Date
                            </th>
                            {{-- <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Actions
                            </th> --}}
                        </tr>
                    </thead>
                    <tbody class="dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        {{-- @foreach ($rentals as $rental) --}}
                        <tr>
                            <td
                                class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-200">
                                {{ $rental->car->brand }} - {{ $rental->car->model }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                {{ $rental->start_date }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                {{ $rental->end_date }}
                            </td>
                            {{-- <td class="px-6 py-4 whitespace-nowrap">
                                <a href="{{ route('rentals.show', $rental->id) }}"
                                    class="text-indigo-600 hover:text-indigo-900">View</a>
                            </td> --}}
                            {{-- <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="{{ route('cars.edit', $car->id) }}" class="btn btn-outline btn-warning">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <form action="{{ route('cars.destroy', $car->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline btn-error"><i
                                                class="fa-solid fa-trash-can"></i></button>
                                    </form>
                                </td> --}}
                        </tr>
                        {{-- @endforeach --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
