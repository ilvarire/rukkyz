<div>
    <!-- Food Details -->
    <section class="pt-20 py-16">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid md:grid-cols-2 gap-12">
                <!-- Food Image -->
                <div class="relative">
                    <img src="{{ asset('storage/' . $food->image_url) }}" alt="image"
                        class="w-full rounded-lg shadow-2xl">
                    <div class="absolute top-4 left-4">
                        <span
                            class="bg-african-orange text-white px-3 py-1 rounded-full text-sm font-semibold">Popular</span>
                    </div>
                    <div class="absolute top-4 right-4">
                        <button
                            class="bg-white p-2 rounded-full cursor-pointer shadow-lg hover:bg-red-50 transition duration-300">
                            <i class="fas fa-heart text-red-500"></i>
                        </button>
                    </div>
                </div>

                <!-- Food Information -->
                <div>
                    <h1 class="text-4xl font-bold text-african-green mb-4"> {{$food->name}} </h1>
                    {{-- <div class="flex items-center mb-6">
                        <div class="flex text-yellow-400 mr-4">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <span class="text-gray-600">(4.9/5) - 127 reviews</span>
                    </div> --}}

                    <p class="text-gray-600 mb-6 text-lg">
                        {{$food->description}}
                    </p>

                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <span class="text-3xl font-bold text-african-orange"></span>
                            <span class="text-gray-500 line-through ml-2"></span>
                            <div class="flex items-center border border-gray-300 rounded-lg">
                                <select wire:model.live="selectedSizeId"
                                    class="text-primary w-[160px] text-center mt-[10px] rounded-[5px] py-[5px] m-2 px-[10px]">
                                    @forelse($food->prices as $price)
                                        <option value="{{$price->id}}">
                                            {{ $price->size->label }} - {{ Number::currency($price->price, 'GBP') }}
                                        </option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>

                        </div>
                        <div class="flex items-center space-x-4">

                            <div class="flex items-center border border-gray-300 rounded-lg">
                                <h4 class="px-3 py-2 text-gray-600 hover:text-african-orange">Qty</h4>
                                <input type="number" wire:model="quantity" min="1" max="200"
                                    class="px-4 py-2 font-semibold">
                            </div>
                        </div>
                    </div>
                    @if (session()->has('error'))
                        <p class="text-xs text-red-600">{{ session('error')}}</p>
                    @endif
                    <div class="flex space-x-4">
                        <button wire:click="addToCart" wire:loading.attr="disabled"
                            class="flex-1 cursor-pointer bg-african-green hover:bg-light-green text-white py-3 rounded-lg font-semibold transition duration-300">
                            <i class="fas fa-shopping-cart mr-2"></i>Add to Cart
                        </button>
                        <button
                            class="px-6 py-3 border-2 border-african-green text-african-green hover:bg-african-green hover:text-white rounded-lg font-semibold transition duration-300">
                            <i class="fas fa-heart mr-2"></i>Wishlist
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Reviews Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-african-green mb-8">Customer Reviews</h2>
            <div class="grid md:grid-cols-2 gap-8">
                <div class="bg-cream p-6 rounded-lg">
                    <div class="flex items-center mb-4">
                        <img src="https://images.unsplash.com/photo-1494790108755-2616b612b786?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=100&q=80"
                            alt="User" class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <h4 class="font-semibold text-african-green">Sarah Johnson</h4>
                            <div class="flex text-yellow-400">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-600">"Absolutely delicious! The Jollof Rice tasted just like my grandmother used
                        to make. The spices were perfectly balanced and the rice was cooked to perfection."</p>
                </div>

                <div class="bg-cream p-6 rounded-lg">
                    <div class="flex items-center mb-4">
                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=100&q=80"
                            alt="User" class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <h4 class="font-semibold text-african-green">Michael Chen</h4>
                            <div class="flex text-yellow-400">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-600">"This was my first time trying African cuisine and I was blown away! The
                        Jollof Rice had such rich flavors and the portion size was generous. Highly recommend!"</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Dishes -->
    <section class="py-16 bg-cream">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-african-green mb-8">You Might Also Like</h2>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
                    <img src="https://images.unsplash.com/photo-1546833999-b9f581a1996d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80"
                        alt="Nyama Choma" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-african-green mb-2">Afang</h3>
                        <p class="text-gray-600 mb-4 text-sm">East African grilled meat served with traditional sides.
                        </p>
                        <div class="flex justify-between items-center">
                            <span class="text-2xl font-bold text-african-orange">£70.00</span>
                            <a href="food-details.html"
                                class="bg-african-green hover:bg-light-green text-white px-4 py-2 rounded-lg transition duration-300 text-sm">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
                    <img src="{{ url('/images/bnr2.jpg')}}" alt="Egusi Soup" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-african-green mb-2">Egusi Soup</h3>
                        <p class="text-gray-600 mb-4 text-sm">Nigerian soup with ground melon seeds and vegetables.</p>
                        <div class="flex justify-between items-center">
                            <span class="text-2xl font-bold text-african-orange">£60.00</span>
                            <a href="food-details.html"
                                class="bg-african-green hover:bg-light-green text-white px-4 py-2 rounded-lg transition duration-300 text-sm">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
                    <img src="{{ url('/images/ban.jpg')}}" alt="Suya" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-african-green mb-2">Edikaikong</h3>
                        <p class="text-gray-600 mb-4 text-sm">Spicy Nigerian skewered meat with peanut spice mix.</p>
                        <div class="flex justify-between items-center">
                            <span class="text-2xl font-bold text-african-orange">£65.00</span>
                            <a href="food-details.html"
                                class="bg-african-green hover:bg-light-green text-white px-4 py-2 rounded-lg transition duration-300 text-sm">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>