<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'YAFNET — Empowering Youth. Building Peace.')</title>
    <meta name="description" content="@yield('meta_description', 'Youth Action Forum for Networking (YAFNET) — peacebuilding, digital literacy and youth empowerment across Kenya\'s ASAL counties.')">
    <meta property="og:title" content="@yield('title', 'YAFNET')">
    <meta property="og:description" content="@yield('meta_description', 'Empowering Youth. Building Peace. Transforming ASAL Communities.')">
    <meta property="og:type" content="website">
    <link rel="icon" href="/favicon.ico">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = {
        theme: {
          extend: {
            colors: {
              navy: { DEFAULT: '#0B2545', dark: '#061829', light: '#13355F' },
              gold: { DEFAULT: '#D9A441', light: '#F0C878', dark: '#B3822C' },
            },
            fontFamily: {
              heading: ['Sora', 'ui-sans-serif', 'system-ui'],
              body: ['Manrope', 'ui-sans-serif', 'system-ui'],
            },
            boxShadow: {
              glow: '0 0 40px -10px rgba(217,164,65,0.45)',
              soft: '0 20px 60px -20px rgba(11,37,69,0.25)',
            },
          }
        }
      }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700;800&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
      :root {
        --navy: #0B2545;
        --gold: #D9A441;
      }
      * { scroll-behavior: smooth; }
