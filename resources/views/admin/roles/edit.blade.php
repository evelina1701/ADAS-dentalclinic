@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Role: {{ $role->name }}</h1>

    <form action="{{ route('admin.roles.update', $role->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group mt-2">
            <label>Permissions</label><br>
            @foreach($permissions as $permission)
                <div class="form-check form-check-inline">
                    <input type="checkbox"
                           name="permissions[]"
                           value="{{ $permission->name }}"
                           id="perm_{{ $permission->id }}"
                           @if($role->hasPermissionTo($permission->name)) checked @endif
                           class="form-check-input">
                    <label for="perm_{{ $permission->id }}" class="form-check-label">
                        {{ $permission->name }}
                    </label>
                </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-success mt-3">Update Role</button>
    </form>
</div>
@endsection
