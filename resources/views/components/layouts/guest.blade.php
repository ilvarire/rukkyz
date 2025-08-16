<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.guest')
</head>

<body class="bg-cream">
    <div class="loader" id="loader">
        <img src="{{ url('/logo.png')}}" alt="Logo" class="logow" />
    </div>
    <!-- Navigation -->
    <livewire:customer.navigation />

    <!-- Page Content -->
    <main>
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-african-green text-white py-12" style="background-color: #204043;
background-image: linear-gradient(215deg, #1a4449 0%, #000000 74%);">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center mb-4">
                        <img src="{{ url('/logo.png') }}" alt="logo" style="width: 5rem;">
                    </div>
                    <p class="text-gray-300 mb-4">Nigerian food in Luton, 🇳🇬. African food in UK 🇬🇧</p>
                    <div class="flex space-x-4">
                        <a href="https://api.whatsapp.com/send/?phone=%2B447424350622&text&type=phone_number&app_absent=0&wame_ctl=1"
                            target="_blank" class="text-gray-300 hover:text-african-orange"><i
                                class="fab fa-whatsapp"></i></a>
                        <a href="https://www.tiktok.com/@rukkyz_kitchen?_t=ZN-8yrrcQq2XRO&_r=1"
                            class="text-gray-300 hover:text-african-orange"><i class="fab fa-tiktok"></i></a>
                        <a href="https://www.instagram.com/rukkyz_kitchen_global?igsh=MWFxcTBuend3dW94NA%3D%3D&utm_source=qr"
                            target="_blank" class="text-gray-300 hover:text-african-orange"><i
                                class="fab fa-instagram"></i></a>
                    </div>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('home') }}" class="text-gray-300 hover:text-african-orange">Home</a></li>
                        <li><a href="{{ route('foods') }}" class="text-gray-300 hover:text-african-orange">Menu</a></li>
                        <li><a href="{{ route('orders') }}" class="text-gray-300 hover:text-african-orange">Orders</a>
                        </li>
                        <li><a href="{{ route('policy') }}" class="text-gray-300 hover:text-african-orange">Business
                                policy</a>
                        </li>
                        <li><a href="{{ route('guide') }}" class="text-gray-300 hover:text-african-orange">Business
                                guide</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Contact Info</h3>
                    <ul class="space-y-2 text-gray-300">
                        <li><i class="fas fa-map-marker-alt mr-2"></i> 71-75 Shelton Street, Convent Garden. London, UK.
                        </li>
                        <li><i class="fas fa-phone mr-2"></i> +44 7424 350622</li>
                        <li><i class="fas fa-envelope mr-2"></i> info@rukkyzkitchen.com</li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Working Hours</h3>
                    <ul class="space-y-2 text-gray-300">
                        <li>24/7</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-300">
                <p>&copy; 2025 RukkyzKitchen. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const loader = document.getElementById("loader");

            if (loader) {
                // Optional delay
                setTimeout(() => {
                    loader.classList.add("hidden");

                    loader.addEventListener("transitionend", () => {
                        loader.remove();
                    });
                }, 500);
            }
        });

    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @fluxScripts
</body>

</html>