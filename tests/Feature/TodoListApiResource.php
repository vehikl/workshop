<?php

namespace Tests\Feature;

use App\Models\TodoListItem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TodoListApiResource extends TestCase
{
    use RefreshDatabase;

    public function test_guest_can_create_a_list_item()
    {

        $newListItem = 'Wash clothes';
        $this->postJson(route('todo-list-items.store'), ['description' => $newListItem])
            ->assertSuccessful();

        $this->assertDatabaseHas(TodoListItem::class, ['description' => $newListItem]);
    }

}
