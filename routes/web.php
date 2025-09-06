<?php

use App\Http\Controllers\AccountantDashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DeliveryDashboardController;
use App\Http\Controllers\EmployeeDashboardController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ManufacturerController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Seller\PromotionsController;
use App\Http\Controllers\WarehouseDashboardController;
use App\Http\Middleware\CheckEmployeeRole;
use App\Http\Middleware\RedirectEmployeeByRole;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Models\Seller;
use Illuminate\Support\Str;

// Route::get('/fix-seller-slugs', function () {
//     $sellers = Seller::all();

//     foreach ($sellers as $seller) {
//         $seller->slug = Str::slug($seller->company_name);
//         $seller->save();
//     }

//     return "Slugs updated for all sellers!";
// });


Route::get('/temp', function () {
    return view('seller.products.create-bulk');
});

// Frontend routes
Route::get('/', [FrontendController::class, 'index'])->name('home');
// Frontend routes
// Route::get('/seller/{slug}', [FrontendController::class, 'seller'])->name('select.seller');
Route::get('/manufacturers', [ManufacturerController::class, 'index'])->name('manufacturers');
Route::get('/regional-supplies', [SellerController::class, 'index'])->name('regional-supplies');

// Public Product Routes
Route::get('/products/{product}', [ProductController::class, 'show'])->name('product.show');

// Regular Login Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

    // Password Reset Routes
    Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
    Route::get('/reset-password/{token}', [AuthController::class, 'showResetPassword'])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
});

// Protected Routes for Regular Users
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// Unified Login Routes
Route::get('/unified-login', [App\Http\Controllers\UnifiedLoginController::class, 'showLoginForm'])->name('unified.login.form');
Route::post('/unified-login', [App\Http\Controllers\UnifiedLoginController::class, 'login'])->name('unified.login');

