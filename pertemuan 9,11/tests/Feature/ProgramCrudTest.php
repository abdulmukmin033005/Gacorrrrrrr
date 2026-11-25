<?php

namespace Tests\Feature;

use App\Models\Program;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProgramCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_program_index_page_loads(): void
    {
        Program::create([
            'nama' => 'Webinar',
            'deskripsi' => 'Pelatihan web',
        ]);

        $response = $this->get('/programs');

        $response->assertOk();
        $response->assertSee('Webinar');
    }
}
