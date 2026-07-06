@extends('layouts.admin')
@section('title', 'Edit User')
@section('page_title', 'Edit User')

@section('content')
<div class="max-w-2xl">
    <div class="card-premium p-8">
        <form action="{{ route('admin.users.update', $user) }}" method="POST">
            @csrf @method('PUT')

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mb-6">
                <div>
                    <label class="input-label">Full Name</label>
                    <input type="text" name="name" class="input-field @error('name') border-red-500 @enderror"
                           value="{{ old('name', $user->name) }}">
                    @error('name') <p class="input-error">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="input-label">Email</label>
                    <input type="email" name="email" class="input-field @error('email') border-red-500 @enderror"
                           value="{{ old('email', $user->email) }}">
                    @error('email') <p class="input-error">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="input-label">Role</label>
                    <select name="role_id" class="select-field">
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>
                                {{ $role->label }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="input-label">Phone</label>
                    <input type="text" name="phone" class="input-field"
                           value="{{ old('phone', $user->phone) }}">
                </div>
                <div>
                    <label class="input-label">Country</label>
                    <input type="text" name="country" class="input-field"
                           value="{{ old('country', $user->country) }}">
                </div>
                <div>
                    <label class="input-label">City</label>
                    <input type="text" name="city" class="input-field"
                           value="{{ old('city', $user->city) }}">
                </div>
                <div class="sm:col-span-2">
                    <label class="input-label">New Password <span class="text-dark-500">(leave blank to keep same)</span></label>
                    <input type="password" name="password" class="input-field" placeholder="••••••••">
                </div>
            </div>

            <div class="flex gap-3">
                <button type="submit" class="btn-primary">Save Changes</button>
                <a href="{{ route('admin.users.index') }}" class="btn-outline">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection