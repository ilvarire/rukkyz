<div>
    <!-- Hero Section with CSS Classes -->
    <section class="hero-section"
        style="border-bottom-left-radius: 20px; border-bottom-right-radius: 20px; position: relative; min-height: 80vh; background: linear-gradient(135deg, #2D5016 0%, #4A7C59 50%, #FF6B35 100%); display: flex; align-items: center; overflow: hidden; padding-top: 5rem;">
        <div class="hero-container"
            style="max-width: 80rem; margin: 0 auto; padding: 0 1rem; width: 100%; display: flex; align-items: center; gap: 2rem; flex-direction: column; min-height: 75vh;">

            <!-- Left Side - Text Content -->
            <div class="hero-text" style="flex: 1; color: white; z-index: 10; text-align: center; width: 100%;">
                <p class="hero-tagline mt-4"
                    style="color: #FFD700; font-family: cursive; font-weight: 600; margin-bottom: 1rem; font-size: 1rem; text-transform: lowercase; letter-spacing: 1px;">
                    RukkyzKitchen
                </p>
                <h1 class="hero-title"
                    style="font-size: 2rem; font-weight: bold; margin-bottom: 1rem; line-height: 1.2; text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">
                    An innovative<br>
                    <span style="color: #FFD700;">Culinary Venture</span>
                </h1>
                <p class="hero-subtitle"
                    style="font-size: 1rem; margin-bottom: 1.5rem; line-height: 1.6; opacity: 0.95; text-shadow: 1px 1px 2px rgba(0,0,0,0.3); max-width: 600px; margin-left: auto; margin-right: auto;">
                    Offering a blend of traditional and modern take on African cuisine. With vibrant rich flavours and
                    spice, each dish takes you on a journey through the heart of Africa one bite at a time.
                </p>
                <div class="hero-buttons"
                    style="display: flex; gap: 0.75rem; flex-wrap: wrap; justify-content: center;">
                    <a href="{{route('foods')}}" class="hero-button"
                        style="background-color: #FF6B35; color: white; padding: 0.75rem 1.5rem; border-radius: 0.5rem; font-weight: 600; text-decoration: none; transition: all 0.3s ease; font-size: 0.875rem; box-shadow: 0 4px 15px rgba(255,107,53,0.3);">
                        Order Now
                    </a>
                    <a href="{{ asset('menu/food-menu.pdf') }}" target="_blank" class="hero-button"
                        style="border: 2px solid white; color: white; padding: 0.75rem 1.5rem; border-radius: 0.5rem; font-weight: 600; text-decoration: none; transition: all 0.3s ease; font-size: 0.875rem;">
                        View Menu
                    </a>
                </div>
            </div>

            <!-- Right Side - Image -->
            <div class="hero-image-container"
                style="flex: 1; display: flex; justify-content: center; align-items: center; z-index: 10; width: 100%; margin-top: 1rem;">
                <img src="{{ url('/images/banner2.png')}}" alt="African Cuisine" class="hero-image"
                    style="max-width: 100%; height: auto; max-height: 40vh; object-fit: contain; filter: drop-shadow(0 10px 20px rgba(0,0,0,0.3));">
            </div>
        </div>
    </section>

    <div>
        <!-- Featured Categories -->
        <section style="padding: 4rem 0; background-color: white;">
            <div style="max-width: 80rem; margin: 0 auto; padding: 0 1rem;">
                <h2
                    style="font-size: 1.875rem; font-weight: bold; text-align: center; color: #2D5016; margin-bottom: 3rem;">
                    Popular Categories</h2>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem;">
                    @forelse($categories as $category)
                        <a href="{{ route('foods', ['category' => $category->slug]) }}"
                            style="position: relative; border-radius: 0.5rem; overflow: hidden; height: 12rem; display: block; cursor: pointer; text-decoration: none;">
                            <img src="{{ asset('storage/' . $category->image_url) }}" alt="{{$category->name}}"
                                style="position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover;">
                            <div style="position: absolute; inset: 0; background-color: rgba(0,0,0,0.3);"></div>
                            <div
                                style="position: absolute; inset: 0; display: flex; flex-direction: column; align-items: center; justify-content: center; color: white;">
                                <i class="fas fa-drumstick-bite" style="font-size: 3rem; margin-bottom: 0.5rem;"></i>
                                <h3 style="font-size: 1.125rem; font-weight: 600;"> {{$category->name}} </h3>
                            </div>
                        </a>
                    @empty
                        <h3 style="font-size: 1.125rem; font-weight: 600;">No categories</h3>
                    @endforelse
                </div>
            </div>
        </section>
    </div>

    <!-- Menu Grid -->
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4">
            <h2
                style="font-size: 1.875rem; font-weight: bold; text-align: center; color: #2D5016; margin-bottom: 3rem;">
                Special delight
            </h2>
            <div class="grid md:grid-cols-3 lg:grid-cols-4 gap-8">

                @forelse($specialFood as $food)
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