<section class="page-header">
    <div class="page-header__bg" @if($backgroundImage) style="background-image: url('{{ $backgroundImage }}');" @endif></div>
    <!-- /.page-header__bg -->
    <!-- <div class="page-header__shape"></div> -->
    <!-- /.page-header__shape -->
    <div class="container">
        <h2 class="page-header__title bw-split-in-right">{{ $title }}</h2>
        @if($subtitle)
            <p class="page-header__subtitle">{{ $subtitle }}</p>
        @endif
        @if($showBreadcrumbs && !empty($breadcrumbs))
            <ul class="procounsel-breadcrumb list-unstyled">
                @foreach($breadcrumbs as $breadcrumb)
                    <li>
                        @if(isset($breadcrumb['url']) && !$loop->last)
                            <a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['label'] }}</a>
                        @else
                            <span>{{ $breadcrumb['label'] }}</span>
                        @endif
                    </li>
                @endforeach
            </ul><!-- /.procounsel-breadcrumb list-unstyled -->
        @endif
    </div><!-- /.container -->
</section><!-- /.page-header -->
