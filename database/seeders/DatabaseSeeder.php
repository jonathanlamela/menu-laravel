<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Food;
use Illuminate\Database\Seeder;
use App\Models\OrderState;
use App\Models\Settings;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $order_created = new OrderState([
            "id" => 1,
            "name" => "Ordine creato",
            "css_badge_class" => "badge-primary"
        ]);

        $order_created->save();

        $order_paid = new OrderState([
            "id" => 2,
            "name" => "Ordine pagato",
            "css_badge_class" => "badge-secondary"
        ]);

        $order_paid->save();

        $order_delivered = new OrderState([
            "id" => 3,
            "name" => "Ordine eliminato",
            "css_badge_class" => "badge-danger"
        ]);

        $order_delivered->save();

        $settings = new Settings([
            "id" => 1,
            "site_title" => "Demo",
            "site_subtitle" => "Ristorante | Pizzeria",
            "order_created_state_id" => 1,
            "order_paid_state_id" => 2,
            "order_deleted_state_id" => 3
        ]);

        $settings->save();

        $category = new Category([
            "id" => 1,
            "name" => "Pizze"
        ]);

        $category->save();

        $category = new Category([
            "id" => 2,
            "name" => "Panini"
        ]);

        $category->save();

        $category = new Category([
            "id" => 3,
            "name" => "Contorni"
        ]);

        $category->save();

        $category = new Category([
            "id" => 4,
            "name" => "Bibite e bevande"
        ]);

        $category->save();


        $cibo = new Food([
            "id" => 1,
            "name" => "Pizza Margherita",
            "ingredients" => "pomodoro, mozzarella",
            "category_id" => 1,
            "price" => 3.50
        ]);

        $cibo->save();
    }
}
