<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Resident;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ResidentKkFilterTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_view_members_of_a_kk_via_filter()
    {
        // create admin user
        $admin = User::factory()->create(['role' => 'admin']);

        // create residents with same KK
        $kk = '111222333';
        Resident::factory()->create(['kk_number' => $kk, 'name' => 'Member One']);
        Resident::factory()->create(['kk_number' => $kk, 'name' => 'Member Two']);

        // create other resident
        Resident::factory()->create(['kk_number' => '999888777', 'name' => 'Other']);

        $response = $this->actingAs($admin)
            ->get('/admin/residents?filter=kk&kk_number=' . $kk);

        $response->assertStatus(200);
        $response->assertSee('Member One');
        $response->assertSee('Member Two');
        $response->assertDontSee('Other');
    }
}
