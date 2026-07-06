@extends('layouts.admin')
@section('title', isset($meeqatLocation) ? 'Edit Location' : 'Add Location')
@section('page_title', isset($meeqatLocation) ? 'Edit Meeqat Location' : 'Add Meeqat Location')

@section('content')
<div class="max-w-2xl">
    <div class="card-premium p-8">
        <form action="{{ isset($meeqatLocation) ? route('admin.meeqat-locations.update', $meeqatLocation) : route('admin.meeqat-locations.store') }}"
              method="POST">
            @csrf
            @if(isset($meeqatLocation)) @method('PUT') @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mb-5">
                <div>
                    <label class="input-label">Name (English) *</label>
                    <input type="text" name="name_en" class="input-field"
                           value="{{ old('name_en', $meeqatLocation->name_en ?? '') }}">
                </div>
                <div>
                    <label class="input-label">Name (Arabic) *</label>
                    <input type="text" name="name_ar" class="input-field arabic text-right" dir="rtl"
                           value="{{ old('name_ar', $meeqatLocation->name_ar ?? '') }}">
                </div>
                <div>
                    <label class="input-label">Name (Urdu)</label>
                    <input type="text" name="name_ur" class="input-field"
                           value="{{ old('name_ur', $meeqatLocation->name_ur ?? '') }}">
                </div>
                <div>
                    <label class="input-label">Icon (Emoji)</label>
                    <input type="text" name="icon" class="input-field"
                           value="{{ old('icon', $meeqatLocation->icon ?? '📍') }}">
                </div>
                <div>
                    <label class="input-label">Latitude *</label>
                    <input type="number" name="latitude" step="0.00000001" class="input-field"
                           value="{{ old('latitude', $meeqatLocation->latitude ?? '') }}">
                </div>
                <div>
                    <label class="input-label">Longitude *</label>
                    <input type="number" name="longitude" step="0.00000001" class="input-field"
                           value="{{ old('longitude', $meeqatLocation->longitude ?? '') }}">
                </div>
                <div>
                    <label class="input-label">Sort Order</label>
                    <input type="number" name="sort_order" class="input-field"
                           value="{{ old('sort_order', $meeqatLocation->sort_order ?? 0) }}">
                </div>
                <div>
                    <label class="input-label">Color (hex)</label>
                    <input type="text" name="color" class="input-field" placeholder="#22c55e"
                           value="{{ old('color', $meeqatLocation->color ?? '#22c55e') }}">
                </div>
            </div>

            <div class="mb-5">
                <label class="input-label">For Pilgrims From</label>
                <input type="text" name="for_pilgrims_from" class="input-field"
                       placeholder="e.g. Pakistan, India, Turkey..."
                       value="{{ old('for_pilgrims_from', $meeqatLocation->for_pilgrims_from ?? '') }}">
            </div>

            <div class="mb-5">
                <label class="input-label">Description</label>
                <textarea name="description" rows="3" class="input-field">{{ old('description', $meeqatLocation->description ?? '') }}</textarea>
            </div>

            <div class="flex items-center gap-4 mb-6">
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" name="is_active" value="1" class="w-5 h-5 rounded"
                           {{ old('is_active', $meeqatLocation->is_active ?? true) ? 'checked' : '' }}>
                    <span class="text-dark-300 font-medium">✅ Active</span>
                </label>
            </div>

            <div class="flex gap-3">
                <button type="submit" class="btn-primary">
                    {{ isset($meeqatLocation) ? 'Update Location' : 'Create Location' }}
                </button>
                <a href="{{ route('admin.meeqat-locations.index') }}" class="btn-outline">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection