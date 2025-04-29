@props(['active'=> false])
<!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
<a {{ $attributes }} class="{{ $active ? 'rounded-md px-3 py-2 text-sm font-medium bg-[#5e3d13] text-white' : 'text-[#bf7029] hover:bg-[#885318] hover:text-white hover:rounded-[4px]' }}" aria-current="{{ $active ? 'page' : false }}">{{ $slot }}
    
</a>