// Seller routes - specific routes must come before the catch-all profile route
Route::prefix('seller')->group(function () {
    // Guest routes
    Route::middleware('guest:seller')->group(function () {
        Route::get('/register', [App\Http\Controllers\Seller\AuthController::class, 'showRegistrationForm'])->name('seller.register');
        Route::post('/register/step1', [App\Http\Controllers\Seller\AuthController::class, 'processStep1'])->name('seller.register.step1');
        Route::post('/register/step2', [App\Http\Controllers\Seller\AuthController::class, 'processStep2'])->name('seller.register.step2');
        Route::post('/register/step3', [App\Http\Controllers\Seller\AuthController::class, 'processStep3'])->name('seller.register.step3');
        Route::get('/login', [App\Http\Controllers\Seller\AuthController::class, 'showLoginForm'])->name('seller.login');
        Route::post('/login', [App\Http\Controllers\Seller\AuthController::class, 'login'])->name('seller.login.submit');
    });

    Route::get('/coins-rewards', [App\Http\Controllers\CoinsController::class, 'index'])->name('seller.coins.index');

    // Protected Seller Routes
    Route::middleware(['auth:seller'])->group(function () {
        // Dashboard
        Route::get('/dashboard', [App\Http\Controllers\Seller\DashboardController::class, 'index'])->name('seller.dashboard');

        // Profile Management
        Route::get('/profile', [App\Http\Controllers\Seller\ProfileController::class, 'index'])->name('seller.profile');
        Route::put('/profile', [App\Http\Controllers\Seller\ProfileController::class, 'update'])->name('seller.profile.update');

        
    });

    // Employee Management
    Route::prefix('employees')->name('seller.employees.')->group(function () {
        // Employee Login
        Route::middleware('guest:employee')->group(function () {
            Route::get('/login', [App\Http\Controllers\Seller\Employee\AuthController::class, 'showLoginForm'])->name('login');
            Route::post('/login', [App\Http\Controllers\Seller\Employee\AuthController::class, 'login'])->name('login.submit');
        });

        // Protected employee routes
        Route::middleware('auth:seller')->group(function () {
            Route::get('/', [App\Http\Controllers\Seller\EmployeeController::class, 'index'])->name('index');
            Route::post('/', [App\Http\Controllers\Seller\EmployeeController::class, 'store'])->name('store');
            Route::put('/{employee}', [App\Http\Controllers\Seller\EmployeeController::class, 'update'])->name('update');
            Route::delete('/{employee}', [App\Http\Controllers\Seller\EmployeeController::class, 'destroy'])->name('destroy');
            Route::post('/{employee}/reset-password', [App\Http\Controllers\Seller\EmployeeController::class, 'resetPassword'])->name('reset-password');
        });

        // Employee dashboard routes
        Route::middleware('auth:employee', RedirectEmployeeByRole::class)->group(function () {
            Route::post('/logout', [App\Http\Controllers\Seller\Employee\AuthController::class, 'logout'])->name('logout');
            Route::get('delivery/dashboard', [DeliveryDashboardController::class, 'index'])->name('delivery.dashboard');
            Route::get('warehouse/dashboard', [WarehouseDashboardController::class, 'index'])->name('warehouse.dashboard');
            Route::get('accountant/dashboard', [AccountantDashboardController::class, 'index'])->name('accountant.dashboard');
            Route::get('dashboard', [EmployeeDashboardController::class, 'index'])->name('dashboard');
        });


        // Employee Orders
        Route::resource('orders', App\Http\Controllers\Seller\Employee\OrderController::class)->only([
            'index',
            'show',
            'update'
        ])->names([
            'index' => 'orders.index',
            'show' => 'orders.show',
            'update' => 'orders.update',
        ]);
        
        Route::get('orders/{order}/create-invoice', [App\Http\Controllers\Seller\Employee\OrderController::class, 'createInvoice'])->name('orders.create-invoice');
        Route::post('orders/{order}/store-item', [App\Http\Controllers\Seller\Employee\OrderController::class, 'storeOrderItem'])->name('orders.store-item');
        Route::post('orders/{order}/send-invoice', [App\Http\Controllers\Seller\Employee\OrderController::class, 'sendInvoice'])->name('orders.send-invoice');

        Route::get('warehouse/orders', [App\Http\Controllers\Seller\Employee\WarehouseOrderController::class, 'index'])->name('warehouse.orders');
        Route::post('warehouse/orders/assign-delivery', [App\Http\Controllers\Seller\Employee\WarehouseOrderController::class, 'assignDelivery'])->name('warehouse.orders.assign-delivery');
        Route::post('warehouse/orders/{order}/start-production', [App\Http\Controllers\Seller\Employee\WarehouseOrderController::class, 'startProduction'])->name('warehouse.orders.start-production');
        
        Route::get('delivery-person/orders', [App\Http\Controllers\Seller\Employee\DeliveryPersonOrderController::class, 'index'])->name('delivery-person.orders');

        Route::get('delivery-person/dashboard', [App\Http\Controllers\Seller\Employee\Delivery\DeliveryPersonDashboardController::class, 'index'])->name('delivery_person.dashboard');

        Route::post('delivery-person/orders/mark-delivered', [App\Http\Controllers\Seller\Employee\DeliveryPersonOrderController::class, 'markDelivered'])->name('delivery-person.orders.mark-delivered');



    });

    // Product Management
    Route::resource('products', App\Http\Controllers\Seller\ProductController::class)->names([
        'index' => 'seller.products.index',
        'create' => 'seller.products.create',
        'store' => 'seller.products.store',
        'show' => 'seller.products.show',
        'edit' => 'seller.products.edit',
        'update' => 'seller.products.update',
        'destroy' => 'seller.products.destroy',
    ]);

    Route::get('create-bulk', function () {
        return view('seller.products.create-bulk');
    })->name('seller.products.createBulk');


    Route::post('products/bulk-upload', [App\Http\Controllers\Seller\ProductController::class, 'bulkUpload'])->name('seller.products.bulkUpload');





    Route::resource('promotions', PromotionsController::class)->names([
        'index' => 'seller.promotions.index',
        'create' => 'seller.promotions.create',
        'store' => 'seller.promotions.store',
        'show' => 'seller.promotions.show',
        'edit' => 'seller.promotions.edit',
        'update' => 'seller.promotions.update',
    ]);

    Route::post('payment-settings/store', [App\Http\Controllers\Seller\PaymentSettingsController::class, 'store'])->name('seller.payment-settings.store');

    Route::post('notification-preferences/store', [App\Http\Controllers\Seller\NotificationPreferenceController::class, 'store'])->name('seller.notification-preferences.store');
    Route::get('notification-preferences/show', [App\Http\Controllers\Seller\NotificationPreferenceController::class, 'show'])->name('seller.notification-preferences.show');
    Route::post('twofactor/store', [App\Http\Controllers\Seller\TwoFactorController::class, 'store'])->name('seller.twofactor.store');
    Route::post('change-password', [App\Http\Controllers\Seller\SettingsController::class, 'changePassword'])->name('seller.change-password');
    Route::get('contact-book', [App\Http\Controllers\Seller\ContactBookController::class, 'index'])->name('seller.contact-book.index');
    Route::post('contact-book/store', [App\Http\Controllers\Seller\ContactBookController::class, 'store'])->name('seller.contact-book.store');

    Route::delete('promotions/{promotion}', [App\Http\Controllers\Seller\PromotionsController::class, 'destroy'])
        ->name('seller.promotions.destroy');

    Route::put('promotions/{promotion}/status', [App\Http\Controllers\Seller\PromotionsController::class, 'updateStatus'])
        ->name('seller.promotion.status');

    // Custom routes for bulk products

    // Route::get('products/create-bulk',function(){
    //     return view('seller.products.create-bulk');
    // })
    //     ->name('seller.products.createBulk');
    // Route::post('products/store-bulk', [ProductController::class, 'storeBulkProducts'])
    //     ->name('seller.products.storeBulk');


    // Order Management
    Route::resource('orders', App\Http\Controllers\Seller\OrderController::class)->only([
        'index',
        'show',
        'update'
    ])->names([
        'index' => 'seller.orders.index',
        'show' => 'seller.orders.show',
        'update' => 'seller.orders.update',
    ]);

    Route::get('order/bulks', [App\Http\Controllers\Seller\OrderController::class, 'bulkIndex'])
        ->name('seller.orders.bulkIndex');



    Route::put('orders/{order}/update-status', [App\Http\Controllers\Seller\OrderController::class, 'updateStatus'])
        ->name('seller.orders.update-status');

    Route::get('orders/{order}/order-split', [App\Http\Controllers\Seller\OrderController::class, 'orderSplit'])
        ->name('seller.orders.order-split');

    Route::post('orders/{order}/order-split', [App\Http\Controllers\Seller\OrderController::class, 'orderSplitStore'])
        ->name('seller.orders.split.store');

    Route::get('orders/{order}/print-invoice', [App\Http\Controllers\Seller\OrderController::class, 'printInvoice'])
        ->name('seller.orders.print-invoice');

    // Analytics
    Route::get('/dashboard', [App\Http\Controllers\Seller\AnalyticsController::class, 'index'])->name('seller.dashboard');

    // Communication
    Route::get('/communication', [App\Http\Controllers\Seller\CommunicationController::class, 'index'])->name('seller.communication');

    // Settings
    Route::get('/settings', [App\Http\Controllers\Seller\SettingsController::class, 'index'])->name('seller.settings');
    Route::put('/settings', [App\Http\Controllers\Seller\SettingsController::class, 'update'])->name('seller.settings.update');

    // Delivery Boy Management
    Route::prefix('delivery-boys')->name('seller.delivery-boys.')->group(function () {
        Route::get('/', [App\Http\Controllers\Seller\DeliveryBoyController::class, 'index'])->name('index');
        Route::post('/', [App\Http\Controllers\Seller\DeliveryBoyController::class, 'store'])->name('store');
        Route::get('/{deliveryBoy}', [App\Http\Controllers\Seller\DeliveryBoyController::class, 'show'])->name('show');
        Route::put('/{deliveryBoy}', [App\Http\Controllers\Seller\DeliveryBoyController::class, 'update'])->name('update');
        Route::delete('/{deliveryBoy}', [App\Http\Controllers\Seller\DeliveryBoyController::class, 'destroy'])->name('destroy');
        Route::post('/{deliveryBoy}/reset-password', [App\Http\Controllers\Seller\DeliveryBoyController::class, 'resetPassword'])->name('reset-password');
    });

    // Account Person Management
    Route::prefix('account-persons')->name('seller.account-persons.')->group(function () {
        Route::get('/', [App\Http\Controllers\Seller\AccountPersonController::class, 'index'])->name('index');
        Route::post('/', [App\Http\Controllers\Seller\AccountPersonController::class, 'store'])->name('store');
        Route::put('/{accountPerson}', [App\Http\Controllers\Seller\AccountPersonController::class, 'update'])->name('update');
        Route::delete('/{accountPerson}', [App\Http\Controllers\Seller\AccountPersonController::class, 'destroy'])->name('destroy');
        Route::post('/{accountPerson}/reset-password', [App\Http\Controllers\Seller\AccountPersonController::class, 'resetPassword'])->name('reset-password');
    });
    //Leads

    Route::get('/leads', [App\Http\Controllers\Seller\LeadsController::class, 'index'])->name('seller.leads');
    Route::post('/leads/assign', [App\Http\Controllers\Seller\LeadsController::class, 'assign'])->name('seller.leads.assign');

    // Logout
    Route::post('/logout', [App\Http\Controllers\Seller\AuthController::class, 'logout'])->name('seller.logout');
});

