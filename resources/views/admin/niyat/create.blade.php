@extends('layouts.admin')
@section('title', isset($niyat) ? 'Edit Niyat' : 'Add Niyat')
@section('page_title', isset($niyat) ? 'Edit Niyat' : 'Add New Niyat')

@section('content')
<div class="max-w-4xl">
    <div class="card-premium p-8">
        <form action="{{ isset($niyat) ? route('admin.niyat.update', $niyat) : route('admin.niyat.store') }}"
              method="POST">
            @csrf
            @if(isset($niyat)) @method('PUT') @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mb-5">
                <div>
                    <label class="input-label">Type <span class="text-red-400">*</span></label>
                    <select name="type" class="select-field">
                        @foreach(['hajj' => '🕌 Hajj', 'umrah' => '🕋 Umrah', 'tawaf' => '🔄 Tawaf', 'sai' => '⛰️ Sai', 'other' => '📿 Other'] as $val => $label)
                            <option value="{{ $val }}" {{ old('type', $niyat->type ?? '') === $val ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="input-label">Title (English) <span class="text-red-400">*</span></label>
                    <input type="text" name="title_en" class="input-field"
                           placeholder="e.g. Niyat for Umrah"
                           value="{{ old('title_en', $niyat->title_en ?? '') }}">
                    @error('title_en') <p class="input-error">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="mb-5">
                <label class="input-label">Arabic Text <span class="text-red-400">*</span></label>
                <textarea name="arabic_text" rows="3"
                          class="input-field arabic text-right text-xl leading-loose"
                          dir="rtl"
                          placeholder="عربی متن یہاں لکھیں...">{{ old('arabic_text', $niyat->arabic_text ?? '') }}</textarea>
                @error('arabic_text') <p class="input-error">{{ $message }}</p> @enderror
            </div>

            <div class="mb-5">
                <label class="input-label">Transliteration (Roman)</label>
                <textarea name="transliteration" rows="2" class="input-field"
                          placeholder="e.g. Labbayk Allahumma Umratan...">{{ old('transliteration', $niyat->transliteration ?? '') }}</textarea>
            </div>

            <div class="mb-5">
                <label class="input-label">Translation (English)</label>
                <textarea name="translation_en" rows="2" class="input-field"
                          placeholder="English translation...">{{ old('translation_en', $niyat->translation_en ?? '') }}</textarea>
            </div>

            <div class="flex items-center gap-5 mb-6">
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" name="is_active" value="1" class="w-5 h-5 rounded"
                           {{ old('is_active', $niyat->is_active ?? true) ? 'checked' : '' }}>
                    <span class="text-dark-300 font-medium">✅ Active</span>
                </label>
            </div>

            <div class="flex gap-3">
                <button type="submit" class="btn-primary">
                    {{ isset($niyat) ? 'Update Niyat' : 'Create Niyat' }}
                </button>
                <a href="{{ route('admin.niyat.index') }}" class="btn-outline">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection