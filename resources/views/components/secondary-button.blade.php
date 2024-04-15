<button {{ $attributes->merge(['type' => 'submit', 'class' => 'px-4 py-2 bg-white border border-zinc-300 rounded-md font-semibold text-zinc-700 hover:bg-zinc-50 focus:bg-zinc-200 active:bg-zinc-50 focus:outline-none focus:ring-2 focus:ring-zinc-200 focus:ring-offset-2 transition ease-in-out duration-150 text-center w-full whitespace-nowrap']) }}>
    {{ $slot }}
</button>
