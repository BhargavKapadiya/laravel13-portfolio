<!-- Footer Start -->
<footer class="landing-footer bg-body footer-text">
    <div class="footer-top position-relative overflow-hidden z-1">
        <img src="{{ Helper::assets('assets/img/front-pages/backgrounds/footer-bg-light.png') }}" alt="footer bg" class="footer-bg banner-bg-img z-n1" data-app-light-img="front-pages/backgrounds/footer-bg-light.png" data-app-dark-img="front-pages/backgrounds/footer-bg-dark.png" />
        <div class="container">
            <div class="row gx-0 gy-4 g-md-5">
                <div class="col-lg-5">

                    <a href="{{ route('home') }}" class="app-brand-link mb-4">
                        <span class="app-brand-logo demo">
                            <svg width="25" viewBox="0 0 25 42" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <defs>
                                    <path d="M13.7918663,0.358365126 L3.39788168,7.44174259 C0.566865006,9.69408886 -0.379795268,12.4788597 0.557900856,15.7960551 C0.68998853,16.2305145 1.09562888,17.7872135 3.12357076,19.2293357 C3.8146334,19.7207684 5.32369333,20.3834223 7.65075054,21.2172976 L7.59773219,21.2525164 L2.63468769,24.5493413 C0.445452254,26.3002124 0.0884951797,28.5083815 1.56381646,31.1738486 C2.83770406,32.8170431 5.20850219,33.2640127 7.09180128,32.5391577 C8.347334,32.0559211 11.4559176,30.0011079 16.4175519,26.3747182 C18.0338572,24.4997857 18.6973423,22.4544883 18.4080071,20.2388261 C17.963753,17.5346866 16.1776345,15.5799961 13.0496516,14.3747546 L10.9194936,13.4715819 L18.6192054,7.984237 L13.7918663,0.358365126 Z" id="path-1"></path>
                                    <path d="M5.47320593,6.00457225 C4.05321814,8.216144 4.36334763,10.0722806 6.40359441,11.5729822 C8.61520715,12.571656 10.0999176,13.2171421 10.8577257,13.5094407 L15.5088241,14.433041 L18.6192054,7.984237 C15.5364148,3.11535317 13.9273018,0.573395879 13.7918663,0.358365126 C13.5790555,0.511491653 10.8061687,2.3935607 5.47320593,6.00457225 Z" id="path-3"></path>
                                    <path d="M7.50063644,21.2294429 L12.3234468,23.3159332 C14.1688022,24.7579751 14.397098,26.4880487 13.008334,28.506154 C11.6195701,30.5242593 10.3099883,31.790241 9.07958868,32.3040991 C5.78142938,33.4346997 4.13234973,34 4.13234973,34 C4.13234973,34 2.75489982,33.0538207 2.37032616e-14,31.1614621 C-0.55822714,27.8186216 -0.55822714,26.0572515 -4.05231404e-15,25.8773518 C0.83734071,25.6075023 2.77988457,22.8248993 3.3049379,22.52991 C3.65497346,22.3332504 5.05353963,21.8997614 7.50063644,21.2294429 Z" id="path-4"></path>
                                    <path d="M20.6,7.13333333 L25.6,13.8 C26.2627417,14.6836556 26.0836556,15.9372583 25.2,16.6 C24.8538077,16.8596443 24.4327404,17 24,17 L14,17 C12.8954305,17 12,16.1045695 12,15 C12,14.5672596 12.1403557,14.1461923 12.4,13.8 L17.4,7.13333333 C18.0627417,6.24967773 19.3163444,6.07059163 20.2,6.73333333 C20.3516113,6.84704183 20.4862915,6.981722 20.6,7.13333333 Z" id="path-5"></path>
                                </defs>
                                <g id="g-app-brand" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g id="Brand-Logo" transform="translate(-27.000000, -15.000000)">
                                        <g id="Icon" transform="translate(27.000000, 15.000000)">
                                            <g id="Mask" transform="translate(0.000000, 8.000000)">
                                                <mask id="mask-2" fill="white">
                                                    <use xlink:href="#path-1"></use>
                                                </mask>
                                                <use fill="#696cff" xlink:href="#path-1"></use>
                                                <g id="Path-3" mask="url(#mask-2)">
                                                    <use fill="#696cff" xlink:href="#path-3"></use>
                                                    <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-3"></use>
                                                </g>
                                                <g id="Path-4" mask="url(#mask-2)">
                                                    <use fill="#696cff" xlink:href="#path-4"></use>
                                                    <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-4"></use>
                                                </g>
                                            </g>
                                            <g id="Triangle" transform="translate(19.000000, 11.000000) rotate(-300.000000) translate(-19.000000, -11.000000) ">
                                                <use fill="#696cff" xlink:href="#path-5"></use>
                                                <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-5"></use>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </span>
                        <span class="app-brand-text demo footer-link fw-bold ms-2 ps-1">{{ env('APP_NAME') }}</span>
                    </a>

                    <p class="footer-text footer-logo-description mb-4">
                        Most developer friendly & highly customisable Admin Dashboard Template.
                    </p>
                    {{-- <form class="footer-form">
                        <label for="footer-email" class="small">Subscribe to newsletter</label>
                        <div class="d-flex mt-1">
                            <input type="email" class="form-control rounded-0 rounded-start-bottom rounded-start-top" id="footer-email" placeholder="Your email" />
                            <button type="submit" class="btn btn-primary shadow-none rounded-0 rounded-end-bottom rounded-end-top">
                                Subscribe
                            </button>
                        </div>
                    </form> --}}
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6">
                    <h6 class="footer-title mb-4">Information</h6>
                    <ul class="list-unstyled">
                        <li class="mb-3">
                            <a href="{{ route('about-us') }}" class="footer-link">About Us</a>
                        </li>
                        <li class="mb-3">
                            <a href="{{ route('terms-conditions') }}" class="footer-link">Terms & conditions</a>
                        </li>
                        <li class="mb-3">
                            <a href="{{ route('privacy-policy') }}" class="footer-link">Privacy policy</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6">
                    <h6 class="footer-title mb-4">Quick Links</h6>
                    <ul class="list-unstyled">
                        <li class="mb-3">
                            <a href="{{ route('home') }}#landingHero" class="footer-link">Home</a>
                        </li>
                        <li class="mb-3">
                            <a href="{{ route('home') }}#landingFeatures" class="footer-link">Features</a>
                        </li>
                        @if (isset($faqs) && !empty($faqs) && $faqs->count())
                            <li class="mb-3">
                                <a href="{{ route('home') }}#landingFAQ" class="footer-link">FAQs</a>
                            </li>
                        @endif
                        <li class="mb-3">
                            <a href="{{ route('home') }}#landingContact" class="footer-link">Contact Us</a>
                        </li>
                        <li class="mb-3">
                            <a href="{{ route('login') }}" class="footer-link">Login/Register</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-4">
                    <h6 class="footer-title mb-4">Contact</h6>
                    <a href="mailto:bhargavkapadiya80@gmail.com" class="d-block footer-link mb-3 pb-2">Email: bhargavkapadiya80@gmail.com</a>
                    <a href="tel:+919638364455" class="d-block footer-link mb-3 pb-2">Contact: +919638364455</a>
                    <a href="https://www.google.com/maps/place/South+Bopal,+Bopal,+Ahmedabad,+Gujarat/@23.0220367,72.4468087,14z/data=!3m1!4b1!4m6!3m5!1s0x395e9ba1551ce393:0x501cc628f73ed0f5!8m2!3d23.0206198!4d72.4687152!16s%2Fg%2F1tk8l_72?entry=ttu&g_ep=EgoyMDI2MDYxMC4wIKXMDSoASAFQAw%3D%3D" target="_blank" class="d-block footer-link mb-3 pb-2">Location: Ahmedabad, Gujarat, India</a>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom py-3">
        <div class="container d-flex flex-wrap justify-content-between flex-md-row flex-column text-center text-md-start">
            <div class="mb-2 mb-md-0">
                <span class="footer-text">©
                    <script>
                        document.write(new Date().getFullYear());
                    </script>
                </span>
                <a href="{{ route('home') }}" class="fw-medium text-white footer-link">{{ env('APP_NAME') }},</a>
                <span class="footer-text"> Made with ❤️ by a Bhargav Kapadiya.</span>
            </div>
            <div>
                <a href="https://github.com/BhargavKapadiya" class="footer-link me-3" target="_blank">
                    <img src="{{ Helper::assets('assets/img/front-pages/icons/github-light.png') }}" alt="github icon" data-app-light-img="front-pages/icons/github-light.png" data-app-dark-img="front-pages/icons/github-dark.png" />
                </a>
                <a href="https://www.linkedin.com/in/bhargav-kapadiya-1685471b2" class="footer-link me-3" target="_blank">
                    <img src="{{ Helper::assets('assets/img/front-pages/icons/linkedin-light.png') }}" alt="linkedin icon" data-app-light-img="front-pages/icons/linkedin-light.png" data-app-dark-img="front-pages/icons/linkedin-dark.png" />
                </a>
                {{-- <a href="https://twitter.com/Theme_Selection" class="footer-link me-3" target="_blank">
                    <img src="{{ Helper::assets('assets/img/front-pages/icons/twitter-light.png') }}" alt="twitter icon" data-app-light-img="front-pages/icons/twitter-light.png" data-app-dark-img="front-pages/icons/twitter-dark.png" />
                </a>
                <a href="https://www.instagram.com/themeselection/" class="footer-link" target="_blank">
                    <img src="{{ Helper::assets('assets/img/front-pages/icons/instagram-light.png') }}" alt="google icon" data-app-light-img="front-pages/icons/instagram-light.png" data-app-dark-img="front-pages/icons/instagram-dark.png" />
                </a> --}}
            </div>
        </div>
    </div>
</footer>
<!-- end Footer -->
