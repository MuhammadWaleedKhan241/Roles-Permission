<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Users') }}
            </h2>
            <a href="{{ route('users.create') }}"
                class="bg-slate-700 text-sm rounded-md text-white px-3 py-3">Create</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-message></x-message>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="min-w-full">
                        <thead class="bg-gray-50">
                            <tr class="border-b">
                                <th class="px-6 py-3 text-left" width="60">#</th>
                                <th class="px-6 py-3 text-left">Name</th>
                                <th class="px-6 py-3 text-left">Email</th>
                                <th class="px-6 py-3 text-left">Role</th>
                                <th class="px-6 py-3 text-left" width="">Created</th>
                                <th class="px-6 py-3 text-center" width="">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @forelse ($users as $user)
                            <tr class="border-b">
                                <td class="px-6 py-3 text-left">{{ $user->id }}</td>
                                <td class="px-6 py-3 text-left">{{ $user->name }}</td>
                                <td class="px-6 py-3 text-left">{{ $user->email }}</td>
                                <td class="px-6 py-3 text-left">{{ $user->roles->pluck('name')->implode(', ') }}</td>
                                <td class="px-6 py-3 text-left">{{ \Carbon\Carbon::parse($user->created_at)->format('d,
                                    M, Y') }}</td>
                                <td class="px-6 py-3 text-center">
                                    @can('edit users')
                                    <a href="{{ route('users.edit', $user->id) }}"
                                        class="bg-yellow-400 text-sm rounded-md text-white px-3 py-3 hover:bg-yellow-600">Edit</a>
                                    @endcan

                                    @can('delete users')
                                    <form action="{{ route('users.delete', $user->id) }}" method="POST"
                                        class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            onclick="return confirm('Are you sure you want to delete this User?')"
                                            class="bg-red-700 text-sm rounded-md text-white px-3 py-3 hover:bg-red-600">
                                            Delete
                                        </button>
                                    </form>
                                    @endcan
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-3 text-center">No User found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="my-3">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>