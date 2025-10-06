<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-6 py-3 bg-gradient-to-r from-red-600 to-black border border-transparent rounded-lg font-semibold text-sm text-white uppercase tracking-widest hover:from-red-700 hover:to-gray-900 focus:from-red-700 focus:to-gray-900 active:from-red-800 active:to-black focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-200 transform hover:scale-105']) }}>
    {{ $slot }}
</button>
