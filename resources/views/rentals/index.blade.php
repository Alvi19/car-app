<x-app-layout>

    <div class="py-12">
        <div class="dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                <h2 class="font-semibold text-xl mb-6 text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Rental Management') }}
                </h2>
                <div class="navbar ">
                    <div class="flex-1">
                        <a href="{{ route('rentals.create') }}" class="btn btn-outline btn-success">
                            <i class="fa-solid fa-circle-plus"></i> {{ __('Add New Rental') }}
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
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($rentals as $rental)
                            <tr>
                                <td
                                    class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-200">
                                    {{ $rental->car->brand }} -
                                    {{ $rental->car->model }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                    {{ $rental->car->license_plate }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                    {{ $rental->start_date }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                    {{ $rental->end_date }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{ route('rentals.show', $rental->id) }}"
                                        class="btn btn-outline btn-info"><i class="fa-solid fa-circle-info"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
