<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Dosen;

class DosenTest extends TestCase
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

        $this->dosen = Dosen::create([
            'nipk' => '1',
            'nama_dosen' => 'Nama Dosen 1',
        ]);
    }

    public function tearDown(): void
    {
        Dosen::where('nipk', '1')->delete();
        Dosen::where('nipk', '2')->delete();

        parent::tearDown();
    }

    public function test_admin_dapat_melihat_tampilan_mengelola_dosen()
    {
        $response = $this->get('/mengelola-dosen');
        $response->assertStatus(200);
        $response->assertViewIs('mengelolaDosen');
        $response->assertViewHas('dosenItems');
    }

    public function test_admin_dapat_melihat_tampilan_tambah_dosen()
    {
        $response = $this->get('/tambah-dosen');
        $response->assertStatus(200);
        $response->assertViewIs('tambahDosen');
    }

    public function test_admin_dapat_menambah_dosen()
    {
        $this->setUp();

        $dataDosen = [
            'nipk' => '1',
            'nama_dosen' => 'Nama Dosen 1',
        ];

        $response = $this->post('/tambah-dosen', $dataDosen);
        $this->assertDatabaseHas('dosen', $dataDosen);
        $response->assertRedirect('/mengelola-dosen');
        $response->assertSessionHas('success', 'Dosen telah ditambahkan.');
    }

    public function test_admin_dapat_melihat_tampilan_ubah_dosen()
    {
        $dosen = Dosen::first();
        $response = $this->get("/ubah-dosen/{$dosen->iddosen}");
        $response->assertStatus(200);
        $response->assertViewIs('ubahDosen');
        $response->assertViewHas('dosenItems', function ($dosenItems) use ($dosen) {
            return $dosenItems->contains('iddosen', $dosen->iddosen);
        });
    }

    public function test_admin_dapat_mengubah_dosen()
    {
        $response = $this->patch("/ubah-dosen/{$this->dosen->iddosen}", [
            'nipk' => '2',
            'nama_dosen' => 'Nama Dosen 2',
        ]);

        $response->assertRedirect('/mengelola-dosen');
        $response->assertSessionHas('success', 'Dosen berhasil diubah.');
        $updatedDosen = Dosen::findOrFail($this->dosen->iddosen);

        $this->assertEquals('2', $updatedDosen->nipk);
        $this->assertEquals('Nama Dosen 2', $updatedDosen->nama_dosen);
    }

    public function test_admin_dapat_menghapus_dosen()
    {
        $dosenToDelete = Dosen::create([
            'nipk' => '3',
            'nama_dosen' => 'Nama Dosen 3',
        ]);

        $response = $this->delete("/hapus-dosen/{$dosenToDelete->iddosen}");
        $response->assertStatus(200);
        $response->assertJson(['success' => true, 'message' => 'Dosen berhasil dihapus.']);
        $this->assertDatabaseMissing('dosen', ['iddosen' => $dosenToDelete->iddosen]);
    }
}
