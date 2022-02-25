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

    public function test_get_list_item()
    {
        $existingTodoListItems = TodoListItem::factory()->times(20)->create();

        $this->get(route('todo-list-items.index'))
            ->assertSuccessful()
            ->assertJson($existingTodoListItems->toArray());
    }

}
