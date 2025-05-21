<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    
    <style>
        /* Base Layout Styles */
        body {
            font-family: 'Poppins', sans-serif;
            color: #333;
            overflow-x: hidden;
            line-height: 1.5;
        }

        #app {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        main {
            flex: 1;
        }
        
        /* Navigation Styles */
        #mainNav {
            transition: background-color 0.3s ease;
            background-color: transparent;
            padding-top: 1rem;
            padding-bottom: 1rem;
            position: fixed;
            top: 0;
            right: 0;
            left: 0;
            z-index: 1030;
        }

        #mainNav.scrolled {
            background-color: rgba(74, 0, 128, 0.95);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
        }

        .navbar-brand {
            font-size: 1.5rem;
            letter-spacing: 1px;
            font-weight: 600;
            color: #fff !important;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.8) !important;
            padding: 0.5rem 1rem !important;
            transition: color 0.3s ease, transform 0.3s ease;
            position: relative;
            font-weight: 400;
        }

        .nav-link:hover, .nav-link.active {
            color: #fff !important;
            transform: translateY(-2px);
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background-color: #fff;
            transition: width 0.3s ease, left 0.3s ease;
        }

        .nav-link:hover::after, .nav-link.active::after {
            width: 80%;
            left: 10%;
        }

        .navbar-toggler {
            border: 1px solid rgba(255, 255, 255, 0.5);
            padding: 0.25rem 0.5rem;
        }

        .navbar-toggler:focus {
            box-shadow: 0 0 0 0.1rem rgba(255, 255, 255, 0.25);
        }
        
        /* Hero Section Styles */
        .hero-section {
            position: relative;
            height: 100vh;
            min-height: 700px;
            background: linear-gradient(135deg, #4a0080 0%, #7a1cc9 50%, #9b36ff 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            overflow: hidden;
            margin-top: 0;
            padding-top: 76px;
        }

        .hero-title {
            font-size: 4.5rem;
            font-weight: 700;
            letter-spacing: 3px;
            margin-bottom: 0.5rem;
            text-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            animation: fadeInDown 1s ease-out;
        }

        .hero-subtitle {
            font-size: 1.75rem;
            font-weight: 300;
            letter-spacing: 2px;
            margin-bottom: 1.5rem;
            opacity: 0.9;
            animation: fadeInUp 1s ease-out 0.3s;
            animation-fill-mode: both;
        }

        .hero-text {
            font-size: 1.125rem;
            max-width: 600px;
            margin: 0 auto 2rem;
            opacity: 0.8;
            animation: fadeInUp 1s ease-out 0.6s;
            animation-fill-mode: both;
        }

        .light-orb {
            position: absolute;
            top: 20%;
            left: 15%;
            width: 150px;
            height: 150px;
            background: radial-gradient(circle, rgba(255,255,255,0.8) 0%, rgba(255,194,255,0.4) 40%, rgba(156,111,255,0) 70%);
            border-radius: 50%;
            filter: blur(10px);
            animation: pulse 6s infinite ease-in-out;
        }

        .mountain-silhouette {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 30%;
            background-image: url('https://images.pexels.com/photos/772803/pexels-photo-772803.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940');
            background-size: cover;
            background-position: center;
            -webkit-mask-image: linear-gradient(to top, rgba(0,0,0,1), rgba(0,0,0,0));
            mask-image: linear-gradient(to top, rgba(0,0,0,1), rgba(0,0,0,0));
            opacity: 0.8;
        }

        /* Button Styles */
        .btn {
            transition: all 0.3s ease;
            border-radius: 50px;
            font-weight: 500;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            font-size: 0.875rem;
        }

        .btn-join {
            background-color: #fff;
            color: #7a1cc9;
            border: 2px solid #fff;
            font-weight: 600;
            padding: 0.75rem 2rem !important;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            animation: fadeInUp 1s ease-out 0.9s;
            animation-fill-mode: both;
        }

        .btn-join:hover {
            background-color: transparent;
            color: #fff;
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.25);
        }
        
        /* Features Section */
        .features {
            padding: 5rem 0;
            background-color: #f8f9fa;
        }
        
        .section-title {
            font-weight: 600;
            font-size: 2.25rem;
            margin-bottom: 0.5rem;
            color: #4a0080;
        }

        .section-subtitle {
            font-size: 1.125rem;
            color: #7a1cc9;
            margin-bottom: 2rem;
        }

        .feature-card {
            background-color: #fff;
            border-radius: 1rem;
            padding: 2rem;
            height: 100%;
            box-shadow: 0 8px 24px rgba(149, 157, 165, 0.1);
            transition: all 0.3s ease;
        }
        
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 30px rgba(149, 157, 165, 0.2);
        }

        .feature-icon {
            font-size: 2.5rem;
            color: #7a1cc9;
            background: linear-gradient(135deg, #4a0080 0%, #9b36ff 100%);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .feature-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #4a0080;
            margin-bottom: 1rem;
        }

        .feature-text {
            color: #6c757d;
            font-size: 1rem;
        }
        
        /* Footer Styles */
        footer {
            background-color: #4a0080;
            color: #fff;
            padding: 4rem 0 2rem;
        }
        
        footer h5 {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            position: relative;
        }
        
        footer h5::after {
            content: '';
            position: absolute;
            bottom: -0.5rem;
            left: 0;
            width: 40px;
            height: 3px;
            background-color: #9b36ff;
        }
        
        .footer-link {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            transition: all 0.3s ease;
            display: block;
            margin-bottom: 0.5rem;
        }
        
        .footer-link:hover {
            color: #fff;
            transform: translateX(5px);
        }
        
        .social-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.1);
            color: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            transition: all 0.3s ease;
            text-decoration: none;
        }
        
        .social-icon:hover {
            background-color: rgba(255, 255, 255, 0.2);
            color: #fff;
            transform: translateY(-3px);
        }
        
        /* Animations */
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes pulse {
            0% {
                transform: scale(1);
                opacity: 0.8;
            }
            50% {
                transform: scale(1.1);
                opacity: 1;
            }
            100% {
                transform: scale(1);
                opacity: 0.8;
            }
        }
        
        /* Responsive Breakpoints */
        @media (max-width: 1200px) {
            .hero-title {
                font-size: 4rem;
            }
        }
        
        @media (max-width: 992px) {
            .hero-title {
                font-size: 3.5rem;
            }
            
            .hero-subtitle {
                font-size: 1.5rem;
            }
            
            #mainNav .navbar-collapse {
                background-color: rgba(74, 0, 128, 0.95);
                border-radius: 0.5rem;
                padding: 1rem;
                margin-top: 0.5rem;
            }
            
            .nav-link::after {
                display: none;
            }
            
            .nav-link:hover, .nav-link.active {
                transform: none;
                padding-left: 1.25rem !important;
            }
        }
        
        @media (max-width: 768px) {
            .hero-title {
                font-size: 3rem;
            }
            
            .hero-subtitle {
                font-size: 1.25rem;
            }
            
            .hero-text {
                font-size: 1rem;
            }
            
            .section-title {
                font-size: 1.75rem;
            }
            
            .section-subtitle {
                font-size: 1rem;
            }
            
            .light-orb {
                width: 100px;
                height: 100px;
            }
        }
        
        @media (max-width: 576px) {
            .hero-title {
                font-size: 2.5rem;
            }
            
            .hero-section {
                min-height: 600px;
            }
            
            .feature-card {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div id="app">
        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-dark" id="mainNav">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <span class="fw-bold">USER MANAGEMENT</span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" 
                        aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('login') }}">LOGIN</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">REGISTER</a>
                        </li>
                       
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        
        <main>
            <!-- Hero Section -->
            <div class="hero-section">
                <div class="light-orb"></div>
                <div class="container h-100">
                    <div class="row h-100 align-items-center">
                        <div class="col-12 text-center">
                            <h1 class="hero-title">
                                WELCOME
                                
                            </h1>
                           
                        </div>
                    </div>
                </div>
                <div class="mountain-silhouette"></div>
            </div>

         
        </main>
        
       
    </div>
    
    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JavaScript -->
    <script>
        // Navbar scroll behavior
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('mainNav');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    </script>
</body>
</html>