// Warehouse Employee Routes
Route::prefix('warehouse')->name('warehouse.')->group(function () {
    Route::post('/orders/{order}/start-production', [\App\Http\Controllers\Seller\Employee\WarehouseOrderController::class, 'startProduction'])->name('orders.start-production');
});

// Seller protected routes here

// Public seller profile route - must be at the end to prevent route conflicts
Route::get('/seller/{seller}', [SellerController::class, 'show'])->name('seller.public.profile')
    ->where('seller', '[0-9]+'); // Only match numeric IDs

// Employee routes
Route::prefix('employee')->name('employee.')->group(function () {
    // Auth routes
    Route::middleware(['guest:employee'])->group(function () {
        Route::get('/login', [App\Http\Controllers\Employee\Auth\LoginController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [App\Http\Controllers\Employee\Auth\LoginController::class, 'login']);
    });

    Route::middleware(['auth:employee'])->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\Employee\DashboardController::class, 'index'])->name('dashboard');
        Route::post('/logout', [App\Http\Controllers\Employee\Auth\LoginController::class, 'logout'])->name('logout');

        // Profile routes
        Route::get('/profile', [App\Http\Controllers\Employee\ProfileController::class, 'index'])->name('profile');
        Route::put('/profile', [App\Http\Controllers\Employee\ProfileController::class, 'update'])->name('profile.update');
        Route::post('/profile/experience', [App\Http\Controllers\Employee\ProfileController::class, 'addExperience'])->name('profile.add-experience');
        Route::put('/profile/skills', [App\Http\Controllers\Employee\ProfileController::class, 'updateSkills'])->name('profile.update-skills');

        // Product routes
        Route::resource('products', App\Http\Controllers\Employee\ProductController::class);

        // Order routes
        Route::resource('orders', App\Http\Controllers\Employee\OrderController::class)->only(['index', 'show', 'update']);

        // Analytics route
        Route::get('/analytics', [App\Http\Controllers\Employee\AnalyticsController::class, 'index'])->name('analytics');
    });
});

