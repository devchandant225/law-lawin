<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\PublicationsController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\PracticeController;
use App\Http\Controllers\PublicationController as PublicPublicationController;
use App\Http\Controllers\TeamController as PublicTeamController;
use App\Http\Controllers\PortfolioController as PublicPortfolioController;

// Admin Controllers
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\PublicationController as AdminPublicationController;
use App\Http\Controllers\Admin\FAQController as AdminFAQController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\TableOfContentController;
use App\Http\Controllers\Admin\AboutUsContentSectionController;
use App\Http\Controllers\Admin\PortfolioController;
use App\Http\Controllers\SliderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// About
Route::get('/about/introduction', [AboutController::class, 'introduction']);
Route::get('/about/executive-committee', [AboutController::class, 'executiveCommittee']);

// Information
Route::get('/information/notices', [InformationController::class, 'notices']);
Route::get('/information/notices/{slug}', [InformationController::class, 'showNotice']);
Route::get('/information/events', [InformationController::class, 'events']);


// Membership
Route::get('/membership/register', [MembershipController::class, 'create']);
Route::get('/membership/{type}', [MembershipController::class, 'listing']);

// Media
Route::get('/media/gallery', [MediaController::class, 'gallery']);

// Submission
Route::get('/submission', [SubmissionController::class, 'create']);

// Contact
Route::get('/contact', [ContactController::class, 'index']);

// Posts
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{type}', [PostController::class, 'byType'])->name('posts.by-type')
    ->where('type', 'service|practice|news|blog');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

// Services
Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/services/search', [ServiceController::class, 'search'])->name('services.search');
Route::get('/services/featured', [ServiceController::class, 'featured'])->name('services.featured');
Route::get('/services/stats', [ServiceController::class, 'stats'])->name('services.stats');
Route::get('/service/{slug}', [ServiceController::class, 'show'])->name('service.show');

// Practices (Legal Publications)
Route::get('/practices', [PracticeController::class, 'index'])->name('practices.index');
Route::get('/practices/search', [PracticeController::class, 'search'])->name('practices.search');
Route::get('/practices/featured', [PracticeController::class, 'featured'])->name('practices.featured');
Route::get('/practices/stats', [PracticeController::class, 'stats'])->name('practices.stats');
Route::get('/practice/{slug}', [PracticeController::class, 'show'])->name('practice.show');

// Publications
Route::get('/publications', [PublicPublicationController::class, 'index'])->name('publications.index');
Route::get('/publications/search', [PublicPublicationController::class, 'search'])->name('publications.search');
Route::get('/publications/featured', [PublicPublicationController::class, 'featured'])->name('publications.featured');
Route::get('/publications/stats', [PublicPublicationController::class, 'stats'])->name('publications.stats');
Route::get('/publication/{slug}', [PublicPublicationController::class, 'show'])->name('publication.show');

// Team
Route::get('/team', [PublicTeamController::class, 'index'])->name('team.index');
Route::get('/team/{team}', [PublicTeamController::class, 'show'])->name('team.show');

// Portfolio
Route::get('/portfolios', [PublicPortfolioController::class, 'index'])->name('portfolios.index');

// Add home route with name
Route::get('/', [HomeController::class, 'index'])->name('home');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

// Admin Authentication Routes (Guest only)
Route::prefix('admin')->name('admin.')->middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

// Admin Protected Routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Profile Management
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/create', [ProfileController::class, 'create'])->name('profile.create');
    Route::post('/profile', [ProfileController::class, 'store'])->name('profile.store');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/logo', [ProfileController::class, 'removeLogo'])->name('profile.remove-logo');
    
    // Posts Management
    Route::resource('posts', AdminPostController::class);
    Route::post('/posts/{post}/toggle-status', [AdminPostController::class, 'toggleStatus'])->name('posts.toggle-status');
    
    // Publications Management
    Route::resource('publications', AdminPublicationController::class);
    Route::post('/publications/{publication}/toggle-status', [AdminPublicationController::class, 'toggleStatus'])->name('publications.toggle-status');
    
    // FAQ Management
    Route::resource('faqs', AdminFAQController::class);
    Route::post('/faqs/{faq}/toggle-status', [AdminFAQController::class, 'toggleStatus'])->name('faqs.toggle-status');
    
    // Table of Contents Management (nested under publications)
    Route::prefix('publications/{publication}')
        ->name('publications.')
        ->group(function () {
            Route::resource('table-of-contents', TableOfContentController::class, [
                'names' => [
                    'index' => 'table-of-contents.index',
                    'create' => 'table-of-contents.create', 
                    'store' => 'table-of-contents.store',
                    'show' => 'table-of-contents.show',
                    'edit' => 'table-of-contents.edit',
                    'update' => 'table-of-contents.update',
                    'destroy' => 'table-of-contents.destroy'
                ]
            ]);
            
            // Additional TOC routes
            Route::post('table-of-contents/{tableOfContent}/toggle-status', [TableOfContentController::class, 'toggleStatus'])
                ->name('table-of-contents.toggle-status');
            Route::post('table-of-contents/reorder', [TableOfContentController::class, 'reorder'])
                ->name('table-of-contents.reorder');
            Route::delete('table-of-contents/bulk-delete', [TableOfContentController::class, 'bulkDelete'])
                ->name('table-of-contents.bulk-delete');
        });
    
    // Team Management
    Route::resource('teams', TeamController::class);
    
    // Slider Management
    Route::resource('sliders', SliderController::class);
    Route::post('/sliders/{slider}/toggle-status', [SliderController::class, 'toggleStatus'])->name('sliders.toggle-status');
    
    // About Us Content Section Management
    Route::resource('about-us-contents', AboutUsContentSectionController::class);
    Route::post('/about-us-contents/{aboutUsContent}/toggle-status', [AboutUsContentSectionController::class, 'toggleStatus'])->name('about-us-contents.toggle-status');
    
    // Portfolio Management
    Route::resource('portfolios', PortfolioController::class);
    Route::post('/portfolios/{portfolio}/toggle-status', [PortfolioController::class, 'toggleStatus'])->name('portfolios.toggle-status');
    
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
