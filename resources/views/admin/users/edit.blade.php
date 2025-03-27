@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit User</h1>
    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
         <div class="form-group mt-2">
             <label for="name">Name</label>
             <input type="text" name="name" value="{{ $user->name }}" class="form-control" required>
         </div>
         <div class="form-group mt-2">
             <label for="surname">Surname</label>
             <input type="text" name="surname" value="{{ $user->surname }}" class="form-control" required>
         </div>
         <div class="form-group mt-2">
             <label for="email">Email</label>
             <input type="email" name="email" value="{{ $user->email }}" class="form-control" required>
         </div>
         <div class="form-group mt-2">
             <label for="role">Role</label>
             <select name="role" class="form-control" required>
                @foreach($roles as $role)
                    <option value="{{ $role }}" 
                        {{ $user->roles->first() && $user->roles->first()->name === $role ? 'selected' : '' }}>
                        {{ ucfirst($role) }}
                    </option>
                @endforeach
            </select>
         </div>
         <div class="form-group mt-2">
             <label for="password">Password (leave blank if not changing)</label>
             <input type="password" name="password" class="form-control">
         </div>
         <div class="form-group mt-2">
             <label for="password_confirmation">Confirm Password</label>
             <input type="password" name="password_confirmation" class="form-control">
         </div>
         <button type="submit" class="btn btn-primary mt-3">Update</button>
    </form>
</div>
@endsection
