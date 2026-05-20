<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Napoleon Textile Company — A Design House in Fabric</title>

  <!-- Fonts — self-hosted Bodoni Moda, loads reliably without network dependency -->

  <!-- Scripts -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
  <script src="https://unpkg.com/@studio-freight/lenis@1.0.42/dist/lenis.min.js"></script>
  <script src="https://d3js.org/d3.v7.min.js"></script>
  <script src="https://unpkg.com/topojson-client@3/dist/topojson-client.min.js"></script>

  <!-- Tailwind brand tokens -->
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            ntc: {
              obsidian: '#1A1A18',
              ivory:    '#F4F1EA',
              champagne:'#C5A97A',
              slate:    '#4A4E5A',
              ecru:     '#E8E0D0',
              blush:    '#C9B8A8',
              navy:     '#1C2540',
              ink:      '#0E0E0C',
            }
          },
          fontFamily: {
            display: ['Bodoni Moda', 'Georgia', 'serif'],
            sans:    ['Bodoni Moda', 'Georgia', 'serif'],
          },
        }
      }
    }
  </script>

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
    @font-face {
      font-family: 'Bodoni Moda';
      font-style: normal;
      font-weight: 600;
      font-display: swap;
      src: url('fonts/bodoni-700.woff2') format('woff2');
    }
    @font-face {
      font-family: 'Bodoni Moda';
      font-style: normal;
      font-weight: 700;
      font-display: swap;
      src: url('fonts/bodoni-700.woff2') format('woff2');
    }
    @font-face {
      font-family: 'Bodoni Moda';
      font-style: normal;
      font-weight: 900;
      font-display: swap;
      src: url('fonts/bodoni-900.woff2') format('woff2');
    }
    @font-face {
      font-family: 'Bodoni Moda';
      font-style: italic;
      font-weight: 400;
      font-display: swap;
      src: url('fonts/bodoni-400-italic.woff2') format('woff2');
    }

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    html { scroll-behavior: auto; }   /* let Lenis own all scrolling — no native smooth-scroll */
    body {
      font-family: 'Bodoni Moda', serif;
      font-weight: 400;
      background-color: #F4F1EA;
      color: #1A1A18;
      overflow-x: clip;              /* clip instead of hidden — doesn't create a scroll container */
    }

    /* ── NAV — always transparent, text adapts to section bg ── */
    #navbar {
      background: transparent !important;
      box-shadow: none !important;
    }
    .nav-link {
      font-size: 10.5px;
      font-weight: 700;
      letter-spacing: 0.18em;
      text-transform: uppercase;
      text-decoration: none;
      padding: 7px 32px;
      border: none;
      border-radius: 0;
      background: #F4F1EA;
      color: #1A1A18;
      opacity: 1;
      display: inline-block;
      transition: background 0.35s ease, color 0.35s ease, opacity 0.2s ease;
    }
    .nav-link:hover { opacity: 0.8; }

    /* Over dark sections — ivory fill, dark text; logo shows naturally (no invert) */
    #navbar.nav-dark .nav-link  { background: #F4F1EA; color: #1A1A18; }
    #navbar.nav-dark .btn-cta   { background: #F4F1EA; color: #1A1A18; }
    #navbar.nav-dark #nav-logo, #navbar.nav-dark #nav-logo-mob { filter: none !important; }

    /* Over light sections — dark fill, ivory text; logo inverts to show on light bg */
    #navbar.nav-light .nav-link { background: #1A1A18; color: #F4F1EA; }
    #navbar.nav-light .btn-cta  { background: #1A1A18; color: #F4F1EA; }
    #navbar.nav-light #nav-logo, #navbar.nav-light #nav-logo-mob { filter: invert(1) !important; }

    .btn-cta {
      font-size: 10.5px;
      letter-spacing: 0.18em;
      text-transform: uppercase;
      font-weight: 700;
      padding: 7px 32px;
      border-radius: 0;
      background: #F4F1EA;
      color: #1A1A18;
      text-decoration: none;
      border: none;
      transition: opacity 0.2s ease;
    }
    .btn-cta:hover { opacity: 0.8; }

    /* Subtle text-link nav button */
    .btn-nav-text {
      font-size: 10px;
      font-weight: 500;
      letter-spacing: 0.2em;
      text-transform: uppercase;
      text-decoration: none;
      background: transparent;
      display: inline-block;
      padding-bottom: 3px;
      border-bottom: 1px solid currentColor;
      opacity: 1;
      transition: opacity 0.25s ease;
    }
    .btn-nav-text:hover { opacity: 0.6; }
    #navbar.nav-dark .btn-nav-text { color: #F4F1EA; }
    #navbar.nav-light .btn-nav-text { color: #1A1A18; }
    .btn-primary {
      display: inline-block;
      font-size: 10.5px;
      letter-spacing: 0.18em;
      text-transform: uppercase;
      font-weight: 700;
      padding: 14px 48px;
      border-radius: 0;
      background: #1A1A18;
      color: #F4F1EA;
      text-decoration: none;
      transition: opacity 0.2s ease;
      cursor: pointer;
      border: none;
    }
    .btn-primary:hover { opacity: 0.8; }
    .btn-outline {
      display: inline-block;
      font-size: 10.5px;
      letter-spacing: 0.18em;
      text-transform: uppercase;
      font-weight: 700;
      padding: 13px 48px;
      border-radius: 0;
      background: #1A1A18;
      color: #F4F1EA;
      border: none;
      text-decoration: none;
      transition: opacity 0.2s ease;
    }
    .btn-outline:hover { opacity: 0.8; }

    /* ── HERO ── */
    .hero-section {
      height: 100svh;
      min-height: 620px;
      position: relative;
      display: flex;
      align-items: flex-end;
      overflow: hidden;
    }
    .hero-bg {
      position: absolute;
      inset: 0;
      will-change: transform;
      transform: translateZ(0);
      background:
        linear-gradient(to right, rgba(10,10,8,0.55) 0%, rgba(10,10,8,0.25) 50%, rgba(10,10,8,0.0) 100%),
        linear-gradient(to bottom, rgba(10,10,8,0.1) 0%, rgba(10,10,8,0) 30%, rgba(10,10,8,0.5) 100%),
        url('BRAND_ASSETS/IMG_2961.jpeg') center/cover no-repeat;
    }

    /* ── TYPOGRAPHY ── */
    /* ═══════════════════════════════════════
       UNIFIED TYPE SYSTEM — Bodoni Moda
       All text uses Bodoni Moda.
       uppercase + tracked, body is mixed-case.
    ═══════════════════════════════════════ */

    /* Bodoni Moda as the universal base — no exceptions */
    *, *::before, *::after {
      font-family: 'Bodoni Moda', serif !important;
    }
    body  { font-size: 13px; line-height: 1.85; font-weight: 400; color: inherit; }
    p, li { font-size: 13px; line-height: 1.85; font-weight: 400; }

    /* Display scale — Bodoni Moda */
    .display-xl, h1 {
      font-size: clamp(2.4rem, 5.5vw, 5rem);
      font-weight: 700;
      line-height: 1.05;
      letter-spacing: -0.02em;
      text-transform: none;
    }
    .display-lg, h2 {
      font-size: clamp(1.2rem, 2.8vw, 2.4rem);
      font-weight: 500;
      line-height: 1.1;
      letter-spacing: 0.08em;
      text-transform: uppercase;
    }
    .display-md {
      font-size: clamp(0.9rem, 1.8vw, 1.5rem);
      font-weight: 500;
      line-height: 1.15;
      letter-spacing: 0.08em;
      text-transform: uppercase;
    }
    .display-sm {
      font-size: clamp(0.75rem, 1.2vw, 1rem);
      font-weight: 500;
      line-height: 1.2;
      letter-spacing: 0.08em;
      text-transform: uppercase;
    }

    /* Section headings */
    h3 {
      font-size: clamp(0.85rem, 1.4vw, 1.1rem);
      font-weight: 600;
      line-height: 1.2;
      letter-spacing: 0.16em;
      text-transform: uppercase;
    }
    h4 {
      font-size: 9px;
      font-weight: 600;
      line-height: 1.4;
      letter-spacing: 0.16em;
      text-transform: uppercase;
    }

    /* Eyebrow / labels */
    .eyebrow {
      font-size: 9px !important;
      font-weight: 500;
      letter-spacing: 0.28em;
      text-transform: uppercase;
    }

    /* Body copy helper */
    .body-copy { font-size: 13px; line-height: 1.85; font-weight: 400; }


    /* Stat / card numbers — Inter, larger */
    .card-title  { font-size: 13px; font-weight: 400; letter-spacing: 0.06em; text-transform: uppercase; }
    .card-number { font-size: clamp(2rem, 4vw, 3.5rem); font-weight: 200; letter-spacing: 0.04em; }
    .stat-number { font-size: clamp(2rem, 4vw, 3.5rem); font-weight: 200; letter-spacing: 0.04em; line-height: 1; }


    /* ── CHAMPAGNE DIVIDER ── */
    .gold-line { height: 1px; background: linear-gradient(90deg, transparent, #C5A97A 30%, #C5A97A 70%, transparent); }
    .divider { height: 1px; background: rgba(26,26,24,0.1); }

    /* ── MARQUEE ── */
    @keyframes marquee { 0% { transform: translateX(0); } 100% { transform: translateX(-50%); } }
    .marquee-track { animation: marquee 32s linear infinite; }

    /* ── CAROUSEL ── */
    .carousel-wrapper { position: relative; overflow: visible; }
    .carousel-track {
      display: flex;
      overflow-x: auto;
      scroll-behavior: auto;
      gap: 16px;
      padding-left: max(1.5rem, calc((100vw - 80rem) / 2 + 4rem));
      padding-right: 3rem;
      padding-top: 14px;
      padding-bottom: 14px;
      cursor: default;
      touch-action: pan-x;
      -webkit-overflow-scrolling: touch;
      scrollbar-width: none;
      overflow-anchor: none;
    }
    .carousel-track::-webkit-scrollbar { display: none; }
    .carousel-card {
      flex: 0 0 280px;
      height: 380px;
      position: relative;
      overflow: hidden;
      /* NO transform transition — any transform on hover triggers
         scroll-container layout recalc and resets scroll position */
    }
    @media (min-width: 768px) { .carousel-card { flex: 0 0 340px; height: 440px; } }
    /* Arrow buttons */
    .carousel-arrow {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      z-index: 10;
      width: 44px; height: 44px;
      background: #F4F1EA;
      border: 1px solid rgba(26,26,24,0.15);
      display: flex; align-items: center; justify-content: center;
      cursor: pointer;
      transition: background 0.2s ease, border-color 0.2s ease;
      box-shadow: 0 2px 12px rgba(26,26,24,0.12);
    }
    .carousel-arrow:hover { background: #1A1A18; }
    .carousel-arrow:hover svg { stroke: #F4F1EA; }
    .carousel-arrow svg { stroke: #1A1A18; transition: stroke 0.2s ease; }
    .carousel-arrow.prev { left: -22px; }
    .carousel-arrow.next { right: -22px; }
    .carousel-arrow:disabled { opacity: 0.3; pointer-events: none; }
    /* wrapper must NOT clip arrows */
    .carousel-wrapper { overflow: visible; }
    /* hover: only darken overlay — no translateY which triggers snap reset */
    .carousel-card .card-inner {
      width: 100%;
      height: 100%;
      position: relative;
      display: flex;
      flex-direction: column;
      justify-content: flex-end;
      padding: 28px;
      /* Pinking-shears — 8 teeth per side (down from 32; looks identical, 4× faster to rasterize) */
      clip-path: polygon(
        0% 0%,
        6.25% 1.5%,   12.5% 0%,  18.75% 1.5%,  25% 0%,
        31.25% 1.5%,  37.5% 0%,  43.75% 1.5%,  50% 0%,
        56.25% 1.5%,  62.5% 0%,  68.75% 1.5%,  75% 0%,
        81.25% 1.5%,  87.5% 0%,  93.75% 1.5%,  100% 0%,
        98.5% 6.25%,  100% 12.5%, 98.5% 18.75%, 100% 25%,
        98.5% 31.25%, 100% 37.5%, 98.5% 43.75%, 100% 50%,
        98.5% 56.25%, 100% 62.5%, 98.5% 68.75%, 100% 75%,
        98.5% 81.25%, 100% 87.5%, 98.5% 93.75%, 100% 100%,
        93.75% 98.5%, 87.5% 100%, 81.25% 98.5%, 75% 100%,
        68.75% 98.5%, 62.5% 100%, 56.25% 98.5%, 50% 100%,
        43.75% 98.5%, 37.5% 100%, 31.25% 98.5%, 25% 100%,
        18.75% 98.5%, 12.5% 100%,  6.25% 98.5%,  0% 100%,
        1.5% 93.75%, 0% 87.5%, 1.5% 81.25%, 0% 75%,
        1.5% 68.75%, 0% 62.5%, 1.5% 56.25%, 0% 50%,
        1.5% 43.75%, 0% 37.5%, 1.5% 31.25%, 0% 25%,
        1.5% 18.75%, 0% 12.5%, 1.5%  6.25%, 0%  0%
      );
    }
    .carousel-card .card-number {
      font-size: 3.2rem;
      font-weight: 400;
      line-height: 1;
      letter-spacing: 0.06em;
      position: absolute;
      top: 16px;
      left: 20px;
      opacity: 0.9;
    }
    /* Corner bracket decorators */
    /* Full border frame — sits outside card with a gap, + ticks at two opposite corners */
    .carousel-card {
      position: relative;
    }
    .card-label {
      position: relative;
      z-index: 2;
    }
    .carousel-card .card-label .card-title {
      font-size: 10px;
      font-weight: 500;
      letter-spacing: 0.18em;
      text-transform: uppercase;
      color: #F4F1EA;
      line-height: 1.4;
    }
    .carousel-card .card-label .card-sub {
      font-size: 9px;
      letter-spacing: 0.2em;
      text-transform: uppercase;
      color: rgba(244,241,234,0.55);
      margin-top: 6px;
    }
    .carousel-tab {
      font-size: 10.5px;
      letter-spacing: 0.18em;
      text-transform: uppercase;
      font-weight: 700;
      padding: 7px 32px;
      border: none;
      border-radius: 0;
      cursor: pointer;
      transition: opacity 0.2s ease;
      background: rgba(26,26,24,0.12);
      color: #1A1A18;
    }
    .carousel-tab.active {
      background: #1A1A18;
      color: #F4F1EA;
    }
    .carousel-tab:hover:not(.active) { opacity: 0.7; }

    /* ── BLEND TAG ── */
    .blend-tag {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      border: 1px solid #1A1A18;
      border-radius: 0;
      padding: 7px 24px;
      background: transparent;
      color: #1A1A18;
      font-size: 10.5px;
      letter-spacing: 0.18em;
      text-transform: uppercase;
      font-weight: 500;
    }

    /* ── PROCESS STEPS ── */
    .process-step-text {
      transition: opacity 0.7s ease, transform 0.7s ease;
    }
    /* Images are always visible — no pop-in, no thread showing through */
    .process-step-img {
      opacity: 1 !important;
      transform: none !important;
    }
    .process-step-wrap {
      display: grid;
      grid-template-columns: 1fr;
      gap: 0;
    }
    @media (min-width: 1024px) { .process-step-wrap { grid-template-columns: 1fr 1fr; } }
    .process-step {
      position: relative;
      padding: 60px 0;
    }
    .process-step:not(:last-child) { border-bottom: 1px solid rgba(26,26,24,0.08); }
    .process-img {
      width: 100%;
      aspect-ratio: 16/10;
      object-fit: cover;
      display: block;
    }

    /* ── TIMELINE ── */
    #timeline-container { position: relative; }
    .journey-row {
      display: grid;
      grid-template-columns: 1fr;
      border-top: 1px solid rgba(26,26,24,0.08);
    }
    @media (min-width: 768px) {
      .journey-row { grid-template-columns: 5fr 7fr; }
      .journey-row-flip { grid-template-columns: 7fr 5fr; }
    }
    .journey-row:last-child { border-bottom: 1px solid rgba(26,26,24,0.08); }
    .journey-artwork {
      position: relative;
      overflow: hidden;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      padding: 2.5rem 2rem;
      min-height: 180px;
    }
    .journey-artwork .artwork-year {
      position: absolute;
      font-family: 'Bodoni Moda', serif;
      font-size: clamp(3.5rem, 8vw, 6rem);
      font-weight: 700;
      letter-spacing: -0.03em;
      color: rgba(197,169,122,0.1);
      line-height: 1;
      pointer-events: none;
      user-select: none;
      white-space: nowrap;
    }
    .journey-artwork .artwork-icon {
      position: relative;
      z-index: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      width: 64px;
      height: 64px;
      border: 1px solid rgba(197,169,122,0.3);
      background: rgba(197,169,122,0.05);
      margin-bottom: 0.85rem;
    }
    .journey-artwork .artwork-label {
      position: relative;
      z-index: 1;
      font-size: 9px;
      font-weight: 700;
      letter-spacing: 0.2em;
      text-transform: uppercase;
      color: rgba(197,169,122,0.5);
    }
    .journey-content {
      padding: 2rem 2.5rem;
      display: flex;
      flex-direction: column;
      justify-content: center;
      border-left: 1px solid rgba(26,26,24,0.08);
    }
    .journey-row-flip .journey-content {
      border-left: none;
      border-right: 1px solid rgba(26,26,24,0.08);
    }
    @media (max-width: 767px) {
      .journey-content { border-left: none !important; border-right: none !important; border-top: 1px solid rgba(26,26,24,0.08); }
    }
    .milestone-year {
      font-size: clamp(0.72rem, 1.1vw, 0.82rem);
      font-weight: 700;
      letter-spacing: 0.16em;
      color: #C5A97A;
      text-transform: uppercase;
      line-height: 1;
      display: block;
      margin-bottom: 0.6rem;
    }

    /* ── MOBILE MENU ── */
    #mobile-menu {
      transform: translateX(100%);
      transition: transform 0.45s cubic-bezier(0.25,0.46,0.45,0.94);
    }
    #mobile-menu.open { transform: translateX(0); }

    /* ── SCROLL REVEAL ── */
    /* No pre-applied will-change — GSAP adds it only during animation */
    .gsap-reveal {}
    .reveal {}

    /* Pause marquee & pulse during scroll to cut paint load */
    .is-scrolling .marquee-track { animation-play-state: paused; }

    /* ── MAP ── */
    .map-dot {
      cursor: pointer;
    }
    .map-dot circle.pulse {
      transform-box: fill-box;
      transform-origin: center;
      will-change: transform, opacity;
      animation: mapPulse 2.5s ease-out infinite;
    }
    .is-scrolling .map-dot circle.pulse {
      animation-play-state: paused;
    }
    @keyframes mapPulse {
      0%   { transform: scale(1);   opacity: 0.8; }
      70%  { transform: scale(2.4); opacity: 0; }
      100% { transform: scale(1);   opacity: 0; }
    }
    /* Arc draw-on animation */
    @keyframes drawArc {
      to { stroke-dashoffset: 0; }
    }
    /* Travelling dot along arc */
    @keyframes travelDot {
      0%   { opacity: 0; }
      10%  { opacity: 1; }
      85%  { opacity: 1; }
      100% { opacity: 0; }
    }
    .map-tooltip {
      pointer-events: none;
      opacity: 0;
      transition: opacity 0.2s ease;
    }
    .map-dot:hover .map-tooltip { opacity: 1; }

    /* ── THREAD PATH ── */
    #thread-path {
      fill: none;
      stroke: #C5A97A;
      stroke-width: 1.5;
      stroke-linecap: round;
      stroke-linejoin: round;
    }

    /* ── SECTION BG ── */
    .bg-ivory     { background-color: #F4F1EA; }
    .bg-ecru      { background-color: #E8E0D0; }
    .bg-obsidian  { background-color: #1A1A18; }
    .bg-navy      { background-color: #1C2540; }

    /* ── SCROLLLINE ANIM ── */
    @keyframes scrollLine { 0% { transform: translateY(-100%); } 100% { transform: translateY(280%); } }

    /* ── HERITAGE PHOTO FRAME (same outline+tick as carousel cards) ── */
    .heritage-frame {
      outline: 1px solid #1A1A18;
      outline-offset: 4px;
      position: relative;
      display: block;
    }
    .heritage-frame::before {
      content: '';
      position: absolute;
      top: -10px; left: -10px;
      width: 10px; height: 10px;
      z-index: 20;
      pointer-events: none;
      background:
        linear-gradient(#1A1A18,#1A1A18) 0 9px / 100% 1px no-repeat,
        linear-gradient(#1A1A18,#1A1A18) 9px 0 / 1px 100% no-repeat;
    }
    .heritage-frame::after {
      content: '';
      position: absolute;
      bottom: -10px; right: -10px;
      width: 10px; height: 10px;
      z-index: 20;
      pointer-events: none;
      background:
        linear-gradient(#1A1A18,#1A1A18) 0 0 / 100% 1px no-repeat,
        linear-gradient(#1A1A18,#1A1A18) 0 0 / 1px 100% no-repeat;
    }

    /* ── HOW WE WORK — minimalist numbered list ── */
    .craft-step {
      position: relative;
      padding: 2rem 0;
      display: flex;
      flex-direction: column;
      gap: 1rem;
    }
    .step-thread {
      display: block;
      position: absolute;
      top: 0; left: 0;
      height: 1px;
      width: 100%;
      background: linear-gradient(to right, #C5A97A 60%, rgba(197,169,122,0.12));
      transform: scaleX(0);
      transform-origin: left center;
    }
    .craft-step:last-child {
      border-bottom: 1px solid rgba(197,169,122,0.14);
    }
    @media (min-width: 1024px) {
      .craft-step {
        display: grid;
        grid-template-columns: 110px 1fr 1.6fr 280px;
        gap: 3.5rem;
        align-items: center;
        padding: 3rem 0;
      }
    }
    .craft-step-num {
      font-size: clamp(2.5rem,4vw,4rem);
      font-weight: 200;
      color: #C5A97A;
      line-height: 1;
      letter-spacing: 0.04em;
    }
    .craft-step-label {
      font-size: 9px;
      font-weight: 700;
      letter-spacing: 0.24em;
      text-transform: uppercase;
      color: rgba(197,169,122,0.5);
      margin-bottom: 0.4rem;
    }
    .craft-step-title {
      font-size: clamp(1.05rem,1.8vw,1.45rem);
      font-weight: 500;
      color: #F4F1EA;
      letter-spacing: 0.02em;
      line-height: 1.3;
    }
    .craft-step-desc {
      font-size: 13.5px;
      line-height: 1.95;
      color: rgba(244,241,234,0.38);
      padding-top: 0.3rem;
    }
    .craft-step-photo {
      display: none;
    }
    @media (min-width: 1024px) {
      .craft-step-photo {
        display: block;
        width: 280px;
        height: 185px;
        overflow: hidden;
        position: relative;
        flex-shrink: 0;
      }
      .craft-step-photo img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        filter: grayscale(40%) brightness(0.85);
        transition: filter 0.5s ease, transform 0.6s cubic-bezier(0.25,0.46,0.45,0.94);
      }
      .craft-step:hover .craft-step-photo img {
        filter: grayscale(0%) brightness(1);
        transform: scale(1.05);
      }
      .craft-step-photo::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(to bottom, transparent 50%, rgba(26,26,24,0.55));
        pointer-events: none;
      }
    }
    @media (max-width: 1023px) {
      .craft-step-photo-mobile {
        display: block;
        width: 100%;
        height: 200px;
        overflow: hidden;
      }
      .craft-step-photo-mobile img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        filter: grayscale(30%);
      }
    }
    @media (min-width: 1024px) {
      .craft-step-photo-mobile { display: none; }
    }

    /* ── TESTIMONIAL AUTO-CAROUSEL ── */
    .testimonial-track {
      display: flex;
      gap: 20px;
      width: max-content;
      will-change: transform;
      user-select: none;
    }
    .testimonial-card {
      flex: 0 0 400px;
      background: #E8E0D0;
      padding: 36px 40px;
    }

    /* ══ MOBILE OPTIMISATIONS ═══════════════════════════════════════════ */

    /* 1. Hamburger lines adapt to nav mode — visible on light-bg sections */
    #navbar.nav-light #menu-btn span { background-color: #1A1A18 !important; }

    /* 2. Hero stats: 2×2 grid on phones instead of single cramped row */
    @media (max-width: 639px) {
      .hero-stats {
        display: grid !important;
        grid-template-columns: 1fr 1fr;
        gap: 1.25rem 0.75rem;
        padding-left: 1.25rem !important;
        margin-bottom: 2rem !important;
      }
      .hero-stats > div {
        border-left: none !important;
        padding-left: 0 !important;
      }
    }

    /* 3. Collections lift: less aggressive pull-up on small screens */
    @media (max-width: 639px) {
      .collections-lift { margin-top: -100px !important; }
    }
    @media (min-width: 640px) and (max-width: 1023px) {
      .collections-lift { margin-top: -200px !important; }
    }

    /* 4. Heritage city strip: full-width bottom text on mobile */
    @media (max-width: 767px) {
      .heritage-city-frame { height: 520px !important; }
      .heritage-city-grad {
        background: linear-gradient(to bottom, transparent 30%, rgba(10,10,8,0.72) 62%, rgba(10,10,8,0.96) 100%) !important;
      }
      .heritage-city-text {
        width: 100% !important;
        top: auto !important;
        padding: 1.5rem 1.5rem 2rem !important;
      }
      .heritage-city-vr { display: none !important; }
    }

    /* 5. Heritage portrait cards: reduce height on phones */
    @media (max-width: 639px) {
      .heritage-portrait { height: 400px !important; }
    }

    /* 6. Contact email address wraps on narrow screens */
    @media (max-width: 639px) {
      #contact a[href^="mailto"] { overflow-wrap: anywhere; word-break: break-all; }
    }
  </style>
</head>
<body class="bg-ivory text-ntc-obsidian">

  <!-- ══════════════════════════════════════════
       NAVIGATION
  ══════════════════════════════════════════ -->
  <nav id="navbar" class="fixed top-0 left-0 right-0 z-50 nav-dark" style="transition: color 0.35s ease;">
    <div class="max-w-screen-xl mx-auto px-6 lg:px-12">
      <!-- 3-column grid: Lookbook · logo · Let's Talk -->
      <div class="hidden lg:grid py-5" style="grid-template-columns:1fr auto 1fr;align-items:center;">

        <!-- Left: Lookbook -->
        <div class="flex items-center">
          <a href="lookbook.php" class="btn-nav-text">Lookbook</a>
        </div>

        <!-- Center: Logo -->
        <a href="#" class="flex justify-center">
          <img src="BRAND_ASSETS/napoleon logo-2.png" alt="Napoleon Textile Company"
               id="nav-logo" class="w-auto" style="height:4.8rem;filter: none; transition: filter 0.35s ease;" />
        </a>

        <!-- Right: Let's Talk -->
        <div class="flex items-center justify-end">
          <a href="#contact" class="btn-nav-text">Get in Touch</a>
        </div>

      </div>

      <!-- Mobile row -->
      <div class="flex lg:hidden items-center justify-between py-5">
        <a href="#">
          <img src="BRAND_ASSETS/napoleon logo-2.png" alt="Napoleon Textile Company"
               id="nav-logo-mob" class="w-auto" style="height:3.5rem;filter: none; transition: filter 0.35s ease;" />
        </a>
        <button id="menu-btn" class="p-2 focus:outline-none" aria-label="Menu">
          <div class="space-y-1.5">
            <span class="block w-6 h-px bg-ntc-ivory transition-transform duration-300"></span>
            <span class="block w-6 h-px bg-ntc-ivory transition-opacity duration-300"></span>
            <span class="block w-6 h-px bg-ntc-ivory transition-transform duration-300"></span>
          </div>
        </button>
      </div>

    </div>
  </nav>

  <!-- Mobile Menu -->
  <div id="mobile-menu" class="fixed inset-0 z-40 bg-ntc-obsidian flex flex-col pt-24 px-8 pb-12">
    <div class="flex flex-col gap-10">
      <a href="#collections" class="font-display text-3xl font-light text-ntc-ivory" style="letter-spacing:-0.01em;" onclick="closeMobile()">Collections</a>
      <a href="#heritage"    class="font-display text-3xl font-light text-ntc-ivory" style="letter-spacing:-0.01em;" onclick="closeMobile()">Heritage</a>
      <a href="#craft"       class="font-display text-3xl font-light text-ntc-ivory" style="letter-spacing:-0.01em;" onclick="closeMobile()">Process</a>
      <a href="#exports"      class="font-display text-3xl font-light text-ntc-ivory" style="letter-spacing:-0.01em;" onclick="closeMobile()">Global Reach</a>
      <a href="lookbook.php" class="font-display text-3xl font-light text-ntc-ivory" style="letter-spacing:-0.01em;" onclick="closeMobile()">Lookbook</a>
      <a href="#contact"      class="font-display text-3xl font-light text-ntc-ivory" style="letter-spacing:-0.01em;" onclick="closeMobile()">Contact</a>
    </div>
    <div class="mt-auto">
      <a href="#contact" class="btn-cta inline-block" style="background:#C5A97A;color:#1A1A18;" onclick="closeMobile()">Enquire Now</a>
      <p class="eyebrow text-ntc-blush mt-6">Mumbai · India · Est. 1995</p>
    </div>
  </div>


  <!-- ══════════════════════════════════════════
       HERO
  ══════════════════════════════════════════ -->
  <section class="hero-section">
    <div class="hero-bg"></div>

    <div class="relative z-10 w-full max-w-screen-xl mx-auto px-6 lg:px-12 pb-16 lg:pb-24">
      <p class="eyebrow text-ntc-champagne mb-7 gsap-hero-sub" style="letter-spacing:0.32em;opacity:0.65;">Est. 1995 &nbsp;·&nbsp; Mumbai, India</p>

      <h1 class="text-ntc-ivory gsap-hero-h1"
          style="font-size:clamp(2.4rem,5.5vw,5rem);font-weight:400;line-height:1.05;letter-spacing:-0.01em;text-transform:none;max-width:680px;margin-bottom:2.8rem;">
        Thirty years of fabric<br /><em style="color:#C5A97A;font-style:italic;">and conviction.</em>
      </h1>

      <!-- Key numbers -->
      <div class="hero-stats flex gap-8 lg:gap-14 gsap-hero-sub" style="margin-bottom:3rem;border-left:1.5px solid rgba(197,169,122,0.4);padding-left:1.75rem;">
        <div>
          <p style="font-size:2rem;font-weight:200;color:#F4F1EA;line-height:1;letter-spacing:0.06em;">30<span style="color:#C5A97A;font-size:0.65rem;letter-spacing:0.1em;vertical-align:super;"> YRS</span></p>
          <p class="eyebrow" style="color:rgba(244,241,234,0.4);margin-top:5px;">In Business</p>
        </div>
        <div style="border-left:1px solid rgba(197,169,122,0.2);padding-left:2rem;">
          <p style="font-size:2rem;font-weight:200;color:#F4F1EA;line-height:1;letter-spacing:0.06em;">3.5<span style="color:#C5A97A;font-size:0.65rem;letter-spacing:0.1em;vertical-align:super;"> M+</span></p>
          <p class="eyebrow" style="color:rgba(244,241,234,0.4);margin-top:5px;">Metres Annually</p>
        </div>
        <div style="border-left:1px solid rgba(197,169,122,0.2);padding-left:2rem;">
          <p style="font-size:2rem;font-weight:200;color:#F4F1EA;line-height:1;letter-spacing:0.06em;">12<span style="color:#C5A97A;font-size:0.65rem;letter-spacing:0.1em;vertical-align:super;"> +</span></p>
          <p class="eyebrow" style="color:rgba(244,241,234,0.4);margin-top:5px;">Countries Served</p>
        </div>
        <div style="border-left:1px solid rgba(197,169,122,0.2);padding-left:2rem;">
          <p style="font-size:2rem;font-weight:200;color:#F4F1EA;line-height:1;letter-spacing:0.06em;">500<span style="color:#C5A97A;font-size:0.65rem;letter-spacing:0.1em;vertical-align:super;"> +</span></p>
          <p class="eyebrow" style="color:rgba(244,241,234,0.4);margin-top:5px;">New Designs / Season</p>
        </div>
      </div>

    </div>

    <!-- Scroll indicator -->
    <div class="absolute bottom-8 right-8 lg:right-12 flex flex-col items-center gap-2 z-10">
      <span class="eyebrow text-ntc-ivory/30" style="writing-mode:vertical-lr;font-size:8px;">Scroll</span>
      <div class="w-px h-12 bg-ntc-ivory/15 relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full bg-ntc-ivory/50" style="height:40%;animation:scrollLine 2s ease-in-out infinite;"></div>
      </div>
    </div>
  </section>


  <!-- ══════════════════════════════════════════
       MARQUEE
  ══════════════════════════════════════════ -->
  <div class="bg-ntc-obsidian py-3 overflow-hidden">
    <div class="marquee-track flex whitespace-nowrap">
      <span class="eyebrow text-ntc-ivory/30 mr-10" style="font-size:8px;">Premium Shirting &nbsp;·&nbsp;</span>
      <span class="eyebrow text-ntc-champagne mr-10" style="font-size:8px;">Napoleon Textile Company &nbsp;·&nbsp;</span>
      <span class="eyebrow text-ntc-ivory/30 mr-10" style="font-size:8px;">A Design House in Fabric &nbsp;·&nbsp;</span>
      <span class="eyebrow text-ntc-champagne mr-10" style="font-size:8px;">Made in Mumbai &nbsp;·&nbsp;</span>
      <span class="eyebrow text-ntc-ivory/30 mr-10" style="font-size:8px;">Est. 1995 &nbsp;·&nbsp;</span>
      <span class="eyebrow text-ntc-champagne mr-10" style="font-size:8px;">Serving Brands Worldwide &nbsp;·&nbsp;</span>
      <span class="eyebrow text-ntc-ivory/30 mr-10" style="font-size:8px;">Premium Shirting &nbsp;·&nbsp;</span>
      <span class="eyebrow text-ntc-champagne mr-10" style="font-size:8px;">Napoleon Textile Company &nbsp;·&nbsp;</span>
      <span class="eyebrow text-ntc-ivory/30 mr-10" style="font-size:8px;">A Design House in Fabric &nbsp;·&nbsp;</span>
      <span class="eyebrow text-ntc-champagne mr-10" style="font-size:8px;">Made in Mumbai &nbsp;·&nbsp;</span>
      <span class="eyebrow text-ntc-ivory/30 mr-10" style="font-size:8px;">Est. 1995 &nbsp;·&nbsp;</span>
      <span class="eyebrow text-ntc-champagne mr-10" style="font-size:8px;">Serving Brands Worldwide &nbsp;·&nbsp;</span>
    </div>
  </div>


  <!-- ══════════════════════════════════════════
       EDITORIAL STATEMENT + PHOTO
  ══════════════════════════════════════════ -->
  <canvas id="fabricCanvas" style="display:none;"></canvas>
  <section style="background:#1A1A18;position:relative;overflow:hidden;height:90vh;min-height:620px;">

    <!-- Full-bleed photo -->
    <div style="position:absolute;inset:0;z-index:1;">
      <img src="BRAND_ASSETS/BLBANNER.jpg"
           alt="Napoleon shirting fabric range"
           style="width:100%;height:100%;object-fit:cover;object-position:center center;filter:saturate(1.15) brightness(1.0);" />
      <!-- Bottom darkening — deepens toward where collections card sits over it -->
      <div style="position:absolute;inset:0;background:linear-gradient(to bottom,transparent 30%,rgba(10,10,8,0.5) 65%,rgba(10,10,8,0.82) 88%,rgba(10,10,8,0.95) 100%);"></div>
      <!-- Grain -->
      <svg style="position:absolute;inset:0;width:100%;height:100%;opacity:0.04;pointer-events:none;" xmlns="http://www.w3.org/2000/svg">
        <filter id="grain"><feTurbulence type="fractalNoise" baseFrequency="0.72" numOctaves="4" stitchTiles="stitch"/><feColorMatrix type="saturate" values="0"/></filter>
        <rect width="100%" height="100%" filter="url(#grain)"/>
      </svg>
    </div>

  </section>

  <!-- ────── COLLECTIONS CAROUSELS ────── -->
  <div id="collections" class="collections-lift pt-10 lg:pt-14 pb-14 lg:pb-20 bg-ivory" style="position:relative;z-index:10;margin-top:-300px;border-radius:32px 32px 0 0;box-shadow:0 -48px 120px rgba(10,10,8,0.45),0 -2px 0 rgba(10,10,8,0.15);will-change:transform;">
    <div class="max-w-screen-xl mx-auto px-6 lg:px-16">

      <!-- Section intro -->
      <div class="mb-10 gsap-reveal" style="max-width:640px;">
        <p class="eyebrow text-ntc-champagne mb-3" style="letter-spacing:0.28em;">Our Collections</p>
        <p style="font-size:15px;line-height:1.8;color:#4A4E5A;margin-bottom:1.25rem;">
          Each season we conceive fabric before the market calls for it — building collections around proportion, texture, and colour with genuine design intent. For the brands and labels that deserve more than a catalogue.
        </p>
        <div style="display:flex;flex-wrap:wrap;gap:8px;">
          <span style="border:1px solid rgba(26,26,24,0.18);color:rgba(26,26,24,0.65);font-size:10px;font-weight:600;letter-spacing:0.16em;text-transform:uppercase;padding:6px 14px;display:inline-block;">500+ Developments / Season</span>
          <span style="border:1px solid rgba(26,26,24,0.18);color:rgba(26,26,24,0.65);font-size:10px;font-weight:600;letter-spacing:0.16em;text-transform:uppercase;padding:6px 14px;display:inline-block;">Private Label &amp; Brand Supply</span>
          <span style="border:1px solid rgba(26,26,24,0.18);color:rgba(26,26,24,0.65);font-size:10px;font-weight:600;letter-spacing:0.16em;text-transform:uppercase;padding:6px 14px;display:inline-block;">Global Export</span>
        </div>
      </div>

      <!-- Browse by + Tabs — tight together -->
      <div class="flex items-center mb-10 flex-wrap gap-4">
        <div class="gsap-reveal">
          <h2 class="display-md text-ntc-obsidian" style="margin-right:1.25rem;">Browse by</h2>
        </div>
        <div class="flex gap-2 gsap-reveal">
          <button class="carousel-tab active" onclick="switchTab('occasion',this)">By Occasion</button>
          <button class="carousel-tab" onclick="switchTab('pattern',this)">By Pattern</button>
        </div>
      </div>

    </div><!-- /constrained header -->

      <!-- Occasion Carousel — full bleed -->
      <div id="carousel-occasion" class="carousel-panel">
        <div class="carousel-wrapper">
        <div class="carousel-track" id="track-occasion" data-lenis-prevent>

          <!-- Boardroom Formal -->
          <a href="lookbook.php" class="carousel-card gsap-reveal" style="text-decoration:none;display:block;">

            <div class="card-inner" style="background:#0E0E0C;overflow:hidden;position:relative;">
              <video class="collection-video" muted loop playsinline autoplay preload="none"
                     style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;z-index:0;pointer-events:none;">
                <source src="BRAND_ASSETS/Boardroom formal.mov" type="video/quicktime">
              </video>
              <div style="position:absolute;inset:0;background:linear-gradient(to top,rgba(0,0,0,0.72) 0%,rgba(0,0,0,0.18) 55%,transparent 100%);z-index:1;"></div>
              <span class="card-number text-ntc-ivory" style="z-index:2;">01</span>
              <div class="card-label" style="z-index:2;">
                <p class="card-title">Boardroom<br />Formal</p>
                <p class="card-sub">Power dressing · Corporate · Sharp</p>
              </div>
            </div>
          </a>

          <!-- Smart Casual -->
          <a href="lookbook.php" class="carousel-card gsap-reveal" style="text-decoration:none;display:block;">

            <div class="card-inner" style="background:#2A2E38;overflow:hidden;position:relative;">
              <video class="collection-video" muted loop playsinline autoplay preload="none"
                     style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;z-index:0;pointer-events:none;">
                <source src="BRAND_ASSETS/Smart Casual.mov" type="video/quicktime">
              </video>
              <div style="position:absolute;inset:0;background:linear-gradient(to top,rgba(0,0,0,0.72) 0%,rgba(0,0,0,0.18) 55%,transparent 100%);z-index:1;"></div>
              <span class="card-number text-ntc-ivory" style="z-index:2;">02</span>
              <div class="card-label" style="z-index:2;">
                <p class="card-title">Smart<br />Casual</p>
                <p class="card-sub">Relaxed elegance · Weekend · Travel</p>
              </div>
            </div>
          </a>

          <!-- Evening & Occasion -->
          <a href="lookbook.php" class="carousel-card gsap-reveal" style="text-decoration:none;display:block;">

            <div class="card-inner" style="background:#1A0E08;overflow:hidden;position:relative;">
              <video class="collection-video" muted loop playsinline autoplay preload="none"
                     style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;z-index:0;pointer-events:none;">
                <source src="BRAND_ASSETS/Evening wear.mov" type="video/quicktime">
              </video>
              <div style="position:absolute;inset:0;background:linear-gradient(to top,rgba(0,0,0,0.72) 0%,rgba(0,0,0,0.18) 55%,transparent 100%);z-index:1;"></div>
              <span class="card-number text-ntc-champagne" style="z-index:2;">03</span>
              <div class="card-label" style="z-index:2;">
                <p class="card-title">Evening<br />&amp; Occasion</p>
                <p class="card-sub">Galas · Events · Heritage luxury</p>
              </div>
            </div>
          </a>

          <!-- Workwear & Uniform -->
          <a href="lookbook.php" class="carousel-card gsap-reveal" style="text-decoration:none;display:block;">

            <div class="card-inner" style="background:#1A1810;overflow:hidden;position:relative;">
              <video class="collection-video" muted loop playsinline autoplay preload="none"
                     style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;z-index:0;pointer-events:none;">
                <source src="BRAND_ASSETS/Workwear.mov" type="video/quicktime">
              </video>
              <div style="position:absolute;inset:0;background:linear-gradient(to top,rgba(0,0,0,0.72) 0%,rgba(0,0,0,0.18) 55%,transparent 100%);z-index:1;"></div>
              <span class="card-number text-ntc-champagne" style="z-index:2;">04</span>
              <div class="card-label" style="z-index:2;">
                <p class="card-title">Workwear<br />&amp; Uniform</p>
                <p class="card-sub">Hospitality · Corporate uniform · Durable</p>
              </div>
            </div>
          </a>

          <!-- Travel & Leisure -->
          <a href="lookbook.php" class="carousel-card gsap-reveal" style="text-decoration:none;display:block;">
            <div class="card-inner" style="background:#1C2830;overflow:hidden;position:relative;">
              <video class="collection-video" muted loop playsinline autoplay preload="none"
                     style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;z-index:0;pointer-events:none;">
                <source src="BRAND_ASSETS/Resort wear.mov" type="video/quicktime">
              </video>
              <div style="position:absolute;inset:0;background:linear-gradient(to top,rgba(0,0,0,0.72) 0%,rgba(0,0,0,0.18) 55%,transparent 100%);z-index:1;"></div>
              <span class="card-number text-ntc-ivory" style="z-index:2;">05</span>
              <div class="card-label" style="z-index:2;">
                <p class="card-title">Travel<br />&amp; Leisure</p>
                <p class="card-sub">Resort · Weekend · Easy elegance</p>
              </div>
            </div>
          </a>

        </div>
        </div><!-- /carousel-wrapper -->
      </div>

      <!-- Pattern Carousel (hidden by default) — full bleed -->
      <div id="carousel-pattern" class="carousel-panel hidden">
        <div class="carousel-wrapper">
        <div class="carousel-track" id="track-pattern" data-lenis-prevent>

          <!-- Checks -->
          <a href="lookbook.php?cat=checks" class="carousel-card gsap-reveal" style="text-decoration:none;display:block;">

            <div class="card-inner" style="
              background-color:#E8E0D0;
              background-image:
                repeating-linear-gradient(0deg,transparent 0,transparent 14px,rgba(74,78,90,0.18) 14px,rgba(74,78,90,0.18) 15px),
                repeating-linear-gradient(90deg,transparent 0,transparent 14px,rgba(74,78,90,0.18) 14px,rgba(74,78,90,0.18) 15px);
              ">
              <span class="card-number" style="color:rgba(26,26,24,0.1)">01</span>
              <div class="card-label">
                <p class="card-title" style="color:#1A1A18;">Checks &<br />Windowpanes</p>
                <p class="card-sub" style="color:rgba(26,26,24,0.5);">Tattersall · Prince of Wales · Gingham</p>
              </div>
            </div>
          </a>

          <!-- Stripes -->
          <a href="lookbook.php?cat=stripes" class="carousel-card gsap-reveal" style="text-decoration:none;display:block;">

            <div class="card-inner" style="
              background-color:#F4F1EA;
              background-image:repeating-linear-gradient(
                0deg,
                transparent 0,transparent 9px,
                rgba(28,37,64,0.18) 9px,rgba(28,37,64,0.18) 11px,
                transparent 11px,transparent 22px,
                rgba(28,37,64,0.1) 22px,rgba(28,37,64,0.1) 23px,
                transparent 23px,transparent 32px
              );
              ">
              <span class="card-number" style="color:rgba(28,37,64,0.1)">02</span>
              <div class="card-label">
                <p class="card-title" style="color:#1A1A18;">Stripes &<br />Pinstripes</p>
                <p class="card-sub" style="color:rgba(26,26,24,0.5);">Bengal · Chalk stripe · Multicolor</p>
              </div>
            </div>
          </a>

          <!-- Dobbies -->
          <a href="lookbook.php?cat=dobbies" class="carousel-card gsap-reveal" style="text-decoration:none;display:block;">

            <div class="card-inner" style="
              background-color:#1A1A18;
              background-image:repeating-linear-gradient(45deg,rgba(197,169,122,0.12) 0,rgba(197,169,122,0.12) 1px,transparent 1px,transparent 10px),
              repeating-linear-gradient(-45deg,rgba(197,169,122,0.08) 0,rgba(197,169,122,0.08) 1px,transparent 1px,transparent 10px);
              ">
              <span class="card-number text-ntc-champagne">03</span>
              <div class="card-label">
                <p class="card-title">Dobbies &<br />Jacquards</p>
                <p class="card-sub">Woven texture · Self-pattern · Birdseye</p>
              </div>
            </div>
          </a>

          <!-- Plains -->
          <a href="lookbook.php?cat=plains" class="carousel-card gsap-reveal" style="text-decoration:none;display:block;">

            <div class="card-inner" style="background:linear-gradient(160deg,#4A4E5A 0%,#3A3E48 100%);">
              <span class="card-number text-ntc-ivory">04</span>
              <div class="card-label">
                <p class="card-title">Plains &<br />Solids</p>
                <p class="card-sub">Poplin · Oxford · Broadcloth</p>
              </div>
            </div>
          </a>

          <!-- Uniforms -->
          <a href="lookbook.php?cat=uniforms" class="carousel-card gsap-reveal" style="text-decoration:none;display:block;">

            <div class="card-inner" style="
              background-color:#2A3040;
              background-image:repeating-linear-gradient(0deg,rgba(255,255,255,0.04) 0,rgba(255,255,255,0.04) 1px,transparent 1px,transparent 10px),
              repeating-linear-gradient(90deg,rgba(255,255,255,0.03) 0,rgba(255,255,255,0.03) 1px,transparent 1px,transparent 10px);
              ">
              <span class="card-number text-ntc-ivory">05</span>
              <div class="card-label">
                <p class="card-title">Uniforms<br />&amp; Workwear</p>
                <p class="card-sub">Durable · Structured · Institutional</p>
              </div>
            </div>
          </a>

        </div>
        </div><!-- /carousel-wrapper -->
      </div>

    <div class="max-w-screen-xl mx-auto px-6 lg:px-16">
      <!-- Blends + Finishes — elevated two-column panel -->
      <div class="mt-10 mb-0 gsap-reveal" style="border-top:1px solid rgba(26,26,24,0.08);padding-top:2.5rem;">

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-0">

          <!-- ── OUR FABRIC BLENDS ── -->
          <div class="lg:pr-12">
            <div style="display:flex;align-items:center;gap:1rem;margin-bottom:1.75rem;">
              <p class="eyebrow" style="color:#C5A97A;letter-spacing:0.28em;white-space:nowrap;">Our Fabric Blends</p>
              <div style="flex:1;height:1px;background:rgba(197,169,122,0.25);"></div>
            </div>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:2px;">

              <div style="background:#EDE8DF;padding:20px 22px;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#C5A97A" stroke-width="1.2"><circle cx="12" cy="12" r="10"/><path d="M12 2a10 10 0 0 0 0 20"/><path d="M2 12h20"/></svg>
                <p style="font-size:13px;font-weight:500;color:#1A1A18;margin-top:12px;letter-spacing:0.02em;">100% Cotton</p>
                <p style="font-size:9px;color:#5A5A52;margin-top:5px;letter-spacing:0.12em;text-transform:uppercase;line-height:1.6;">Egyptian · Pima · Supima</p>
              </div>

              <div style="background:#E8E0D0;padding:20px 22px;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#C5A97A" stroke-width="1.2"><path d="M12 2l3 7h7l-6 4 2 7-6-4-6 4 2-7-6-4h7z"/></svg>
                <p style="font-size:13px;font-weight:500;color:#1A1A18;margin-top:12px;letter-spacing:0.02em;">Poly Cotton</p>
                <p style="font-size:9px;color:#5A5A52;margin-top:5px;letter-spacing:0.12em;text-transform:uppercase;line-height:1.6;">Performance · Durability</p>
              </div>

              <div style="background:#E8E0D0;padding:20px 22px;margin-top:2px;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#C5A97A" stroke-width="1.2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                <p style="font-size:13px;font-weight:500;color:#1A1A18;margin-top:12px;letter-spacing:0.02em;">Giza Blends</p>
                <p style="font-size:9px;color:#5A5A52;margin-top:5px;letter-spacing:0.12em;text-transform:uppercase;line-height:1.6;">Long-staple · Luxury lustre</p>
              </div>

              <div style="background:#EDE8DF;padding:20px 22px;margin-top:2px;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#C5A97A" stroke-width="1.2"><path d="M12 3c-1.5 5-1.5 13 0 18M3 12c5 1.5 13 1.5 18 0"/></svg>
                <p style="font-size:13px;font-weight:500;color:#1A1A18;margin-top:12px;letter-spacing:0.02em;">Tencel / Lyocell</p>
                <p style="font-size:9px;color:#5A5A52;margin-top:5px;letter-spacing:0.12em;text-transform:uppercase;line-height:1.6;">Sustainable · Soft drape</p>
              </div>

            </div>
          </div>

          <!-- ── OUR SPECIAL FINISHES ── -->
          <div class="lg:pl-12 lg:border-l" style="border-color:rgba(26,26,24,0.08);">
            <div style="display:flex;align-items:center;gap:1rem;margin-bottom:1.75rem;">
              <p class="eyebrow" style="color:#C5A97A;letter-spacing:0.28em;white-space:nowrap;">Our Special Finishes</p>
              <div style="flex:1;height:1px;background:rgba(197,169,122,0.25);"></div>
            </div>
            <div style="display:grid;grid-template-columns:repeat(2,1fr);gap:2px;">

              <div style="background:#EDE8DF;padding:18px 20px;display:flex;align-items:center;gap:10px;">
                <div style="width:5px;height:5px;background:#C5A97A;flex-shrink:0;"></div>
                <p style="font-size:10.5px;font-weight:600;color:#1A1A18;letter-spacing:0.1em;text-transform:uppercase;">Easy to Iron</p>
              </div>

              <div style="background:#E8E0D0;padding:18px 20px;display:flex;align-items:center;gap:10px;">
                <div style="width:5px;height:5px;background:#C5A97A;flex-shrink:0;"></div>
                <p style="font-size:10.5px;font-weight:600;color:#1A1A18;letter-spacing:0.1em;text-transform:uppercase;">Liquid Ammonia</p>
              </div>

              <div style="background:#E8E0D0;padding:18px 20px;display:flex;align-items:center;gap:10px;margin-top:2px;">
                <div style="width:5px;height:5px;background:#C5A97A;flex-shrink:0;"></div>
                <p style="font-size:10.5px;font-weight:600;color:#1A1A18;letter-spacing:0.1em;text-transform:uppercase;">Mech. Stretch</p>
              </div>

              <div style="background:#EDE8DF;padding:18px 20px;display:flex;align-items:center;gap:10px;margin-top:2px;">
                <div style="width:5px;height:5px;background:#C5A97A;flex-shrink:0;"></div>
                <p style="font-size:10.5px;font-weight:600;color:#1A1A18;letter-spacing:0.1em;text-transform:uppercase;">Anti Bacterial</p>
              </div>

              <div style="background:#EDE8DF;padding:18px 20px;display:flex;align-items:center;gap:10px;margin-top:2px;">
                <div style="width:5px;height:5px;background:#C5A97A;flex-shrink:0;"></div>
                <p style="font-size:10.5px;font-weight:600;color:#1A1A18;letter-spacing:0.1em;text-transform:uppercase;">Moisture Management</p>
              </div>

              <div style="background:#E8E0D0;padding:18px 20px;display:flex;align-items:center;gap:10px;margin-top:2px;">
                <div style="width:5px;height:5px;background:#C5A97A;flex-shrink:0;"></div>
                <p style="font-size:10.5px;font-weight:600;color:#1A1A18;letter-spacing:0.1em;text-transform:uppercase;">UV Protek</p>
              </div>

            </div>
          </div>

        </div>
      </div>
      <!-- Grey separator below -->
      <div style="height:1px;background:rgba(26,26,24,0.08);margin-top:2.5rem;"></div>
    </div><!-- /constrained blends -->
  </div><!-- /collections -->




  <!-- ══════════════════════════════════════════
       HERITAGE — Founder + Mumbai Roots
  ══════════════════════════════════════════ -->
  <section id="heritage" class="py-14 lg:py-20 bg-ivory">
    <div class="max-w-screen-xl mx-auto px-6 lg:px-12">

      <!-- Intro -->
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-16 items-start mb-12 lg:mb-16">
        <div class="gsap-reveal">
          <p class="eyebrow text-ntc-champagne mb-4">Our Heritage</p>
          <h2 class="display-lg">Rooted in Mumbai.<br /><em>Woven for the World.</em></h2>
        </div>
        <div class="gsap-reveal">
          <div class="divider mb-6 mt-4 lg:mt-12"></div>
          <p class="text-ntc-slate leading-relaxed mb-6" class="body-copy">
            Founded in Mumbai's textile district and built over thirty years, Napoleon Textile Company stands at the meeting point of design and manufacturing. We understand the weight a label carries — the promises it makes, the trust it earns. That understanding shapes every metre of fabric we produce.
          </p>
          <p class="text-ntc-slate leading-relaxed" class="body-copy">
            We work with fashion brands, private labels, and resellers across twelve countries — not as a supplier, but as a partner who takes their craft as seriously as they do. The relationship comes first. The fabric follows.
          </p>
        </div>
      </div>

      <!-- Leadership: two portrait cards -->
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-0 mb-10 lg:mb-14 gsap-reveal" style="padding:10px;">

        <!-- Founder — Mr. Sanjeev Rathod -->
        <div class="heritage-frame" style="margin:6px;">
          <div class="heritage-portrait relative overflow-hidden" style="height:560px;background:#1A1A18;">
            <img src="BRAND_ASSETS/photo_2026-04-06 21.52.10.jpeg"
                 alt="Mr. Sanjeev Rathod — Founder, Napoleon Textile Company"
                 class="absolute inset-0 w-full h-full object-cover object-top"
                 loading="lazy" decoding="async"
                 style="filter:grayscale(18%) contrast(1.06);" />
            <!-- Grain -->
            <svg style="position:absolute;inset:0;width:100%;height:100%;opacity:0.06;pointer-events:none;z-index:1;" xmlns="http://www.w3.org/2000/svg">
              <filter id="hgrain1"><feTurbulence type="fractalNoise" baseFrequency="0.68" numOctaves="4" stitchTiles="stitch"/><feColorMatrix type="saturate" values="0"/></filter>
              <rect width="100%" height="100%" filter="url(#hgrain1)"/>
            </svg>
            <!-- Gradient -->
            <div class="absolute inset-0" style="background:linear-gradient(to top,rgba(10,10,8,0.92) 0%,rgba(10,10,8,0.42) 45%,transparent 75%);z-index:2;"></div>
            <!-- Info bottom -->
            <div class="absolute bottom-0 left-0 right-0 p-8" style="z-index:3;">
              <div style="width:36px;height:1px;background:#C5A97A;margin-bottom:16px;"></div>
              <p class="font-display text-ntc-ivory" style="font-size:1.75rem;font-weight:300;line-height:1.05;letter-spacing:0.01em;">Mr. Sanjeev Rathod</p>
              <p style="font-size:9px;font-weight:600;letter-spacing:0.24em;text-transform:uppercase;color:#C5A97A;margin-top:8px;">Founder</p>
            </div>
          </div>
        </div>

        <!-- Managing Director — Mr. Milind Rathod -->
        <div class="heritage-frame" style="margin:6px;">
          <div class="heritage-portrait relative overflow-hidden" style="height:560px;background:#1A1A18;">
            <img src="BRAND_ASSETS/MR_PIC.jpeg"
                 alt="Mr. Milind Rathod — Managing Director, Napoleon Textile Company"
                 class="absolute inset-0 w-full h-full object-cover"
                 loading="lazy" decoding="async"
                 style="object-position:center 15%;filter:grayscale(18%) contrast(1.06);" />
            <!-- Grain -->
            <svg style="position:absolute;inset:0;width:100%;height:100%;opacity:0.06;pointer-events:none;z-index:1;" xmlns="http://www.w3.org/2000/svg">
              <filter id="hgrain2"><feTurbulence type="fractalNoise" baseFrequency="0.68" numOctaves="4" stitchTiles="stitch"/><feColorMatrix type="saturate" values="0"/></filter>
              <rect width="100%" height="100%" filter="url(#hgrain2)"/>
            </svg>
            <!-- Gradient -->
            <div class="absolute inset-0" style="background:linear-gradient(to top,rgba(10,10,8,0.92) 0%,rgba(10,10,8,0.42) 45%,transparent 75%);z-index:2;"></div>
            <!-- Info bottom -->
            <div class="absolute bottom-0 left-0 right-0 p-8" style="z-index:3;">
              <div style="width:36px;height:1px;background:#C5A97A;margin-bottom:16px;"></div>
              <p class="font-display text-ntc-ivory" style="font-size:1.75rem;font-weight:300;line-height:1.05;letter-spacing:0.01em;">Mr. Milind Rathod</p>
              <p style="font-size:9px;font-weight:600;letter-spacing:0.24em;text-transform:uppercase;color:#C5A97A;margin-top:8px;">Managing Director</p>
            </div>
          </div>
        </div>

      </div>

      <!-- Mumbai editorial strip -->
      <div class="gsap-reveal mb-12 lg:mb-16" style="padding:10px;">
        <div class="heritage-frame">
          <div class="heritage-city-frame relative overflow-hidden" style="height:400px;background:#1A1A18;">

            <!-- Full-bleed photo -->
            <img src="https://images.unsplash.com/photo-1570168007204-dfb528c6958f?w=1400&q=85&auto=format&fit=crop"
                 alt="Mumbai — India"
                 class="absolute inset-0 w-full h-full object-cover"
                 loading="lazy" decoding="async"
                 style="object-position:center 40%;filter:saturate(0.6) brightness(0.75) contrast(1.08);" />

            <!-- Left-to-right darkening — keeps left legible, right panel dark for text -->
            <div class="heritage-city-grad absolute inset-0" style="background:linear-gradient(to right,rgba(10,10,8,0.15) 0%,rgba(10,10,8,0.1) 50%,rgba(10,10,8,0.88) 72%,rgba(10,10,8,0.96) 100%);"></div>
            <!-- Bottom fade -->
            <div class="absolute inset-0" style="background:linear-gradient(to top,rgba(10,10,8,0.55) 0%,transparent 40%);"></div>
            <!-- Grain -->
            <svg style="position:absolute;inset:0;width:100%;height:100%;opacity:0.05;pointer-events:none;" xmlns="http://www.w3.org/2000/svg">
              <filter id="hgrain3"><feTurbulence type="fractalNoise" baseFrequency="0.68" numOctaves="4" stitchTiles="stitch"/><feColorMatrix type="saturate" values="0"/></filter>
              <rect width="100%" height="100%" filter="url(#hgrain3)"/>
            </svg>

            <!-- Bottom-left: location tag -->
            <div class="absolute bottom-8 left-8 lg:left-10">
              <p style="font-size:9px;font-weight:700;letter-spacing:0.26em;text-transform:uppercase;color:rgba(197,169,122,0.6);">Mumbai · India</p>
              <p style="font-size:9px;font-weight:500;letter-spacing:0.15em;color:rgba(244,241,234,0.28);margin-top:4px;">19°04′N · 72°52′E</p>
            </div>

            <!-- Right panel: typographic -->
            <div class="heritage-city-text absolute top-0 bottom-0 right-0 flex flex-col justify-center" style="width:42%;padding:3rem 3rem 3rem 2rem;">
              <!-- Vertical rule -->
              <div class="heritage-city-vr" style="width:1px;height:48px;background:rgba(197,169,122,0.35);margin-bottom:20px;"></div>
              <p style="font-size:9px;font-weight:600;letter-spacing:0.24em;text-transform:uppercase;color:rgba(197,169,122,0.55);margin-bottom:14px;">Our Origin</p>
              <p class="font-display text-ntc-ivory" style="font-size:clamp(2rem,4vw,3.25rem);font-weight:200;line-height:0.95;letter-spacing:-0.01em;margin-bottom:20px;">
                Rooted in a<br /><em>city woven from</em><br />culture &amp; craft.
              </p>
              <p style="font-size:12px;line-height:1.9;color:rgba(244,241,234,0.45);max-width:300px;">
                Mumbai has been India's creative and commercial heartbeat for centuries — a city where ancient trade routes, diverse cultures, and a relentless spirit of craft converge. Napoleon Textile Company is a product of this energy: a place where tradition is not preserved behind glass, but lived in every thread we weave.
              </p>
            </div>

          </div>
        </div>
      </div>

      <!-- Three Pillars -->
      <div>
        <p class="eyebrow text-ntc-slate text-center mb-8 gsap-reveal">What Defines Us</p>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-0 border-t border-ntc-obsidian/10">

          <div class="pt-5 pb-6 pr-0 md:pr-10 gsap-reveal">
            <div class="w-7 h-7 mb-4 flex items-center justify-center border border-ntc-champagne">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#C5A97A" stroke-width="1.5"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/></svg>
            </div>
            <h3 class="font-display text-base font-medium mb-2">Design with Intent</h3>
            <p class="text-ntc-slate text-xs leading-relaxed" style="line-height:1.85;">Every collection begins as a point of view — pattern, hand, drape — before a single thread is sourced. We design for the brands and buyers who recognise the difference between fabric made to a price and fabric made with purpose.</p>
          </div>

          <div class="pt-5 pb-6 px-0 md:px-10 border-t md:border-t-0 md:border-l border-ntc-obsidian/10 gsap-reveal">
            <div class="w-7 h-7 mb-4 flex items-center justify-center border border-ntc-champagne">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#C5A97A" stroke-width="1.5"><path d="M12 22V12M12 12L5 7M12 12l7-5"/><path d="M5 7V17l7 5 7-5V7"/></svg>
            </div>
            <h3 class="font-display text-base font-medium mb-2">Craft Without Compromise</h3>
            <p class="text-ntc-slate text-xs leading-relaxed" style="line-height:1.85;">Quality is not a promise here — it is a consequence of how we work. From yarn selection to finishing, every decision is made with the end wearer in mind. Defect rates under 0.2%. No shortcuts, at any scale.</p>
          </div>

          <div class="pt-5 pb-6 pl-0 md:pl-10 border-t md:border-t-0 md:border-l border-ntc-obsidian/10 gsap-reveal">
            <div class="w-7 h-7 mb-4 flex items-center justify-center border border-ntc-champagne">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#C5A97A" stroke-width="1.5"><circle cx="12" cy="12" r="10"/><path d="M2 12h20M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
            </div>
            <h3 class="font-display text-base font-medium mb-2">A Partnership Worldwide</h3>
            <p class="text-ntc-slate text-xs leading-relaxed" style="line-height:1.85;">Fashion labels, private labels, and resellers across twelve countries trust us season after season. We take that trust seriously — understanding what each partner needs and showing up for them, consistently.</p>
          </div>

        </div>
      </div>

    </div>
  </section>


  <!-- ══════════════════════════════════════════
       TIMELINE — Our Journey
  ══════════════════════════════════════════ -->
  <section class="py-14 lg:py-20 bg-ivory">
    <div class="max-w-screen-xl mx-auto px-6 lg:px-12">

      <div class="text-center mb-10 lg:mb-16">
        <p class="eyebrow text-ntc-slate mb-4 gsap-reveal">Our Journey</p>
        <h2 class="display-lg gsap-reveal">Thirty Years of<br /><em>Fabric &amp; Conviction</em></h2>
      </div>

      <div class="relative" id="timeline-container">
        <!-- Scroll-progress fill line — left edge -->
        <div class="absolute top-0 bottom-0" style="left:0;width:1px;background:rgba(26,26,24,0.07);">
          <div id="timeline-progress" class="w-full" style="height:100%;background:#C5A97A;transform:scaleY(0);transform-origin:top;transition:none;"></div>
        </div>
        <div id="timeline-progress-mob" style="display:none;"></div>

        <div style="padding-left:1px;">

          <!-- 1995 — The Foundation (artwork left) -->
          <div class="journey-row gsap-timeline-item">
            <div class="journey-artwork" style="background:#1A1A18;background-image:repeating-linear-gradient(45deg,rgba(197,169,122,0.07) 0,rgba(197,169,122,0.07) 1px,transparent 1px,transparent 14px);">
              <span class="artwork-year">1995</span>
              <div class="artwork-icon">
                <svg width="32" height="32" viewBox="0 0 48 48" fill="none"><path d="M6 40 L6 24 L24 10 L42 24 L42 40 Z" stroke="#C5A97A" stroke-width="1" fill="rgba(197,169,122,0.08)"/><line x1="14" y1="40" x2="14" y2="28" stroke="#C5A97A" stroke-width="1"/><line x1="24" y1="40" x2="24" y2="28" stroke="#C5A97A" stroke-width="1"/><line x1="34" y1="40" x2="34" y2="28" stroke="#C5A97A" stroke-width="1"/><rect x="18" y="30" width="12" height="10" stroke="#C5A97A" stroke-width="0.8" fill="none"/><line x1="4" y1="40" x2="44" y2="40" stroke="#C5A97A" stroke-width="1.5"/></svg>
              </div>
              <span class="artwork-label">Kalbadevi · Est. 1995</span>
            </div>
            <div class="journey-content">
              <span class="milestone-year">1995</span>
              <h4 class="font-display font-medium mb-2" style="font-size:clamp(1rem,1.6vw,1.2rem);">The Foundation</h4>
              <p class="text-ntc-slate text-sm" style="line-height:1.85;">Mr. Sanjeev Rathod establishes Napoleon Textile Company in Mumbai's Kalbadevi — with one conviction: fabric should be designed, not merely manufactured. A family enterprise rooted in craft from day one.</p>
              <span style="font-size:8px;font-weight:700;letter-spacing:0.18em;text-transform:uppercase;color:rgba(197,169,122,0.6);display:inline-block;margin-top:12px;">Est. 1995 · Kalbadevi, Mumbai</span>
            </div>
          </div>

          <!-- 1997 — First Export Shipment (artwork right) -->
          <div class="journey-row journey-row-flip gsap-timeline-item">
            <div class="journey-content">
              <span class="milestone-year">1997</span>
              <h4 class="font-display font-medium mb-2" style="font-size:clamp(1rem,1.6vw,1.2rem);">First Export Shipment</h4>
              <p class="text-ntc-slate text-sm" style="line-height:1.85;">Just two years after founding, Napoleon's quality earns its first international recognition. A consignment ships to Sri Lanka — the seed of what would grow into a 12-country export network spanning three continents.</p>
              <span style="font-size:8px;font-weight:700;letter-spacing:0.18em;text-transform:uppercase;color:rgba(197,169,122,0.6);display:inline-block;margin-top:12px;">First Destination · Sri Lanka</span>
            </div>
            <div class="journey-artwork" style="background:#1C2540;background-image:repeating-linear-gradient(180deg,rgba(197,169,122,0.07) 0,rgba(197,169,122,0.07) 1px,transparent 1px,transparent 20px);">
              <span class="artwork-year">1997</span>
              <div class="artwork-icon">
                <svg width="32" height="32" viewBox="0 0 48 48" fill="none"><path d="M5 30 L10 22 L38 22 L43 30 Z" stroke="#C5A97A" stroke-width="1" fill="rgba(197,169,122,0.08)"/><rect x="16" y="14" width="16" height="8" stroke="#C5A97A" stroke-width="0.8" fill="none"/><line x1="24" y1="6" x2="24" y2="14" stroke="#C5A97A" stroke-width="1"/><path d="M24 6 L31 9 L24 12" stroke="#C5A97A" stroke-width="0.8" fill="rgba(197,169,122,0.3)"/><path d="M4 34 Q12 32 20 34 Q28 36 36 34 Q44 32 48 34" stroke="#C5A97A" stroke-width="0.8" opacity="0.5"/></svg>
              </div>
              <span class="artwork-label">Sri Lanka · 1997</span>
            </div>
          </div>

          <!-- 2005 — Stripe Supremacy (artwork left) -->
          <div class="journey-row gsap-timeline-item">
            <div class="journey-artwork" style="background:#2A2416;background-image:repeating-linear-gradient(180deg,rgba(197,169,122,0.18) 0,rgba(197,169,122,0.18) 4px,transparent 4px,transparent 20px);">
              <span class="artwork-year">2005</span>
              <div class="artwork-icon">
                <svg width="32" height="32" viewBox="0 0 48 48" fill="none"><rect x="5" y="5" width="38" height="38" stroke="#C5A97A" stroke-width="1"/><rect x="5" y="9" width="38" height="5" fill="rgba(197,169,122,0.55)"/><rect x="5" y="19" width="38" height="5" fill="rgba(197,169,122,0.55)"/><rect x="5" y="29" width="38" height="5" fill="rgba(197,169,122,0.55)"/><rect x="5" y="39" width="38" height="4" fill="rgba(197,169,122,0.55)"/></svg>
              </div>
              <span class="artwork-label">Stripe Master · 2005</span>
            </div>
            <div class="journey-content">
              <span class="milestone-year">2005</span>
              <h4 class="font-display font-medium mb-2" style="font-size:clamp(1rem,1.6vw,1.2rem);">Stripe Supremacy</h4>
              <p class="text-ntc-slate text-sm" style="line-height:1.85;">Napoleon becomes India's go-to name for poly-cotton blended stripe shirting. Deep mastery of yarn ratio, weave construction, and stripe pitch earns preferred-supplier status with India's largest garment exporters.</p>
              <span style="font-size:8px;font-weight:700;letter-spacing:0.18em;text-transform:uppercase;color:rgba(197,169,122,0.6);display:inline-block;margin-top:12px;">No. 1 PC Stripe Supplier · India</span>
            </div>
          </div>

          <!-- 2015 — Cotton First (artwork right) -->
          <div class="journey-row journey-row-flip gsap-timeline-item">
            <div class="journey-content">
              <span class="milestone-year">2015</span>
              <h4 class="font-display font-medium mb-2" style="font-size:clamp(1rem,1.6vw,1.2rem);">Cotton First</h4>
              <p class="text-ntc-slate text-sm" style="line-height:1.85;">Global buyers begin demanding more natural, breathable fabric. Napoleon pivots the core range toward cotton-rich constructions early. Hand-feel improves, repeat orders multiply, and the brand's quality reputation takes a decisive step forward.</p>
              <span style="font-size:8px;font-weight:700;letter-spacing:0.18em;text-transform:uppercase;color:rgba(197,169,122,0.6);display:inline-block;margin-top:12px;">Cotton-Rich Range · 70%+ of Orders</span>
            </div>
            <div class="journey-artwork" style="background:#1F2D20;background-image:radial-gradient(circle,rgba(197,169,122,0.18) 1px,transparent 1px);background-size:22px 22px;">
              <span class="artwork-year">2015</span>
              <div class="artwork-icon">
                <svg width="32" height="32" viewBox="0 0 48 48" fill="none"><circle cx="24" cy="16" r="7" stroke="#C5A97A" stroke-width="1" fill="rgba(197,169,122,0.08)"/><circle cx="14" cy="23" r="6" stroke="#C5A97A" stroke-width="0.8" fill="rgba(197,169,122,0.06)"/><circle cx="34" cy="23" r="6" stroke="#C5A97A" stroke-width="0.8" fill="rgba(197,169,122,0.06)"/><path d="M24 29 L24 42" stroke="#C5A97A" stroke-width="1"/><path d="M24 38 Q16 33 15 38" stroke="#C5A97A" stroke-width="0.8"/><path d="M24 34 Q32 29 33 34" stroke="#C5A97A" stroke-width="0.8"/></svg>
              </div>
              <span class="artwork-label">Cotton Era · 2015</span>
            </div>
          </div>

          <!-- 2018 — Colour Enters (artwork left) -->
          <div class="journey-row gsap-timeline-item">
            <div class="journey-artwork" style="background:#1A1A18;padding:0;">
              <img src="BRAND_ASSETS/PRINTES.jpg" alt="Colour Enters the Story · 2018" style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;object-position:center center;" loading="lazy" decoding="async" />
              <div style="position:absolute;inset:0;background:linear-gradient(to top,rgba(10,10,8,0.75) 0%,rgba(10,10,8,0.2) 60%,transparent 100%);"></div>
              <span class="artwork-year" style="position:relative;z-index:1;">2018</span>
              <span class="artwork-label" style="position:relative;z-index:1;">Prints · 2018</span>
            </div>
            <div class="journey-content">
              <span class="milestone-year">2018</span>
              <h4 class="font-display font-medium mb-2" style="font-size:clamp(1rem,1.6vw,1.2rem);">Colour Enters the Story</h4>
              <p class="text-ntc-slate text-sm" style="line-height:1.85;">Napoleon enters the world of printed fabrics — geometric, floral, and abstract motifs for smart-casual and resort shirting. The move unlocks an entirely new buyer category and a design-forward identity for the company's commercial range.</p>
              <span style="font-size:8px;font-weight:700;letter-spacing:0.18em;text-transform:uppercase;color:rgba(197,169,122,0.6);display:inline-block;margin-top:12px;">Screen &amp; Digital Prints Added</span>
            </div>
          </div>

          <!-- 2019 — Pure Cotton (artwork right) -->
          <div class="journey-row journey-row-flip gsap-timeline-item">
            <div class="journey-content">
              <span class="milestone-year">2019</span>
              <h4 class="font-display font-medium mb-2" style="font-size:clamp(1rem,1.6vw,1.2rem);">Pure Cotton. Always.</h4>
              <p class="text-ntc-slate text-sm" style="line-height:1.85;">A defining commitment: full pivot to 100% cotton yarn-dyed shirting. Seasonal design collections, bespoke colour palettes, and reactive dyeing become the core of Napoleon's identity. Synthetic blends step aside — for good.</p>
              <span style="font-size:8px;font-weight:700;letter-spacing:0.18em;text-transform:uppercase;color:rgba(197,169,122,0.6);display:inline-block;margin-top:12px;">100% Cotton · Reactive Dyed · Seasonal Collections</span>
            </div>
            <div class="journey-artwork" style="background:#1A1A18;background-image:repeating-linear-gradient(0deg,rgba(197,169,122,0.08) 0,rgba(197,169,122,0.08) 1px,transparent 1px,transparent 16px),repeating-linear-gradient(90deg,rgba(197,169,122,0.08) 0,rgba(197,169,122,0.08) 1px,transparent 1px,transparent 16px);">
              <span class="artwork-year">2019</span>
              <div class="artwork-icon">
                <svg width="32" height="32" viewBox="0 0 48 48" fill="none"><path d="M14 4 C11 14 17 22 14 32 C11 40 14 44 14 44" stroke="#C5A97A" stroke-width="1.5"/><path d="M24 4 C21 14 27 22 24 32 C21 40 24 44 24 44" stroke="#C5A97A" stroke-width="1.5"/><path d="M34 4 C31 14 37 22 34 32 C31 40 34 44 34 44" stroke="#C5A97A" stroke-width="1.5"/><path d="M4 14 C12 11 20 17 28 14 C36 11 44 14 44 14" stroke="#C5A97A" stroke-width="1" opacity="0.65"/><path d="M4 24 C12 21 20 27 28 24 C36 21 44 24 44 24" stroke="#C5A97A" stroke-width="1" opacity="0.65"/><path d="M4 34 C12 31 20 37 28 34 C36 31 44 34 44 34" stroke="#C5A97A" stroke-width="1" opacity="0.65"/></svg>
              </div>
              <span class="artwork-label">100% Cotton · 2019</span>
            </div>
          </div>

          <!-- 2022 — We Blended Well (artwork left) -->
          <div class="journey-row gsap-timeline-item">
            <div class="journey-artwork" style="background:#1A2B1C;background-image:repeating-linear-gradient(135deg,rgba(197,169,122,0.07) 0,rgba(197,169,122,0.07) 1px,transparent 1px,transparent 14px);">
              <span class="artwork-year">2022</span>
              <div class="artwork-icon">
                <svg width="32" height="32" viewBox="0 0 48 48" fill="none"><path d="M24 24 Q18 14 10 10 Q12 20 24 24" stroke="#C5A97A" stroke-width="1" fill="rgba(197,169,122,0.12)"/><path d="M24 24 Q38 16 40 8 Q30 10 24 24" stroke="#C5A97A" stroke-width="1" fill="rgba(197,169,122,0.12)"/><path d="M24 24 Q20 36 22 44 Q28 40 24 24" stroke="#C5A97A" stroke-width="1" fill="rgba(197,169,122,0.1)"/><circle cx="24" cy="24" r="3" fill="#C5A97A" opacity="0.7"/></svg>
              </div>
              <span class="artwork-label">Tencel · Modal · 2022</span>
            </div>
            <div class="journey-content">
              <span class="milestone-year">2022</span>
              <h4 class="font-display font-medium mb-2" style="font-size:clamp(1rem,1.6vw,1.2rem);">We Blended Well!</h4>
              <p class="text-ntc-slate text-sm" style="line-height:1.85;">Napoleon's portfolio expands into sustainable luxury-touch fibres. Tencel delivers exceptional drape and moisture management. Modal adds silk-like softness. Organic Cotton satisfies the ethical sourcing requirements of global premium buyers.</p>
              <span style="font-size:8px;font-weight:700;letter-spacing:0.18em;text-transform:uppercase;color:rgba(197,169,122,0.6);display:inline-block;margin-top:12px;">Tencel · Modal · Organic Cotton</span>
            </div>
          </div>

          <!-- 2023 — The Fine Line (artwork right) -->
          <div class="journey-row journey-row-flip gsap-timeline-item">
            <div class="journey-content">
              <span class="milestone-year">2023</span>
              <h4 class="font-display font-medium mb-2" style="font-size:clamp(1rem,1.6vw,1.2rem);">The Fine Line</h4>
              <p class="text-ntc-slate text-sm" style="line-height:1.85;">Premium shirt labels call for finer, more luxurious fabric. Napoleon begins developing 2-ply constructions — 2/80s and 2/100s — with softer hand, higher lustre, and elevated character. Each metre a statement of craft.</p>
              <span style="font-size:8px;font-weight:700;letter-spacing:0.18em;text-transform:uppercase;color:rgba(197,169,122,0.6);display:inline-block;margin-top:12px;">2/80s · 2/100s · Fine 2-Ply Counts</span>
            </div>
            <div class="journey-artwork" style="background:#221E14;background-image:repeating-linear-gradient(180deg,rgba(197,169,122,0.12) 0,rgba(197,169,122,0.12) 1px,transparent 1px,transparent 8px);">
              <span class="artwork-year">2023</span>
              <div class="artwork-icon">
                <svg width="32" height="32" viewBox="0 0 48 48" fill="none"><path d="M8 12 C16 8 24 16 32 12 C40 8 46 14 46 14" stroke="#C5A97A" stroke-width="1.5"/><path d="M8 20 C16 16 24 24 32 20 C40 16 46 22 46 22" stroke="#C5A97A" stroke-width="1.5" opacity="0.65"/><path d="M8 28 C16 24 24 32 32 28 C40 24 46 30 46 30" stroke="#C5A97A" stroke-width="1.5"/><path d="M8 36 C16 32 24 40 32 36 C40 32 46 38 46 38" stroke="#C5A97A" stroke-width="1.5" opacity="0.65"/><circle cx="10" cy="8" r="6" stroke="#C5A97A" stroke-width="0.8"/><text x="10" y="11" text-anchor="middle" fill="#C5A97A" font-size="6" font-family="serif">2×</text></svg>
              </div>
              <span class="artwork-label">Fine 2-Ply · 2023</span>
            </div>
          </div>

          <!-- Today — Still Developing (artwork left) -->
          <div class="journey-row gsap-timeline-item" style="border-bottom:1px solid rgba(26,26,24,0.08);">
            <div class="journey-artwork" style="background:#1A1A18;background-image:radial-gradient(circle,rgba(197,169,122,0.22) 1.5px,transparent 1.5px);background-size:26px 26px;">
              <span class="artwork-year" style="font-size:clamp(2.5rem,5vw,4rem);">Today</span>
              <div class="artwork-icon" style="border-color:rgba(197,169,122,0.5);background:rgba(197,169,122,0.08);">
                <svg width="32" height="32" viewBox="0 0 48 48" fill="none"><circle cx="24" cy="24" r="16" stroke="#C5A97A" stroke-width="1"/><ellipse cx="24" cy="24" rx="7" ry="16" stroke="#C5A97A" stroke-width="0.6" opacity="0.45"/><line x1="8" y1="24" x2="40" y2="24" stroke="#C5A97A" stroke-width="0.6" opacity="0.45"/><path d="M9 16 Q24 13 39 16" stroke="#C5A97A" stroke-width="0.5" opacity="0.4"/><path d="M9 32 Q24 35 39 32" stroke="#C5A97A" stroke-width="0.5" opacity="0.4"/><circle cx="30" cy="16" r="2" fill="#C5A97A"/><circle cx="18" cy="20" r="2" fill="#C5A97A"/><circle cx="32" cy="28" r="2" fill="#C5A97A"/><circle cx="20" cy="30" r="2" fill="#C5A97A"/></svg>
              </div>
              <span class="artwork-label">12 Countries · Today</span>
            </div>
            <div class="journey-content">
              <span class="milestone-year">Today</span>
              <h4 class="font-display font-medium mb-2" style="font-size:clamp(1rem,1.6vw,1.2rem);">Still Developing. Still Growing.</h4>
              <p class="text-ntc-slate text-sm" style="line-height:1.85;">Thirty years on, the original mission holds. Every season brings 500+ new developments conceived before market demand arrives. 3.5 million+ metres shipped annually. 12 export countries across Asia, the Middle East, Africa and beyond.</p>
              <span style="font-size:8px;font-weight:700;letter-spacing:0.18em;text-transform:uppercase;color:rgba(197,169,122,0.6);display:inline-block;margin-top:12px;">500+ Developments/Season · 3.5M+ Metres · 12 Countries</span>
            </div>
          </div>

        </div>
      </div>
    </div>
  </section>


  <!-- ══════════════════════════════════════════
       EXPORT MAP
  ══════════════════════════════════════════ -->
  <section id="exports" class="py-14 lg:py-20 bg-ntc-obsidian">
    <div class="max-w-screen-xl mx-auto px-6 lg:px-12">

      <div class="flex flex-col lg:flex-row lg:items-end justify-between mb-12 gap-6">
        <div class="gsap-reveal">
          <p class="eyebrow text-ntc-champagne mb-4">Global Presence</p>
          <h2 class="display-lg text-ntc-ivory">Fabric That<br /><em style="color:#C5A97A;">Travels the World</em></h2>
        </div>
        <p class="eyebrow text-ntc-ivory/30 gsap-reveal">12 Export Destinations</p>
      </div>

      <!-- SVG World Map — dotted grid, D3 Mercator (Natural Earth 110m) -->
      <div class="gsap-reveal" style="overflow:hidden;">
        <svg id="world-map-svg" viewBox="0 0 960 500" xmlns="http://www.w3.org/2000/svg"
             style="width:100%;display:block;background:#0E0E0C;">
          <defs>
            <!-- Land dot grid — small, dense, uniform squares (pixel-map style) -->
            <pattern id="dotGrid" width="5.5" height="5.5" patternUnits="userSpaceOnUse">
              <rect x="0.8" y="0.8" width="3.5" height="3.5" rx="0.7" ry="0.7" fill="#C5A97A" opacity="0.85"/>
            </pattern>
            <!-- Ocean dot grid — very faint -->
            <pattern id="oceanGrid" width="5.5" height="5.5" patternUnits="userSpaceOnUse">
              <rect x="0.8" y="0.8" width="3.5" height="3.5" rx="0.7" ry="0.7" fill="#C5A97A" opacity="0.07"/>
            </pattern>
            <filter id="glow" x="-50%" y="-50%" width="200%" height="200%">
              <feGaussianBlur stdDeviation="3" result="blur"/>
              <feMerge><feMergeNode in="blur"/><feMergeNode in="SourceGraphic"/></feMerge>
            </filter>
            <!-- D3 + Natural Earth fills this clipPath with accurate land geometry -->
            <clipPath id="landClip"></clipPath>
          </defs>

          <!-- Ocean background dots (very faint) -->
          <rect width="960" height="500" fill="url(#oceanGrid)"/>
          <!-- Land dots — clipped to accurate land geometry via D3 -->
          <rect width="960" height="500" fill="url(#dotGrid)" clip-path="url(#landClip)"/>

          <!-- D3 renders arcs, dots, labels into these groups -->
          <g id="map-arcs"></g>
          <g id="map-dots"></g>

        </svg>
      </div>

      <!-- Country list -->
      <div class="mt-10 flex flex-wrap gap-2 gsap-reveal">
        <span class="eyebrow text-ntc-ivory/30 mr-2" style="font-size:8px;">Exporting to:</span>
        <span class="eyebrow text-ntc-champagne/70" style="font-size:8px;">Sri Lanka</span>
        <span class="eyebrow text-ntc-ivory/20" style="font-size:8px;">·</span>
        <span class="eyebrow text-ntc-champagne/70" style="font-size:8px;">Indonesia</span>
        <span class="eyebrow text-ntc-ivory/20" style="font-size:8px;">·</span>
        <span class="eyebrow text-ntc-champagne/70" style="font-size:8px;">Thailand</span>
        <span class="eyebrow text-ntc-ivory/20" style="font-size:8px;">·</span>
        <span class="eyebrow text-ntc-champagne/70" style="font-size:8px;">UAE</span>
        <span class="eyebrow text-ntc-ivory/20" style="font-size:8px;">·</span>
        <span class="eyebrow text-ntc-champagne/70" style="font-size:8px;">South Africa</span>
        <span class="eyebrow text-ntc-ivory/20" style="font-size:8px;">·</span>
        <span class="eyebrow text-ntc-champagne/70" style="font-size:8px;">Singapore</span>
        <span class="eyebrow text-ntc-ivory/20" style="font-size:8px;">·</span>
        <span class="eyebrow text-ntc-champagne/70" style="font-size:8px;">Colombia</span>
        <span class="eyebrow text-ntc-ivory/20" style="font-size:8px;">·</span>
        <span class="eyebrow text-ntc-champagne/70" style="font-size:8px;">Kuwait</span>
        <span class="eyebrow text-ntc-ivory/20" style="font-size:8px;">·</span>
        <span class="eyebrow text-ntc-champagne/70" style="font-size:8px;">Mexico</span>
        <span class="eyebrow text-ntc-ivory/20" style="font-size:8px;">·</span>
        <span class="eyebrow text-ntc-champagne/70" style="font-size:8px;">Iran</span>
        <span class="eyebrow text-ntc-ivory/20" style="font-size:8px;">·</span>
        <span class="eyebrow text-ntc-champagne/70" style="font-size:8px;">Bangladesh</span>
        <span class="eyebrow text-ntc-ivory/20" style="font-size:8px;">·</span>
        <span class="eyebrow text-ntc-champagne/70" style="font-size:8px;">Hong Kong</span>
      </div>

    </div>
  </section>


  <!-- ══════════════════════════════════════════
       TESTIMONIALS — auto-moving carousel
  ══════════════════════════════════════════ -->
  <section class="pt-14 lg:pt-20 pb-0 bg-ivory overflow-hidden">
    <!-- Heading — constrained -->
    <div class="max-w-screen-xl mx-auto px-6 lg:px-12 mb-10 gsap-reveal text-center">
      <p class="eyebrow text-ntc-slate mb-3">What Our Partners Say</p>
      <h2 class="display-md">Chosen by those who<br /><em>know what fabric should be</em></h2>
    </div>

    <!-- Full-bleed auto-scroll strip — no user interaction -->
    <div style="position:relative;overflow:hidden;">
      <!-- padding gives a little height buffer above/below cards -->
      <div style="padding:10px 0 0;overflow:hidden;">
        <!-- Double the set for seamless loop (translateX(-50%) in keyframes) -->
        <div class="testimonial-track">

          <!-- Card A1 -->
          <div class="testimonial-card">
            <div style="margin-bottom:20px;padding-bottom:16px;border-bottom:1px solid rgba(26,26,24,0.1);display:flex;align-items:center;gap:12px;">
              <img src="BRAND_ASSETS/napoleon logo-2.png" alt="" style="height:22px;width:auto;opacity:0.18;filter:saturate(0);" />
              <p style="font-size:10px;font-weight:700;letter-spacing:0.2em;text-transform:uppercase;color:rgba(26,26,24,0.35);">Bombay Shirt Co.</p>
            </div>
            <p style="font-size:13.5px;font-style:italic;line-height:1.85;color:#1A1A18;margin-bottom:20px;">"Napoleon fabrics consistently deliver on colour accuracy and shrinkage control. Our production team trusts them implicitly — defect rates under 0.2%."</p>
            <div style="height:1px;background:rgba(26,26,24,0.1);margin-bottom:14px;"></div>
            <p style="font-size:12px;font-weight:500;color:#1A1A18;">Rajiv Mehta</p>
            <p style="font-size:9px;font-weight:600;letter-spacing:0.18em;text-transform:uppercase;color:#4A4E5A;margin-top:4px;">Head of Sourcing</p>
          </div>

          <!-- Card A2 -->
          <div class="testimonial-card">
            <div style="margin-bottom:20px;padding-bottom:16px;border-bottom:1px solid rgba(26,26,24,0.1);display:flex;align-items:center;gap:12px;">
              <img src="BRAND_ASSETS/napoleon logo-2.png" alt="" style="height:22px;width:auto;opacity:0.18;filter:saturate(0);" />
              <p style="font-size:10px;font-weight:700;letter-spacing:0.2em;text-transform:uppercase;color:rgba(26,26,24,0.35);">Prestige Menswear</p>
            </div>
            <p style="font-size:13.5px;font-style:italic;line-height:1.85;color:#1A1A18;margin-bottom:20px;">"The Dobby Jacquard range is extraordinary. Our label shirts made from NTC fabric outsell every other SKU. The handle and drape speak for themselves."</p>
            <div style="height:1px;background:rgba(26,26,24,0.1);margin-bottom:14px;"></div>
            <p style="font-size:12px;font-weight:500;color:#1A1A18;">Priya Sharma</p>
            <p style="font-size:9px;font-weight:600;letter-spacing:0.18em;text-transform:uppercase;color:#4A4E5A;margin-top:4px;">Creative Director</p>
          </div>

          <!-- Card A3 -->
          <div class="testimonial-card">
            <div style="margin-bottom:20px;padding-bottom:16px;border-bottom:1px solid rgba(26,26,24,0.1);display:flex;align-items:center;gap:12px;">
              <img src="BRAND_ASSETS/napoleon logo-2.png" alt="" style="height:22px;width:auto;opacity:0.18;filter:saturate(0);" />
              <p style="font-size:10px;font-weight:700;letter-spacing:0.2em;text-transform:uppercase;color:rgba(26,26,24,0.35);">Elegance Apparels</p>
            </div>
            <p style="font-size:13.5px;font-style:italic;line-height:1.85;color:#1A1A18;margin-bottom:20px;">"In 8 years of working with NTC, I've never had a late shipment. Their logistics and communication set the benchmark for the industry."</p>
            <div style="height:1px;background:rgba(26,26,24,0.1);margin-bottom:14px;"></div>
            <p style="font-size:12px;font-weight:500;color:#1A1A18;">Anil Kapoor</p>
            <p style="font-size:9px;font-weight:600;letter-spacing:0.18em;text-transform:uppercase;color:#4A4E5A;margin-top:4px;">Chief Executive Officer</p>
          </div>

          <!-- Card A4 -->
          <div class="testimonial-card">
            <div style="margin-bottom:20px;padding-bottom:16px;border-bottom:1px solid rgba(26,26,24,0.1);display:flex;align-items:center;gap:12px;">
              <img src="BRAND_ASSETS/napoleon logo-2.png" alt="" style="height:22px;width:auto;opacity:0.18;filter:saturate(0);" />
              <p style="font-size:10px;font-weight:700;letter-spacing:0.2em;text-transform:uppercase;color:rgba(26,26,24,0.35);">Heritage Fabric House</p>
            </div>
            <p style="font-size:13.5px;font-style:italic;line-height:1.85;color:#1A1A18;margin-bottom:20px;">"The Giza blend range opened a new price tier for us — clients immediately notice the lustre and hand feel. NTC's consistency batch-to-batch is unmatched."</p>
            <div style="height:1px;background:rgba(26,26,24,0.1);margin-bottom:14px;"></div>
            <p style="font-size:12px;font-weight:500;color:#1A1A18;">Omar Al-Farouq</p>
            <p style="font-size:9px;font-weight:600;letter-spacing:0.18em;text-transform:uppercase;color:#4A4E5A;margin-top:4px;">Director of Procurement, UAE</p>
          </div>

          <!-- Duplicate set B (identical) for seamless loop -->
          <div class="testimonial-card">
            <div style="margin-bottom:20px;padding-bottom:16px;border-bottom:1px solid rgba(26,26,24,0.1);display:flex;align-items:center;gap:12px;">
              <img src="BRAND_ASSETS/napoleon logo-2.png" alt="" style="height:22px;width:auto;opacity:0.18;filter:saturate(0);" />
              <p style="font-size:10px;font-weight:700;letter-spacing:0.2em;text-transform:uppercase;color:rgba(26,26,24,0.35);">Bombay Shirt Co.</p>
            </div>
            <p style="font-size:13.5px;font-style:italic;line-height:1.85;color:#1A1A18;margin-bottom:20px;">"Napoleon fabrics consistently deliver on colour accuracy and shrinkage control. Our production team trusts them implicitly — defect rates under 0.2%."</p>
            <div style="height:1px;background:rgba(26,26,24,0.1);margin-bottom:14px;"></div>
            <p style="font-size:12px;font-weight:500;color:#1A1A18;">Rajiv Mehta</p>
            <p style="font-size:9px;font-weight:600;letter-spacing:0.18em;text-transform:uppercase;color:#4A4E5A;margin-top:4px;">Head of Sourcing</p>
          </div>

          <div class="testimonial-card">
            <div style="margin-bottom:20px;padding-bottom:16px;border-bottom:1px solid rgba(26,26,24,0.1);display:flex;align-items:center;gap:12px;">
              <img src="BRAND_ASSETS/napoleon logo-2.png" alt="" style="height:22px;width:auto;opacity:0.18;filter:saturate(0);" />
              <p style="font-size:10px;font-weight:700;letter-spacing:0.2em;text-transform:uppercase;color:rgba(26,26,24,0.35);">Prestige Menswear</p>
            </div>
            <p style="font-size:13.5px;font-style:italic;line-height:1.85;color:#1A1A18;margin-bottom:20px;">"The Dobby Jacquard range is extraordinary. Our label shirts made from NTC fabric outsell every other SKU. The handle and drape speak for themselves."</p>
            <div style="height:1px;background:rgba(26,26,24,0.1);margin-bottom:14px;"></div>
            <p style="font-size:12px;font-weight:500;color:#1A1A18;">Priya Sharma</p>
            <p style="font-size:9px;font-weight:600;letter-spacing:0.18em;text-transform:uppercase;color:#4A4E5A;margin-top:4px;">Creative Director</p>
          </div>

          <div class="testimonial-card">
            <div style="margin-bottom:20px;padding-bottom:16px;border-bottom:1px solid rgba(26,26,24,0.1);display:flex;align-items:center;gap:12px;">
              <img src="BRAND_ASSETS/napoleon logo-2.png" alt="" style="height:22px;width:auto;opacity:0.18;filter:saturate(0);" />
              <p style="font-size:10px;font-weight:700;letter-spacing:0.2em;text-transform:uppercase;color:rgba(26,26,24,0.35);">Elegance Apparels</p>
            </div>
            <p style="font-size:13.5px;font-style:italic;line-height:1.85;color:#1A1A18;margin-bottom:20px;">"In 8 years of working with NTC, I've never had a late shipment. Their logistics and communication set the benchmark for the industry."</p>
            <div style="height:1px;background:rgba(26,26,24,0.1);margin-bottom:14px;"></div>
            <p style="font-size:12px;font-weight:500;color:#1A1A18;">Anil Kapoor</p>
            <p style="font-size:9px;font-weight:600;letter-spacing:0.18em;text-transform:uppercase;color:#4A4E5A;margin-top:4px;">Chief Executive Officer</p>
          </div>

          <div class="testimonial-card">
            <div style="margin-bottom:20px;padding-bottom:16px;border-bottom:1px solid rgba(26,26,24,0.1);display:flex;align-items:center;gap:12px;">
              <img src="BRAND_ASSETS/napoleon logo-2.png" alt="" style="height:22px;width:auto;opacity:0.18;filter:saturate(0);" />
              <p style="font-size:10px;font-weight:700;letter-spacing:0.2em;text-transform:uppercase;color:rgba(26,26,24,0.35);">Heritage Fabric House</p>
            </div>
            <p style="font-size:13.5px;font-style:italic;line-height:1.85;color:#1A1A18;margin-bottom:20px;">"The Giza blend range opened a new price tier for us — clients immediately notice the lustre and hand feel. NTC's consistency batch-to-batch is unmatched."</p>
            <div style="height:1px;background:rgba(26,26,24,0.1);margin-bottom:14px;"></div>
            <p style="font-size:12px;font-weight:500;color:#1A1A18;">Omar Al-Farouq</p>
            <p style="font-size:9px;font-weight:600;letter-spacing:0.18em;text-transform:uppercase;color:#4A4E5A;margin-top:4px;">Director of Procurement, UAE</p>
          </div>

        </div><!-- /testimonial-track -->
      </div>
      <!-- Shadow falling below the strip -->
      <div style="height:40px;background:linear-gradient(to bottom,rgba(26,26,24,0.07),transparent);pointer-events:none;"></div>
    </div>
  </section>


  <!-- ══════════════════════════════════════════
       HOW WE WORK — Minimalist numbered list
  ══════════════════════════════════════════ -->
  <section id="craft" style="background:#1A1A18;">

    <!-- Section header -->
    <div class="max-w-screen-xl mx-auto px-6 lg:px-12 pt-14 lg:pt-20 pb-10 lg:pb-14">
      <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-8">
        <div>
          <p class="eyebrow text-ntc-champagne mb-4 gsap-reveal">Our Craft</p>
          <h2 class="display-lg text-ntc-ivory gsap-reveal">How We Work</h2>
        </div>
        <p class="eyebrow text-ntc-ivory/30 gsap-reveal" style="max-width:300px;line-height:2;">
          Seven steps, each deliberate. From trend intelligence to finished fabric — the same rigour, every season.
        </p>
      </div>
    </div>

    <!-- Numbered steps -->
    <div class="max-w-screen-xl mx-auto px-6 lg:px-12 pb-14 lg:pb-20">

      <div class="craft-step craft-anim">
        <span class="step-thread" aria-hidden="true"></span>
        <span class="craft-step-num">01</span>
        <div>
          <p class="craft-step-label">Research</p>
          <p class="craft-step-title">Research New Bases</p>
          <p class="craft-step-desc lg:hidden">Every season begins with research — global runway trends, buyer feedback, and fibre market intelligence combine to identify the next generation of base fabrics.</p>
        </div>
        <p class="craft-step-desc hidden lg:block">Every season begins with research — global runway trends, buyer feedback, and fibre market intelligence combine to identify the next generation of base fabrics.</p>
        <div class="craft-step-photo">
          <img src="BRAND_ASSETS/HWW01.jpg" alt="Research" loading="lazy" decoding="async" style="width:100%;height:100%;object-fit:cover;object-position:center center;" />
        </div>
      </div>
      <div class="craft-step-photo-mobile">
        <img src="BRAND_ASSETS/HWW01.jpg" alt="Research" loading="lazy" decoding="async" style="width:100%;height:100%;object-fit:cover;object-position:center center;" />
      </div>

      <div class="craft-step craft-anim">
        <span class="step-thread" aria-hidden="true"></span>
        <span class="craft-step-num">02</span>
        <div>
          <p class="craft-step-label">Concept</p>
          <p class="craft-step-title">Curating Mood Boards</p>
          <p class="craft-step-desc lg:hidden">Colour, texture, weight, and pattern are assembled into seasonal mood boards before any fabric is made. The collection has a point of view first.</p>
        </div>
        <p class="craft-step-desc hidden lg:block">Colour, texture, weight, and pattern are assembled into seasonal mood boards before any fabric is made. The collection has a point of view first.</p>
        <div class="craft-step-photo">
          <img src="BRAND_ASSETS/HWW02.jpg" alt="Mood Boards" loading="lazy" decoding="async" style="width:100%;height:100%;object-fit:cover;object-position:center center;" />
        </div>
      </div>
      <div class="craft-step-photo-mobile">
        <img src="BRAND_ASSETS/HWW02.jpg" alt="Mood Boards" loading="lazy" decoding="async" style="width:100%;height:100%;object-fit:cover;object-position:center center;" />
      </div>

      <div class="craft-step craft-anim">
        <span class="step-thread" aria-hidden="true"></span>
        <span class="craft-step-num">03</span>
        <div>
          <p class="craft-step-label">Materials</p>
          <p class="craft-step-title">Quality Yarn Sourcing</p>
          <p class="craft-step-desc lg:hidden">Indian cotton forms the core of most of our sourcing — selected for its clean spinning characteristics and fine staple. We also work with Australian cotton for superior softness, and bring in select Egyptian cotton blends where the construction calls for it. The right fibre is chosen per fabric, not per formula.</p>
        </div>
        <p class="craft-step-desc hidden lg:block">Indian cotton forms the core of most of our sourcing — selected for its clean spinning characteristics and fine staple. We also work with Australian cotton for superior softness, and bring in select Egyptian cotton blends where the construction calls for it. The right fibre is chosen per fabric, not per formula.</p>
        <div class="craft-step-photo">
          <img src="BRAND_ASSETS/HWW03.jpg" alt="Yarn Sourcing" loading="lazy" decoding="async" style="width:100%;height:100%;object-fit:cover;object-position:center center;" />
        </div>
      </div>
      <div class="craft-step-photo-mobile">
        <img src="BRAND_ASSETS/HWW03.jpg" alt="Yarn Sourcing" loading="lazy" decoding="async" style="width:100%;height:100%;object-fit:cover;object-position:center center;" />
      </div>

      <div class="craft-step craft-anim">
        <span class="step-thread" aria-hidden="true"></span>
        <span class="craft-step-num">04</span>
        <div>
          <p class="craft-step-label">Weaving</p>
          <p class="craft-step-title">Mill Partnership</p>
          <p class="craft-step-desc lg:hidden">We work with established weaving mills, providing precise specifications for every fabric — thread count, weave structure, yarn count, and construction. Our merchandising team liaises directly with mill partners to ensure each production run is executed to our design intent, metre by metre.</p>
        </div>
        <p class="craft-step-desc hidden lg:block">We work with established weaving mills, providing precise specifications for every fabric — thread count, weave structure, yarn count, and construction. Our merchandising team liaises directly with mill partners to ensure each production run is executed to our design intent, metre by metre.</p>
        <div class="craft-step-photo">
          <img src="https://placehold.co/440x280/1A1A18/C5A97A?text=Weaving" alt="Weaving" loading="lazy" decoding="async" />
        </div>
      </div>
      <div class="craft-step-photo-mobile">
        <img src="https://placehold.co/800x360/1A1A18/C5A97A?text=Weaving" alt="Weaving" loading="lazy" decoding="async" />
      </div>

      <div class="craft-step craft-anim">
        <span class="step-thread" aria-hidden="true"></span>
        <span class="craft-step-num">05</span>
        <div>
          <p class="craft-step-label">Processing</p>
          <p class="craft-step-title">Dyeing &amp; Finishing</p>
          <p class="craft-step-desc lg:hidden">Dyeing, mercerisation, sanforising, and finishing are carried out by trusted processing partners working to our written specifications. Our team oversees colour standards, shrinkage parameters, and finish requirements — validating each lot before it is cleared for the next stage.</p>
        </div>
        <p class="craft-step-desc hidden lg:block">Dyeing, mercerisation, sanforising, and finishing are carried out by trusted processing partners working to our written specifications. Our team oversees colour standards, shrinkage parameters, and finish requirements — validating each lot before it is cleared for the next stage.</p>
        <div class="craft-step-photo">
          <img src="https://placehold.co/440x280/1A1A18/C5A97A?text=Processing" alt="Processing" loading="lazy" decoding="async" />
        </div>
      </div>
      <div class="craft-step-photo-mobile">
        <img src="https://placehold.co/800x360/1A1A18/C5A97A?text=Processing" alt="Processing" loading="lazy" decoding="async" />
      </div>

      <div class="craft-step craft-anim">
        <span class="step-thread" aria-hidden="true"></span>
        <span class="craft-step-num">06</span>
        <div>
          <p class="craft-step-label">Quality</p>
          <p class="craft-step-title">In-House Inspection</p>
          <p class="craft-step-desc lg:hidden">Every roll is physically inspected by our in-house quality team using dedicated checking machines. We apply the 4-Point System across every piece — only fabric that clears our standard is passed for packing and dispatch. Defect rates held below 0.2%.</p>
        </div>
        <p class="craft-step-desc hidden lg:block">Every roll is physically inspected by our in-house quality team using dedicated checking machines. We apply the 4-Point System across every piece — only fabric that clears our standard is passed for packing and dispatch. Defect rates held below 0.2%.</p>
        <div class="craft-step-photo">
          <img src="https://placehold.co/440x280/1A1A18/C5A97A?text=Quality+Check" alt="Quality Assurance" loading="lazy" decoding="async" />
        </div>
      </div>
      <div class="craft-step-photo-mobile">
        <img src="https://placehold.co/800x360/1A1A18/C5A97A?text=Quality+Check" alt="Quality Assurance" loading="lazy" decoding="async" />
      </div>

      <div class="craft-step craft-anim" style="border-bottom:1px solid rgba(197,169,122,0.14);">
        <span class="step-thread" aria-hidden="true"></span>
        <span class="craft-step-num">07</span>
        <div>
          <p class="craft-step-label">Intelligence</p>
          <p class="craft-step-title">Season Data Compilation</p>
          <p class="craft-step-desc lg:hidden">Every order, defect, and buyer response is catalogued. This intelligence feeds directly back into next season's design brief — a continuous loop of refinement.</p>
        </div>
        <p class="craft-step-desc hidden lg:block">Every order, defect, and buyer response is catalogued. This intelligence feeds directly back into next season's design brief — a continuous loop of refinement.</p>
        <div class="craft-step-photo">
          <img src="https://placehold.co/440x280/1A1A18/C5A97A?text=Data+%26+Insights" alt="Season Data" loading="lazy" decoding="async" />
        </div>
      </div>
      <div class="craft-step-photo-mobile" style="border-bottom:1px solid rgba(197,169,122,0.14);">
        <img src="https://placehold.co/800x360/1A1A18/C5A97A?text=Data+%26+Insights" alt="Season Data" loading="lazy" decoding="async" />
      </div>

    </div>
  </section>


  <!-- ══════════════════════════════════════════
       CONTACT
  ══════════════════════════════════════════ -->
  <section id="contact" class="py-14 lg:py-20 bg-ntc-obsidian">
    <div class="max-w-screen-xl mx-auto px-6 lg:px-12">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">

        <div class="gsap-reveal">
          <p class="eyebrow text-ntc-champagne mb-4">Get in Touch</p>
          <h2 class="display-lg text-ntc-ivory mb-8">Let's Begin<br /><em>a Conversation</em></h2>
          <p class="text-ntc-ivory/45 leading-relaxed mb-12" class="body-copy" style="max-width:380px;">
            Whether you represent a fashion label, a private label, or distribute to retailers — we would be glad to be your fabric partner. Reach us for samples, seasonal collections, or a quiet conversation about what you need.
          </p>
          <div class="space-y-7">
            <div>
              <p class="eyebrow text-ntc-slate mb-1">Address</p>
              <a href="https://maps.app.goo.gl/9rN7oxZmVTcei7Fg8" target="_blank" rel="noopener noreferrer"
                 class="text-ntc-ivory/70 text-sm leading-relaxed block hover:text-ntc-champagne"
                 style="transition:color 0.2s ease;text-decoration:none;"
                 onmouseover="this.style.color='#C5A97A'" onmouseout="this.style.color='rgba(244,241,234,0.7)'">
                Napoleon Textile Company<br />
                Avior Corporate Park, LBS Marg<br />
                Mulund West, Mumbai — 400080<br />
                Maharashtra, India
              </a>
            </div>
            <div>
              <p class="eyebrow text-ntc-slate mb-1">Email</p>
              <a href="mailto:milind@napoleontextilecompany.com" class="text-ntc-ivory/70 text-sm"
                 style="text-decoration:none;transition:color 0.2s ease;"
                 onmouseover="this.style.color='#C5A97A'" onmouseout="this.style.color='rgba(244,241,234,0.7)'">milind@napoleontextilecompany.com</a>
            </div>
            <div>
              <p class="eyebrow text-ntc-slate mb-1">Business Hours</p>
              <p class="text-ntc-ivory/70 text-sm">Monday – Saturday &nbsp;·&nbsp; 10:00 AM – 7:00 PM IST</p>
              <div id="office-status" class="flex items-center gap-2 mt-2" style="display:none!important;">
                <span id="office-status-dot" style="width:7px;height:7px;border-radius:50%;flex-shrink:0;display:inline-block;"></span>
                <span id="office-status-text" class="text-sm" style="font-family:'Bodoni Moda',serif;font-weight:400;"></span>
              </div>
            </div>
          </div>
        </div>

        <div class="gsap-reveal">
          <form class="space-y-5" onsubmit="handleSubmit(event)">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
              <div>
                <label class="eyebrow text-ntc-ivory/30 block mb-2" for="name">Full Name</label>
                <input id="name" type="text" placeholder="Your name" required
                  class="w-full bg-white/5 border text-ntc-ivory placeholder-ntc-ivory/20 px-4 py-3.5 text-sm focus:outline-none focus:border-ntc-champagne"
                  style="border-color:rgba(244,241,234,0.12);font-family:'Bodoni Moda',serif;font-weight:400;transition:border-color 0.2s ease;"/>
              </div>
              <div>
                <label class="eyebrow text-ntc-ivory/30 block mb-2" for="company">Company</label>
                <input id="company" type="text" placeholder="Your company"
                  class="w-full bg-white/5 border text-ntc-ivory placeholder-ntc-ivory/20 px-4 py-3.5 text-sm focus:outline-none focus:border-ntc-champagne"
                  style="border-color:rgba(244,241,234,0.12);font-family:'Bodoni Moda',serif;font-weight:400;transition:border-color 0.2s ease;"/>
              </div>
            </div>
            <div>
              <label class="eyebrow text-ntc-ivory/30 block mb-2" for="email">Email Address</label>
              <input id="email" type="email" placeholder="your@email.com" required
                class="w-full bg-white/5 border text-ntc-ivory placeholder-ntc-ivory/20 px-4 py-3.5 text-sm focus:outline-none focus:border-ntc-champagne"
                style="border-color:rgba(244,241,234,0.12);font-family:'Bodoni Moda',serif;font-weight:400;transition:border-color 0.2s ease;"/>
            </div>
            <div>
              <label class="eyebrow text-ntc-ivory/30 block mb-2" for="interest">Fabric Category</label>
              <select id="interest"
                class="w-full bg-ntc-obsidian border text-ntc-ivory/60 px-4 py-3.5 text-sm focus:outline-none focus:border-ntc-champagne appearance-none cursor-pointer"
                style="border-color:rgba(244,241,234,0.12);font-family:'Bodoni Moda',serif;font-weight:400;transition:border-color 0.2s ease;background-image:url(\"data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='6'%3E%3Cpath d='M0 0l5 6 5-6z' fill='%23C5A97A'/%3E%3C/svg%3E\");background-repeat:no-repeat;background-position:right 16px center;">
                <option value="" class="bg-ntc-obsidian">Select category…</option>
                <option class="bg-ntc-obsidian">Boardroom Formal</option>
                <option class="bg-ntc-obsidian">Smart Casual</option>
                <option class="bg-ntc-obsidian">Evening & Occasion</option>
                <option class="bg-ntc-obsidian">Checks & Windowpanes</option>
                <option class="bg-ntc-obsidian">Stripes & Pinstripes</option>
                <option class="bg-ntc-obsidian">Dobbies & Jacquards</option>
                <option class="bg-ntc-obsidian">Plains & Solids</option>
                <option class="bg-ntc-obsidian">Uniform &amp; Workwear</option>
                <option class="bg-ntc-obsidian">Travel &amp; Leisure</option>
                <option class="bg-ntc-obsidian">Custom</option>
              </select>
            </div>
            <div>
              <label class="eyebrow text-ntc-ivory/30 block mb-2" for="message">Message</label>
              <textarea id="message" rows="4" placeholder="Tell us about your requirements — volume, end-use, timeline…"
                class="w-full bg-white/5 border text-ntc-ivory placeholder-ntc-ivory/20 px-4 py-3.5 text-sm focus:outline-none focus:border-ntc-champagne resize-none"
                style="border-color:rgba(244,241,234,0.12);font-family:'Bodoni Moda',serif;font-weight:400;transition:border-color 0.2s ease;"></textarea>
            </div>
            <button type="submit" class="btn-primary w-full text-center border-0"
              style="background:#C5A97A;color:#1A1A18;font-weight:500;"
              onmouseover="this.style.background='#D4B87A'" onmouseout="this.style.background='#C5A97A'">
              Send Enquiry
            </button>
            <p id="form-success" class="eyebrow text-ntc-champagne text-center hidden" style="font-size:9px;">
              ✓ Thank you — we will be in touch within 24 hours.
            </p>
          </form>
        </div>

      </div>
    </div>
  </section>


  <!-- ══════════════════════════════════════════
       FOOTER
  ══════════════════════════════════════════ -->
  <footer class="py-12 lg:py-16" style="background:#0E0E0C;">
    <div class="max-w-screen-xl mx-auto px-6 lg:px-12">
      <div class="flex flex-col lg:flex-row justify-between items-start gap-10 mb-10">
        <div class="max-w-xs">
          <img src="BRAND_ASSETS/napoleon logo-2.png" alt="Napoleon Textile Company"
               class="h-14 w-auto mb-4" style="filter:invert(1);opacity:0.7;" />
          <p class="text-ntc-ivory/25 text-xs leading-relaxed" style="font-weight:400;">A Design House in Fabric.<br />Premium Men's Shirting.<br />Mumbai · India · Est. 1995</p>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 gap-x-12 gap-y-4">
          <a href="#collections" style="font-size:10px;font-weight:600;letter-spacing:0.18em;text-transform:uppercase;text-decoration:none;color:rgba(244,241,234,0.35);transition:color 0.2s ease;" onmouseover="this.style.color='rgba(244,241,234,0.7)'" onmouseout="this.style.color='rgba(244,241,234,0.35)'">Collections</a>
          <a href="#heritage"    style="font-size:10px;font-weight:600;letter-spacing:0.18em;text-transform:uppercase;text-decoration:none;color:rgba(244,241,234,0.35);transition:color 0.2s ease;" onmouseover="this.style.color='rgba(244,241,234,0.7)'" onmouseout="this.style.color='rgba(244,241,234,0.35)'">Heritage</a>
          <a href="#craft"       style="font-size:10px;font-weight:600;letter-spacing:0.18em;text-transform:uppercase;text-decoration:none;color:rgba(244,241,234,0.35);transition:color 0.2s ease;" onmouseover="this.style.color='rgba(244,241,234,0.7)'" onmouseout="this.style.color='rgba(244,241,234,0.35)'">Process</a>
          <a href="#exports"     style="font-size:10px;font-weight:600;letter-spacing:0.18em;text-transform:uppercase;text-decoration:none;color:rgba(244,241,234,0.35);transition:color 0.2s ease;" onmouseover="this.style.color='rgba(244,241,234,0.7)'" onmouseout="this.style.color='rgba(244,241,234,0.35)'">Global Reach</a>
          <a href="#contact"     style="font-size:10px;font-weight:600;letter-spacing:0.18em;text-transform:uppercase;text-decoration:none;color:rgba(244,241,234,0.35);transition:color 0.2s ease;" onmouseover="this.style.color='rgba(244,241,234,0.7)'" onmouseout="this.style.color='rgba(244,241,234,0.35)'">Contact</a>
        </div>
      </div>
      <div style="height:1px;background:rgba(244,241,234,0.06);"></div>
      <div class="flex flex-col sm:flex-row justify-between items-center gap-4 mt-7">
        <p class="text-ntc-ivory/18 text-xs" style="font-size:9px;font-weight:400;">© 2024 Napoleon Textile Company. All rights reserved.</p>
        <p class="text-ntc-ivory/18 text-xs" style="font-size:9px;font-weight:400;">Mumbai, Maharashtra, India &nbsp;·&nbsp; Design House · Men's Shirting</p>
      </div>
    </div>
  </footer>


  <!-- ══════════════════════════════════════════
       SCRIPTS
  ══════════════════════════════════════════ -->
  <script>
    // ════════════════════════════════════════
    // COLLECTION VIDEOS — 0.7x speed, same real-time duration as original
    // ════════════════════════════════════════
    document.addEventListener('DOMContentLoaded', function () {
      document.querySelectorAll('.collection-video').forEach(function (video) {
        video.playbackRate = 0.7;
        // Crop at 70% of source duration so real-time loop = original video length
        video.addEventListener('loadedmetadata', function () {
          var cropAt = video.duration * 0.7;
          video.addEventListener('timeupdate', function () {
            if (video.currentTime >= cropAt) {
              video.currentTime = 0;
            }
          });
        });
      });
    });

    // ════════════════════════════════════════
    // LENIS SMOOTH SCROLL
    // ════════════════════════════════════════
    const lenis = new Lenis({
      lerp: 0.1,                // 0.1 = silky momentum (lower = dreamier, higher = snappier)
      smoothWheel: true,
      wheelMultiplier: 1.0,     // 1:1 with native scroll distance
      touchMultiplier: 2.0,
      syncTouch: false,
      infinite: false,
    });

    // Connect Lenis to GSAP ticker — the only correct integration pattern
    gsap.registerPlugin(ScrollTrigger);
    lenis.on('scroll', ScrollTrigger.update);
    gsap.ticker.add((time) => { lenis.raf(time * 1000); });
    gsap.ticker.lagSmoothing(0);

    // Pause CSS pulse animations while scrolling to reduce paint load
    let scrollPauseTimer;
    lenis.on('scroll', () => {
      document.documentElement.classList.add('is-scrolling');
      clearTimeout(scrollPauseTimer);
      scrollPauseTimer = setTimeout(() => {
        document.documentElement.classList.remove('is-scrolling');
      }, 150);
    });

    // Tell ScrollTrigger to use Lenis scroll position
    ScrollTrigger.defaults({ scroller: window });

    // ════════════════════════════════════════
    // NAV: always transparent, text flips via
    // IntersectionObserver watching dark sections
    // ════════════════════════════════════════
    const navbar = document.getElementById('navbar');

    // Sections that are dark-bg (nav text should be light/ivory)
    const darkSections = [
      '.hero-section',
      '#craft',
      '#exports',
      '#contact',
      'footer',
    ];
    // Sections that are light-bg (nav text should be dark/obsidian)
    const lightSections = [
      '#collections',
      '#heritage',
      '.bg-ecru',
      '.py-24.bg-ivory',
    ];

    // Use a thin sentinel div at the top of each section
    const navH = 80;
    const obsOptions = { rootMargin: `-${navH}px 0px -${window.innerHeight - navH - 2}px 0px`, threshold: 0 };

    let currentIsDark = true; // hero is dark
    const obsMap = new Map();

    document.querySelectorAll('section, #collections, footer, .hero-section').forEach(el => {
      const bg = window.getComputedStyle(el).backgroundColor;
      // Parse rgb and check luminance
      const m = bg.match(/\d+/g);
      if (!m) return;
      const [r,g,b] = m.map(Number);
      const lum = (0.299*r + 0.587*g + 0.114*b) / 255;
      const isDark = lum < 0.5;
      obsMap.set(el, isDark);
    });

    const io = new IntersectionObserver(entries => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          const isDark = obsMap.get(entry.target) ?? true;
          navbar.classList.toggle('nav-dark',  isDark);
          navbar.classList.toggle('nav-light', !isDark);
        }
      });
    }, obsOptions);

    obsMap.forEach((_, el) => io.observe(el));

    // ════════════════════════════════════════
    // MOBILE MENU
    // ════════════════════════════════════════
    const menuBtn     = document.getElementById('menu-btn');
    const mobileMenu  = document.getElementById('mobile-menu');
    let menuOpen = false;
    menuBtn.addEventListener('click', () => {
      menuOpen = !menuOpen;
      mobileMenu.classList.toggle('open', menuOpen);
      document.body.style.overflow = menuOpen ? 'hidden' : '';
    });
    function closeMobile() {
      menuOpen = false;
      mobileMenu.classList.remove('open');
      document.body.style.overflow = '';
    }

    // ════════════════════════════════════════
    // GSAP HERO ANIMATIONS (on load)
    // ════════════════════════════════════════
    gsap.fromTo('.gsap-hero-sub',
      { opacity:0, y:20 },
      { opacity:1, y:0, duration:0.9, ease:'power2.out', stagger:0.15, delay:0.3 }
    );
    gsap.fromTo('.gsap-hero-h1',
      { opacity:0, y:60, skewY:1.5 },
      { opacity:1, y:0, skewY:0, duration:1.2, ease:'power3.out', delay:0.5 }
    );
    gsap.fromTo('.gsap-hero-btns',
      { opacity:0, y:24 },
      { opacity:1, y:0, duration:0.9, ease:'power2.out', delay:1.0 }
    );

    // ════════════════════════════════════════
    // GSAP SCROLL REVEALS
    // ════════════════════════════════════════
    function setupReveal(selector, extraOpts = {}) {
      gsap.utils.toArray(selector).forEach((el) => {
        gsap.fromTo(el,
          { opacity:0, y:48 },
          Object.assign({
            opacity:1, y:0,
            duration:1.0, ease:'power2.out',
            scrollTrigger: { trigger:el, start:'top 88%', toggleActions:'play none none none' }
          }, extraOpts)
        );
      });
    }
    setupReveal('.gsap-reveal');
    setupReveal('.reveal');

    // Display headings
    gsap.utils.toArray('.display-lg, .display-xl, .display-md').forEach(el => {
      if (el.closest('.hero-section')) return;
      gsap.fromTo(el,
        { opacity:0, y:55, skewY:1 },
        { opacity:1, y:0, skewY:0, duration:1.1, ease:'power3.out',
          scrollTrigger:{ trigger:el, start:'top 88%', toggleActions:'play none none none' } }
      );
    });

    // ════════════════════════════════════════
    // COUNTER ANIMATION
    // ════════════════════════════════════════
    document.querySelectorAll('.counter').forEach(el => {
      const target  = parseFloat(el.dataset.target);
      const suffix  = el.dataset.suffix || '+';
      const decimal = parseInt(el.dataset.decimal || '0');
      const obj     = { val: 0 };
      gsap.to(obj, {
        val: target,
        duration: 2.2,
        ease: 'power2.out',
        scrollTrigger: { trigger: el, start:'top 80%', toggleActions:'play none none none', once:true },
        onUpdate: () => {
          el.textContent = obj.val.toFixed(decimal) + suffix;
        },
        onComplete: () => {
          el.textContent = target.toFixed(decimal) + suffix;
        }
      });
    });

    // ════════════════════════════════════════
    // TIMELINE PROGRESS LINE
    // ════════════════════════════════════════
    const tlContainer = document.getElementById('timeline-container');
    const tlProgress  = document.getElementById('timeline-progress');
    const tlMob       = document.getElementById('timeline-progress-mob');
    if (tlContainer) {
      ScrollTrigger.create({
        trigger: tlContainer,
        start: 'top 55%',
        end:   'bottom 55%',
        scrub: 1.5,
        onUpdate(self) {
          const s = self.progress;
          tlProgress.style.transform = `scaleY(${s})`;
          if (tlMob) tlMob.style.transform = `scaleY(${s})`;
        }
      });
    }

    // ════════════════════════════════════════
    // TIMELINE MILESTONE TEXT ANIMATIONS
    // ════════════════════════════════════════
    gsap.utils.toArray('.gsap-timeline-item').forEach((item, i) => {
      const year = item.querySelector('.milestone-year');
      const h4   = item.querySelector('h4');
      const p    = item.querySelector('p');
      const tl   = gsap.timeline({
        scrollTrigger: { trigger:item, start:'top 80%', toggleActions:'play none none none' }
      });
      if (year) tl.fromTo(year,
        { opacity:0, y:30 },
        { opacity:1, y:0, duration:0.9, ease:'power3.out' }
      );
      if (h4) tl.fromTo(h4,
        { opacity:0, x: i%2===0 ? -30 : 30 },
        { opacity:1, x:0, duration:0.8, ease:'power2.out' }, '-=0.5'
      );
      if (p) tl.fromTo(p,
        { opacity:0, y:15 },
        { opacity:1, y:0,  duration:0.7, ease:'power2.out' }, '-=0.4'
      );
    });

    // ════════════════════════════════════════
    // HOW WE WORK — sequential step reveals
    // ════════════════════════════════════════
    gsap.utils.toArray('.craft-anim').forEach((step) => {
      const thread = step.querySelector('.step-thread');
      const num    = step.querySelector('.craft-step-num');
      const label  = step.querySelector('.craft-step-label');
      const title  = step.querySelector('.craft-step-title');
      const descs  = step.querySelectorAll('.craft-step-desc');
      const photo  = step.querySelector('.craft-step-photo');

      // Set invisible before play
      gsap.set([num, label, title, ...descs], { opacity: 0 });
      if (photo) gsap.set(photo, { opacity: 0, x: 36 });

      const tl = gsap.timeline({
        scrollTrigger: { trigger: step, start: 'top 80%', toggleActions: 'play none none none' }
      });

      // 1. Thread draws left → right (scaleX = compositor-only, no layout)
      tl.fromTo(thread,
        { scaleX: 0 },
        { scaleX: 1, duration: 0.72, ease: 'power3.inOut' }
      );

      // 2. Number rises (no blur — blur forces rasterization every frame)
      tl.fromTo(num,
        { opacity: 0, y: 22 },
        { opacity: 1, y: 0, duration: 0.65, ease: 'power3.out' },
        '-=0.28'
      );

      // 3. Label
      tl.fromTo(label,
        { opacity: 0, y: 10 },
        { opacity: 1, y: 0, duration: 0.4, ease: 'power2.out' },
        '-=0.38'
      );

      // 4. Title
      tl.fromTo(title,
        { opacity: 0, y: 18 },
        { opacity: 1, y: 0, duration: 0.5, ease: 'power2.out' },
        '-=0.35'
      );

      // 5. Description lines stagger
      tl.fromTo([...descs],
        { opacity: 0, y: 10 },
        { opacity: 1, y: 0, duration: 0.45, ease: 'power1.out', stagger: 0.08 },
        '-=0.3'
      );

      // 6. Photo slides in from right
      if (photo) {
        tl.fromTo(photo,
          { opacity: 0, x: 36 },
          { opacity: 1, x: 0, duration: 0.6, ease: 'power2.out' },
          '-=0.5'
        );
      }
    });

    // ════════════════════════════════════════
    // FABRIC CANVAS ANIMATION
    // Driven by GSAP ticker (not its own RAF)
    // so it never competes with Lenis
    // ════════════════════════════════════════
    (function() {
      const canvas = document.getElementById('fabricCanvas');
      if (!canvas) return;
      const ctx = canvas.getContext('2d');
      let W, H, t = 0, visible = false, _skip = 0;
      function resize() {
        W = canvas.offsetWidth; H = canvas.offsetHeight;
        canvas.width = W; canvas.height = H;
      }
      function draw() {
        if (!visible) return;
        // Throttle to ~20 fps — invisible at 60 fps, saves ~67% CPU
        if (++_skip < 3) return;
        _skip = 0;
        ctx.clearRect(0, 0, W, H);
        const sp = 16, amp = 2.0;
        // Vertical threads — compute strokeStyle once per column, not per pixel
        ctx.lineWidth = 0.7;
        for (let x = 0; x <= W + sp; x += sp) {
          const a = (0.08 + 0.05 * Math.sin(t * 0.6 + x * 0.02)).toFixed(2);
          ctx.strokeStyle = `rgba(197,169,122,${a})`;
          ctx.beginPath();
          for (let y = 0; y <= H; y += 2) {
            const wave = Math.sin((y / H) * Math.PI * 5 + t + x * 0.025) * amp;
            y === 0 ? ctx.moveTo(x + wave, y) : ctx.lineTo(x + wave, y);
          }
          ctx.stroke();
        }
        // Horizontal threads — compute strokeStyle once per row
        ctx.lineWidth = 0.6;
        for (let y = 0; y <= H + sp; y += sp) {
          const a = (0.06 + 0.04 * Math.sin(t * 0.5 + y * 0.02)).toFixed(2);
          ctx.strokeStyle = `rgba(140,123,107,${a})`;
          ctx.beginPath();
          for (let x = 0; x <= W; x += 2) {
            const wave = Math.sin((x / W) * Math.PI * 6 + t * 0.75 + y * 0.025) * amp;
            x === 0 ? ctx.moveTo(x, y + wave) : ctx.lineTo(x, y + wave);
          }
          ctx.stroke();
        }
        t += 0.03; // 3× step since running at 20fps to maintain same visual speed
      }
      resize();
      window.addEventListener('resize', resize, {passive:true});
      const obs = new IntersectionObserver(e => { visible = e[0].isIntersecting; }, { threshold: 0 });
      obs.observe(canvas);
      gsap.ticker.add(draw);
    })();

    // ════════════════════════════════════════
    // CAROUSEL — preserve scroll on focus
    // Prevents browser scrollIntoView from
    // jumping back to card 1 when an <a>
    // inside the track receives focus
    // ════════════════════════════════════════
    document.querySelectorAll('.carousel-track').forEach(track => {
      track.addEventListener('focusin', () => {
        const saved = track.scrollLeft;
        requestAnimationFrame(() => { track.scrollLeft = saved; });
      });
    });

    // ════════════════════════════════════════
    // VIDEO LAZY PLAY — only decode+play when card is visible,
    // pause immediately when scrolled away. Prevents all videos
    // from competing for the decoder on load.
    // ════════════════════════════════════════
    document.querySelectorAll('.carousel-track video').forEach(vid => {
      const io = new IntersectionObserver(entries => {
        entries.forEach(e => {
          if (e.isIntersecting) {
            vid.play().catch(() => {});
          } else {
            vid.pause();
          }
        });
      }, { threshold: 0.1, rootMargin: '0px 120px 0px 120px' });
      io.observe(vid);
    });

    // Arrow scroll helper
    function carouselScroll(trackId, dir) {
      const track = document.getElementById(trackId);
      if (!track) return;
      const cardWidth = track.querySelector('.carousel-card')?.offsetWidth || 340;
      track.scrollBy({ left: dir * (cardWidth + 16), behavior: 'smooth' });
    }

    // ════════════════════════════════════════
    // TAB SWITCH (Occasion / Pattern)
    // ════════════════════════════════════════
    function switchTab(id, btn) {
      document.querySelectorAll('.carousel-panel').forEach(p => p.classList.add('hidden'));
      document.getElementById('carousel-' + id).classList.remove('hidden');
      document.querySelectorAll('.carousel-tab').forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
    }

    // ════════════════════════════════════════
    // SMOOTH ANCHOR SCROLL
    // ════════════════════════════════════════
    document.querySelectorAll('a[href^="#"]').forEach(a => {
      a.addEventListener('click', e => {
        const target = document.querySelector(a.getAttribute('href'));
        if (target) {
          e.preventDefault();
          const navHeight = document.getElementById('navbar').getBoundingClientRect().height;
          // Sections have pt-24/pt-32 top padding. We scroll to the first child
          // (the content container) so the content — not the empty padding — lands
          // right below the navbar.
          const contentEl = target.firstElementChild || target;
          const sectionPad = parseInt(window.getComputedStyle(target).paddingTop) || 0;
          // For sections whose padding is on the inner container (e.g. #craft),
          // also check the first child's padding-top.
          const innerPad = sectionPad === 0
            ? (parseInt(window.getComputedStyle(contentEl).paddingTop) || 0)
            : 0;
          const topPad = sectionPad || innerPad;
          // offset = padding to skip − navbar height − small gap
          lenis.scrollTo(target, {
            offset: topPad - navHeight - 16,
            duration: 1.5,
          });
          closeMobile();
        }
      });
    });

    // ════════════════════════════════════════
    // WORLD MAP — D3 + Natural Earth TopoJSON
    // ════════════════════════════════════════
    (function() {
      const svgEl = document.getElementById('world-map-svg');
      if (!svgEl || typeof d3 === 'undefined' || typeof topojson === 'undefined') return;

      const W = 960, H = 500;
      const ns = 'http://www.w3.org/2000/svg';

      const projection = d3.geoNaturalEarth1()
        .scale(153)
        .translate([W / 2, H / 2]);
      const geoPath = d3.geoPath().projection(projection);

      // Export destinations + Mumbai home base
      const MUMBAI = [72.88, 19.07];
      const CITIES = [
        { name: 'Sri Lanka',    lon:  80.77, lat:   7.87, delay: 0.0  },
        { name: 'Indonesia',    lon: 113.92, lat:  -0.79, delay: 0.25 },
        { name: 'Thailand',     lon: 100.99, lat:  15.87, delay: 0.5  },
        { name: 'UAE',          lon:  54.37, lat:  24.47, delay: 0.75 },
        { name: 'South Africa', lon:  25.75, lat: -28.74, delay: 1.0  },
        { name: 'Singapore',    lon: 103.82, lat:   1.35, delay: 0.35 },
        { name: 'Colombia',     lon: -74.08, lat:   4.71, delay: 1.5  },
        { name: 'Kuwait',       lon:  47.97, lat:  29.37, delay: 0.6  },
        { name: 'Mexico',       lon: -99.13, lat:  19.43, delay: 1.25 },
        { name: 'Iran',         lon:  53.39, lat:  32.43, delay: 0.15 },
        { name: 'Bangladesh',   lon:  90.36, lat:  23.68, delay: 0.45 },
        { name: 'Hong Kong',    lon: 114.16, lat:  22.32, delay: 0.8  },
      ];

      // Arrowhead marker definition
      const defs = svgEl.querySelector('defs');
      const marker = document.createElementNS(ns, 'marker');
      marker.setAttribute('id', 'arrowhead');
      marker.setAttribute('markerWidth', '6');
      marker.setAttribute('markerHeight', '6');
      marker.setAttribute('refX', '5');
      marker.setAttribute('refY', '3');
      marker.setAttribute('orient', 'auto');
      marker.setAttribute('markerUnits', 'strokeWidth');
      const arrowPath = document.createElementNS(ns, 'path');
      arrowPath.setAttribute('d', 'M0,0.5 L5,3 L0,5.5');
      arrowPath.setAttribute('fill', 'none');
      arrowPath.setAttribute('stroke', '#C5A97A');
      arrowPath.setAttribute('stroke-width', '1');
      arrowPath.setAttribute('stroke-linecap', 'round');
      marker.appendChild(arrowPath);
      defs.appendChild(marker);

      function buildMap(world) {
        const land = topojson.feature(world, world.objects.land);

        // 1. Fill the clipPath with accurate land paths
        const clipEl = svgEl.querySelector('#landClip');
        if (clipEl) {
          const landPathEl = document.createElementNS(ns, 'path');
          landPathEl.setAttribute('d', geoPath(land));
          clipEl.appendChild(landPathEl);
        }

        const arcsGroup = svgEl.querySelector('#map-arcs');
        const dotsGroup = svgEl.querySelector('#map-dots');

        // 2. Project Mumbai
        const [mx, my] = projection(MUMBAI);

        // 3. Draw each arc + dot + label
        CITIES.forEach((city, i) => {
          const dest = [city.lon, city.lat];
          const [dx, dy] = projection(dest);

          // ── Great circle arc ──
          const lineGeo = { type: 'LineString', coordinates: [MUMBAI, dest] };
          const arcD = geoPath(lineGeo);
          if (arcD) {
            const arcEl = document.createElementNS(ns, 'path');
            arcEl.setAttribute('d', arcD);
            arcEl.setAttribute('fill', 'none');
            arcEl.setAttribute('stroke', '#C5A97A');
            arcEl.setAttribute('stroke-width', '0.85');
            arcEl.setAttribute('opacity', '0.5');
            arcEl.setAttribute('marker-end', 'url(#arrowhead)');
            arcsGroup.appendChild(arcEl);

            // Animate draw-on triggered by IntersectionObserver
            const len = arcEl.getTotalLength();
            arcEl.style.strokeDasharray = len;
            arcEl.style.strokeDashoffset = len;
            arcEl.dataset.len = len;
            arcEl.dataset.delay = city.delay;
            arcEl.classList.add('map-arc');

            // Travelling dot along the arc
            const animEl = document.createElementNS(ns, 'circle');
            animEl.setAttribute('r', '2.5');
            animEl.setAttribute('fill', '#C5A97A');
            animEl.setAttribute('opacity', '0');
            animEl.dataset.delay = city.delay;
            animEl.classList.add('map-traveller');

            // Use animateMotion for dot travel
            const am = document.createElementNS(ns, 'animateMotion');
            am.setAttribute('dur', '2s');
            am.setAttribute('begin', 'indefinite');
            am.setAttribute('fill', 'freeze');
            am.setAttribute('calcMode', 'spline');
            am.setAttribute('keyTimes', '0;1');
            am.setAttribute('keySplines', '0.4 0 0.2 1');
            const mpath = document.createElementNS(ns, 'mpath');
            // link to arc path via xlink:href
            const arcId = `arc-path-${i}`;
            arcEl.setAttribute('id', arcId);
            mpath.setAttributeNS('http://www.w3.org/1999/xlink', 'href', `#${arcId}`);
            am.appendChild(mpath);
            animEl.appendChild(am);
            animEl.dataset.anim = am;
            arcsGroup.appendChild(animEl);
          }

          // ── Destination dot ──
          const dotG = document.createElementNS(ns, 'g');
          dotG.setAttribute('class', 'map-dot');
          dotG.setAttribute('filter', 'url(#glow)');

          const solidDot = document.createElementNS(ns, 'circle');
          solidDot.setAttribute('cx', dx);
          solidDot.setAttribute('cy', dy);
          solidDot.setAttribute('r', '4.5');
          solidDot.setAttribute('fill', '#C5A97A');
          solidDot.setAttribute('opacity', '0');
          solidDot.classList.add('map-dest-dot');
          solidDot.dataset.delay = city.delay;

          const pulseDot = document.createElementNS(ns, 'circle');
          pulseDot.setAttribute('cx', dx);
          pulseDot.setAttribute('cy', dy);
          pulseDot.setAttribute('r', '4.5');
          pulseDot.setAttribute('fill', '#C5A97A');
          pulseDot.setAttribute('class', 'pulse');
          pulseDot.setAttribute('opacity', '0');
          pulseDot.classList.add('map-dest-dot');
          pulseDot.dataset.delay = city.delay + 0.05;

          // Label — offset to avoid overlap
          const labelOffX = dx > mx ? 8 : -(city.name.length * 5.5 + 8);
          const labelOffY = dy < my ? -7 : 14;
          const label = document.createElementNS(ns, 'text');
          label.setAttribute('x', dx + labelOffX);
          label.setAttribute('y', dy + labelOffY);
          label.setAttribute('fill', '#F4F1EA');
          label.setAttribute('font-size', '8.5');
          label.setAttribute('font-family', 'Bodoni Moda,serif');
          label.setAttribute('font-weight', '300');
          label.setAttribute('letter-spacing', '0.04em');
          label.setAttribute('opacity', '0');
          label.classList.add('map-dest-dot');
          label.dataset.delay = city.delay + 0.1;
          label.textContent = city.name;

          dotG.appendChild(solidDot);
          dotG.appendChild(pulseDot);
          dotG.appendChild(label);
          dotsGroup.appendChild(dotG);
        });

        // 4. Mumbai home dot
        const mumbaiG = document.createElementNS(ns, 'g');
        const mSolid = document.createElementNS(ns, 'circle');
        mSolid.setAttribute('cx', mx); mSolid.setAttribute('cy', my);
        mSolid.setAttribute('r', '5'); mSolid.setAttribute('fill', '#F4F1EA');
        mSolid.setAttribute('opacity', '0.9');
        const mRing = document.createElementNS(ns, 'circle');
        mRing.setAttribute('cx', mx); mRing.setAttribute('cy', my);
        mRing.setAttribute('r', '9'); mRing.setAttribute('fill', 'none');
        mRing.setAttribute('stroke', '#F4F1EA'); mRing.setAttribute('stroke-width', '0.8');
        mRing.setAttribute('opacity', '0.35');
        const mLabel = document.createElementNS(ns, 'text');
        mLabel.setAttribute('x', mx + 12); mLabel.setAttribute('y', my + 4);
        mLabel.setAttribute('fill', 'rgba(244,241,234,0.6)');
        mLabel.setAttribute('font-size', '8.5');
        mLabel.setAttribute('font-family', 'Bodoni Moda,serif');
        mLabel.setAttribute('font-weight', '400');
        mLabel.setAttribute('letter-spacing', '0.1em');
        mLabel.textContent = 'MUMBAI';
        mumbaiG.appendChild(mSolid);
        mumbaiG.appendChild(mRing);
        mumbaiG.appendChild(mLabel);
        dotsGroup.appendChild(mumbaiG);

        // 5. Trigger animations on scroll into view
        const mapSection = document.getElementById('exports');
        if (!mapSection) return;

        let animated = false;
        const mapObs = new IntersectionObserver(entries => {
          if (entries[0].isIntersecting && !animated) {
            animated = true;
            mapObs.disconnect();
            triggerMapAnimations();
          }
        }, { threshold: 0.3 });
        mapObs.observe(mapSection);
      }

      function triggerMapAnimations() {
        // Animate arcs
        svgEl.querySelectorAll('.map-arc').forEach(arc => {
          const len = parseFloat(arc.dataset.len);
          const delay = parseFloat(arc.dataset.delay) * 1000;
          setTimeout(() => {
            arc.style.transition = `stroke-dashoffset 1.4s cubic-bezier(0.4,0,0.2,1)`;
            arc.style.strokeDashoffset = '0';
          }, delay);
        });

        // Animate travelling dots
        svgEl.querySelectorAll('.map-traveller').forEach(dot => {
          const delay = parseFloat(dot.dataset.delay) * 1000;
          setTimeout(() => {
            dot.setAttribute('opacity', '1');
            const am = dot.querySelector('animateMotion');
            if (am) am.beginElement();
            // Fade out after travel
            setTimeout(() => { dot.setAttribute('opacity', '0'); }, 2100);
          }, delay);
        });

        // Fade in destination dots + labels
        svgEl.querySelectorAll('.map-dest-dot').forEach(el => {
          const delay = (parseFloat(el.dataset.delay) + 1.2) * 1000;
          setTimeout(() => {
            el.style.transition = 'opacity 0.5s ease';
            el.setAttribute('opacity', el.classList.contains('pulse') ? '0.45' : '1');
          }, delay);
        });
      }

      fetch('https://cdn.jsdelivr.net/npm/world-atlas@2/countries-110m.json')
        .then(r => r.json())
        .then(buildMap)
        .catch(() => {});
    })();

    // ════════════════════════════════════════
    // TESTIMONIAL MARQUEE — always flowing
    // ════════════════════════════════════════
    (function () {
      const track = document.querySelector('.testimonial-track');
      if (!track) return;

      // Collect the unique cards — HTML has 4 originals + 4 duplicates.
      // Keep only the first half; JS will clone as needed.
      const all = Array.from(track.querySelectorAll('.testimonial-card'));
      const half = Math.ceil(all.length / 2);
      all.slice(half).forEach(c => c.remove());

      const originals = Array.from(track.querySelectorAll('.testimonial-card'));

      // Clone until track is at least 4× the viewport width so there
      // is always content ahead of the read-head, no matter the screen size.
      let safety = 0;
      while (track.scrollWidth < window.innerWidth * 4 && safety++ < 20) {
        originals.forEach(c => track.appendChild(c.cloneNode(true)));
      }
      // One extra set so the seam is never the visible leading edge.
      originals.forEach(c => track.appendChild(c.cloneNode(true)));

      // Wait two frames for layout to settle before measuring.
      requestAnimationFrame(() => requestAnimationFrame(() => {
        const cards = track.querySelectorAll('.testimonial-card');
        if (cards.length < originals.length + 1) return;

        // setWidth = exact distance between card[0] and card[originals.length],
        // i.e. the pixel width of exactly one full original set including its trailing gap.
        const setWidth = cards[originals.length].offsetLeft - cards[0].offsetLeft;
        if (setWidth <= 0) return;

        const SPEED = 42; // px per second
        let x = 0;
        // Use GSAP ticker (same loop as Lenis) — no competing RAF
        gsap.ticker.add(function(time, dt) {
          x -= SPEED * dt / 1000; // dt is ms
          if (x <= -setWidth) x += setWidth;
          track.style.transform = `translateX(${x}px)`;
        });
      }));
    }());

    // ════════════════════════════════════════
    // FORM SUBMIT
    // ════════════════════════════════════════
    function handleSubmit(e) {
      e.preventDefault();
      const btn = e.target.querySelector('button[type=submit]');
      btn.textContent = 'Sending…'; btn.disabled = true;
      setTimeout(() => {
        btn.textContent = 'Sent!';
        document.getElementById('form-success').classList.remove('hidden');
        e.target.reset();
        setTimeout(() => {
          btn.textContent = 'Send Enquiry'; btn.disabled = false;
          document.getElementById('form-success').classList.add('hidden');
        }, 5000);
      }, 1200);
    }

    (function updateOfficeStatus() {
      const dot  = document.getElementById('office-status-dot');
      const text = document.getElementById('office-status-text');
      const wrap = document.getElementById('office-status');
      if (!dot || !text || !wrap) return;

      function tick() {
        const now    = new Date();
        // IST = UTC + 5h30m
        const istMs  = now.getTime() + (now.getTimezoneOffset() * 60000) + (5.5 * 3600000);
        const ist    = new Date(istMs);
        const day    = ist.getDay();   // 0=Sun, 1=Mon … 6=Sat
        const h      = ist.getHours();
        const m      = ist.getMinutes();
        const mins   = h * 60 + m;    // minutes since midnight IST

        const isWeekday = day >= 1 && day <= 6;
        const isOpen    = isWeekday && mins >= 600 && mins < 1140; // 10:00–19:00

        if (isOpen) {
          dot.style.background  = '#4ade80';
          dot.style.boxShadow   = '0 0 6px rgba(74,222,128,0.6)';
          text.style.color      = 'rgba(74,222,128,0.9)';
          text.textContent      = 'Open now';
        } else {
          dot.style.background  = 'rgba(244,241,234,0.25)';
          dot.style.boxShadow   = 'none';
          text.style.color      = 'rgba(244,241,234,0.35)';
          // tell them when it opens next
          const opensDay  = day === 0 ? 'Monday' : day === 6 ? 'Monday' : 'tomorrow';
          const closedMsg = !isWeekday
            ? 'Closed · Opens Monday at 10:00 AM'
            : mins < 600
              ? 'Closed · Opens today at 10:00 AM'
              : 'Closed · Opens ' + opensDay + ' at 10:00 AM';
          text.textContent = closedMsg;
        }

        wrap.style.setProperty('display', 'flex', 'important');
      }

      tick();
      setInterval(tick, 60000);
    })();
  </script>

</body>
</html>
