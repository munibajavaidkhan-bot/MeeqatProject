@extends('layouts.admin')
@section('title', 'Analytics')
@section('page_title', 'Analytics & Reports')

@section('content')

{{-- Stats --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 mb-8">
    @foreach([
        ['Total Users',    $stats['total_users'],    '👥', 'primary'],
        ['Total Calcs',    $stats['total_calcs'],    '📏', 'blue'],
        ['Total Searches', $stats['total_searches'], '📍', 'purple'],
        ['Calcs/Month',    $stats['calcs_month'],    '📊', 'gold'],
        ['Searches/Month', $stats['searches_month'], '🔍', 'green'],
    ] as $s)
        <div class="card p-5 text-center">
            <div class="text-3xl mb-2">{{ $s[2] }}</div>
            <p class="text-2xl font-black text-white">{{ number_format($s[1]) }}</p>
            <p class="text-dark-500 text-xs mt-1">{{ $s[0] }}</p>
        </div>
    @endforeach
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">

    {{-- Chaddar Style Stats --}}
    <div class="card-premium p-6">
        <h3 class="text-white font-bold mb-5">📏 Chaddar Style Usage</h3>
        @php $total = $styleStats->sum(); @endphp
        @foreach($styleStats as $style => $count)
            <div class="mb-4">
                <div class="flex justify-between mb-1.5">
                    <span class="text-dark-300 text-sm capitalize">{{ $style }} Style</span>
                    <span class="text-white font-bold text-sm">{{ $count }}</span>
                </div>
                <div class="progress-bar">
                    <div class="progress-fill" style="width: {{ $total > 0 ? ($count/$total)*100 : 0 }}%"></div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Top Countries --}}
    <div class="card-premium p-6">
        <h3 class="text-white font-bold mb-5">🌍 Top Countries (Meeqat Searches)</h3>
        <div class="space-y-3">
            @foreach($topCountries as $index => $country)
                <div class="flex items-center gap-3">
                    <span class="text-dark-500 text-sm w-5 font-bold">{{ $index + 1 }}</span>
                    <div class="flex-1">
                        <div class="flex justify-between mb-1">
                            <span class="text-dark-300 text-sm">{{ $country->user_country }}</span>
                            <span class="text-white font-bold text-sm">{{ $country->total }}</span>
                        </div>
                        <div class="progress-bar">
                            <div class="h-1.5 bg-gradient-to-r from-blue-500 to-blue-400 rounded-full"
                                 style="width: {{ $topCountries->first()->total > 0 ? ($country->total/$topCountries->first()->total)*100 : 0 }}%"></div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

{{-- Activity Log --}}
<div class="card-premium overflow-hidden">
    <div class="p-5 border-b border-dark-800">
        <h3 class="text-white font-bold">📋 Recent Activity Logs</h3>
    </div>
    <table class="table-premium">
        <thead>
            <tr>
                <th>User</th>
                <th>Action</th>
                <th>Module</th>
                <th>IP</th>
                <th>Time</th>
            </tr>
        </thead>
        <tbody>
            @foreach($recentLogs as $log)
                <tr>
                    <td class="text-dark-200 text-sm">{{ $log->user?->name ?? 'Guest' }}</td>
                    <td><span class="badge-green text-xs">{{ str_replace('_', ' ', $log->action) }}</span></td>
                    <td class="text-dark-400 text-sm">{{ $log->module }}</td>
                    <td class="text-dark-600 text-xs font-mono">{{ $log->ip_address }}</td>
                    <td class="text-dark-500 text-xs">{{ $log->created_at->diffForHumans() }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection