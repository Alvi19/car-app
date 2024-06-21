<div class="w-64 h-screen bg-gray-800 text-white">
    <div class="p-6">
        <a href="{{ route('dashboard') }}" class="block px-4 py-2 hover:bg-gray-700">
            {{ __('Dashboard') }}
        </a>
    </div>
    <ul>
        <li class="mt-4">
            <a href="{{ route('cars.index') }}" class="block px-4 py-2 hover:bg-gray-700">
                {{ __('Cars') }}
            </a>
        </li>
        <li class="mt-4">
            <a href="{{ route('rentals.index') }}" class="block px-4 py-2 hover:bg-gray-700">
                {{ __('Cars Rental') }}
            </a>
        </li>
        <li class="mt-4">
            <a href="{{ route('returns.index') }}" class="block px-4 py-2 hover:bg-gray-700">
                {{ __('Cars Return') }}
            </a>
        </li>
        <!-- Add more sidebar links here -->
    </ul>
</div>