// Employee Public Profile Routes
Route::get('/employees/{employee}/profile', [App\Http\Controllers\Employee\ProfileController::class, 'publicProfile'])->name('employees.profile');
Route::post('/employees/{employee}/follow', [App\Http\Controllers\Employee\ProfileController::class, 'follow'])->name('employees.follow');
Route::post('/employees/{employee}/unfollow', [App\Http\Controllers\Employee\ProfileController::class, 'unfollow'])->name('employees.unfollow');

// Delivery Boy Routes
Route::prefix('delivery-boy')->name('delivery-boy.')->group(function () {
    Route::middleware('guest:delivery_boy')->group(function () {
        Route::get('login', [App\Http\Controllers\DeliveryBoy\Auth\LoginController::class, 'showLoginForm'])->name('login');
        Route::post('login', [App\Http\Controllers\DeliveryBoy\Auth\LoginController::class, 'login']);
    });

    Route::middleware('auth:delivery_boy')->group(function () {
        // Profile Completion Routes
        Route::get('complete-profile', [App\Http\Controllers\DeliveryBoy\ProfileController::class, 'showCompleteProfile'])->name('complete-profile.show');
        Route::post('complete-profile', [App\Http\Controllers\DeliveryBoy\ProfileController::class, 'completeProfile'])->name('complete-profile');

        // Protected routes that require profile completion
        Route::middleware([\App\Http\Middleware\CheckProfileCompletion::class])->group(function () {
            Route::post('logout', [App\Http\Controllers\DeliveryBoy\Auth\LoginController::class, 'logout'])->name('logout');
            Route::get('dashboard', [App\Http\Controllers\DeliveryBoy\DashboardController::class, 'index'])->name('dashboard');
            Route::get('profile', [App\Http\Controllers\DeliveryBoy\ProfileController::class, 'index'])->name('profile');
            Route::put('profile', [App\Http\Controllers\DeliveryBoy\ProfileController::class, 'update'])->name('profile.update');
        });
    });
});

