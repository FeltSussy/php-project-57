<?php

namespace Tests\Feature;

use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskStatusTest extends TestCase
{
    use RefreshDatabase;

    public function test_show_the_list(): void
    {
        $response = $this->get(route('task_statuses.index'));

        $response->assertOk();
    }

    public function test_create_a_new_task_status_as_a_user(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->post(route('task_statuses.store'), [
                'name' => 'Новый статус',
            ]);

        $response->assertRedirect(route('task_statuses.index'));

        $this->assertDatabaseHas('task_statuses', [
            'name' => 'Новый статус',
        ]);
    }

    public function test_update_a_task_status_as_a_user(): void
    {
        $user = User::factory()->create();

        $taskStatus = TaskStatus::create([
            'name' => 'Старое имя',
        ]);

        $response = $this->actingAs($user)
            ->patch(route('task_statuses.update', $taskStatus), [
                'name' => 'Новое имя',
            ]);

        $response->assertRedirect(route('task_statuses.index'));

        $this->assertDatabaseHas('task_statuses', [
            'id' => $taskStatus->id,
            'name' => 'Новое имя',
        ]);
    }

    public function test_delete_a_task_status_as_a_user(): void
    {
        $user = User::factory()->create();

        $taskStatus = TaskStatus::create([
            'name' => 'Статус для удаления',
        ]);

        $response = $this->actingAs($user)
            ->delete(route('task_statuses.destroy', $taskStatus));

        $response->assertRedirect(route('task_statuses.index'));

        $this->assertDatabaseMissing('task_statuses', [
            'id' => $taskStatus->id,
        ]);
    }

    public function test_guest_cannot_create_a_task_status(): void
    {
        $response = $this->post(route('task_statuses.store'), [
            'name' => 'Новый статус',
        ]);

        $response->assertForbidden();

        $this->assertDatabaseMissing('task_statuses', [
            'name' => 'Новый статус',
        ]);
    }

    public function test_guest_cannot_update_a_task_status(): void
    {
        $taskStatus = TaskStatus::create([
            'name' => 'Старое имя',
        ]);

        $response = $this->patch(
            route('task_statuses.update', $taskStatus),
            [
                'name' => 'Новое имя',
            ]
        );

        $response->assertForbidden();

        $this->assertDatabaseHas('task_statuses', [
            'id' => $taskStatus->id,
            'name' => 'Старое имя',
        ]);
    }

    public function test_guest_cannot_delete_a_task_status(): void
    {
        $taskStatus = TaskStatus::create([
            'name' => 'Статус для удаления',
        ]);

        $response = $this->delete(
            route('task_statuses.destroy', $taskStatus)
        );

        $response->assertForbidden();

        $this->assertDatabaseHas('task_statuses', [
            'id' => $taskStatus->id,
        ]);
    }
}