html, body { overflow-x: hidden; max-width: 100%; }
body {
  font-family: 'Manrope', sans-serif;
  background:
    radial-gradient(1200px 600px at 100% -10%, rgba(217,164,65,0.06), transparent 60%),
    radial-gradient(900px 500px at -10% 20%, rgba(11,37,69,0.05), transparent 55%),
    #FBF9F5;
}
      h1,h2,h3,h4,h5,.font-heading { font-family: 'Sora', sans-serif; letter-spacing: -0.01em; }

      @media (prefers-reduced-motion: reduce) {
        *,*::before,*::after { animation-duration: 0.001ms !important; animation-iteration-count: 1 !important; transition-duration: 0.001ms !important; scroll-behavior: auto !important; }
      }

      /* ---------- Scroll reveal ---------- */
      .reveal { opacity: 0; transform: translateY(28px); transition: opacity .8s cubic-bezier(.22,1,.36,1), transform .8s cubic-bezier(.22,1,.36,1); }
      .reveal.is-visible { opacity: 1; transform: translateY(0); }
      .reveal-scale { opacity: 0; transform: scale(.94); transition: opacity .7s ease, transform .7s cubic-bezier(.22,1,.36,1); }
      .reveal-scale.is-visible { opacity: 1; transform: scale(1); }
      .reveal-left { opacity: 0; transform: translateX(-32px); transition: opacity .8s ease, transform .8s cubic-bezier(.22,1,.36,1); }
      .reveal-left.is-visible { opacity: 1; transform: translateX(0); }
      .reveal-right { opacity: 0; transform: translateX(32px); transition: opacity .8s ease, transform .8s cubic-bezier(.22,1,.36,1); }
      .reveal-right.is-visible { opacity: 1; transform: translateX(0); }
      [data-stagger] .reveal:nth-child(1) { transition-delay: .05s; }
      [data-stagger] .reveal:nth-child(2) { transition-delay: .15s; }
      [data-stagger] .reveal:nth-child(3) { transition-delay: .25s; }
      [data-stagger] .reveal:nth-child(4) { transition-delay: .35s; }
      [data-stagger] .reveal:nth-child(5) { transition-delay: .45s; }

      /* ---------- Nav ---------- */
      .nav-link { position: relative; }
      .nav-link::after {
        content: ''; position: absolute; left: 0; bottom: -6px; width: 0; height: 2px;
        background: linear-gradient(90deg, var(--gold), #F0C878);
        transition: width .3s cubic-bezier(.22,1,.36,1);
      }
      .nav-link:hover::after, .nav-link.active::after { width: 100%; }

      /* ---------- Buttons ---------- */
      .btn-glow { position: relative; overflow: hidden; isolation: isolate; }
      .btn-glow::before {
        content: ''; position: absolute; inset: 0; z-index: -1;
        background: linear-gradient(120deg, transparent, rgba(255,255,255,.55), transparent);
        transform: translateX(-120%); transition: transform .6s ease;
      }
      .btn-glow:hover::before { transform: translateX(120%); }
      .btn-lift { transition: transform .35s cubic-bezier(.22,1,.36,1), box-shadow .35s ease; }
      .btn-lift:hover { transform: translateY(-3px); box-shadow: 0 16px 30px -12px rgba(11,37,69,.35); }

      /* ---------- Cards ---------- */
      .card-hover { transition: transform .45s cubic-bezier(.22,1,.36,1), box-shadow .45s ease, border-color .45s ease; }
      .card-hover:hover { transform: translateY(-8px); box-shadow: 0 30px 60px -25px rgba(11,37,69,.35); border-color: rgba(217,164,65,.55); }
      .img-zoom { overflow: hidden; }
      .img-zoom img, .img-zoom .img-fill { transition: transform .7s cubic-bezier(.22,1,.36,1); }
      .img-zoom:hover img, .img-zoom:hover .img-fill { transform: scale(1.08); }

      /* ---------- Hero ---------- */
      .hero-bg {
        background-image:
          linear-gradient(180deg, rgba(6,24,41,.75), rgba(6,24,41,.92)),
          url('/images/hero-bg.jpg');
        background-size: cover; background-position: center;
        will-change: transform;
      }
      .hero-orb {
        position: absolute; border-radius: 9999px; filter: blur(60px); opacity: .35;
        animation: float 9s ease-in-out infinite;
      }
      @keyframes float {
        0%, 100% { transform: translate(0,0) scale(1); }
        50% { transform: translate(18px,-24px) scale(1.08); }
      }
      .grain {
        position: absolute; inset: 0; pointer-events: none; opacity: .05; mix-blend-mode: overlay;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='120' height='120'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='2' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E");
      }
      .kicker {
        display: inline-flex; align-items: center; gap: .5rem;
        font-size: .75rem; font-weight: 700; letter-spacing: .14em; text-transform: uppercase;
      }
      .kicker::before { content: ''; width: 22px; height: 2px; background: var(--gold); display: inline-block; }

      /* ---------- Marquee (partner strip) ---------- */
      .marquee-track { display: flex; gap: 3.5rem; animation: marquee 28s linear infinite; width: max-content; }
      .marquee-track:hover { animation-play-state: paused; }
      @keyframes marquee { from { transform: translateX(0); } to { transform: translateX(-50%); } }

      /* ---------- Misc ---------- */
      .divider-gradient { height: 1px; background: linear-gradient(90deg, transparent, rgba(11,37,69,.15), transparent); }
      ::selection { background: var(--gold); color: #061829; }
      .skip-link:focus { position: fixed; top: 1rem; left: 1rem; z-index: 100; background: #061829; color: #fff; padding: .75rem 1.25rem; border-radius: .5rem; }
    </style>
    @stack('head')
</head>
<body class="bg-[#FBF9F5] text-navy antialiased">
    <a href="#main" class="skip-link sr-only">Skip to content</a>

    @include('partials.nav')

    <main id="main">
        @if (session('success'))
            <div class="max-w-3xl mx-auto mt-6 px-4">
                <div class="bg-green-50 border border-green-300 text-green-800 rounded-xl px-4 py-3 text-sm shadow-sm">
                    {{ session('success') }}
                </div>
            </div>
        @endif
        @yield('content')
    </main>

    @include('partials.footer')

    @stack('scripts')

    <!-- Back to top -->
    <button id="back-to-top" aria-label="Back to top"
        class="fixed bottom-6 right-6 z-40 w-11 h-11 rounded-full bg-navy text-white shadow-soft flex items-center justify-center opacity-0 pointer-events-none translate-y-3 transition-all duration-300 hover:bg-gold hover:text-navy">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 15l7-7 7 7"/></svg>
    </button>

    <script>
      // ---------- Scroll reveal (fades / scales / slides) ----------
      const revealEls = document.querySelectorAll('.reveal, .reveal-scale, .reveal-left, .reveal-right');
      const revealObserver = new IntersectionObserver((entries) => {
        entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('is-visible'); revealObserver.unobserve(e.target); } });
      }, { threshold: 0.15, rootMargin: '0px 0px -40px 0px' });
      revealEls.forEach(el => revealObserver.observe(el));

      // ---------- Animated counters ----------
      document.querySelectorAll('[data-counter]').forEach(el => {
        const target = parseInt(el.dataset.counter, 10);
        let started = false;
        const io = new IntersectionObserver((entries) => {
          entries.forEach(entry => {
            if (entry.isIntersecting && !started) {
              started = true;
              const duration = 1400;
              const startTime = performance.now();
              const ease = t => 1 - Math.pow(1 - t, 3);
              const tick = (now) => {
                const progress = Math.min((now - startTime) / duration, 1);
                el.textContent = Math.floor(ease(progress) * target).toLocaleString();
                if (progress < 1) requestAnimationFrame(tick); else el.textContent = target.toLocaleString();
              };
              requestAnimationFrame(tick);
            }
          });
        }, { threshold: 0.4 });
        io.observe(el);
      });

      // ---------- Sticky nav shrink + shadow on scroll ----------
      const nav = document.getElementById('site-nav');
      const backToTop = document.getElementById('back-to-top');
      window.addEventListener('scroll', () => {
        const y = window.scrollY;
        if (nav) {
          if (y > 40) nav.classList.add('shadow-lg', 'py-2'); else nav.classList.remove('shadow-lg', 'py-2');
        }
        if (backToTop) {
          if (y > 480) backToTop.classList.remove('opacity-0', 'pointer-events-none', 'translate-y-3');
          else backToTop.classList.add('opacity-0', 'pointer-events-none', 'translate-y-3');
        }
      }, { passive: true });
      backToTop?.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));

      // ---------- Subtle parallax on hero background ----------
      document.querySelectorAll('[data-parallax]').forEach(el => {
        window.addEventListener('scroll', () => {
          const speed = parseFloat(el.dataset.parallax) || 0.15;
          const offset = window.scrollY * speed;
          el.style.transform = `translate3d(0, ${offset}px, 0)`;
        }, { passive: true });
      });

      // ---------- Magnetic buttons (subtle cursor pull) ----------
      document.querySelectorAll('[data-magnetic]').forEach(btn => {
        btn.addEventListener('mousemove', (e) => {
          const r = btn.getBoundingClientRect();
          const x = (e.clientX - r.left - r.width / 2) * 0.25;
          const y = (e.clientY - r.top - r.height / 2) * 0.25;
          btn.style.transform = `translate(${x}px, ${y}px)`;
        });
        btn.addEventListener('mouseleave', () => { btn.style.transform = 'translate(0,0)'; });
      });
    </script>
</body>
</html>
