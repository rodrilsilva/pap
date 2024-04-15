<button {{ $attributes->merge(['type' => 'submit', 'class' => 'px-4 py-2 bg-violet-600 border border-transparent rounded-md font-semibold text-white hover:bg-violet-500 focus:bg-violet-600 active:bg-violet-900 focus:outline-none focus:ring-2 focus:ring-violet-500 focus:ring-offset-2 transition ease-in-out duration-150 text-center w-full whitespace-nowrap h-min']) }}>
    {{ $slot }}
</button>
