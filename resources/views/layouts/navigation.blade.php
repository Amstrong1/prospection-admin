<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        {{-- <x-application-logo class="block w-6 fill-current text-gray-800" /> --}}
                        <img src="{{ asset('img/vibecro1.png') }}" class="h-12" alt="vibecro" srcset="">
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{-- {{ __('Prospection App') }} --}}
                        {{ auth()->user()->structure->name }}
                    </x-nav-link>
                </div>
            </div>

            <div class="flex items-center flex-shrink-0 space-x-2">

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center justify-center mx-2 p-2 rounded-md text-black">
                            <div>
                                <a class="hidden-arrow mr-4 flex items-center text-black transition duration-200 hover:ease-in-out disabled:text-black/30 motion-reduce:transition-none"
                                    href="#" id="dropdownMenuButton1" role="button" data-te-dropdown-toggle-ref
                                    aria-expanded="false">
                                    <!-- Dropdown trigger icon -->
                                    <span class="[&>svg]:w-6">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                                        </svg>
                                    </span>
                                    <!-- Notification counter -->
                                    <span
                                        class="absolute -mt-6 ml-4 rounded-full bg-danger px-1 py-[0.15rem] text-xs font-bold leading-none text-black">
                                        {{ Auth::user()->unreadNotifications->count() }}
                                    </span>
                                </a>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        @if (Auth::user()->unreadNotifications->count() !== 0)
                            <form action="" method="post">
                                @csrf
                                <div class="flex p-4 justify-end">
                                    <button type="submit" class="border-0">
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="red"
                                                class="w-4 h-4">
                                                <path fill-rule="evenodd"
                                                    d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </span>
                                    </button>
                                </div>
                            </form>
                        @endif

                        @forelse (Auth::user()->unreadNotifications as $notification)
                            <x-dropdown-link href="{{ route($notification->data['link']) }}">
                                <div class="flex">
                                    <div>
                                        <p class="text-sm">
                                            {{ $notification->data['message'] }}
                                        </p>

                                        <p class="text-xs">{{ getFormattedDate($notification->created_at) }}</p>
                                    </div>
                                </div>
                            </x-dropdown-link>
                        @empty
                            <p class="text-sm p-4 text-black">
                                Aucune notification
                            </p>
                        @endforelse
                    </x-slot>
                </x-dropdown>

                <!-- Settings Dropdown -->
                <div class="sm:flex sm:items-center sm:ms-6">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-black bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div class="hidden md:block">
                                    {{ Auth::user()->lastname . ' ' . Auth::user()->firstname }}</div>

                                <div class="ms-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profil') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Déconnexion') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>
        </div>
    </div>
</nav>
