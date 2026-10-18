<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>SchoolMS — Complete School Management System</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="stylesheet" media="print" onload="this.media='all'"
    href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@700;800;900&display=swap" />
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    html { scroll-behavior: smooth; }
    body { font-family: 'Inter', sans-serif; color: #0d1f13; background: #fff; }

    /* ── Variables ── */
    :root {
      --green: #15803d;
      --green-dark: #14532d;
      --green-deepest: #0d1f13;
      --amber: #f59e0b;
      --amber-dark: #d97706;
      --gray: #6b7280;
      --light: #f9fafb;
    }

    /* ── Utility ── */
    .container { max-width: 1200px; margin: 0 auto; padding: 0 24px; }
    .container-sm { max-width: 1100px; margin: 0 auto; padding: 0 24px; }

    /* ── Navbar ── */
    .navbar {
      position: sticky; top: 0; z-index: 100;
      background: rgba(255,255,255,0.96);
      backdrop-filter: blur(12px);
      border-bottom: 1px solid #f3f4f6;
    }
    .navbar-inner {
      display: flex; align-items: center; justify-content: space-between;
      height: 66px;
    }
    .logo { display: flex; align-items: center; gap: 10px; text-decoration: none; }
    .logo-icon {
      width: 40px; height: 40px; border-radius: 11px;
      background: linear-gradient(135deg, var(--green), var(--green-dark));
      display: flex; align-items: center; justify-content: center;
      flex-shrink: 0;
    }
    .logo-icon svg { width: 22px; height: 22px; }
    .logo-name { font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 900; font-size: 18px; color: var(--green-deepest); line-height: 1.1; }
    .logo-sub { font-size: 10px; color: #9ca3af; font-weight: 500; }
    .nav-links { display: flex; gap: 36px; align-items: center; }
    .nav-links a { color: #374151; font-size: 14px; font-weight: 500; text-decoration: none; transition: color .2s; }
    .nav-links a:hover { color: var(--green); }
    .btn-amber {
      display: inline-flex; align-items: center; gap: 8px;
      background: var(--amber); color: var(--green-deepest);
      font-weight: 700; border-radius: 9999px;
      padding: 10px 22px; font-size: 14px;
      text-decoration: none; border: none; cursor: pointer;
      transition: all .2s;
    }
    .btn-amber:hover { background: var(--amber-dark); transform: scale(1.03); }
    .btn-amber-lg { padding: 16px 40px; font-size: 16px; }
    .btn-ghost {
      display: inline-flex; align-items: center; gap: 8px;
      border: 2px solid rgba(255,255,255,.55); color: #fff;
      font-weight: 600; border-radius: 9999px;
      padding: 16px 32px; font-size: 16px;
      text-decoration: none; transition: all .2s; background: transparent;
    }
    .btn-ghost:hover { background: rgba(255,255,255,.12); }

    /* ── Hero ── */
    .hero {
      background: linear-gradient(135deg, #0d1f13 0%, #14532d 50%, #15803d 100%);
      padding: 88px 24px 104px;
      text-align: center;
    }
    .hero-badge {
      display: inline-flex; align-items: center; gap: 8px;
      background: rgba(245,158,11,.14); border: 1px solid rgba(245,158,11,.3);
      border-radius: 9999px; padding: 6px 18px; margin-bottom: 32px;
    }
    .hero-badge-dot { width: 8px; height: 8px; border-radius: 50%; background: var(--amber); }
    .hero-badge span { color: var(--amber); font-size: 13px; font-weight: 600; }
    .hero h1 {
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: clamp(36px, 5.5vw, 66px);
      font-weight: 900; color: #fff; line-height: 1.08;
      margin-bottom: 28px; letter-spacing: -1.5px;
    }
    .hero h1 .accent { color: var(--amber); }
    .hero p {
      font-size: 18px; color: rgba(255,255,255,.72);
      max-width: 640px; margin: 0 auto 48px; line-height: 1.75;
    }
    .hero-btns { display: flex; gap: 16px; justify-content: center; flex-wrap: wrap; }
    .school-types {
      display: flex; gap: 10px; justify-content: center; flex-wrap: wrap;
      margin-top: 52px;
    }
    .type-pill {
      background: rgba(255,255,255,.1); border: 1px solid rgba(255,255,255,.18);
      border-radius: 9999px; padding: 7px 18px;
      font-size: 13px; color: rgba(255,255,255,.85); font-weight: 500;
    }
    .stats-row {
      display: flex; justify-content: center; gap: 56px;
      margin-top: 72px; flex-wrap: wrap;
    }
    .stat-val {
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 38px; font-weight: 900; color: var(--amber); line-height: 1;
    }
    .stat-label { font-size: 13px; color: rgba(255,255,255,.55); margin-top: 7px; font-weight: 500; }

    /* ── Wave ── */
    .wave-wrap { background: var(--light); line-height: 0; }
    .wave-wrap svg { display: block; }

    /* ── Section shared ── */
    section { padding: 96px 24px; }
    .section-pill {
      display: inline-flex; align-items: center; gap: 7px;
      background: #f0fdf4; border: 1px solid #bbf7d0;
      border-radius: 9999px; padding: 5px 16px; margin-bottom: 20px;
      font-size: 13px; font-weight: 600; color: var(--green);
    }
    .section-title {
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: clamp(26px, 4vw, 46px); font-weight: 900;
      color: var(--green-deepest); margin-bottom: 18px;
    }
    .section-sub { font-size: 17px; color: var(--gray); max-width: 560px; margin: 0 auto; line-height: 1.75; }
    .divider { height: 4px; width: 52px; background: linear-gradient(90deg,var(--green),var(--amber)); border-radius: 9999px; margin-bottom: 20px; }

    /* ── Features grid ── */
    .features-bg { background: var(--light); }
    .features-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 22px; margin-top: 0; }
    .feature-card {
      background: #fff; border-radius: 20px; padding: 30px;
      border: 1px solid #e5e7eb;
      transition: all .25s ease;
    }
    .feature-card:hover { transform: translateY(-5px); box-shadow: 0 24px 48px rgba(0,0,0,.12); }
    .feat-icon {
      width: 54px; height: 54px; border-radius: 15px;
      display: flex; align-items: center; justify-content: center; margin-bottom: 20px;
    }
    .feat-icon svg { width: 26px; height: 26px; }
    .feature-card h3 { font-size: 16px; font-weight: 700; color: var(--green-deepest); margin-bottom: 10px; }
    .feature-card p { font-size: 14px; color: var(--gray); line-height: 1.72; }

    /* ── Who section ── */
    .who-bg { background: #fff; }
    .who-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 72px; align-items: center; }
    .type-btns { display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 36px; }
    .type-btn {
      padding: 8px 18px; border-radius: 9999px; font-size: 14px; font-weight: 600;
      border: 2px solid #e5e7eb; background: #fff; color: var(--gray);
      cursor: pointer; transition: all .2s;
    }
    .type-btn.active { border-color: var(--green); background: rgba(21,128,61,.08); color: var(--green); }
    .benefit-list { display: flex; flex-direction: column; gap: 16px; }
    .benefit-item { display: flex; align-items: flex-start; gap: 14px; }
    .benefit-icon {
      width: 40px; height: 40px; border-radius: 11px;
      background: rgba(21,128,61,.1); display: flex; align-items: center; justify-content: center; flex-shrink: 0;
    }
    .benefit-icon svg { width: 18px; height: 18px; }
    .benefit-title { font-size: 15px; font-weight: 700; color: var(--green-deepest); margin-bottom: 3px; }
    .benefit-desc { font-size: 14px; color: var(--gray); line-height: 1.6; }
    /* Capabilities panel */
    .cap-panel {
      background: linear-gradient(145deg, var(--green-deepest), var(--green-dark));
      border-radius: 26px; padding: 38px; color: #fff;
    }
    .cap-label { font-size: 12px; font-weight: 700; color: var(--amber); margin-bottom: 22px; text-transform: uppercase; letter-spacing: 1.2px; }
    .cap-item {
      display: flex; align-items: center; gap: 12px;
      padding: 11px 0; border-bottom: 1px solid rgba(255,255,255,.08);
    }
    .cap-item:last-child { border-bottom: none; }
    .cap-check {
      width: 22px; height: 22px; border-radius: 50%;
      background: rgba(21,128,61,.5); display: flex; align-items: center; justify-content: center; flex-shrink: 0;
    }
    .cap-check svg { width: 12px; height: 12px; }
    .cap-item span { font-size: 14px; font-weight: 500; color: rgba(255,255,255,.88); }

    /* ── Pricing ── */
    .pricing-bg { background: var(--light); }
    .pricing-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 24px; max-width: 940px; margin: 0 auto; }
    .plan-card {
      border-radius: 22px; padding: 32px;
      transition: all .25s ease;
    }
    .plan-card:hover { transform: translateY(-4px); }
    .plan-card.plain { background: #fff; border: 1px solid #e5e7eb; box-shadow: 0 4px 20px rgba(0,0,0,.05); }
    .plan-card.highlight { background: linear-gradient(145deg, var(--green-deepest), var(--green-dark)); box-shadow: 0 20px 60px rgba(21,128,61,.3); position: relative; overflow: hidden; }
    .plan-card.purple { background: #fff; border: 1px solid #e5e7eb; box-shadow: 0 4px 20px rgba(0,0,0,.05); }
    .plan-badge {
      position: absolute; top: 18px; right: 18px;
      background: var(--amber); color: var(--green-deepest);
      font-size: 11px; font-weight: 700; border-radius: 9999px; padding: 3px 12px;
    }
    .plan-name { font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 12px; }
    .plan-name.green { color: var(--amber); }
    .plan-name.dark { color: #374151; }
    .plan-name.purple { color: #7c3aed; }
    .plan-price { font-family: 'Plus Jakarta Sans', sans-serif; font-size: 34px; font-weight: 900; line-height: 1; }
    .plan-price.white { color: #fff; }
    .plan-price.dark-text { color: var(--green-deepest); }
    .plan-period { font-size: 13px; margin-top: 4px; margin-bottom: 28px; }
    .plan-period.muted { color: rgba(255,255,255,.5); }
    .plan-period.gray { color: #9ca3af; }
    .plan-features { display: flex; flex-direction: column; gap: 12px; margin-bottom: 32px; }
    .plan-feat { display: flex; align-items: center; gap: 10px; }
    .plan-feat span { font-size: 14px; font-weight: 500; }
    .plan-feat span.white { color: rgba(255,255,255,.82); }
    .plan-feat span.dark-text { color: #374151; }
    .check-small { width: 14px; height: 14px; flex-shrink: 0; }
    .plan-btn {
      display: flex; align-items: center; justify-content: center; gap: 8px;
      padding: 12px 0; border-radius: 9999px;
      font-size: 14px; font-weight: 700; text-decoration: none;
      transition: all .2s;
    }
    .plan-btn.amber-btn { background: var(--amber); color: var(--green-deepest); }
    .plan-btn.amber-btn:hover { background: var(--amber-dark); }
    .plan-btn.green-outline { background: rgba(21,128,61,.1); color: var(--green); border: 2px solid rgba(21,128,61,.25); }
    .plan-btn.green-outline:hover { background: rgba(21,128,61,.18); }
    .plan-btn.purple-outline { background: rgba(124,58,237,.08); color: #7c3aed; border: 2px solid rgba(124,58,237,.25); }
    .plan-btn.purple-outline:hover { background: rgba(124,58,237,.15); }

    /* ── Testimonials ── */
    .testi-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 24px; }
    .testi-card { background: #f9fafb; border-radius: 20px; padding: 32px; border: 1px solid #e5e7eb; }
    .stars { display: flex; gap: 3px; margin-bottom: 20px; }
    .stars svg { width: 16px; height: 16px; }
    .testi-card p { font-size: 15px; color: #374151; line-height: 1.78; margin-bottom: 24px; font-style: italic; }
    .testi-author { display: flex; align-items: center; gap: 12px; }
    .author-avatar {
      width: 44px; height: 44px; border-radius: 50%;
      background: linear-gradient(135deg, var(--green), var(--amber));
      display: flex; align-items: center; justify-content: center;
      color: #fff; font-weight: 800; font-size: 17px; flex-shrink: 0;
    }
    .author-name { font-weight: 700; font-size: 14px; color: var(--green-deepest); }
    .author-role { font-size: 12px; color: #9ca3af; }

    /* ── CTA ── */
    .cta-section {
      background: linear-gradient(135deg, #0d1f13 0%, #14532d 50%, #15803d 100%);
      padding: 96px 24px; text-align: center;
    }
    .cta-icon {
      width: 74px; height: 74px; border-radius: 50%;
      background: var(--amber); display: flex; align-items: center; justify-content: center;
      margin: 0 auto 30px;
    }
    .cta-icon svg { width: 36px; height: 36px; }
    .cta-section h2 {
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: clamp(28px, 4.5vw, 52px);
      font-weight: 900; color: #fff; margin-bottom: 22px; line-height: 1.12;
    }
    .cta-section h2 .accent { color: var(--amber); }
    .cta-section p { font-size: 18px; color: rgba(255,255,255,.7); line-height: 1.76; margin-bottom: 48px; max-width: 600px; margin-left: auto; margin-right: auto; }
    .cta-note { margin-top: 26px; font-size: 13px; color: rgba(255,255,255,.38); }

    /* ── Footer ── */
    .footer { background: var(--green-deepest); padding: 44px 24px; }
    .footer-inner { display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 24px; }
    .footer-logo { display: flex; align-items: center; gap: 10px; }
    .footer-logo-icon { width: 36px; height: 36px; border-radius: 9px; background: var(--green); display: flex; align-items: center; justify-content: center; }
    .footer-logo-icon svg { width: 20px; height: 20px; }
    .footer-name { font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 900; font-size: 16px; color: #fff; }
    .footer-sub { font-size: 11px; color: rgba(255,255,255,.4); }
    .footer-links { display: flex; gap: 28px; }
    .footer-links a { font-size: 13px; color: rgba(255,255,255,.45); text-decoration: none; font-weight: 500; transition: color .2s; }
    .footer-links a:hover { color: rgba(255,255,255,.8); }
    .footer-copy { font-size: 12px; color: rgba(255,255,255,.25); }

    /* ── Responsive ── */
    @media (max-width: 900px) {
      .nav-links { display: none; }
      .who-grid { grid-template-columns: 1fr; gap: 40px; }
      .pricing-grid { grid-template-columns: 1fr; max-width: 420px; }
      .footer-inner { flex-direction: column; align-items: flex-start; }
    }
    @media (max-width: 600px) {
      .hero h1 { font-size: 32px; }
      .stats-row { gap: 32px; }
      .hero-btns { flex-direction: column; align-items: center; }
      .btn-ghost { padding: 14px 24px; font-size: 15px; }
      .btn-amber-lg { padding: 14px 30px; font-size: 15px; }
    }
  </style>
</head>
<body>

<!-- ══════════ NAVBAR ══════════ -->
<nav class="navbar">
  <div class="container navbar-inner">
    <a href="landing.php" class="logo">
      <div class="logo-icon">
        <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/>
        </svg>
      </div>
      <div>
        <div class="logo-name">SchoolMS</div>
        <div class="logo-sub">Management System</div>
      </div>
    </a>

    <nav class="nav-links">
      <a href="#features">Features</a>
      <a href="#whoitsfor">Who It's For</a>
      <a href="#pricing">Pricing</a>
      <a href="#demo">Demo</a>
    </nav>

    <a href="login.php" class="btn-amber">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="5 3 19 12 5 21 5 3"/></svg>
      Try Demo Free
    </a>
  </div>
</nav>

<!-- ══════════ HERO ══════════ -->
<section class="hero">
  <div class="container">
    <div class="hero-badge">
      <div class="hero-badge-dot"></div>
      <span>Complete School Management Software</span>
    </div>

    <h1>
      Run Your School Smarter —<br>
      <span class="accent">For Any School, Any Size</span>
    </h1>

    <p>Students, fees, attendance, results, certificates — all managed in one offline-ready system. No monthly traps, no internet required.</p>

    <div class="hero-btns">
      <a href="login.php" class="btn-amber btn-amber-lg">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><polygon points="5 3 19 12 5 21 5 3"/></svg>
        Visit Live Demo
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
      </a>
      <a href="#features" class="btn-ghost">
        See All Features
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
      </a>
    </div>

    <div class="school-types">
      <?php foreach(['Primary Schools','Secondary Schools','Higher Secondary','Private Academies','Madrassas','Coaching Centers'] as $t): ?>
        <div class="type-pill">✓ <?= htmlspecialchars($t) ?></div>
      <?php endforeach; ?>
    </div>

    <div class="stats-row">
      <?php foreach([['Any','School Type'],['8+','Core Modules'],['100%','Data Private'],['Free','Open Source']] as [$v,$l]): ?>
        <div style="text-align:center">
          <div class="stat-val"><?= $v ?></div>
          <div class="stat-label"><?= $l ?></div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- wave -->
<div class="wave-wrap">
  <svg viewBox="0 0 1440 60" xmlns="http://www.w3.org/2000/svg">
    <path d="M0,30 C360,60 1080,0 1440,30 L1440,0 L0,0 Z" fill="#14532d"/>
  </svg>
</div>

<!-- ══════════ FEATURES ══════════ -->
<section id="features" class="features-bg">
  <div class="container">
    <div style="text-align:center;margin-bottom:64px">
      <div class="section-pill">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
        Powerful Modules
      </div>
      <h2 class="section-title">Everything in One System</h2>
      <p class="section-sub">8 fully-integrated modules. Switch between them instantly — no separate apps, no data migration.</p>
    </div>

    <div class="features-grid">
      <?php
      $features = [
        ['color'=>'#15803d','icon'=>'users',     'title'=>'Student Management',  'desc'=>'Complete student profiles with admission records, documents, photos, and real-time status tracking.'],
        ['color'=>'#0891b2','icon'=>'dollar',    'title'=>'Fee Collection',       'desc'=>'Automated monthly fee tracking, defaulter reports, receipt printing, and full fee history per student.'],
        ['color'=>'#7c3aed','icon'=>'clipboard', 'title'=>'Attendance System',    'desc'=>'Daily attendance for students and teachers with class-wise reports and automated insights.'],
        ['color'=>'#dc2626','icon'=>'chart',     'title'=>'Results & Exams',      'desc'=>'Enter marks, generate result cards, print exam slips, and track student progress across terms.'],
        ['color'=>'#d97706','icon'=>'award',     'title'=>'Certificates',         'desc'=>'One-click School Leaving Certificates, Character Certificates, and Transfer Letters.'],
        ['color'=>'#059669','icon'=>'usercheck', 'title'=>'Parent Portal',        'desc'=>'Parents can view their child\'s attendance, results, and fee status with a secure login.'],
        ['color'=>'#2563eb','icon'=>'graduate',  'title'=>'Class Promotion',      'desc'=>'Bulk-promote students to the next class at year-end with a single click and audit trail.'],
        ['color'=>'#9333ea','icon'=>'archive',   'title'=>'Backup & Restore',     'desc'=>'One-click data backup as ZIP and instant restore. Your data is always safe and portable.'],
      ];
      $icons = [
        'users'     =>'<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>',
        'dollar'    =>'<line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>',
        'clipboard' =>'<path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/><rect x="8" y="2" width="8" height="4" rx="1" ry="1"/><line x1="9" y1="12" x2="15" y2="12"/><line x1="9" y1="16" x2="15" y2="16"/>',
        'chart'     =>'<line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/>',
        'award'     =>'<circle cx="12" cy="8" r="7"/><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"/>',
        'usercheck' =>'<path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="8.5" cy="7" r="4"/><polyline points="17 11 19 13 23 9"/>',
        'graduate'  =>'<path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/>',
        'archive'   =>'<polyline points="21 8 21 21 3 21 3 8"/><rect x="1" y="3" width="22" height="5"/><line x1="10" y1="12" x2="14" y2="12"/>',
      ];
      foreach($features as $f): ?>
        <div class="feature-card">
          <div class="feat-icon" style="background:<?= $f['color'] ?>18">
            <svg viewBox="0 0 24 24" fill="none" stroke="<?= $f['color'] ?>" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <?= $icons[$f['icon']] ?>
            </svg>
          </div>
          <h3><?= htmlspecialchars($f['title']) ?></h3>
          <p><?= htmlspecialchars($f['desc']) ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ══════════ WHO IT'S FOR ══════════ -->
<section id="whoitsfor" class="who-bg">
  <div class="container-sm">
    <div class="who-grid">
      <div>
        <div class="divider"></div>
        <h2 class="section-title" style="margin-bottom:20px">Built for Every Kind of School</h2>
        <p style="font-size:16px;color:var(--gray);line-height:1.8;margin-bottom:36px">
          Whether you run a small private academy or a large secondary school — SchoolMS adapts to your workflow. No special IT skills needed.
        </p>

        <div class="type-btns" id="typeBtns">
          <?php foreach(['Primary Schools','Secondary Schools','Higher Secondary','Private Academies','Madrassas','Coaching Centers'] as $i=>$t): ?>
            <button class="type-btn<?= $i===0?' active':'' ?>" onclick="setType(this)"><?= htmlspecialchars($t) ?></button>
          <?php endforeach; ?>
        </div>

        <div class="benefit-list">
          <?php
          $benefits = [
            ['icon'=>'wifi',    'title'=>'Works Offline',       'desc'=>'All data stored on your machine. No internet subscription required.'],
            ['icon'=>'lock',    'title'=>'Your Data, Your Control','desc'=>'Nothing uploaded to any server. 100% private and secure.'],
            ['icon'=>'zap',     'title'=>'Setup in Minutes',    'desc'=>'Just install and go. No complex configuration or IT team needed.'],
            ['icon'=>'shield',  'title'=>'Role-Based Access',   'desc'=>'Admin, Teacher, and Parent roles — each sees only what they need.'],
          ];
          $bicons = [
            'wifi'  =>'<path d="M5 12.55a11 11 0 0 1 14.08 0"/><path d="M1.42 9a16 16 0 0 1 21.16 0"/><path d="M8.53 16.11a6 6 0 0 1 6.95 0"/><line x1="12" y1="20" x2="12.01" y2="20"/>',
            'lock'  =>'<rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>',
            'zap'   =>'<polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/>',
            'shield'=>'<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>',
          ];
          foreach($benefits as $b): ?>
            <div class="benefit-item">
              <div class="benefit-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="var(--green)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <?= $bicons[$b['icon']] ?>
                </svg>
              </div>
              <div>
                <div class="benefit-title"><?= htmlspecialchars($b['title']) ?></div>
                <div class="benefit-desc"><?= htmlspecialchars($b['desc']) ?></div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- Capabilities panel -->
      <div class="cap-panel">
        <div class="cap-label">System Capabilities</div>
        <?php foreach([
          'Unlimited Student Profiles','Multi-Class Fee Structures',
          'Daily & Monthly Attendance','Term-wise Result Cards',
          'School Leaving Certificates','Parent Self-Service Portal',
          'One-Click Data Backup / Restore','Bulk Student Promotion',
          'Print Receipts & Reports','Multi-Role Staff Accounts',
        ] as $cap): ?>
          <div class="cap-item">
            <div class="cap-check">
              <svg viewBox="0 0 24 24" fill="none" stroke="#86efac" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="20 6 9 17 4 12"/>
              </svg>
            </div>
            <span><?= htmlspecialchars($cap) ?></span>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

<!-- ══════════ PRICING ══════════ -->
<section id="pricing" class="pricing-bg">
  <div class="container">
    <div style="text-align:center;margin-bottom:60px">
      <div class="section-pill">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
        Simple Pricing
      </div>
      <h2 class="section-title">Start Free. Scale When Ready.</h2>
      <p class="section-sub">The full system is free to use on your own machine. Pay only if you need cloud hosting or custom features.</p>
    </div>

    <div class="pricing-grid">
      <!-- Free -->
      <div class="plan-card plain">
        <div class="plan-name dark">Free</div>
        <div class="plan-price dark-text">PKR 0</div>
        <div class="plan-period gray">forever</div>
        <div class="plan-features">
          <?php foreach(['Unlimited Students','All 8 Modules','Offline / Local Use','Community Support'] as $f): ?>
            <div class="plan-feat">
              <svg class="check-small" viewBox="0 0 24 24" fill="none" stroke="var(--green)" stroke-width="3" stroke-linecap="round"><polyline points="20 6 9 17 4 12"/></svg>
              <span class="dark-text"><?= htmlspecialchars($f) ?></span>
            </div>
          <?php endforeach; ?>
        </div>
        <a href="login.php" class="plan-btn green-outline">Start Free <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
      </div>

      <!-- Hosted (highlight) -->
      <div class="plan-card highlight">
        <div class="plan-badge">POPULAR</div>
        <div class="plan-name green">Hosted</div>
        <div class="plan-price white">PKR 1,500</div>
        <div class="plan-period muted">/ month</div>
        <div class="plan-features">
          <?php foreach(['Everything in Free','Cloud Hosting','Online Access Anywhere','Priority Support','Automatic Backups'] as $f): ?>
            <div class="plan-feat">
              <svg class="check-small" viewBox="0 0 24 24" fill="none" stroke="#86efac" stroke-width="3" stroke-linecap="round"><polyline points="20 6 9 17 4 12"/></svg>
              <span class="white"><?= htmlspecialchars($f) ?></span>
            </div>
          <?php endforeach; ?>
        </div>
        <a href="login.php" class="plan-btn amber-btn">Get Started <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
      </div>

      <!-- Custom -->
      <div class="plan-card purple">
        <div class="plan-name purple">Custom</div>
        <div class="plan-price dark-text" style="font-size:26px">Let's Talk</div>
        <div class="plan-period gray" style="margin-bottom:28px">&nbsp;</div>
        <div class="plan-features">
          <?php foreach(['Custom Branding','Multi-Branch Support','API Access','Dedicated Server','Training & Onboarding'] as $f): ?>
            <div class="plan-feat">
              <svg class="check-small" viewBox="0 0 24 24" fill="none" stroke="#7c3aed" stroke-width="3" stroke-linecap="round"><polyline points="20 6 9 17 4 12"/></svg>
              <span class="dark-text"><?= htmlspecialchars($f) ?></span>
            </div>
          <?php endforeach; ?>
        </div>
        <a href="login.php" class="plan-btn purple-outline">Contact Us <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
      </div>
    </div>
  </div>
</section>

<!-- ══════════ TESTIMONIALS ══════════ -->
<section style="background:#fff;padding:96px 24px">
  <div class="container-sm">
    <div style="text-align:center;margin-bottom:58px">
      <div class="section-pill">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="var(--green)" stroke="var(--green)" stroke-width="1"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
        User Reviews
      </div>
      <h2 class="section-title">Schools Love SchoolMS</h2>
    </div>
    <div class="testi-grid">
      <?php
      $testimonials = [
        ['name'=>'School Principal','role'=>'Private Secondary School','text'=>'SMS transformed how we manage 400+ students. Fee collection, attendance, and results — all in one place. No more paperwork.'],
        ['name'=>'Head Teacher',    'role'=>'Primary School',          'text'=>'The parent portal is a game changer. Parents check their child\'s fee and attendance anytime without calling the school.'],
        ['name'=>'Admin Staff',     'role'=>'Academy',                 'text'=>'Certificate printing used to take hours. Now it\'s one click. The backup system gives us complete peace of mind.'],
      ];
      foreach($testimonials as $t): ?>
        <div class="testi-card">
          <div class="stars">
            <?php for($i=0;$i<5;$i++): ?>
              <svg viewBox="0 0 24 24" fill="#f59e0b" stroke="#f59e0b" stroke-width="1"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
            <?php endfor; ?>
          </div>
          <p>"<?= htmlspecialchars($t['text']) ?>"</p>
          <div class="testi-author">
            <div class="author-avatar"><?= strtoupper($t['name'][0]) ?></div>
            <div>
              <div class="author-name"><?= htmlspecialchars($t['name']) ?></div>
              <div class="author-role"><?= htmlspecialchars($t['role']) ?></div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ══════════ CTA / DEMO ══════════ -->
<section id="demo" class="cta-section">
  <div style="max-width:680px;margin:0 auto">
    <div class="cta-icon">
      <svg viewBox="0 0 24 24" fill="var(--green-deepest)" stroke="var(--green-deepest)" stroke-width="1">
        <polygon points="5 3 19 12 5 21 5 3"/>
      </svg>
    </div>
    <h2>See It in Action —<br><span class="accent">Live Demo, Right Now</span></h2>
    <p>Explore the full SchoolMS system. Log in as admin and discover every feature — no sign-up, no credit card, no commitment.</p>
    <a href="login.php" class="btn-amber btn-amber-lg">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><polygon points="5 3 19 12 5 21 5 3"/></svg>
      Open Live Demo
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
    </a>
    <p class="cta-note">No account needed · Works in your browser · Sample data pre-loaded</p>
  </div>
</section>

<!-- ══════════ FOOTER ══════════ -->
<footer class="footer">
  <div class="container-sm footer-inner">
    <div class="footer-logo">
      <div class="footer-logo-icon">
        <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="20" height="20">
          <path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/>
        </svg>
      </div>
      <div>
        <div class="footer-name">SchoolMS</div>
        <div class="footer-sub">School Management System</div>
      </div>
    </div>
    <div class="footer-links">
      <a href="#features">Features</a>
      <a href="#pricing">Pricing</a>
      <a href="login.php">Demo</a>
    </div>
    <div class="footer-copy">© 2026 AR Software Solutions</div>
  </div>
</footer>

<script>
function setType(btn) {
  document.querySelectorAll('.type-btn').forEach(b => b.classList.remove('active'));
  btn.classList.add('active');
}
</script>

<!-- ══════════ WHATSAPP FLOATING BUTTON ══════════ -->
<style>
  .wa-wrap {
    position: fixed;
    bottom: 28px;
    right: 28px;
    z-index: 9999;
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    gap: 10px;
  }

  /* Tooltip bubble */
  .wa-tooltip {
    background: #fff;
    color: #111;
    font-family: 'Inter', sans-serif;
    font-size: 13px;
    font-weight: 600;
    padding: 10px 16px;
    border-radius: 14px;
    box-shadow: 0 6px 28px rgba(0,0,0,0.15);
    white-space: nowrap;
    opacity: 0;
    transform: translateX(30px) scale(0.9);
    transition: opacity .35s ease, transform .35s ease;
    pointer-events: none;
    position: relative;
  }
  .wa-tooltip::after {
    content: '';
    position: absolute;
    right: 18px;
    bottom: -7px;
    width: 14px; height: 14px;
    background: #fff;
    transform: rotate(45deg);
    box-shadow: 3px 3px 6px rgba(0,0,0,0.07);
    border-radius: 2px;
  }
  .wa-tooltip.show {
    opacity: 1;
    transform: translateX(0) scale(1);
  }

  /* Main button */
  .wa-btn {
    width: 60px; height: 60px;
    border-radius: 50%;
    background: #25d366;
    display: flex; align-items: center; justify-content: center;
    box-shadow: 0 6px 24px rgba(37,211,102,0.45);
    cursor: pointer;
    text-decoration: none;
    border: none;
    /* starts off-screen to the right */
    transform: translateX(100px) scale(0.5);
    opacity: 0;
    transition: transform .55s cubic-bezier(.34,1.56,.64,1), opacity .4s ease, box-shadow .2s ease;
  }
  .wa-btn.visible {
    transform: translateX(0) scale(1);
    opacity: 1;
  }
  .wa-btn:hover {
    box-shadow: 0 10px 36px rgba(37,211,102,0.6);
    transform: translateX(0) scale(1.08) !important;
  }
  .wa-btn svg { width: 32px; height: 32px; }

  /* Pulse ring */
  .wa-btn::before {
    content: '';
    position: absolute;
    width: 60px; height: 60px;
    border-radius: 50%;
    background: rgba(37,211,102,0.35);
    animation: wa-pulse 2.2s ease-out infinite;
    animation-play-state: paused;
  }
  .wa-btn.visible::before { animation-play-state: running; }
  @keyframes wa-pulse {
    0%   { transform: scale(1);   opacity: .7; }
    70%  { transform: scale(1.7); opacity: 0;  }
    100% { transform: scale(1.7); opacity: 0;  }
  }
</style>

<div class="wa-wrap" id="waWrap">
  <div class="wa-tooltip" id="waTooltip">💬 Rabta karein — WhatsApp per</div>
  <a class="wa-btn" id="waBtn"
     href="https://wa.me/923000358189?text=Hello%21%20SchoolMS%20ke%20baare%20mein%20maloomat%20chahiye."
     target="_blank" rel="noopener" aria-label="WhatsApp per rabta karein">
    <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" fill="white">
      <path d="M16.003 2.667C8.637 2.667 2.667 8.637 2.667 16c0 2.363.63 4.59 1.73 6.52L2.667 29.333l6.987-1.697A13.28 13.28 0 0 0 16.003 29.333C23.37 29.333 29.333 23.363 29.333 16S23.37 2.667 16.003 2.667zm0 2.4c5.987 0 10.93 4.943 10.93 10.933S21.99 26.933 16.003 26.933a10.9 10.9 0 0 1-5.587-1.527l-.4-.24-4.147 1.007.997-3.987-.267-.413A10.88 10.88 0 0 1 5.073 16c0-5.99 4.94-10.933 10.93-10.933zm-3.47 5.773c-.2 0-.52.08-.793.373-.273.293-1.04 1.013-1.04 2.48s1.067 2.88 1.213 3.08c.147.2 2.08 3.253 5.08 4.44 2.52.993 3.033.793 3.58.747.547-.047 1.76-.72 2.013-1.413.253-.693.253-1.287.173-1.413-.08-.107-.28-.187-.587-.333-.307-.147-1.76-.867-2.04-.967-.28-.1-.48-.147-.68.147-.2.293-.773.967-.947 1.16-.173.2-.347.22-.653.073-.307-.147-1.293-.477-2.467-1.52-.91-.813-1.527-1.813-1.707-2.12-.173-.307-.013-.473.133-.62.133-.133.307-.347.453-.52.147-.173.2-.293.307-.493.107-.2.053-.373-.027-.52-.08-.147-.68-1.647-.947-2.24-.253-.587-.507-.493-.693-.507-.187-.013-.4-.013-.613-.013z"/>
    </svg>
  </a>
</div>

<script>
(function () {
  var btn  = document.getElementById('waBtn');
  var tip  = document.getElementById('waTooltip');
  var shown = false;

  /* ── Pop sound via Web Audio API (no file needed) ── */
  function playPop() {
    try {
      var ctx = new (window.AudioContext || window.webkitAudioContext)();
      /* Layer 1 – quick click */
      var osc1 = ctx.createOscillator();
      var gain1 = ctx.createGain();
      osc1.connect(gain1); gain1.connect(ctx.destination);
      osc1.type = 'sine';
      osc1.frequency.setValueAtTime(520, ctx.currentTime);
      osc1.frequency.exponentialRampToValueAtTime(260, ctx.currentTime + 0.12);
      gain1.gain.setValueAtTime(0.55, ctx.currentTime);
      gain1.gain.exponentialRampToValueAtTime(0.001, ctx.currentTime + 0.18);
      osc1.start(ctx.currentTime);
      osc1.stop(ctx.currentTime + 0.18);

      /* Layer 2 – soft body */
      var osc2 = ctx.createOscillator();
      var gain2 = ctx.createGain();
      osc2.connect(gain2); gain2.connect(ctx.destination);
      osc2.type = 'triangle';
      osc2.frequency.setValueAtTime(300, ctx.currentTime + 0.03);
      osc2.frequency.exponentialRampToValueAtTime(140, ctx.currentTime + 0.22);
      gain2.gain.setValueAtTime(0.3, ctx.currentTime + 0.03);
      gain2.gain.exponentialRampToValueAtTime(0.001, ctx.currentTime + 0.22);
      osc2.start(ctx.currentTime + 0.03);
      osc2.stop(ctx.currentTime + 0.22);
    } catch (e) { /* audio not available — silent fallback */ }
  }

  /* ── Show button after 2.5 s ── */
  setTimeout(function () {
    if (shown) return;
    shown = true;
    btn.classList.add('visible');
    playPop();

    /* Show tooltip 0.8 s after button appears */
    setTimeout(function () {
      tip.classList.add('show');
    }, 800);

    /* Auto-hide tooltip after 5 s */
    setTimeout(function () {
      tip.classList.remove('show');
    }, 5800);
  }, 2500);

  /* Re-show tooltip on hover */
  btn.addEventListener('mouseenter', function () { tip.classList.add('show'); });
  btn.addEventListener('mouseleave', function () {
    setTimeout(function () { tip.classList.remove('show'); }, 1500);
  });
})();
</script>
</body>
</html>
