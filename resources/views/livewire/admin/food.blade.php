<div>
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        All Food
    </h2>
    <div class="w-full overflow-hidden rounded-lg shadow-xs">
        @if (session()->has('success'))
            <a class="flex items-center justify-between p-4 mb-8 text-sm font-semibold text-purple-100 bg-purple-600 rounded-lg shadow-md focus:outline-none focus:shadow-outline-purple"
                href="{{route('admin.food.add')}}">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                        </path>
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
                <span>Add Food &RightArrow;</span>
            </a>
        @endif
        <!-- Search input -->
        <div class="flex justify-between my-6 flex-1 lg:mr-32">
            <div>
                <button wire:click="$set('search', '')"
                    class="flex items-center justify-between mt-1 ml-4 px-2 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                    aria-label="Like">
                    <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 512 512">
                        <path
                            d="M48.5 224L40 224c-13.3 0-24-10.7-24-24L16 72c0-9.7 5.8-18.5 14.8-22.2s19.3-1.7 26.2 5.2L98.6 96.6c87.6-86.5 228.7-86.2 315.8 1c87.5 87.5 87.5 229.3 0 316.8s-229.3 87.5-316.8 0c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0c62.5 62.5 163.8 62.5 226.3 0s62.5-163.8 0-226.3c-62.2-62.2-162.7-62.5-225.3-1L185 183c6.9 6.9 8.9 17.2 5.2 26.2s-12.5 14.8-22.2 14.8L48.5 224z"
                            clip-rule="evenodd" fill-rule="evenodd"></path>
                    </svg>
                </button>
            </div>

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
                    type="text" placeholder="Search for food" aria-label="Search" />
            </div>
            <select wire:model.live="selectedCategory"
                class="block w-xs mt-1  mr-6 text-sm dark:text-gray-300 border-0 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                <option value="">All Categories</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>


        </div>
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr
                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3">#</th>
                        <th class="px-4 py-3">Name</th>
                        <th class="px-4 py-3">Price</th>
                        <th class="px-4 py-3">Category</th>
                        <th class="px-4 py-3">Description</th>
                        <th class="px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @forelse ($foods as $food)
                        <tr class="text-gray-700 dark:text-gray-400">
                            <td class="px-4 py-3 text-sm">
                                {{ $loop->index + 1 }}.
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center text-sm">
                                    <!-- Avatar with inset shadow -->

                                    <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                                        @if ($food->image_url)
                                            <img class="object-cover w-full h-full rounded-lg"
                                                src="{{ asset('storage/' . $food->image_url) }}" alt="" loading="lazy" />
                                        @else
                                            <img class="object-cover w-full h-full rounded-lg"
                                                src="https://images.unsplash.com/flagged/photo-1570612861542-284f4c12e75f?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=200&fit=max&ixid=eyJhcHBfaWQiOjE3Nzg0fQ"
                                                alt="" loading="lazy" />
                                        @endif

                                        <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                                    </div>
                                    <div>
                                        <p class="font-semibold"> {{$food->name}} </p>
                                        <p class="text-xs text-gray-600 dark:text-gray-400">
                                            @foreach ($food->prices as $price)
                                                {{$price->size->label}},
                                            @endforeach
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ Number::currency($food->prices->first()->price, 'GBP') }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $food->category->name }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{-- <span
                                    class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                    Approved
                                </span> --}}
                                {{ mb_strimwidth($food->description, 0, 30, '...') }}
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center space-x-4 text-sm">
                                    <flux:modal.trigger name="edit-food">
                                        <button
                                            wire:click="$dispatch('edit-food', { mode: 'edit', food: '{{ $food->slug }}'})"
                                            class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                            aria-label="Edit">
                                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                                </path>
                                            </svg>
                                        </button>
                                    </flux:modal.trigger>

                                    <flux:modal.trigger name="delete-food">
                                        <button wire:click="$dispatch('delete-food', { id: {{ $food->id }} })"
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
                                        No food found
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
                @if ($foods->total() > 0)
                    Showing {{ $foods->firstItem() }}-{{ $foods->LastItem() }} of {{ $foods->total() }}
                @else

                @endif

            </span>
            <span class="col-span-2"></span>
            <!-- Pagination -->
            <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">

                {{ $foods->links() }}
            </span>
        </div>
    </div>

    <flux:modal name="edit-food" class="w-full bg-white rounded-t-lg dark:bg-gray-800  sm:rounded-lg sm:max-w-xl">
        <div>
            <div class="text-center mt-8 mb-2">
                <flux:text class="text-gray-700 dark:text-gray-400">Edit food
                </flux:text>
            </div>

            <div class="mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                <form method="POST" id="update_food" wire:submit.prevent="updateFood">
                    <div class="grid gap-6 mb-6 mt-4 md:grid-cols-2 xl:grid-cols-4">
                        <img src="{{ asset('storage/' . $existingImage) }}" alt="img" class="rounded-lg">
                    </div>
                    <label class="block text-sm mb-2">
                        <span class="text-gray-700 dark:text-gray-400">
                            Name
                        </span>
                        <input type="text" wire:model="name" value="{{ old('name') }}"
                            class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple form-input"
                            placeholder="Name" required />
                        @error('name')
                            <span class="text-xs text-red-600 dark:text-red-400">
                                {{$message}}
                            </span>
                        @enderror

                    </label>
                    <label class="block mt-4 text-sm mb-2">
                        <span class="text-gray-700 dark:text-gray-400">Description</span>
                        <textarea wire:model="description" value="{{ old('description') }}"
                            class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                            rows="3" placeholder="Enter product description"></textarea>
                        @error('description')
                            <span class="text-xs text-red-600 dark:text-red-400">
                                {{$message}}
                            </span>
                        @enderror
                    </label>

                    <label class="block text-sm mb-2">
                        <span class="text-gray-700 dark:text-gray-400">
                            Category
                        </span>
                        <select wire:model="category_id" value="{{ old('category_id') }}"
                            class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                            <option class="" value="">select category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <span class="text-xs text-red-600 dark:text-red-400">
                                {{$message}}
                            </span>
                        @enderror

                    </label>

                    <div class="flex gap-6 mb-4 mt-4">
                        <label class="block text-sm mb-2">
                            <span class="text-gray-700 dark:text-gray-400">
                                Available: <span class="text-purple-600">{{ $is_available ? 'Yes' : 'No' }} </span>
                            </span>
                            <input type="checkbox" wire:model="is_available" value="1"
                                class="text-purple-600 form-checkbox focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" />
                            <span class="ml-2">

                            </span>
                            @error('is_available')
                                <span class="text-xs text-red-600 dark:text-red-400">
                                    {{$message}}
                                </span>
                            @enderror

                        </label>
                        <label class="block text-sm mb-2">
                            <span class="text-gray-700 dark:text-gray-400">
                                Special: <span class="text-purple-600">{{ $is_special ? 'Yes' : 'No' }} </span>
                            </span>
                            <input type="checkbox" wire:model="is_special" value="1"
                                class="text-purple-600 form-checkbox focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" />
                            <span class="ml-2">

                            </span>
                            @error('is_special')
                                <span class="text-xs text-red-600 dark:text-red-400">
                                    {{$message}}
                                </span>
                            @enderror

                        </label>

                        <label class="block text-sm mb-2">
                            <span class="text-gray-700 dark:text-gray-400">
                                Featured: <span class="text-purple-600">{{ $is_featured ? 'Yes' : 'No' }} </span>
                            </span>
                            <input type="checkbox" wire:model="is_featured" value="1"
                                class="text-purple-600 form-checkbox focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" />
                            <span class="ml-2">

                            </span>
                            @error('is_featured')
                                <span class="text-xs text-red-600 dark:text-red-400">
                                    {{$message}}
                                </span>
                            @enderror

                        </label>
                    </div>

                    <h3 class="mt-4 mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200">Prices - Sizes</h3>

                    <div class="flex gap-6 mb-4">
                        @forelse($sizes as $size)
                            <label class="block text-sm mb-2 w-16">
                                <span class="text-gray-700 font-bold dark:text-gray-400">
                                    {{ $size->label }}
                                </span>
                                <input type="text" wire:model="prices.{{ $size->id }}" value="{{ old('price') }}"
                                    name="money"
                                    class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple form-input"
                                    placeholder="00.00" />
                                @error('prices')
                                    <span class="text-xs text-red-600 dark:text-red-400">
                                        {{$message}}
                                    </span>
                                @enderror
                            </label>
                        @empty
                            <span class="mb-6 text-gray-700 font-thin dark:text-gray-400">
                                No sizes added
                            </span>
                        @endforelse

                    </div>

                    <label class="block text-sm mb-2">
                        <span class="text-gray-700 dark:text-gray-400">
                            Image
                        </span>
                        <input type="file" accept="image/*" wire:model="image" value="{{ old('image') }}"
                            class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple form-input"
                            placeholder="Select Images" />
                        @error('image')
                            <span class="text-xs text-red-600 dark:text-red-400">
                                {{$message}}
                            </span>
                        @enderror

                    </label>

                    @if ($image)
                        <div class="grid gap-6 mb-6 mt-4 md:grid-cols-2 xl:grid-cols-4">
                            <img src="{{ $image->temporaryUrl() }}" alt="img" class="rounded-lg">
                        </div>
                    @endif

                </form>
            </div>

            <div class="flex">
                <flux:spacer />

                <button type="submit" form="update_food"
                    class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                    Save
                </button>
            </div>
        </div>
    </flux:modal>

    <flux:modal name="delete-food" class="bg-white rounded-t-lg dark:bg-gray-800">
        <div>
            <div class="text-center mt-8 mb-2">
                <flux:text class="text-gray-700 dark:text-gray-400">Delete food?
                </flux:text>
            </div>

            <div class="mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                <span class="text-sm text-gray-600 dark:text-gray-400">You're about to delete this food</span>
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    This could affect transactions under this food</p>
            </div>

            <div class="flex">
                <flux:spacer />

                <flux:modal.close>
                    <button
                        class="w-full mr-4 px-5 py-3 text-sm font-medium leading-5 text-white text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray">
                        Cancel
                    </button>
                </flux:modal.close>

                <button wire:click="deleteFood"
                    class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red">
                    delete
                </button>
            </div>
        </div>
    </flux:modal>
</div>