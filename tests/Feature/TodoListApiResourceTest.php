<?php

namespace Tests\Feature;

use App\Models\TodoListItem;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TodoListApiResourceTest extends TestCase
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
        $existingUser = User::factory()->has(TodoListItem::factory()->count(20))->create();
        $existingTodoListItems = $existingUser->todoListItems;

        $this->actingAs($existingUser)->getJson(route('todo-list-items.index'))
            ->assertSuccessful()
            ->assertJson($existingTodoListItems->toArray());
    }


    public function test_a_user_can_only_see_their_own_todo_list_items()
    {
        $userA = User::factory()->has(TodoListItem::factory()->count(5))->create();
        /** @var $userB User */
        $userB = User::factory()->has(TodoListItem::factory()->count(1))->create();


        $this->actingAs($userA)->getJson(route('todo-list-items.index'))
            ->assertSuccessful()
            ->assertJson($userA->todoListItems->toArray())
            ->assertDontSee($userB->todoListItems()->first()->description);
    }
}
