<div>
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Add Food
    </h2>
    <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        <form wire:submit.prevent="storeFood" enctype="multipart/form-data" id="add_food">

            @if (session()->has('success'))
            <a class="flex items-center justify-between p-4 mb-8 text-sm font-semibold text-purple-100 bg-purple-600 rounded-lg shadow-md focus:outline-none focus:shadow-outline-purple"
                href="{{route('admin.food')}}">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                        </path>
                    </svg>
                    <span>Food added successfully</span>
                </div>
                <span>View all &RightArrow;</span>
            </a>
            @endif

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

            <h3 class="mt-4 mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200">Prices - Sizes</h3>

            <div class="flex gap-6 mb-4">
                @forelse($sizes as $size)
                <label class="block text-sm mb-2 w-16">
                    <span class="text-gray-700 font-bold dark:text-gray-400">
                        {{ $size->label }}
                    </span>
                    <input type="text" wire:model="prices.{{ $size->id }}" value="{{ old('price') }}" name="money"
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
                    placeholder="Select Images" required />
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
        <button type="submit" form="add_food" wire:loading.class="opacity-50 cursor-not-allowed"
            wire:loading.remove.class="active:bg-purple-600 hover:bg-purple-700 focus:shadow-outline-purple"
            class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
            Create
        </button>
    </div>
</div>