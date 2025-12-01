<div>
    <livewire:components.header />

    <livewire:components.sidebar />

    <main id="main-content" class="pt-24 pl-64 
    smooth-transition min-h-screen">
        <div class="p-6">
            <div class="flex flex-col sm:flex-row 
            justify-between items-start sm:items-center 
            gap-4 mb-8">
                <h2 class="text-2xl font-bold dark:text-white">
                    Products Management
                </h2>
                <button class="bg-blue-600 hover:bg-blue-700 
                text-white px-4 py-2 rounded-lg flex items-center 
                gap-2 smooth-transition w-full sm:w-auto justify-center" 
                onclick="openAddProductModal()">
                    <i class="fa-solid fa-plus"></i>
                    Add Product
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

            <div class="bg-white dark:bg-gray-800 rounded-xl 
            shadow-sm border border-gray-100 dark:border-gray-700 
            overflow-hidden smooth-transition">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-6 py-4 text-left text-sm 
                                    font-medium text-gray-500 dark:text-gray-300 
                                    uppercase tracking-wider">
                                    Product
                                </th>
                                    <th class="px-6 py-4 text-left text-sm font-medium 
                                    text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Description
                                </th>
                                <th class="px-6 py-4 text-left text-sm font-medium 
                                    text-gray-500 dark:text-gray-300 uppercase 
                                    tracking-wider">Category</th>
                                    <th class="px-6 py-4 text-left text-sm font-medium 
                                    text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Price
                                </th>
                                <th class="px-6 py-4 text-left text-sm font-medium 
                                    text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Visitor
                                </th>
                                    <th class="px-6 py-4 text-left text-sm font-medium 
                                    text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-600">
                            @foreach ($products as $product)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 smooth-transition">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="h-12 w-12 flex-shrink-0 bg-blue-100 rounded-lg flex items-center justify-center">
                                            <img src={{ asset('/storage/'.$product->image_path ?? '') }} 
                                            alt="{{ $product->name }}" />
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                {{ $product->name }}
                                            </div>
                                            <div class="whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                                {{ $product->slug }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 
                                    dark:text-gray-400">
                                    {{ $product->description }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 
                                    dark:text-gray-400">
                                    {{ $product->category->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 
                                    dark:text-white">
                                    {{ 'Rp'.number_format($product->price, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 
                                    dark:text-gray-400 text-center">
                                    {{ $product->visits_count }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button class="text-blue-600 hover:text-blue-900 
                                        dark:text-blue-400 dark:hover:text-blue-300 mr-4 smooth-transition" 
                                        onclick="openEditProductModal()" wire:click="edit({{ $product->id }})">
                                        Edit
                                    </button>
                                    <button onclick="if(!confirm('Are you sure you want to delete this product?')) 
                                        return;" wire:click="delete({{ $product->id }})" 
                                        class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300 
                                        smooth-transition">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <div id="add-product-modal" class="modal">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg w-full 
            max-w-md mx-4 p-6 smooth-transition">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-semibold dark:text-white">
                    Add Product
                </h3>
                <button class="text-gray-500 hover:text-gray-700 
                    dark:text-gray-400 
                    dark:hover:text-gray-200 smooth-transition" 
                    onclick="closeModal('add-product-modal')">
                    <i class="fa-solid fa-times"></i>
                </button>
            </div>
            <form class="space-y-4" wire:submit.prevent="save">
                <div>
                    <label class="block text-sm font-medium text-gray-700 
                        dark:text-gray-300 mb-2">Product Name</label>
                    <input type="text" wire:model="name" class="w-full 
                        px-4 py-3 border border-gray-300 dark:border-gray-600 
                        rounded-lg bg-white dark:bg-gray-700 text-gray-900 
                        dark:text-white smooth-transition focus:ring-2 focus:ring-blue-500 
                        focus:border-transparent" placeholder="Enter product name">
                </div>
                <div>
                    <label class="block text-sm font-medium 
                        text-gray-700 dark:text-gray-300 mb-2">
                        Product Slug
                    </label>
                    <input type="text" wire:model="slug" 
                    class="w-full px-4 py-3 border border-gray-300 
                        dark:border-gray-600 rounded-lg bg-white 
                        dark:bg-gray-700 text-gray-900 dark:text-white 
                        smooth-transition focus:ring-2 focus:ring-blue-500 
                        focus:border-transparent" 
                        id="product-slug-add"
                        placeholder="Enter product slug">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 
                        dark:text-gray-300 mb-2">
                        Category
                    </label>
                    <select wire:model="category" class="w-full px-4 py-3 border 
                        border-gray-300 dark:border-gray-600 rounded-lg 
                        bg-white dark:bg-gray-700 text-gray-900 dark:text-white 
                        smooth-transition focus:ring-2 focus:ring-blue-500 
                        focus:border-transparent">
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="grid grid-cols-1 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700  
                            dark:text-gray-300 mb-2">
                            Price
                        </label>
                        <input wire:model="price" type="number" class="w-full 
                            px-4 py-3 border border-gray-300 dark:border-gray-600 
                            rounded-lg bg-white dark:bg-gray-700 text-gray-900 
                            dark:text-white smooth-transition focus:ring-2 
                            focus:ring-blue-500 focus:border-transparent" 
                            placeholder="Enter product price">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 
                        dark:text-gray-300 mb-2">
                        Description
                    </label>
                    <textarea wire:model="description" 
                    class="w-full px-4 py-3 border border-gray-300 
                        dark:border-gray-600 rounded-lg bg-white 
                        dark:bg-gray-700 text-gray-900 dark:text-white 
                        smooth-transition focus:ring-2 focus:ring-blue-500 
                        focus:border-transparent" 
                        rows="3" 
                        placeholder="Enter product description">
                    </textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 
                        dark:text-gray-300 mb-2">
                        Product Image
                    </label>
                    <input type="file" wire:model="image" 
                    class="w-full px-4 py-3 border border-gray-300 
                        dark:border-gray-600 rounded-lg bg-white 
                        dark:bg-gray-700 text-gray-900 dark:text-white 
                        smooth-transition focus:ring-2 focus:ring-blue-500 
                        focus:border-transparent" 
                        accept="image/*">
                </div>
                <div class="flex justify-end space-x-3 pt-4">
                    <button type="button" class="px-6 py-3 border 
                        border-gray-300 dark:border-gray-600 text-gray-700 
                        dark:text-gray-300 rounded-lg hover:bg-gray-50 
                        dark:hover:bg-gray-700 smooth-transition" 
                        onclick="closeModal('add-product-modal')">
                        Cancel
                    </button>
                    <button type="submit" class="px-6 py-3 bg-blue-600 
                        hover:bg-blue-700 text-white rounded-lg smooth-transition">
                        Save Product
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div id="edit-product-modal" class="modal">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg w-full 
            max-w-md mx-4 p-6 smooth-transition">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-semibold dark:text-white">
                    Edit Product
                </h3>
                <button class="text-gray-500 hover:text-gray-700 
                    dark:text-gray-400 dark:hover:text-gray-200 
                    smooth-transition" 
                    onclick="closeModal('edit-product-modal')">
                    <i class="fa-solid fa-times"></i>
                </button>
            </div>
            <form wire:submit.prevent="update" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium 
                        text-gray-700 dark:text-gray-300 mb-2">
                        Product Name
                    </label>
                    <input type="text" wire:model="name" 
                    class="w-full px-4 py-3 border border-gray-300 
                        dark:border-gray-600 rounded-lg bg-white 
                        dark:bg-gray-700 text-gray-900 dark:text-white 
                        smooth-transition focus:ring-2 focus:ring-blue-500 
                        focus:border-transparent" 
                        placeholder="Enter product name">
                </div>
                <div>
                    <label class="block text-sm font-medium 
                        text-gray-700 dark:text-gray-300 mb-2">
                        Product Slug
                    </label>
                    <input type="text" wire:model="slug" 
                    class="w-full px-4 py-3 border border-gray-300 
                        dark:border-gray-600 rounded-lg bg-white 
                        dark:bg-gray-700 text-gray-900 dark:text-white 
                        smooth-transition focus:ring-2 focus:ring-blue-500 
                        focus:border-transparent" 
                        placeholder="Enter product slug">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 
                        dark:text-gray-300 mb-2">
                        Category
                    </label>
                    <select wire:model="category" class="w-full px-4 py-3 border 
                    border-gray-300 dark:border-gray-600 rounded-lg bg-white 
                    dark:bg-gray-700 text-gray-900 dark:text-white 
                    smooth-transition focus:ring-2 focus:ring-blue-500 
                    focus:border-transparent">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 
                        dark:text-gray-300 mb-2">
                        Price
                    </label>
                    <input wire:model="price" type="number" 
                    class="w-full px-4 py-3 border border-gray-300 
                        dark:border-gray-600 rounded-lg bg-white 
                        dark:bg-gray-700 text-gray-900 dark:text-white 
                        smooth-transition focus:ring-2 focus:ring-blue-500 
                        focus:border-transparent" 
                    placeholder="Enter product price">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 
                        dark:text-gray-300 mb-2">
                        Description
                    </label>
                    <textarea wire:model="description" 
                    class="w-full px-4 py-3 border border-gray-300 
                        dark:border-gray-600 rounded-lg bg-white 
                        dark:bg-gray-700 text-gray-900 dark:text-white 
                        smooth-transition focus:ring-2 focus:ring-blue-500 
                        focus:border-transparent" 
                    rows="3" 
                    placeholder="Enter product description"></textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 
                        dark:text-gray-300 mb-2">
                        Product Image
                    </label>
                    <input type="file" wire:model="image" 
                    class="w-full px-4 py-3 border border-gray-300 
                        dark:border-gray-600 rounded-lg bg-white 
                        dark:bg-gray-700 text-gray-900 dark:text-white 
                        smooth-transition focus:ring-2 focus:ring-blue-500 
                        focus:border-transparent" 
                        accept="image/*">
                </div>
                <div class="flex justify-end space-x-3 pt-4">
                    <button type="button" class="px-6 py-3 border border-gray-300 
                        dark:border-gray-600 text-gray-700 dark:text-gray-300 
                        rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 smooth-transition" 
                        onclick="closeModal('edit-product-modal')">
                        Cancel
                    </button>
                    <button type="submit" class="px-6 py-3 bg-blue-600 
                        hover:bg-blue-700 text-white rounded-lg smooth-transition">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('product-slug-add').addEventListener('change', function () {
            this.value = this.value.toLowerCase().trim().replace(/\s+/g, '-');
        });

        window.addEventListener('openAddProductModal', event => {
            document.getElementById('add-product-modal').classList.add('active');
        });

        window.addEventListener('openEditProductModal', event => {
            document.getElementById('edit-product-modal').classList.add('active');
        });
    </script>
</div>