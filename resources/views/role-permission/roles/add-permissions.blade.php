<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Permission</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Laravel Vite (optional for additional resources) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Success Alert -->
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <!-- Validation Errors -->
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
                        <h4>Role : {{ $role->name}}</h4>
                        <a href="{{ url('roles') }}" class="btn btn-danger">Back</a>
                    </div>
                    <div class="card-body">
                        <!-- Form for Editing Permission -->
                        {{-- <form action="{{ url('roles/'.$role->id.'/give-permissions', $role->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="role_name" class="form-label">Permissions</label>
                                <div class="row">
                                    @foreach ($permissions as $permission)
                                    <div class="col-md-3">
                                        <label>
                                            <input type="checkbox" name="permission[]" id="role_name"
                                                value="{{$permission->name}}" {{in_array($permission->id,
                                            $rolePermissions) ?'checked':''}}

                                            placeholder="Enter role name" required
                                            @error('name') <span class="text-danger">{{ $message }}</span>
                                            @enderror>
                                            {{$permission->name}}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Update Permission</button>
                            </div>
                        </form> --}}
                        <form action="{{ url('roles/'.$role->id.'/give-permission') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="role_name" class="form-label">Permissions</label>
                                <div class="row">
                                    @foreach ($permissions as $permission)
                                    <div class="col-md-3">
                                        <label>
                                            <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                                                {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}>
                                            {{ $permission->name }}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Update Permissions</button>
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

</html>