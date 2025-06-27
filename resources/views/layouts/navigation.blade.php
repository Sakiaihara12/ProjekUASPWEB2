@php
    $user = Auth::guard('web')->user();
    $admin = Auth::guard('admin')->user();
@endphp

<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    @if ($admin)
                        <a href="{{ route('admin.dashboard') }}">
                            <svg width="30" height="30" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M13.6668 0.333374H9.22236V4.77784H4.77796V9.22224H0.333496V13.6667H13.6668V0.333374Z" fill="#1C0D0F"/>
                            </svg>
                        </a>
                    @else
                        <a href="{{ route('dashboard') }}">
                            <svg width="30" height="30" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M13.6668 0.333374H9.22236V4.77784H4.77796V9.22224H0.333496V13.6667H13.6668V0.333374Z" fill="#1C0D0F"/>
                            </svg>
                        </a>
                    @endif
                </div>

                <!-- Navigation Links -->
                @if ($admin)
                    {{-- ✅ NAVBAR UNTUK ADMIN --}}
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link href="{{ route('admin.dashboard') }}" :active="request()->routeIs('admin.dashboard')">
                            Dashboard
                        </x-nav-link>
                        <x-nav-link href="{{ route('admin.menus.index') }}" :active="request()->routeIs('admin.menus.*')">
                            Menu
                        </x-nav-link>
                        <x-nav-link href="{{ route('admin.orders.index') }}" :active="request()->routeIs('admin.orders.*')">
                            Pesanan Masuk
                        </x-nav-link>
                        <x-nav-link href="{{ route('admin.ratings.index') }}" :active="request()->routeIs('admin.ratings.*')">
    Rating
</x-nav-link>

                    </div>
                @elseif ($user)
                    {{-- ✅ NAVBAR UNTUK USER --}}
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                            Dashboard
                        </x-nav-link>
                        <x-nav-link href="{{ route('cart.index') }}" :active="request()->routeIs('cart.index')">
                            🛒 Keranjang
                        </x-nav-link>
                                <x-nav-link href="{{ route('orders.history') }}" :active="request()->routeIs('orders.history')">
            📜 Riwayat Pesanan
        </x-nav-link>
                    </div>
                @endif
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @if ($admin || $user)
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ $admin?->name ?? $user->name }}</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            @if ($user)
                                <x-dropdown-link href="{{ route('profile.edit') }}">
                                    {{ __('Profile') }}
                                </x-dropdown-link>
                            @endif

                            <!-- Logout -->
                            <form method="POST" action="{{ $admin ? route('admin.logout') : route('logout') }}">
                                @csrf
                                <x-dropdown-link href="{{ $admin ? route('admin.logout') : route('logout') }}"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @endif
            </div>
        </div>
    </div>
</nav>
