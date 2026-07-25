<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') — YAFNET Admin</title>
    <script>
      // Apply saved theme + sidebar color BEFORE paint, to avoid a flash of default styling.
      (function () {
        var theme = localStorage.getItem('yafnet_admin_theme') || 'light';
        if (theme === 'dark') document.documentElement.classList.add('dark');
        var sidebarColor = localStorage.getItem('yafnet_admin_sidebar_color') || '#0B2545';
        document.documentElement.style.setProperty('--sidebar-bg', sidebarColor);
      })();
    </script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = {
        darkMode: 'class',
        theme: {
          extend: {
            colors: {
              navy: { DEFAULT: '#0B2545', dark: '#061829', light: '#13355F' },
              gold: { DEFAULT: '#D9A441', light: '#F0C878', dark: '#B3822C' },
            },
          }
        }
      }
    </script>
    <style>
      body { font-family: 'Manrope', ui-sans-serif, system-ui, sans-serif; }
      [data-swatch] { transition: transform .15s ease; }
      [data-swatch]:hover { transform: scale(1.15); }
      [data-swatch].active { box-shadow: 0 0 0 2px white, 0 0 0 4px var(--sidebar-bg); }

      /* ---- Force readable text in both themes across every admin page ---- */
      html.dark body { background-color: #0f172a !important; color: #f1f5f9 !important; }
      html.dark .bg-white { background-color: #1e293b !important; }
      html.dark .bg-gray-50 { background-color: #0f172a !important; }
      html.dark .text-gray-900,
      html.dark .text-gray-800,
      html.dark .text-gray-700,
      html.dark .text-gray-600,
      html.dark h1, html.dark h2, html.dark h3, html.dark label,
      html.dark p, html.dark span, html.dark div, html.dark a { color: #f1f5f9 !important; }
      html.dark .text-gray-500,
      html.dark .text-gray-400 { color: #94a3b8 !important; }
      html.dark .border, html.dark .border-t, html.dark .border-b,
      html.dark .divide-y > * + * { border-color: #334155 !important; }
      html.dark input, html.dark select, html.dark textarea {
        background-color: #1e293b !important; color: #f1f5f9 !important; border-color: #334155 !important;
      }
      html.dark input::placeholder, html.dark textarea::placeholder { color: #64748b !important; }
      html.dark .text-red-600, html.dark .text-red-700 { color: #f87171 !important; }
      html.dark .text-blue-600 { color: #60a5fa !important; }
      html.dark .text-green-800 { color: #86efac !important; }
      html.dark .bg-green-50 { background-color: #14532d !important; }
      html.dark .bg-red-50 { background-color: #450a0a !important; }

      /* ---- Light mode: keep everything explicitly dark-on-light ---- */
      html:not(.dark) body { color: #111827; }
    </style>
</head>
<body class="bg-gray-50 dark:bg-slate-900 text-gray-900 dark:text-gray-100 transition-colors duration-200">
<div class="flex min-h-screen">

    <!-- Sidebar -->
    <aside class="w-64 flex-shrink-0 hidden md:flex md:flex-col justify-between text-white" style="background: var(--sidebar-bg, #0B2545);">
        <div>
            <div class="p-6 flex items-center gap-2">
                <span class="font-bold text-xl">YAFNET <span class="text-yellow-400">Admin</span></span>
            </div>
            <nav class="px-3 space-y-1 text-sm">
                @php
                    $navItems = [
                        ['route' => 'admin.dashboard', 'label' => 'Dashboard', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>'],
                        ['route' => 'admin.news.index', 'label' => 'News & Stories', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>'],
                        ['route' => 'admin.programs.index', 'label' => 'Programs', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>'],
                        ['route' => 'admin.partners.index', 'label' => 'Partners', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m6-1.13a4 4 0 10-4-4 4 4 0 004 4zm6 0a4 4 0 10-4-4"/>'],
                        ['route' => 'admin.team.index', 'label' => 'Team / Leadership', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>'],
                        ['route' => 'admin.stats.index', 'label' => 'Impact Stats', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2"/>'],
                        ['route' => 'admin.jobs.index', 'label' => 'Jobs / Volunteering', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M20 7h-3V5a2 2 0 00-2-2H9a2 2 0 00-2 2v2H4a1 1 0 00-1 1v3a2 2 0 002 2h14a2 2 0 002-2V8a1 1 0 00-1-1zM9 5h6v2H9V5zm11 8.5V17a2 2 0 01-2 2H6a2 2 0 01-2-2v-3.5"/>'],
                        ['route' => 'admin.media.index', 'label' => 'Media Library', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14M4 8h16M4 4h16a1 1 0 011 1v14a1 1 0 01-1 1H4a1 1 0 01-1-1V5a1 1 0 011-1z"/>'],
                        ['route' => 'admin.submissions.index', 'label' => 'Form Submissions', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>'],
                        ['route' => 'admin.settings.edit', 'label' => 'Site Settings', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>'],
                    ];
                @endphp

                @foreach($navItems as $item)
                    <a href="{{ route($item['route']) }}"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-colors {{ request()->routeIs($item['route'].'*') || request()->routeIs(str_replace('.index','.*', $item['route'])) ? 'bg-white/15 font-semibold' : 'hover:bg-white/10 text-white/85' }}">
                        <svg class="w-4.5 h-4.5 shrink-0" width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">{!! $item['icon'] !!}</svg>
                        <span>{{ $item['label'] }}</span>
                    </a>
                @endforeach

                @if(auth()->user()?->isSuperAdmin())
                    <a href="{{ route('admin.users.index') }}"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-colors {{ request()->routeIs('admin.users.*') ? 'bg-white/15 font-semibold' : 'hover:bg-white/10 text-white/85' }}">
                        <svg class="w-4.5 h-4.5 shrink-0" width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        <span>Admin Users</span>
                    </a>
                @endif
            </nav>
        </div>

        <div class="p-4 border-t border-white/10 space-y-4">
            <!-- Sidebar color picker -->
            <div>
                <p class="text-[11px] uppercase tracking-wide text-white/50 mb-2">Sidebar color</p>
                <div class="flex gap-2 flex-wrap" id="sidebar-swatches">
                   @foreach(['#0B2545' => 'Navy', '#312e81' => 'Indigo', '#065f46' => 'Emerald', '#7c2d12' => 'Rust', '#1e293b' => 'Slate', '#831843' => 'Rose', '#000000' => 'Black'] as $hex => $label)
                        <button type="button" data-swatch data-color="{{ $hex }}" title="{{ $label }}"
                                class="w-6 h-6 rounded-full border border-white/20" style="background: {{ $hex }};"></button>
                    @endforeach
                </div>
            </div>

            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button class="w-full text-left text-sm px-3 py-2 rounded-lg hover:bg-white/10 text-white/85 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    Log out
                </button>
            </form>
        </div>
    </aside>

    <!-- Main -->
    <div class="flex-1 flex flex-col min-w-0">
        <!-- Top bar -->
        <header class="bg-white dark:bg-slate-800 border-b border-gray-200 dark:border-slate-700 px-6 py-3 flex items-center justify-between transition-colors">
            <h2 class="text-sm font-semibold text-gray-500 dark:text-gray-400">@yield('title', 'Dashboard')</h2>
            <button id="theme-toggle" type="button"
                    class="flex items-center gap-2 text-sm px-3 py-1.5 rounded-full border border-gray-300 dark:border-slate-600 hover:bg-gray-100 dark:hover:bg-slate-700 transition-colors">
                <svg id="theme-icon-light" class="w-4 h-4 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                <svg id="theme-icon-dark" class="w-4 h-4 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
                <span id="theme-label">Theme</span>
            </button>
        </header>

        <main class="flex-1 p-6 md:p-10">
            <div class="max-w-5xl mx-auto">
                @if(session('success'))
                    <div class="bg-green-50 dark:bg-green-900/30 border border-green-300 dark:border-green-700 text-green-800 dark:text-green-300 rounded-xl px-4 py-3 text-sm mb-6">{{ session('success') }}</div>
                @endif
                @if($errors->any())
                    <div class="bg-red-50 dark:bg-red-900/30 border border-red-300 dark:border-red-700 text-red-800 dark:text-red-300 rounded-xl px-4 py-3 text-sm mb-6">
                        <ul class="list-disc pl-5">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                    </div>
                @endif
                @yield('content')
            </div>
        </main>
    </div>
</div>

<script>
  // Theme toggle
  var htmlEl = document.documentElement;
  var themeBtn = document.getElementById('theme-toggle');
  var iconLight = document.getElementById('theme-icon-light');
  var iconDark = document.getElementById('theme-icon-dark');
  var themeLabel = document.getElementById('theme-label');

  function refreshThemeUI() {
    var isDark = htmlEl.classList.contains('dark');
    iconLight.classList.toggle('hidden', isDark);
    iconDark.classList.toggle('hidden', !isDark);
    themeLabel.textContent = isDark ? 'Dark' : 'Light';
  }
  refreshThemeUI();

  themeBtn.addEventListener('click', function () {
    htmlEl.classList.toggle('dark');
    var isDark = htmlEl.classList.contains('dark');
    localStorage.setItem('yafnet_admin_theme', isDark ? 'dark' : 'light');
    refreshThemeUI();
  });

  // Sidebar color picker
  var swatches = document.querySelectorAll('[data-swatch]');
  var currentColor = localStorage.getItem('yafnet_admin_sidebar_color') || '#0B2545';

  function markActiveSwatch() {
    swatches.forEach(function (btn) {
      btn.classList.toggle('active', btn.dataset.color.toLowerCase() === currentColor.toLowerCase());
    });
  }
  markActiveSwatch();

  swatches.forEach(function (btn) {
    btn.addEventListener('click', function () {
      currentColor = btn.dataset.color;
      htmlEl.style.setProperty('--sidebar-bg', currentColor);
      localStorage.setItem('yafnet_admin_sidebar_color', currentColor);
      markActiveSwatch();
    });
  });
</script>
</body>
</html>