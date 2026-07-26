@extends('layouts.app')
@section('title', 'Where We Work — YAFNET')

@push('head')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="">
<style>
    #kenya-map { height: 560px; width: 100%; background: #eef1f5; }
    .leaflet-popup-content-wrapper { border-radius: 10px; }
    .map-legend { font-size: .75rem; }
    .map-legend .dot { width: 12px; height: 12px; border-radius: 3px; display: inline-block; margin-right: 6px; vertical-align: middle; }
</style>
@endpush

@section('content')
<section class="max-w-6xl mx-auto px-6 py-20">
    <span class="kicker text-gold reveal">Our reach</span>
    <h1 class="font-heading text-4xl md:text-5xl font-800 mt-3 mb-4 reveal">Where We Work</h1>
    <p class="text-navy/60 max-w-2xl mb-10 reveal">YAFNET is headquartered in Nairobi with a field office in Moyale, Marsabit County, and works across Kenya's 23 arid and semi-arid land (ASAL) counties.</p>

    <div id="kenya-map" class="rounded-2xl overflow-hidden border border-navy/10 reveal-scale"></div>

    <div class="flex flex-wrap gap-x-6 gap-y-2 mt-4 map-legend text-navy/60 reveal">
        <span><span class="dot" style="background:#0B2545"></span>Nairobi HQ &amp; Moyale field office</span>
        <span><span class="dot" style="background:#D9A441"></span>Arid counties</span>
        <span><span class="dot" style="background:#F0C878"></span>Semi-arid counties</span>
        <span><span class="dot" style="background:#e7e9ec"></span>Non-ASAL counties</span>
    </div>

    <div class="grid md:grid-cols-2 gap-6 text-sm mt-10" data-stagger>
        <div class="reveal bg-white border border-navy/10 rounded-xl p-5 card-hover">
            <strong>Arid Counties (9)</strong>
            <p class="text-navy/60 mt-1">Baringo, Garissa, Isiolo, Mandera, Marsabit, Samburu, Tana River, Turkana, Wajir</p>
        </div>
        <div class="reveal bg-white border border-navy/10 rounded-xl p-5 card-hover">
            <strong>Semi-Arid Counties (14)</strong>
            <p class="text-navy/60 mt-1">Embu, Kajiado, Kilifi, Kitui, Kwale, Laikipia, Lamu, Makueni, Meru, Narok, Nyeri (Kieni sub-county), Taita Taveta, Tharaka Nithi, West Pokot</p>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    var mapEl = document.getElementById('kenya-map');
    if (!mapEl || typeof L === 'undefined') return;

    // Kenya's approximate bounding box — keeps the map locked to Kenya only,
    // preventing panning/zooming out to reveal neighboring countries.
    var kenyaBounds = L.latLngBounds([-5.2, 33.5], [5.6, 42.2]);

    var map = L.map('kenya-map', {
        scrollWheelZoom: false,
        maxBounds: kenyaBounds,
        maxBoundsViscosity: 1.0,
        minZoom: 6,
    }).fitBounds(kenyaBounds);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors',
        maxZoom: 12,
        minZoom: 6,
        bounds: kenyaBounds,
    }).addTo(map);

    // Arid counties (first 9)
    var aridCounties = [
        'BARINGO', 'GARISSA', 'ISIOLO', 'MANDERA', 'MARSABIT',
        'SAMBURU', 'TANA RIVER', 'TURKANA', 'WAJIR'
    ];

    // Semi-arid counties (remaining 14). Note: Nyeri is shaded whole-county
    // since boundary data only goes to county level — only Kieni sub-county
    // within Nyeri is actually classified as semi-arid.
    var semiAridCounties = [
        'EMBU', 'KAJIADO', 'KILIFI', 'KITUI', 'KWALE', 'LAIKIPIA', 'LAMU',
        'MAKUENI', 'MERU', 'NAROK', 'NYERI', 'TAITA TAVETA', 'THARAKA-NITHI', 'WEST POKOT'
    ];

    function styleForCounty(name) {
        if (aridCounties.includes(name)) {
            return { fillColor: '#D9A441', color: '#B3822C', weight: 1, fillOpacity: 0.8 };
        }
        if (semiAridCounties.includes(name)) {
            return { fillColor: '#F0C878', color: '#D9A441', weight: 1, fillOpacity: 0.6 };
        }
        return { fillColor: '#e7e9ec', color: '#d5d8dd', weight: 1, fillOpacity: 0.35 };
    }

    fetch('https://cdn.jsdelivr.net/gh/mikelmaron/kenya-election-data@master/data/counties.geojson')
        .then(function (res) { return res.json(); })
        .then(function (geojson) {
            L.geoJSON(geojson, {
                style: function (feature) {
                    var name = (feature.properties.COUNTY_NAM || '').toUpperCase();
                    return styleForCounty(name);
                },
                onEachFeature: function (feature, layer) {
                    var rawName = feature.properties.COUNTY_NAM || 'Unknown';
                    var name = rawName.toUpperCase();
                    var label = rawName.charAt(0) + rawName.slice(1).toLowerCase();
                    var classification = aridCounties.includes(name)
                        ? 'Arid'
                        : (semiAridCounties.includes(name) ? 'Semi-arid' : null);
                    var note = (name === 'NYERI') ? '<br><span style="font-size:11px;color:#94785a;">Kieni sub-county only</span>' : '';
                    var popup = '<strong>' + label + ' County</strong>' + (classification ? '<br>' + classification + ' (ASAL)' + note : '');
                    layer.bindPopup(popup);
                    layer.on('mouseover', function () { layer.setStyle({ weight: 2.5 }); });
                    layer.on('mouseout', function () { layer.setStyle({ weight: styleForCounty(name).weight }); });
                }
            }).addTo(map);
        })
        .catch(function () {
            mapEl.innerHTML = '<div class="w-full h-full flex items-center justify-center text-navy/40 text-sm px-6 text-center">Map data could not be loaded — check your internet connection.</div>';
        });

    // Office markers
    var hqIcon = L.divIcon({
        className: '', html: '<div style="background:#0B2545;width:14px;height:14px;border-radius:50%;border:3px solid white;box-shadow:0 0 0 2px #0B2545;"></div>',
        iconSize: [14, 14], iconAnchor: [7, 7],
    });

    L.marker([-1.2921, 36.8219], { icon: hqIcon }).addTo(map)
        .bindPopup('<strong>Nairobi HQ</strong><br>YAFNET headquarters');

    L.marker([3.5167, 39.0500], { icon: hqIcon }).addTo(map)
        .bindPopup('<strong>Moyale Field Office</strong><br>Marsabit County');
});
</script>
@endpush

