<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cookie;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\NetopiaController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdminPageController;
use App\Http\Controllers\DiscountRuleController;
use App\Http\Controllers\PageAdminController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\VariationController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\HomepageContentController;

Route::get('/', [PageController::class, 'home']);
Route::post('/message', [MessageController::class, 'store']);
Route::get('/about', [PageController::class, 'about']);
Route::get('/terms-conditions', [PageController::class, 'termsConditions']);
Route::get('/contact', [PageController::class, 'contact']);
Route::get('/refund-policy', [PageController::class, 'refundPolicy']);


Route::get('/change', [PageController::class, 'changeLang']);

Route::post('/subscribe', [SubscriberController::class, 'store'])->name('subscribe');

Route::get('/checkout', [OrderController::class, 'checkout']);
Route::get('/success', [OrderController::class, 'success'])->name('success');
Route::get('/payment', [OrderController::class, 'payment'])->name('payment');
Route::post('/checkout/stripe', [StripeController::class, 'checkout']);
Route::post('/checkout/netopia', [NetopiaController::class, 'checkout']);


// Route::get('/cart', [OrderController::class, 'cart']);

Route::middleware('guest')->group(function () {
    Route::get('/signup', [AuthController::class, 'signup'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/auth', [AuthController::class, 'auth']);
    Route::get('/password/reset', [AuthController::class, 'resetPassword'])->name('password.reset');
    Route::post('/password/email', [AuthController::class, 'resetPasswordEmail'])->name('password.email');
    Route::get('/reset-password', [AuthController::class, 'resetPasswordGet']);
    Route::post('/password/update', [AuthController::class, 'resetPasswordUpdate']);
});

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/account', [UserController::class, 'account']);
    Route::post('/account/update', [UserController::class, 'update']);
    Route::post('/account/update-pass', [UserController::class, 'update_pass']);
    Route::get('/account/password', [UserController::class, 'password']);
});

Route::get('/test', function () {
    return json_decode(Cookie::get('cart', '[]'), true);
});

Route::get('/blogs', [PageController::class, 'blogs']);
Route::get('/blogs/{post:slug}', [PageController::class, 'post'])->name('blogs.post');
Route::post('/comment/{post}/store', [CommentController::class, 'store']);
Route::post('/comment/visible/{comment}', [CommentController::class, 'update']);

// Route::get('/invoice', [InvoiceController::class, 'createInvoice']);
Route::get('/invoice/{order}', [InvoiceController::class, 'getInvoice']);
// Route::get('/test-invoice', [InvoiceController::class, 'test']);

// Route::get('/services', [PageController::class, 'services']);
// Route::post('/review/{service}/store', [ReviewController::class, 'store']);
// Route::get('/{service:slug}', [PageController::class, 'service']);
// // Route::get('/{post:slug}', [PageController::class, 'post'])->name('blogs.post');


