@extends('layouts.admin')
@section('title', 'Dashboard')
@section('page_title', 'Dashboard')
@section('page_subtitle', 'Welcome back, ' . auth()->user()->name)

@section('content')

{{-- Stats Cards --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    @php
    $statCards = [
        ['label' => 'Total Users',       'value' => $stats['total_users'],          'icon' => '👥', 'sub' => '+' . $stats['new_users_today'] . ' today',     'color' => 'primary',   'trend' => '+12%'],
        ['label' => 'Total Duas',        'value' => $stats['total_duas'],           'icon' => '🤲', 'sub' => $stats['total_niyat'] . ' niyat also',           'color' => 'gold',      'trend' => '+8%'],
        ['label' => 'Chaddar Calcs',     'value' => $stats['chaddar_calculations'], 'icon' => '📏', 'sub' => '+' . $stats['calcs_today'] . ' today',          'color' => 'blue',      'trend' => '+24%'],
        ['label' => 'Meeqat Searches',   'value' => $stats['meeqat_searches'],      'icon' => '📍', 'sub' => '+' . $stats['searches_today'] . ' today',       'color' => 'purple',    'trend' => '+5%'],
    ];
    @endphp

    @foreach($statCards as $index => $card)
        <div class="card-premium overflow-hidden group">
            <div class="p-6 flex flex-col h-full relative">
                <div class="absolute top-0 right-0 w-24 h-24 rounded-full opacity-5 -mr-12 -mt-12 transition-all duration-300 group-hover:scale-125"
                     style="background: linear-gradient(135deg, var(--color-{{ $card['color'] }}), var(--color-{{ $card['color'] }}))"></div>
                
                <div class="flex items-start justify-between mb-4 relative z-10">
                    <div class="w-12 h-12 rounded-xl bg-dark-700/50 flex items-center justify-center text-xl group-hover:bg-dark-600 transition-all duration-300">
                        {{ $card['icon'] }}
                    </div>
                    <span class="badge-green text-xs font-medium tracking-wider">LIVE</span>
                </div>
                
                <div class="flex-1 relative z-10">
                    <p class="text-3xl font-black text-white mb-2 tracking-tight">{{ number_format($card['value']) }}</p>
                    <p class="text-dark-400 text-sm font-semibold">{{ $card['label'] }}</p>
                </div>
                
                <div class="flex items-center justify-between mt-4 relative z-10 pt-4 border-t border-dark-700/30">
                    <p class="text-dark-600 text-xs">{{ $card['sub'] }}</p>
                    <span class="text-primary-400 text-xs font-bold tracking-wide">{{ $card['trend'] }}</span>
                </div>
            </div>
        </div>
    @endforeach
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- Recent Users --}}
    <div class="lg:col-span-2 card-premium">
        <div class="px-6 py-4 border-b border-dark-700/50 flex items-center justify-between">
            <div>
                <h3 class="text-white font-bold text-lg">👥 Recent Users</h3>
                <p class="text-dark-500 text-xs mt-1">Latest user registrations</p>
            </div>
            <a href="{{ route('admin.users.index') }}" class="text-primary-400 text-sm font-semibold hover:text-primary-300 transition-colors flex items-center gap-1">
                View All
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-dark-700/30">
                        <th class="px-6 py-3 text-left text-caption font-semibold text-dark-400 uppercase tracking-wider">User</th>
                        <th class="px-6 py-3 text-left text-caption font-semibold text-dark-400 uppercase tracking-wider">Role</th>
                        <th class="px-6 py-3 text-left text-caption font-semibold text-dark-400 uppercase tracking-wider">Country</th>
                        <th class="px-6 py-3 text-left text-caption font-semibold text-dark-400 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-caption font-semibold text-dark-400 uppercase tracking-wider">Joined</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentUsers as $user)
                        <tr class="border-b border-dark-700/20 hover:bg-dark-700/20 transition-colors duration-150">
                            <td class="px-6 py-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-primary-500 to-primary-700 flex items-center justify-center text-white text-xs font-bold flex-shrink-0">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <p class="text-white text-sm font-semibold">{{ $user->name }}</p>
                                        <p class="text-dark-500 text-xs">{{ $user->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-3"><span class="badge-green text-xs font-semibold">{{ $user->role?->label }}</span></td>
                            <td class="px-6 py-3 text-dark-400 text-sm font-medium">{{ $user->country ?? '—' }}</td>
                            <td class="px-6 py-3">
                                @if($user->is_active)
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-green-500/20 text-green-300 border border-green-500/30">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-400"></span>
                                        Active
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-red-500/20 text-red-300 border border-red-500/30">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-400"></span>
                                        Inactive
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-3 text-dark-500 text-xs font-medium">{{ $user->created_at->diffForHumans() }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Quick Actions --}}
    <div class="card-premium p-6">
        <div class="mb-5">
            <h3 class="text-white font-bold text-lg">⚡ Quick Actions</h3>
            <p class="text-dark-500 text-xs mt-1">Frequently used admin functions</p>
        </div>
        <div class="space-y-2">
            @foreach([
                ['route' => 'admin.duas.create',         'icon' => '🤲', 'label' => 'Add New Dua',           'color' => 'primary'],
                ['route' => 'admin.niyat.create',        'icon' => '📿', 'label' => 'Add New Niyat',         'color' => 'gold'],
                ['route' => 'admin.ihram-guides.create', 'icon' => '📖', 'label' => 'Add Ihram Guide',       'color' => 'blue'],
                ['route' => 'admin.categories.index',    'icon' => '🏷️', 'label' => 'Manage Categories',    'color' => 'purple'],
                ['route' => 'admin.messages.index',      'icon' => '✉️', 'label' => 'View Messages',        'color' => 'green'],
                ['route' => 'admin.settings',            'icon' => '⚙️', 'label' => 'Site Settings',        'color' => 'orange'],
            ] as $action)
                <a href="{{ route($action['route']) }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-lg bg-dark-700/40 hover:bg-dark-700/70 border border-dark-700/50 hover:border-dark-600 transition-all duration-200 group">
                    <span class="text-lg">{{ $action['icon'] }}</span>
                    <span class="text-dark-300 group-hover:text-white text-sm font-medium transition-colors flex-1">{{ $action['label'] }}</span>
                    <svg class="w-4 h-4 text-dark-600 group-hover:text-primary-400 transition-colors flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            @endforeach
        </div>
    </div>

    {{-- Recent Activity --}}
    <div class="lg:col-span-3 card-premium">
        <div class="px-6 py-4 border-b border-dark-700/50">
            <div>
                <h3 class="text-white font-bold text-lg">📊 Recent Activity</h3>
                <p class="text-dark-500 text-xs mt-1">Platform activity log</p>
            </div>
        </div>
        <div class="p-6 space-y-3 max-h-96 overflow-y-auto">
            @foreach($recentActivity as $log)
                <div class="flex items-start gap-4 p-3 rounded-lg hover:bg-dark-700/30 transition-all duration-200 group">
                    <div class="w-9 h-9 rounded-lg bg-dark-700/50 group-hover:bg-dark-700 border border-dark-700/30 flex items-center justify-center text-sm flex-shrink-0 transition-colors">
                        {{ match($log->module) { 'chaddar_calculator' => '📏', 'meeqat_finder' => '📍', default => '📋' } }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-dark-200 text-sm">
                            <span class="text-white font-semibold">{{ $log->user?->name ?? 'Guest' }}</span>
                            <span class="text-dark-600 mx-1">—</span>
                            <span class="text-dark-400">{{ str_replace('_', ' ', $log->action) }}</span>
                        </p>
                        <div class="flex items-center gap-2 text-dark-600 text-xs mt-1">
                            <span class="inline-flex items-center">{{ $log->created_at->diffForHumans() }}</span>
                            <span class="w-1 h-1 rounded-full bg-dark-600"></span>
                            <span class="font-mono text-dark-700">{{ $log->ip_address }}</span>
                        </div>
                    </div>
                    <span class="inline-flex items-center px-2 py-1 rounded-md bg-dark-700/50 border border-dark-700/30 text-dark-400 text-xs font-medium uppercase tracking-wider flex-shrink-0">
                        {{ str_replace('_', ' ', $log->module) }}
                    </span>
                </div>
            @endforeach
        </div>
    </div>
</div>

@endsection
