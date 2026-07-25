<header id="site-nav" class="sticky top-0 z-50 bg-[#FBF9F5]/95 backdrop-blur border-b border-navy/10 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between">
        <a href="{{ route('home') }}" class="flex items-center gap-2 shrink-0">
            <img src="{{ asset('images/logo.png') }}" alt="YAFNET logo" class="h-10 w-auto">
        </a>
        <nav class="hidden lg:flex items-center gap-8 text-sm font-medium">
            <a href="{{ route('about') }}" class="nav-link hover:text-gold transition">About</a>
            <a href="{{ route('programs.index') }}" class="nav-link hover:text-gold transition">Programs</a>
            <a href="{{ route('flagship.index') }}" class="nav-link hover:text-gold transition">Flagship Programs</a>
            <a href="{{ route('where-we-work') }}" class="nav-link hover:text-gold transition">Where We Work</a>
            <a href="{{ route('news.index') }}" class="nav-link hover:text-gold transition">News</a>
            <a href="{{ route('partners') }}" class="nav-link hover:text-gold transition">Partners</a>
            <a href="{{ route('governance') }}" class="nav-link hover:text-gold transition">Governance</a>
            <a href="{{ route('contact') }}" class="nav-link hover:text-gold transition">Contact</a>
        </nav>
        <div class="hidden lg:flex items-center gap-3">
            <a href="{{ route('get-involved') }}#donate" class="bg-gold hover:bg-gold-light text-navy font-semibold text-sm px-5 py-2.5 rounded-full transition">Donate</a>
            <a href="{{ route('get-involved') }}" class="border border-navy/20 hover:border-navy text-navy text-sm font-semibold px-5 py-2.5 rounded-full transition">Get Involved</a>
        </div>
        <button x-data @click="$dispatch('toggle-mobile-nav')" onclick="document.getElementById('mobile-nav').classList.toggle('hidden')" class="lg:hidden p-2" aria-label="Toggle menu">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
        </button>
    </div>
    <div id="mobile-nav" class="hidden lg:hidden border-t border-navy/10 px-4 py-4 space-y-3 bg-[#FBF9F5]">
        <a href="{{ route('about') }}" class="block py-1">About</a>
        <a href="{{ route('programs.index') }}" class="block py-1">Programs</a>
        <a href="{{ route('flagship.index') }}" class="block py-1">Flagship Programs</a>
        <a href="{{ route('where-we-work') }}" class="block py-1">Where We Work</a>
        <a href="{{ route('news.index') }}" class="block py-1">News</a>
        <a href="{{ route('partners') }}" class="block py-1">Partners</a>
        <a href="{{ route('governance') }}" class="block py-1">Governance</a>
        <a href="{{ route('contact') }}" class="block py-1">Contact</a>
        <a href="{{ route('get-involved') }}" class="block mt-2 bg-gold text-navy text-center font-semibold py-2 rounded-full">Get Involved</a>
    </div>
</header>