Route::prefix('/admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [AdminPageController::class, 'index']);

    Route::get('/dashboard', [AdminPageController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/users', [AdminPageController::class, 'users'])->name('admin.users');
    Route::put('/users/{user}', [AdminPageController::class, 'updateUser']);
    Route::delete('/users/{user}', [AdminPageController::class, 'deleteUser']);

    Route::get('/account', [AdminPageController::class, 'account']);

    Route::resource('services', ServiceController::class);

    Route::get('/services/{service}/variation-types', [VariationController::class, 'variation_types']);
    Route::post('/services/{service}/variation-types', [VariationController::class, 'variation_types_store']);
    Route::get('/services/variation-types/{variation_type}/edit', [VariationController::class, 'variation_types_edit']);
    Route::put('/services/variation-types/{variation_type}/update', [VariationController::class, 'variation_types_update']);
    Route::delete('/services/variation-types/{variation_type}/delete', [VariationController::class, 'variation_types_destroy']);

    Route::get('/services/variation-types/{variation_type}/variations', [VariationController::class, 'variations']);
    Route::post('/services/variation-types/{variation_type}/variations', [VariationController::class, 'variations_store']);
    Route::delete('/services/variation-types/variations/{variation}/delete', [VariationController::class, 'variations_destroy']);

    Route::get('/services/{service}/faq', [FaqController::class, 'create']);
    Route::post('/services/faq/', [FaqController::class, 'store']);
    Route::get('/services/faq/{faq}/edit', [FaqController::class, 'edit']);
    Route::put('/services/faq/{faq}/', [FaqController::class, 'update']);
    Route::delete('/services/faq/{faq}', [FaqController::class, 'destroy']);

    Route::get('/categories', [CategoryController::class, 'index']);
    Route::post('/categories', [CategoryController::class, 'store']);
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit']);
    Route::put('/categories/{category}', [CategoryController::class, 'update']);
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy']);

    Route::get('/orders', [OrderController::class, 'orders']);
    Route::get('/orders/{order}', [OrderController::class, 'order']);

    Route::get('/discounts', [DiscountRuleController::class, 'index']);
    Route::post('/discounts', [DiscountRuleController::class, 'store']);
    Route::delete('/discounts/{discount}', [DiscountRuleController::class, 'destroy']);

    Route::get('/reviews-ratings', [ReviewController::class, 'index']);
    Route::post('/review/visible/{review}', [ReviewController::class, 'update']);

    // Route::get('/sliders', [PageAdminController::class, 'adminSliders']);
    // Route::post('/sliders/store', [PageAdminController::class, 'sliderStore']);
    Route::get('/home-page', [PageAdminController::class, 'home']);
    Route::get('/home-insta', [PageAdminController::class, 'insta']);
    Route::get('/promotions', [PromotionController::class, 'create']);
    Route::post('/promotions', [PromotionController::class, 'store']);
    Route::get('/promotions/{promotion}/edit', [PromotionController::class, 'edit']);
    Route::put('/promotions/{promotion}/update', [PromotionController::class, 'update']);
    Route::delete('/promotions/{promotion}', [PromotionController::class, 'destroy']);
    Route::post('/home-page', [HomepageContentController::class, 'update']);
    Route::post('/home-insta', [HomepageContentController::class, 'insta_update']);
    Route::delete('/home-insta/{id}', [HomepageContentController::class, 'insta_delete']);
    Route::get('/about-page', [PageAdminController::class, 'about']);
    Route::get('/terms-conditions-page', [PageAdminController::class, 'termsConditions']);
    Route::get('/refund-policy', [PageAdminController::class, 'refundPolicy']);
    Route::post('/store-page', [PageAdminController::class, 'store_page']);

    Route::get('/posts', [PostController::class, 'index']);
    Route::get('/posts/create', [PostController::class, 'create'])->name('admin.posts.create');
    Route::post('/posts/store', [PostController::class, 'store']);
    Route::get('/posts/{id}/edit', [PostController::class, 'edit']);
    Route::post('/posts/{id}', [PostController::class, 'update']);
    Route::delete('/posts/{id}', [PostController::class, 'destroy']);
    Route::get('/posts/comments', [CommentController::class, 'index']);

    Route::get('/messages', [MessageController::class, 'index']);
    Route::get('/messages/{message}', [MessageController::class, 'show']);
    Route::delete('/messages/{message}', [MessageController::class, 'destroy']);

    Route::get('/views', [AdminPageController::class, 'views']);
    Route::get('/subscribers', [AdminPageController::class, 'subscribers']);
    Route::delete('/subscribers/{subscriber}', [AdminPageController::class, 'subscriberDelete']);

    Route::get('/settings/general', [AdminPageController::class, 'general'])->name('admin.settings.general');
    Route::post('/settings/general/basic', [AdminPageController::class, 'basic'])->name('admin.settings.general.basic');
    Route::post('/settings/general/contact', [AdminPageController::class, 'contact'])->name('admin.settings.general.contact');
    Route::post('/settings/general/api_key', [AdminPageController::class, 'api_key'])->name('admin.settings.general.api_key');

    Route::get('/settings/social-media', [AdminPageController::class, 'socialMedia'])->name('admin.settings.social-media');
    Route::post('/settings/social-media', [AdminPageController::class, 'socialMediaUpdate'])->name('admin.settings.social-media.update');

    Route::get('/settings/subscription', [AdminPageController::class, 'subscription'])->name('admin.settings.subscription');
    Route::post('/settings/subscription', [AdminPageController::class, 'subs_update'])->name('admin.settings.subscription.update');

    Route::fallback(function () {
        return view('errors.404-admin');
    });
});


Route::get('/services', [PageController::class, 'services']);
Route::post('/review/{service}/store', [ReviewController::class, 'store']);
Route::get('/{service:slug}', [PageController::class, 'service']);
// Route::get('/{post:slug}', [PageController::class, 'post'])->name('blogs.post');

Route::fallback(function () {
    abort(404);
});
