<?php

use App\Http\Controllers\ApiController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('pos', function () {
    $response = User::get();

    return response()->json($response, 200);
});

Route::post('loginApi', [ApiController::class, 'loginApi'])->name('toke');
// Route::group(['middleware' => ['auth:sanctum']], function () {

Route::prefix('user')->group(function () {
    // Route::post('userCreate', [ApiController::class, 'userCreate'])->name('userCreate');
    Route::get('getUserData', [ApiController::class, 'getUserData'])->name('getUserData');
    // Route::post('updateUserApi', [ApiController::class, 'updateUserApi'])->name('updateUserApi');
    // Route::post('deleteUserApi', [ApiController::class, 'deleteUserApi'])->name('deleteUserApi');
});

Route::prefix('category')->group(function () {
    // Route::post('createCategoryApi', [ApiController::class, 'createCategoryApi'])->name('createCategoryApi');
    Route::get('getCategoryData', [ApiController::class, 'getCategoryData'])->name('getCategoryData');
    // Route::post('deleteCategoryApi', [ApiController::class, 'deleteCategoryApi'])->name('deleteCategoryApi');
});

Route::prefix('product')->group(function () {
    // Route::post('createProductApi', [ApiController::class, 'createProductApi'])->name('createProductApi');
    Route::get('getProductData', [ApiController::class, 'getProductData'])->name('getProductData');
    // Route::post('deleteProductApi', [ApiController::class, 'deleteProductApi'])->name('deleteProductApi');
});

Route::prefix('stock')->group(function () {
    // Route::post('createStockApi', [ApiController::class, 'createStockApi'])->name('createStockApi');
    Route::get('getStockData', [ApiController::class, 'getStockData'])->name('getStockData');
    // Route::post('deleteStockApi', [ApiController::class, 'deleteStockApi'])->name('deleteStockApi');
});

Route::post('createOrder', [ApiController::class, 'createOrder'])->name('createOrder');
Route::get('totalSaleQty', [ApiController::class, 'totalSaleQty'])->name('totalSaleQty');
Route::get('invoiceId', [ApiController::class, 'invoiceId'])->name('invoiceId');
Route::get('bestSeller', [ApiController::class, 'bestSeller'])->name('bestSeller');

// Route::post('orders',function(Request $request){
//     return response()->json(['data'=>$request->all()]);
// });

Route::prefix('account')->group(function () {
    Route::post('changePasswordApi', [ApiController::class, 'changePasswordApi'])->name('changePasswordApi');
    Route::post('editProfileApi', [ApiController::class, 'editProfileApi'])->name('editProfileApi');
});
Route::post('logoutApi', [ApiController::class, 'logoutApi'])->name('logoutApi');
// });
// });
