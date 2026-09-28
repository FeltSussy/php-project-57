<?php

namespace Tests\Feature;

use App\Models\Label;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LabelTest extends TestCase
{
    use RefreshDatabase;

    public function test_show_the_list(): void
    {
        $response = $this->get(route('labels.index'));

        $response->assertOk();
    }

    public function test_create_a_label_as_a_user(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->post(route('labels.store'), [
                'name' => 'Ошибка',
                'description' => 'Ошибка в приложении',
            ]);

        $label = Label::latest('id')->first();

        $response->assertRedirect(route('labels.show', $label));

        $this->assertDatabaseHas('labels', [
            'name' => 'Ошибка',
            'description' => 'Ошибка в приложении',
        ]);
    }

    public function test_update_a_label_as_a_user(): void
    {
        $user = User::factory()->create();

        $label = Label::create([
            'name' => 'Старое имя',
            'description' => 'Старое описание',
        ]);

        $response = $this->actingAs($user)
            ->patch(route('labels.update', $label), [
                'name' => 'Новое имя',
                'description' => 'Новое описание',
            ]);

        $response->assertRedirect(route('labels.show', $label));

        $this->assertDatabaseHas('labels', [
            'id' => $label->id,
            'name' => 'Новое имя',
            'description' => 'Новое описание',
        ]);
    }

    public function test_delete_a_label_as_a_user(): void
    {
        $user = User::factory()->create();

        $label = Label::create([
            'name' => 'Метка для удаления',
            'description' => 'Описание',
        ]);

        $response = $this->actingAs($user)
            ->delete(route('labels.destroy', $label));

        $response->assertRedirect(route('labels.index'));

        $this->assertDatabaseMissing('labels', [
            'id' => $label->id,
        ]);
    }

    public function test_guest_cannot_create_a_label(): void
    {
        $response = $this->post(route('labels.store'), [
            'name' => 'Новая метка',
            'description' => 'Описание',
        ]);

        $response->assertForbidden();

        $this->assertDatabaseMissing('labels', [
            'name' => 'Новая метка',
        ]);
    }

    public function test_guest_cannot_update_a_label(): void
    {
        $label = Label::create([
            'name' => 'Старое имя',
            'description' => 'Старое описание',
        ]);

        $response = $this->patch(
            route('labels.update', $label),
            [
                'name' => 'Новое имя',
                'description' => 'Новое описание',
            ]
        );

        $response->assertForbidden();

        $this->assertDatabaseHas('labels', [
            'id' => $label->id,
            'name' => 'Старое имя',
        ]);
    }

    public function test_guest_cannot_delete_a_label(): void
    {
        $label = Label::create([
            'name' => 'Метка для удаления',
            'description' => 'Описание',
        ]);

        $response = $this->delete(
            route('labels.destroy', $label)
        );

        $response->assertForbidden();

        $this->assertDatabaseHas('labels', [
            'id' => $label->id,
        ]);
    }
}
