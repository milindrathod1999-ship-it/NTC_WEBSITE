<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Lookbook — Napoleon Textile Company</title>
  <link rel="preconnect" href="https://fonts.googleapis.com"/>
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=Inter:wght@300;400;500&display=swap" rel="stylesheet"/>
  <link rel="prefetch" href="index.php"/>
  <!-- Prefetch index.php's CDN scripts so they're in browser cache on back-navigation -->
  <link rel="prefetch" href="https://cdn.tailwindcss.com" as="script"/>
  <link rel="prefetch" href="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js" as="script"/>
  <link rel="prefetch" href="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js" as="script"/>
  <link rel="prefetch" href="https://unpkg.com/@studio-freight/lenis@1.0.42/dist/lenis.min.js" as="script"/>
  <link rel="prefetch" href="https://d3js.org/d3.v7.min.js" as="script"/>
  <link rel="prefetch" href="https://unpkg.com/topojson-client@3/dist/topojson-client.min.js" as="script"/>
  <style>
    @font-face {
      font-family: 'Bodoni Moda';
      font-style: normal;
      font-weight: 400;
      font-display: swap;
      src: url('fonts/bodoni-400.woff2') format('woff2');
    }
    @font-face {
      font-family: 'Bodoni Moda';
      font-style: normal;
      font-weight: 500;
      font-display: swap;
      src: url('fonts/bodoni-500.woff2') format('woff2');
    }

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
      --bg:        #F4F1EA;
      --obsidian:  #1A1A18;
      --slate:     #6B6B64;
      --champagne: #C5A97A;
      --card:      280px;
      --gap:       24px;
      --nav-h:     88px;
    }

    html, body {
      width: 100%; height: 100%;
      overflow: hidden;
      background: transparent;
      font-family: 'Inter', sans-serif;
      -webkit-font-smoothing: antialiased;
      user-select: none;
    }

    /* ── NAV ── */
    #lb-nav {
      position: fixed;
      top: 0; left: 0; right: 0;
      z-index: 200;
      background: var(--bg);
      border-bottom: 1px solid rgba(26,26,24,0.08);
    }
    #lb-nav-inner {
      display: grid;
      grid-template-columns: 1fr auto 1fr;
      align-items: center;
      padding: 20px 48px;
    }
    .lb-nav-col { display: flex; align-items: center; }
    .lb-nav-left  { justify-content: flex-start; }
    .lb-nav-center { justify-content: center; }
    .lb-nav-right { justify-content: flex-end; }

    /* Mobile logo — hidden on desktop, shown on mobile in left column */
    #lb-logo-mob { display: none; }

    @media (max-width: 767px) {
      #lb-nav-inner {
        grid-template-columns: 1fr auto;
        padding: 10px 20px;
      }
      .lb-nav-center { display: none; }
      #lb-eyebrow    { display: none; }
      #lb-logo-mob   { display: block; }
    }

    /* Exact copy of home page .btn-nav-text — font-family explicit since lookbook body uses Inter */
    .btn-nav-text {
      font-family: 'Bodoni Moda', Georgia, serif;
      font-size: 10px;
      font-weight: 500;
      letter-spacing: 0.2em;
      text-transform: uppercase;
      text-decoration: none;
      background: transparent;
      display: inline-block;
      padding-bottom: 3px;
      border-bottom: 1px solid currentColor;
      color: var(--obsidian);
      opacity: 1;
      transition: opacity 0.25s ease;
    }
    .btn-nav-text:hover { opacity: 0.6; }

    /* Eyebrow — same as .btn-nav-text but no underline, not interactive */
    #lb-eyebrow {
      font-family: 'Bodoni Moda', Georgia, serif;
      font-size: 10px;
      font-weight: 500;
      letter-spacing: 0.2em;
      text-transform: uppercase;
      color: var(--obsidian);
      opacity: 1;
      white-space: nowrap;
      cursor: default;
    }

    /* ── CATEGORY TABS ── */
    #cat-tabs {
      position: fixed;
      bottom: 28px;
      left: 50%;
      transform: translateX(-50%);
      z-index: 100;
      display: flex;
      gap: 2px;
      align-items: center;
      background: rgba(244,241,234,0.88);
      backdrop-filter: blur(16px);
      -webkit-backdrop-filter: blur(16px);
      border: 1px solid rgba(26,26,24,0.12);
      border-radius: 100px;
      padding: 5px 6px;
      box-shadow: 0 4px 24px rgba(26,26,24,0.10);
      white-space: nowrap;
    }
    @media (max-width: 767px) {
      #cat-tabs {
        max-width: calc(100vw - 32px);
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        scrollbar-width: none;
        bottom: max(14px, env(safe-area-inset-bottom, 0px) + 10px);
        left: 16px;
        right: 16px;
        transform: none;
        border-radius: 100px;
      }
      #cat-tabs::-webkit-scrollbar { display: none; }
      .cat-tab { padding: 7px 11px; font-size: 8px; }
      #zoom-ctrl { bottom: max(68px, env(safe-area-inset-bottom, 0px) + 56px); right: 14px; }
    }
    .cat-tab {
      font-size: 9px;
      font-weight: 500;
      letter-spacing: 0.16em;
      text-transform: uppercase;
      color: var(--slate);
      padding: 7px 16px;
      border-radius: 100px;
      border: none;
      background: none;
      cursor: pointer;
      transition: color 0.2s ease, background 0.2s ease;
    }
    .cat-tab:hover { color: var(--obsidian); }
    .cat-tab.active {
      color: #F4F1EA;
      background: var(--obsidian);
    }

    /* ── DRAG HINT ── */
    #drag-hint {
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      z-index: 90;
      pointer-events: none;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 12px;
      transition: opacity 0.5s ease;
    }
    #drag-hint.hidden { opacity: 0; }
    #drag-hint svg { animation: hintPulse 2.2s ease-in-out infinite; }
    @keyframes hintPulse {
      0%, 100% { opacity: 0.35; transform: scale(1);    }
      50%       { opacity: 0.85; transform: scale(1.08); }
    }
    #drag-hint p {
      font-size: 9px;
      letter-spacing: 0.24em;
      text-transform: uppercase;
      color: var(--slate);
    }

    /* ── CANVAS STAGE ── */
    #stage {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      z-index: 1;
      background: var(--bg);
      cursor: grab;
      overflow: hidden;
      touch-action: none; /* hand all touch events to JS — no browser scroll/zoom */
    }
    #stage.dragging { cursor: grabbing; }

    /* ── GRID WORLD ── */
    #grid-world {
      position: absolute;
      will-change: transform;
    }

    /* ── PHOTO CARD ── */
    .lb-card {
      position: absolute;
      width: var(--card);
      height: var(--card);
      aspect-ratio: 1 / 1;
      overflow: hidden;
      background: #E8E4DB;
      transition: box-shadow 0.3s ease, transform 0.3s ease;
    }
    .lb-card img {
      display: block;
      width: 100%;
      height: 100%;
      object-fit: cover;
      object-position: center;
      pointer-events: none;
      transition: transform 0.5s ease;
    }
    .lb-card:hover {
      box-shadow:
        0 20px 60px rgba(26,26,24,0.18),
        0 6px 18px rgba(26,26,24,0.10);
      transform: translateY(-6px);
      z-index: 20;
    }
    .lb-card:hover img { transform: scale(1.06); }

    /* ── HOVER OVERLAY ── */
    .lb-overlay {
      position: absolute;
      inset: 0;
      display: flex;
      flex-direction: column;
      justify-content: flex-end;
      padding: 22px;
      background: linear-gradient(
        to top,
        rgba(26,26,24,0.86) 0%,
        rgba(26,26,24,0.38) 55%,
        transparent 100%
      );
      opacity: 0;
      transition: opacity 0.3s ease;
      pointer-events: none;
    }
    .lb-card:hover .lb-overlay { opacity: 1; }
    .lb-overlay-eyebrow {
      font-size: 8px;
      font-weight: 500;
      letter-spacing: 0.2em;
      text-transform: uppercase;
      color: var(--champagne);
      margin-bottom: 5px;
    }
    .lb-overlay-name {
      font-family: 'Cormorant Garamond', Georgia, serif;
      font-size: 1.15rem;
      font-weight: 400;
      color: #F4F1EA;
      line-height: 1.2;
      margin-bottom: 8px;
    }
    .lb-overlay-desc {
      font-size: 8px;
      font-weight: 300;
      letter-spacing: 0.03em;
      color: rgba(244,241,234,0.65);
      line-height: 1.6;
    }

    /* ── ZOOM CONTROLS ── */
    #zoom-ctrl {
      position: fixed;
      right: 24px;
      bottom: 76px;
      z-index: 100;
      display: flex;
      flex-direction: column;
      gap: 4px;
    }
    .zoom-btn {
      width: 32px; height: 32px;
      background: rgba(244,241,234,0.9);
      border: 1px solid rgba(26,26,24,0.15);
      border-radius: 3px;
      color: var(--obsidian);
      font-size: 16px;
      cursor: pointer;
      display: flex; align-items: center; justify-content: center;
      transition: background 0.2s ease, box-shadow 0.2s ease;
      box-shadow: 0 2px 8px rgba(26,26,24,0.06);
    }
    .zoom-btn:hover { background: var(--bg); box-shadow: 0 4px 16px rgba(26,26,24,0.12); }
  </style>
