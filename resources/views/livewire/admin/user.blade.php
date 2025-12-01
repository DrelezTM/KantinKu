<div>
    <livewire:components.header />

    <livewire:components.sidebar />

    <!-- Main Content -->
    <main id="main-content" 
    class="pt-24 pl-64 smooth-transition min-h-screen">
        <div class="p-6">
            <div class="flex flex-col sm:flex-row 
                justify-between items-start sm:items-center 
                gap-4 mb-8">
                <h2 class="text-2xl font-bold dark:text-white">
                    Users Management
                </h2>

                <button class="bg-blue-600 hover:bg-blue-700 
                text-white px-4 py-2 rounded-lg flex items-center 
                gap-2 smooth-transition w-full sm:w-auto justify-center" 
                onclick="openAddUserModal()">
                    <i class="fa-solid fa-plus"></i>
                    Add User
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

            <div class="bg-white dark:bg-gray-800 
                rounded-xl shadow-sm border border-gray-100 
                dark:border-gray-700 overflow-hidden smooth-transition">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-6 py-4 text-left 
                                    text-sm font-medium text-gray-500 
                                    dark:text-gray-300 uppercase tracking-wider">
                                        User
                                    </th>
                                <th class="px-6 py-4 text-left 
                                    text-sm font-medium text-gray-500 
                                    dark:text-gray-300 uppercase tracking-wider">
                                        Email
                                    </th>
                                
                                <th class="px-6 py-4 text-left text-sm 
                                    font-medium text-gray-500 
                                    dark:text-gray-300 uppercase tracking-wider">
                                        Telp
                                    </th>
                                <th class="px-6 py-4 text-left 
                                    text-sm font-medium text-gray-500 
                                    dark:text-gray-300 uppercase tracking-wider">
                                        Role
                                    </th>
                                <th class="px-6 py-4 text-left text-sm 
                                    font-medium text-gray-500 
                                    dark:text-gray-300 uppercase tracking-wider">
                                        Actions
                                    </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 
                            dark:divide-gray-600">
                            @foreach ($users as $user)
                            <tr class="hover:bg-gray-50 
                                dark:hover:bg-gray-700 smooth-transition">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="h-10 w-10 flex-shrink-0 
                                            bg-blue-100 rounded-full flex 
                                            items-center justify-center">
                                            <span class="text-blue-600 
                                                font-semibold text-sm">
                                                {{ strtoupper(substr(
                                                    $user->name, 0, 1) . substr(
                                                        explode(' ', 
                                                        $user->name)[1] ?? '', 0, 1)) }}
                                            </span>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium 
                                                text-gray-900 dark:text-white">
                                                    {{ $user->name }}
                                                </div>
                                            <div class="text-sm text-gray-500 
                                                dark:text-gray-400">
                                                    {{ $user->nim }}
                                                </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm 
                                    text-gray-500 dark:text-gray-400">
                                        {{ $user->email }}
                                    </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm 
                                    text-gray-500 dark:text-gray-400">
                                        {{ $user->phone_number }}
                                    </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm 
                                    text-gray-900 dark:text-white">
                                        {{ ucfirst($user->role) }}
                                    </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button onclick="if(!confirm('Are you sure you want to delete this user?')) 
                                    return;" wire:click="delete({{ $user->id }})" 
                                    class="text-red-600 hover:text-red-900 dark:text-red-400 
                                        dark:hover:text-red-300 smooth-transition"
                                            >Delete
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

    <div id="add-user-modal" class="modal">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg w-full 
            max-w-md mx-4 p-6 smooth-transition">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-semibold dark:text-white">
                    Add User
                </h3>
                <button class="text-gray-500 hover:text-gray-700 
                    dark:text-gray-400 
                    dark:hover:text-gray-200 smooth-transition" 
                    onclick="closeModal('add-user-modal')">
                    <i class="fa-solid fa-times"></i>
                </button>
            </div>
            <form class="space-y-4" wire:submit.prevent="save">
                <div>
                    <label class="block text-sm font-medium text-gray-700 
                        dark:text-gray-300 mb-2">NIM</label>
                    <input type="text" wire:model="nim" class="w-full 
                        px-4 py-3 border border-gray-300 dark:border-gray-600 
                        rounded-lg bg-white dark:bg-gray-700 text-gray-900 
                        dark:text-white smooth-transition focus:ring-2 focus:ring-blue-500 
                        focus:border-transparent" placeholder="Enter nim">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 
                        dark:text-gray-300 mb-2">Name</label>
                    <input type="text" wire:model="name" class="w-full 
                        px-4 py-3 border border-gray-300 dark:border-gray-600 
                        rounded-lg bg-white dark:bg-gray-700 text-gray-900 
                        dark:text-white smooth-transition focus:ring-2 focus:ring-blue-500 
                        focus:border-transparent" placeholder="Enter name">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 
                        dark:text-gray-300 mb-2">Email</label>
                    <input type="email" wire:model="email" class="w-full 
                        px-4 py-3 border border-gray-300 dark:border-gray-600 
                        rounded-lg bg-white dark:bg-gray-700 text-gray-900 
                        dark:text-white smooth-transition focus:ring-2 focus:ring-blue-500 
                        focus:border-transparent" placeholder="Enter email">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 
                        dark:text-gray-300 mb-2">Password</label>
                    <input type="password" wire:model="password" class="w-full 
                        px-4 py-3 border border-gray-300 dark:border-gray-600 
                        rounded-lg bg-white dark:bg-gray-700 text-gray-900 
                        dark:text-white smooth-transition focus:ring-2 focus:ring-blue-500 
                        focus:border-transparent" placeholder="Enter password">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 
                        dark:text-gray-300 mb-2">Phone Number</label>
                    <input type="number" wire:model="phone_number" class="w-full 
                        px-4 py-3 border border-gray-300 dark:border-gray-600 
                        rounded-lg bg-white dark:bg-gray-700 text-gray-900 
                        dark:text-white smooth-transition focus:ring-2 focus:ring-blue-500 
                        focus:border-transparent" placeholder="Enter phone number">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 
                        dark:text-gray-300 mb-2">
                        Role
                    </label>
                    <select wire:model="role" class="w-full px-4 py-3 border 
                        border-gray-300 dark:border-gray-600 rounded-lg 
                        bg-white dark:bg-gray-700 text-gray-900 dark:text-white 
                        smooth-transition focus:ring-2 focus:ring-blue-500 
                        focus:border-transparent">
                        <option value="admin">Admin</option>
                        <option value="buyer">Buyer/Mahasiswa</option>
                    </select>
                </div>
                <div class="flex justify-end space-x-3 pt-4">
                    <button type="button" class="px-6 py-3 border 
                        border-gray-300 dark:border-gray-600 text-gray-700 
                        dark:text-gray-300 rounded-lg hover:bg-gray-50 
                        dark:hover:bg-gray-700 smooth-transition" 
                        onclick="closeModal('add-user-modal')">
                        Cancel
                    </button>
                    <button type="submit" class="px-6 py-3 bg-blue-600 
                        hover:bg-blue-700 text-white rounded-lg smooth-transition">
                        Save User
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>