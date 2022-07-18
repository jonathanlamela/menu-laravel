<?php

namespace Database\Seeders;

use App\Mail\OrderPaid;
use App\Models\Category;
use App\Models\Food;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrdineCreato;
use App\Mail\OrdineRicevuto;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        /*Category::factory(6)->create();

        $categories = Category::all();

        foreach ($categories as $category) {

            Food::factory(10)->create([
                "category_id" => $category->id
            ]);
        }*/

        $order = Order::find(11);
        Mail::to($order->user)->send(new OrderPaid($order));
    }
}
