<nav class="bg-[#111827] border-b border-gray-700">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex justify-between h-16 items-center">

            <!-- Left -->
            <div class="flex items-center gap-10">

                <a href="{{ Auth::user()->role == 'admin' ? route('dashboard') : route('student.dashboard') }}">
                    <x-application-logo class="h-9 w-auto text-white"/>
                </a>

                <div class="hidden md:flex items-center gap-8">

                    @if(Auth::user()->role == 'admin')

                        <a href="{{ route('dashboard') }}" class="text-gray-300 hover:text-white font-medium">
                            Dashboard
                        </a>

                        <a href="{{ route('bookings.index') }}" class="text-gray-300 hover:text-white font-medium">
                            Bookings
                        </a>

                        <a href="{{ route('facilities.index') }}" class="text-gray-300 hover:text-white font-medium">
                            Facilities
                        </a>

                        <a href="{{ route('reports.index') }}" class="text-gray-300 hover:text-white font-medium">
                            Reports
                        </a>

                        <a href="{{ route('calendar.index') }}" class="text-gray-300 hover:text-white font-medium">
                            Calendar
                        </a>

                    @else

                        <a href="{{ route('student.dashboard') }}" class="text-gray-300 hover:text-white font-medium">
                            Dashboard
                        </a>

                        <a href="{{ route('bookings.create') }}" class="text-gray-300 hover:text-white font-medium">
                            Book Facility
                        </a>

                        <a href="{{ route('bookings.my') }}" class="text-gray-300 hover:text-white font-medium">
                            My Bookings
                        </a>

                        <a href="{{ route('calendar.index') }}" class="text-gray-300 hover:text-white font-medium">
                            Calendar
                        </a>

                    @endif

                </div>
            </div>

            <!-- Right -->
            <div class="flex items-center gap-4">

                <div class="text-right">
                    <div class="text-white font-semibold">
                        {{ Auth::user()->name }}
                    </div>

                    <div class="text-xs text-gray-400">
                        {{ ucfirst(Auth::user()->role) }}
                    </div>
                </div>

                <form method="POST" action="{{ route('logout') }}" id="logout-form">
                    @csrf

                    <button
                        type="submit"
                        class="px-4 py-2 bg-red-600 hover:bg-red-700 rounded-lg text-white font-semibold transition">
                        Logout
                    </button>
                </form>

            </div>

        </div>
    </div>
</nav>