@extends('layouts.app')
@section('title', 'Get Involved — YAFNET')
@section('content')
<section id="donate" class="max-w-4xl mx-auto px-6 py-20">
    <span class="kicker text-gold reveal">Join us</span>
    <h1 class="font-heading text-4xl md:text-5xl font-800 mt-3 mb-6 reveal">Get Involved</h1>

    <div class="reveal bg-white border border-navy/10 rounded-2xl p-8 mb-14 card-hover">
        <h2 class="font-heading text-2xl font-700 mb-4">Donate</h2>
        <p class="text-navy/60 mb-6">Your support funds digital literacy training, peace dialogues and livelihood pathways for youth. [Wire Stripe / Paystack / M-Pesa checkout here in production.]</p>
        <div class="flex flex-wrap gap-3">
            @foreach([500,1000,5000,10000] as $amt)
                <button type="button" class="btn-lift border border-navy/20 rounded-full px-6 py-2 text-sm font-semibold hover:border-gold">KES {{ number_format($amt) }}</button>
            @endforeach
        </div>
        <button data-magnetic class="btn-glow btn-lift mt-6 bg-gold text-navy font-semibold px-8 py-3 rounded-full">Donate Now</button>
    </div>

    <div id="volunteer" class="reveal bg-white border border-navy/10 rounded-2xl p-8 mb-14 card-hover">
        <h2 class="font-heading text-2xl font-700 mb-4">Volunteer / Partner With Us</h2>
        <form action="{{ route('volunteer.submit') }}" method="POST" class="grid md:grid-cols-2 gap-4">
            @csrf
            <input name="name" required placeholder="Full name" class="border border-navy/20 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-gold/40">
            <input type="email" name="email" required placeholder="Email" class="border border-navy/20 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-gold/40">
            <input name="phone" placeholder="Phone (optional)" class="border border-navy/20 rounded-lg px-4 py-3 text-sm md:col-span-2 focus:outline-none focus:ring-2 focus:ring-gold/40">
            <textarea name="message" required placeholder="Tell us how you'd like to be involved" rows="4" class="border border-navy/20 rounded-lg px-4 py-3 text-sm md:col-span-2 focus:outline-none focus:ring-2 focus:ring-gold/40"></textarea>
            <button class="btn-lift bg-navy text-white font-semibold px-8 py-3 rounded-full md:col-span-2">Submit</button>
        </form>
    </div>

    <div id="careers" class="reveal">
        <h2 class="font-heading text-2xl font-700 mb-6">Careers &amp; Opportunities</h2>
        <div class="space-y-4" data-stagger>
            @forelse($jobs as $job)
                <div class="reveal bg-white border border-navy/10 rounded-2xl p-6 flex items-center justify-between flex-wrap gap-3 card-hover">
                    <div>
                        <h3 class="font-heading font-semibold">{{ $job->title }}</h3>
                        <p class="text-sm text-navy/60">{{ $job->type }} · {{ $job->location }}</p>
                    </div>
                    @if($job->closing_date)
                        <span class="text-xs text-navy/50">Closes {{ $job->closing_date->format('M j, Y') }}</span>
                    @endif
                </div>
            @empty
                <p class="text-navy/50">No open opportunities at the moment — check back soon.</p>
            @endforelse
        </div>
    </div>
</section>
@endsection


