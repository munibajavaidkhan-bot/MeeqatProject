@extends('layouts.admin')
@section('title', 'Dashboard')
@section('page_title', 'Dashboard')
@section('page_subtitle', 'Welcome back, ' . auth()->user()->name)

@section('content')

{{-- Stats Cards --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
    @php
    $statCards = [
        ['label' => 'Total Users',       'value' => $stats['total_users'],          'icon' => '👥', 'sub' => '+' . $stats['new_users_today'] . ' today',     'color' => 'from-primary-500/20 to-primary-600/10 border-primary-500/20'],
        ['label' => 'Total Duas',        'value' => $stats['total_duas'],           'icon' => '🤲', 'sub' => $stats['total_niyat'] . ' niyat also',           'color' => 'from-gold-500/20 to-gold-600/10 border-gold-500/20'],
        ['label' => 'Chaddar Calcs',     'value' => $stats['chaddar_calculations'], 'icon' => '📏', 'sub' => '+' . $stats['calcs_today'] . ' today',          'color' => 'from-blue-500/20 to-blue-600/10 border-blue-500/20'],
        ['label' => 'Meeqat Searches',   'value' => $stats['meeqat_searches'],      'icon' => '📍', 'sub' => '+' . $stats['searches_today'] . ' today',       'color' => 'from-purple-500/20 to-purple-600/10 border-purple-500/20'],
    ];
    @endphp

    @foreach($statCards as $card)
        <div class="card overflow-hidden bg-gradient-to-br {{ $card['color'] }} border">
            <div class="p-6">
                <div class="flex items-start justify-between mb-4">
                    <div class="text-3xl">{{ $card['icon'] }}</div>
                    <span class="badge-green text-xs">Live</span>
                </div>
                <p class="text-3xl font-black text-white mb-1">{{ number_format($card['value']) }}</p>
                <p class="text-dark-400 text-sm font-medium">{{ $card['label'] }}</p>
                <p class="text-dark-600 text-xs mt-1">{{ $card['sub'] }}</p>
            </div>
        </div>
    @endforeach
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- Recent Users --}}
    <div class="lg:col-span-2 card-premium">
        <div class="p-5 border-b border-dark-800 flex items-center justify-between">
            <h3 class="text-white font-bold">👥 Recent Users</h3>
            <a href="{{ route('admin.users.index') }}" class="text-primary-400 text-sm hover:underline">View All →</a>
        </div>
        <div class="overflow-x-auto">
            <table class="table-premium">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Role</th>
                        <th>Country</th>
                        <th>Status</th>
                        <th>Joined</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentUsers as $user)
                        <tr>
                            <td>
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-primary-500 to-primary-700 flex items-center justify-center text-white text-xs font-bold">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <p class="text-white text-sm font-medium">{{ $user->name }}</p>
                                        <p class="text-dark-500 text-xs">{{ $user->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td><span class="badge-green text-xs">{{ $user->role?->label }}</span></td>
                            <td class="text-dark-400 text-sm">{{ $user->country ?? '—' }}</td>
                            <td>
                                @if($user->is_active)
                                    <span class="badge-green text-xs">Active</span>
                                @else
                                    <span class="badge-red text-xs">Inactive</span>
                                @endif
                            </td>
                            <td class="text-dark-500 text-xs">{{ $user->created_at->diffForHumans() }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Quick Actions --}}
    <div class="card-premium p-6">
        <h3 class="text-white font-bold mb-5">⚡ Quick Actions</h3>
        <div class="space-y-3">
            @foreach([
                ['route' => 'admin.duas.create',         'icon' => '🤲', 'label' => 'Add New Dua',           'color' => 'primary'],
                ['route' => 'admin.niyat.create',        'icon' => '📿', 'label' => 'Add New Niyat',         'color' => 'gold'],
                ['route' => 'admin.ihram-guides.create', 'icon' => '📖', 'label' => 'Add Ihram Guide',       'color' => 'blue'],
                ['route' => 'admin.categories.index',    'icon' => '🏷️', 'label' => 'Manage Categories',    'color' => 'purple'],
                ['route' => 'admin.messages.index',      'icon' => '✉️', 'label' => 'View Messages',        'color' => 'green'],
                ['route' => 'admin.settings',            'icon' => '⚙️', 'label' => 'Site Settings',        'color' => 'orange'],
            ] as $action)
                <a href="{{ route($action['route']) }}"
                   class="flex items-center gap-3 p-3 rounded-xl bg-dark-800 hover:bg-dark-700 border border-dark-700 hover:border-dark-600 transition-all duration-200 group">
                    <span class="text-xl">{{ $action['icon'] }}</span>
                    <span class="text-dark-300 group-hover:text-white text-sm font-medium transition-colors">{{ $action['label'] }}</span>
                    <svg class="w-4 h-4 text-dark-600 group-hover:text-primary-400 ml-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            @endforeach
        </div>
    </div>

    {{-- Recent Activity --}}
    <div class="lg:col-span-3 card-premium">
        <div class="p-5 border-b border-dark-800">
            <h3 class="text-white font-bold">📊 Recent Activity</h3>
        </div>
        <div class="p-5 space-y-3">
            @foreach($recentActivity as $log)
                <div class="flex items-start gap-4 p-3 rounded-xl hover:bg-dark-800 transition-colors">
                    <div class="w-8 h-8 rounded-lg bg-dark-800 border border-dark-700 flex items-center justify-center text-sm flex-shrink-0">
                        {{ match($log->module) { 'chaddar_calculator' => '📏', 'meeqat_finder' => '📍', default => '📋' } }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-dark-200 text-sm">
                            <span class="text-white font-medium">{{ $log->user?->name ?? 'Guest' }}</span>
                            — {{ str_replace('_', ' ', $log->action) }}
                        </p>
                        <p class="text-dark-600 text-xs mt-0.5">{{ $log->created_at->diffForHumans() }} • {{ $log->ip_address }}</p>
                    </div>
                    <span class="badge bg-dark-800 border border-dark-700 text-dark-400 text-xs flex-shrink-0">{{ $log->module }}</span>
                </div>
            @endforeach
        </div>
    </div>
</div>

@endsection