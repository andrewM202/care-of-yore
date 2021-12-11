<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 border-gray-500 rounded-md py-2 bg-green-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-green-400 active:bg-green-600 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
