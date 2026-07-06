@extends('layouts.admin')
@section('title', 'Manage Users')
@section('page_title', 'Users Management')
@section('page_subtitle', 'Manage all registered users')

@section('content')

{{-- Filters --}}
<div class="card-premium p-5 mb-6">
    <form action="{{ route('admin.users.index') }}" method="GET" class="flex flex-wrap gap-3">
        <input type="text" name="search" placeholder="Search name or email..." class="input-field flex-1 min-w-48" value="{{ request('search') }}">
        <select name="role" class="select-field w-40">
            <option value="">All Roles</option>
            @foreach($roles as $role)
                <option value="{{ $role->id }}" {{ request('role') == $role->id ? 'selected' : '' }}>{{ $role->label }}</option>
            @endforeach
        </select>
        <select name="status" class="select-field w-36">
            <option value="">All Status</option>
            <option value="active"   {{ request('status') === 'active'   ? 'selected' : '' }}>Active</option>
            <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
        </select>
        <button type="submit" class="btn-primary py-2.5 px-5 text-sm">Search</button>
        <a href="{{ route('admin.users.index') }}" class="btn-outline py-2.5 px-5 text-sm">Clear</a>
    </form>
</div>

{{-- Table --}}
<div class="card-premium overflow-hidden">
    <div class="p-5 border-b border-dark-800 flex items-center justify-between">
        <h3 class="text-white font-bold">All Users ({{ $users->total() }})</h3>
    </div>
    <div class="overflow-x-auto">
        <table class="table-premium">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Role</th>
                    <th>Country</th>
                    <th>Status</th>
                    <th>Joined</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-primary-500 to-primary-700 flex items-center justify-center text-white text-sm font-bold">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <div>
                                    <p class="text-white font-medium text-sm">{{ $user->name }}</p>
                                    <p class="text-dark-500 text-xs">{{ $user->email }}</p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="{{ $user->role_id === 1 ? 'badge-gold' : ($user->role_id === 2 ? 'badge-blue' : 'badge-green') }} text-xs">
                                {{ $user->role?->label }}
                            </span>
                        </td>
                        <td class="text-dark-400 text-sm">{{ $user->country ?? '—' }}</td>
                        <td>
                            <form action="{{ route('admin.users.toggle', $user) }}" method="POST">
                                @csrf @method('PATCH')
                                <button type="submit" class="{{ $user->is_active ? 'badge-green' : 'badge-red' }} text-xs cursor-pointer hover:opacity-80 transition-opacity">
                                    {{ $user->is_active ? 'Active' : 'Inactive' }}
                                </button>
                            </form>
                        </td>
                        <td class="text-dark-500 text-xs">{{ $user->created_at->format('M d, Y') }}</td>
                        <td>
                            <div class="flex items-center gap-2">
                                <a href="{{ route('admin.users.edit', $user) }}"
                                   class="p-1.5 rounded-lg bg-dark-700 hover:bg-primary-500/20 text-dark-400 hover:text-primary-400 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </a>
                                @if($user->id !== auth()->id())
                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                                          onsubmit="return confirm('Delete this user?')">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                                class="p-1.5 rounded-lg bg-dark-700 hover:bg-red-500/20 text-dark-400 hover:text-red-400 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="p-5 border-t border-dark-800">
        {{ $users->withQueryString()->links() }}
    </div>
</div>

@endsection