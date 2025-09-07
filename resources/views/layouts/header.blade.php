      <header class="main-header main-header--five sticky-header sticky-header--normal">
          <div class="main-header__inner">
              <div class="main-header__logo">
                  <a href="{{ route('home') }}">
                      @if ($globalProfile && $globalProfile->logo_url)
                          <img src="{{ $globalProfile->logo_url }}" alt="{{ config('app.name') }}" width="160">
                      @else
                          <img src="assets/images/logo-light.png" alt="{{ config('app.name') }}" width="160">
                      @endif
                  </a>
              </div><!-- /.main-header__logo -->
              <div class="main-header__center">
                  <div class="topbar-one">
                      <div class="topbar-one__inner">
                          <ul class="list-unstyled topbar-one__info">
                              @if ($globalProfile && $globalProfile->address)
                                  <li class="topbar-one__info__item">
                                      <i class="fas fa-map-marker-alt topbar-one__info__icon"></i>
                                      {{ $globalProfile->address }}
                                  </li>
                              @endif
                              @if ($globalProfile && $globalProfile->email)
                                  <li class="topbar-one__info__item">
                                      <i class="fas fa-envelope topbar-one__info__icon"></i>
                                      <a href="mailto:{{ $globalProfile->email }}">{{ $globalProfile->email }}</a>
                                  </li>
                              @endif
                          </ul><!-- /.list-unstyled topbar-one__info -->
                          <div class="topbar-one__right">
                              <p class="topbar-one__text"><i class="icon-clock topbar-one__info__icon"></i>Open:
                                  Mon-Sat: 08.00 - 18.00</p><!-- /.topbar-one__text -->
                          </div><!-- /.topbar-one__right -->
                          <div class="main-header__right__social">
                              @if ($globalProfile && $globalProfile->facebook_link)
                                  <a href="{{ $globalProfile->facebook_link }}">
                                      <i class="icon-facebook"></i>
                                      <span class="sr-only">Facebook</span>
                                  </a>
                              @endif

                              @if ($globalProfile && $globalProfile->linkedin_link)
                                  <a href="{{ $globalProfile->linkedin_link }}">
                                      <i class="fab fa-linkedin"></i>
                                      <span class="sr-only">LinkedIn</span>
                                  </a>
                              @endif
                              @if ($globalProfile && $globalProfile->whatsapp)
                                  <a href="{{ $globalProfile->whatsapp }}">
                                      <i class="fab fa-whatsapp"></i>
                                      <span class="sr-only">whatsapp</span>
                                  </a>
                              @endif
                              @if ($globalProfile && $globalProfile->viber)
                                  <a href="{{ $globalProfile->viber }}">
                                      <i class="fab fa-viber"></i>
                                      <span class="sr-only">viber</span>
                                  </a>
                              @endif
                                 @if ($globalProfile && $globalProfile->wechat_link)
                                  <a href="{{ $globalProfile->wechat_link }}">
                                      <i class="fab fa-weixin"></i>
                                      <span class="sr-only">wechat link</span>
                                  </a>
                              @endif
                                 <a href="/calculator">
                                      <i class="fab fa-calculator"></i>
                                      <span class="sr-only">wechat link</span>
                                  </a>
                          </div>
                      </div><!-- /.topbar-one__inner -->
                  </div><!-- /.topbar-one -->
                  <div class="main-header__center__bottom">
                      <nav class="main-header__nav main-menu">
                          <ul class="main-menu__list">
                              <li>
                                  <a href="{{ route('home') }}">Home</a>
                              </li>

                              <li>
                                  <a href="/about/introduction">About</a>
                              </li>

                              <li class="dropdown">
                                  <a href="{{ route('services.index') }}">Services</a>
                                  @if ($navServices && $navServices->count() > 0)
                                      <ul>
                                          <li><a href="{{ route('services.index') }}">All Services</a></li>
                                          @foreach ($navServices->take(8) as $service)
                                              <li><a
                                                      href="{{ route('service.show', $service->slug) }}">{{ $service->title }}</a>
                                              </li>
                                          @endforeach
                                      </ul>
                                  @endif
                              </li>

                              <li class="dropdown">
                                  <a href="{{ route('practices.index') }}">Practice Areas</a>
                                  @if ($navPracticeAreas && $navPracticeAreas->count() > 0)
                                      <ul>
                                          <li><a href="{{ route('practices.index') }}">All Practice Areas</a></li>
                                          @foreach ($navPracticeAreas->take(8) as $practice)
                                              <li><a
                                                      href="{{ route('practice.show', $practice->slug) }}">{{ $practice->title }}</a>
                                              </li>
                                          @endforeach
                                      </ul>
                                  @endif
                              </li>

                              <li class="dropdown">
                                  <a href="#">News & Publications</a>
                                  <ul>
                                      <li><a href="{{ route('posts.by-type', 'news') }}">News</a></li>
                                      <li><a href="{{ route('publications.index') }}">Publications</a></li>
                                  </ul>
                              </li>

                              <li class="dropdown">
                                  <a href="{{ route('team.index') }}">Our Team</a>
                              </li>

                              <li class="dropdown">
                                  <a href="#">Help Desk</a>
                                  <ul>
                                      @foreach ($navHelpDeskItems as $helpDeskItem)
                                          <li><a href="{{ $helpDeskItem['url'] }}">{{ $helpDeskItem['title'] }}</a>
                                          </li>
                                      @endforeach
                                  </ul>
                              </li>

                              <li>
                                  <a href="/contact">Contact</a>
                              </li>
                          </ul>
                      </nav><!-- /.main-header__nav -->
                      <div class="main-header__right">
                          <div class="mobile-nav__btn mobile-nav__toggler">
                              <span></span>
                              <span></span>
                              <span></span>
                          </div><!-- /.mobile-nav__toggler -->

                      </div><!-- /.main-header__right -->
                  </div>
              </div>
          </div><!-- /.main-header__inner -->
      </header><!-- /.main-header -->
