@extends('layouts.app')
@section('title', 'Duas Library')

@section('content')
<div class="relative pt-32 pb-20 overflow-hidden">
    <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
        <div class="absolute top-20 left-1/4 w-80 h-80 bg-primary-500/5 rounded-full blur-3xl"></div>
        <div class="absolute top-20 right-1/4 w-80 h-80 bg-secondary-500/4 rounded-full blur-3xl"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="text-center mb-10">
            <h1 class="text-4xl md:text-5xl font-black text-heading mb-3">Hajj & Umrah <span class="text-primary-600">Duas</span></h1>
            <p class="text-muted max-w-xl mx-auto">Authentic duas with Arabic text, translation, and Urdu translation for your spiritual journey.</p>
        </div>

        {{-- Search + Filter --}}
        <div class="max-w-3xl mx-auto mb-10">
            <form action="{{ route('duas.index') }}" method="GET" class="flex flex-col sm:flex-row gap-3">
                <div class="flex-1 relative">
                    <input type="text" name="search" placeholder="Search duas (English or Urdu)..." class="form-input w-full pl-10" value="{{ request('search') }}">
                    <svg class="w-4 h-4 text-muted absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
                @if(request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                <button type="submit" class="btn-primary">Search</button>
                @if(request('search'))
                    <a href="{{ route('duas.index') }}" class="btn-outline">Clear</a>
                @endif
            </form>
        </div>

        <div class="flex flex-col lg:flex-row gap-8">
            {{-- Categories Sidebar --}}
            <div class="lg:w-72 flex-shrink-0">
                <div class="card p-5 sticky top-24">
                    <h3 class="text-heading font-bold mb-4 flex items-center gap-2">
                        <span class="w-1 h-5 bg-primary-500 rounded-full"></span>
                        Categories
                    </h3>
                    <div class="space-y-1.5">
                        <a href="{{ route('duas.index') }}" class="flex items-center gap-2 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 {{ !request('category') ? 'bg-primary-50 text-primary-700 border border-primary-200' : 'text-muted hover:text-heading hover:bg-dark-50' }}">
                            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                            All Duas <span class="ml-auto text-xs opacity-60">({{ $duas->total() }})</span>
                        </a>
                        @foreach($categories as $cat)
                            <a href="{{ route('duas.index', ['category' => $cat->id]) }}" class="flex items-center gap-2 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 {{ request('category') == $cat->id ? 'bg-primary-50 text-primary-700 border border-primary-200' : 'text-muted hover:text-heading hover:bg-dark-50' }}">
                                <span>{{ $cat->icon }}</span> {{ $cat->name_en }} <span class="ml-auto text-xs opacity-60">({{ $cat->duas_count }})</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Duas Grid --}}
            <div class="flex-1 min-w-0">
                @if($duas->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
                        @foreach($duas as $dua)
                            <a href="{{ route('duas.show', $dua->id) }}" class="card p-5 hover:-translate-y-1.5 hover:border-primary-200 transition-all duration-300 group block">
                                <div class="flex items-center gap-2 mb-3">
                                    <span class="badge-green text-xs">{{ $dua->category->name_en }}</span>
                                    @if($dua->is_featured)
                                        <span class="badge-gold text-xs">Featured</span>
                                    @endif
                                </div>
                                <h3 class="text-heading font-bold text-sm mb-3 line-clamp-2 group-hover:text-primary-600 transition-colors">{{ $dua->title_en }}</h3>
                                <p class="arabic text-xl text-secondary-600/90 mb-3 line-clamp-2 leading-loose">{{ $dua->arabic_text }}</p>
                                <p class="text-muted text-xs line-clamp-2">{{ $dua->translation_en }}</p>
                                @if($dua->translation_ur)
                                    <p class="text-muted text-xs mt-2 line-clamp-1 border-t border-border pt-2">{{ $dua->translation_ur }}</p>
                                @endif
                                <div class="mt-3 flex items-center gap-2 text-muted text-xs">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                                    Read full dua
                                </div>
                            </a>
                        @endforeach
                    </div>
                    <div class="mt-8">{{ $duas->links() }}</div>
                @else
                    <div class="card p-12 text-center">
                        <div class="w-16 h-16 rounded-2xl bg-surface flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </div>
                        <h3 class="text-heading font-bold text-lg mb-2">No Duas Found</h3>
                        <p class="text-muted text-sm">Try a different search term or category.</p>
                        <a href="{{ route('duas.index') }}" class="btn-primary mt-4 inline-block">View All Duas</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
