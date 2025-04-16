<x-layout>
  <x-slot:tittle>{{ $tittle }}</x-slot:tittle>
  
@foreach ($rooms as $room)
  <article class="py-8 max-w-screen-md border-b border-gray-300">
    <a href="/rooms/{{ $room['slug'] }}" class="hover:underline">
      <h2 class="mb-1 text-3xl tracking-tight font-bold text-gray-900">{{ $room['tittle'] }}</h2>
    </a>
    <div class="text-base text-gray-500">
      <a href="#">{{ $room['author'] }}</a> | 15 April 2025
    </div>
    <p class="my-4 font-light">{{ Str::limit($room['body'],150) }}</p>
    <a href="/rooms/{{ $room['slug'] }}" class="font-medium text-blue-500 hover:underline">Read more &raquo;</a>
  </article>
@endforeach

</x-layout>