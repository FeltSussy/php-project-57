<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_show_the_list(): void
    {
        $response = $this->get(route('tasks.index'));

        $response->assertOk();
    }

    public function test_show_a_task(): void
    {
        $user = User::factory()->create();

        $taskStatus = TaskStatus::create([
            'name' => 'Новый',
        ]);

        $task = new Task;
        $task->name = 'Тестовая задача';
        $task->status_id = $taskStatus->id;
        $task->created_by_id = $user->id;
        $task->save();

        $response = $this->get(route('tasks.show', $task));

        $response->assertOk();
    }

    public function test_create_a_task_as_a_user(): void
    {
        $user = User::factory()->create();

        $taskStatus = TaskStatus::create([
            'name' => 'Новый',
        ]);

        $response = $this->actingAs($user)
            ->post(route('tasks.store'), [
                'name' => 'Новая задача',
                'status_id' => $taskStatus->id,
                'description' => 'Описание задачи',
            ]);

        $task = Task::latest('id')->first();

        $response->assertRedirect(route('tasks.show', $task));

        $this->assertDatabaseHas('tasks', [
            'name' => 'Новая задача',
            'status_id' => $taskStatus->id,
            'created_by_id' => $user->id,
        ]);
    }

    public function test_update_a_task_as_a_user(): void
    {
        $creator = User::factory()->create();
        $user = User::factory()->create();

        $taskStatus = TaskStatus::create([
            'name' => 'Новый',
        ]);

        $task = new Task;
        $task->name = 'Старое имя';
        $task->status_id = $taskStatus->id;
        $task->created_by_id = $creator->id;
        $task->save();

        $response = $this->actingAs($user)
            ->patch(route('tasks.update', $task), [
                'name' => 'Новое имя',
                'status_id' => $taskStatus->id,
            ]);

        $response->assertRedirect(route('tasks.show', $task));

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'name' => 'Новое имя',
        ]);
    }

    public function test_delete_a_task_as_creator(): void
    {
        $creator = User::factory()->create();

        $taskStatus = TaskStatus::create([
            'name' => 'Новый',
        ]);

        $task = new Task;
        $task->name = 'Задача для удаления';
        $task->status_id = $taskStatus->id;
        $task->created_by_id = $creator->id;
        $task->save();

        $response = $this->actingAs($creator)
            ->delete(route('tasks.destroy', $task));

        $response->assertRedirect(route('tasks.index'));

        $this->assertDatabaseMissing('tasks', [
            'id' => $task->id,
        ]);
    }

    public function test_user_cannot_delete_another_users_task(): void
    {
        $creator = User::factory()->create();
        $anotherUser = User::factory()->create();

        $taskStatus = TaskStatus::create([
            'name' => 'Новый',
        ]);

        $task = new Task;
        $task->name = 'Чужая задача';
        $task->status_id = $taskStatus->id;
        $task->created_by_id = $creator->id;
        $task->save();

        $response = $this->actingAs($anotherUser)
            ->delete(route('tasks.destroy', $task));

        $response->assertForbidden();

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
        ]);
    }

    public function test_guest_cannot_create_a_task(): void
    {
        $taskStatus = TaskStatus::create([
            'name' => 'Новый',
        ]);

        $response = $this->post(route('tasks.store'), [
            'name' => 'Новая задача',
            'status_id' => $taskStatus->id,
        ]);

        $response->assertForbidden();

        $this->assertDatabaseMissing('tasks', [
            'name' => 'Новая задача',
        ]);
    }

    public function test_guest_cannot_update_a_task(): void
    {
        $creator = User::factory()->create();

        $taskStatus = TaskStatus::create([
            'name' => 'Новый',
        ]);

        $task = new Task;
        $task->name = 'Старое имя';
        $task->status_id = $taskStatus->id;
        $task->created_by_id = $creator->id;
        $task->save();

        $response = $this->patch(
            route('tasks.update', $task),
            [
                'name' => 'Новое имя',
                'status_id' => $taskStatus->id,
            ]
        );

        $response->assertForbidden();

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'name' => 'Старое имя',
        ]);
    }

    public function test_guest_cannot_delete_a_task(): void
    {
        $creator = User::factory()->create();

        $taskStatus = TaskStatus::create([
            'name' => 'Новый',
        ]);

        $task = new Task;
        $task->name = 'Задача для удаления';
        $task->status_id = $taskStatus->id;
        $task->created_by_id = $creator->id;
        $task->save();

        $response = $this->delete(
            route('tasks.destroy', $task)
        );

        $response->assertForbidden();

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
        ]);
    }
}
