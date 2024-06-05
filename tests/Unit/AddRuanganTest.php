<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Ruangan;

class AddRuanganTest extends TestCase
{
    public function testMenambahDataRuangan() {
        $NamaRuangan = 'Lab Multimedia';
        $KodeRuangan = 101010;
        $LuasRuangan = '36 m²';
        $StatusRuangan = null;

        $ruangan = Ruangan::create([
            'nama_ruangan' => $NamaRuangan,
            'kode_ruangan' => $KodeRuangan,
            'luas_ruangan' => $LuasRuangan,
            'status_ruangan' => $StatusRuangan
        ]);

        $this->assertEquals($NamaRuangan, $ruangan->nama_ruangan);
        $this->assertEquals($KodeRuangan, $ruangan->kode_ruangan);
        $this->assertEquals($LuasRuangan, $ruangan->luas_ruangan);
        $this->assertEquals($StatusRuangan, $ruangan->status_ruangan);
    }
}
