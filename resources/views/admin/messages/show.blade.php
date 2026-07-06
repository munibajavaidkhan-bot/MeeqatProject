@extends('layouts.admin')
@section('title', 'View Message')
@section('page_title', 'Message Detail')

@section('content')
<div class="max-w-2xl">
    <a href="{{ route('admin.messages.index') }}" class="inline-flex items-center gap-2 text-dark-400 hover:text-primary-400 text-sm mb-6 transition-colors">
        ← Back to Messages
    </a>

    <div class="card-premium p-8">
        <div class="flex items-start justify-between mb-6">
            <div>
                <h2 class="text-xl font-bold text-white">{{ $message->subject ?? 'No Subject' }}</h2>
                <p class="text-dark-400 text-sm mt-1">{{ $message->created_at->format('F d, Y — h:i A') }}</p>
            </div>
            <span class="badge-green text-xs">Read</span>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-6">
            <div class="card p-4">
                <p class="text-dark-500 text-xs mb-1">Name</p>
                <p class="text-white font-semibold">{{ $message->name }}</p>
            </div>
            <div class="card p-4">
                <p class="text-dark-500 text-xs mb-1">Email</p>
                <a href="mailto:{{ $message->email }}" class="text-primary-400 font-semibold hover:underline">{{ $message->email }}</a>
            </div>
            @if($message->phone)
                <div class="card p-4 col-span-2">
                    <p class="text-dark-500 text-xs mb-1">Phone</p>
                    <p class="text-white">{{ $message->phone }}</p>
                </div>
            @endif
        </div>

        <div class="card p-5">
            <p class="text-dark-500 text-xs mb-3 uppercase tracking-wider">Message</p>
            <p class="text-dark-200 leading-relaxed">{{ $message->message }}</p>
        </div>

        <div class="flex gap-3 mt-6">
            <a href="mailto:{{ $message->email }}" class="btn-primary text-sm">Reply via Email</a>
            <form action="{{ route('admin.messages.destroy', $message->id) }}" method="POST"
                  onsubmit="return confirm('Delete message?')">
                @csrf @method('DELETE')
                <button type="submit" class="btn-danger text-sm">Delete</button>
            </form>
        </div>
    </div>
</div>
@endsection