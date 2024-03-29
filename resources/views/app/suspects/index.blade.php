<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between">
                        <h1 class="font-bold text-lg my-2">
                            {{ __('Listes des suspects') }}
                        </h1>

                        <form action="" method="post">
                            @csrf
                            <input type="hidden" name="suspect_response"
                                value="{{ request()->suspect_response ?? 'all' }}">
                            <select class="rounded border-gray-300" name="user_id" id=""
                                onchange="this.form.submit()">
                                <option value="all">Tous les agents</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" @selected($user->id == request()->user_id)>
                                        {{ $user->lastname . ' ' . $user->firstname }}
                                    </option>
                                @endforeach
                            </select>
                        </form>
                    </div>
                </div>

                <div class="mt-4">
                    <x-tables.default :resources="$suspects" :mattributes="$my_attributes" type="suspect" :mactions="$my_actions" />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
