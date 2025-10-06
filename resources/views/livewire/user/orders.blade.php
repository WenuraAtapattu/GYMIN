@section('title', 'My Orders')

<div class="min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-red-900 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <!-- Page Header -->
        <div class="mb-8 text-center">
            <h1 class="text-3xl font-bold text-white mb-2">My Orders</h1>
            <p class="text-gray-300">View and manage your order history</p>
        </div>

        <!-- Status Filters -->
        <div class="bg-white rounded-lg shadow-md p-4 mb-8">
            <div class="flex flex-wrap justify-center gap-2">
                <button wire:click="updateStatusFilter('all')" 
                        class="px-4 py-2 rounded-full text-sm font-medium transition-colors duration-200
                               {{ $statusFilter === 'all' ? 'bg-red-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    All Orders
                </button>
                <button wire:click="updateStatusFilter('pending')" 
                        class="px-4 py-2 rounded-full text-sm font-medium transition-colors duration-200
                               {{ $statusFilter === 'pending' ? 'bg-yellow-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    Pending
                </button>
                <button wire:click="updateStatusFilter('processing')" 
                        class="px-4 py-2 rounded-full text-sm font-medium transition-colors duration-200
                               {{ $statusFilter === 'processing' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    Processing
                </button>
                <button wire:click="updateStatusFilter('completed')" 
                        class="px-4 py-2 rounded-full text-sm font-medium transition-colors duration-200
                               {{ $statusFilter === 'completed' ? 'bg-green-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    Completed
                </button>
                <button wire:click="updateStatusFilter('cancelled')" 
                        class="px-4 py-2 rounded-full text-sm font-medium transition-colors duration-200
                               {{ $statusFilter === 'cancelled' ? 'bg-gray-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    Cancelled
                </button>
            </div>
        </div>

        <!-- Orders List -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            @if($orders->count() > 0)
                <div class="divide-y divide-gray-200">
                    @foreach($orders as $order)
                        <div class="p-6 hover:bg-gray-50 transition-colors duration-200">
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                                <div class="flex-1">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            <div class="w-28 h-28 bg-white rounded-lg border border-gray-200 overflow-hidden flex items-center justify-center shadow-sm">
                                                @php
                                                    $imageUrl = null;
                                                    if ($order->product) {
                                                        $imageUrl = $order->product->main_image 
                                                            ? asset('storage/' . $order->product->main_image)
                                                            : ($order->product->images && is_array($order->product->images) && count($order->product->images) > 0 
                                                                ? asset('storage/' . $order->product->images[0])
                                                                : null);
                                                    }
                                                @endphp
                                                
                                                @if($imageUrl)
                                                    <img src="{{ $imageUrl }}" 
                                                         alt="{{ $order->product->name ?? 'Product Image' }}" 
                                                         class="max-w-full max-h-full object-contain p-2 transition-transform duration-200 hover:scale-105"
                                                         loading="lazy"
                                                         onerror="this.onerror=null; this.src='{{ asset('images/placeholder-product.png') }}'">
                                                @else
                                                    <div class="w-full h-full flex items-center justify-center bg-gray-50">
                                                        <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                        </svg>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <h3 class="text-lg font-medium text-gray-900">
                                                {{ $order->product->name ?? 'Product Not Available' }}
                                            </h3>
                                            <p class="text-sm text-gray-500">Order #{{ $order->id }}</p>
                                            <p class="text-sm text-gray-500">
                                                {{ $order->created_at->format('F d, Y \a\t h:i A') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4 md:mt-0 md:ml-6 text-right">
                                    <p class="text-lg font-medium text-gray-900">
                                        ${{ number_format($order->total_amount, 2) }}
                                    </p>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium mt-1
                                        {{ $order->status === 'completed' ? 'bg-green-100 text-green-800' : '' }}
                                        {{ $order->status === 'processing' ? 'bg-blue-100 text-blue-800' : '' }}
                                        {{ $order->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                        {{ $order->status === 'cancelled' ? 'bg-gray-100 text-gray-800' : '' }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </div>
                            </div>
                            <div class="mt-4 pt-4 border-t border-gray-100">
                                <div class="flex justify-end space-x-3">
                                    <a href="{{ route('orders.show', $order->id) }}" 
                                       class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200">
                                        View Details
                                    </a>
                                    @if($order->status === 'pending')
                                        <button type="button" 
                                                class="inline-flex items-center px-3 py-1.5 border border-gray-300 shadow-sm text-xs font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200">
                                            Cancel Order
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-16">
                    <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    <h3 class="mt-2 text-lg font-medium text-gray-900">No orders found</h3>
                    <p class="mt-1 text-gray-500">
                        {{ $statusFilter === 'all' 
                            ? 'You haven\'t placed any orders yet.' 
                            : "You don't have any {$statusFilter} orders." }}
                    </p>
                    <div class="mt-6">
                        <a href="{{ route('products.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200">
                            <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m0 0h8"></path>
                            </svg>
                            Continue Shopping
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
