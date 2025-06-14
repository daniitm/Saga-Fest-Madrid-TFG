<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-[#7692FF] hover:bg-[#1B2CC1] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring-0 active:ring-0 active:outline-none transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>