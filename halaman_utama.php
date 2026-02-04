<style>
/* ================= ROOT THEME ================= */
:root {
    --main-color: #2563eb;
    --dark-color: #1e3a8a;
    --soft-color: #f8fafc;
    --glass: rgba(255,255,255,0.18);
    --glossy: linear-gradient(135deg, #1d4ed8, #3b82f6);
    --glow: 0 0 30px rgba(59, 130, 246, 0.55);
}

/* ================= GLOBAL ================= */
* {
    transition: 
        background-color 0.35s ease,
        box-shadow 0.35s ease,
        transform 0.35s ease,
        color 0.25s ease;
}

body {
    background-color: var(--soft-color);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

/* ================= NAVBAR ================= */
.navbar {
    background: linear-gradient(135deg, #1e40af, #3b82f6) !important;
    box-shadow: 
        0 8px 22px rgba(30, 64, 175, 0.45),
        inset 0 -1px 0 rgba(255,255,255,0.25);
    backdrop-filter: blur(6px);
}

.navbar .nav-link,
.navbar .navbar-brand {
    color: #fff !important;
    font-weight: 600;
    position: relative;
}

.navbar .nav-link::after {
    content: "";
    position: absolute;
    left: 50%;
    bottom: -6px;
    width: 0;
    height: 3px;
    background: #fff;
    border-radius: 10px;
    transform: translateX(-50%);
}

.navbar .nav-link:hover::after {
    width: 100%;
}

.navbar .nav-link:hover {
    transform: translateY(-2px);
    color: #e0e7ff !important;
}

/* ================= HERO ================= */
.hero-lilac {
    background: linear-gradient(135deg, #1e3a8a, #2563eb, #3b82f6);
    color: white;
    padding: 90px 20px;
    border-radius: 0 0 70px 70px;
    box-shadow: 
        0 20px 45px rgba(37, 99, 235, 0.45),
        inset 0 -20px 60px rgba(0,0,0,0.15);
    position: relative;
    overflow: hidden;
}

.hero-lilac::after {
    content: "";
    position: absolute;
    inset: 0;
    background: radial-gradient(circle at top right, rgba(255,255,255,0.25), transparent 60%);
}

.hero-lilac img {
    border: 6px solid rgba(255,255,255,0.6);
    margin-bottom: 20px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.25);
}

.hero-lilac h1 {
    font-weight: 900;
    font-size: 3rem;
    letter-spacing: 0.6px;
}

.hero-lilac p {
    max-width: 620px;
    margin: auto;
    font-size: 1.15rem;
    opacity: 0.95;
}

/* ================= BUTTON ================= */
.btn-success {
    background: var(--glossy);
    border: none;
    font-weight: 800;
    border-radius: 16px;
    padding: 13px 30px;
    box-shadow: 0 10px 26px rgba(37, 99, 235, 0.45);
    position: relative;
    overflow: hidden;
}

.btn-success::before {
    content: "";
    position: absolute;
    inset: 0;
    background: linear-gradient(120deg, transparent, rgba(255,255,255,0.5), transparent);
    transform: translateX(-100%);
}

.btn-success:hover::before {
    transform: translateX(100%);
}

.btn-success:hover {
    transform: translateY(-5px) scale(1.05);
    box-shadow: 0 18px 38px rgba(37, 99, 235, 0.65);
}

/* ================= STATISTIK ================= */
.stat-box {
    background: #ffffff;
    border-radius: 22px;
    padding: 30px 25px;
    box-shadow: 0 14px 30px rgba(37, 99, 235, 0.25);
    position: relative;
    overflow: hidden;
    border-left: 6px solid var(--main-color);
}

.stat-box::before {
    content: "";
    position: absolute;
    inset: 0;
    background: linear-gradient(120deg, transparent, rgba(37,99,235,0.1), transparent);
}

.stat-box:hover {
    transform: translateY(-8px);
}

.stat-box h3 {
    font-weight: 900;
    font-size: 2.4rem;
    color: var(--dark-color);
}

/* ================= CARD FITUR ================= */
section.py-5 .card {
    border-radius: 24px;
    border: none;
    background: #ffffff;
    box-shadow: 0 14px 32px rgba(30, 64, 175, 0.22);
    position: relative;
    overflow: hidden;
    backdrop-filter: blur(8px);
}

section.py-5 .card::before {
    content: "";
    position: absolute;
    width: 100%;
    height: 7px;
    background: var(--glossy);
    top: 0;
    left: 0;
}

section.py-5 .card::after {
    content: "";
    position: absolute;
    inset: 0;
    border-radius: 24px;
    box-shadow: inset 0 0 0 1px rgba(255,255,255,0.4);
}

section.py-5 .card:hover {
    transform: translateY(-14px) scale(1.03);
    box-shadow: 0 22px 45px rgba(30, 64, 175, 0.35);
}

section.py-5 .card-title {
    font-weight: 800;
    color: var(--dark-color);
}

/* ================= ALUR / STEP ================= */
section.bg-light.py-5 {
    background: #f8fafc !important;
}

section.bg-light.py-5 .col-md-3 {
    background: #ffffff;
    border-radius: 20px;
    padding: 26px 18px;
    box-shadow: 0 12px 26px rgba(30, 64, 175, 0.22);
    font-weight: 700;
    color: var(--dark-color);
    text-align: center;
    cursor: pointer;
    position: relative;
}

section.bg-light.py-5 .col-md-3::after {
    content: "";
    position: absolute;
    inset: 0;
    border-radius: 20px;
    box-shadow: inset 0 0 0 2px rgba(37,99,235,0.25);
}

section.bg-light.py-5 .col-md-3:hover {
    background: linear-gradient(135deg, #eef2ff, #ffffff);
    transform: translateY(-10px) scale(1.06);
}

/* ================= FOOTER ================= */
footer {
    background: linear-gradient(135deg, #1e3a8a, #2563eb);
    color: white;
    box-shadow: 0 -6px 18px rgba(37, 99, 235, 0.35);
}

footer a {
    color: #e0e7ff;
    font-weight: 600;
    opacity: 0.85;
}

footer a:hover {
    color: #ffffff;
    opacity: 1;
    text-decoration: underline;
}
</style>
