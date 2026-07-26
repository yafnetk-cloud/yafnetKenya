<footer class="bg-navy text-white/90 mt-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 grid grid-cols-1 md:grid-cols-4 gap-10">
        <div>
            <div class="inline-block bg-white/95 rounded-lg px-3 py-2 mb-3">
                <img src="{{ asset('images/logo.png') }}" alt="YAFNET logo" class="h-8 w-auto">
            </div>
            <p class="text-sm text-white/70 leading-relaxed">Youth Action Forum for Networking — empowering youth and building peace across Kenya's ASAL counties.</p>
            <div class="flex gap-3 mt-4">
                <a href="#" aria-label="Facebook" class="hover:text-gold">FB</a>
                <a href="#" aria-label="Twitter/X" class="hover:text-gold">X</a>
                <a href="#" aria-label="LinkedIn" class="hover:text-gold">In</a>
                <a href="#" aria-label="Instagram" class="hover:text-gold">IG</a>
            </div>
        </div>
        <div>
            <h4 class="font-heading font-semibold text-white mb-3">Quick Links</h4>
            <ul class="space-y-2 text-sm text-white/70">
                <li><a href="{{ route('about') }}" class="hover:text-gold">About Us</a></li>
                <li><a href="{{ route('programs.index') }}" class="hover:text-gold">Programs</a></li>
                <li><a href="{{ route('news.index') }}" class="hover:text-gold">News &amp; Stories</a></li>
                <li><a href="{{ route('get-involved') }}" class="hover:text-gold">Careers</a></li>
            </ul>
        </div>
        <div>
            <h4 class="font-heading font-semibold text-white mb-3">Offices</h4>
            <p class="text-sm text-white/70">Nairobi HQ, Kenya</p>
            <p class="text-sm text-white/70">Moyale Field Office, Marsabit County</p>
        </div>
        <div>
            <h4 class="font-heading font-semibold text-white mb-3">Newsletter</h4>
            <form action="{{ route('newsletter.submit') }}" method="POST" class="flex gap-2">
                @csrf
                <input type="email" name="email" required placeholder="Your email" class="w-full rounded-full px-4 py-2 text-navy text-sm">
                <button class="bg-gold text-navy px-4 py-2 rounded-full text-sm font-semibold">Join</button>
            </form>
        </div>
    </div>
    <div class="border-t border-white/10 py-6 text-center text-xs text-white/50">
        &copy; {{ date('Y') }} YAFNET. All rights reserved. Aligned with SDGs 1, 4, 5, 6, 8, 10, 13, 16, 17 &amp; Kenya Vision 2030.
    </div>
</footer>
