@extends('layouts.app')
@section('title', 'Contact Us — YAFNET')
@section('content')
<section class="max-w-6xl mx-auto px-6 py-20 grid md:grid-cols-2 gap-12">
    <div class="reveal-left">
        <span class="kicker text-gold">Get in touch</span>
        <h1 class="font-heading text-4xl md:text-5xl font-800 mt-3 mb-6">Contact Us</h1>
        <p class="text-navy/60 mb-8">We'd love to hear from you — whether you're a partner, donor, volunteer or community member.</p>
        <div class="space-y-4 text-sm">
            <p><strong>Nairobi HQ:</strong> Nairobi, Kenya</p>
            <p><strong>Moyale Field Office:</strong> Moyale, Marsabit County, Kenya</p>
            <p><strong>Email:</strong> info@yafnet.org</p>
        </div>
        <div class="h-64 rounded-2xl mt-8 overflow-hidden border border-navy/10 reveal-scale">
            <iframe
                src="https://www.google.com/maps?q=Hurlingham,+Nairobi,+Kenya&output=embed"
                width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade" title="YAFNET Nairobi office location — Hurlingham">
            </iframe>
        </div>
    </div>
    <form action="{{ route('contact.submit') }}" method="POST" class="reveal-right bg-white border border-navy/10 rounded-2xl p-8 space-y-4 h-fit card-hover">
        @csrf
        <input name="name" required placeholder="Full name" class="w-full border border-navy/20 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-gold/40">
        <input type="email" name="email" required placeholder="Email" class="w-full border border-navy/20 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-gold/40">
        <input name="phone" placeholder="Phone (optional)" class="w-full border border-navy/20 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-gold/40">
        <input name="subject" placeholder="Subject" class="w-full border border-navy/20 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-gold/40">
        <textarea name="message" required rows="5" placeholder="Your message" class="w-full border border-navy/20 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-gold/40"></textarea>
        <button data-magnetic class="btn-glow btn-lift bg-navy text-white font-semibold px-8 py-3 rounded-full w-full">Send Message</button>
    </form>
</section>
@endsection