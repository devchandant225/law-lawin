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
            @if ($globalProfile && $globalProfile->phone)
                <li class="topbar-one__info__item">
                    <i class="fas fa-phone topbar-one__info__icon"></i>
                    <a href="tel:{{ $globalProfile->phone }}" rel="nofollow">{{ $globalProfile->phone }}</a>
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
        </div>
    </div><!-- /.topbar-one__inner -->
</div><!-- /.topbar-one -->
