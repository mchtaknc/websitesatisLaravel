<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use Laravel\Fortify\Http\Controllers\ConfirmablePasswordController;
use Laravel\Fortify\Http\Controllers\ConfirmedPasswordStatusController;
use Laravel\Fortify\Http\Controllers\EmailVerificationNotificationController;
use Laravel\Fortify\Http\Controllers\EmailVerificationPromptController;
use Laravel\Fortify\Http\Controllers\NewPasswordController;
use Laravel\Fortify\Http\Controllers\PasswordController;
use Laravel\Fortify\Http\Controllers\PasswordResetLinkController;
use Laravel\Fortify\Http\Controllers\ProfileInformationController;
use Laravel\Fortify\Http\Controllers\RecoveryCodeController;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;
use Laravel\Fortify\Http\Controllers\VerifyEmailController;

use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\CustomersController;
use App\Http\Controllers\Admin\PackagesController;
use App\Http\Controllers\Admin\ThemesController;
use App\Http\Controllers\Admin\ThemesCategoryController;
use App\Http\Controllers\Admin\ThemesImageController;
use App\Http\Controllers\Admin\OrdersController as AdminOrdersController;

use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ThemesController as ThemesControllerFront;
use App\Http\Controllers\Front\CouponController;
use App\Http\Controllers\Front\ProductController;
use App\Http\Controllers\Front\AccountController;
use App\Http\Controllers\Front\OrdersController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\PasswordChangeController;
use App\Http\Controllers\Front\TicketController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::group(['middleware' => config('fortify.middleware', ['web'])], function () {
    // Authentication...
    Route::get('/giris', [AuthenticatedSessionController::class, 'create'])
        ->middleware(['guest'])
        ->name('login');

    $limiter = config('fortify.limiters.login');

    Route::post('/giris', [AuthenticatedSessionController::class, 'store'])
        ->middleware(array_filter([
            'guest',
            $limiter ? 'throttle:' . $limiter : null,
        ]));

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

    // Password Reset...
    if (Features::enabled(Features::resetPasswords())) {
        Route::get('/sifremi-unuttum', [PasswordResetLinkController::class, 'create'])
            ->middleware(['guest'])
            ->name('password.request');

        Route::post('/sifremi-unuttum', [PasswordResetLinkController::class, 'store'])
            ->middleware(['guest'])
            ->name('password.email');

        Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
            ->middleware(['guest'])
            ->name('password.reset');

        Route::post('/reset-password', [NewPasswordController::class, 'store'])
            ->middleware(['guest'])
            ->name('password.update');
    }

    // Registration...
    if (Features::enabled(Features::registration())) {
        Route::get('/kayitol', [RegisteredUserController::class, 'create'])
            ->middleware(['guest'])
            ->name('register');

        Route::post('/kayitol', [RegisteredUserController::class, 'store'])
            ->middleware(['guest']);
    }

    // Email Verification...
    if (Features::enabled(Features::emailVerification())) {
        Route::get('/email/verify', [EmailVerificationPromptController::class, '__invoke'])
            ->middleware(['auth'])
            ->name('verification.notice');

        Route::get('/email/verify/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
            ->middleware(['auth', 'signed', 'throttle:6,1'])
            ->name('verification.verify');

        Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
            ->middleware(['auth', 'throttle:6,1'])
            ->name('verification.send');
    }

    // Profile Information...
    if (Features::enabled(Features::updateProfileInformation())) {
        Route::put('/user/profile-information', [ProfileInformationController::class, 'update'])
            ->middleware(['auth'])
            ->name('user-profile-information.update');
    }

    // Passwords...
    if (Features::enabled(Features::updatePasswords())) {
        Route::put('/user/password', [PasswordController::class, 'update'])
            ->middleware(['auth'])
            ->name('user-password.update');
    }

    // Password Confirmation...
    Route::get('/user/confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->middleware(['auth'])
        ->name('password.confirm');

    Route::post('/user/confirm-password', [ConfirmablePasswordController::class, 'store'])
        ->middleware(['auth']);

    Route::get('/user/confirmed-password-status', [ConfirmedPasswordStatusController::class, 'show'])
        ->middleware(['auth'])
        ->name('password.confirmation');
});

Route::group(['middleware' => ['auth', 'verified', 'admin'], 'prefix' => 'admin'], function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('admin');
    //Siparişler
    Route::get('/orders', [AdminOrdersController::class, 'index'])->name('admin.orders');
    Route::post('/orderlist', [AdminOrdersController::class, 'orders'])->name('admin.orders.list');
    Route::get('/orders/create', [AdminOrdersController::class, 'create'])->name('admin.orders.create');
    Route::post('/orders', [AdminOrdersController::class, 'store'])->name('admin.orders.store');
    Route::get('/orders/edit/{id}', [AdminOrdersController::class, 'edit'])->name('admin.orders.edit');
    Route::put('/orders/{id}', [AdminOrdersController::class, 'update'])->name('admin.orders.update');
    //Kullanıcılar
    Route::get('/users', [UsersController::class, 'index'])->name('admin.users');
    Route::get('/users/create', [UsersController::class, 'create'])->name('admin.users.create');
    Route::post('/users', [UsersController::class, 'store'])->name('admin.users.store');
    Route::get('/users/edit/{id}', [UsersController::class, 'edit'])->name('admin.users.edit');
    Route::put('/users/{id}', [UsersController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{id}', [UsersController::class, 'destroy'])->name('admin.users.destroy');
    //Müşteriler
    Route::get('/customers', [CustomersController::class, 'index'])->name('admin.customers');
    Route::get('/customers/create', [CustomersController::class, 'create'])->name('admin.customers.create');
    Route::post('/customers', [CustomersController::class, 'store'])->name('admin.customers.store');
    Route::get('/customers/edit/{id}', [CustomersController::class, 'edit'])->name('admin.customers.edit');
    Route::put('/customers/{id}', [CustomersController::class, 'update'])->name('admin.customers.update');
    Route::delete('/customers/{id}', [CustomersController::class, 'destroy'])->name('admin.customers.destroy');
    //Paketler
    Route::post('/packagePrice', [PackagesController::class, 'getPackagePrice'])->name('admin.package.price');
    Route::get('/packages', [PackagesController::class, 'index'])->name('admin.packages');
    Route::get('/packages/create', [PackagesController::class, 'create'])->name('admin.packages.create');
    Route::post('/packages', [PackagesController::class, 'store'])->name('admin.packages.store');
    Route::get('/packages/edit/{id}', [PackagesController::class, 'edit'])->name('admin.packages.edit');
    Route::put('/packages/{id}', [PackagesController::class, 'update'])->name('admin.packages.update');
    Route::delete('/packages/{id}', [PackagesController::class, 'destroy'])->name('admin.packages.destroy');
    //Temalar
    Route::get('/themes', [ThemesController::class, 'index'])->name('admin.themes');
    Route::get('/themes/create', [ThemesController::class, 'create'])->name('admin.themes.create');
    Route::post('/themes', [ThemesController::class, 'store'])->name('admin.themes.store');
    Route::get('/themes/edit/{id}', [ThemesController::class, 'edit'])->name('admin.themes.edit');
    Route::put('/themes/{id}', [ThemesController::class, 'update'])->name('admin.themes.update');
    Route::delete('/themes/{id}', [ThemesController::class, 'destroy'])->name('admin.themes.destroy');
    //Tema Kategori
    Route::get('/themes/category', [ThemesCategoryController::class, 'index'])->name('admin.themes.category');
    Route::get('/themes/category/create', [ThemesCategoryController::class, 'create'])->name('admin.themes.category.create');
    Route::post('/themes/category', [ThemesCategoryController::class, 'store'])->name('admin.themes.category.store');
    Route::get('/themes/category/edit/{id}', [ThemesCategoryController::class, 'edit'])->name('admin.themes.category.edit');
    Route::put('/themes/category/{id}', [ThemesCategoryController::class, 'update'])->name('admin.themes.category.update');
    Route::delete('/themes/category/{id}', [ThemesCategoryController::class, 'destroy'])->name('admin.themes.category.destroy');
    //Tema Resimleri
    Route::post('/theme_image/featured', [ThemesImageController::class, 'featured'])->name('admin.theme_image.featured');
    Route::post('/theme_image/remove', [ThemesImageController::class, 'remove'])->name('admin.theme_image.remove');
});

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/temalar', [ThemesControllerFront::class, 'index'])->name('themes');
Route::get('/tema/{id}', [ThemesControllerFront::class, 'show'])->name('theme');
Route::post('/kupon-kodu', [CouponController::class, 'attachCoupon'])->name('product.attachcoupon');
Route::get('/sepete-ekle/{id}', [ProductController::class, 'getAddtoCart'])->name('product.addToCart');
Route::get('/sepet-guncelle', [ProductController::class, 'updateTotalPrice'])->name('product.updateTotalPrice');
Route::get('/form/{id}', [ProductController::class, 'form'])->name('product.form');
Route::post('/form/{id}', [ProductController::class, 'addDomain'])->name('product.domain.add');
Route::post('/whois', [ProductController::class, 'domainWhois'])->name('whois');
Route::get('/sepet', [ProductController::class, 'getCart'])->name('product.cart');
Route::get('/sepet/cikart/{id}', [ProductController::class, 'removeCart'])->name('product.removeCart');
Route::get('/odeme', [ProductController::class, 'checkoutForm'])->name('product.checkout.show');
Route::post('/odeme', [CartController::class, 'checkout'])->name('product.checkout');
Route::post('/odeme-sonuc/{user}/{order}', [CartController::class, 'callback'])->name('product.callback');
Route::get('/hakkimizda', function () {
    return view('front.about-us');
})->name('about-us');
Route::get('/iletisim', function () {
    return view('front.contact');
})->name('contact');

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/musteri-paneli', function () {
        return view('front.dashboard.default');
    })->name('dashboard');
    Route::get('/bilgilerim', [AccountController::class, 'index'])->name('account');
    Route::put('/bilgilerim', [AccountController::class, 'update'])->name('account.update');

    Route::get('/siparislerim', [OrdersController::class, 'index'])->name('orders');
    Route::post('/siparislerim', [OrdersController::class, 'orders'])->name('orders');

    Route::get('/taleplerim', [TicketController::class, 'index'])->name('tickets');
    Route::post('/taleplerim', [TicketController::class, 'tickets'])->name('tickets');
    Route::get('/talep/olustur', [TicketController::class, 'create'])->name('ticket.create');
    Route::post('/talep/olustur', [TicketController::class, 'store'])->name('ticket.store');
    Route::get('/talep/{uniqid}', [TicketController::class, 'show'])->name('ticket.show');
    Route::post('/talep/{id}', [TicketController::class, 'storeReply'])->name('ticket.storeReply');
    Route::put('/talep/{uniqid}', [TicketController::class, 'update'])->name('ticket.update');

    Route::get('/sifre-degistir', [PasswordChangeController::class, 'index'])->name('password');
    Route::post('/sifre-degistir', [PasswordChangeController::class, 'store'])->name('password');
});
