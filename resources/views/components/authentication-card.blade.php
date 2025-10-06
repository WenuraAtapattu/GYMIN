<div class="flex flex-col items-center">
    <div class="mb-6">
        {{ $logo }}
    </div>

    <div class="w-full bg-white bg-opacity-95 shadow-2xl overflow-hidden rounded-2xl border border-gray-200">
        <div class="px-8 py-6">
            {{ $slot }}
        </div>
    </div>
</div>
