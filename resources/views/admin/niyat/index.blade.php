@extends('layouts.admin')
@section('title', 'Manage Niyat')
@section('page_title', 'Niyat Management')

@section('content')

<div class="flex justify-end mb-6">
    <a href="{{ route('admin.niyat.create') }}" class="btn-primary text-sm">+ Add New Niyat</a>
</div>

<div class="card-premium overflow-hidden">
    <table class="table-premium">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Type</th>
                <th>Arabic Preview</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($niyats as $niyat)
                <tr>
                    <td class="text-dark-500 text-xs">{{ $niyat->id }}</td>
                    <td class="text-white font-medium">{{ Str::limit($niyat->title_en, 40) }}</td>
                    <td>
                        <span class="badge-green text-xs capitalize">{{ $niyat->type }}</span>
                    </td>
                    <td class="arabic text-gold-400 text-sm">{{ Str::limit($niyat->arabic_text, 30) }}</td>
                    <td>
                        @if($niyat->is_active)
                            <span class="badge-green text-xs">Active</span>
                        @else
                            <span class="badge-red text-xs">Inactive</span>
                        @endif
                    </td>
                    <td>
                        <div class="flex gap-2">
                            <a href="{{ route('admin.niyat.edit', $niyat) }}"
                               class="p-1.5 rounded-lg bg-dark-700 hover:bg-primary-500/20 text-dark-400 hover:text-primary-400 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </a>
                            <form action="{{ route('admin.niyat.destroy', $niyat) }}" method="POST"
                                  onsubmit="return confirm('Delete this niyat?')">
                                @csrf @method('DELETE')
                                <button type="submit"
                                        class="p-1.5 rounded-lg bg-dark-700 hover:bg-red-500/20 text-dark-400 hover:text-red-400 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center py-10 text-dark-500">
                        Koi niyat nahi mili.
                        <a href="{{ route('admin.niyat.create') }}" class="text-primary-400 hover:underline ml-1">Add first niyat →</a>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="p-5 border-t border-dark-800">{{ $niyats->links() }}</div>
</div>

@endsection