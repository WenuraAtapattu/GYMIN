<div class="min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-red-900">
    <!-- Profile Header -->
    <div class="bg-gradient-to-r from-red-600 via-red-700 to-red-800 shadow-2xl">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex items-center space-x-6">
                <!-- Profile Avatar -->
                <div class="flex-shrink-0">
                    <div class="w-24 h-24 bg-white rounded-full flex items-center justify-center shadow-lg">
                        <span class="text-3xl font-bold text-red-600">{{ strtoupper(substr($user->name, 0, 2)) }}</span>
                    </div>
                </div>
                
                <!-- Profile Info -->
                <div class="flex-1">
                    <h1 class="text-4xl font-bold text-white mb-2">{{ $user->name }}</h1>
                    <p class="text-red-100 text-lg mb-2">{{ $user->email }}</p>
                    <p class="text-red-200 text-sm">Member since {{ $user->created_at->format('F Y') }}</p>
                </div>
                
                <!-- Quick Stats -->
                <div class="hidden lg:flex items-center space-x-8">
                    <div class="text-center">
                        <div class="text-3xl font-bold text-white">{{ $stats['total_orders'] }}</div>
                        <div class="text-red-100 text-sm">Orders</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-white">${{ number_format($stats['total_spent'], 0) }}</div>
                        <div class="text-red-100 text-sm">Total Spent</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Personal Stats -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Cart Items -->
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-6 text-white shadow-xl transform hover:scale-105 transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-100 text-sm font-medium">Cart Items</p>
                        <p class="text-3xl font-bold">{{ $stats['cart_items'] }}</p>
                    </div>
                    <div class="bg-blue-400 bg-opacity-30 rounded-xl p-3">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m0 0h8"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Total Orders -->
            <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl p-6 text-white shadow-xl transform hover:scale-105 transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-green-100 text-sm font-medium">Total Orders</p>
                        <p class="text-3xl font-bold">{{ $stats['total_orders'] }}</p>
                    </div>
                    <div class="bg-green-400 bg-opacity-30 rounded-xl p-3">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Pending Orders -->
            <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-2xl p-6 text-white shadow-xl transform hover:scale-105 transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-yellow-100 text-sm font-medium">Pending Orders</p>
                        <p class="text-3xl font-bold">{{ $stats['pending_orders'] }}</p>
                    </div>
                    <div class="bg-yellow-400 bg-opacity-30 rounded-xl p-3">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Total Spent -->
            <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl p-6 text-white shadow-xl transform hover:scale-105 transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-purple-100 text-sm font-medium">Total Spent</p>
                        <p class="text-2xl font-bold">${{ number_format($stats['total_spent'], 2) }}</p>
                    </div>
                    <div class="bg-purple-400 bg-opacity-30 rounded-xl p-3">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Profile Information -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                    <div class="bg-gradient-to-r from-red-600 to-red-700 px-6 py-4">
                        <h2 class="text-xl font-bold text-white flex items-center">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            Profile Information
                        </h2>
                    </div>
                    
                    <div class="p-6">
                        <div class="space-y-6">
                            <!-- Personal Details -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                                    <div class="bg-gray-50 rounded-lg p-3 border">
                                        <span class="text-gray-900 font-medium">{{ $user->name }}</span>
                                    </div>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                                    <div class="bg-gray-50 rounded-lg p-3 border">
                                        <span class="text-gray-900">{{ $user->email }}</span>
                                    </div>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Member Since</label>
                                    <div class="bg-gray-50 rounded-lg p-3 border">
                                        <span class="text-gray-900">{{ $user->created_at->format('F d, Y') }}</span>
                                    </div>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Account Status</label>
                                    <div class="bg-gray-50 rounded-lg p-3 border">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                            </svg>
                                            Active
                                        </span>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Quick Actions -->
                            <div class="border-t pt-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Quick Actions</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <a href="{{ route('profile.show') }}" 
                                       class="flex items-center p-4 bg-blue-50 hover:bg-blue-100 rounded-lg transition-colors duration-200">
                                        <svg class="w-6 h-6 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                        <span class="font-medium text-blue-900">Edit Profile</span>
                                    </a>
                                    
                                    <a href="{{ route('products.index') }}" 
                                       class="flex items-center p-4 bg-green-50 hover:bg-green-100 rounded-lg transition-colors duration-200">
                                        <svg class="w-6 h-6 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                        </svg>
                                        <span class="font-medium text-green-900">Browse Equipment</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Cart Items -->
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4">
                        <h2 class="text-xl font-bold text-white flex items-center">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m0 0h8"/>
                            </svg>
                            My Cart ({{ $stats['cart_items'] }})
                        </h2>
                    </div>
                    
                    <div class="p-6">
                        @forelse($cartItems as $item)
                            <div class="flex items-center space-x-4 mb-4 p-3 bg-gray-50 rounded-lg">
                                <img src="{{ $item->product->main_image_url }}" alt="{{ $item->product->name }}" 
                                     class="w-12 h-12 object-cover rounded-lg">
                                <div class="flex-1">
                                    <h4 class="font-medium text-gray-900 text-sm">{{ Str::limit($item->product->name, 30) }}</h4>
                                    <p class="text-gray-600 text-xs">Qty: {{ $item->quantity }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold text-gray-900 text-sm">${{ number_format($item->total_price, 2) }}</p>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8">
                                <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m0 0h8"/>
                                </svg>
                                <p class="text-gray-500 text-sm">Your cart is empty</p>
                            </div>
                        @endforelse
                        
                        @if(count($cartItems) > 0)
                            <div class="mt-6">
                                <a href="{{ route('cart') }}" 
                                   class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 px-4 rounded-lg font-medium text-center block transition-colors duration-200">
                                    View Full Cart
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Recent Orders -->
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                    <div class="bg-gradient-to-r from-green-600 to-green-700 px-6 py-4">
                        <h2 class="text-xl font-bold text-white flex items-center">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                            Recent Orders
                        </h2>
                    </div>
                    
                    <div class="p-6">
                        @forelse($recentOrders as $order)
                            <div class="mb-4 p-3 bg-gray-50 rounded-lg">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="font-medium text-gray-900 text-sm">Order #{{ $order->id }}</p>
                                        <p class="text-gray-600 text-xs">{{ $order->created_at->format('M d, Y') }}</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-bold text-gray-900 text-sm">${{ number_format($order->total_amount, 2) }}</p>
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium 
                                            @if($order->status === 'completed') bg-green-100 text-green-800
                                            @elseif($order->status === 'pending') bg-yellow-100 text-yellow-800
                                            @else bg-gray-100 text-gray-800 @endif">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8">
                                <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                </svg>
                                <p class="text-gray-500 text-sm">No orders yet</p>
                            </div>
                        @endforelse
                        
                        @if(count($recentOrders) > 0)
                            <div class="mt-4 text-center">
                                <a href="{{ route('user.orders') }}" class="text-green-600 hover:text-green-800 text-sm font-medium">
                                    View all orders →
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
