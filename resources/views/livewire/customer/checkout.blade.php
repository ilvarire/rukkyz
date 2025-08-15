<div>
    <!-- Checkout Section -->
    <section class="pt-20 py-16">
        <div class="max-w-7xl mx-auto px-4">
            <h1 class="text-3xl font-bold text-african-green mb-8">Checkout</h1>

            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Checkout Form -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
                        <h2 class="text-xl font-semibold text-african-green mb-6">Delivery Information</h2>

                        <form class="space-y-6">

                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Country</label>
                                <select wire:model.live="country_id"
                                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-african-green">
                                    <option value="">-- select country --</option>
                                    @forelse ($countries as $country)
                                        <option value="{{ $country->id}}">{{ $country->name}}</option>
                                    @empty
                                    @endforelse
                                </select>
                                @error('country_id')
                                    <span class="text-xs text-red-600">{{$message}}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">State</label>
                                <select wire:model.live="state_id"
                                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-african-green">
                                    <option value="1">-- select state --</option>
                                    @if ($states)
                                        @foreach ($states as $state)
                                            <option value="{{ $state->id }}">{{ $state->state }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('state_id')
                                    <span class="text-xs text-red-600">{{$message}}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Delivery Address</label>
                                <input wire:model="address" type="text" value="{{ old('address') }}"
                                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-african-green"
                                    placeholder="123 Main Street">
                                @error('address')
                                    <span class="text-xs text-red-600">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="grid md:grid-cols-3 gap-6">
                                <div>
                                    <label class="block text-gray-700 font-semibold mb-2">Phone</label>
                                    <input type="tel" placeholder="+1 234 567 8900" wire:model="phone_number"
                                        value="{{ old('phone_number') }}"
                                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-african-green">
                                    @error('phone_number')
                                        <span class="text-xs text-red-600">{{$message}}</span>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-gray-700 font-semibold mb-2">
                                        City
                                    </label>
                                    <input wire:model="city" type="text" value="{{ old('city') }}"
                                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-african-green"
                                        placeholder="NY">
                                    @error('city')
                                        <span class="text-xs text-red-600">{{$message}}</span>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-gray-700 font-semibold mb-2">ZIP Code</label>
                                    <input wire:model="zip_code" type="tel" value="{{ old('zip_code') }}"
                                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-african-green"
                                        placeholder="10001">
                                    @error('zip_code')
                                        <span class="text-xs text-red-600">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Delivery Instructions
                                    (Optional)</label>
                                <textarea wire:model="note" value="{{ old('note') }}"
                                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-african-green"
                                    rows="3" placeholder="Any special delivery instructions..."></textarea>
                            </div>
                        </form>
                    </div>

                    <!-- Payment Method -->
                    <div class="bg-white rounded-lg shadow-lg p-6">
                        <h2 class="text-xl font-semibold text-african-green mb-6">Payment Method</h2>

                        <div class="space-y-4">
                            <div class="border border-gray-300 rounded-lg p-4">
                                <div class="flex items-center">
                                    <input type="radio" name="payment" id="card" class="mr-3" checked>
                                    <label for="card" class="flex items-center cursor-pointer">
                                        <i class="fas fa-credit-card text-african-green mr-2"></i>
                                        <span class="font-semibold">Credit/Debit Card</span>
                                    </label>
                                </div>
                            </div>

                        </div>

                        <!-- Card Details -->
                        <div class="mt-6 space-y-4">
                            <h2 class="text-xl font-semibold text-african-green mb-6">Coupon code</h2>
                            <!-- Promo Code -->
                            <div class="grid md:grid-cols-3 gap-6">

                                <div class="flex">
                                    <input wire:model.defer="coupon" type="text" placeholder="Coupon code"
                                        class="flex-1 border border-gray-300 rounded-l-lg px-4 py-2 focus:outline-none focus:border-african-green">
                                    <button wire:click="applyCoupon"
                                        class="bg-african-green text-white px-4 py-2 rounded-r-lg hover:bg-light-green transition duration-300">
                                        Apply
                                    </button>
                                </div>
                                @error('coupon')
                                    <span class="text-xs text-red-600">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-lg shadow-lg p-6 sticky top-24">
                        <h2 class="text-xl font-semibold text-african-green mb-6">Order Summary</h2>

                        <!-- Order Items -->
                        <div class="space-y-4 mb-6">
                            @forelse ($cart_items as $item)
                                <div class="flex justify-between items-center">
                                    <div class="flex items-center">
                                        <img src="{{ asset('storage/' . $item['image_url']) }}" alt="Jollof Rice"
                                            class="w-12 h-12 rounded-lg object-cover mr-3">
                                        <div>
                                            <h4 class="font-semibold text-african-green">{{$item['name']}}</h4>
                                            <p class="text-gray-600 text-sm">Qty: {{$item['quantity']}}</p>
                                        </div>
                                    </div>
                                    <span class="font-semibold">{{ Number::currency($item['total_amount'], 'GBP') }}</span>
                                </div>
                            @empty
                            @endforelse


                        </div>

                        <!-- Price Breakdown -->
                        <div class="border-t border-gray-200 pt-4 space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Subtotal</span>
                                <span class="font-semibold">{{ Number::currency($grand_total, 'GBP') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Delivery Fee</span>
                                <span class="font-semibold">{{ Number::currency($shippingFee, 'GBP') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Discount(coupon)</span>
                                <span class="font-semibold">{{ Number::currency($discount, 'GBP') }}</span>
                            </div>
                            <div class="border-t border-gray-200 pt-3">
                                <div class="flex justify-between">
                                    <span class="text-lg font-semibold text-african-green">Total</span>
                                    <span
                                        class="text-2xl font-bold text-african-orange">{{ Number::currency($cart_total, 'GBP') }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Place Order Button -->
                        <button wire:loading.attr="disabled" wire:click="placeOrder"
                            class="w-full bg-african-orange hover:bg-orange-600 text-white py-3 rounded-lg font-semibold mt-6 transition duration-300">
                            <span wire:loading.remove>
                                Place Order - {{ Number::currency($cart_total, 'GBP') }}
                            </span>
                            <span wire:loading>
                                Loading...
                            </span>

                        </button>

                        <!-- Security Notice -->
                        <div class="mt-4 text-center text-sm text-gray-600">
                            <i class="fas fa-lock mr-1"></i>
                            Your payment information is secure and encrypted
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>