<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Kelas;

class KelasTest extends TestCase
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

        $this->kelas = Kelas::create([
            'kelas' => 'K1',
        ]);
    }

    public function tearDown(): void
    {
        Kelas::where('kelas', 'K1')->delete();
        Kelas::where('kelas', 'K2')->delete();

        parent::tearDown();
    }

    public function test_admin_dapat_melihat_tampilan_mengelola_kelas()
    {
        $response = $this->get('/mengelola-kelas');
        $response->assertStatus(200);
        $response->assertViewIs('mengelolaKelas');
        $response->assertViewHas('kelasItems');
    }

    public function test_admin_dapat_melihat_tampilan_tambah_kelas()
    {
        $response = $this->get('/tambah-kelas');
        $response->assertStatus(200);
        $response->assertViewIs('tambahKelas');
    }

    public function test_admin_dapat_menambah_kelas()
    {
        $this->setUp();

        $dataKelas = [
            'kelas' => 'K1',
        ];

        $response = $this->post('/tambah-kelas', $dataKelas);
        $this->assertDatabaseHas('kelas', $dataKelas);
        $response->assertRedirect('/mengelola-kelas');
        $response->assertSessionHas('success', 'Kelas telah ditambahkan.');
    }

    public function test_admin_dapat_melihat_tampilan_ubah_kelas()
    {
        $kelas = Kelas::first();
        $response = $this->get("/ubah-kelas/{$kelas->idkelas}");
        $response->assertStatus(200);
        $response->assertViewIs('ubahKelas');
        $response->assertViewHas('kelasItems', function ($kelasItems) use ($kelas) {
            return $kelasItems->contains('idkelas', $kelas->idkelas);
        });
    }

    public function test_admin_dapat_mengubah_kelas()
    {
        $response = $this->patch("/ubah-kelas/{$this->kelas->idkelas}", [
            'kelas' => 'K2',
        ]);

        $response->assertRedirect('/mengelola-kelas');
        $response->assertSessionHas('success', 'Kelas berhasil diubah.');
        $updatedKelas = Kelas::findOrFail($this->kelas->idkelas);

        $this->assertEquals('K2', $updatedKelas->kelas);
    }

    public function test_admin_dapat_menghapus_kelas()
    {
        $kelasToDelete = Kelas::create([
            'kelas' => 'K3',
        ]);

        $response = $this->delete("/hapus-kelas/{$kelasToDelete->idkelas}");
        $response->assertStatus(200);
        $response->assertJson(['success' => true, 'message' => 'Kelas berhasil dihapus.']);
        $this->assertDatabaseMissing('kelas', ['idkelas' => $kelasToDelete->idkelas]);
    }
}
