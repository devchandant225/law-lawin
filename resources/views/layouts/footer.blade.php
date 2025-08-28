  <!-- Google Maps Section -->
        <section class="map-section">
            <div class="container-fluid p-0">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="map-container" id="google-map" style="position: relative; overflow: hidden;">
                            @if($globalProfile && $globalProfile->address)
                                <!-- Google Maps Embed with Search Query -->
                                <iframe 
                                    src="https://maps.google.com/maps?width=100%25&amp;height=400&amp;hl=en&amp;q={{ urlencode($globalProfile->address) }}&amp;t=&amp;z=16&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"
                                    width="100%" 
                                    height="400" 
                                    style="border:0;" 
                                    allowfullscreen="" 
                                    loading="lazy" 
                                    referrerpolicy="no-referrer-when-downgrade"
                                    title="Office Location Map">
                                </iframe>
                                <!-- Map Overlay with Office Info -->
                                <div class="map-overlay" style="position: absolute; top: 20px; left: 20px; background: rgba(255,255,255,0.95); padding: 15px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); max-width: 300px; z-index: 10;">
                                    <h5 style="margin: 0 0 10px 0; font-size: 16px; font-weight: bold; color: #333;">{{ config('app.name') }}</h5>
                                    <p style="margin: 0; font-size: 14px; color: #666; line-height: 1.4;">{{ $globalProfile->address }}</p>
                                    @if($globalProfile->phone1)
                                    <p style="margin: 5px 0 0 0; font-size: 14px;"><i class="fas fa-phone" style="color: #007bff; margin-right: 8px;"></i><a href="tel:{{ $globalProfile->phone1 }}" style="color: #007bff; text-decoration: none;">{{ $globalProfile->phone1 }}</a></p>
                                    @endif
                                </div>
                            @else
                                <!-- Default Map for Kathmandu, Nepal -->
                                <iframe 
                                    src="https://maps.google.com/maps?width=100%25&amp;height=400&amp;hl=en&amp;q=Kathmandu,%20Nepal&amp;t=&amp;z=13&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"
                                    width="100%" 
                                    height="400" 
                                    style="border:0;" 
                                    allowfullscreen="" 
                                    loading="lazy" 
                                    referrerpolicy="no-referrer-when-downgrade"
                                    title="Default Location Map">
                                </iframe>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- /.map-section -->
        
  <footer class="main-footer">
            <div class="main-footer__bg" style="background-image: url(assets/images/backgrounds/footer-bg.png);"></div>
            <div class="main-footer__top">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-xl-4 wow fadeInUp" data-wow-delay="00ms">
                            <div class="footer-widget footer-widget--about">
                                <a href="{{ route('home') }}" class="footer-widget__logo">
                                    @if($globalProfile && $globalProfile->logo_url)
                                        <img src="{{ $globalProfile->logo_url }}" width="160" alt="{{ config('app.name') }}">
                                    @else
                                        <img src="assets/images/logo-light.png" width="160" alt="{{ config('app.name') }}">
                                    @endif
                                </a>
                                <p class="footer-widget__text">
                                    @if($globalProfile && $globalProfile->description)
                                        {{ Str::limit($globalProfile->description, 120) }}
                                    @else
                                        Discover a unique approach with our dedicated attorneys, committed to providing effective legal solutions.
                                    @endif
                                </p>
                            </div><!-- /.footer-widget -->
                        </div><!-- /.col-md-6 -->
                        <div class="col-md-6 col-xl-2 wow fadeInUp" data-wow-delay="100ms">
                            <div class="footer-widget footer-widget--links">
                                <h2 class="footer-widget__title">Quick Links</h2><!-- /.footer-widget__title -->
                                <ul class="list-unstyled footer-widget__links">
                                    <li><a href="/about/introduction">About Us</a></li>
                                    <li><a href="{{ route('team.index') }}">Our Team</a></li>
                                    <li><a href="{{ route('services.index') }}">Services</a></li>
                                    <li><a href="{{ route('practices.index') }}">Practice Areas</a></li>
                                    <li><a href="/contact">Contact</a></li>
                                </ul><!-- /.list-unstyled footer-widget__links -->
                            </div><!-- /.footer-widget -->
                        </div><!-- /.col-md-6 -->
                        <div class="col-md-6 col-xl-2 wow fadeInUp" data-wow-delay="200ms">
                            <div class="footer-widget footer-widget--links">
                                <h2 class="footer-widget__title">Legal Help</h2><!-- /.footer-widget__title -->
                                <ul class="list-unstyled footer-widget__links">
                                    <li><a href="{{ route('publications.index') }}">Publications</a></li>
                                    <li><a href="{{ route('posts.by-type', 'news') }}">Latest News</a></li>
                                    <li><a href="{{ route('help-desk.nrn-legal') }}">NRN Legal Help</a></li>
                                    <li><a href="{{ route('help-desk.fdi-legal') }}">FDI Legal Help</a></li>
                                    <li><a href="{{ route('portfolios.index') }}">Portfolio</a></li>
                                </ul><!-- /.list-unstyled footer-widget__links -->
                            </div><!-- /.footer-widget -->
                        </div><!-- /.col-md-6 -->
                        <div class="col-md-6 col-xl-4 wow fadeInUp" data-wow-delay="300ms">
                            <div class="footer-widget footer-widget--mail">
                                <h2 class="footer-widget__title">
                                    Signup for our latest news<br> & articles
                                </h2><!-- /.footer-widget__title -->
                                <form action="#" data-url="MAILCHIMP_FORM_URL"
                                    class="footer-widget__newsletter mc-form">
                                    <input type="text" name="EMAIL" placeholder="Email Address">
                                    <button type="submit">
                                        <i class="icon-right-arrow-2"></i>
                                        <span class="sr-only">submit</span><!-- /.sr-only -->
                                    </button>
                                </form><!-- /. mc-form -->
                                <div class="footer-widget__check">
                                    <input type="checkbox" checked="" name="save-data" id="save-data">
                                    <label for="save-data"><span></span>I agree to the <a href="checkout.html">Privacy
                                            Policy.</a></label>
                                </div>
                                <div class="mc-form__response"></div><!-- /.mc-form__response -->
                                <!-- /.footer-widget__text -->
                            </div><!-- /.footer-widget -->
                        </div><!-- /.col-md-6 -->
                    </div><!-- /.row -->
                    <div class="main-footer__info">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="main-footer__info__inner">
                                    <div class="main-footer__info__pin">
                                        <i class="icon-pin"></i>
                                    </div>
                                    <div class="main-footer__info__location">
                                        @if($globalProfile && $globalProfile->address)
                                            {!! nl2br(e($globalProfile->address)) !!}
                                        @else
                                            6391 Elgin St. Delaware <br>New York. USA
                                        @endif
                                    </div>
                                    <ul class="list-unstyled main-footer__info__list">
                                        @if($globalProfile && $globalProfile->phone1)
                                        <li class="main-footer__info__item">
                                            <div class="main-footer__info__icon">
                                                <i class="icon-telephone-call-1"></i>
                                            </div>
                                            <div class="main-footer__info__content">
                                                <p class="main-footer__info__text">
                                                    <a href="tel:{{ $globalProfile->phone1 }}">{{ $globalProfile->phone1 }}</a>
                                                </p><!-- /.contact-one__info__text -->
                                            </div>
                                        </li>
                                        @endif
                                        
                                        @if($globalProfile && $globalProfile->email)
                                        <li class="main-footer__info__item">
                                            <div class="main-footer__info__icon">
                                                <i class="icon-mail"></i>
                                            </div>
                                            <div class="main-footer__info__content">
                                                <p class="main-footer__info__text">
                                                    <a href="mailto:{{ $globalProfile->email }}">{{ $globalProfile->email }}</a>
                                                </p><!-- /.contact-one__info__text -->
                                            </div>
                                        </li>
                                        @endif
                                        @if($globalProfile && $globalProfile->whatsapp)
                                        <li class="main-footer__info__item">
                                            <div class="main-footer__info__icon">
                                                <i class="fab fa-whatsapp"></i>
                                            </div>
                                            <div class="main-footer__info__content">
                                                <p class="main-footer__info__text">
                                                    <a href="https://wa.me/{{ $globalProfile->whatsapp }}">{{ $globalProfile->whatsapp }}</a>
                                                </p><!-- /.contact-one__info__text -->
                                            </div>
                                        </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="main-footer__info__social">
                                    @if($globalProfile && $globalProfile->facebook_link)
                                    <a href="{{ $globalProfile->facebook_link }}">
                                        <i class="icon-facebook"></i>
                                        <span class="sr-only">Facebook</span>
                                    </a>
                                    @endif
                                    @if($globalProfile && $globalProfile->twitter_link)
                                    <a href="{{ $globalProfile->twitter_link }}">
                                        <i class="icon-twitter"></i>
                                        <span class="sr-only">Twitter</span>
                                    </a>
                                    @endif
                                    @if($globalProfile && $globalProfile->linkedin_link)
                                    <a href="{{ $globalProfile->linkedin_link }}">
                                        <i class="fab fa-linkedin"></i>
                                        <span class="sr-only">LinkedIn</span>
                                    </a>
                                    @endif
                                    @if($globalProfile && $globalProfile->instagram_link)
                                    <a href="{{ $globalProfile->instagram_link }}">
                                        <i class="fab fa-instagram"></i>
                                        <span class="sr-only">Instagram</span>
                                    </a>
                                    @endif
                                    @if($globalProfile && $globalProfile->youtube_link)
                                    <a href="{{ $globalProfile->youtube_link }}">
                                        <i class="icon-youtube"></i>
                                        <span class="sr-only">Youtube</span>
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- /.container -->
            </div><!-- /.main-footer__top -->
            <div class="main-footer__bottom  wow fadeInUp" data-wow-delay="00ms">
                <div class="container">
                    <div class="main-footer__bottom__inner">
                        <p class="main-footer__copyright">
                            &copy; Copyright <span class="dynamic-year"></span> by {{ config('app.name') }}. All rights reserved.
                        </p>
                    </div><!-- /.main-footer__inner -->
                </div><!-- /.container -->
            </div><!-- /.main-footer__bottom -->
        </footer><!-- /.main-footer -->