@extends('layouts.admin')
@section('title', 'Ihram Guides')
@section('page_title', 'Ihram Guides')

@section('content')

<div class="flex justify-end mb-6">
    <a href="{{ route('admin.ihram-guides.create') }}" class="btn-primary text-sm">+ Add New Guide</a>
</div>

<div class="card-premium overflow-hidden">
    <table class="table-premium">
        <thead>
            <tr>
                <th>Guide</th>
                <th>Category</th>
                <th>Urdu Title</th>
                <th>Order</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($guides as $guide)
                <tr>
                    <td>
                        <div class="flex items-center gap-3">
                            <span class="text-2xl">{{ $guide->icon }}</span>
                            <p class="text-white font-medium text-sm">{{ Str::limit($guide->title_en, 35) }}</p>
                        </div>
                    </td>
                    <td>
                        <span class="badge border {{ $guide->category_color }} text-xs">
                            {{ $guide->category_label }}
                        </span>
                    </td>
                    <td class="urdu text-dark-400 text-sm">{{ Str::limit($guide->title_ur, 25) ?? '—' }}</td>
                    <td class="text-dark-400 text-sm">{{ $guide->sort_order }}</td>
                    <td>
                        @if($guide->is_active)
                            <span class="badge-green text-xs">Active</span>
                        @else
                            <span class="badge-red text-xs">Inactive</span>
                        @endif
                    </td>
                    <td>
                        <div class="flex gap-2">
                            <a href="{{ route('admin.ihram-guides.edit', $guide) }}"
                               class="p-1.5 rounded-lg bg-dark-700 hover:bg-primary-500/20 text-dark-400 hover:text-primary-400 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </a>
                            <form action="{{ route('admin.ihram-guides.destroy', $guide) }}" method="POST"
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
    <div class="p-5 border-t border-dark-800">{{ $guides->links() }}</div>
</div>

@endsection