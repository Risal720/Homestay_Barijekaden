<header class="bg-white shadow-sm fixed-header" >
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
      <h1 class="text-3xl font-bold tracking-tight text-gray-900">{{ $slot }}</h1>
    </div>
</header>

<style>
  .fixed-header {
    position: fixed;
    top: 4rem;
    left: 0;
    right: 0;
    z-index: 20;
}
</style>