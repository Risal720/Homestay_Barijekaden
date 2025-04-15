@props(['active'=> false])
<!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
<a {{ $attributes }} class="{{ $active ? 'rounded-md px-3 py-2 text-sm font-medium bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}" aria-current="{{ $active ? 'page' : false }}">{{ $slot }}
    
</a>