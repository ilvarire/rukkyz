<div class="">
    <section class="pt-19 relative overflow-hidden">
        <div class="relative h-74 md:h-80">
            <img src="{{ url('/images/bnr2.jpg')}}" alt="African food banner" class="w-full object-cover">
            <div class="absolute inset-0 flex items-center justify-center">
                <div class="text-center text-white">
                    <h1 class="text-4xl font-bold mb-2 drop-shadow-md">Our Menu</h1>
                    <p class="text-lg mb-6 md:text-xl drop-shadow">Discover authentic African flavors from across the
                        continent</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Filters -->
    <section class="py-8 bg-white shadow-sm">
        <div class="max-w-xl mx-auto px-4 overflow-hidden">
            <div class="flex flex-wrap gap-4 justify-center">
                <!-- Search input -->
                <div class="">
                    <input wire:model.live.debounce.500ms="search" style="width: 130px;"
                        class="px-6 py-2 pl-2 mt-1 pr-2 text-sm text-gray-700 placeholder-gray-600 border border-gray-600 rounded-md focus:border-gray-600 focus:outline-none"
                        type="text" style="font-size: 16px;" placeholder="Search Food" aria-label="Search" />

                </div><br>
                <select wire:model.live="selectedCategory"
                    class="text-gray-600 bg-white border border-gray-600 cursor-pointer px-6 py-2 rounded-lg font-semibold">
                    <option value="">All Categories</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id}}">{{ $category->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </section>

    <!-- Menu Grid -->
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid md:grid-cols-3 lg:grid-cols-4 gap-8">

                @forelse($foods->items() as $food)
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
                        <img src="{{ asset('storage/' . $food->image_url) }}" alt="Jollof Rice"
                            class="w-full h-48 object-cover">
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-2">
                                <a href="{{route('food.details', $food->slug)}}" class="cursor-pointer">
                                    <h3 class="text-xl font-semibold text-african-green">{{ $food->name }}</h3>
                                </a>
                                <button class="text-gray-400 cursor-pointer hover:text-red-500">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                            <p class="text-gray-600 mb-4 text-sm">{{ $food->description }}</p>
                            <div class="flex justify-between items-center">
                                <span
                                    class="text-2xl font-bold text-african-orange">{{ Number::currency($food->prices->first()->price, 'GBP') }}</span>
                                <a href="" wire:click.prevent="addToCart({{ $food->id}})"
                                    class="bg-african-green hover:bg-light-green text-white px-4 py-2 rounded-lg transition duration-300 text-sm">
                                    Add To Cart
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-600 mb-4 text-sm">No food found!</p>
                @endforelse
            </div>
        </div>
    </section>
</div>