</head>
<body>

  <!-- NAV -->
  <nav id="lb-nav">
    <div id="lb-nav-inner">

      <!-- Left: eyebrow on desktop, logo on mobile -->
      <div class="lb-nav-col lb-nav-left">
        <span id="lb-eyebrow">Lookbook &nbsp;·&nbsp; S/S 2026</span>
        <a id="lb-logo-mob" href="index.php" onclick="if(history.length>1){event.preventDefault();history.back();}">
          <img src="BRAND_ASSETS/napoleon logo-2.png" alt="Napoleon Textile Company"
               style="height:3.5rem;width:auto;display:block;"/>
        </a>
      </div>

      <!-- Center: Logo -->
      <div class="lb-nav-col lb-nav-center">
        <a href="index.php" onclick="if(history.length>1){event.preventDefault();history.back();}">
          <img src="BRAND_ASSETS/napoleon logo-2.png" alt="Napoleon Textile Company"
               style="height:4.8rem;width:auto;display:block;"/>
        </a>
      </div>

      <!-- Right: Back to Site -->
      <div class="lb-nav-col lb-nav-right">
        <a href="index.php" class="btn-nav-text" onclick="if(history.length>1){event.preventDefault();history.back();}">← Back to Site</a>
      </div>

    </div>
  </nav>

  <!-- DRAG HINT -->
  <div id="drag-hint">
    <svg width="44" height="44" viewBox="0 0 44 44" fill="none">
      <circle cx="22" cy="22" r="21" stroke="#C5A97A" stroke-width="1"/>
      <line x1="11" y1="22" x2="33" y2="22" stroke="#1A1A18" stroke-width="1.2" stroke-linecap="round"/>
      <polyline points="26,15 33,22 26,29" fill="none" stroke="#1A1A18" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
      <polyline points="18,15 11,22 18,29" fill="none" stroke="#1A1A18" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
    <p>Drag to explore</p>
  </div>

  <!-- ZOOM CONTROLS -->
  <div id="zoom-ctrl">
    <button class="zoom-btn" id="zoom-in" title="Zoom in">+</button>
    <button class="zoom-btn" id="zoom-out" title="Zoom out">−</button>
  </div>

  <!-- CANVAS STAGE -->
  <div id="stage">
    <div id="grid-world"></div>
  </div>

  <!-- CATEGORY TABS -->
  <div id="cat-tabs">
    <button class="cat-tab active" data-cat="all">All</button>
    <button class="cat-tab" data-cat="dobbies">Dobbies &amp; Jacquards</button>
    <button class="cat-tab" data-cat="checks">Checks &amp; Windowpanes</button>
    <button class="cat-tab" data-cat="stripes">Stripes</button>
    <button class="cat-tab" data-cat="prints">Prints</button>
  </div>

  <script>
  // ─────────────────────────────────────────────
  // FABRIC DATA
  // ─────────────────────────────────────────────
  const FABRICS = [
    // ── DOBBIES & JACQUARDS ──
    { src: 'BRAND_ASSETS/Fabric photos/LOOKBOOK PHOTOS/BF-01-DOB.jpg', name: 'BF-01', type: 'Dobbies & Jacquards', cat: ['dobbies'], desc: '' },
    { src: 'BRAND_ASSETS/Fabric photos/LOOKBOOK PHOTOS/BF-02-DOB.jpg', name: 'BF-02', type: 'Dobbies & Jacquards', cat: ['dobbies'], desc: '' },
    { src: 'BRAND_ASSETS/Fabric photos/LOOKBOOK PHOTOS/BF-05-DOB.jpg', name: 'BF-05', type: 'Dobbies & Jacquards', cat: ['dobbies'], desc: '' },
    { src: 'BRAND_ASSETS/Fabric photos/LOOKBOOK PHOTOS/BF-06-DOB.jpg', name: 'BF-06', type: 'Dobbies & Jacquards', cat: ['dobbies'], desc: '' },
    { src: 'BRAND_ASSETS/Fabric photos/LOOKBOOK PHOTOS/BF-07-DOB.jpg', name: 'BF-07', type: 'Dobbies & Jacquards', cat: ['dobbies'], desc: '' },
    { src: 'BRAND_ASSETS/Fabric photos/LOOKBOOK PHOTOS/BF-08-DOB.jpg', name: 'BF-08', type: 'Dobbies & Jacquards', cat: ['dobbies'], desc: '' },
    { src: 'BRAND_ASSETS/Fabric photos/LOOKBOOK PHOTOS/BF-09-DOB.jpg', name: 'BF-09', type: 'Dobbies & Jacquards', cat: ['dobbies'], desc: '' },
    // ── CHECKS & WINDOWPANES ──
    { src: 'BRAND_ASSETS/Fabric photos/LOOKBOOK PHOTOS/BF-03-CHK.jpg', name: 'BF-03', type: 'Checks & Windowpanes', cat: ['checks'], desc: '' },
    { src: 'BRAND_ASSETS/Fabric photos/LOOKBOOK PHOTOS/BF-04-CHK.jpg', name: 'BF-04', type: 'Checks & Windowpanes', cat: ['checks'], desc: '' },
    { src: 'BRAND_ASSETS/Fabric photos/LOOKBOOK PHOTOS/BF-10-CHK.jpg', name: 'BF-10', type: 'Checks & Windowpanes', cat: ['checks'], desc: '' },
    { src: 'BRAND_ASSETS/Fabric photos/LOOKBOOK PHOTOS/WW-02-CHK.jpg', name: 'WW-02', type: 'Checks & Windowpanes', cat: ['checks'], desc: '' },
    { src: 'BRAND_ASSETS/Fabric photos/LOOKBOOK PHOTOS/WW-03-CHK.jpg', name: 'WW-03', type: 'Checks & Windowpanes', cat: ['checks'], desc: '' },
    { src: 'BRAND_ASSETS/Fabric photos/LOOKBOOK PHOTOS/WW-04-CHK.jpg', name: 'WW-04', type: 'Checks & Windowpanes', cat: ['checks'], desc: '' },
    { src: 'BRAND_ASSETS/Fabric photos/LOOKBOOK PHOTOS/WW-08-CHK.jpg', name: 'WW-08', type: 'Checks & Windowpanes', cat: ['checks'], desc: '' },
    { src: 'BRAND_ASSETS/Fabric photos/LOOKBOOK PHOTOS/SF-01-CHK.jpg', name: 'SF-01', type: 'Checks & Windowpanes', cat: ['checks'], desc: '' },
    { src: 'BRAND_ASSETS/Fabric photos/LOOKBOOK PHOTOS/SF-02-CHK.jpg', name: 'SF-02', type: 'Checks & Windowpanes', cat: ['checks'], desc: '' },
    { src: 'BRAND_ASSETS/Fabric photos/LOOKBOOK PHOTOS/SF-03-CHK.jpg', name: 'SF-03', type: 'Checks & Windowpanes', cat: ['checks'], desc: '' },
    { src: 'BRAND_ASSETS/Fabric photos/LOOKBOOK PHOTOS/SF-04-CHK.jpg', name: 'SF-04', type: 'Checks & Windowpanes', cat: ['checks'], desc: '' },
    { src: 'BRAND_ASSETS/Fabric photos/LOOKBOOK PHOTOS/SF-05-CHK.jpg', name: 'SF-05', type: 'Checks & Windowpanes', cat: ['checks'], desc: '' },
    { src: 'BRAND_ASSETS/Fabric photos/LOOKBOOK PHOTOS/SF-07-CHK.jpg', name: 'SF-07', type: 'Checks & Windowpanes', cat: ['checks'], desc: '' },
    { src: 'BRAND_ASSETS/Fabric photos/LOOKBOOK PHOTOS/SF-08-CHK.jpg', name: 'SF-08', type: 'Checks & Windowpanes', cat: ['checks'], desc: '' },
    { src: 'BRAND_ASSETS/Fabric photos/LOOKBOOK PHOTOS/SF-09-CHK.jpg', name: 'SF-09', type: 'Checks & Windowpanes', cat: ['checks'], desc: '' },
    { src: 'BRAND_ASSETS/Fabric photos/LOOKBOOK PHOTOS/SF-10-CHK.jpg', name: 'SF-10', type: 'Checks & Windowpanes', cat: ['checks'], desc: '' },
    // ── STRIPES ──
    { src: 'BRAND_ASSETS/Fabric photos/LOOKBOOK PHOTOS/WW-01-STR.jpg', name: 'WW-01', type: 'Stripes', cat: ['stripes'], desc: '' },
    { src: 'BRAND_ASSETS/Fabric photos/LOOKBOOK PHOTOS/WW-07-STR.jpg', name: 'WW-07', type: 'Stripes', cat: ['stripes'], desc: '' },
    { src: 'BRAND_ASSETS/Fabric photos/LOOKBOOK PHOTOS/WW-09-STR.jpg', name: 'WW-09', type: 'Stripes', cat: ['stripes'], desc: '' },
    { src: 'BRAND_ASSETS/Fabric photos/LOOKBOOK PHOTOS/WW-10-STR.jpg', name: 'WW-10', type: 'Stripes', cat: ['stripes'], desc: '' },
    { src: 'BRAND_ASSETS/Fabric photos/LOOKBOOK PHOTOS/SF-06-STR.jpg', name: 'SF-06', type: 'Stripes', cat: ['stripes'], desc: '' },
    // ── PRINTS ──
    { src: 'BRAND_ASSETS/Fabric photos/LOOKBOOK PHOTOS/WW-05-PR.jpg', name: 'WW-05', type: 'Prints', cat: ['prints'], desc: '' },
    { src: 'BRAND_ASSETS/Fabric photos/LOOKBOOK PHOTOS/WW-06-PR.jpg', name: 'WW-06', type: 'Prints', cat: ['prints'], desc: '' },
    { src: 'BRAND_ASSETS/Fabric photos/LOOKBOOK PHOTOS/EVE-01-PR.jpg', name: 'EVE-01', type: 'Prints', cat: ['prints'], desc: '' },
    { src: 'BRAND_ASSETS/Fabric photos/LOOKBOOK PHOTOS/EVE-02-PR.jpg', name: 'EVE-02', type: 'Prints', cat: ['prints'], desc: '' },
    { src: 'BRAND_ASSETS/Fabric photos/LOOKBOOK PHOTOS/EVE-03-PR.jpg', name: 'EVE-03', type: 'Prints', cat: ['prints'], desc: '' },
    { src: 'BRAND_ASSETS/Fabric photos/LOOKBOOK PHOTOS/EVE-04-PR.jpg', name: 'EVE-04', type: 'Prints', cat: ['prints'], desc: '' },
    { src: 'BRAND_ASSETS/Fabric photos/LOOKBOOK PHOTOS/EVE-05-PR.jpg', name: 'EVE-05', type: 'Prints', cat: ['prints'], desc: '' },
    { src: 'BRAND_ASSETS/Fabric photos/LOOKBOOK PHOTOS/EVE-06-PR.jpg', name: 'EVE-06', type: 'Prints', cat: ['prints'], desc: '' },
    { src: 'BRAND_ASSETS/Fabric photos/LOOKBOOK PHOTOS/EVE-07-PR.jpg', name: 'EVE-07', type: 'Prints', cat: ['prints'], desc: '' },
    { src: 'BRAND_ASSETS/Fabric photos/LOOKBOOK PHOTOS/HCA-01-PR.jpg', name: 'HCA-01', type: 'Prints', cat: ['prints'], desc: '' },
    // ── HCA CHECKS ──
    { src: 'BRAND_ASSETS/Fabric photos/LOOKBOOK PHOTOS/HCA-02-CHK.jpg', name: 'HCA-02', type: 'Checks & Windowpanes', cat: ['checks'], desc: '' },
    { src: 'BRAND_ASSETS/Fabric photos/LOOKBOOK PHOTOS/HCA-03-CHK.jpg', name: 'HCA-03', type: 'Checks & Windowpanes', cat: ['checks'], desc: '' },
    { src: 'BRAND_ASSETS/Fabric photos/LOOKBOOK PHOTOS/HCA-04-CHK.jpg', name: 'HCA-04', type: 'Checks & Windowpanes', cat: ['checks'], desc: '' },
    { src: 'BRAND_ASSETS/Fabric photos/LOOKBOOK PHOTOS/HCA-05-CHK.jpg', name: 'HCA-05', type: 'Checks & Windowpanes', cat: ['checks'], desc: '' },
    { src: 'BRAND_ASSETS/Fabric photos/LOOKBOOK PHOTOS/HCA-06-CHK.jpg', name: 'HCA-06', type: 'Checks & Windowpanes', cat: ['checks'], desc: '' },
  ];

  // ─────────────────────────────────────────────
  // LAYOUT — landscape grid matching screen ratio
  // ─────────────────────────────────────────────
  const CARD_PX  = 280;
  const GAP_PX   = 24;
  const EDGE_PAD = 20;

  function buildLayout(fabrics) {
    const n = fabrics.length;
    if (!n) return [];
    const aspect = window.innerWidth / window.innerHeight; // full-screen ratio ~16:9
    const cols   = Math.max(4, Math.round(Math.sqrt(n * aspect)));
    return fabrics.map((fab, idx) => ({
      ...fab,
      x: (idx % cols) * (CARD_PX + GAP_PX),
      y: Math.floor(idx / cols) * (CARD_PX + GAP_PX),
    }));
  }

  // ─────────────────────────────────────────────
  // DOM
  // ─────────────────────────────────────────────
  const world = document.getElementById('grid-world');
  const stage = document.getElementById('stage');
  const hint  = document.getElementById('drag-hint');

  let allLaid    = [];
  let currentCat = 'all';

  function renderCards(catFilter) {
    world.innerHTML = '';
    allLaid = [];

    const filtered = catFilter === 'all'
      ? FABRICS
      : FABRICS.filter(f => f.cat.includes(catFilter));

    const laid = buildLayout(filtered);
    allLaid = laid;

    laid.forEach(item => {
      const card = document.createElement('div');
      card.className = 'lb-card';
      card.style.left = item.x + 'px';
      card.style.top  = item.y + 'px';

      const img = document.createElement('img');
      img.src     = item.src;
      img.alt     = item.name;
      img.loading = 'eager'; // lazy fails with CSS-transform canvases
      card.appendChild(img);

      const overlay = document.createElement('div');
      overlay.className = 'lb-overlay';
      overlay.innerHTML = `
        <div class="lb-overlay-eyebrow">${item.type}</div>
        <div class="lb-overlay-name">${item.name}</div>
        <div class="lb-overlay-desc">${item.desc}</div>
      `;
      card.appendChild(overlay);

      world.appendChild(card);
    });

    fitToView(laid, true);
  }

  // ─────────────────────────────────────────────
  // VIEWPORT / TRANSFORM
  // ─────────────────────────────────────────────
  let vx = 0, vy = 0, scale = 1;
  let minScale = 0.14;
  const MAX_SCALE = 2.4;

  // Always use translate3d — keeps grid-world on GPU composite layer
  function applyTransform(animated = false) {
    if (animated) {
      world.style.transition = 'transform 0.6s cubic-bezier(0.25,1,0.5,1)';
      setTimeout(() => { world.style.transition = 'none'; }, 620);
    } else {
      world.style.transition = 'none';
    }
    world.style.transform = `translate3d(${vx}px,${vy}px,0) scale(${scale})`;
    world.style.transformOrigin = '0 0';
  }

  // Smooth zoom via RAF lerp — avoids CSS transition vs drag conflicts
  let zoomTarget = null, zoomRafId = null;
  function applyZoomSmooth() {
    if (!zoomTarget) zoomTarget = { vx, vy, scale };
    zoomTarget.vx = vx; zoomTarget.vy = vy; zoomTarget.scale = scale;
    if (!zoomRafId) zoomRafId = requestAnimationFrame(zoomTick);
  }
  // Lerp state — updated in fitToView after first render
  let lerpVx = 0, lerpVy = 0, lerpScale = 1;
  function zoomTick() {
    const FACTOR = 0.22;
    lerpVx    += (zoomTarget.vx    - lerpVx)    * FACTOR;
    lerpVy    += (zoomTarget.vy    - lerpVy)    * FACTOR;
    lerpScale += (zoomTarget.scale - lerpScale) * FACTOR;
    world.style.transition = 'none';
    world.style.transform = `translate3d(${lerpVx}px,${lerpVy}px,0) scale(${lerpScale})`;
    world.style.transformOrigin = '0 0';
    const done = Math.abs(zoomTarget.vx - lerpVx) < 0.05 &&
                 Math.abs(zoomTarget.vy - lerpVy) < 0.05 &&
                 Math.abs(zoomTarget.scale - lerpScale) < 0.0002;
    if (done) {
      lerpVx = zoomTarget.vx; lerpVy = zoomTarget.vy; lerpScale = zoomTarget.scale;
      world.style.transform = `translate3d(${lerpVx}px,${lerpVy}px,0) scale(${lerpScale})`;
      zoomRafId = null;
    } else {
      zoomRafId = requestAnimationFrame(zoomTick);
    }
  }

  function getContentBounds(laid) {
    let minX = Infinity, minY = Infinity, maxX = -Infinity, maxY = -Infinity;
    laid.forEach(item => {
      minX = Math.min(minX, item.x);
      minY = Math.min(minY, item.y);
      maxX = Math.max(maxX, item.x + CARD_PX);
      maxY = Math.max(maxY, item.y + CARD_PX);
    });
    return { minX, minY, maxX, maxY, cW: maxX - minX, cH: maxY - minY };
  }

  function getNavH() {
    return document.getElementById('lb-nav').getBoundingClientRect().height;
  }

  function fitToView(laid, animated = false) {
    if (!laid.length) return;
    const vw   = window.innerWidth;
    const vh   = window.innerHeight;
    const navH = getNavH();
    const { minX, minY, cW, cH } = getContentBounds(laid);
    const availW = vw - EDGE_PAD * 2;
    const availH = vh - navH - EDGE_PAD * 2;
    // Math.min = fit-to-view (all photos visible); Math.max would cover/crop
    const fitScale = Math.min(availW / cW, availH / cH);
    minScale = fitScale * 0.7; // allow zooming out 30% past fit for context
    scale    = fitScale;
    vx = EDGE_PAD + (availW - cW * scale) / 2 - minX * scale;
    vy = navH + EDGE_PAD - minY * scale;
    clampPan();
    // Keep lerp state in sync so zoom buttons start from correct position
    lerpVx = vx; lerpVy = vy; lerpScale = scale;
    applyTransform(animated);
  }

  // ─────────────────────────────────────────────
  // PAN CLAMP — keep grid within padded display area
  // ─────────────────────────────────────────────
  function clampPan() {
    if (!allLaid.length) return;
    const vw   = window.innerWidth;
    const vh   = window.innerHeight;
    const navH = getNavH();
    const { minX, minY, cW, cH } = getContentBounds(allLaid);

    // Horizontal: content edges stay within [EDGE_PAD, vw-EDGE_PAD]
    const maxVx = EDGE_PAD - minX * scale;
    const minVx = (vw - EDGE_PAD) - (minX + cW) * scale;
    if (minVx > maxVx) {
      vx = (minVx + maxVx) / 2; // content narrower than available — center it
    } else {
      vx = Math.max(minVx, Math.min(maxVx, vx));
    }

    // Vertical: top bound = navH+EDGE_PAD, bottom bound = vh-EDGE_PAD
    const maxVy = (navH + EDGE_PAD) - minY * scale;
    const minVy = (vh - EDGE_PAD) - (minY + cH) * scale;
    if (minVy > maxVy) {
      vy = (minVy + maxVy) / 2; // content shorter than available — center it
    } else {
      vy = Math.max(minVy, Math.min(maxVy, vy));
    }
  }

  // ─────────────────────────────────────────────
  // DRAG + PINCH — unified pointer events
  // (touch-action:none on #stage ensures no browser interference)
  // ─────────────────────────────────────────────
  const activePointers = new Map(); // pointerId → {x, y}
  let dragging = false, dragStartX = 0, dragStartY = 0;
  let dvx = 0, dvy = 0, lastX = 0, lastY = 0;
  let lastPinchDist = null;
  let rafId = null, hasDragged = false;

  stage.addEventListener('pointerdown', e => {
    // Cancel any zoom animation so drag takes over immediately
    if (zoomRafId) { cancelAnimationFrame(zoomRafId); zoomRafId = null; }
    // Sync lerp state to current transform to avoid snap
    lerpVx = vx; lerpVy = vy; lerpScale = scale;
    world.style.transition = 'none';

    activePointers.set(e.pointerId, { x: e.clientX, y: e.clientY });
    stage.setPointerCapture(e.pointerId);

    if (activePointers.size === 1) {
      // Single finger/mouse — start drag
      dragging = true;
      dragStartX = e.clientX - vx;
      dragStartY = e.clientY - vy;
      dvx = dvy = 0;
      lastX = e.clientX; lastY = e.clientY;
      lastPinchDist = null;
      stage.classList.add('dragging');
      cancelRaf();
    } else if (activePointers.size === 2) {
      // Second finger arrived — switch to pinch mode
      dragging = false;
      stage.classList.remove('dragging');
      cancelRaf();
      const pts = [...activePointers.values()];
      lastPinchDist = Math.hypot(pts[0].x - pts[1].x, pts[0].y - pts[1].y);
    }
  });

  stage.addEventListener('pointermove', e => {
    if (!activePointers.has(e.pointerId)) return;
    activePointers.set(e.pointerId, { x: e.clientX, y: e.clientY });

    if (activePointers.size === 2) {
      // ── Pinch zoom ──
      const pts = [...activePointers.values()];
      const d  = Math.hypot(pts[0].x - pts[1].x, pts[0].y - pts[1].y);
      const cx = (pts[0].x + pts[1].x) / 2;
      const cy = (pts[0].y + pts[1].y) / 2;
      if (lastPinchDist !== null) {
        const r  = d / lastPinchDist;
        const ns = Math.max(minScale, Math.min(MAX_SCALE, scale * r));
        const ratio = ns / scale;
        vx = cx - ratio * (cx - vx);
        vy = cy - ratio * (cy - vy);
        scale = ns;
        clampPan();
        applyTransform();
      }
      lastPinchDist = d;
    } else if (activePointers.size === 1 && dragging) {
      // ── Pan ──
      dvx = e.clientX - lastX; dvy = e.clientY - lastY;
      lastX = e.clientX; lastY = e.clientY;
      vx = e.clientX - dragStartX; vy = e.clientY - dragStartY;
      clampPan();
      applyTransform();
      if (!hasDragged && (Math.abs(dvx) > 3 || Math.abs(dvy) > 3)) {
        hasDragged = true;
        hint.classList.add('hidden');
      }
    }
  });

  function onPointerEnd(e) {
    activePointers.delete(e.pointerId);
    if (activePointers.size === 0) {
      // All fingers up
      if (dragging) startMomentum();
      dragging = false;
      stage.classList.remove('dragging');
      lastPinchDist = null;
    } else if (activePointers.size === 1) {
      // Went from 2→1 finger — restart drag from remaining finger
      lastPinchDist = null;
      const [rem] = activePointers.values();
      dragging = true;
      dragStartX = rem.x - vx; dragStartY = rem.y - vy;
      lastX = rem.x; lastY = rem.y; dvx = dvy = 0;
      stage.classList.add('dragging');
    }
  }
  stage.addEventListener('pointerup',     onPointerEnd);
  stage.addEventListener('pointercancel', e => { activePointers.delete(e.pointerId); if (!activePointers.size) { dragging = false; stage.classList.remove('dragging'); } });

  function startMomentum() {
    cancelRaf();
    let mx = dvx * 0.9, my = dvy * 0.9;
    function tick() {
      if (Math.abs(mx) < 0.3 && Math.abs(my) < 0.3) return;
      vx += mx; vy += my; mx *= 0.93; my *= 0.93;
      clampPan();
      applyTransform();
      rafId = requestAnimationFrame(tick);
    }
    rafId = requestAnimationFrame(tick);
  }
  function cancelRaf() { if (rafId) { cancelAnimationFrame(rafId); rafId = null; } }

  // ─────────────────────────────────────────────
  // WHEEL (desktop trackpad / mouse wheel)
  // ─────────────────────────────────────────────
  stage.addEventListener('wheel', e => {
    e.preventDefault();
    const mx = e.clientX, my = e.clientY;
    if (e.ctrlKey || e.metaKey) {
      const f = e.deltaY < 0 ? 1.04 : 0.962;
      const ns = Math.max(minScale, Math.min(MAX_SCALE, scale * f));
      const r = ns / scale;
      vx = mx - r * (mx - vx); vy = my - r * (my - vy); scale = ns;
      lerpVx = vx; lerpVy = vy; lerpScale = scale;
      clampPan();
      applyTransform();
    } else {
      vx -= e.deltaX; vy -= e.deltaY;
      clampPan();
      applyTransform();
    }
  }, { passive: false });

  // ─────────────────────────────────────────────
  // ZOOM BUTTONS — lerp-smooth, no CSS transition
  // ─────────────────────────────────────────────
  function zoomBy(f) {
    const cx = window.innerWidth / 2, cy = window.innerHeight / 2;
    const ns = Math.max(minScale, Math.min(MAX_SCALE, scale * f));
    const r = ns / scale;
    vx = cx - r * (cx - vx); vy = cy - r * (cy - vy); scale = ns;
    clampPan();
    // Kick off lerp if not already running (lerpVx/Y/Scale are current position)
    if (!zoomRafId) {
      if (!zoomTarget) zoomTarget = { vx: lerpVx, vy: lerpVy, scale: lerpScale };
    } else {
      cancelAnimationFrame(zoomRafId); zoomRafId = null;
    }
    applyZoomSmooth();
  }
  document.getElementById('zoom-in').addEventListener('click',  () => zoomBy(1.25));
  document.getElementById('zoom-out').addEventListener('click', () => zoomBy(0.8));

  // ─────────────────────────────────────────────
  // CATEGORY TABS
  // ─────────────────────────────────────────────
  function setActiveTab(cat) {
    document.querySelectorAll('.cat-tab').forEach(b => {
      b.classList.toggle('active', b.dataset.cat === cat);
    });
    currentCat = cat;
    renderCards(cat);
  }

  document.querySelectorAll('.cat-tab').forEach(btn => {
    btn.addEventListener('click', () => setActiveTab(btn.dataset.cat));
  });

  // ─────────────────────────────────────────────
  // URL PRE-FILTER — ?cat=stripes etc.
  // ─────────────────────────────────────────────
  const urlCat = new URLSearchParams(window.location.search).get('cat');
  const validCats = ['all','stripes','checks','prints','dobbies','plains','uniforms','premium'];
  const initCat = (urlCat && validCats.includes(urlCat)) ? urlCat : 'all';

  // ─────────────────────────────────────────────
  // KEYBOARD
  // ─────────────────────────────────────────────
  document.addEventListener('keydown', e => {
    const s = 90;
    if (e.key === 'ArrowLeft')  { vx += s; clampPan(); applyTransform(true); }
    if (e.key === 'ArrowRight') { vx -= s; clampPan(); applyTransform(true); }
    if (e.key === 'ArrowUp')    { vy += s; clampPan(); applyTransform(true); }
    if (e.key === 'ArrowDown')  { vy -= s; clampPan(); applyTransform(true); }
    if (e.key === '+' || e.key === '=') zoomBy(1.2);
    if (e.key === '-') zoomBy(0.83);
    if (e.key === '0') fitToView(allLaid, true);
  });

  // ─────────────────────────────────────────────
  // INIT
  // ─────────────────────────────────────────────

  // Measure actual nav height and keep --nav-h in sync
  function syncNavHeight() {
    const h = document.getElementById('lb-nav').getBoundingClientRect().height;
    document.documentElement.style.setProperty('--nav-h', h + 'px');
  }
  syncNavHeight();

  setActiveTab(initCat);
  setTimeout(() => hint.classList.add('hidden'), 3500);
  window.addEventListener('resize', () => { syncNavHeight(); renderCards(currentCat); });
  </script>
</body>
</html>
