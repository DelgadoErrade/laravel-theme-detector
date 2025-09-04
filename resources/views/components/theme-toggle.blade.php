<div>
    <div class="flex items-center space-x-2 p-4 bg-white dark:bg-gray-800 rounded-lg shadow">
        <!-- Browser Info -->
        <div class="flex items-center space-x-2">
            <i class="{{ $browserIcon }} text-blue-500"></i>
            <i class="{{ $deviceIcon }} text-green-500"></i>
        </div>

        <!-- Theme Toggle -->
        <div class="flex items-center space-x-1">
            <button wire:click="setTheme('light')"
                class="p-2 rounded-full {{ $userTheme === 'light' ? 'bg-blue-100 text-blue-600 dark:bg-blue-900 dark:text-blue-300' : 'text-gray-500 hover:text-gray-700 dark:hover:text-gray-300' }}"
                title="Modo claro">
                <i class="fas fa-sun"></i>
            </button>

            <button wire:click="setTheme('auto')"
                class="p-2 rounded-full {{ $userTheme === 'auto' ? 'bg-blue-100 text-blue-600 dark:bg-blue-900 dark:text-blue-300' : 'text-gray-500 hover:text-gray-700 dark:hover:text-gray-300' }}"
                title="Automático (seguir sistema)">
                <i class="fas fa-adjust"></i>
            </button>

            <button wire:click="setTheme('dark')"
                class="p-2 rounded-full {{ $userTheme === 'dark' ? 'bg-blue-100 text-blue-600 dark:bg-blue-900 dark:text-blue-300' : 'text-gray-500 hover:text-gray-700 dark:hover:text-gray-300' }}"
                title="Modo oscuro">
                <i class="fas fa-moon"></i>
            </button>
        </div>
    </div>

    <script>
        document.addEventListener('livewire:initialized', function() {
            Livewire.on('themeUpdated', (isDarkMode) => {
                document.documentElement.classList.toggle('dark', isDarkMode);
            });
        });
    </script>
</div>
