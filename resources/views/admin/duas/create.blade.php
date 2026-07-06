@extends('layouts.admin')
@section('title', isset($dua) ? 'Edit Dua' : 'Add Dua')
@section('page_title', isset($dua) ? 'Edit Dua' : 'Add New Dua')

@section('content')
<div class="max-w-4xl">
    <div class="card-premium p-8">
        <form action="{{ isset($dua) ? route('admin.duas.update', $dua) : route('admin.duas.store') }}"
              method="POST">
            @csrf
            @if(isset($dua)) @method('PUT') @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mb-5">
                <div>
                    <label class="input-label">Category <span class="text-red-400">*</span></label>
                    <select name="category_id" class="select-field">
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id', $dua->category_id ?? '') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->icon }} {{ $cat->name_en }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="input-label">Title (English) <span class="text-red-400">*</span></label>
                    <input type="text" name="title_en" class="input-field" placeholder="Dua title..."
                           value="{{ old('title_en', $dua->title_en ?? '') }}">
                    @error('title_en') <p class="input-error">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="mb-5">
                <label class="input-label">Arabic Text <span class="text-red-400">*</span></label>
                <textarea name="arabic_text" rows="4"
                          class="input-field arabic text-right text-xl leading-loose"
                          dir="rtl" placeholder="عربی متن یہاں لکھیں...">{{ old('arabic_text', $dua->arabic_text ?? '') }}</textarea>
                @error('arabic_text') <p class="input-error">{{ $message }}</p> @enderror
            </div>

            <div class="mb-5">
                <label class="input-label">Transliteration (Roman)</label>
                <textarea name="transliteration" rows="3" class="input-field"
                          placeholder="e.g. Rabbana atina fid-dunya hasanatan...">{{ old('transliteration', $dua->transliteration ?? '') }}</textarea>
            </div>

            <div class="mb-5">
                <label class="input-label">Translation (English)</label>
                <textarea name="translation_en" rows="3" class="input-field"
                          placeholder="English translation...">{{ old('translation_en', $dua->translation_en ?? '') }}</textarea>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mb-6">
                <div>
                    <label class="input-label">Reference (Quran/Hadith)</label>
                    <input type="text" name="reference" class="input-field" placeholder="e.g. Quran 2:201"
                           value="{{ old('reference', $dua->reference ?? '') }}">
                </div>
                <div class="flex items-end gap-6">
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="hidden" name="is_featured" value="0">
                        <input type="checkbox" name="is_featured" value="1" class="w-5 h-5 rounded"
                               {{ old('is_featured', $dua->is_featured ?? false) ? 'checked' : '' }}>
                        <span class="text-dark-300 font-medium">⭐ Featured</span>
                    </label>
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" name="is_active" value="1" class="w-5 h-5 rounded"
                               {{ old('is_active', $dua->is_active ?? true) ? 'checked' : '' }}>
                        <span class="text-dark-300 font-medium">✅ Active</span>
                    </label>
                </div>
            </div>

            <div class="flex gap-3">
                <button type="submit" class="btn-primary">{{ isset($dua) ? 'Update Dua' : 'Create Dua' }}</button>
                <a href="{{ route('admin.duas.index') }}" class="btn-outline">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection