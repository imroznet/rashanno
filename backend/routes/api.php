// Public routes
Route::post('auth/login', [AuthController::class, 'login']);
Route::post('auth/register', [AuthController::class, 'register']);

// Protected routes
Route::middleware('jwt.auth')->group(function () {
    Route::get('orders', [OrderController::class, 'index']);
    Route::post('checkout', [CheckoutController::class, 'createCheckout']);
    Route::post('push/register', [PushController::class, 'registerToken']);
});

// Admin routes
Route::middleware(['jwt.auth', 'admin.secret'])->prefix('admin')->group(function () {
    Route::get('settings', [AdminController::class, 'getSettings']);
    Route::post('products', [ProductController::class, 'store']);
    Route::put('products/{id}', [ProductController::class, 'update']);
    Route::delete('products/{id}', [ProductController::class, 'destroy']);
});