<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Waktu;

class WaktuTest extends TestCase
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

        $this->waktu = Waktu::create([
            'waktu' => '11.59',
        ]);
    }

    public function tearDown(): void
    {
        Waktu::where('waktu', '11.59')->delete();
        Waktu::where('waktu', '12.59')->delete();

        parent::tearDown();
    }

    public function test_admin_dapat_melihat_tampilan_mengelola_waktu()
    {
        $response = $this->get('/mengelola-waktu');
        $response->assertStatus(200);
        $response->assertViewIs('mengelolaWaktu');
        $response->assertViewHas('waktuItems');
    }

    public function test_admin_dapat_melihat_tampilan_tambah_waktu()
    {
        $response = $this->get('/tambah-waktu');
        $response->assertStatus(200);
        $response->assertViewIs('tambahWaktu');
    }

    public function test_admin_dapat_menambah_waktu()
    {
        $this->setUp();

        $dataWaktu = [
            'waktu' => '11.59',
        ];

        $response = $this->post('/tambah-waktu', $dataWaktu);
        $this->assertDatabaseHas('waktu', $dataWaktu);
        $response->assertRedirect('/mengelola-waktu');
        $response->assertSessionHas('success', 'Waktu telah ditambahkan.');
    }

    public function test_admin_dapat_melihat_tampilan_ubah_waktu()
    {
        $waktu = Waktu::first();
        $response = $this->get("/ubah-waktu/{$waktu->idwaktu}");
        $response->assertStatus(200);
        $response->assertViewIs('ubahWaktu');
        $response->assertViewHas('waktuItems', function ($waktuItems) use ($waktu) {
            return $waktuItems->contains('idwaktu', $waktu->idwaktu);
        });
    }

    public function test_admin_dapat_mengubah_waktu()
    {
        $response = $this->patch("/ubah-waktu/{$this->waktu->idwaktu}", [
            'waktu' => '12.59',
        ]);

        $response->assertRedirect('/mengelola-waktu');
        $response->assertSessionHas('success', 'Waktu berhasil diubah.');
        $updatedWaktu = Waktu::findOrFail($this->waktu->idwaktu);

        $this->assertEquals('12.59', $updatedWaktu->waktu);
    }

    public function test_admin_dapat_menghapus_waktu()
    {
        $waktuToDelete = Waktu::create([
            'waktu' => '13.59',
        ]);

        $response = $this->delete("/hapus-waktu/{$waktuToDelete->idwaktu}");
        $response->assertStatus(200);
        $response->assertJson(['success' => true, 'message' => 'Waktu berhasil dihapus.']);
        $this->assertDatabaseMissing('waktu', ['idwaktu' => $waktuToDelete->idwaktu]);
    }
}
