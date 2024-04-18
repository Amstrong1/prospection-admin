<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex sm:flex-col md:flex-row justify-between">
                        <h1 class="font-bold text-lg my-2">
                            {{ __('Listes des prospects') }}
                        </h1>

                        <form action="" method="post">
                            @csrf
                            <div class="flex sm:flex-col items-end md:flex-row gap-2">

                                <div class="relative flex flex-wrap">
                                    <span
                                        class="flex items-center whitespace-nowrap py-[0.25rem] text-center text-base">Filtrer
                                        par date :</span> &nbsp;
                                    <input type="date" aria-label="Début" value="{{ request()->start }}"
                                        name="start"
                                        class="rounded-l relative m-0 block flex-auto border-gray-300 border-r-0 py-2" />
                                    <input type="date" aria-label="Fin" value="{{ request()->end }}" name="end"
                                        class="relative m-0 -ms-px block flex-auto border-gray-300 border-x-0 py-2" />
                                    <button type="submit"
                                        class="z-[2] inline-block border rounded-r border-gray-300 px-2 text-xs"
                                        data-twe-ripple-init type="button" id="button-addon2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m4.5 12.75 6 6 9-13.5" />
                                        </svg>
                                    </button>
                                </div>

                                <select class="border-gray-300 rounded" name="user_id" onchange="this.form.submit()">
                                    <option value="">Tous les agents</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}" @selected($user->id == request()->user_id)>
                                            {{ $user->lastname . ' ' . $user->firstname }}
                                        </option>
                                    @endforeach
                                </select>

                                <select class="border-gray-300 rounded" name="suspect_response" onchange="this.form.submit()">
                                    <option value="">Toutes les réponses</option>
                                    <option value="Oui" @selected('Oui' == request()->suspect_response)>Oui</option>
                                    <option value="Non" @selected('Non' == request()->suspect_response)>Non</option>
                                    <option value="Indécis" @selected('Indécis' == request()->suspect_response)>Indécis</option>
                                </select>
                            </div>
                        </form>
                    </div>

                    <div class="mt-4">
                        {{ 'Nombre de prospects : ' . $prospects->count() }}
                        <x-tables.default :resources="$prospects" :mattributes="$my_attributes" type="prospect" :mactions="$my_actions" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
