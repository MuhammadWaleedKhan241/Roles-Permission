{{--
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Permissions</title>
    <!-- Bootstrap CSS (CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    @include('role-permission.navbar-link')
    @include('role-permission.nav-links')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                @if(session('status'))
                <div class="alert alert-success">{{session('status')}}</div>

                @endif
                <div class="card mt-3">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Permissions</h4>
                        <a href="{{ url('permissions/create') }}" class="btn btn-primary">Add Permission</a>
                    </div>
                    <div class="card-body">
                        @if($permissions->count())
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permissions as $permission)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $permission->name }}</td>
                                    <td>
                                        <a href="{{ url('permissions/'.$permission->id.'/edit') }}"
                                            class="btn btn-success btn-sm">Edit</a>
                                        <a href="{{ url('permissions/'.$permission->id.'/delete') }}"
                                            class="btn btn-danger btn-sm">Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <p>No permissions found.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<!-- Bootstrap JS (CDN) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html> --}}

<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Permissions') }}
            </h2>
            <a href="{{route('permission.create')}}"
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

                                <th class="px-6 py-3 text-left" width="">#</th>
                                <th class="px-6 py-3 text-left">Name</th>
                                <th class="px-6 py-3 text-left" width="">Created</th>
                                <th class="px-6 py-3 text-center" width="">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @forelse ($permissions as $permission)
                            <tr class="border-b">
                                <td class="px-6 py-3 text-left">{{ $permission->id }}</td>
                                <td class="px-6 py-3 text-left">{{ $permission->name }}</td>
                                <td class="px-6 py-3 text-left">{{
                                    \carbon\carbon::parse($permission->created_at)->format('d, M, Y') }}</td>
                                <td class="px-6 py-3 text-center">
                                    {{-- @can('edit permissions') --}}
                                    <a href="{{route('permission.edit',$permission->id)}}"
                                        class="bg-yellow-400 text-sm rounded-md text-white px-3 py-3 hover:bg-yellow-600">Edit</a>
                                    {{-- @endcan --}}

                                    <form action="{{ route('permission.delete', $permission->id) }}" method="POST"
                                        class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        @can('delete permissions')
                                        <button type="submit"
                                            onclick="return confirm('Are you sure you want to delete this permission?')"
                                            class="bg-red-700 text-sm rounded-md text-white px-3 py-3 hover:bg-red-600">
                                            Delete
                                        </button>
                                        @endcan
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-3 text-center">No permissions found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="my-3"> {{$permissions->links()}} </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>