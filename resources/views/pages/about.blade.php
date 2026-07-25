@extends('layouts.app')
@section('title', 'About Us — YAFNET')
@section('content')
<section class="max-w-5xl mx-auto px-6 py-20">
    <span class="kicker text-gold reveal">Who we are</span>
    <h1 class="font-heading text-4xl md:text-5xl font-800 mt-3 mb-6 reveal">About YAFNET</h1>
    <p class="text-navy/70 leading-relaxed mb-10 reveal">The Youth Action Forum for Networking (YAFNET) exists because young people in Kenya's border and ASAL counties face compounded challenges of conflict, limited economic opportunity, and a widening digital divide. We were founded to change that — building peace and opportunity from the ground up.</p>

    <div class="grid md:grid-cols-3 gap-8 mb-16" data-stagger>
        <div class="reveal bg-white rounded-2xl border border-navy/10 p-6 card-hover"><h3 class="font-heading font-semibold mb-2">Vision</h3><p class="text-sm text-navy/60">A peaceful, digitally empowered generation of young people across Kenya's ASAL counties.</p></div>
        <div class="reveal bg-white rounded-2xl border border-navy/10 p-6 card-hover"><h3 class="font-heading font-semibold mb-2">Mission</h3><p class="text-sm text-navy/60">To build peace, skills and opportunity for youth through digital literacy, dialogue and inclusive programming.</p></div>
        <div class="reveal bg-white rounded-2xl border border-navy/10 p-6 card-hover"><h3 class="font-heading font-semibold mb-2">Core Values</h3><p class="text-sm text-navy/60">Integrity, Inclusion, Innovation, Community Ownership, Peace.</p></div>
    </div>

    <h2 class="font-heading text-2xl font-700 mb-6 reveal">Theory of Change</h2>
    <div class="grid md:grid-cols-3 gap-6 mb-16 text-sm" data-stagger>
        <div class="reveal bg-navy text-white rounded-2xl p-6 card-hover"><strong class="text-gold">IF</strong><p class="mt-2">Youth gain digital, peacebuilding and livelihood skills</p></div>
        <div class="reveal bg-navy text-white rounded-2xl p-6 card-hover"><strong class="text-gold">AND</strong><p class="mt-2">Communities engage in structured cross-border dialogue</p></div>
        <div class="reveal bg-navy text-white rounded-2xl p-6 card-hover"><strong class="text-gold">THEN</strong><p class="mt-2">ASAL counties see reduced conflict and greater economic resilience</p></div>
    </div>

    <h2 class="font-heading text-2xl font-700 mb-6 reveal">Our Journey</h2>
    <ol class="border-l-2 border-gold pl-6 space-y-6 reveal">
        <li><strong>Phase 1 — Foundation:</strong> Establishing programs and trust in Moyale and Marsabit County.</li>
        <li><strong>Phase 2 — Consolidation:</strong> Scaling flagship programs and deepening partnerships.</li>
        <li><strong>Phase 3 — Regional/National Growth:</strong> Expansion across Kenya's 23 ASAL counties.</li>
    </ol>
</section>
@endsection