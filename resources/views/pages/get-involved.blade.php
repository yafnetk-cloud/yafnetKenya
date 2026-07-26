@extends('layouts.app')
@section('title', 'Get Involved — YAFNET')
@section('content')
<section id="donate" class="max-w-4xl mx-auto px-6 py-20">

    <span class="kicker text-gold reveal">Join us</span>
    <h1 class="font-heading text-4xl md:text-5xl font-800 mt-3 mb-6 reveal">
        Get Involved
    </h1>

    <div class="reveal bg-white border border-navy/10 rounded-2xl p-8 mb-14 card-hover">

        <h2 class="font-heading text-2xl font-700 mb-4">
            Donate
        </h2>

        <p class="text-navy/60 mb-6">
            Your support helps us empower youth, promote peace, and build resilient
            communities across ASAL regions.
        </p>

        @if(session('success'))
            <div class="mb-4 rounded-lg bg-green-100 text-green-700 p-4">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-4 rounded-lg bg-red-100 text-red-700 p-4">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-4 rounded-lg bg-red-100 text-red-700 p-4">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('donate.initiate') }}" method="POST">

            @csrf

            <input
                type="text"
                name="name"
                placeholder="Full Name"
                value="{{ old('name') }}"
                required
                class="border border-navy/20 rounded-lg px-4 py-3 w-full mb-4">

            <input
                type="email"
                name="email"
                placeholder="Email Address"
                value="{{ old('email') }}"
                required
                class="border border-navy/20 rounded-lg px-4 py-3 w-full mb-4">

            <input
                type="text"
                name="phone"
                placeholder="07XXXXXXXX"
                value="{{ old('phone') }}"
                required
                class="border border-navy/20 rounded-lg px-4 py-3 w-full mb-6">

            <input
                type="hidden"
                id="amount"
                name="amount">

            <h3 class="font-semibold mb-3">
                Select Donation Amount
            </h3>

            <div class="flex flex-wrap gap-3 mb-5">

                @foreach([500,1000,5000,10000] as $amt)

                    <button
                        type="button"
                        data-amount="{{ $amt }}"
                        class="donate-preset border border-navy/20 rounded-full px-6 py-2 hover:border-gold">

                        KES {{ number_format($amt) }}

                    </button>

                @endforeach

            </div>

            <div class="mb-6">

                <label class="block text-sm font-medium mb-2">
                    Or enter your own amount (KES)
                </label>

                <input
                    type="number"
                    id="custom-amount"
                    min="1"
                    placeholder="e.g. 2500"
                    class="border border-navy/20 rounded-lg px-4 py-3 w-full">

            </div>

            <button
                type="submit"
                id="donate-btn"
                class="btn-glow btn-lift bg-gold text-navy font-semibold px-8 py-3 rounded-full">

                Donate via M-Pesa

            </button>

        </form>

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
    <script>
document.addEventListener('DOMContentLoaded', function () {

    const presets = document.querySelectorAll('.donate-preset');
    const customInput = document.getElementById('custom-amount');
    const hiddenAmount = document.getElementById('amount');
    const form = document.querySelector('form[action="{{ route('donate.initiate') }}"]');

    function setAmount(amount) {

        hiddenAmount.value = amount;

        presets.forEach(btn => {

            btn.classList.remove(
                'border-gold',
                'bg-gold',
                'text-navy'
            );

            if (btn.dataset.amount == amount) {

                btn.classList.add(
                    'border-gold',
                    'bg-gold',
                    'text-navy'
                );

            }

        });

    }

    presets.forEach(btn => {

        btn.addEventListener('click', function () {

            customInput.value = '';

            setAmount(this.dataset.amount);

        });

    });

    customInput.addEventListener('input', function () {

        presets.forEach(btn => {

            btn.classList.remove(
                'border-gold',
                'bg-gold',
                'text-navy'
            );

        });

        hiddenAmount.value = this.value;

    });

    form.addEventListener('submit', function(e){

        if(hiddenAmount.value === '' || Number(hiddenAmount.value) <= 0){

            e.preventDefault();

            alert('Please select or enter a donation amount.');

        }

    });

});
</script>
</section>
@endsection


