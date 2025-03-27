@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Roles</h1>
    @if(session('success'))
      <div class="alert alert-success mt-3">{{ session('success') }}</div>
    @endif
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Name</th>
                <th>Permissions</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($roles as $role)
           <tr>
             <td>{{ $role->name }}</td>
             <td>
                @foreach($role->permissions as $perm)
                    <span class="badge bg-secondary">{{ $perm->name }}</span>
                @endforeach
             </td>
             <td>
                <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-sm btn-warning">
                    Edit
                </a>
             </td>
           </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
