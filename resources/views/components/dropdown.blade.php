@props(['align' => 'right', 'width' => '48', 'contentClasses' => 'py-1 bg-white dark:bg-gray-700'])

@php
$alignmentClasses = match ($align) {
    'left' => 'ltr:origin-top-left rtl:origin-top-right start-0',
    'top' => 'origin-top',
    default => 'ltr:origin-top-right rtl:origin-top-left end-0',
};

$width = match ($width) {
    '48' => 'w-48',
    default => $width,
};
@endphp

<div class="relative" x-data="{ open: false }" @click.outside="open = false" @close.stop="open = false">
    <div @click="open = ! open">
        {{ $trigger }}
    </div>

    <div x-show="open"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="absolute z-50 mt-2 {{ $width }} rounded-md shadow-lg {{ $alignmentClasses }}"
            style="display: none;"
            @click="open = false">
        <div class="rounded-md ring-1 ring-black ring-opacity-5 bg-[#7692FF]">
            <style>
                .dropdown-link, .dropdown-link:visited {
                    color: #fff !important;
                    background: transparent !important;
                    border-radius: 0 !important;
                }
                .dropdown-link:first-child {
                    border-top-left-radius: 0.375rem !important;
                    border-top-right-radius: 0.375rem !important;
                }
                .dropdown-link:last-child {
                    border-bottom-left-radius: 0.375rem !important;
                    border-bottom-right-radius: 0.375rem !important;
                }
                .dropdown-link:hover, .dropdown-link:focus, .dropdown-link[aria-current="page"] {
                    background-color: #1B2CC1 !important;
                    color: #fff !important;
                }
            </style>
            <div class="text-white">
                {{ $content }}
            </div>
        </div>
    </div>
</div>
