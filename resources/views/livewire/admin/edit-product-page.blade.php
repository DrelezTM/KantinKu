<div>
    <livewire:components.header />

    <livewire:components.sidebar />

    <style>
        .smooth-transition {
            transition: all 0.3s ease;
        }
        .file-input-wrapper {
            position: relative;
            overflow: hidden;
            display: inline-block;
        }
        .file-input-wrapper input[type=file] {
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
            cursor: pointer;
        }
    </style>

    <!-- Main Content -->
    <main id="main-content" class="pt-24 pl-64 smooth-transition min-h-screen">
        <div class="p-6">
            <div class="flex flex-col sm:flex-row 
                justify-between items-start sm:items-center 
                gap-4 mb-8">
                <h2 class="text-2xl font-bold dark:text-white">
                    Create New User
                </h2>
            </div>

            <!-- Form -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-8">
                <form id="addProductForm" class="space-y-8" wire:submit.prevent="update">
                    <!-- Product Name -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">
                            <span class="text-lg font-semibold">Product Name</span>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Enter the name of the product</p>
                        </label>
                        <div class="relative">
                            <input type="text" 
                                id="product-name" 
                                class="w-full px-4 py-4 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white smooth-transition focus:ring-2 focus:ring-blue-500 focus:border-transparent text-base"
                                placeholder="Enter product name"
                                wire:model="name"
                                required>
                            <div class="absolute right-6 top-1/2 transform -translate-y-1/4">
                                <i class="fas fa-box text-gray-400"></i>
                            </div>
                        </div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">Use a descriptive name for your product</p>
                    </div>

                    <!-- Product Slug -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">
                            <span class="text-lg font-semibold">Product Slug</span>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Enter the URL-friendly slug for the product</p>
                        </label>
                        <div class="relative">
                            <input type="text" 
                                id="product-slug"
                                wire:model="slug" 
                                class="w-full px-4 py-4 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white smooth-transition focus:ring-2 focus:ring-blue-500 focus:border-transparent text-base"
                                placeholder="Enter product slug"
                                required>
                            <div class="absolute right-6 top-1/2 transform -translate-y-1/4">
                                <i class="fas fa-link text-gray-400"></i>
                            </div>
                        </div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">Slug will be auto-generated if left empty</p>
                    </div>

                    <!-- Category -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">
                            <span class="text-lg font-semibold">Category</span>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Select the product category</p>
                        </label>
                        <select id="product-category" 
                            wire:model="category"
                            class="w-full px-4 py-4 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white smooth-transition focus:ring-2 focus:ring-blue-500 focus:border-transparent text-base">
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Price -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">
                            <span class="text-lg font-semibold">Price</span>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Enter the product price</p>
                        </label>
                        <div class="relative">
                            <div class="absolute left-6 top-1/2 transform -translate-y-1/4 text-gray-500">
                                Rp
                            </div>
                            <input type="number" 
                                wire:model="price"
                                id="product-price" 
                                class="w-full pl-14 pr-4 py-4 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white smooth-transition focus:ring-2 focus:ring-blue-500 focus:border-transparent text-base"
                                placeholder="Enter product price"
                                min="0"
                                step="1000"
                                required>
                        </div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">Enter price in Indonesian Rupiah</p>
                    </div>

                    <!-- Description -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">
                            <span class="text-lg font-semibold">Description</span>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Enter the product description</p>
                        </label>
                        <textarea id="product-description" 
                            wire:model="description"
                            rows="4"
                            class="w-full px-4 py-4 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white smooth-transition focus:ring-2 focus:ring-blue-500 focus:border-transparent text-base"
                            placeholder="Enter product description"></textarea>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">Describe your product in detail</p>
                    </div>

                    <!-- Product Image -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">
                            <span class="text-lg font-semibold">Product Image</span>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Upload product image</p>
                        </label>
                        <div class="file-input-wrapper w-full">
                            <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg p-8 text-center cursor-pointer">

                                @if (!$fileSelected)
                                    <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-3"></i>
                                    <p class="text-gray-600 dark:text-gray-400 font-medium mb-1">Click to upload or drag and drop</p>
                                    <p class="text-gray-500 dark:text-gray-500 text-sm">PNG, JPG, GIF up to 5MB</p>
                                @else
                                    <i class="fas fa-check-circle text-3xl text-green-500 mb-3"></i>
                                    <p class="text-gray-600 dark:text-gray-400 font-medium mb-1">File selected:</p>
                                    <p class="text-gray-500 dark:text-gray-500 text-sm">{{ $image->getClientOriginalName() }}</p>
                                @endif

                                <input type="file" wire:model="image" accept="image/*" class="w-full h-full absolute top-0 left-0 opacity-0 cursor-pointer" />
                            </div>
                        </div>
                        <div id="file-preview" class="hidden mt-4">
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Selected file:</p>
                            <div class="flex items-center justify-between bg-gray-50 dark:bg-gray-700 p-3 rounded-lg">
                                <div class="flex items-center">
                                    <i class="fas fa-image text-blue-500 mr-3"></i>
                                    <span id="file-name" class="text-gray-700 dark:text-gray-300"></span>
                                </div>
                                @if ($fileSelected)
                                <button 
                                    type="button" 
                                    wire:click="$set('image', null); $set('fileSelected', false);" class="text-red-500 hover:text-red-700">
                                    Remove file
                                </button>
                                @endif
                                
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex justify-end space-x-4 pt-8 border-t border-gray-100 dark:border-gray-700">
                        <a href="{{ route('dashboard.products') }}" 
                            class="px-8 py-3.5 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 smooth-transition font-medium text-base">
                            Cancel
                        </a>
                        <button type="submit" 
                            class="px-8 py-3.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg smooth-transition font-medium text-base">
                            Save Product
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script>
        document.getElementById('product-slug').addEventListener('change', function () {
            this.value = this.value.toLowerCase().trim().replace(/\s+/g, '-');
        });
    </script>
</div>