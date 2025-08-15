<div>
    <!-- Cart Section -->
    <section class="pt-20 py-16">
        <div class="max-w-7xl mx-auto px-4">
            <h1 class="text-3xl font-bold text-african-green mb-8">Shopping Cart</h1>

            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Cart Items -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-lg shadow-lg p-6">
                        <h2 class="text-xl font-semibold text-african-green mb-6">Cart Items ({{$cart_count}})</h2>

                        @forelse ($cart_items as $index => $item)
                            <!-- Cart Item 1 -->
                            <div class="flex items-center py-4 border-b border-gray-200">
                                <img src="{{ asset('storage/' . $item['image_url']) }}" alt="Jollof Rice"
                                    class="w-20 h-20 rounded-lg object-cover mr-4">
                                <div class="flex-1">
                                    <h3 class="font-semibold text-african-green">{{$item['name']}}</h3>
                                    <p class="text-gray-600 text-sm">
                                        <span class="text-african-orange font-semibold">
                                            {{ Number::currency($item['total_amount'], 'GBP') }}
                                        </span>
                                        <select wire:change="updateSize({{ $index }}, $event.target.value)"
                                            class="text-primary w-[60px] border border-gray-300 text-center mt-[10px] rounded-[5px] py-2 m-2 px-4">
                                            @forelse(App\Models\Food::find($item['food_id'])->prices as $price)
                                                <option value="{{$price->size_id}}"
                                                    @selected($price->size_id == $item['size_id'])>
                                                    {{ $price->size->label }}
                                                </option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </p>
                                    <div class="flex items-center mt-2">
                                        <div class="flex items-center border border-gray-300 rounded-lg mr-4">
                                            <button wire:click="decreaseQty({{$item['food_id']}})"
                                                class="px-2 py-1 cursor-pointer text-gray-600 hover:text-african-orange">
                                                -
                                            </button><br>
                                            <span
                                                class="px-4 py-1 font-semibold border border-gray-300 text-primary font-bold">
                                                <p class="text-gray-600 text-sm">Qty: {{$item['quantity']}}</p>
                                            </span>
                                            <button wire:click="increaseQty({{$item['food_id']}})"
                                                class="px-2 py-1 cursor-pointer text-gray-600 hover:text-african-orange">
                                                +
                                            </button>
                                        </div>

                                    </div>
                                </div>
                                <button wire:click="removeFromCart({{ $item['food_id']}})"
                                    class="text-red-500 cursor-pointer hover:text-red-700 ml-4">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        @empty
                            <p class="text-gray-600 text-sm">No items in cart</p>
                        @endforelse
                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <a href="{{route('foods')}}"><button
                                    class="text-african-green hover:text-african-orange font-semibold">
                                    <i class="fas fa-arrow-left mr-2"></i>Continue Shopping
                                </button></a>
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-lg shadow-lg p-6 sticky top-24">
                        <h2 class="text-xl font-semibold text-african-green mb-6">Order Summary</h2>

                        <div class="space-y-4 mb-6">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Subtotal {{ '(' . $cart_count . ')'}} items</span>

                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Tax</span>
                                <span class="font-semibold">{{ Number::currency(0, 'GBP') }}</span>
                            </div>
                            <div class="border-t border-gray-200 pt-4">
                                <div class="flex justify-between">
                                    <span class="text-lg font-semibold text-african-green">Total</span>
                                    <span
                                        class="text-2xl font-bold text-african-orange">{{ Number::currency($grand_total, 'GBP') }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Promo Code -->
                        {{-- <div class="mb-6">
                            <div class="flex">
                                <input type="text" placeholder="Promo code"
                                    class="flex-1 border border-gray-300 rounded-l-lg px-4 py-2 focus:outline-none focus:border-african-green">
                                <button
                                    class="bg-african-green text-white px-4 py-2 rounded-r-lg hover:bg-light-green transition duration-300">
                                    Apply
                                </button>
                            </div>
                        </div> --}}

                        <!-- Checkout Button -->
                        @if ($cart_count > 0)
                            <a href="{{ route('checkout')}}"
                                class="w-full bg-african-orange hover:bg-orange-600 text-white py-3 rounded-lg font-semibold text-center block transition duration-300">
                                Proceed to Checkout
                            </a>
                        @endif

                        <!-- Payment Methods -->
                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <h3 class="font-semibold text-african-green mb-3">We Accept</h3>
                            <div class="flex space-x-2">
                                <div class="bg-gray-100 p-2 rounded">
                                    <i class="fab fa-cc-visa text-blue-600"></i>
                                </div>
                                <div class="bg-gray-100 p-2 rounded">
                                    <i class="fab fa-cc-mastercard text-red-600"></i>
                                </div>
                                <div class="bg-gray-100 p-2 rounded">
                                    <i class="fab fa-cc-amex text-blue-500"></i>
                                </div>
                                <div class="bg-gray-100 p-2 rounded">
                                    <i class="fab fa-cc-paypal text-blue-700"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>