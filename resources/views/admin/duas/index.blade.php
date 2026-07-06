@extends('layouts.admin')
@section('title', 'Manage Duas')
@section('page_title', 'Duas Library')

@section('content')

<div class="flex justify-between items-center mb-6">
    <div class="flex gap-3">
        <form action="{{ route('admin.duas.index') }}" method="GET" class="flex gap-3">
            <input type="text" name="search" placeholder="Search duas..." class="input-field w-64" value="{{ request('search') }}">
            <select name="category" class="select-field w-40">
                <option value="">All Categories</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name_en }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn-primary text-sm py-2.5 px-4">Filter</button>
        </form>
    </div>
    <a href="{{ route('admin.duas.create') }}" class="btn-primary text-sm">
        + Add New Dua
    </a>
</div>

<div class="card-premium overflow-hidden">
    <table class="table-premium">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Category</th>
                <th>Arabic Preview</th>
                <th>Featured</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($duas as $dua)
                <tr>
                    <td class="text-dark-500 text-xs">{{ $dua->id }}</td>
                    <td class="text-white font-medium max-w-xs">{{ Str::limit($dua->title_en, 40) }}</td>
                    <td><span class="badge-green text-xs">{{ $dua->category->name_en }}</span></td>
                    <td class="arabic text-gold-400 text-sm max-w-xs">{{ Str::limit($dua->arabic_text, 30) }}</td>
                    <td>
                        @if($dua->is_featured)
                            <span class="badge-gold text-xs">⭐ Yes</span>
                        @else
                            <span class="text-dark-600 text-xs">—</span>
                        @endif
                    </td>
                    <td>
                        <div class="flex gap-2">
                            <a href="{{ route('admin.duas.edit', $dua) }}"
                               class="p-1.5 rounded-lg bg-dark-700 hover:bg-primary-500/20 text-dark-400 hover:text-primary-400 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </a>
                            <form action="{{ route('admin.duas.destroy', $dua) }}" method="POST"
                                  onsubmit="return confirm('Delete this dua?')">
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
    <div class="p-5 border-t border-dark-800">{{ $duas->links() }}</div>
</div>

@endsection