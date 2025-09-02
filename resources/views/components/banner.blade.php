      <!-- main-slider-start -->
      <section class="main-slider-one" id="home">
          <div class="main-slider-one__carousel procounsel-owl__carousel owl-carousel"
              data-owl-options='{
		"loop": true,
		"animateOut": "fadeOut",
		"animateIn": "fadeIn",
		"items": 1,
		"autoplay": true,
		"autoplayTimeout": 7000,
		"smartSpeed": 1000,
		"nav": false,
        "navText": ["<span class=\"icon-arrow-left\"></span>","<span class=\"icon-arrow-right\"></span>"],
		"dots": false,
		"margin": 0
	    }'>
              @foreach ($sliders as $slider)
                  <div class="item">
                      <div class="main-slider-one__item">
                          <div class="main-slider-one__bg" style="background-image: url('{{ $slider->image_url }}');">
                          </div>
                          <!-- bg -->
                          <div class="main-slider-one__overlay-one"></div>
                          <div class="main-slider-one__overlay-two"></div>
                          <div class="container">
                              <div class="row">
                                  <div class="col-md-12 ">
                                      <div class="main-slider-one__content">
                                          <h2 class="main-slider-one__title">{{ $slider->title }}
                                          </h2><!-- slider-title -->
                                          <p class="main-slider-one__text">{{ $slider->description }}</p>
                                          <!-- slider-text -->
                                          <div class="main-slider-one__btn">
                                              <a href="/about" class="procounsel-btn"> <i> Discover More</i>
                                                  <span> Discover More</span></a><!-- slider-btn -->
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div><!-- item -->
              @endforeach
          </div>
      </section>
