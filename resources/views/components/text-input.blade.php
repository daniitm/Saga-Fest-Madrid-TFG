@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'bg-[#232323] text-white border-[#7692FF] placeholder-gray-400 focus:border-[#1B2CC1] focus:ring-[#1B2CC1] rounded-md shadow-sm']) }}>
