<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\AdminFoodController;
use App\Http\Controllers\AdminImpostazioniGeneraliController;

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ErrorController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\AdminOrderDetailController;
use App\Http\Controllers\AdminOrderStateController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/error', [ErrorController::class, 'index']);
Route::get('/category/{category:slug}', [CategoryController::class, 'show'])->name("category.show");
Route::get('/search', [SearchController::class, 'doSearch'])->name("searchGlobally");


Route::prefix("cart")->group(function () {
    Route::get("", [CartController::class, "show"])->name("cart.show");
    Route::post('addToCart', [CartController::class, 'postAddToCart'])->name('cart.add_item');
    Route::post('removeFromCart', [CartController::class, 'removeFromCart'])->name('cart.remove_item');
    Route::post('increaseQty', [CartController::class, 'increaseQty'])->name('cart.increase_qty');
    Route::post('decreaseQty', [CartController::class, 'decreaseQty'])->name('cart.decrease_qty');

    Route::prefix('checkout')->middleware(['auth', 'verified', 'cartIsFilled'])->group(function () {

        //Scegliere consegna o ritiro
        Route::get('step1', [CheckoutController::class, "step1"])->name("checkout.step1");
        Route::post('step1', [CheckoutController::class, "storeStep1"])->name("checkout.step1");

        //Se scelto consegna mettere l'indirizzo e l'orario
        Route::get('step2', [CheckoutController::class, "step2"])->name("checkout.step2");;
        Route::post('step2', [CheckoutController::class, "storeStep2"])->name("checkout.step2");

        //Riepilogo ordine e possibilità di inserire una nota per l'ordine
        Route::get('step3', [CheckoutController::class, "step3"])->name("checkout.step3");;
    });
});

Route::prefix("account")->group(function () {

    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('', [AccountController::class, 'index'])->name("account.index");
        Route::get('change-password', [AccountController::class, "changePassword"])->name("account.change-password");
        Route::get('my-account', [AccountController::class, "myAccount"])->name("account.my-account");
    });

    Route::prefix("orders")->middleware(['auth', 'verified'])->group(function () {

        Route::get("", [OrderController::class, "list"])->name("orders.list");
        Route::post("create", [OrderController::class, "create"])->name("orders.create");
        Route::get("view/{order}", [OrderController::class, "orderView"])->name("orders.view");
        Route::get("pay/{order}", [OrderController::class, "pay"])->name("orders.pay")->middleware(["orderBelongsToCustomer", "orderIsNotPaid"]);
        Route::get("pay/{order}/completato", [OrderController::class, "storePayment"])->name("orders.paymentCompleted");
    });
});


Route::prefix('admin')->middleware('can:isAdmin')->group(function () {

    Route::prefix("settings")->group(function () {
        Route::get("generals", [AdminImpostazioniGeneraliController::class, "index"])->name("admin.settings.generals");
        Route::post("generals", [AdminImpostazioniGeneraliController::class, "store"])->name("admin.settings.generals");
    });

    Route::prefix("catalog")->group(function () {
        Route::prefix("categories")->group(function () {

            Route::get("", [AdminCategoryController::class, "list"])->name("admin.category.list");
            Route::get("create", [AdminCategoryController::class, "create"])->name("admin.category.create");
            Route::get("edit/{category}", [AdminCategoryController::class, "edit"])->name("admin.category.edit");
            Route::get("delete/{category}", [AdminCategoryController::class, "delete"])->name("admin.category.delete");

            Route::post("create", [AdminCategoryController::class, "store"])->name("admin.category.store");
            Route::post("edit/{category}", [AdminCategoryController::class, "update"])->name("admin.category.update");
            Route::post("delete/{category}", [AdminCategoryController::class, "destroy"])->name("admin.category.destroy");;
        });

        Route::prefix("foods")->group(function () {

            Route::get("", [AdminFoodController::class, "list"])->name("admin.food.list");
            Route::get("create", [AdminFoodController::class, "create"])->name("admin.food.create");
            Route::get("edit/{food}", [AdminFoodController::class, "edit"])->name("admin.food.edit");
            Route::get("delete/{food}", [AdminFoodController::class, "delete"])->name("admin.food.delete");

            Route::post("create", [AdminFoodController::class, "store"])->name("admin.food.store");
            Route::post("edit/{food}", [AdminFoodController::class, "update"])->name("admin.food.update");
            Route::post("delete/{food}", [AdminFoodController::class, "destroy"])->name("admin.food.destroy");;
        });
    });

    Route::prefix("sales")->group(function () {
        Route::prefix("orders")->group(function () {

            Route::get("", [AdminOrderController::class, "list"])->name("admin.order.list");
            Route::get("create", [AdminOrderController::class, "create"])->name("admin.order.create");
            Route::get("edit/{order}", [AdminOrderController::class, "edit"])->name("admin.order.edit");
            Route::get("delete/{order}", [AdminOrderController::class, "delete"])->name("admin.order.delete");

            Route::post("create", [AdminOrderController::class, "store"])->name("admin.order.store");
            Route::post("edit/{order}", [AdminOrderController::class, "update"])->name("admin.order.update");
            Route::post("delete/{order}", [AdminOrderController::class, "destroy"])->name("admin.order.destroy");

            Route::post("updateOrderState/{order}", [AdminOrderController::class, "updateOrderState"])->name("admin.order.updateOrderState");
            Route::post("updateOrderDeliveryType/{order}", [AdminOrderController::class, "updateOrderDeliveryType"])->name("admin.order.updateOrderDeliveryType");
            Route::post("updateOrderDeliveryInfo/{order}", [AdminOrderController::class, "updateOrderDeliveryInfo"])->name("admin.order.updateOrderDeliveryInfo");
            Route::post("addOrderDetail/{order}", [AdminOrderController::class, "addOrderDetail"])->name("admin.order.addOrderDetail");
            Route::post("updateOrderNote/{order}", [AdminOrderController::class, "updateOrderNote"])->name("admin.order.updateOrderNote");
        });

        Route::prefix("orderDetails")->group(function () {
            Route::post("increaseQty/{orderDetail}", [AdminOrderDetailController::class, "increaseQty"])->name("admin.orderDetails.increaseQty");
            Route::post("reduceQty/{orderDetail}", [AdminOrderDetailController::class, "reduceQty"])->name("admin.orderDetails.reduceQty");
            Route::post("removeItem/{orderDetail}", [AdminOrderDetailController::class, "removeItem"])->name("admin.orderDetails.removeItem");
        });

        Route::prefix("stati-ordine")->group(function () {

            Route::get("", [AdminOrderStateController::class, "list"])->name("admin.order-state.list");
            Route::get("create", [AdminOrderStateController::class, "create"])->name("admin.order-state.create");
            Route::get("edit/{orderState}", [AdminOrderStateController::class, "edit"])->name("admin.order-state.edit");
            Route::get("delete/{orderState}", [AdminOrderStateController::class, "delete"])->name("admin.order-state.delete");

            Route::post("create", [AdminOrderStateController::class, "store"])->name("admin.order-state.store");
            Route::post("edit/{orderState}", [AdminOrderStateController::class, "update"])->name("admin.order-state.update");
            Route::post("delete/{orderState}", [AdminOrderStateController::class, "destroy"])->name("admin.order-state.destroy");
        });
    });
});
