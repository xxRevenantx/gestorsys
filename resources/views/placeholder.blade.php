<div class="p-4">
    <div class="animate-pulse space-y-4">
        <!-- Header de la tabla -->
        <div class="flex justify-between items-center">
            <div class="h-6 bg-gray-200 rounded w-1/3"></div>
            <div class="h-6 bg-gray-200 rounded w-1/6"></div>
        </div>

        <!-- Tabla -->
        <div class="border border-gray-200 rounded-lg">
            <div class="bg-gray-100 p-3 rounded-t-lg">
                <div class="grid grid-cols-6 gap-4">
                    <div class="h-4 bg-gray-300 rounded w-full"></div>
                    <div class="h-4 bg-gray-300 rounded w-full"></div>
                    <div class="h-4 bg-gray-300 rounded w-full"></div>
                    <div class="h-4 bg-gray-300 rounded w-full"></div>
                    <div class="h-4 bg-gray-300 rounded w-full"></div>
                    <div class="h-4 bg-gray-300 rounded w-full"></div>
                </div>
            </div>

            <!-- Filas de la tabla -->
            @for ($i = 0; $i < 5; $i++)
                <div class="p-3 border-t border-gray-200">
                    <div class="grid grid-cols-6 gap-4">
                        <div class="h-4 bg-gray-200 rounded w-full"></div>
                        <div class="h-4 bg-gray-200 rounded w-full"></div>
                        <div class="h-4 bg-gray-200 rounded w-full"></div>
                        <div class="h-4 bg-gray-200 rounded w-full"></div>
                        <div class="h-4 bg-gray-200 rounded w-full"></div>
                        <div class="h-4 bg-gray-200 rounded w-full"></div>
                    </div>
                </div>
            @endfor
        </div>
    </div>
</div>
