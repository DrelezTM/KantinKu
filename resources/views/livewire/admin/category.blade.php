<div>
    <livewire:components.header />

    <livewire:components.sidebar />

    <!-- Main Content -->
    <main id="main-content" class="pt-24 pl-64 
    smooth-transition min-h-screen">
        <div class="p-6">
            <div class="flex flex-col sm:flex-row justify-between 
            items-start sm:items-center gap-4 mb-8">
                <h2 class="text-2xl font-bold dark:text-white">
                    Categories Management
                </h2>
                <button class="bg-blue-600 hover:bg-blue-700 
                text-white px-4 py-2 rounded-lg flex items-center 
                gap-2 smooth-transition w-full sm:w-auto justify-center" 
                onclick="openAddCategoryModal()">
                    <i class="fa-solid fa-plus"></i>
                    Add Category
                </button>
            </div>

            @if (session()->has('message'))
            <div id="alert-box" 
                @class([
                    'mb-4 px-4 py-3 rounded-lg text-white',
                    'bg-red-600' => session('type') === 'error',
                    'bg-green-600' => session('type') !== 'error'
                ])>
                {{ session('message') }}
            </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($categories as $category)
                <div class="bg-white dark:bg-gray-800 p-6 rounded-xl 
                shadow-sm border border-gray-100 dark:border-gray-700 
                smooth-transition card-hover">
                    <div class="flex items-center justify-between mb-4">
                        <span class="bg-blue-100 text-blue-800 text-xs 
                            font-medium px-3 py-1 rounded-full dark:bg-blue-900 
                            dark:text-blue-300">
                            {{ $category->products_count }} Products
                        </span>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 
                        dark:text-white mb-2">
                        {{ $category->name }}
                    </h3>
                    <p class="text-gray-500 dark:text-gray-400 text-sm mb-4">
                        {{ $category->slug }}
                    </p>
                    <div class="flex space-x-3">
                        <button onclick="if(!confirm('Are you sure you want to delete this category?'))
                         return;" wire:click="delete({{ $category->id }})" class="text-red-600 
                         hover:text-red-900 dark:text-red-400 dark:hover:text-red-300 text-sm 
                         smooth-transition">Delete</button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </main>

    <div id="add-category-modal" class="modal">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg w-full 
            max-w-md mx-4 p-6 smooth-transition">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-semibold dark:text-white">
                    Add Category
                </h3>
                <button class="text-gray-500 hover:text-gray-700 
                    dark:text-gray-400 
                    dark:hover:text-gray-200 smooth-transition" 
                    onclick="closeModal('add-category-modal')">
                    <i class="fa-solid fa-times"></i>
                </button>
            </div>
            <form class="space-y-4" wire:submit.prevent="save">
                <div>
                    <label class="block text-sm font-medium text-gray-700 
                        dark:text-gray-300 mb-2">Category Name</label>
                    <input type="text" wire:model="name" class="w-full 
                        px-4 py-3 border border-gray-300 dark:border-gray-600 
                        rounded-lg bg-white dark:bg-gray-700 text-gray-900 
                        dark:text-white smooth-transition focus:ring-2 focus:ring-blue-500 
                        focus:border-transparent" placeholder="Enter product name">
                </div>
                <div>
                    <label class="block text-sm font-medium 
                        text-gray-700 dark:text-gray-300 mb-2">
                        Category Slug
                    </label>
                    <input type="text" wire:model="slug" 
                    class="w-full px-4 py-3 border border-gray-300 
                        dark:border-gray-600 rounded-lg bg-white 
                        dark:bg-gray-700 text-gray-900 dark:text-white 
                        smooth-transition focus:ring-2 focus:ring-blue-500 
                        focus:border-transparent" 
                        id="category-slug-add"
                        placeholder="Enter product slug">
                </div>
                <div class="flex justify-end space-x-3 pt-4">
                    <button type="button" class="px-6 py-3 border 
                        border-gray-300 dark:border-gray-600 text-gray-700 
                        dark:text-gray-300 rounded-lg hover:bg-gray-50 
                        dark:hover:bg-gray-700 smooth-transition" 
                        onclick="closeModal('add-category-modal')">
                        Cancel
                    </button>
                    <button type="submit" class="px-6 py-3 bg-blue-600 
                        hover:bg-blue-700 text-white rounded-lg smooth-transition">
                        Save Category
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('category-slug-add').addEventListener('change', function () {
            this.value = this.value.toLowerCase().trim().replace(/\s+/g, '-');
        });
    </script>
</div>