// // Account Person Routes
// Route::prefix('account-person')->name('account-person.')->group(function () {
//     Route::middleware('guest:account-person')->group(function () {
//         Route::get('login', [App\Http\Controllers\AccountPerson\Auth\LoginController::class, 'showLoginForm'])->name('login');
//         Route::post('login', [App\Http\Controllers\AccountPerson\Auth\LoginController::class, 'login'])->name('login.submit');
//         Route::get('forgot-password', [App\Http\Controllers\AccountPerson\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
//         Route::post('forgot-password', [App\Http\Controllers\AccountPerson\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
//         Route::get('reset-password/{token}', [App\Http\Controllers\AccountPerson\Auth\ResetPasswordController::class, 'showResetForm'])->name('password.reset');
//         Route::post('reset-password', [App\Http\Controllers\AccountPerson\Auth\ResetPasswordController::class, 'reset'])->name('password.update');
//     });

//     Route::middleware('auth:account-person')->group(function () {
//         // Profile Completion Routes
//         Route::get('complete-profile', [App\Http\Controllers\AccountPerson\ProfileController::class, 'showCompleteProfile'])->name('complete-profile');
//         Route::post('complete-profile', [App\Http\Controllers\AccountPerson\ProfileController::class, 'completeProfile'])->name('complete-profile.submit');

//         Route::middleware([\App\Http\Middleware\CheckProfileCompletion::class])->group(function () {
//             Route::get('dashboard', [App\Http\Controllers\AccountPerson\DashboardController::class, 'index'])->name('dashboard');
//             Route::get('profile', [App\Http\Controllers\AccountPerson\ProfileController::class, 'index'])->name('profile');
//             Route::put('profile', [App\Http\Controllers\AccountPerson\ProfileController::class, 'update'])->name('profile.update');

//             // Transaction Routes
//             Route::get('transactions', [App\Http\Controllers\AccountPerson\TransactionController::class, 'index'])->name('transactions.index');

//             // Report Routes
//             Route::get('reports', [App\Http\Controllers\AccountPerson\ReportController::class, 'index'])->name('reports.index');

//             Route::post('logout', [App\Http\Controllers\AccountPerson\Auth\LoginController::class, 'logout'])->name('logout');
//         });
//     });
// });
