<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            User Create
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="block text-lg font-medium">Name</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}"
                                class="w-full border-gray-300 rounded-lg @error('name') border-red-500 @enderror">
                            @error('name')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="email" class="block text-lg font-medium">Email</label>
                            <input type="text" id="email" name="email" value="{{ old('email') }}"
                                class="w-full border-gray-300 rounded-lg @error('email') border-red-500 @enderror">
                            @error('email')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password" class="block text-lg font-medium">Password</label>
                            <input type="password" id="password" name="password" value="{{ old('password') }}"
                                class="w-full border-gray-300 rounded-lg @error('password') border-red-500 @enderror">
                            @error('password')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="confirm_password" class="block text-lg font-medium">Confirm Password</label>
                            <input type="password" id="confirm_password" name="confirm_password"
                                value="{{ old('confirm_password') }}"
                                class="w-full border-gray-300 rounded-lg @error('confirm_password') border-red-500 @enderror">
                            @error('confirm_password')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-lg font-medium">Assign Permissions</label>
                            @foreach ($roles as $role)
                            <div class="flex items-center mb-2">
                                <input type="checkbox" id="role-{{$role->id}}" name="role[]" value="{{ $role->name }}"
                                    class="mr-2">
                                <label for="role-{{$role->id}}">{{$role->name}}</label>
                            </div>
                            @endforeach
                        </div>

                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>