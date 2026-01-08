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
use App\Http\Controllers\ContactFormController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\PracticeController;
use App\Http\Controllers\PublicationController as PublicPublicationController;
use App\Http\Controllers\MorePublicationController;
use App\Http\Controllers\ServiceLocationController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\TeamController as PublicTeamController;
use App\Http\Controllers\PortfolioController as PublicPortfolioController;
use App\Http\Controllers\HelpDeskController;

// Admin Controllers
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\PublicationController as AdminPublicationController;
use App\Http\Controllers\Admin\MorePublicationController as AdminMorePublicationController;
use App\Http\Controllers\Admin\FAQController as AdminFAQController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\TableOfContentController;
use App\Http\Controllers\Admin\AboutUsContentSectionController;
use App\Http\Controllers\Admin\PortfolioController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\PublicationTeamController;
use App\Http\Controllers\Admin\MetaTagController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\PageController as PublicPageController;

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
Route::get('/about', [AboutController::class, 'index'])->name('about');
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
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact/submit', [ContactFormController::class, 'submit'])->name('contact.submit');

// Posts
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{type}', [PostController::class, 'byType'])
    ->name('posts.by-type')
    ->where('type', 'service|practice|news|blog');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

// Services
Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/services/search', [ServiceController::class, 'search'])->name('services.search');
Route::get('/services/featured', [ServiceController::class, 'featured'])->name('services.featured');
Route::get('/services/stats', [ServiceController::class, 'stats'])->name('services.stats');
Route::get('/service/{slug}', [ServiceController::class, 'show'])->name('service.show');

// Practice Areas
Route::get('/practice', [PracticeController::class, 'index'])->name('practice.index');
Route::get('/practice/search', [PracticeController::class, 'search'])->name('practice.search');
Route::get('/practice/featured', [PracticeController::class, 'featured'])->name('practice.featured');
Route::get('/practice/stats', [PracticeController::class, 'stats'])->name('practice.stats');
Route::get('/practice/{slug}', [PracticeController::class, 'show'])->name('practice.show');

// Publications
Route::get('/publication', [PublicPublicationController::class, 'index'])->name('publications.index');
Route::get('/publication/search', [PublicPublicationController::class, 'search'])->name('publications.search');
Route::get('/publication/featured', [PublicPublicationController::class, 'featured'])->name('publications.featured');
Route::get('/publication/stats', [PublicPublicationController::class, 'stats'])->name('publications.stats');
Route::get('/publication/{slug}', [PublicPublicationController::class, 'show'])->name('publication.show');

// More Publications - Redirect to Publications
Route::redirect('/more-publication', '/publication', 301)->name('more-publications.index');
Route::redirect('/more-publication/{slug}', '/publication', 301)->name('more-publication.show');
Route::get('/more-publications/search', [MorePublicationController::class, 'search'])->name('more-publications.search');
Route::get('/more-publications/featured', [MorePublicationController::class, 'featured'])->name('more-publications.featured');
Route::get('/more-publications/stats', [MorePublicationController::class, 'stats'])->name('more-publications.stats');

// Service Locations
Route::get('/service-locations', [ServiceLocationController::class, 'index'])->name('service-locations.index');
Route::get('/service-locations/search', [ServiceLocationController::class, 'search'])->name('service-locations.search');
Route::get('/service-locations/featured', [ServiceLocationController::class, 'featured'])->name('service-locations.featured');
Route::get('/service-locations/stats', [ServiceLocationController::class, 'stats'])->name('service-locations.stats');
Route::get('/service-location/{slug}', [ServiceLocationController::class, 'show'])->name('service-locations.show');

// Languages
Route::get('/languages', [LanguageController::class, 'index'])->name('languages.index');
Route::get('/languages/search', [LanguageController::class, 'search'])->name('languages.search');
Route::get('/languages/featured', [LanguageController::class, 'featured'])->name('languages.featured');
Route::get('/languages/stats', [LanguageController::class, 'stats'])->name('languages.stats');
Route::get('/language/{slug}', [LanguageController::class, 'show'])->name('languages.show');

// Team
Route::get('/team', [PublicTeamController::class, 'index'])->name('team.index');
Route::get('/team/{team}', [PublicTeamController::class, 'show'])->name('team.show');

// Portfolio
Route::get('/portfolios', [PublicPortfolioController::class, 'index'])->name('portfolios.index');

