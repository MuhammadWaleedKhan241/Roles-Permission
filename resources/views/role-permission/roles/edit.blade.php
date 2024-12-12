<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Role: {{ $role->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('role.update', $role->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <!-- This is necessary for PUT or PATCH requests -->

                        <div class="mb-4">
                            <label for="name" class="block text-lg font-medium">Role Name</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $role->name) }}"
                                class="w-full border-gray-300 rounded-lg @error('name') border-red-500 @enderror">
                            @error('name')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-lg font-medium">Assign Permissions</label>
                            @foreach ($permissions as $permission)
                            <div class="flex items-center mb-2">
                                <input {{($hasPermission->contains($permission->name))? 'checked' : ''}} type="checkbox"
                                name="permissions[]" value="{{ $permission->id }}"
                                class="mr-2">
                                <span>{{ $permission->name }}</span>
                            </div>
                            @endforeach

                            {{-- @foreach ($permissions as $permission)
                            <div class="flex items-center mb-2">
                                <input {{ $hasPermission->contains($permission->name) ? 'checked' : '' }}
                                type="checkbox"
                                name="permissions[]"
                                value="{{ $permission->id }}"
                                class="mr-2">
                                <span>{{ $permission->name }}</span>
                            </div>
                            @endforeach --}}
                        </div>

                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md">Update Role</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>