<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Jetstream\Http\Livewire\UpdateProfileInformationForm;
use Livewire\Livewire;
use Tests\TestCase;

class ProfileInformationTest extends TestCase
{
    use RefreshDatabase;

    public function test_current_profile_information_is_available()
    {
        $this->actingAs($user = User::factory()->create());

        $component = Livewire::test(UpdateProfileInformationForm::class);

        $this->assertEquals($user->first_name, $component->state['first_name']);
        $this->assertEquals($user->last_name, $component->state['last_name']);
        $this->assertEquals($user->email, $component->state['email']);
        $this->assertEquals($user->role, $component->state['role']);
    }

    public function test_profile_information_can_be_updated()
    {
        $this->actingAs($user = User::factory()->create());

        Livewire::test(UpdateProfileInformationForm::class)
            ->set('state', ['first_name' => 'Test Name', 'last_name' => 'Test Name', 'email' => 'test@example.com'])
            ->call('updateProfileInformation');


        $this->assertEquals('Test Name', $user->fresh()->first_name);
        $this->assertEquals('Test Name', $user->fresh()->last_name);
        $this->assertEquals('test@example.com', $user->fresh()->email);
        $this->assertEquals('Standard', $user->fresh()->role);
    }
}
