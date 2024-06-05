<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Ruangan;

class RuanganTest extends TestCase
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

        $this->ruangan = Ruangan::create([
            'kode_ruangan' => 'KRT01',
            'nama_ruangan' => 'Ruangan Test 1',
            'luas_ruangan' => '50',
            'status_ruangan' => 'Tersedia',
        ]);
    }

    public function tearDown(): void
    {
        Ruangan::where('kode_ruangan', 'KRT01')->delete();
        Ruangan::where('kode_ruangan', 'KRT02')->delete();

        parent::tearDown();
    }


    public function test_admin_dapat_melihat_tampilan_mengelola_ruangan()
    {
        $response = $this->get('/mengelola-ruangan');
        $response->assertStatus(200);
        $response->assertViewIs('mengelolaRuangan');
        $response->assertViewHas('ruanganItems');
    }

    public function test_admin_dapat_melihat_tampilan_tambah_ruangan()
    {
        $response = $this->get('/tambah-ruangan');
        $response->assertStatus(200);
        $response->assertViewIs('tambahRuangan');
    }

    public function test_admin_dapat_menambah_ruangan()
    {
        $this->setUp();

        $dataRuangan = [
            'kode_ruangan' => 'KRT01',
            'nama_ruangan' => 'Ruangan Test 1',
            'luas_ruangan' => '50',
            'status_ruangan' => 'Tersedia',
        ];

        $response = $this->post('/tambah-ruangan', $dataRuangan);
        $this->assertDatabaseHas('ruangan', $dataRuangan);
        $response->assertRedirect('/mengelola-ruangan');
        $response->assertSessionHas('success', 'Ruangan telah ditambahkan.');
    }

    public function test_admin_dapat_melihat_tampilan_ubah_ruangan()
    {
        $ruangan = Ruangan::first();
        $response = $this->get("/ubah-ruangan/{$ruangan->idruangan}");
        $response->assertStatus(200);
        $response->assertViewIs('ubahRuangan');
        $response->assertViewHas('ruanganItems', function ($ruanganItems) use ($ruangan) {
            return $ruanganItems->contains('idruangan', $ruangan->idruangan);
        });
    }

    public function test_admin_dapat_mengubah_ruangan()
    {
        $response = $this->patch("/ubah-ruangan/{$this->ruangan->idruangan}", [
            'kode_ruangan' => 'KRT02',
            'nama_ruangan' => 'Ruangan Test 2',
            'luas_ruangan' => '60',
            'status_ruangan' => 'Tersedia',
        ]);

        $response->assertRedirect('/mengelola-ruangan');
        $response->assertSessionHas('success', 'Ruangan berhasil diubah.');
        $updatedRuangan = Ruangan::findOrFail($this->ruangan->idruangan);

        $this->assertEquals('KRT02', $updatedRuangan->kode_ruangan);
        $this->assertEquals('Ruangan Test 2', $updatedRuangan->nama_ruangan);
        $this->assertEquals('60 m²', $updatedRuangan->luas_ruangan);
        $this->assertEquals('Tersedia', $updatedRuangan->status_ruangan);
    }

    public function test_admin_dapat_menghapus_ruangan()
    {
        $ruanganToDelete = Ruangan::create([
            'kode_ruangan' => 'KRT03',
            'nama_ruangan' => 'Ruangan Test 3',
            'luas_ruangan' => '70',
            'status_ruangan' => 'Tersedia',
        ]);

        $response = $this->delete("/hapus-ruangan/{$ruanganToDelete->idruangan}");
        $response->assertStatus(200);
        $response->assertJson(['success' => true, 'message' => 'Ruangan berhasil dihapus.']);
        $this->assertDatabaseMissing('ruangan', ['idruangan' => $ruanganToDelete->idruangan]);
    }
}
