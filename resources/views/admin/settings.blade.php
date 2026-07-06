@extends('layouts.admin')
@section('title', 'Settings')
@section('page_title', 'Site Settings')

@section('content')
<div class="max-w-3xl">
    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="space-y-6">
            @foreach($settings as $group => $groupSettings)
                <div class="card-premium overflow-hidden">
                    <div class="px-6 py-4 border-b border-dark-800 bg-dark-800/30">
                        <h3 class="text-white font-bold capitalize">{{ $group }} Settings</h3>
                    </div>
                    <div class="p-6 space-y-4">
                        @foreach($groupSettings as $setting)
                            <div class="grid grid-cols-3 gap-4 items-center">
                                <label class="text-dark-300 text-sm font-medium">
                                    {{ $setting->label ?? $setting->key }}
                                </label>
                                <div class="col-span-2">
                                    @if($setting->type === 'boolean')
                                        <select name="{{ $setting->key }}" class="select-field">
                                            <option value="1" {{ $setting->value == '1' ? 'selected' : '' }}>Enabled</option>
                                            <option value="0" {{ $setting->value == '0' ? 'selected' : '' }}>Disabled</option>
                                        </select>
                                    @elseif($setting->type === 'image')
                                        <input type="file" name="{{ $setting->key }}" accept="image/*"
                                               class="block w-full text-sm text-dark-400 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:bg-primary-500/20 file:text-primary-400 file:cursor-pointer">
                                    @else
                                        <input type="text" name="{{ $setting->key }}"
                                               value="{{ $setting->value }}"
                                               class="input-field">
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            <button type="submit" class="btn-primary px-8 py-3">💾 Save All Settings</button>
        </div>
    </form>
</div>
@endsection