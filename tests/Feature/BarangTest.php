<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Barang;

class BarangTest extends TestCase
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

        $this->barang = Barang::create([
            'kode_barang' => 'KBT01',
            'nama_barang' => 'Barang Test 1',
            'deskripsi_barang' => 'Deskripsi Barang Test 1',
            'status_barang' => 'Tersedia',
            'merek_barang' => 'Merek Barang Test 1',
        ]);
    }

    public function tearDown(): void
    {
        Barang::where('kode_barang', 'KBT01')->delete();
        Barang::where('kode_barang', 'KBT02')->delete();

        parent::tearDown();
    }

    public function test_admin_dapat_melihat_tampilan_mengelola_barang()
    {
        $response = $this->get('/mengelola-barang');
        $response->assertStatus(200);
        $response->assertViewIs('mengelolaBarang');
        $response->assertViewHas('barangItems');
    }

    public function test_admin_dapat_melihat_tampilan_tambah_barang()
    {
        $response = $this->get('/tambah-barang');
        $response->assertStatus(200);
        $response->assertViewIs('tambahBarang');
    }

    public function test_admin_dapat_menambah_barang()
    {
        $this->setUp();

        $dataBarang = [
            'kode_barang' => 'KBT01',
            'nama_barang' => 'Barang Test 1',
            'deskripsi_barang' => 'Deskripsi Barang Test 1',
            'status_barang' => 'Tersedia',
            'merek_barang' => 'Merek Barang Test 1',
        ];

        $response = $this->post('/tambah-barang', $dataBarang);
        $this->assertDatabaseHas('barang', $dataBarang);
        $response->assertRedirect('/mengelola-barang');
        $response->assertSessionHas('success', 'Barang telah ditambahkan.');
    }

    public function test_admin_dapat_melihat_tampilan_ubah_barang()
    {
        $barang = Barang::first();
        $response = $this->get("/ubah-barang/{$barang->idbarang}");
        $response->assertStatus(200);
        $response->assertViewIs('ubahBarang');
        $response->assertViewHas('barangItems', function ($barangItems) use ($barang) {
            return $barangItems->contains('idbarang', $barang->idbarang);
        });
    }

    public function test_admin_dapat_mengubah_barang()
    {
        $response = $this->patch("/ubah-barang/{$this->barang->idbarang}", [
            'kode_barang' => 'KBT02',
            'nama_barang' => 'Barang Test 2',
            'deskripsi_barang' => 'Deskripsi Barang Test 2',
            'status_barang' => 'Tersedia',
            'merek_barang' => 'Merek Barang Test 2',
        ]);

        $response->assertRedirect('/mengelola-barang');
        $response->assertSessionHas('success', 'Barang berhasil diubah.');
        $updatedBarang = Barang::findOrFail($this->barang->idbarang);

        $this->assertEquals('KBT02', $updatedBarang->kode_barang);
        $this->assertEquals('Barang Test 2', $updatedBarang->nama_barang);
        $this->assertEquals('Deskripsi Barang Test 2', $updatedBarang->deskripsi_barang);
        $this->assertEquals('Tersedia', $updatedBarang->status_barang);
        $this->assertEquals('Merek Barang Test 2', $updatedBarang->merek_barang);
    }

    public function test_admin_dapat_menghapus_barang()
    {
        $barangToDelete = Barang::create([
            'kode_barang' => 'KBT03',
            'nama_barang' => 'Barang Test 2',
            'deskripsi_barang' => 'Deskripsi Barang Test 3',
            'status_barang' => 'Tersedia',
            'merek_barang' => 'Merek Barang Test 3',
        ]);

        $response = $this->delete("/hapus-barang/{$barangToDelete->idbarang}");
        $response->assertStatus(200);
        $response->assertJson(['success' => true, 'message' => 'Barang berhasil dihapus.']);
        $this->assertDatabaseMissing('barang', ['idbarang' => $barangToDelete->idbarang]);
    }
}
