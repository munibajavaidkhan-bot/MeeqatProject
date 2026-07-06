@extends('layouts.admin')
@section('title', 'Messages')
@section('page_title', 'Contact Messages')

@section('content')

@if($unread > 0)
    <div class="alert-warning mb-6">
        <span class="text-xl">📬</span>
        <p>Aapke paas <strong>{{ $unread }}</strong> unread messages hain!</p>
    </div>
@endif

<div class="card-premium overflow-hidden">
    <table class="table-premium">
        <thead>
            <tr>
                <th>From</th>
                <th>Subject</th>
                <th>Message</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($messages as $msg)
                <tr class="{{ !$msg->is_read ? 'bg-primary-500/5' : '' }}">
                    <td>
                        <div>
                            <p class="text-white text-sm font-medium {{ !$msg->is_read ? 'font-bold' : '' }}">{{ $msg->name }}</p>
                            <p class="text-dark-500 text-xs">{{ $msg->email }}</p>
                        </div>
                    </td>
                    <td class="text-dark-300 text-sm">{{ Str::limit($msg->subject, 30) ?? '—' }}</td>
                    <td class="text-dark-500 text-sm">{{ Str::limit($msg->message, 40) }}</td>
                    <td class="text-dark-500 text-xs">{{ $msg->created_at->format('M d, Y') }}</td>
                    <td>
                        <div class="flex gap-2">
                            <a href="{{ route('admin.messages.show', $msg->id) }}"
                               class="p-1.5 rounded-lg bg-dark-700 hover:bg-primary-500/20 text-dark-400 hover:text-primary-400 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            </a>
                            <form action="{{ route('admin.messages.destroy', $msg->id) }}" method="POST"
                                  onsubmit="return confirm('Delete?')">
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
    <div class="p-5 border-t border-dark-800">{{ $messages->links() }}</div>
</div>

@endsection