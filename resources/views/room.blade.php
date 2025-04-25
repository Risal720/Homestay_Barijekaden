<x-layout>
    <x-slot:tittle>{{ $tittle }}</x-slot:tittle>
    
    <article class="py-8 max-w-screen-md border-b">
      <h2 class="mb-1 text-3xl tracking-tight font-bold text-gray-900">{{ $room['tittle'] }}</h2>
      <div class="text-base text-gray-500">
        <a href="#">{{ $room['author'] }}</a> | {{ $room->created_at->diffForHumans()}}
      </div>
      <p class="my-4 font-light">{{ $room['body'] }}</p>
      <a href="/rooms" class="font-medium text-blue-500 hover:underline">&laquo;Back To Room</a>
    </article>
  
  </x-layout>