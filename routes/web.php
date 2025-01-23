<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\AlertController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StockInController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
})->name('auth#login');
Route::post('loginUser', [AuthController::class, 'loginUser'])->name('loginUser');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::middleware('admin_auth')->group(function () {
        Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

        Route::get('customercreate', [CustomerController::class, 'customercreate'])->name('customercreate');
        Route::get('/customerlistPage', [CustomerController::class, 'customerlistPage'])->name('customerlistPage');
        Route::prefix('admin')->group(function () {
            // category
            Route::middleware('role:super admin')->prefix('category')->group(function () {
                Route::post('updateCategory', [CategoryController::class, 'updateCategory'])->name('updateCategory');
                Route::post('deleteCategory', [CategoryController::class, 'deleteCategory'])->name('deleteCategory');
            });
            Route::group(['middleware' => 'permission:create category'], function () {
                Route::get('/createCategoryPage', [CategoryController::class, 'createCategoryPage'])->name('admin#createCategoryPage');
                Route::post('/createCategory', [CategoryController::class, 'createCategory'])->name('admin#createCategory');
            });
            Route::group(['middleware' => 'permission:view category page'], function () {
                Route::get('category', [CategoryController::class, 'categoryIndex'])->name('category.index');
            });

            // product
            Route::middleware('role:super admin')->prefix('product')->group(function () {
                Route::post('updateProduct', [ProductController::class, 'updateProduct'])->name('updateProduct');
                Route::post('deleteProduct', [ProductController::class, 'deleteProduct'])->name('deleteProduct');
                // Route::delete('/products', [ProductController::class, 'destroy'])->name('products.destroy');
                Route::get('productEdit/{productId}', [ProductController::class, 'productEdit'])->name('productEdit');
                Route::get('recently_deleted_product', [ProductController::class, 'recentlyDeletedProduct'])->name('recentlyDeletedProduct');
                Route::get('restored_product', [ProductController::class, 'restoreProduct'])->name('restoreProduct');
            });
            Route::group(['middleware' => 'permission:view product page|create product'], function () {
                Route::get('/createProductPage', [ProductController::class, 'createProductPage'])->name('admin#createProductPage');
                Route::post('/createProduct', [ProductController::class, 'createProduct'])->name('createProduct');
                Route::get('/productlistPage', [ProductController::class, 'productlistPage'])->name('productlistPage');
                Route::get('productDetail/{productId}', [ProductController::class, 'productDetail'])->name('productDetail');
            });

            // stock in
            Route::prefix('stock')->group(function () {
                Route::group(['middleware' => 'permission:create stock'], function () {
                    Route::get('/createStockPage', [StockInController::class, 'createStockPage'])->name('admin#createStockPage');
                    Route::post('/createStock', [StockInController::class, 'createStock'])->name('createStock');
                });
                Route::group(['middleware' => 'permission:view stock page'], function () {
                    Route::get('/inventory', [InventoryController::class, 'inventory'])->name('inventory');
                    Route::get('/stockindetail', [InventoryController::class, 'stockindetail'])->name('stockindetail');
                    Route::post('/alertStock', [AlertController::class, 'alertStock'])->name('alertStock');
                });
            });

            // user CRUD
            Route::group(['middleware' => 'permission:view user page'], function () {
                Route::get('/userLists', [AdminController::class, 'userLists'])->name('admin#userLists');
                Route::get('/userLists/table', [AdminController::class, 'userListsTable'])->name('admin#userListsTable');
            });

            Route::middleware('role:super admin')->group(function () {
                Route::get('/createUserPage', [AdminController::class, 'createUserPage'])->name('admin#createUserPage');
                Route::post('/createUser', [AdminController::class, 'createUser'])->name('createUser');
                Route::post('updateUser', [AdminController::class, 'updateUser'])->name('updateUser');
                Route::post('deleteUser', [AdminController::class, 'deleteUser'])->name('admin#deleteUser');
                Route::get('updatePage/{userId}', [AdminController::class, 'updatePage'])->name('admin#updatePage');
                Route::post('changeRole', [AdminController::class, 'changeRole'])->name('changeRole');
            });
        });

        // rolePermission
        Route::middleware('role:super admin')->group(function () {
            Route::resource('permissions', PermissionController::class);
            Route::post('permissions/delete', [PermissionController::class, 'destoryPermission'])->name('destoryPermission');
            Route::post('permission/update', [PermissionController::class, 'updatePermission'])->name('updatePermission');

            // Roles
            Route::resource('roles', RoleController::class);
            Route::post('roles/delete', [RoleController::class, 'destoryRole'])->name('destroyRole');
            // Route::get('roles/{roleId}/delete', [App\Http\Controllers\RoleController::class, 'destory']);
            Route::get('roles/{roleId}/addPermissionToRole', [RoleController::class, 'addPermissionToRole']);
            Route::put('roles/{roleId}/givePermissions', [RoleController::class, 'givePermissionsToRole'])->name('role#givePermissionsToRole');
            Route::post('role/update', [RoleController::class, 'updateRole'])->name('updateRole');

            // data tables
            Route::get('roles', [RoleController::class, 'index'])->name('roles.index');
            // Route::post('role/update/{id}',[RoleController::class,'updateRole'])->name('updateRole');
        });

        // profile
        Route::group(['middleware' => ['permission:view profile|edit profile|change password']], function () {
            Route::prefix('profile')->group(function () {
                Route::get('profilePage', [UserController::class, 'profilePage'])->name('profilePage');
                Route::post('changePassword', [UserController::class, 'changePassword'])->name('changePassword');
                Route::post('updateProfile', [UserController::class, 'updateProfile'])->name('updateProfile');
            });
        });

        // dashboard
        Route::prefix('ajax/')->group(function () {
            Route::get('dailySale', [AjaxController::class, 'dailySale'])->name('dailySale');
            Route::get('weeklySale', [AjaxController::class, 'weeklySale'])->name('weeklySale');
            Route::get('monthlySale', [AjaxController::class, 'monthlySale'])->name('monthlySale');
            Route::get('yearlySale', [AjaxController::class, 'yearlySale'])->name('yearlySale');
        });

        // invoice
        Route::prefix('invoice')->group(function () {
            Route::get('invoice', [InvoiceController::class, 'invoice'])->name('invoice');
            Route::get('invoicePage', [InvoiceController::class, 'invoicePage'])->name('invoicePage');
        });

        // alert
        Route::get('alert', [AdminController::class, 'alert'])->name('alert');
    });
});

// forgetPassword
Route::get('forgotPasswordPage', [AuthController::class, 'forgotPasswordPage'])->name('forgotPasswordPage');
Route::post('forgotPassword', [AuthController::class, 'forgotPassword'])->name('forgotPassword');
Route::get('resetPasswordPage/{token}', [AuthController::class, 'resetPasswordPage'])->name('resetPasswordPage');
Route::post('resetPassword', [AuthController::class, 'resetPassword'])->name('resetPassword');

Route::patch('/fcm-token', [AlertController::class, 'updateToken'])->name('fcmToken');
Route::post('/send-notification', [AlertController::class, 'notification'])->name('notification');
require __DIR__.'/auth.php';
