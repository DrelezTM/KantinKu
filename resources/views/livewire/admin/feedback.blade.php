<div>
    <livewire:components.header />

    <livewire:components.sidebar />

    <!-- Main Content -->
    <main id="main-content" class="pt-24 pl-64 
    smooth-transition min-h-screen">
        <div class="p-6">
            <div class="mb-8">
                <h2 class="text-2xl font-bold 
                dark:text-white">Keluhan Pelanggan</h2>
                <p class="text-gray-600 
                dark:text-gray-400">Kelola keluhan dari pelanggan</p>
            </div>

            <!-- Stats Simple -->
            <div class="grid grid-cols-1 
            md:grid-cols-1 gap-6 mb-8">
                <div class="bg-white dark:bg-gray-800 p-6 
                rounded-xl shadow-sm border border-gray-100 
                dark:border-gray-700">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-yellow-100 
                        dark:bg-yellow-900 rounded-lg flex items-center 
                        justify-center mr-4">
                            <i class="fa-solid fa-clock text-yellow-600 
                            dark:text-yellow-400"></i>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-gray-900 
                            dark:text-white">{{ $feedbackCount }}</p>
                            <p class="text-gray-500 dark:text-gray-400">
                                Diterima</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Daftar Keluhan -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border 
            border-gray-100 dark:border-gray-700">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex justify-between items-center">
                        <h3 class="text-lg font-semibold dark:text-white">
                            Daftar Keluhan
                        </h3>
                    </div>
                </div>

                <div class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach ($feedbacks as $feedback)
                    <div class="p-6 hover:bg-gray-50 dark:hover:bg-gray-700 
                    smooth-transition">
                        <div class="flex justify-between items-start mb-3">
                            <div>
                                <h4 class="font-semibold text-gray-900 
                                dark:text-white">{{ $feedback->name }}</h4>
                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                    {{ $feedback->email }}
                                </p>
                            </div>
                            <div class="flex items-center space-x-2">
                                <span class="text-sm text-gray-500 
                                dark:text-gray-400">
                                {{ \Carbon\Carbon::parse($feedback->created_at)->diffForHumans() }}
                            </span>
                            </div>
                        </div>
                        <p class="text-gray-600 dark:text-gray-300 mb-4">
                            {{ $feedback->message }}
                        </p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
</div>