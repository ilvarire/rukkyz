<div class="">
    <section class="pt-19 relative overflow-hidden">
        <div class="relative h-64 md:h-80">
            <img src="{{ url('/images/bnr2.jpg')}}" alt="African food banner" class="w-full object-cover">
            <div class="absolute inset-0 flex items-center justify-center">
                <div class="text-center text-white">
                    <h1 class="text-4xl font-bold mb-2 drop-shadow-md">Our Menu</h1>
                    <p class="text-lg md:text-xl drop-shadow">Discover authentic African flavors from across the
                        continent</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Filters -->
    <section class="py-8 bg-white shadow-sm">
        <div class="max-w-xl mx-auto px-4 overflow-hidden">
            <div class="flex flex-wrap gap-4 justify-center">
                <button class="bg-african-green text-white px-6 py-2 rounded-lg font-semibold">All</button>
                @forelse($categories as $category)
                    <button
                        class="bg-gray-200 text-gray-700 hover:bg-african-green hover:text-white px-6 py-2 rounded-lg font-semibold transition duration-300">
                        {{ $category->name}}
                    </button>
                @empty
                @endforelse
            </div>
        </div>
    </section>

    <!-- Menu Grid -->
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid md:grid-cols-3 lg:grid-cols-4 gap-8">

                @forelse($foods as $food)
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
                @endforelse
            </div>
        </div>
    </section>
</div>