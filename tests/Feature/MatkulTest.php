<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Matkul;

class MatkulTest extends TestCase
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

        $this->matkul = Matkul::create([
            'kode_matkul' => 'KM01',
            'matkul' => 'Matkul 1',
            'sks' => 1,
        ]);
    }

    public function tearDown(): void
    {
        Matkul::where('kode_matkul', 'KM01')->delete();
        Matkul::where('kode_matkul', 'KM02')->delete();

        parent::tearDown();
    }

    public function test_admin_dapat_melihat_tampilan_mengelola_matkul()
    {
        $response = $this->get('/mengelola-matkul');
        $response->assertStatus(200);
        $response->assertViewIs('mengelolaMatkul');
        $response->assertViewHas('matkulItems');
    }

    public function test_admin_dapat_melihat_tampilan_tambah_matkul()
    {
        $response = $this->get('/tambah-matkul');
        $response->assertStatus(200);
        $response->assertViewIs('tambahMatkul');
    }

    public function test_admin_dapat_menambah_matkul()
    {
        $this->setUp();

        $dataMatkul = [
            'kode_matkul' => 'KM01',
            'matkul' => 'Matkul 1',
            'sks' => 1,
        ];

        $response = $this->post('/tambah-matkul', $dataMatkul);
        $this->assertDatabaseHas('matkul', $dataMatkul);
        $response->assertRedirect('/mengelola-matkul');
        $response->assertSessionHas('success', 'Mata Kuliah telah ditambahkan.');
    }

    public function test_admin_dapat_melihat_tampilan_ubah_matkul()
    {
        $matkul = Matkul::first();
        $response = $this->get("/ubah-matkul/{$matkul->idmatkul}");
        $response->assertStatus(200);
        $response->assertViewIs('ubahMatkul');
        $response->assertViewHas('matkulItems', function ($matkulItems) use ($matkul) {
            return $matkulItems->contains('idmatkul', $matkul->idmatkul);
        });
    }

    public function test_admin_dapat_mengubah_matkul()
    {
        $response = $this->patch("/ubah-matkul/{$this->matkul->idmatkul}", [
            'kode_matkul' => 'KM02',
            'matkul' => 'Matkul 2',
            'sks' => 2,
        ]);

        $response->assertRedirect('/mengelola-matkul');
        $response->assertSessionHas('success', 'Mata Kuliah berhasil diubah.');
        $updatedMatkul = Matkul::findOrFail($this->matkul->idmatkul);

        $this->assertEquals('KM02', $updatedMatkul->kode_matkul);
        $this->assertEquals('Matkul 2', $updatedMatkul->matkul);
        $this->assertEquals(2, $updatedMatkul->sks);
    }

    public function test_admin_dapat_menghapus_matkul()
    {
        $matkulToDelete = Matkul::create([
            'kode_matkul' => 'KM03',
            'matkul' => 'Matkul 3',
            'sks' => 3,
        ]);

        $response = $this->delete("/hapus-matkul/{$matkulToDelete->idmatkul}");
        $response->assertStatus(200);
        $response->assertJson(['success' => true, 'message' => 'Mata Kuliah berhasil dihapus.']);
        $this->assertDatabaseMissing('matkul', ['idmatkul' => $matkulToDelete->idmatkul]);
    }
}
