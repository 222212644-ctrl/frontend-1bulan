<header 
    x-data="{ isScrolled: false }" 
    x-init="window.addEventListener('scroll', () => { isScrolled = window.scrollY > 0 })"
    :class="isScrolled ? 'backdrop-blur-md bg-[#F9F8F4]/80 shadow-lg' : 'bg-[#F9F8F4] shadow-md'"
    class="fixed top-0 left-0 w-full z-50 transition-all duration-300 font-posterable"
>
    <div class="container mx-auto px-4 flex justify-between items-center py-4">
        <!-- Logo -->
        <div class="flex items-center space-x-4">
            <a href="/">
                <img src="{{ asset('img/logobps2.png') }}" alt="Logo" class="h-12 w-auto">
            </a>
            <a href="/">
                <div>
                    <h1 class="text-lg  font-semibold">BPS Kota Medan</h1>
                </div>
            </a>
        </div>

        <!-- Mobile Menu Button -->
        <button 
            class="lg:hidden text-green-800 focus:outline-none hover:text-green-600 transition"
            wire:click="toggleMenu"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                    d="M4 6h16M4 12h16m-7 6h7" />
            </svg>
        </button>

        <!-- Navigation Links (Desktop) -->
        <nav class="hidden lg:flex items-center space-x-8 ">
            <a wire:navigate href="/" class="hover:text-green-600 hover:border-b-4 hover:border-green-800">Beranda</a>
            <a href="{{ route('petausaha') }}" class="hover:text-green-600 hover:border-b-4 hover:border-green-800">Peta Usaha</a>
            <a wire:navigate href="/kuisioner"
                class="bg-green-800 text-white px-4 py-2 rounded hover:bg-green-600">Kuesioner</a>
        </nav>
    </div>

    <!-- Mobile Navigation Links -->
    @if ($isMenuOpen)
        <div class="lg:hidden bg-[#F9F8F4]/90 backdrop-blur-md flex flex-col space-y-2 px-4 py-4">
            <a href="/" class="hover:text-green-600">Beranda</a>
            <a href="/petausaha" class="hover:text-green-600">Peta Usaha</a>
            <a href="/kuisioner" class="bg-green-800 text-white px-4 py-2 rounded hover:bg-green-600">Kuesioner</a>
        </div>
    @endif
</header>

<!-- Alpine.js -->
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
