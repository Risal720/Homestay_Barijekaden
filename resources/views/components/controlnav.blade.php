    <div class="top-navbar">
        <div class="flex items-center h-16">
            <svg id="toggleSidebarBtn" class="ml-1 size-10 relative rounded bg-[#ffffff] p-1 text-[#7b521c] hover:bg-[#bf7029] focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-[#bf7029] focus:outline-hidden" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
            <div class="font-semibold px-6 ml-4">
                <a href="/">
                    <p class="text-[#bf7029] norican-regular">Barijekaden</p>
                </a>
            </div>
            <div class="bg-[#ffffff] text-center py-4 px- ml-auto mr-8 rounded-md">
                <p class="font-semibold text-2xl">{{ $slot }}</p>
            </div>
        </div>
    </div>