@extends('layouts.admin')
@section('title', 'Meeqat Locations')
@section('page_title', 'Meeqat Locations')

@section('content')

<div class="flex justify-end mb-6">
    <a href="{{ route('admin.meeqat-locations.create') }}" class="btn-primary text-sm">+ Add Location</a>
</div>

<div class="card-premium overflow-hidden">
    <table class="table-premium">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Arabic</th>
                <th>Coordinates</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($locations as $loc)
                <tr>
                    <td class="text-dark-500">{{ $loc->sort_order }}</td>
                    <td>
                        <div class="flex items-center gap-2">
                            <span class="text-xl">{{ $loc->icon }}</span>
                            <span class="text-white font-medium text-sm">{{ $loc->name_en }}</span>
                        </div>
                    </td>
                    <td class="arabic text-gold-400">{{ $loc->name_ar }}</td>
                    <td class="font-mono text-dark-400 text-xs">
                        {{ $loc->latitude }}, {{ $loc->longitude }}
                    </td>
                    <td>
                        @if($loc->is_active)
                            <span class="badge-green text-xs">Active</span>
                        @else
                            <span class="badge-red text-xs">Inactive</span>
                        @endif
                    </td>
                    <td>
                        <div class="flex gap-2">
                            <a href="{{ route('admin.meeqat-locations.edit', $loc) }}"
                               class="p-1.5 rounded-lg bg-dark-700 hover:bg-primary-500/20 text-dark-400 hover:text-primary-400 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </a>
                            <form action="{{ route('admin.meeqat-locations.destroy', $loc) }}" method="POST"
                                  onsubmit="return confirm('Delete?')">
                                @csrf @method('DELETE')
                                <button type="submit"
                                        class="p-1.5 rounded-lg bg-dark-700 hover:bg-red-500/20 text-dark-400 hover:text-red-400 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection