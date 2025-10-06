<div wire:poll.5s="loadStats" class="min-h-screen bg-gradient-to-br from-gray-50 via-red-50 to-gray-100">
    <!-- Header -->
    <div class="bg-gradient-to-r from-gray-900 via-red-900 to-black shadow-2xl relative overflow-hidden">
        <!-- Animated background -->
        <div class="absolute inset-0 bg-gradient-to-r from-red-600/10 to-transparent animate-pulse"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-8">
                <div class="flex items-center space-x-4">
                    <div class="flex-shrink-0">
                        <div class="w-16 h-16 bg-gradient-to-br from-red-500 to-red-700 rounded-2xl flex items-center justify-center shadow-xl">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h1 class="text-4xl font-bold text-white mb-1">
                            Gym<span class="text-red-400">In</span> <span class="text-red-300">Admin</span>
                        </h1>
                        <p class="text-red-100 text-lg font-medium">Premium Equipment Management Portal</p>
                    </div>
                </div>
                <div class="flex items-center space-x-6">
                    <!-- Notifications -->
                    <button class="relative p-3 bg-white/10 hover:bg-white/20 rounded-2xl transition-all duration-300 group">
                        <svg class="w-6 h-6 text-white group-hover:text-red-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5-5V9.5a6.5 6.5 0 10-13 0V12l-5 5h5a3 3 0 006 0z"/>
                        </svg>
                        <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center font-bold">3</span>
                    </button>
                    
                    <!-- Admin Profile -->
                    <div class="flex items-center space-x-4 bg-white/10 backdrop-blur-sm rounded-2xl p-4">
                        <div class="text-white text-right">
                            <p class="text-sm text-red-100">Welcome back,</p>
                            <p class="font-bold text-lg">{{ auth()->user()->name }}</p>
                        </div>
                        <div class="relative">
                            <img class="h-12 w-12 rounded-2xl ring-2 ring-white shadow-lg" 
                                 src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&color=fff&background=dc2626&size=48" 
                                 alt="{{ auth()->user()->name }}">
                            <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-400 border-2 border-white rounded-full"></div>
                        </div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="bg-white/20 hover:bg-white/30 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-300 flex items-center group">
                                <svg class="w-5 h-5 mr-2 group-hover:rotate-180 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                </svg>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Overview Stats Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="mb-12">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold bg-gradient-to-r from-gray-900 to-red-600 bg-clip-text text-transparent mb-4">
                    Equipment Store Analytics
                </h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Monitor your gym equipment business performance with real-time insights and comprehensive metrics</p>
            </div>
            
            <!-- Enhanced Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
                <!-- Total Users -->
                <div class="relative group">
                    <div class="absolute inset-0 bg-gradient-to-r from-blue-400 to-blue-600 rounded-3xl transform -rotate-1 group-hover:rotate-0 transition-transform duration-300"></div>
                    <div class="relative bg-white rounded-3xl shadow-2xl p-8 border border-blue-100 group-hover:shadow-3xl transition-all duration-300">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-700 rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                                <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                                </svg>
                            </div>
                            <div class="text-right">
                                <div class="text-3xl font-bold text-gray-900">{{ $stats['total_users'] ?? 0 }}</div>
                                <div class="text-sm font-medium text-blue-600">+12% this month</div>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 mb-1">Total Customers</h3>
                            <p class="text-gray-600 text-sm">Active gym equipment buyers</p>
                        </div>
                    </div>
                </div>

                <!-- Active Products -->
                <div class="relative group">
                    <div class="absolute inset-0 bg-gradient-to-r from-green-400 to-emerald-600 rounded-3xl transform rotate-1 group-hover:rotate-0 transition-transform duration-300"></div>
                    <div class="relative bg-white rounded-3xl shadow-2xl p-8 border border-green-100 group-hover:shadow-3xl transition-all duration-300">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-700 rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                                <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                </svg>
                            </div>
                            <div class="text-right">
                                <div class="text-3xl font-bold text-gray-900">{{ $stats['total_packages'] ?? 0 }}</div>
                                <div class="text-sm font-medium text-green-600">+8% this week</div>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 mb-1">Equipment Items</h3>
                            <p class="text-gray-600 text-sm">Active product catalog</p>
                        </div>
                    </div>
                </div>

                <!-- Total Orders -->
                <div class="relative group">
                    <div class="absolute inset-0 bg-gradient-to-r from-purple-400 to-purple-600 rounded-3xl transform -rotate-1 group-hover:rotate-0 transition-transform duration-300"></div>
                    <div class="relative bg-white rounded-3xl shadow-2xl p-8 border border-purple-100 group-hover:shadow-3xl transition-all duration-300">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-700 rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                                <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                </svg>
                            </div>
                            <div class="text-right">
                                <div class="text-3xl font-bold text-gray-900">{{ $stats['total_orders'] ?? 0 }}</div>
                                <div class="text-sm font-medium text-purple-600">+25% this month</div>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 mb-1">Equipment Orders</h3>
                            <p class="text-gray-600 text-sm">Completed purchases</p>
                        </div>
                    </div>
                </div>

                <!-- Monthly Revenue -->
                <div class="relative group">
                    <div class="absolute inset-0 bg-gradient-to-r from-red-400 to-pink-600 rounded-3xl transform rotate-1 group-hover:rotate-0 transition-transform duration-300"></div>
                    <div class="relative bg-white rounded-3xl shadow-2xl p-8 border border-red-100 group-hover:shadow-3xl transition-all duration-300">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-16 h-16 bg-gradient-to-br from-red-500 to-pink-700 rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                                <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                                </svg>
                            </div>
                            <div class="text-right">
                                <div class="text-3xl font-bold text-gray-900">${{ number_format($stats['monthly_revenue'] ?? 0, 0) }}</div>
                                <div class="text-sm font-medium text-red-600">+18% this month</div>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 mb-1">Monthly Revenue</h3>
                            <p class="text-gray-600 text-sm">Equipment sales income</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Enhanced Quick Actions -->
            <div class="bg-gradient-to-br from-white to-gray-50 shadow-2xl rounded-3xl p-8 mb-12 border border-gray-100">
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">Quick Actions</h3>
                        <p class="text-gray-600">Manage your gym equipment store efficiently</p>
                    </div>
                    <div class="w-16 h-16 bg-gradient-to-br from-red-500 to-red-700 rounded-2xl flex items-center justify-center shadow-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <button wire:click="setActiveTab('packages')" class="group relative bg-gradient-to-r from-red-500 to-red-700 hover:from-red-600 hover:to-red-800 text-white p-6 rounded-2xl font-semibold transition-all duration-300 flex items-center shadow-lg hover:shadow-2xl transform hover:-translate-y-1">
                        <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mr-4 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                        </div>
                        <div class="text-left">
                            <div class="font-bold text-lg">Add Equipment</div>
                            <div class="text-red-100 text-sm">New product catalog</div>
                        </div>
                    </button>
                    
                    <button wire:click="setActiveTab('users')" class="group relative bg-gradient-to-r from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800 text-white p-6 rounded-2xl font-semibold transition-all duration-300 flex items-center shadow-lg hover:shadow-2xl transform hover:-translate-y-1">
                        <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mr-4 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                            </svg>
                        </div>
                        <div class="text-left">
                            <div class="font-bold text-lg">Manage Customers</div>
                            <div class="text-blue-100 text-sm">User accounts & data</div>
                        </div>
                    </button>
                    
                    <button wire:click="setActiveTab('orders')" class="group relative bg-gradient-to-r from-green-500 to-emerald-700 hover:from-green-600 hover:to-emerald-800 text-white p-6 rounded-2xl font-semibold transition-all duration-300 flex items-center shadow-lg hover:shadow-2xl transform hover:-translate-y-1">
                        <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mr-4 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        </div>
                        <div class="text-left">
                            <div class="font-bold text-lg">View Orders</div>
                            <div class="text-green-100 text-sm">Sales & transactions</div>
                        </div>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced Navigation Tabs -->
    <div class="bg-white/80 backdrop-blur-lg shadow-xl border-b border-gray-200/50 sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex space-x-1" aria-label="Tabs">
                <button wire:click="setActiveTab('packages')" 
                        class="group relative py-6 px-6 font-semibold text-sm transition-all duration-300 {{ $activeTab === 'packages' ? 'text-red-600' : 'text-gray-500 hover:text-gray-700' }}">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-2xl flex items-center justify-center transition-all duration-300 {{ $activeTab === 'packages' ? 'bg-red-100' : 'bg-gray-100 group-hover:bg-gray-200' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                        </div>
                        <div>
                            <div class="font-bold">Equipment</div>
                            <div class="text-xs text-gray-400">Product catalog</div>
                        </div>
                    </div>
                    @if($activeTab === 'packages')
                        <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-red-500 to-red-700 rounded-t-full"></div>
                    @endif
                </button>
                
                <button wire:click="setActiveTab('users')" 
                        class="group relative py-6 px-6 font-semibold text-sm transition-all duration-300 {{ $activeTab === 'users' ? 'text-blue-600' : 'text-gray-500 hover:text-gray-700' }}">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-2xl flex items-center justify-center transition-all duration-300 {{ $activeTab === 'users' ? 'bg-blue-100' : 'bg-gray-100 group-hover:bg-gray-200' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                            </svg>
                        </div>
                        <div>
                            <div class="font-bold">Customers</div>
                            <div class="text-xs text-gray-400">User management</div>
                        </div>
                    </div>
                    @if($activeTab === 'users')
                        <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-blue-500 to-blue-700 rounded-t-full"></div>
                    @endif
                </button>
                
                <button wire:click="setActiveTab('orders')" 
                        class="group relative py-6 px-6 font-semibold text-sm transition-all duration-300 {{ $activeTab === 'orders' ? 'text-green-600' : 'text-gray-500 hover:text-gray-700' }}">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-2xl flex items-center justify-center transition-all duration-300 {{ $activeTab === 'orders' ? 'bg-green-100' : 'bg-gray-100 group-hover:bg-gray-200' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <div>
                            <div class="font-bold">Orders</div>
                            <div class="text-xs text-gray-400">Sales & transactions</div>
                        </div>
                    </div>
                    @if($activeTab === 'orders')
                        <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-green-500 to-green-700 rounded-t-full"></div>
                    @endif
                </button>
                
                <button wire:click="setActiveTab('analytics')" 
                        class="group relative py-6 px-6 font-semibold text-sm transition-all duration-300 {{ $activeTab === 'analytics' ? 'text-purple-600' : 'text-gray-500 hover:text-gray-700' }}">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-2xl flex items-center justify-center transition-all duration-300 {{ $activeTab === 'analytics' ? 'bg-purple-100' : 'bg-gray-100 group-hover:bg-gray-200' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </div>
                        <div>
                            <div class="font-bold">Analytics</div>
                            <div class="text-xs text-gray-400">Performance data</div>
                        </div>
                    </div>
                    @if($activeTab === 'analytics')
                        <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-purple-500 to-purple-700 rounded-t-full"></div>
                    @endif
                </button>
            </nav>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Enhanced Success/Error Messages -->
        @if (session()->has('success'))
            <div class="mb-8 bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-2xl p-6 shadow-2xl border border-green-200">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center mr-4">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div>
                        <div class="font-bold text-lg">Success!</div>
                        <div class="text-green-100">{{ session('success') }}</div>
                    </div>
                </div>
            </div>
        @endif

        @if (session()->has('error'))
            <div class="mb-8 bg-gradient-to-r from-red-500 to-pink-600 text-white rounded-2xl p-6 shadow-2xl border border-red-200">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center mr-4">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div>
                        <div class="font-bold text-lg">Error!</div>
                        <div class="text-red-100">{{ session('error') }}</div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Enhanced Packages Tab -->
        @if($activeTab === 'packages')
            <div class="bg-gradient-to-br from-white to-red-50 shadow-2xl overflow-hidden rounded-3xl border border-red-100">
                <div class="bg-gradient-to-r from-red-500 to-red-700 px-8 py-8 text-white">
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="text-3xl font-bold mb-2">Equipment Management</h3>
                            <p class="text-red-100 text-lg">Manage your gym equipment catalog and inventory</p>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="text-right">
                                <div class="text-3xl font-bold">{{ $packages->total() ?? 0 }}</div>
                                <div class="text-red-200 text-sm">Total Products</div>
                            </div>
                            <button wire:click="openCreatePackageModal" 
                                    class="bg-white/20 hover:bg-white/30 backdrop-blur-sm text-white font-bold py-4 px-6 rounded-2xl transition-all duration-300 transform hover:scale-105 flex items-center shadow-lg">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                                Add Equipment
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Enhanced Search and Filter Section -->
                <div class="p-8 bg-gradient-to-r from-gray-50 to-red-50">
                    <div class="flex flex-col lg:flex-row gap-6">
                        <div class="flex-1">
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                    </svg>
                                </div>
                                <input wire:model.live="search" 
                                       type="text" 
                                       placeholder="Search equipment by name, brand, or category..." 
                                       class="w-full pl-12 pr-4 py-4 bg-white border border-gray-200 rounded-2xl shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent text-lg">
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <select wire:model.live="filterCategory" 
                                    class="px-6 py-4 bg-white border border-gray-200 rounded-2xl shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent text-lg">
                                <option value="">All Categories</option>
                                <option value="cardio">Cardio Equipment</option>
                                <option value="strength">Strength Training</option>
                                <option value="accessories">Accessories</option>
                                <option value="supplements">Supplements</option>
                            </select>
                            <button class="px-6 py-4 bg-gradient-to-r from-red-500 to-red-700 text-white rounded-2xl hover:from-red-600 hover:to-red-800 transition-all duration-300 shadow-lg">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Enhanced Equipment Grid -->
                <div class="p-8">
                    @if($packages && $packages->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                            @foreach($packages as $package)
                                <div class="group bg-white rounded-3xl shadow-xl hover:shadow-2xl transition-all duration-500 overflow-hidden border border-gray-100 hover:border-red-200 transform hover:-translate-y-2">
                                    <div class="relative">
                                        <div class="aspect-w-16 aspect-h-10 bg-gradient-to-br from-gray-200 to-gray-300">
                                            <img src="{{ $package->main_image_url }}" alt="{{ $package->name }}" 
                                                 class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-500">
                                        </div>
                                        <div class="absolute top-4 right-4">
                                            <span class="bg-{{ $package->is_active ? 'green' : 'red' }}-500 text-white px-3 py-1 rounded-full text-xs font-bold shadow-lg">
                                                {{ $package->is_active ? 'Active' : 'Inactive' }}
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <div class="p-6">
                                        <div class="mb-4">
                                            <h4 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-red-600 transition-colors duration-300">
                                                {{ $package->name }}
                                            </h4>
                                            <p class="text-gray-600 text-sm line-clamp-3">{{ $package->description }}</p>
                                        </div>
                                        
                                        <div class="flex items-center justify-between mb-4">
                                            <div>
                                                <span class="text-3xl font-bold text-red-600">${{ number_format($package->price ?? 0, 2) }}</span>
                                            </div>
                                            <div class="text-right">
                                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                                    {{ $package->category === 'cardio' ? 'bg-red-100 text-red-800' : 
                                                       ($package->category === 'strength' ? 'bg-green-100 text-green-800' : 
                                                       ($package->category === 'accessories' ? 'bg-blue-100 text-blue-800' : 
                                                       ($package->category === 'supplements' ? 'bg-purple-100 text-purple-800' : 'bg-gray-100 text-gray-800'))) }}">
                                                    {{ ucfirst($package->category) }}
                                                </span>
                                            </div>
                                        </div>
                                        
                                        <div class="flex space-x-2">
                                            <button wire:click="openEditPackageModal({{ $package->id }})" 
                                                    class="flex-1 bg-gradient-to-r from-blue-500 to-blue-700 text-white px-4 py-3 rounded-xl hover:from-blue-600 hover:to-blue-800 transition-all duration-300 font-semibold shadow-lg hover:shadow-xl transform hover:scale-105">
                                                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                                Edit
                                            </button>
                                            <button wire:click="confirmPackageDeletion({{ $package->id }})" 
                                                    class="flex-1 bg-gradient-to-r from-red-500 to-red-700 text-white px-4 py-3 rounded-xl hover:from-red-600 hover:to-red-800 transition-all duration-300 font-semibold shadow-lg hover:shadow-xl transform hover:scale-105">
                                                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                                Delete
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Enhanced Pagination -->
                        @if($packages->hasPages())
                            <div class="mt-12 flex justify-center">
                                <div class="bg-white rounded-2xl shadow-lg px-6 py-4">
                                    {{ $packages->links() }}
                                </div>
                            </div>
                        @endif
                    @else
                        <div class="text-center py-20">
                            <div class="bg-gradient-to-br from-gray-100 to-gray-200 rounded-3xl p-12 max-w-md mx-auto">
                                <svg class="w-24 h-24 text-gray-400 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                </svg>
                                <h3 class="text-2xl font-bold text-gray-600 mb-4">No Equipment Found</h3>
                                <p class="text-gray-500 mb-8">Start building your gym equipment catalog by adding your first product.</p>
                                <button wire:click="openCreatePackageModal" 
                                        class="bg-gradient-to-r from-red-500 to-red-700 text-white font-bold py-4 px-8 rounded-2xl hover:from-red-600 hover:to-red-800 transition-all duration-300 transform hover:scale-105 shadow-lg">
                                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                    </svg>
                                    Add First Equipment
                                </button>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endif

        <!-- Enhanced Users Tab -->
        @if($activeTab === 'users')
            <div class="bg-gradient-to-br from-white to-blue-50 shadow-2xl overflow-hidden rounded-3xl border border-blue-100">
                <div class="bg-gradient-to-r from-blue-500 to-blue-700 px-8 py-8 text-white">
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="text-3xl font-bold mb-2">User Management</h3>
                            <p class="text-blue-100 text-lg">Manage customer accounts and user permissions</p>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="text-right">
                                <div class="text-3xl font-bold">{{ Auth::user()->count() ?? 0 }}</div>
                                <div class="text-blue-200 text-sm">Total Users</div>
                            </div>
                            <button wire:click="openCreateUserModal" 
                                    class="bg-white/20 hover:bg-white/30 backdrop-blur-sm text-white font-bold py-4 px-6 rounded-2xl transition-all duration-300 transform hover:scale-105 flex items-center shadow-lg">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                                </svg>
                                Add User
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Enhanced Content -->
                <div class="p-8">
                    <div class="text-center py-20">
                        <div class="bg-gradient-to-br from-blue-100 to-blue-200 rounded-3xl p-12 max-w-md mx-auto">
                            <svg class="w-24 h-24 text-blue-400 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                            </svg>
                            <h3 class="text-2xl font-bold text-blue-600 mb-4">User Management System</h3>
                            <p class="text-blue-500 mb-8">Advanced user management functionality with role-based permissions coming soon.</p>
                            <div class="grid grid-cols-2 gap-4 text-sm">
                                <div class="bg-white/60 rounded-xl p-4">
                                    <div class="text-2xl font-bold text-blue-600">{{ \App\Models\User::count() }}</div>
                                    <div class="text-blue-500">Total Users</div>
                                </div>
                                <div class="bg-white/60 rounded-xl p-4">
                                    <div class="text-2xl font-bold text-green-600">{{ \App\Models\User::where('is_admin', true)->count() }}</div>
                                    <div class="text-green-500">Admins</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Enhanced Orders Tab -->
        @if($activeTab === 'orders')
            <div class="bg-gradient-to-br from-white to-green-50 shadow-2xl overflow-hidden rounded-3xl border border-green-100">
                <div class="bg-gradient-to-r from-green-500 to-green-700 px-8 py-8 text-white">
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="text-3xl font-bold mb-2">Order Management</h3>
                            <p class="text-green-100 text-lg">Track and manage customer orders and payments</p>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="text-right">
                                <div class="text-3xl font-bold">{{ \App\Models\Order::count() ?? 0 }}</div>
                                <div class="text-green-200 text-sm">Total Orders</div>
                            </div>
                            <button class="bg-white/20 hover:bg-white/30 backdrop-blur-sm text-white font-bold py-4 px-6 rounded-2xl transition-all duration-300 transform hover:scale-105 flex items-center shadow-lg">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                Export Orders
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Enhanced Content -->
                <div class="p-8">
                    <div class="text-center py-20">
                        <div class="bg-gradient-to-br from-green-100 to-green-200 rounded-3xl p-12 max-w-md mx-auto">
                            <svg class="w-24 h-24 text-green-400 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <h3 class="text-2xl font-bold text-green-600 mb-4">Order Management System</h3>
                            <p class="text-green-500 mb-8">Comprehensive order tracking and management system with analytics.</p>
                            <div class="grid grid-cols-2 gap-4 text-sm">
                                <div class="bg-white/60 rounded-xl p-4">
                                    <div class="text-2xl font-bold text-green-600">{{ \App\Models\Order::count() ?? 0 }}</div>
                                    <div class="text-green-500">Total Orders</div>
                                </div>
                                <div class="bg-white/60 rounded-xl p-4">
                                    <div class="text-2xl font-bold text-blue-600">${{ number_format(\App\Models\Order::sum('total_amount') ?? 0, 0) }}</div>
                                    <div class="text-blue-500">Revenue</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Analytics Tab -->
        @if($activeTab === 'analytics')
            <div class="bg-white shadow-lg overflow-hidden sm:rounded-lg">
                <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                    <div>
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Analytics & Reports</h3>
                        <p class="mt-1 max-w-2xl text-sm text-gray-500">View detailed analytics and reports</p>
                    </div>
                </div>

                <!-- Analytics content placeholder -->
                <div class="p-6">
                    <div class="text-center py-12">
                        <svg class="w-12 h-12 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                        <p class="text-lg font-medium text-gray-900">Analytics Dashboard</p>
                        <p class="text-sm text-gray-500">Analytics and reporting functionality will be implemented here</p>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Include existing modals and components here -->
    @include('livewire.partials.package-modal')
    @include('livewire.partials.user-modal')
    @include('livewire.partials.delete-confirmation-modal')

    <!-- Notification Script -->
    <script>
        function showNotification(message, type) {
            // Create notification element
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 p-4 rounded-lg shadow-lg z-50 transform transition-all duration-300 ${
                type === 'success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white'
            }`;
            notification.textContent = message;
            
            // Add to DOM
            document.body.appendChild(notification);
            
            // Animate in
            setTimeout(() => {
                notification.style.transform = 'translateX(0)';
            }, 100);
            
            // Remove after 3 seconds
            setTimeout(() => {
                notification.style.transform = 'translateX(100%)';
                setTimeout(() => {
                    document.body.removeChild(notification);
                }, 300);
            }, 3000);
        }

        // Listen for Livewire events
        document.addEventListener('livewire:init', () => {
            Livewire.on('show-message', (event) => {
                showNotification(event[0].message, event[0].type);
            });
        });
    </script>

    @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                showNotification(@json(session('success')), 'success');
            });
        </script>
    @endif

    @if(session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                showNotification(@json(session('error')), 'error');
            });
        </script>
    @endif

    <!-- Create Product Modal -->
    @if($showCreateModal)
        <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50" wire:click="closeModals">
            <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-3xl bg-white" wire:click.stop>
                <div class="bg-gradient-to-r from-red-500 to-red-700 -m-5 mb-5 p-8 rounded-t-3xl text-white">
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="text-3xl font-bold">Add New Equipment</h3>
                            <p class="text-red-100 text-lg mt-2">Add a new gym equipment product to your inventory</p>
                        </div>
                        <button wire:click="closeModals" class="text-white hover:text-red-200 transition-colors duration-200">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <form wire:submit.prevent="createPackage" class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Product Name -->
                        <div class="md:col-span-2">
                            <label for="name" class="block text-sm font-bold text-gray-700 mb-2">Product Name</label>
                            <input type="text" 
                                   wire:model="name" 
                                   id="name"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500"
                                   placeholder="Enter product name..."
                                   required>
                            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Category -->
                        <div>
                            <label for="category" class="block text-sm font-bold text-gray-700 mb-2">Category</label>
                            <select wire:model="category" 
                                    id="category"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500">
                                <option value="">Select Category</option>
                                <option value="cardio">Cardio Equipment</option>
                                <option value="strength">Strength Training</option>
                                <option value="accessories">Accessories</option>
                                <option value="supplements">Supplements</option>
                            </select>
                            @error('category') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Price -->
                        <div>
                            <label for="price" class="block text-sm font-bold text-gray-700 mb-2">Price ($)</label>
                            <input type="number" 
                                   wire:model="price" 
                                   id="price"
                                   step="0.01"
                                   min="0"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500"
                                   placeholder="0.00"
                                   required>
                            @error('price') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Brand -->
                        <div>
                            <label for="brand" class="block text-sm font-bold text-gray-700 mb-2">Brand</label>
                            <input type="text" 
                                   wire:model="brand" 
                                   id="brand"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500"
                                   placeholder="Enter brand name...">
                            @error('brand') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Model -->
                        <div>
                            <label for="model" class="block text-sm font-bold text-gray-700 mb-2">Model</label>
                            <input type="text" 
                                   wire:model="model" 
                                   id="model"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500"
                                   placeholder="Enter model...">
                            @error('model') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Stock Quantity -->
                        <div>
                            <label for="stock_quantity" class="block text-sm font-bold text-gray-700 mb-2">Stock Quantity</label>
                            <input type="number" 
                                   wire:model="stock_quantity" 
                                   id="stock_quantity"
                                   min="0"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500"
                                   placeholder="0">
                            @error('stock_quantity') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Description -->
                        <div class="md:col-span-2">
                            <label for="description" class="block text-sm font-bold text-gray-700 mb-2">Description</label>
                            <textarea wire:model="description" 
                                      id="description"
                                      rows="4"
                                      class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500"
                                      placeholder="Enter product description..."
                                      required></textarea>
                            @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Features -->
                        <div class="md:col-span-2">
                            <label for="features" class="block text-sm font-bold text-gray-700 mb-2">Features (one per line)</label>
                            <textarea wire:model="features" 
                                      id="features"
                                      rows="3"
                                      class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500"
                                      placeholder="Enter features, one per line..."></textarea>
                            @error('features') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Product Images -->
                        <div class="md:col-span-2">
                            <label for="image" class="block text-sm font-bold text-gray-700 mb-2">Product Images</label>
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-xl hover:border-red-400 transition-colors duration-200">
                                <div class="space-y-1 text-center">
                                    @if ($image)
                                        <div class="mb-4">
                                            <img src="{{ $image->temporaryUrl() }}" class="mx-auto h-32 w-auto rounded-lg shadow-md">
                                            <p class="mt-2 text-sm text-gray-600">Image preview</p>
                                        </div>
                                    @else
                                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    @endif
                                    <div class="flex text-sm text-gray-600">
                                        <label for="image" class="relative cursor-pointer bg-white rounded-md font-medium text-red-600 hover:text-red-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-red-500">
                                            <span>Upload product image</span>
                                            <input id="image" wire:model="image" type="file" class="sr-only" accept="image/*">
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>
                                    <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB</p>
                                </div>
                            </div>
                            @error('image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Status -->
                        <div class="md:col-span-2">
                            <label class="flex items-center">
                                <input type="checkbox" 
                                       wire:model="is_active" 
                                       class="rounded border-gray-300 text-red-600 shadow-sm focus:border-red-300 focus:ring focus:ring-red-200 focus:ring-opacity-50">
                                <span class="ml-2 text-sm text-gray-700 font-medium">Product is active and available for sale</span>
                            </label>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex justify-end space-x-4 mt-8 pt-6 border-t border-gray-200">
                        <button type="button" 
                                wire:click="closeModals"
                                class="px-6 py-3 bg-gray-500 text-white rounded-xl hover:bg-gray-600 transition-colors duration-200 font-semibold">
                            Cancel
                        </button>
                        <button type="submit"
                                class="px-8 py-3 bg-gradient-to-r from-red-500 to-red-700 text-white rounded-xl hover:from-red-600 hover:to-red-800 transition-all duration-200 font-semibold shadow-lg transform hover:scale-105">
                            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            Create Product
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <!-- Edit Product Modal -->
    @if($showEditModal)
        <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50" wire:click="closeModals">
            <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-3xl bg-white" wire:click.stop>
                <div class="bg-gradient-to-r from-blue-500 to-blue-700 -m-5 mb-5 p-8 rounded-t-3xl text-white">
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="text-3xl font-bold">Edit Equipment</h3>
                            <p class="text-blue-100 text-lg mt-2">Update equipment product information</p>
                        </div>
                        <button wire:click="closeModals" class="text-white hover:text-blue-200 transition-colors duration-200">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <form wire:submit.prevent="updatePackage" class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Product Name -->
                        <div class="md:col-span-2">
                            <label for="edit_name" class="block text-sm font-bold text-gray-700 mb-2">Product Name</label>
                            <input type="text" 
                                   wire:model="name" 
                                   id="edit_name"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="Enter product name..."
                                   required>
                            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Category -->
                        <div>
                            <label for="edit_category" class="block text-sm font-bold text-gray-700 mb-2">Category</label>
                            <select wire:model="category" 
                                    id="edit_category"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Select Category</option>
                                <option value="cardio">Cardio Equipment</option>
                                <option value="strength">Strength Training</option>
                                <option value="accessories">Accessories</option>
                                <option value="supplements">Supplements</option>
                            </select>
                            @error('category') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Price -->
                        <div>
                            <label for="edit_price" class="block text-sm font-bold text-gray-700 mb-2">Price ($)</label>
                            <input type="number" 
                                   wire:model="price" 
                                   id="edit_price"
                                   step="0.01"
                                   min="0"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="0.00"
                                   required>
                            @error('price') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Brand -->
                        <div>
                            <label for="edit_brand" class="block text-sm font-bold text-gray-700 mb-2">Brand</label>
                            <input type="text" 
                                   wire:model="brand" 
                                   id="edit_brand"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="Enter brand name...">
                            @error('brand') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Model -->
                        <div>
                            <label for="edit_model" class="block text-sm font-bold text-gray-700 mb-2">Model</label>
                            <input type="text" 
                                   wire:model="model" 
                                   id="edit_model"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="Enter model...">
                            @error('model') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Stock Quantity -->
                        <div>
                            <label for="edit_stock_quantity" class="block text-sm font-bold text-gray-700 mb-2">Stock Quantity</label>
                            <input type="number" 
                                   wire:model="stock_quantity" 
                                   id="edit_stock_quantity"
                                   min="0"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="0">
                            @error('stock_quantity') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Description -->
                        <div class="md:col-span-2">
                            <label for="edit_description" class="block text-sm font-bold text-gray-700 mb-2">Description</label>
                            <textarea wire:model="description" 
                                      id="edit_description"
                                      rows="4"
                                      class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                      placeholder="Enter product description..."
                                      required></textarea>
                            @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Features -->
                        <div class="md:col-span-2">
                            <label for="edit_features" class="block text-sm font-bold text-gray-700 mb-2">Features (one per line)</label>
                            <textarea wire:model="features" 
                                      id="edit_features"
                                      rows="3"
                                      class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                      placeholder="Enter features, one per line..."></textarea>
                            @error('features') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Product Images -->
                        <div class="md:col-span-2">
                            <label for="edit_image" class="block text-sm font-bold text-gray-700 mb-2">Product Images</label>
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-xl hover:border-blue-400 transition-colors duration-200">
                                <div class="space-y-1 text-center">
                                    @if ($image)
                                        <div class="mb-4">
                                            <img src="{{ $image->temporaryUrl() }}" class="mx-auto h-32 w-auto rounded-lg shadow-md">
                                            <p class="mt-2 text-sm text-gray-600">New image preview</p>
                                        </div>
                                    @elseif ($editingPackage && $editingPackage->main_image)
                                        <div class="mb-4">
                                            <img src="{{ $editingPackage->main_image }}" class="mx-auto h-32 w-auto rounded-lg shadow-md">
                                            <p class="mt-2 text-sm text-gray-600">Current image</p>
                                        </div>
                                    @else
                                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    @endif
                                    <div class="flex text-sm text-gray-600">
                                        <label for="edit_image" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-blue-500">
                                            <span>{{ $editingPackage && $editingPackage->main_image ? 'Change image' : 'Upload product image' }}</span>
                                            <input id="edit_image" wire:model="image" type="file" class="sr-only" accept="image/*">
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>
                                    <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB</p>
                                </div>
                            </div>
                            @error('image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Status -->
                        <div class="md:col-span-2">
                            <label class="flex items-center">
                                <input type="checkbox" 
                                       wire:model="is_active" 
                                       class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                <span class="ml-2 text-sm text-gray-700 font-medium">Product is active and available for sale</span>
                            </label>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex justify-end space-x-4 mt-8 pt-6 border-t border-gray-200">
                        <button type="button" 
                                wire:click="closeModals"
                                class="px-6 py-3 bg-gray-500 text-white rounded-xl hover:bg-gray-600 transition-colors duration-200 font-semibold">
                            Cancel
                        </button>
                        <button type="submit"
                                class="px-8 py-3 bg-gradient-to-r from-blue-500 to-blue-700 text-white rounded-xl hover:from-blue-600 hover:to-blue-800 transition-all duration-200 font-semibold shadow-lg transform hover:scale-105">
                            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Update Product
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <!-- Delete Confirmation Modal -->
    @if($showDeleteModal)
        <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50" wire:click="closeModals">
            <div class="relative top-1/2 transform -translate-y-1/2 mx-auto p-5 border w-96 shadow-lg rounded-3xl bg-white" wire:click.stop>
                <div class="text-center">
                    <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 mb-4">
                        <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Delete Product</h3>
                    <p class="text-sm text-gray-500 mb-6">
                        Are you sure you want to delete this product? This action cannot be undone.
                    </p>
                    <div class="flex justify-center space-x-4">
                        <button wire:click="closeModals"
                                class="px-6 py-3 bg-gray-300 text-gray-700 rounded-xl hover:bg-gray-400 transition-colors duration-200 font-semibold">
                            Cancel
                        </button>
                        <button wire:click="deletePackage"
                                class="px-6 py-3 bg-gradient-to-r from-red-500 to-red-700 text-white rounded-xl hover:from-red-600 hover:to-red-800 transition-all duration-200 font-semibold shadow-lg">
                            Delete
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>