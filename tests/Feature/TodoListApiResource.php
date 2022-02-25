<?php

namespace Tests\Feature;

use App\Models\TodoListItem;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TodoListApiResource extends TestCase
{
    use RefreshDatabase;

    public function test_guest_can_create_a_list_item()
    {
        $existingUser = User::factory()->create();
        $newListItem = 'Wash clothes';

        $this->actingAs($existingUser)->postJson(route('todo-list-items.store'), ['description' => $newListItem])
            ->assertSuccessful();

        $this->assertDatabaseHas(TodoListItem::class, ['description' => $newListItem]);
    }

    public function test_get_todo_list_item_as_authenticated_user()
    {
        $existingUser = User::factory()->create();
        $existingTodoListItems = TodoListItem::factory()->times(20)->create();

        $this->actingAs($existingUser)->getJson(route('todo-list-items.index'))
            ->assertSuccessful()
            ->assertJson($existingTodoListItems->toArray());
    }
}
