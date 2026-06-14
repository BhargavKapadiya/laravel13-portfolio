@extends('layouts.app')

@section('title')
    Dashboard
@endsection

@section('css-bottom')
    <link rel="stylesheet" href="{{ Helper::assets('assets/vendor/css/pages/front-page-landing.css') }}" />
@endsection

@section('top-script')
    <script src="{{ Helper::assets('assets/vendor/js/dropdown-hover.js') }}"></script>
    <script src="{{ Helper::assets('assets/vendor/js/mega-dropdown.js') }}"></script>
@endsection

@section('content')
    <div data-bs-spy="scroll" class="scrollspy-example">
        <!-- Hero: Start -->
        <section id="hero-animation">
            <div id="landingHero" class="section-py landing-hero position-relative">
                <img src="{{ Helper::assets('assets/img/front-pages/backgrounds/hero-bg.png') }}" alt="hero background" class="position-absolute top-0 start-50 translate-middle-x object-fit-contain w-100 h-100" data-speed="1" />
                <div class="container">
                    <div class="hero-text-box text-center">
                        <h1 class="text-primary hero-title display-4 fw-bold">Projects built to impress, code written to last</h1>
                        <h2 class="hero-sub-title h6 mb-4 pb-1">
                            Production-ready & easy to use Project setup<br class="d-none d-lg-block" />
                            for Laravel 13.
                        </h2>
                        <div class="landing-hero-btn d-inline-block position-relative">
                            <span class="hero-btn-item position-absolute d-none d-md-flex text-heading">Let's connect
                                <img src="{{ Helper::assets('assets/img/front-pages/icons/Join-community-arrow.png') }}" alt="Join community arrow" class="scaleX-n1-rtl" /></span>
                            <a href="#landingPricing" class="btn btn-primary">View my work</a>
                        </div>
                    </div>
                    <div id="heroDashboardAnimation" class="hero-animation-img">
                        <a href="{{ route('admin') }}" target="_blank">
                            <div id="heroAnimationImg" class="position-relative hero-dashboard-img">
                                <img src="{{ Helper::assets('assets/img/front-pages/landing-page/hero-dashboard-light.png') }}" alt="hero dashboard" class="animation-img" data-app-light-img="front-pages/landing-page/hero-dashboard-light.png" data-app-dark-img="front-pages/landing-page/hero-dashboard-dark.png" />
                                {{-- <img src="{{ Helper::assets('assets/img/front-pages/landing-page/hero-elements-light.png') }}" alt="hero elements" class="position-absolute hero-elements-img animation-img top-0 start-0" data-app-light-img="front-pages/landing-page/hero-elements-light.png" data-app-dark-img="front-pages/landing-page/hero-elements-dark.png" /> --}}
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="landing-hero-blank"></div>
        </section>
        <!-- Hero: End -->

        <!-- Useful features: Start -->
        <section id="landingFeatures" class="section-py landing-features">
            <div class="container">
                <div class="text-center mb-3 pb-1">
                    <span class="badge bg-label-primary">Useful Features</span>
                </div>
                <h3 class="text-center mb-1">Built with Laravel 13, packed with real features</h3>
                <p class="text-center mb-3 mb-md-5 pb-3">
                    blog management, contact enquiries, and a powerful admin panel.
                </p>
                <div class="features-icon-wrapper row gx-0 gy-4 g-sm-5">
                    <div class="col-lg-4 col-sm-6 text-center features-icon-box">
                        <div class="text-center mb-3">
                            <img src="{{ Helper::assets('assets/img/front-pages/icons/laptop.png') }}" alt="laptop charging" />
                        </div>
                        <h5 class="mb-3">Quality Code</h5>
                        <p class="features-icon-description">
                            Code structure that all developers will easily understand and fall in love with.
                        </p>
                    </div>
                    <div class="col-lg-4 col-sm-6 text-center features-icon-box">
                        <div class="text-center mb-3">
                            <img src="{{ Helper::assets('assets/img/front-pages/icons/rocket.png') }}" alt="transition up" />
                        </div>
                        <h5 class="mb-3">Continuous Updates</h5>
                        <p class="features-icon-description">
                            Get free updates whenever a new Laravel version drops — no hassle, just pull and deploy.
                        </p>
                    </div>
                    <div class="col-lg-4 col-sm-6 text-center features-icon-box">
                        <div class="text-center mb-3">
                            <img src="{{ Helper::assets('assets/img/front-pages/icons/paper.png') }}" alt="edit" />
                        </div>
                        <h5 class="mb-3">Stater-Kit</h5>
                        <p class="features-icon-description">
                            I built this clean. <br> No unnecessary features, no clutter. <br>Just the tools I need to showcase my work.
                        </p>
                    </div>
                    <div class="col-lg-4 col-sm-6 text-center features-icon-box">
                        <div class="text-center mb-3">
                            <img src="{{ Helper::assets('assets/img/front-pages/icons/check.png') }}" alt="3d select solid" />
                        </div>
                        <h5 class="mb-3">API Ready</h5>
                        <p class="features-icon-description">
                            A ready-to-use Postman collection comes with the project — just import and start testing instantly.
                        </p>
                    </div>
                    <div class="col-lg-4 col-sm-6 text-center features-icon-box">
                        <div class="text-center mb-3">
                            <img src="{{ Helper::assets('assets/img/front-pages/icons/user.png') }}" alt="lifebelt" />
                        </div>
                        <h5 class="mb-3">Excellent Support</h5>
                        <p class="features-icon-description">Reach out anytime via email or LinkedIn — I personally respond to every message.</p>
                    </div>
                    <div class="col-lg-4 col-sm-6 text-center features-icon-box">
                        <div class="text-center mb-3">
                            <img src="{{ Helper::assets('assets/img/front-pages/icons/keyboard.png') }}" alt="google docs" />
                        </div>
                        <h5 class="mb-3">Well Documented</h5>
                        <p class="features-icon-description">Run install.sh and follow the README — setup done in minutes, code explained every step of the way.</p>
                    </div>
                </div>
            </div>
        </section>
        <!-- Useful features: End -->

        <!-- Real customers reviews: Start -->
        <section id="landingReviews" class="section-py bg-body landing-reviews pb-0">
            <!-- What people say slider: Start -->
            <div class="container">
                <div class="row align-items-center gx-0 gy-4 g-lg-5">

                    <div class="col-md-6 col-lg-5 col-xl-3">
                        <div class="mb-3 pb-1">
                            <span class="badge bg-label-primary">TECH STACK</span>
                        </div>
                        <h3 class="mb-1">What I built with</h3>
                        <p class="mb-3 mb-md-5">
                            Every technology in this project was
                            chosen with purpose and performance
                            in mind for <br class="d-none d-xl-block" />
                            high-performance applications.
                        </p>
                        <div class="landing-reviews-btns d-flex align-items-center gap-3">
                            <button id="reviews-previous-btn" class="btn btn-label-primary reviews-btn" type="button">
                                <i class="bx bx-chevron-left bx-sm"></i>
                            </button>
                            <button id="reviews-next-btn" class="btn btn-label-primary reviews-btn" type="button">
                                <i class="bx bx-chevron-right bx-sm"></i>
                            </button>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-7 col-xl-9">
                        <div class="swiper-reviews-carousel overflow-hidden mb-5 pb-md-2 pb-md-3">
                            <div class="swiper" id="swiper-reviews">
                                <div class="swiper-wrapper">

                                    <div class="swiper-slide">
                                        <div class="card h-100">
                                            <div class="card-body text-body d-flex flex-column justify-content-between h-100">
                                                <div class="mb-3">
                                                    <img src="{{ Helper::assets('assets/img/front-pages/branding/logo-1.png') }}" alt="client logo" class="client-logo img-fluid" />
                                                </div>
                                                <p>
                                                    “The framework I chose to build this project from scratch. Powerful, elegant, and a joy to work with every single day.”
                                                </p>
                                                <div class="d-flex align-items-center">
                                                    <div>
                                                        <h6 class="mb-0">Laravel 13</h6>
                                                        <p class="small text-muted mb-0">PHP Framework</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="swiper-slide">
                                        <div class="card h-100">
                                            <div class="card-body text-body d-flex flex-column justify-content-between h-100">
                                                <div class="mb-3">
                                                    <img src="{{ Helper::assets('assets/img/front-pages/branding/logo-2.png') }}" alt="client logo" class="client-logo img-fluid" />
                                                </div>
                                                <p>
                                                    “The language behind every line of server-side logic. Fast, reliable, and perfect for production apps.”
                                                </p>
                                                <div class="d-flex align-items-center">
                                                    <div>
                                                        <h6 class="mb-0">PHP 8.3</h6>
                                                        <p class="small text-muted mb-0">Backend Language</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="swiper-slide">
                                        <div class="card h-100">
                                            <div class="card-body text-body d-flex flex-column justify-content-between h-100">
                                                <div class="mb-3">
                                                    <img src="{{ Helper::assets('assets/img/front-pages/branding/logo-3.png') }}" alt="client logo" class="client-logo img-fluid" />
                                                </div>
                                                <p>
                                                    “My database of choice — structured, fast, and rock solid for storing and managing all project data.”
                                                </p>
                                                <div class="d-flex align-items-center">
                                                    <div>
                                                        <h6 class="mb-0">MySQL</h6>
                                                        <p class="small text-muted mb-0">Database</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="swiper-slide">
                                        <div class="card h-100">
                                            <div class="card-body text-body d-flex flex-column justify-content-between h-100">
                                                <div class="mb-3">
                                                    <img src="{{ Helper::assets('assets/img/front-pages/branding/logo-4.png') }}" alt="client logo" class="client-logo img-fluid" />
                                                </div>
                                                <p>
                                                    “Responsive layouts built with Bootstrap and custom CSS. Clean, consistent design across every page without the hassle.”
                                                </p>
                                                <div class="d-flex align-items-center">
                                                    <div>
                                                        <h6 class="mb-0">Bootstrap & CSS</h6>
                                                        <p class="small text-muted mb-0">Frontend Styling</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="swiper-slide">
                                        <div class="card h-100">
                                            <div class="card-body text-body d-flex flex-column justify-content-between h-100">
                                                <div class="mb-3">
                                                    <img src="{{ Helper::assets('assets/img/front-pages/branding/logo-5.png') }}" alt="client logo" class="client-logo img-fluid" />
                                                </div>
                                                <p>
                                                    “Roles and permissions handled beautifully with Spatie. Clean, flexible, and built right into the project from day one”
                                                </p>
                                                <div class="d-flex align-items-center">
                                                    <div>
                                                        <h6 class="mb-0">Spatie Permission</h6>
                                                        <p class="small text-muted mb-0">Roles & Permissions</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Real customers reviews: End -->

        <!-- FAQ: Start -->
        @include('pages.faq', ['faqs' => $faqs])
        <!-- FAQ: End -->

        <!-- CTA: Start -->
        <section id="landingCTA" class="section-py landing-cta position-relative p-lg-0 pb-0">
            <img src="{{ Helper::assets('assets/img/front-pages/backgrounds/cta-bg-light.png') }}" class="position-absolute bottom-0 end-0 scaleX-n1-rtl h-100 w-100 z-n1" alt="cta image" data-app-light-img="front-pages/backgrounds/cta-bg-light.png" data-app-dark-img="front-pages/backgrounds/cta-bg-dark.png" />
            <div class="container">
                <div class="row align-items-center gy-5 gy-lg-0">
                    <div class="col-lg-6 text-center text-lg-start">
                        <h6 class="h2 text-primary fw-bold mb-1">Let's Build Something Amazing.</h6>
                        <p class="fw-medium mb-4">I'm Bhargav Kapadiya — a Web developer ready to bring your ideas to life.</p>
                        <a href="mailto:your@email.com" class="btn btn-primary">Get in Touch</a>
                    </div>
                    <div class="col-lg-6 pt-lg-5 text-center text-lg-end">
                        <img src="{{ Helper::assets('assets/img/front-pages/landing-page/cta-dashboard.png') }}" alt="cta dashboard" class="img-fluid" />
                    </div>
                </div>
            </div>
        </section>
        <!-- CTA: End -->

        <!-- Contact Us: Start -->
        @include('pages.contact-us')
        <!-- Contact Us: End -->
    </div>
@endsection

@section('script')
    <script defer src="{{ Helper::assets('assets/libs/validation/validate.min.js') }}" type="text/javascript"></script>
@endsection

@section('script-bottom')
    <script src="{{ Helper::assets('assets/js/front-page-landing.js') }}"></script>
    @if (config('constant.recaptcha_enabled', false))
        <script src="https://www.google.com/recaptcha/enterprise.js?render={{ config('services.recaptcha.site_key') }}"></script>
        <script type="text/javascript">
            $(window).on('load', function() {
                loadRecaptcha()
            });

            function loadRecaptcha() {
                grecaptcha.enterprise.ready(function() {
                    grecaptcha.enterprise.execute("{{ config('services.recaptcha.site_key') }}", {
                        action: 'contact'
                    }).then(function(token) {
                        if (token) {
                            document.getElementById('recaptcha').value = token
                        }
                    })
                })
            }
            $(function() {
                setInterval(function() {
                    loadRecaptcha()
                }, 90 * 1000);
            });
        </script>
    @endif
    <script src="{{ Helper::assets('assets/js/pages/contact.js') }}?v={{ config('constant.asset_version') }}" type="text/javascript"></script>
@endsection
