Undefined variable $leftRightContents

Expand vendor frames
resources
 / 
views
 / 
practice
 / 
show.blade
.php
 
: 48
require
54 vendor frames
public
 / 
index
.php
 
: 51
[top]
resources
 / 
views
 / 
practice
 / 
show.blade
.php
 
: 48































                                    <img src="{{ $practice->feature_image_url }}" alt="{{ $practice->title }}"

                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">

                                </div>

                            @endif

                            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4 leading-tight">

                                {{ $practice->title }}</h1>

                            @if ($practice->excerpt)

                                <p class="text-xl text-gray-600 leading-relaxed">{{ $practice->excerpt }}</p>

                            @endif

                        </div>



                        <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">

                            {!! $practice->content ?: $practice->description !!}

                        </div>

                        <!-- Left-Right Content Sections -->

                        @if ($leftRightContents && $leftRightContents->count() > 0)

                            @foreach ($leftRightContents as $index => $content)

                                <section class="mb-12">

                                    <div

                              