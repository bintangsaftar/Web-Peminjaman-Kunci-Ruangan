<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Prodi;

class ProdiTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    /*
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    */

    public function setUp(): void
    {
        parent::setUp();

        $this->prodi = Prodi::create([
            'prodi' => 'PRD1',
        ]);
    }

    public function tearDown(): void
    {
        Prodi::where('prodi', 'PRD1')->delete();
        Prodi::where('prodi', 'PRD2')->delete();

        parent::tearDown();
    }

    public function test_admin_dapat_melihat_tampilan_mengelola_prodi()
    {
        $response = $this->get('/mengelola-prodi');
        $response->assertStatus(200);
        $response->assertViewIs('mengelolaProdi');
        $response->assertViewHas('prodiItems');
    }

    public function test_admin_dapat_melihat_tampilan_tambah_prodi()
    {
        $response = $this->get('/tambah-prodi');
        $response->assertStatus(200);
        $response->assertViewIs('tambahProdi');
    }

    public function test_admin_dapat_menambah_prodi()
    {
        $this->setUp();

        $dataProdi = [
            'prodi' => 'PRD1',
        ];

        $response = $this->post('/tambah-prodi', $dataProdi);
        $this->assertDatabaseHas('prodi', $dataProdi);
        $response->assertRedirect('/mengelola-prodi');
        $response->assertSessionHas('success', 'Prodi telah ditambahkan.');
    }

    public function test_admin_dapat_melihat_tampilan_ubah_prodi()
    {
        $prodi = Prodi::first();
        $response = $this->get("/ubah-prodi/{$prodi->idprodi}");
        $response->assertStatus(200);
        $response->assertViewIs('ubahProdi');
        $response->assertViewHas('prodiItems', function ($prodiItems) use ($prodi) {
            return $prodiItems->contains('idprodi', $prodi->idprodi);
        });
    }

    public function test_admin_dapat_mengubah_prodi()
    {
        $response = $this->patch("/ubah-prodi/{$this->prodi->idprodi}", [
            'prodi' => 'PRD2',
        ]);

        $response->assertRedirect('/mengelola-prodi');
        $response->assertSessionHas('success', 'Prodi berhasil diubah.');
        $updatedProdi = Prodi::findOrFail($this->prodi->idprodi);

        $this->assertEquals('PRD2', $updatedProdi->prodi);
    }

    public function test_admin_dapat_menghapus_prodi()
    {
        $prodiToDelete = Prodi::create([
            'prodi' => 'PRD3',
        ]);

        $response = $this->delete("/hapus-prodi/{$prodiToDelete->idprodi}");
        $response->assertStatus(200);
        $response->assertJson(['success' => true, 'message' => 'Prodi berhasil dihapus.']);
        $this->assertDatabaseMissing('prodi', ['idprodi' => $prodiToDelete->idprodi]);
    }
}
