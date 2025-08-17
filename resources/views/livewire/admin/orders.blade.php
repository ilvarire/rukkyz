<div>
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        All Orders
    </h2>
    <div class="w-full overflow-hidden rounded-lg shadow-xs">
        @if (session()->has('success'))
            <a class="flex items-center justify-between p-4 mb-8 text-sm font-semibold text-purple-100 bg-purple-600 rounded-lg shadow-md focus:outline-none focus:shadow-outline-purple"
                href="{{route('admin.payments')}}">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                        </path>
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
                <span>See payments &RightArrow;</span>
            </a>
        @endif
        @if (session()->has('error'))
            <a class="flex items-center justify-between p-4 mb-8 text-sm font-semibold text-red-700 bg-red-100 rounded-lg shadow-md focus:outline-none focus:shadow-outline-red"
                href="">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                        </path>
                    </svg>
                    <span>{{ session('error') }}</span>
                </div>
            </a>
        @endif
        <!-- Search input -->
        <div class="flex justify-between my-6 flex-1 lg:mr-32">
            <button wire:click="$set('search', '')"
                class="flex items-center justify-between mt-1 ml-4 px-2 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                aria-label="Like">
                <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 512 512">
                    <path
                        d="M48.5 224L40 224c-13.3 0-24-10.7-24-24L16 72c0-9.7 5.8-18.5 14.8-22.2s19.3-1.7 26.2 5.2L98.6 96.6c87.6-86.5 228.7-86.2 315.8 1c87.5 87.5 87.5 229.3 0 316.8s-229.3 87.5-316.8 0c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0c62.5 62.5 163.8 62.5 226.3 0s62.5-163.8 0-226.3c-62.2-62.2-162.7-62.5-225.3-1L185 183c6.9 6.9 8.9 17.2 5.2 26.2s-12.5 14.8-22.2 14.8L48.5 224z"
                        clip-rule="evenodd" fill-rule="evenodd"></path>
                </svg>
            </button>
            <div class="relative w-xs max-w-xl mr-6 focus-within:text-purple-500">
                <div class="absolute inset-y-0 flex items-center pl-2">
                    <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
                <input wire:model.live.debounce.500ms="search"
                    class="w-full pl-8 mt-1 pr-2 text-sm text-gray-700 placeholder-gray-600 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input"
                    type="text" placeholder="Search orders" aria-label="Search" />
            </div>
            <select wire:model.live="status"
                class="block w-xs mt-1  mr-6 text-sm dark:text-gray-300 border-0 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                <option value="">All Status</option>
                <option value="pending">Pending</option>
                <option value="processed">Processed</option>
                <option value="shipped">Shipped</option>
                <option value="delivered">Delivered</option>
                <option value="cancelled">Cancelled</option>
            </select>

        </div>
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr
                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3">#</th>
                        <th class="px-4 py-3">Client</th>
                        <th class="px-4 py-3">Reference</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Date</th>
                        <th class="px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @forelse ($orders as $order)
                        <tr class="text-gray-700 dark:text-gray-400">
                            <td class="px-4 py-3 text-sm">
                                {{ $loop->index + 1 }}
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center text-sm">
                                    <!-- Avatar with inset shadow -->
                                    <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                                        <img class="object-cover w-full h-full rounded-lg"
                                            src="https://images.unsplash.com/photo-1667821399946-ae0bce59aa22?q=80&w=2574&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                            alt="" loading="lazy" />

                                        <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                                    </div>
                                    <div>
                                        <p class="font-semibold"> {{$order->user->email}} </p>
                                        <p class="text-xs text-gray-600 dark:text-gray-400">
                                            {{ Number::currency($order->total_price, 'GBP') }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                ${{ $order->reference }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <span
                                    class="@if ($order->status === 'pending') px-2 py-1 font-semibold leading-tight text-gray-700 bg-gray-100 rounded-full dark:text-gray-100 dark:bg-gray-700
                                    @elseif ($order->status === 'processed') px-2 py-1 font-semibold leading-tight text-orange-700 bg-orange-100 rounded-full dark:text-white dark:bg-orange-600
                                         @elseif ($order->status === 'shipped') px-2 py-1 font-semibold leading-tight text-orange-700 bg-orange-100 rounded-full dark:text-white dark:bg-orange-600
                                             @elseif ($order->status === 'delivered') px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100
                                                 @elseif ($order->status === 'cancelled') px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-700
                                                     @else px-2 py-1 font-semibold leading-tight text-gray-700 bg-gray-100 rounded-full dark:text-gray-100 dark:bg-gray-700
                                                        @endif
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            ">{{ $order->status }}
                                </span>

                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{$order->created_at}}
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center space-x-4 text-sm">
                                    <flux:modal.trigger name="edit-order">
                                        <button wire:click="$dispatch('edit-order', {order: '{{ $order->reference }}'})"
                                            class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                            aria-label="Edit">
                                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                                </path>
                                            </svg>

                                        </button>
                                    </flux:modal.trigger>
                                    <flux:modal.trigger name="delete-order">
                                        <button wire:click="$dispatch('delete-order', {id: {{ $order->id}}})"
                                            class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                            aria-label="Delete">
                                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        </button>
                                    </flux:modal.trigger>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr class="text-gray-700 dark:text-gray-400">
                            <td class="px-4 py-3" colspan="6">
                                <div class="flex items-center text-sm">
                                    <span class="flex items-center col-span-3">
                                        No orders found
                                    </span>
                                </div>
                            </td>
                        </tr>
                    @endforelse

                </tbody>

            </table>
        </div>
        <div
            class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
            <span class="flex items-center col-span-3">
                @if ($orders->total() > 0)
                    Showing {{ $orders->firstItem() }}-{{ $orders->LastItem() }} of {{ $orders->total() }}
                @else

                @endif
            </span>
            <span class="col-span-2"></span>
            <!-- Pagination -->
            <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">

                {{ $orders->links() }}
            </span>
        </div>
    </div>

    <flux:modal name="edit-order" class="w-full bg-white rounded-t-lg dark:bg-gray-800  sm:rounded-lg sm:max-w-xl">
        <div>
            <div class="text-center mt-8 mb-2">
                <flux:text class="text-gray-700 dark:text-gray-400">Edit Order
                </flux:text>
            </div>

            <div class="mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                @if ($selectedOrder)
                    <div class="flex justify-center mt-4">
                        @if ($selectedOrder->status != 'delivered' && $selectedOrder->payment_status === 'paid')
                            <button wire:click="cancelOrder('{{ $selectedOrder->id }}')" @click="showModal = false"
                                class="flex items-center mb-6 justify-center px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                aria-label="Delete">
                                <svg class="w-5 h-5 mr-3 text-red-700" aria-hidden="true" fill="currentColor"
                                    viewBox="0 0 512 512">
                                    <path fill-rule="evenodd"
                                        d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM175 175c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                CANCEL ORDER
                            </button>
                        @endif
                    </div>

                    <div class="mt-4 mb-6">
                        <div>

                            <!-- Modal title -->
                            <p class="mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">
                                Order ref: <strong>{{ $selectedOrder->reference }}</strong>
                            </p>
                            <p class="mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">
                                Amount: <strong>
                                    {{ Number::currency($selectedOrder->total_price, 'GBP') }}
                                </strong>
                            </p>
                            <a href="{{ route('admin.customers') }}?email={{$selectedOrder->user->email}}">
                                <p class="mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">
                                    User: <strong>{{ $selectedOrder->user->email }}</strong>
                                </p>
                            </a>
                            <p class="mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">
                                Disount:
                                {{ $selectedOrder->coupon_id ? $selectedOrder->coupon->code . ' (' . $selectedOrder->coupon->discount_percentage . '%off)' : 'N/A' }}
                            </p>
                            <p class="mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">
                                Status:
                                <span
                                    class="
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                @if ($selectedOrder->status === 'pending') px-2 py-1 font-semibold leading-tight text-gray-700 bg-gray-100 rounded-full dark:text-gray-100 dark:bg-gray-700
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                @elseif ($selectedOrder->status === 'processed') px-2 py-1 font-semibold leading-tight text-orange-700 bg-orange-100 rounded-full dark:text-white dark:bg-orange-600
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                @elseif ($selectedOrder->status === 'shipped') px-2 py-1 font-semibold leading-tight text-orange-700 bg-orange-100 rounded-full dark:text-white dark:bg-orange-600
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                @elseif ($selectedOrder->status === 'delivered') px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                @elseif ($selectedOrder->status === 'cancelled') px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-700
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                @else px-2 py-1 font-semibold leading-tight text-gray-700 bg-gray-100 rounded-full dark:text-gray-100 dark:bg-gray-700
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                @endif
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                ">
                                    {{ $selectedOrder->status }}
                                </span>
                            </p>
                            <a href="{{ route('admin.payments') }}?orderId={{$selectedOrder->id}}">
                                <p class="mb-2 mt-4 text-sm text-purple-600 px-4 py-2 font-semibold">
                                    Payment:
                                    @if ($selectedOrder->payment)
                                        <strong>{{ str($selectedOrder->payment_status)->title() }}</strong> |
                                        <strong>{{ $selectedOrder->payment->payment_method }}</strong>
                                    @else
                                        <strong>null</strong>
                                    @endif

                                </p>
                            </a>

                        </div>
                        <span class="mb-2 text-xs self-center font-semibold text-gray-700 dark:text-gray-300">
                            Cart Items ({{count($selectedOrder->items)}})
                        </span>

                        @foreach ($selectedOrder->items as $item)
                            <!-- Modal description -->
                            <a href="{{ route('admin.food') }}?food_id={{$item->food->id}}">
                                <div class="flex px-4 py-3 mb-8 mt-2 bg-white rounded-lg shadow-md dark:bg-gray-800">
                                    <div class="hidden mt-4 w-8 h-8 mr-3 rounded-full md:block">
                                        <img class="object-cover w-full h-full rounded-lg"
                                            src="{{ asset('storage/' . $item->food->image_url)}}" alt="" loading="lazy" />
                                    </div>
                                    <p class="text-xs text-gray-600 dark:text-gray-400">

                                        {{ $item->food->name }} <br>
                                        Size: {{ $item->size->label}} <br>
                                        Quantity: {{$item->quantity}} <br>
                                        Price: {{ Number::currency($item->unit_price, 'GBP') }} =
                                        {{ Number::currency($item->unit_price * $item->quantity, 'GBP') }}
                                    </p>

                                </div>
                            </a>
                        @endforeach
                        <span class="text-xs self-center font-semibold text-gray-700 dark:text-gray-300">
                            Address info
                        </span>
                        <div class="flex px-4 py-3 mb-8 mt-2 bg-white rounded-lg shadow-md dark:bg-gray-800">
                            <p class="text-xs text-gray-600 dark:text-gray-400">
                                <span class="text-xl text-gray-600 dark:text-gray-400">
                                    {{ $selectedOrder->shippingAddress->shippingFee->country->name }}
                                </span><br>
                                <strong>STATE: </strong> {{ $selectedOrder->shippingAddress->shippingFee->state }}<br>
                                Delivery fee:
                                {{ Number::currency($selectedOrder->shippingAddress->shippingFee->base_fee, 'GBP') }} <br>
                                <strong>Address:</strong> {{ $selectedOrder->shippingAddress->address}} <br>
                                <strong>City:</strong> {{ $selectedOrder->shippingAddress->city ?? 'n/a'}} <br>
                                <strong>Phone number:</strong> {{ $selectedOrder->shippingAddress->phone_number}} <br>
                                <strong>Zip code:</strong> {{ $selectedOrder->shippingAddress->zip_code ?? 'n/a' }} <br>
                            </p>

                        </div>

                    </div>
                @endif
            </div>

            <div class="flex">
                <flux:spacer />
                <button x-on:click="$flux.modals().close()"
                    class="w-full px-5 py-3 text-sm font-medium leading-5 text-white text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray">
                    Cancel
                </button>
                @if ($selectedOrder)
                    @if($selectedOrder->status === 'processed')
                        <button type="submit" wire:click="shipOrder('{{ $selectedOrder->id }}')"
                            class="w-full px-5 py-3 ml-4 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                            Ship
                        </button>
                    @elseif($selectedOrder->status === 'shipped')
                        <button wire:click="deliverOrder('{{ $selectedOrder->id }}')"
                            class=" w-full px-5 py-3 ml-4 text-sm font-medium leading-5 text-white transition-colors
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                            Deliver
                        </button>
                    @endif
                @endif
            </div>
        </div>
    </flux:modal>

    <flux:modal name="delete-order" class="bg-white rounded-t-lg dark:bg-gray-800">
        <div>
            <div class="text-center mt-8 mb-2">
                <flux:text class="text-gray-700 dark:text-gray-400">Delete order?
                </flux:text>
            </div>

            <div class="mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                <span class="text-sm text-gray-600 dark:text-gray-400">You're about to delete this order</span>
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    This will affect food under this order</p>
            </div>

            <div class="flex">
                <flux:spacer />

                <flux:modal.close>
                    <button
                        class="w-full mr-4 px-5 py-3 text-sm font-medium leading-5 text-white text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray">
                        Cancel
                    </button>
                </flux:modal.close>

                {{-- <button wire:click="deleteOrder"
                    class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red">
                    delete
                </button> --}}
            </div>
        </div>
    </flux:modal>
</div>