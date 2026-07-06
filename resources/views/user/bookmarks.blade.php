@extends('layouts.app')
@section('title', 'My Bookmarks')

@section('content')
<div class="pt-32 pb-20 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-black text-white mb-8">My <span class="text-primary-400">Bookmarks</span></h1>

    @forelse($bookmarks as $dua)
        <div class="card-premium p-6 mb-4">
            <div class="flex justify-between items-start mb-3">
                <span class="badge-green text-xs">{{ $dua->category->name_en }}</span>
                <form action="{{ route('duas.bookmark', $dua->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="text-gold-400 hover:text-dark-400 transition-colors text-sm">Remove ✕</button>
                </form>
            </div>
            <a href="{{ route('duas.show', $dua->id) }}">
                <h3 class="text-white font-bold mb-3">{{ $dua->title_en }}</h3>
                <p class="arabic text-gold-400 text-xl text-right">{{ Str::limit($dua->arabic_text, 80) }}</p>
            </a>
        </div>
    @empty
        <div class="card-premium p-12 text-center">
            <div class="text-5xl mb-4">⭐</div>
            <h3 class="text-white font-bold mb-2">No Bookmarks Yet</h3>
            <p class="text-dark-400 text-sm mb-6">Bookmark duas so you can easily find them later.</p>
            <a href="{{ route('duas.index') }}" class="btn-primary">Browse Duas</a>
        </div>
    @endforelse
</div>
@endsection