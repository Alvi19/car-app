{{-- <x-app-layout>
    <div class="py-12">
        <div class="dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 dark:bg-gray-800 border-b border-gray-200">
                <h2 class="font-semibold text-xl mb-6 text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Car Return History') }}
                </h2>
                <a href="{{ route('returns.create') }}" class="btn btn-outline btn-success">
                    <i class="fa-solid fa-circle-plus"></i> {{ __('Add Return') }}
                </a>
                @if (session('success'))
                    <div class="bg-green-500 text-white p-4 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white dark:bg-gray-800">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 border-b border-gray-200 dark:border-gray-700">License Plate</th>
                                <th class="py-2 px-4 border-b border-gray-200 dark:border-gray-700">Car</th>
                                <th class="py-2 px-4 border-b border-gray-200 dark:border-gray-700">Return Date</th>
                                <th class="py-2 px-4 border-b border-gray-200 dark:border-gray-700">Total Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($carReturns as $return)
                                <tr>
                                    <td class="py-2 px-4 border-b border-gray-200 dark:border-gray-700">
                                        {{ $return->rental->car->license_plate }}</td>
                                    <td class="py-2 px-4 border-b border-gray-200 dark:border-gray-700">
                                        {{ $return->rental->car->brand }} - {{ $return->rental->car->model }}</td>
                                    <td class="py-2 px-4 border-b border-gray-200 dark:border-gray-700">
                                        {{ $return->return_date }}</td>
                                    <td class="py-2 px-4 border-b border-gray-200 dark:border-gray-700">
                                        {{ $return->total_amount }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}


<x-app-layout>

    <div class="py-12">
        <div class="dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                <h2 class="font-semibold text-xl mb-6 text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Car Return History') }}
                </h2>
                <div class="navbar ">
                    <div class="flex-1">
                        <a href="{{ route('returns.create') }}" class="btn btn-outline btn-success">
                            <i class="fa-solid fa-circle-plus"></i> {{ __('Add Return') }}
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
                                Return Date
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Total Amount
                            </th>
                        </tr>
                    </thead>
                    <tbody class="dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($carReturns as $return)
                            <tr>
                                <td
                                    class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-200">
                                    {{ $return->rental->car->brand }} -
                                    {{ $return->rental->car->model }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                    {{ $return->rental->car->license_plate }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                    {{ $return->return_date }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                    {{ $return->total_amount }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
