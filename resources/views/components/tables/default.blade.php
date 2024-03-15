<div class="flex flex-col items-stretch w-full overflow-hidden rounded-lg shadow-xs border">
    <div class="w-full overflow-x-auto">
        <div class="flex justify-center items-center p-4 border-b table-search-container">
            <label for="table-search" class="sr-only">Rechercher</label>
            <div class="relative">
                <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
                <input type="text" id="custom-search-input"
                    class="block p-2 pl-10 w-80 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Rechercher dans la liste">
            </div>
        </div>
        <table class="w-full whitespace-no-wrap" id="datas-table-buttons" style="width: 100% !important">
            <thead>
                <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                    @foreach ($mattributes as $column => $title)
                        <th class="px-4 py-3 text-center ">{{ $title }}</th>
                    @endforeach
                    @isset($mactions)
                        <th class="px-4 py-3 text-center">Actions</th>
                    @endisset
                </tr>
            </thead>
            <tbody class="bg-white divide-y">
                @if (count($resources) > 0)
                    @foreach ($resources as $resource)
                        <tr class="text-gray-700">
                            @foreach ($mattributes as $column => $title)
                                <td class="px-4 py-3 text-center">
                                    @if ($column == 'img' || $column == 'image' || $column == 'photo' || $column == 'logo')
                                        <a class="flex items-center justify-center text-sm hover:opacity-80">
                                            <!-- Avatar OR Image with inset shadow -->
                                            <div class="relative h-12 w-12 mr-3 md:block">
                                                <img class="object-cover w-full h-full rounded-lg"
                                                    src="{{ $resource->{$column} !== null
                                                        ? url('storage/' . $resource->{$column})
                                                        : 'https://ui-avatars.com/api/?background=random&name=' . $resource->fullname }}"
                                                    alt="" loading="lazy">
                                            </div>
                                            {{-- <div>
                                <p class="font-semibold capitalize">{{ $resource->name }}</p>
                            </div> --}}
                                        </a>
                                    @elseif ($column == 'status')
                                        <span @class([
                                            'whitespace-nowrap px-2 py-1 font-semibold leading-tight rounded-full',
                                            'text-green-700 bg-green-100  dark:bg-green-700 dark:text-green-100' =>
                                                $resource->$column == 'Acceptée',
                                            ' text-red-700 bg-red-100 dark:text-red-100 dark:bg-red-700' =>
                                                $resource->$column == 'Rejetée',
                                            ' text-gray-700 bg-yellow-100 dark:text-gray-100 dark:bg-yellow-700' =>
                                                $resource->$column == 'En attente',
                                        ])>
                                            {{ $resource->{$column} }}
                                        </span>
                                    @else
                                        @if (is_object($resource->{$column}))
                                            {{ $resource->{$column}->title ??
                                                ($resource->{$column}->name ??
                                                    ($resource->{$column}->lastname . ' ' . $resource->{$column}->firstname ??
                                                        ($resource->{$column}->nom_structure ?? $resource->{$column}->adresse))) }}
                                        @elseif (is_string($resource->{$column}) && mb_strlen($resource->{$column}) > 100)
                                            {{ Str::of($resource->{$column})->limit(100, '(...)') }}
                                        @elseif (is_array($resource->{$column}))
                                            @for ($i = 0; $i < sizeof($resource->{$column}); $i++)
                                                {{ $resource->{$column}[$i] }} <br>
                                            @endfor
                                        @else
                                            {{ $resource->$column }}
                                        @endif
                                    @endif
                                </td>
                            @endforeach
                            @isset($mactions)
                                <td class="px-4 py-3 text-center">
                                    <div class="flex items-center justify-center space-x-4 text-sm">
                                        @foreach ($mactions as $action => $title)
                                            @if ($action == 'show')
                                                <a href="{{ route(Str::plural($type) . '.show', [$type => $resource->id]) }}"
                                                    class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 rounded-lg focus:outline-none focus:shadow-outline-gray">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                        viewBox="0 0 20 20" fill="currentColor">
                                                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                                        <path fill-rule="evenodd"
                                                            d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </a>
                                            @elseif ($action == 'edit')
                                                <a href="{{ route(Str::plural($type) . '.edit', [$type => $resource->id]) }}"
                                                    class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-main rounded-lg dark:text-main focus:outline-none focus:shadow-outline-gray"
                                                    aria-label="Edit">
                                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor"
                                                        viewBox="0 0 20 20">
                                                        <path
                                                            d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                                        </path>
                                                    </svg>
                                                </a>
                                            @elseif ($action == 'delete')
                                                <form
                                                    action="{{ route(Str::plural($type) . '.destroy', [$type => $resource]) }}"
                                                    method="POST"
                                                    onsubmit="event.preventDefault(); deleteConfirmation(this)">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit"
                                                        class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-red-600 rounded-lg dark:text-red-600 focus:outline-none focus:shadow-outline-gray"
                                                        aria-label="Delete">
                                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor"
                                                            viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd"
                                                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                                clip-rule="evenodd"></path>
                                                        </svg>
                                                    </button>
                                                </form>
                                            @endif
                                        @endforeach
                                    </div>
                                </td>
                            @endisset
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="{{ count((array) $mattributes) + 1 }}"
                            class="px-6 py-4 whitespace-nowrap text-center text-gray-400"> Aucun Element </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
    {{-- <div
         class="grid px-4 py-3 text-center text-xs font-semibold tracking-wide text-gray-500 uppercase border-t bg-gray-50">
        <!-- Pagination -->
        <span class="flex mt-2 py-3 sm:mt-auto sm:justify-center">
            {{ $resources->links('components.elements.pagination.default') }}
        </span>
    </div> --}}


</div>
