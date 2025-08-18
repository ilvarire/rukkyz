<div>
    <!-- Orders Section -->
    <section class="pt-20 py-16">
        <div class="max-w-7xl mx-auto px-4">
            <h1 class="text-3xl font-bold text-african-green mb-8">Order History</h1>

            <!-- Order Filters -->
            <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
                <div class="flex flex-wrap gap-4 justify-center">
                    <button class="bg-african-green text-white px-6 py-2 rounded-lg font-semibold">All Orders</button>
                    <button
                        class="bg-gray-200 text-gray-700 hover:bg-african-green hover:text-white px-6 py-2 rounded-lg font-semibold transition duration-300">Payments</button>
                    {{-- <button
                        class="bg-gray-200 text-gray-700 hover:bg-african-green hover:text-white px-6 py-2 rounded-lg font-semibold transition duration-300">Completed</button>
                    <button
                        class="bg-gray-200 text-gray-700 hover:bg-african-green hover:text-white px-6 py-2 rounded-lg font-semibold transition duration-300">Cancelled</button>
                    --}}
                </div>
            </div>

            <!-- Orders List -->
            <div class="space-y-6">
                @forelse ($orders as $order)
                    <!-- Active Order -->
                    <div class="bg-white rounded-lg shadow-lg p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-xl font-semibold text-african-green">{{$order->reference}}</h3>
                                <p class="text-gray-600">{{$order->created_at}}</p>
                            </div>
                            <div class="text-right">
                                @if ($order->status === 'pending' || $order->status === 'processed' || $order->status === 'shipped')
                                    <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold">
                                        Active
                                    </span>
                                @elseif($order->status === 'delivered')
                                    <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-semibold">
                                        Completed
                                    </span>
                                @elseif($order->status === 'cancelled')
                                    <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-semibold">
                                        Cancelled
                                    </span>
                                @endif

                                <p class="text-2xl font-bold text-african-orange mt-2">
                                    {{ Number::currency($order->total_price, 'GBP') }}
                                </p>
                            </div>
                        </div>

                        <!-- Order Items -->
                        <div class="grid md:grid-cols-3 gap-4 mb-4">
                            @foreach ($order->items as $item)
                                <div class="flex items-center">
                                    <img src="{{ asset('storage/' . $item->food->image_url) }}" alt="Jollof Rice"
                                        class="w-16 h-16 rounded-lg object-cover mr-3">
                                    <div>
                                        <h4 class="font-semibold text-african-green">{{$item->food->name}}</h4>
                                        <p class="text-gray-600 text-sm">Qty: {{$item->quantity}}
                                            {{ '(' . $item->size->label . ')'}}
                                        </p>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                        <!-- Order Status -->
                        <div class="bg-cream rounded-lg p-4 mb-4">
                            <h4 class="font-semibold text-african-green mb-3">Order Status</h4>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-8">
                                    <div class="flex flex-col items-center">
                                        <div
                                            class="w-10 h-10 bg-african-green rounded-full flex items-center justify-center mb-1">
                                            <i class="fas fa-check text-white text-sm"></i>
                                        </div>
                                        <span class="text-xs font-semibold text-african-green">Ordered</span>
                                    </div>
                                    @if ($order->status === 'processed' || $order->status === 'shipped' || $order->status === 'delivered')
                                        <div class="w-12 h-1 bg-african-green"></div>
                                        <div class="flex flex-col items-center">
                                            <div
                                                class="w-10 h-10 bg-african-green rounded-full flex items-center justify-center mb-1">
                                                <i class="fas fa-utensils text-white text-sm"></i>
                                            </div>
                                            <span class="text-xs font-semibold text-african-green">Preparing</span>
                                        </div>
                                    @else
                                        <div class="w-12 h-1 bg-gray-300"></div>
                                        <div class="flex flex-col items-center">
                                            <div
                                                class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center mb-1">
                                                <i class="fas fa-utensils text-white text-sm"></i>
                                            </div>
                                            <span class="text-xs font-semibold text-african-green">Preparing</span>
                                        </div>
                                    @endif

                                    @if ($order->status === 'shipped' || $order->status === 'delivered')
                                        <div class="w-12 h-1 bg-african-green"></div>
                                        <div class="flex flex-col items-center">
                                            <div
                                                class="w-10 h-10 bg-african-green rounded-full flex items-center justify-center mb-1">
                                                <i class="fas fa-motorcycle text-white text-sm"></i>
                                            </div>
                                            <span class="text-xs font-semibold text-gray-500">On the Way</span>
                                        </div>
                                    @else
                                        <div class="w-12 h-1 bg-gray-300"></div>
                                        <div class="flex flex-col items-center">
                                            <div
                                                class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center mb-1">
                                                <i class="fas fa-motorcycle text-gray-500 text-sm"></i>
                                            </div>
                                            <span class="text-xs font-semibold text-gray-500">On the Way</span>
                                        </div>
                                    @endif

                                    @if ($order->status === 'delivered')
                                        <div class="w-12 h-1 bg-african-green"></div>
                                        <div class="flex flex-col items-center">
                                            <div
                                                class="w-10 h-10 bg-african-green rounded-full flex items-center justify-center mb-1">
                                                <i class="fas fa-home text-white text-sm"></i>
                                            </div>
                                            <span class="text-xs font-semibold text-gray-500">Delivered</span>
                                        </div>
                                    @else
                                        <div class="w-12 h-1 bg-gray-300"></div>
                                        <div class="flex flex-col items-center">
                                            <div
                                                class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center mb-1">
                                                <i class="fas fa-home text-gray-500 text-sm"></i>
                                            </div>
                                            <span class="text-xs font-semibold text-gray-500">Delivered</span>
                                        </div>
                                    @endif


                                </div>
                            </div>
                        </div>

                        <!-- Order Actions -->
                        <div class="flex justify-between items-center">
                            <div class="text-sm text-gray-600">
                                <p><i class="fas fa-map-marker-alt mr-1"></i> {{ $order->shippingAddress->address}}</p>
                                <p><i class="fas fa-map mr-1"></i>{{ $order->shippingAddress->city}} </p>
                            </div>
                            <div class="flex space-x-3">
                                <a href="{{ route('foods')}}">
                                    <button
                                        class="bg-african-green hover:bg-light-green text-white px-4 py-2 rounded-lg font-semibold transition duration-300">
                                        Food Menu
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-600">No orders found</p>
                @endforelse
            </div>

            <!-- Load More -->
            <div class="text-center mt-8">
                <button
                    class="bg-african-orange hover:bg-orange-600 text-white px-8 py-3 rounded-lg font-semibold transition duration-300">
                    Load More Orders
                </button>
            </div>
        </div>
    </section>
</div>