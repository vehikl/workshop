<?php

namespace Database\Seeders;

use App\Models\TodoListItem;
use App\Models\User;
use Illuminate\Database\Seeder;

class PlaceHolderTodoListItemsSeeder extends Seeder
{
    public function run()
    {
        User::factory()->has(TodoListItem::factory()->count(10))->create();
        User::factory()->has(TodoListItem::factory()->count(4))->create();
        User::factory()->has(TodoListItem::factory()->count(6))->create();
    }
}
