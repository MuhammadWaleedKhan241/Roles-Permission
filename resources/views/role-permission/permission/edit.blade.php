<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Permission / Edit
            </h2>
            <a href="{{ route('permission.index') }}"
                class="bg-slate-700 text-sm rounded-md text-white px-3 py-2">Back</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- Add CSRF token for form protection --}}
                    <form action="{{ route('permission.update', $permission->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div>
                            <label for="name" class="text-lg font-medium">Name</label>
                            <div class="my-3">
                                <input placeholder="Enter Name" name="name" type="text" id="name"
                                    value="{{ old('name', $permission->name) }}"
                                    class="border-gray-300 shadow-sm w-1/2 rounded-lg @error('name') border-red-500 @enderror">
                                {{-- Validation error message for the name field --}}
                                @error('name')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit"
                                class="bg-slate-700 text-sm rounded-md text-white px-5 py-3">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>