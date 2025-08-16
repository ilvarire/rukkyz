<nav class="bg-white shadow-lg fixed w-full z-50" x-data="{ isMenuOpen: false }">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex justify-between items-center py-4">
            <!-- Logo -->
            <a href="{{route('home')}}">
                <div class="flex items-center">
                    <img src="{{ url('/logo.png') }}" class="ml-4" alt="logo" style="width: 3rem;">
                </div>
            </a>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex space-x-8">
                <a href="{{ route('home') }}"
                    class="text-african-green hover:text-african-orange font-semibold transition duration-300">Home</a>
                <a href="{{ route('foods') }}"
                    class="text-gray-600 hover:text-african-orange font-semibold transition duration-300">Foods</a>
                <a href="{{ route('cart') }}"
                    class="text-gray-600 hover:text-african-orange font-semibold transition duration-300">Cart</a>
                @auth
                    <a href="{{ route('orders') }}"
                        class="text-gray-600 hover:text-african-orange font-semibold transition duration-300">
                        Orders
                    </a>
                    <button type="submit" form="logout"
                        class="block cursor-pointer rounded-md text-base font-medium text-gray-600 hover:text-african-orange hover:bg-gray-50 transition duration-300">
                        Logout
                    </button>
                @endauth
                @guest
                    <a href="{{ route('login') }}"
                        class="text-gray-600 hover:text-african-orange font-semibold transition duration-300">Login</a>
                @endguest

            </div>

            <!-- Desktop Icons -->
            <div class="hidden md:flex items-center space-x-4">
                <a href="{{ route('wishlist') }}"
                    class="text-gray-600 hover:text-african-orange transition duration-300">
                    <i class="fas fa-heart text-xl"></i>
                </a>
                <a href="{{ route('cart') }}"
                    class="text-gray-600 hover:text-african-orange transition duration-300 relative">
                    <i class="fas fa-shopping-cart text-xl"></i>
                    <span
                        class="absolute -top-2 -right-2 bg-african-orange text-white rounded-full w-5 h-5 flex items-center justify-center text-xs">
                        {{ $cart_count }}
                    </span>
                </a>
                <a href="#" class="text-gray-600 hover:text-african-orange transition duration-300">
                    <i class="fas fa-user text-xl"></i>
                </a>
            </div>

            <!-- Mobile Menu Button -->
            <div class="md:hidden flex items-center space-x-4">
                <a href="{{ route('cart') }}"
                    class="text-gray-600 hover:text-african-orange transition duration-300 relative">
                    <i class="fas fa-shopping-cart text-xl"></i>
                    <span
                        class="absolute -top-2 -right-2 bg-african-orange text-white rounded-full w-5 h-5 flex items-center justify-center text-xs">
                        {{ $cart_count }}
                    </span>
                </a>
                <button @click="isMenuOpen = !isMenuOpen" x-cloak
                    class="text-gray-600 hover:text-african-orange focus:outline-none focus:text-african-orange transition duration-300"
                    aria-label="Toggle menu">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!isMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                        <path x-show="isMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div class="md:hidden relative">
            <div x-show="isMenuOpen" x-transition:enter="transition ease-out duration-300" x-cloak
                x-transition:enter-start="opacity-0 transform -translate-y-2"
                x-transition:enter-end="opacity-100 transform translate-y-0"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100 transform translate-y-0"
                x-transition:leave-end="opacity-0 transform -translate-y-2"
                class="absolute top-0 left-0 right-0 px-2 pt-2 pb-3 space-y-1 bg-white border-t border-gray-200 shadow-lg z-50">
                <a href="{{ route('home') }}" @click="isMenuOpen = false"
                    class="block px-3 py-2 rounded-md text-base font-medium text-african-green hover:text-african-orange hover:bg-gray-50 transition duration-300">
                    <i class="fas fa-home mr-2"></i>Home
                </a>
                <a href="{{ route('foods') }}" @click="isMenuOpen = false"
                    class="block px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:text-african-orange hover:bg-gray-50 transition duration-300">
                    <i class="fas fa-utensils mr-2"></i>Foods
                </a>
                <a href="{{ route('cart') }}" @click="isMenuOpen = false"
                    class="block px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:text-african-orange hover:bg-gray-50 transition duration-300">
                    <i class="fas fa-shopping-cart mr-2"></i>Cart
                </a>
                @auth
                    <a href="{{ route('orders') }}" @click="isMenuOpen = false"
                        class="block px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:text-african-orange hover:bg-gray-50 transition duration-300">
                        <i class="fas fa-box mr-2"></i>Orders
                    </a>
                    <form action="{{ route('logout') }}" method="post" id="logout" style="display: none;">
                        @csrf
                    </form>

                    <button type="submit" form="logout"
                        class="block px-3 cursor-pointer py-2 rounded-md text-base font-medium text-gray-600 hover:text-african-orange hover:bg-gray-50 transition duration-300">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Logout
                    </button>

                @endauth
                @guest
                    <a href="{{ route('login') }}" @click="isMenuOpen = false"
                        class="block px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:text-african-orange hover:bg-gray-50 transition duration-300">
                        <i class="fas fa-arrow-right mr-2"></i>Login
                    </a>
                @endguest
                <a href="{{ route('wishlist') }}" @click="isMenuOpen = false"
                    class="block px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:text-african-orange hover:bg-gray-50 transition duration-300">
                    <i class="fas fa-heart mr-2"></i>Wishlist
                </a>
                @auth
                    <div class="border-t border-gray-200 pt-4 mt-4">
                        <a href="{{ route('orders') }}" @click="isMenuOpen = false"
                            class="block px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:text-african-orange hover:bg-gray-50 transition duration-300">
                            <i class="fas fa-user mr-2"></i>Profile
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</nav>