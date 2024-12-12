{{--
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Role</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Laravel Vite (optional for additional resources) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <!-- Display success message -->
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <!-- Display validation errors -->
                @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4>Create Role</h4>
                        <a href="{{ url('roles') }}" class="btn btn-danger">Back</a>
                    </div>
                    <div class="card-body">
                        <!-- Form for Creating Role -->
                        <form action="{{ url('roles') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="role_name" class="form-label">Role Name</label>
                                <input type="text" name="name" id="role_name" class="form-control"
                                    placeholder="Enter role name" value="{{ old('name') }}" required>
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Create Role</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html> --}}


<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Roles / Create
            </h2>
            <a href="{{route('role.index')}}" class="bg-slate-700 text-sm rounded-md text-white px-3 py-2">Back</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- Add CSRF token for form protection --}}
                    <form action="{{ route('role.store') }}" method="POST">
                        @csrf
                        <div>
                            <label for="name" class="text-lg font-medium">Name</label>
                            <div class="my-3">
                                <input placeholder="Enter Name" name="name" type="text" id="name"
                                    value="{{old('name')}}"
                                    class="border-gray-300 shadow-sm w-1/2 rounded-lg @error('name') border-red-500 @enderror">
                                {{-- Validation error message for the name field --}}
                                @error('name')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="grid grid-cols-4 mb-3">
                                @if($permissions->isNotEmpty())
                                @foreach ($permissions as $permission)
                                <div class="mt-3">
                                    <input type="checkbox" id="permission-{{$permission->id}}" class="rounded"
                                        name="permission[]" value="{{$permission->name}}">
                                    <label for="permission-{{$permission->id}}">{{$permission->name}}</label>
                                </div>
                                @endforeach
                                @endif
                            </div>
                            <button type="submit"
                                class="bg-slate-700 text-sm rounded-md text-white px-5 py-3">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>