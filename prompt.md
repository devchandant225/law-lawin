ErrorException
PHP 8.2.12
10.50.0
Attempt to read property "image1" on null

Expand vendor frames
C:\xampp\htdocs\lawin-new\resources\views\components\about-us.blade
.php
 
: 25
require
10 vendor frames
C:\xampp\htdocs\lawin-new\resources\views\home.blade
.php
 
: 11
require
54 vendor frames
C:\xampp\htdocs\lawin-new\public\index
.php
 
: 51
require_once
1 vendor frame
C:\xampp\htdocs\lawin-new\resources\views\components\about-us.blade
.php
 
: 25































        </div>

        <div

            class="absolute -bottom-8 left-20 w-96 h-96 bg-primary/70 rounded-full mix-blend-multiply filter blur-xl animate-blob animation-delay-4000">

        </div>

    </div>



    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Main About Section -->

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 xl:gap-20 items-center">

            <!-- Image Section - Left -->

            <div class="relative order-2 lg:order-1">

                <!-- Main Image Container -->

                <div class="relative">

                    <!-- Image with rounded corners and shadow -->

                    <div class="relative overflow-hidden rounded-xl p-6 sm:p-8 shadow">

                        <img src="{{ asset('storage/' . $intro_home->image1) }}"

                            alt="{{ $intro_home->title ?? 'Legal Services' }}"

                            class="w-full h-[30r