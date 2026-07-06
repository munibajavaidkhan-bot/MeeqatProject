@extends('layouts.admin')
@section('title', 'Categories')
@section('page_title', 'Dua Categories')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- Add Form --}}
    <div class="card-premium p-6">
        <h3 class="text-white font-bold mb-5">Add New Category</h3>
        <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="input-label">Name (English) *</label>
                <input type="text" name="name_en" class="input-field" placeholder="e.g. Tawaf" value="{{ old('name_en') }}">
            </div>
            <div>
                <label class="input-label">Name (Arabic)</label>
                <input type="text" name="name_ar" class="input-field arabic text-right" dir="rtl" placeholder="طواف" value="{{ old('name_ar') }}">
            </div>
            <div>
                <label class="input-label">Icon (Emoji)</label>
                <input type="text" name="icon" class="input-field" placeholder="🕋" value="{{ old('icon') }}">
            </div>
            <button type="submit" class="btn-primary w-full">Add Category</button>
        </form>
    </div>

    {{-- Categories List --}}
    <div class="lg:col-span-2 card-premium overflow-hidden">
        <div class="p-5 border-b border-dark-800">
            <h3 class="text-white font-bold">All Categories ({{ $categories->count() }})</h3>
        </div>
        <table class="table-premium">
            <thead>
                <tr>
                    <th>Category</th>
                    <th>Arabic</th>
                    <th>Duas</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $cat)
                    <tr>
                        <td>
                            <span class="text-xl mr-2">{{ $cat->icon }}</span>
                            <span class="text-white font-medium">{{ $cat->name_en }}</span>
                        </td>
                        <td class="arabic text-gold-400">{{ $cat->name_ar }}</td>
                        <td><span class="badge-green text-xs">{{ $cat->duas_count }}</span></td>
                        <td>
                            <form action="{{ route('admin.categories.destroy', $cat) }}" method="POST"
                                  onsubmit="return confirm('Delete category?')">
                                @csrf @method('DELETE')
                                <button type="submit"
                                        class="p-1.5 rounded-lg bg-dark-700 hover:bg-red-500/20 text-dark-400 hover:text-red-400 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection