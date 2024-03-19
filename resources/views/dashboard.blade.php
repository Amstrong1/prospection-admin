<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="md:flex justify-between">
                        <h1 class="font-semibold text-lg my-4 mx-2">
                            Tableau de bord
                        </h1>
                    </div>

                    <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
                        <!-- Card -->
                        <div class="flex p-4 bg-slate-50 rounded-lg shadow-xs">
                            <div class="w-10 h-10 p-2 mr-4 text-blue-500 bg-blue-100 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                                </svg>
                            </div>
                            <div>
                                <p class="mb-2 text-sm font-medium text-gray-600">
                                    {{ __('Agents commerciaux') }} : {{ $users }}
                                </p>
                                <p class="mb-2 text-lg font-semibold text-gray-700">
                                </p>
                                <hr>
                                <p class="mt-2 text-sm font-medium text-gray-600">
                                    <a href="{{ route('users.index') }}">{{ __('Voir plus') }}</a>
                                </p>
                            </div>
                        </div>

                        <div class="flex p-4 bg-slate-50 rounded-lg shadow-xs">
                            <div class="w-10 h-10 p-2 mr-4 text-blue-500 bg-blue-100 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                                </svg>
                            </div>
                            <div>
                                <p class="mb-2 text-sm font-medium text-gray-600">
                                    {{ __('Suspects') }} : {{ $suspects }}
                                </p>
                                <p class="mb-2 text-lg font-semibold text-gray-700">
                                </p>
                                <hr>
                                <p class="mt-2 text-sm font-medium text-gray-600">
                                    <a href="{{ route('suspects.index') }}">{{ __('Voir plus') }}</a>
                                </p>
                            </div>
                        </div>

                        <div class="flex p-4 bg-slate-50 rounded-lg shadow-xs">
                            <div class="w-10 h-10 p-2 mr-4 text-blue-500 bg-blue-100 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                                </svg>
                            </div>
                            <div>
                                <p class="mb-2 text-sm font-medium text-gray-600">
                                    {{ __('Prospects') }} : {{ $prospects }}
                                </p>
                                <p class="mb-2 text-lg font-semibold text-gray-700">
                                </p>
                                <hr>
                                <p class="mt-2 text-sm font-medium text-gray-600">
                                    <a href="{{ route('prospects.index') }}">{{ __('Voir plus') }}</a>
                                </p>
                            </div>
                        </div>

                        <div class="flex p-4 bg-slate-50 rounded-lg shadow-xs">
                            <div class="w-10 h-10 p-2 mr-4 text-blue-500 bg-blue-100 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                </svg>
                            </div>
                            <div>
                                <p class="mb-2 text-sm font-medium text-gray-600">
                                    {{ __('Rapports') }} : {{ $reports }}
                                </p>
                                <p class="mb-2 text-lg font-semibold text-gray-700">
                                </p>
                                <hr>
                                <p class="mt-2 text-sm font-medium text-gray-600">
                                    <a href="{{ route('reports.index') }}">{{ __('Voir plus') }}</a>
                                </p>
                            </div>
                        </div>

                        <div class="flex p-4 bg-slate-50 rounded-lg shadow-xs">
                            <div class="w-10 h-10 p-2 mr-4 text-blue-500 bg-blue-100 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                                </svg>
                            </div>
                            <div>
                                <p class="mb-2 text-sm font-medium text-gray-600">
                                    {{ __('Solutions') }} : {{ $solutions }}
                                </p>
                                <p class="mb-2 text-lg font-semibold text-gray-700">
                                </p>
                                <hr>
                                <p class="mt-2 text-sm font-medium text-gray-600">
                                    <a href="{{ route('solutions.index') }}">{{ __('Voir plus') }}</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
