<?php

namespace App\Models;

use CodeIgniter\Model;

class PenggajianModel extends Model
{
    protected $table            = 'penggajian';
    protected $allowedFields    = ['id_anggota', 'id_komponen_gaji'];

    /* Mengambil semua data komponen gaji yang dimiliki oleh seorang anggota. */
    public function getKomponenByAnggota(int $id_anggota): array
    {
        return $this->select('komponen_gaji.*')
            ->join('komponen_gaji', 'komponen_gaji.id_komponen_gaji = penggajian.id_komponen_gaji')
            ->where('penggajian.id_anggota', $id_anggota)
            ->findAll();
    }

    /* Menghapus semua entri penggajian untuk seorang anggota. */
    public function deleteByAnggota(int $id_anggota): bool
    {
        return $this->where('id_anggota', $id_anggota)->delete();
    }

    /* Menambahkan satu set komponen gaji ke seorang anggota menggunakan insertBatch. */
    public function addKomponenToAnggota(int $id_anggota, array $komponen_ids)
    {
        if (empty($komponen_ids)) {
            return;
        }

        $dataToInsert = [];
        foreach ($komponen_ids as $komponen_id) {
            $dataToInsert[] = [
                'id_anggota'       => $id_anggota,
                'id_komponen_gaji' => $komponen_id
            ];
        }

        $this->insertBatch($dataToInsert);
    }
}