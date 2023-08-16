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
use App\Http\Controllers\AdminOrderStateController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/error', [ErrorController::class, 'index']);
Route::get('/categoria/{category:slug}', [CategoryController::class, 'show'])->name("category.show");
Route::get('/cerca', [SearchController::class, 'doSearch'])->name("searchGlobally");


Route::prefix("carrello")->group(function () {
    Route::get("", [CartController::class, "show"])->name("cart.show");
    Route::post('aggiungiAlCarrello', [CartController::class, 'postAddToCart'])->name('cart.add_item');
    Route::post('rimuoviDalCarrello', [CartController::class, 'removeFromCart'])->name('cart.remove_item');
    Route::post('incrementaQty', [CartController::class, 'increaseQty'])->name('cart.increase_qty');
    Route::post('riduciQty', [CartController::class, 'decreaseQty'])->name('cart.decrease_qty');
});

Route::prefix("account")->group(function () {

    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('', [AccountController::class, 'dashboard'])->name("account.dashboard");
        Route::get('cambia-password', [AccountController::class, "cambiaPassword"])->name("account.cambia-password");
        Route::get('informazioni-personali', [AccountController::class, "informazioniPersonaliView"])->name("account.informazioni-personali");
    });

    Route::prefix("ordini")->middleware(['auth', 'verified'])->group(function () {

        Route::get("", [OrderController::class, "list"])->name("ordini.list");
        Route::post("crea", [OrderController::class, "crea"])->name("ordini.crea");
        Route::get("view/{order}", [OrderController::class, "orderView"])->name("ordini.view");
        Route::get("paga/{order}", [OrderController::class, "paga"])->name("ordini.paga")->middleware(["orderBelongsToCustomer", "orderIsNotPaid"]);
        Route::get("paga/{order}/completato", [OrderController::class, "storePagamento"])->name("ordini.pagamento-completato");
    });
});


Route::prefix('amministrazione')->middleware('can:isAdmin')->group(function () {

    Route::prefix("impostazioni")->group(function () {
        Route::get("generali", [AdminImpostazioniGeneraliController::class, "index"])->name("admin.impostazioni.generali");
        Route::post("generali", [AdminImpostazioniGeneraliController::class, "store"])->name("admin.impostazioni.generali");
    });

    Route::prefix("categorie")->group(function () {

        Route::get("", [AdminCategoryController::class, "list"])->name("admin.category.list");
        Route::get("crea", [AdminCategoryController::class, "create"])->name("admin.category.create");
        Route::get("modifica/{category}", [AdminCategoryController::class, "edit"])->name("admin.category.edit");
        Route::get("elimina/{category}", [AdminCategoryController::class, "delete"])->name("admin.category.delete");

        Route::post("crea", [AdminCategoryController::class, "store"])->name("admin.category.store");
        Route::post("modifica/{category}", [AdminCategoryController::class, "update"])->name("admin.category.update");
        Route::post("elimina/{category}", [AdminCategoryController::class, "destroy"])->name("admin.category.destroy");;
    });

    Route::prefix("cibi")->group(function () {

        Route::get("", [AdminFoodController::class, "list"])->name("admin.food.list");
        Route::get("crea", [AdminFoodController::class, "create"])->name("admin.food.create");
        Route::get("modifica/{food}", [AdminFoodController::class, "edit"])->name("admin.food.edit");
        Route::get("elimina/{food}", [AdminFoodController::class, "delete"])->name("admin.food.delete");

        Route::post("crea", [AdminFoodController::class, "store"])->name("admin.food.store");
        Route::post("modifica/{food}", [AdminFoodController::class, "update"])->name("admin.food.update");
        Route::post("elimina/{food}", [AdminFoodController::class, "destroy"])->name("admin.food.destroy");;
    });

    Route::prefix("ordini")->group(function () {

        Route::get("", [AdminOrderController::class, "list"])->name("admin.order.list");
        Route::get("crea", [AdminOrderController::class, "create"])->name("admin.order.create");
        Route::get("modifica/{order}", [AdminOrderController::class, "edit"])->name("admin.order.edit");
        Route::get("elimina/{order}", [AdminOrderController::class, "delete"])->name("admin.order.delete");

        Route::post("crea", [AdminOrderController::class, "store"])->name("admin.order.store");
        Route::post("modifica/{order}", [AdminOrderController::class, "update"])->name("admin.order.update");
        Route::post("elimina/{order}", [AdminOrderController::class, "destroy"])->name("admin.order.destroy");
        Route::post("updateOrderState/{order}", [AdminOrderController::class, "updateOrderState"])->name("admin.order.updateOrderState");
    });

    Route::prefix("stati-ordine")->group(function () {

        Route::get("", [AdminOrderStateController::class, "list"])->name("admin.order-state.list");
        Route::get("crea", [AdminOrderStateController::class, "create"])->name("admin.order-state.create");
        Route::get("modifica/{orderState}", [AdminOrderStateController::class, "edit"])->name("admin.order-state.edit");
        Route::get("elimina/{orderState}", [AdminOrderStateController::class, "delete"])->name("admin.order-state.delete");

        Route::post("crea", [AdminOrderStateController::class, "store"])->name("admin.order-state.store");
        Route::post("modifica/{orderState}", [AdminOrderStateController::class, "update"])->name("admin.order-state.update");
        Route::post("elimina/{orderState}", [AdminOrderStateController::class, "destroy"])->name("admin.order-state.destroy");
    });
});


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
