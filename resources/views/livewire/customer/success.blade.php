<div>
    <!-- Cancelled Payment Section -->
    <section class="pt-20 py-16">
        <div class="max-w-4xl mx-auto px-4">
            <div class="bg-white rounded-lg shadow-lg p-8 text-center">
                <!-- Cancelled Icon -->
                <div class="w-20 h-20 bg-green-600 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-check text-4xl text-green-600"></i>
                </div>

                <h1 class="text-3xl font-bold text-african-green mb-4">Payment Successful</h1>
                <p class="text-gray-600 mb-8">Your payment was successful and your order has be taken</p>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center mb-8">
                    <a href="{{route('orders')}}"
                        class="bg-african-green hover:bg-light-green text-white px-8 py-3 rounded-lg font-semibold transition duration-300">
                        <i class="fas fa-shopping-cart mr-2"></i>See Orders
                    </a>
                </div>

            </div>
        </div>
    </section>
</div>