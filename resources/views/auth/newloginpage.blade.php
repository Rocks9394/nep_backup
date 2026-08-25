<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>GoForFit · Login</title>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,400;14..32,500;14..32,600;14..32,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />

    <style>
        /* ===== BRAND COLORS ===== */
        :root {
            --brand-primary: #232271;
            --brand-primary-light: #3a3898;
            --brand-accent: #ff7300;
            --brand-accent-light: #ffa64d;
            --brand-white: #ffffff;
        }

        /* ============================================================
               RESET & BODY — ANIMATED GRADIENT
               ============================================================ */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
             min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0.5rem;
            margin: 0;
            background: linear-gradient(-45deg, #0b0a2e, #232271, #4a1a6b, #ff7300);
            background-size: 300% 300%;
            animation: gradientShift 10s ease infinite;
            position: relative;
            overflow-x: hidden;
        }

        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            25% { background-position: 50% 0%; }
            50% { background-position: 100% 50%; }
            75% { background-position: 50% 100%; }
            100% { background-position: 0% 50%; }
        }

        /* ============================================================
               ANIMATED ORBS (visible through the glass form)
               ============================================================ */
        .orb {
            position: fixed;
            border-radius: 50%;
            filter: blur(100px);
            opacity: 0.7;
            pointer-events: none;
            z-index: 0;
            will-change: transform;
        }

        .orb-1 {
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, #ff7300, #ffa64d);
            top: -15%;
            left: -10%;
            animation: orbFloat1 14s ease-in-out infinite alternate;
        }

        .orb-2 {
            width: 700px;
            height: 700px;
            background: radial-gradient(circle, #3a3898, #232271);
            bottom: -20%;
            right: -10%;
            animation: orbFloat2 16s ease-in-out infinite alternate;
        }

        .orb-3 {
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, #ffa64d, #ff7300);
            top: 50%;
            left: 50%;
            transform: translateX(-50%);
            animation: orbFloat3 12s ease-in-out infinite alternate;
        }

        @keyframes orbFloat1 {
            0% { transform: translate(0, 0) scale(1); }
            100% { transform: translate(120px, 80px) scale(1.2); }
        }

        @keyframes orbFloat2 {
            0% { transform: translate(0, 0) scale(1); }
            100% { transform: translate(-150px, -100px) scale(1.3); }
        }

        @keyframes orbFloat3 {
            0% { transform: translateX(-50%) translateY(0) scale(1); }
            100% { transform: translateX(-50%) translateY(-60px) scale(1.4); }
        }

        /* ============================================================
               FLOATING GEOMETRIC SHAPES (background layer)
               ============================================================ */
        .shape {
            position: fixed;
            border-radius: 50%;
            border: 2px solid rgba(255, 255, 255, 0.15);
            background: transparent;
            pointer-events: none;
            z-index: 0;
            animation: shapeDrift 25s linear infinite alternate;
            will-change: transform;
        }

        .shape-1 {
            width: 250px;
            height: 250px;
            top: 15%;
            right: 5%;
            border-color: rgba(255, 166, 77, 0.3);
            animation-duration: 20s;
        }

        .shape-2 {
            width: 150px;
            height: 150px;
            bottom: 20%;
            left: 3%;
            border-color: rgba(58, 56, 152, 0.4);
            animation-duration: 24s;
            animation-delay: 2s;
        }

        .shape-3 {
            width: 100px;
            height: 100px;
            top: 60%;
            left: 30%;
            border: 3px solid rgba(255, 115, 0, 0.25);
            animation-duration: 18s;
            animation-delay: 4s;
        }

        @keyframes shapeDrift {
            0% { transform: translate(0, 0) rotate(0deg); }
            33% { transform: translate(80px, -50px) rotate(120deg); }
            66% { transform: translate(-40px, 60px) rotate(240deg); }
            100% { transform: translate(30px, -30px) rotate(360deg); }
        }

        /* ============================================================
               LOGIN CONTAINER — Glass effect
               ============================================================ */
        .login-container {
            max-width: 1200px;
            width: 100%;
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border-radius: 15px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            overflow: hidden;
            position: relative;
            z-index: 1;
            box-shadow: 0 30px 80px rgba(0, 0, 0, 0.4), 0 0 0 1px rgba(255, 255, 255, 0.2);
            animation: containerIn 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            transform: translateY(30px) scale(0.96);
            opacity: 0;
        }

        @keyframes containerIn {
            0% { transform: translateY(40px) scale(0.94); opacity: 0; }
            100% { transform: translateY(0) scale(1); opacity: 1; }
        }

        /* ============================================================
               LEFT PANEL — Brand Section
               ============================================================ */
        .login-brand {
            background: linear-gradient(145deg, var(--brand-primary) 0%, var(--brand-primary-light) 100%);
            padding: 3rem 2.5rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            color: white;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .brand-shapes {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 0;
            overflow: hidden;
        }

        .brand-shapes div {
            position: absolute;
            border-radius: 50%;
            will-change: transform, opacity;
        }

        .brand-shape-1 {
            width: 220px;
            height: 220px;
            background: radial-gradient(circle, rgba(255, 115, 0, 0.25), rgba(255, 115, 0, 0.05));
            top: -60px;
            right: -40px;
            animation: floatShape1 7s ease-in-out infinite alternate;
        }

        .brand-shape-2 {
            width: 160px;
            height: 160px;
            border: 2px solid rgba(255, 166, 77, 0.3);
            bottom: -40px;
            left: -40px;
            animation: floatShape2 9s ease-in-out infinite alternate-reverse;
        }

        .brand-shape-3 {
            width: 120px;
            height: 120px;
            background: radial-gradient(circle at 30% 30%, rgba(255, 255, 255, 0.08) 20%, transparent 70%);
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            animation: pulseShape 5s ease-in-out infinite alternate;
        }

        .brand-shape-4 {
            width: 80px;
            height: 80px;
            background: rgba(255, 166, 77, 0.15);
            bottom: 30%;
            right: 10%;
            animation: floatShape1 6s ease-in-out infinite alternate-reverse;
        }

        @keyframes floatShape1 {
            0% { transform: translate(0, 0) rotate(0deg); }
            100% { transform: translate(30px, 30px) rotate(15deg); }
        }

        @keyframes floatShape2 {
            0% { transform: translate(0, 0) rotate(0deg) scale(1); }
            100% { transform: translate(-20px, -20px) rotate(-15deg) scale(1.1); }
        }

        @keyframes pulseShape {
            0% { transform: translate(-50%, -50%) scale(0.8); opacity: 0.4; }
            100% { transform: translate(-50%, -50%) scale(1.4); opacity: 1; }
        }

        .brand-icon {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 2.5rem;
            position: relative;
            z-index: 1;
        }

        .brand-icon img {
            max-width: 220px;
            height: auto;
            display: block;
        }

        .brand-tagline {
            font-size: 1.1rem;
            font-weight: 500;
            line-height: 1.5;
            max-width: 90%;
            margin-bottom: 1.5rem;
            opacity: 0.95;
            color: #f0eefb;
            position: relative;
            z-index: 1;
        }

        .brand-highlights {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            margin-top: 1rem;
            position: relative;
            z-index: 1;
        }

        .highlight-item {
            display: flex;
            align-items: center;
            gap: 0.9rem;
            background: rgba(255, 255, 255, 0.08);
            padding: 0.9rem 1.4rem;
            border-radius: 60px;
            backdrop-filter: blur(4px);
            border: 1px solid rgba(255, 255, 255, 0.06);
            font-weight: 500;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .highlight-item:hover {
            background: rgba(255, 255, 255, 0.15);
            transform: translateX(8px);
        }

        .highlight-item i {
            font-size: 1.2rem;
            color: var(--brand-accent-light);
            width: 1.6rem;
            text-align: center;
        }
        .highlight-item span { color: #eae8fc; }
        .highlight-item strong { color: white; font-weight: 600; }

        .brand-quote {
            margin-top: 2.8rem;
            font-size: 0.9rem;
            opacity: 0.8;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 1.8rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #d4d0f0;
            position: relative;
            z-index: 1;
        }
        .brand-quote i { color: var(--brand-accent-light); }

        /* ============================================================
               RIGHT PANEL — Login Form
               ============================================================ */
        .login-form {
            padding: 0rem 2.8rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: transparent;
            position: relative;
            z-index: 1;
        }

        .mobile-logo {
            display: none;
            text-align: center;
            margin-bottom: 1.8rem;
        }
        .mobile-logo img {
            max-width: 180px;
            height: auto;
            margin: 0 auto;
        }

        .form-header h2 {
            font-size: 2rem;
            font-weight: 700;
            color: var(--brand-primary);
            margin-bottom: 0.4rem;
             text-align: center;
        }
        .form-header p {
            color: #5f5f7a;
            font-size: 0.95rem;
             text-align: center;

        }
        .form-header p a {
            color: var(--brand-accent);
            font-weight: 600;
            text-decoration: none;
            border-bottom: 1.5px solid #fddbb5;
            transition: border 0.2s;
        }
        .form-header p a:hover { border-bottom-color: var(--brand-accent); }

        .input-group {
            margin-bottom: 1.2rem;
            position: relative;
        }
        .input-group label {
            display: block;
            font-weight: 600;
            font-size: 0.85rem;
            color: var(--brand-primary);
            margin-bottom: 0.4rem;
        }
        .input-group .input-icon {
            position: relative;
        }
        .input-group .input-icon i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #8a8aa8;
            font-size: 1.1rem;
            z-index: 2;
            transition: color 0.2s;
        }
        .input-group input,
        .input-group select {
            width: 100%;
            padding: 0.85rem 1rem 0.85rem 2.8rem;
            font-size: 0.95rem;
            border: 1.5px solid rgba(0, 0, 0, 0.08);
            border-radius: 60px;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(4px);
            transition: all 0.2s;
            font-family: 'Inter', sans-serif;
            font-weight: 500;
            color: var(--brand-primary);
            appearance: none;
            -webkit-appearance: none;
        }
        .input-group select {
            cursor: pointer;
            padding-right: 3rem;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%238a8aa8' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1.2rem center;
            background-size: 1.2rem;
        }
        .input-group input:focus,
        .input-group select:focus {
            outline: none;
            border-color: var(--brand-accent);
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 0 0 4px rgba(255, 148, 41, 0.12);
        }
        .input-group .toggle-password {
            position: absolute;
            right: 3rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #8a8aa8;
            font-size: 1rem;
            cursor: pointer;
            padding: 0.2rem;
            z-index: 2;
        }
        .input-group .toggle-password:hover { color: var(--brand-primary); }
        .input-group .input-icon:focus-within i { color: var(--brand-accent); }

        /* ============================================================
               CAPTCHA STYLING
               ============================================================ */


        /* Custom reCAPTCHA Widget Styling */
.recaptcha-widget {
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: #ffffff;
    border: 1px solid #d3d3d3;
    border-radius: 60px; /* Rounded capsule look to match your screenshot */
    padding: 0.6rem 1.2rem;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
    user-select: none;
    height:54px;
}

.recaptcha-checkbox-wrapper {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.recaptcha-checkbox-wrapper input[type="checkbox"] {
    appearance: auto !important;
    -webkit-appearance: checkbox !important;
    width: 22px !important;
    height: 22px !important;
    cursor: pointer;
    margin: 0 !important;
    padding: 0 !important;
    accent-color: #232271;
}

.recaptcha-label {
    font-size: 0.88rem;
    font-weight: 500;
    color: #222222;
    cursor: pointer;
    margin-bottom: 0 !important; /* Overrides input-group label styles */
}

.recaptcha-brand {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    line-height: 1;
}

.recaptcha-logo {
    width: 20px;
    height: 20px;
    margin-bottom: 2px;
}

.recaptcha-title {
    font-size: 0.55rem;
    color: #555555;
    font-weight: 600;
    letter-spacing: 0.2px;
}

.recaptcha-links {
    font-size: 0.52rem;
    color: #777777;
    margin-top: 2px;
    display: flex;
    gap: 3px;
}

.recaptcha-links a {
    color: #555555;
    text-decoration: none;
}

.recaptcha-links a:hover {
    text-decoration: underline;
}

        



        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 0.4rem 0 1.5rem;
        }
        .form-options .remember {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.9rem;
            color: var(--brand-primary);
            font-weight: 500;
            cursor: pointer;
        }
        .form-options .remember input[type="checkbox"] {
            width: 1.1rem;
            height: 1.1rem;
            accent-color: var(--brand-accent);
            cursor: pointer;
        }
        .form-options .forgot-link {
            color: var(--brand-accent);
            font-weight: 600;
            font-size: 0.9rem;
            text-decoration: none;
            border-bottom: 1.5px solid transparent;
            transition: border 0.2s;
        }
        .form-options .forgot-link:hover { border-bottom-color: var(--brand-accent); }

        .btn-login {
            background: linear-gradient(135deg, var(--brand-primary) 0%, var(--brand-accent) 100%);
            width: 100%;
            border: none;
            padding: 1rem;
            border-radius: 60px;
            font-weight: 700;
            font-size: 1rem;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.7rem;
            cursor: pointer;
            transition: all 0.25s ease;
            box-shadow: 0 6px 20px rgba(41, 39, 117, 0.35);
            font-family: 'Inter', sans-serif;
            margin-top: 0.2rem;
            position: relative;
            overflow: hidden;
        }
        .btn-login::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle at 30% 30%, rgba(255,255,255,0.15), transparent 60%);
            opacity: 0;
            transition: opacity 0.4s;
            pointer-events: none;
        }
        .btn-login:hover::after { opacity: 1; }
        .btn-login:hover {
            transform: scale(1.02);
            box-shadow: 0 10px 30px rgba(41, 39, 117, 0.45);
        }
        .btn-login:hover i { transform: translateX(4px); }
        .btn-login i { transition: transform 0.2s; }

        /* ============================================================
               RESPONSIVE — MOBILE ONLY (SHOW LOGO + FORM ONLY)
               ============================================================ */

        @media (max-width: 820px) {
            .orb, .shape {
                display: none !important;
            }

            body {
                padding: 1rem;
                background: linear-gradient(135deg, #0b0a2e 0%, #232271 60%, #4a1a6b 100%);
            }

            .login-container {
                grid-template-columns: 1fr;
                max-width: 460px;
                border-radius: 24px;
                background: rgba(255, 255, 255, 0.92);
                box-shadow: 0 20px 50px rgba(0, 0, 0, 0.35);
            }

            .login-brand {
                display: none !important;
            }

            .mobile-logo {
                display: block;
            }

            .login-form {
                padding: 2.2rem 1.8rem;
            }
        }

        @media (max-width: 480px) {
            body {
                padding: 0rem;
                  min-height: 90vh;
            }
            .login-container {
                border-radius: 0px;
            }
            .login-form {
                /*padding: 4.8rem 1.25rem;*/
                padding: 2.2rem 1.8rem;
            }

            .form-header h2 {
                font-size: 1.0rem; display: none;
            }
            .form-header p {
                font-size: 0.88rem;
                margin-bottom: 25px; 
            }
            .btn-login {
                padding: 0.85rem;
                font-size: 0.95rem;
            }
            .input-group input,
            .input-group select {
                padding: 0.8rem 1rem 0.8rem 2.6rem;
                font-size: 0.9rem;
            }
            .mobile-logo img {
                max-width: 155px;
            }
            .mobile-logo{
               margin-bottom: 1px;
            }
            .form-options {
                font-size: 0.85rem;
            }
            .captcha-box {
                font-size: 1.1rem;
                padding: 0.65rem 0.9rem;
            }
        }
    </style>
</head>
<body>

    <!-- ===== ANIMATED BACKGROUND ELEMENTS (Desktop only) ===== -->
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
    <div class="orb orb-3"></div>
    <div class="shape shape-1"></div>
    <div class="shape shape-2"></div>
    <div class="shape shape-3"></div>

    <!-- ===== LOGIN CONTAINER ===== -->
    <div class="login-container">

        <!-- LEFT PANEL — Hidden on mobile -->
        <div class="login-brand">
            <div class="brand-shapes">
                <div class="brand-shape-1"></div>
                <div class="brand-shape-2"></div>
                <div class="brand-shape-3"></div>
                <div class="brand-shape-4"></div>
            </div>

            <div class="brand-icon">
                <a href="{{ url('/') }}"><img src="{{ asset('logo/brand-logo.png') }}" alt="GoForFit Logo" /></a>
            </div>

            <div class="brand-tagline">
                Empowering Schools, Principals, and Parents with AI-powered daily tracking, actionable insights, and holistic health data for every child.
            </div>

            <div class="brand-highlights">
                <div class="highlight-item">
                    <i class="fas fa-brain"></i>
                    <span><strong>AI insights</strong> · real-time</span>
                </div>
                <div class="highlight-item">
                    <i class="fas fa-chart-line"></i>
                    <span><strong>Holistic health</strong> · daily tracking</span>
                </div>
                <div class="highlight-item">
                    <i class="fas fa-users"></i>
                    <span><strong>For schools, principals &amp; parents</strong></span>
                </div>
            </div>

            <div class="brand-quote">
                <i class="fas fa-quote-left"></i>
                <span>Active School. Active Communities</span>
            </div>
        </div>

        <!-- RIGHT PANEL — Form + Mobile Logo -->
        <div class="login-form">

            <!-- Mobile Logo (visible only on mobile) -->
            <div class="mobile-logo">
                <a href="{{ url('/') }}"><img src="{{ asset('logo/brand_logo.png') }}" alt="GoForFit Logo" /></a>
            </div>


            <div class="form-header">
                <h2>Welcome back</h2>
                 <p>Sign in to access your dashboard &nbsp;·&nbsp; <a href="#">need help?</a></p> 
            </div>
           
            <form id="loginForm" action="#" method="POST" style="margin-top: 1rem;">
                <!-- User Type -->
                <div class="input-group">
                    <label for="userType"><i class="fas fa-user-tag" style="margin-right: 6px;"></i> I am a</label>
                    <div class="input-icon">
                        <i class="fas fa-user-circle"></i>
                        <select id="userType" required>
                            <option value="" disabled selected>— Select your role —</option>
                            <option value="principal">👨‍🏫 Principal</option>
                            <option value="teacher">👩‍🏫 Teacher</option>
                            <option value="parent">👨‍👩‍👦 Parent</option>
                        </select>
                    </div>
                </div>

                <!-- Email -->
                <div class="input-group">
                    <label for="email"><i class="far fa-envelope" style="margin-right: 6px;"></i> Email address</label>
                    <div class="input-icon">
                        <i class="fas fa-envelope"></i>
                        <input type="email" id="email" placeholder="principal@school.edu" value="demo@school.edu" required />
                    </div>
                </div>

                <!-- Password -->
                <div class="input-group">
                    <label for="password"><i class="fas fa-lock" style="margin-right: 6px;"></i> Password</label>
                    <div class="input-icon">
                        <i class="fas fa-key"></i>
                        <input type="password" id="password" placeholder="••••••••" value="password123" required />
                        <button type="button" class="toggle-password" id="togglePassword" aria-label="Show password">
                            <i class="far fa-eye"></i>
                        </button>
                    </div>
                </div>


               <!-- CAPTCHA Field -->
                <div class="input-group">
                    <label for="recaptchaCheck"><i class="fas fa-shield-alt" style="margin-right: 6px;"></i> Security Verification</label>

                    <div class="recaptcha-widget">
                        <div class="recaptcha-checkbox-wrapper">
                            <input type="checkbox" id="recaptchaCheck" name="g-recaptcha-response" required>
                            <label for="recaptchaCheck" class="recaptcha-label">I'm not a robot</label>
                        </div>

                        <div class="recaptcha-brand">
                            <!-- Inline SVG reCAPTCHA Icon -->
                            <svg class="recaptcha-logo" viewBox="0 0 48 48" width="32" height="32">
                                <path fill="#4285F4" d="M24 8V0L14 10l10 10v-8c7.73 0 14 6.27 14 14 0 2.76-.8 5.33-2.18 7.51l4.41 4.41C42.84 34.52 44 29.5 44 24c0-11.05-8.95-20-20-20z"/>
                                <path fill="#000000" opacity="0.1" d="M24 40c-7.73 0-14-6.27-14-14 0-2.76.8-5.33 2.18-7.51l-4.41-4.41C5.16 17.48 4 22.5 4 28c0 11.05 8.95 20 20 20v-8z"/>
                                <path fill="#34A853" d="M24 40c-7.73 0-14-6.27-14-14 0-2.76.8-5.33 2.18-7.51l-4.41-4.41C5.16 17.48 4 22.5 4 28c0 11.05 8.95 20 20 20v-8z"/>
                            </svg>
                            <span class="recaptcha-title">reCAPTCHA</span>
                            <div class="recaptcha-links">
                                <a href="https://policies.google.com/privacy?hl=en" target="_blank" rel="noopener">Privacy</a>
                                <span>-</span>
                                <a href="https://policies.google.com/terms?hl=en" target="_blank" rel="noopener">Terms</a>
                            </div>
                        </div>
                    </div>

                    @if($errors->any())
                        @foreach ($errors->all() as $error)
                            <p class="error_message">{{ $error }}</p>
                        @endforeach
                    @endif

                    @if(session('status') === 'error')
                        <p class="error_message">
                            {{ session('msg') }}
                        </p>
                    @endif
                </div>


               {{--
                <div class="input-group">

                    <label for="captchaInput"><i class="fas fa-shield-alt" style="margin-right: 6px;"></i> Security Verification</label>

                    <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                        <div class="captcha-wrapper">
                            <input type="checkbox" aria-label="Checkbox captcha" name="g-recaptcha-response" required>
                            <img alt="captcha" src="{{ asset('assets/imgs/captcha-img.png') }}" class="img-fluid" usemap="#image-map">
                        </div>
                        <map name="image-map">
                           <area target="_blank" alt="Privacy" title="Privacy" href="https://policies.google.com/privacy?hl=en" coords="" shape="rect" class="m-p">
                           <area target="_blank" alt="Terms" title="Terms" href="https://policies.google.com/terms?hl=en" coords="" shape="rect" class="m-t">
                        </map>                       
                    </div>

                    @if($errors->any())
                       @foreach ($errors->all() as $error)
                          <p class="error_message">{{ $error }}</p>
                       @endforeach
                    @endif

                    @if(session('status') === 'error')
                        <p class="error_message">
                            {{ session('msg') }}
                        </p>
                    @endif
                </div> 
                --}}


                <!-- Options -->
                <div class="form-options">
                    <label class="remember">
                        <input type="checkbox" checked /> Remember me
                    </label>
                    <a href="#" class="forgot-link">Forgot password?</a>
                </div>

                <!-- Login button -->
                <button type="submit" class="btn-login">
                    <span>Sign in</span>
                    <i class="fas fa-arrow-right"></i>
                </button>
            </form>
        </div>
    </div>

    <!-- ===== SCRIPT ===== -->
    <script>
        (function() {
            let currentCaptcha = '';

            // Generate Random CAPTCHA
            function generateCaptcha() {
                const chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
                let code = '';
                for (let i = 0; i < 5; i++) {
                    code += chars.charAt(Math.floor(Math.random() * chars.length));
                }
                currentCaptcha = code;
                const captchaElem = document.getElementById('captchaCode');
                if (captchaElem) {
                    captchaElem.textContent = code;
                }
            }

            // Initial CAPTCHA Generation
            generateCaptcha();

            // Refresh CAPTCHA Event
            const refreshBtn = document.getElementById('refreshCaptcha');
            if (refreshBtn) {
                refreshBtn.addEventListener('click', generateCaptcha);
            }

            // Toggle password visibility
            const toggleBtn = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');
            if (toggleBtn && passwordInput) {
                toggleBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);
                    const icon = this.querySelector('i');
                    if (icon) {
                        icon.classList.toggle('fa-eye');
                        icon.classList.toggle('fa-eye-slash');
                    }
                });
            }



            // Form Submit Logic & CAPTCHA Validation
            const form = document.getElementById('loginForm');
            if (form) {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const email = document.getElementById('email').value.trim();
                    const pass = document.getElementById('password').value.trim();
                    const userType = document.getElementById('userType').value;
                   

                    if (!email || !pass) {
                        alert('⚠️ Please fill in both email and password.');
                        return;
                    }
                    if (!userType) {
                        alert('⚠️ Please select your user role.');
                        return;
                    }
                   

                    const roleMap = { 'principal': 'Principal', 'teacher': 'Teacher', 'parent': 'Parent' };
                    const roleText = roleMap[userType] || userType;

                    window.location.href = "https://nep.goforfit.in/new-dashboard";

                    console.log('✅ Login successful!\n\n' +
                        '👤 Role: ' + roleText + '\n' +
                        '📧 Email: ' + email + '\n\n' +
                        'Redirecting to dashboard …');
                });
            }
        })();
    </script>

</body>
</html>