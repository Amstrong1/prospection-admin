<div class="mx-auto py-6 px-4 lg:px-8 hidden lg:block">
    <nav class="relative flex w-full items-center justify-between lg:justify-center py-2 text-neutral-600 lg:flex-wrap"
        data-te-navbar-ref>
        <div class="px-2">
            <div class="flex-grow basis-[100%] items-center lg:flex lg:basis-auto text-black" id="navbarSupportedContentX"
                data-te-collapse-item>
                @if (Auth::user()->role == 'admin')
                    <ul class="mr-auto flex flex-row" data-te-navbar-nav-ref>
                        <li class="mx-2" data-te-nav-item-ref>
                            <x-nav-link
                                class="block py-2 pr-2 transition duration-150 ease-in-out hover:text-neutral-600 focus:text-neutral-600 lg:px-2"
                                :href="route('dashboard')" :active="request()->routeIs('dashboard')" data-te-ripple-init data-te-ripple-color="light">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                </svg>&nbsp;
                                {{ __('Acceuil') }}
                            </x-nav-link>
                        </li>

                        <li class="mx-2" data-te-nav-item-ref>
                            <x-nav-link
                                class="block py-2 pr-2 transition duration-150 ease-in-out hover:text-neutral-600 focus:text-neutral-600 lg:px-2"
                                :href="route('users.index')" :active="request()->routeIs('users.*')" data-te-ripple-init data-te-ripple-color="light">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                                </svg>&nbsp;
                                {{ __('Agents commerciaux') }}
                            </x-nav-link>
                        </li>

                        <li class="mx-2" data-te-nav-item-ref>
                            <x-nav-link
                                class="block py-2 pr-2 transition duration-150 ease-in-out hover:text-neutral-600 focus:text-neutral-600 lg:px-2"
                                :href="route('solutions.index')" :active="request()->routeIs('solutions.*')" data-te-ripple-init data-te-ripple-color="light">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                                </svg>
                                &nbsp;
                                {{ __('Solutions') }}
                            </x-nav-link>
                        </li>

                        <li class="mx-2" data-te-nav-item-ref>
                            <x-nav-link
                                class="block py-2 pr-2 transition duration-150 ease-in-out hover:text-neutral-600 focus:text-neutral-600 lg:px-2"
                                :href="route('suspects.index')" :active="request()->routeIs('suspects.*')" data-te-ripple-init data-te-ripple-color="light">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                                </svg>
                                &nbsp;
                                {{ __('Suspects') }}
                            </x-nav-link>
                        </li>

                        <li class="mx-2" data-te-nav-item-ref>
                            <x-nav-link
                                class="block py-2 pr-2 transition duration-150 ease-in-out hover:text-neutral-600 focus:text-neutral-600 lg:px-2"
                                :href="route('prospects.index')" :active="request()->routeIs('prospects.*')" data-te-ripple-init data-te-ripple-color="light">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                                </svg>
                                &nbsp;
                                {{ __('Prospects') }}
                            </x-nav-link>
                        </li>

                        {{-- <li class="mx-2" data-te-nav-item-ref>
                            <x-nav-link
                                class="block py-2 pr-2 transition duration-150 ease-in-out hover:text-neutral-600 focus:text-neutral-600 lg:px-2"
                                :href="route('reports.index')" :active="request()->routeIs('reports.*')" data-te-ripple-init data-te-ripple-color="light">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                </svg>
                                &nbsp;
                                {{ __('Rapports') }}
                            </x-nav-link>
                        </li> --}}

                        <li class="mx-2" data-te-nav-item-ref>
                            <x-nav-link
                                class="block py-2 pr-2 transition duration-150 ease-in-out hover:text-neutral-600 focus:text-neutral-600 lg:px-2"
                                :href="route('logs.index')" :active="request()->routeIs('logs.*')" data-te-ripple-init data-te-ripple-color="light">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                </svg>
                                &nbsp;
                                {{ __('Logs') }}
                            </x-nav-link>
                        </li>
                    </ul>
                @elseif(Auth::user()->role == 'super_admin')
                    <ul class="mr-auto flex flex-row" data-te-navbar-nav-ref>
                        <li class="mx-2" data-te-nav-item-ref>
                            <x-nav-link
                                class="block py-2 pr-2 transition duration-150 ease-in-out hover:text-neutral-600 focus:text-neutral-600 lg:px-2"
                                :href="route('dashboard')" :active="request()->routeIs('dashboard')" data-te-ripple-init data-te-ripple-color="light">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                </svg>&nbsp;
                                {{ __('Accueil') }}
                            </x-nav-link>
                        </li>

                        <li class="mx-2" data-te-nav-item-ref>
                            <x-nav-link
                                class="block py-2 pr-2 transition duration-150 ease-in-out hover:text-neutral-600 focus:text-neutral-600 lg:px-2"
                                :href="route('structures.index')" :active="request()->routeIs('structures.*')" data-te-ripple-init data-te-ripple-color="light">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                                </svg>
                                &nbsp;
                                {{ __('Entreprises') }}
                            </x-nav-link>
                        </li>
                    </ul>
                @endif
            </div>
        </div>
    </nav>
</div>