// Pages
Route::get('/page/{page}', [PublicPageController::class, 'show'])->name('page.show');

// Help Desk Routes
Route::get('/help-desk/nrn-legal', [HelpDeskController::class, 'nrnLegal'])->name('help-desk.nrn-legal');
Route::get('/help-desk/fdi-legal', [HelpDeskController::class, 'fdiLegal'])->name('help-desk.fdi-legal');

// Calculator
Route::get('/calculator', function () {
    return view('calculator');
})->name('calculator');

// Policy Pages
Route::get('/terms-of-service', [HomeController::class, 'termsCondition'])->name('terms-condition');
Route::get('/privacy-policy', [HomeController::class, 'privacyPolicy'])->name('privacy-policy');
Route::get('/cookie-policy-for-lawin-and-partners', [HomeController::class, 'cookiesPolicy'])->name('cookies-policy');

// Add home route with name
Route::get('/', [HomeController::class, 'index'])->name('home');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

// Admin Authentication Routes (Guest only)
Route::prefix('admin')
    ->name('admin.')
    ->middleware('guest')
    ->group(function () {
        Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AuthController::class, 'login'])->name('login.post');
        Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
        Route::post('/register', [AuthController::class, 'register'])->name('register.post');
    });

// Admin Protected Routes
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'admin'])
    ->group(function () {
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
        Route::post('/upload_editor_image', [AdminPublicationController::class, 'editorUpload']);
        // FAQ Management
        Route::resource('faqs', AdminFAQController::class);
        Route::post('/faqs/{faq}/toggle-status', [AdminFAQController::class, 'toggleStatus'])->name('faqs.toggle-status');

        // Contact Submissions Management
        Route::resource('contacts', AdminContactController::class)->except(['create', 'store', 'edit', 'update']);
        Route::get('/contacts/export', [AdminContactController::class, 'export'])->name('contacts.export');

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
                        'destroy' => 'table-of-contents.destroy',
                    ],
                ]);

                // Additional TOC routes
                Route::post('table-of-contents/{tableOfContent}/toggle-status', [TableOfContentController::class, 'toggleStatus'])->name('table-of-contents.toggle-status');
                Route::post('table-of-contents/reorder', [TableOfContentController::class, 'reorder'])->name('table-of-contents.reorder');
                Route::delete('table-of-contents/bulk-delete', [TableOfContentController::class, 'bulkDelete'])->name('table-of-contents.bulk-delete');

                // Publication Team Management (nested under publications)
                Route::get('teams', [PublicationTeamController::class, 'index'])->name('teams.index');
                Route::get('teams/create', [PublicationTeamController::class, 'create'])->name('teams.create');
                Route::post('teams', [PublicationTeamController::class, 'store'])->name('teams.store');
                Route::get('teams/show', [PublicationTeamController::class, 'show'])->name('teams.show');
                Route::delete('teams/{team}', [PublicationTeamController::class, 'destroy'])->name('teams.destroy');
                Route::put('teams/{team}/role', [PublicationTeamController::class, 'updateRole'])->name('teams.update-role');
                Route::delete('teams/bulk-remove', [PublicationTeamController::class, 'bulkRemove'])->name('teams.bulk-remove');
                Route::get('teams/data', [PublicationTeamController::class, 'getTeamMembers'])->name('teams.data');
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

        // Left-Right Content Management
        Route::resource('left-right-contents', \App\Http\Controllers\Admin\LeftRightContentController::class);
        Route::post('/left-right-contents/{leftRightContent}/toggle-status', [\App\Http\Controllers\Admin\LeftRightContentController::class, 'toggleStatus'])->name('left-right-contents.toggle-status');

        // Pages Management
        Route::resource('pages', AdminPageController::class);
        Route::post('/pages/{page}/toggle-status', [AdminPageController::class, 'toggleStatus'])->name('pages.toggle-status');

        // Meta Tags Management
        Route::resource('meta-tags', MetaTagController::class);
        Route::post('/meta-tags/{metaTag}/toggle-status', [MetaTagController::class, 'toggleStatus'])->name('meta-tags.toggle-status');

        // Image Upload for CKEditor
        Route::post('/upload-blog-editor-image', [DashboardController::class, 'uploadEditorImage'])->name('upload-blog-editor-image');

        // Logout
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    });
