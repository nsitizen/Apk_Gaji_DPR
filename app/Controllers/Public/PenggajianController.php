<?php

namespace App\Controllers\Public;

use App\Controllers\BaseController;
use App\Models\AnggotaModel;
use App\Models\KomponenGajiModel;
use App\Models\PenggajianModel;

class PenggajianController extends BaseController
{
    public function __construct(
        protected AnggotaModel $anggotaModel = new AnggotaModel(),
        protected KomponenGajiModel $komponenGajiModel = new KomponenGajiModel(),
        protected PenggajianModel $penggajianModel = new PenggajianModel()
    ) {}

    public function index()
    {
        $anggota = $this->anggotaModel->findAll();
        $data_penggajian = [];

        foreach ($anggota as $a) {
            $komponen = $this->penggajianModel->getKomponenByAnggota($a['id_anggota']);
            $a['take_home_pay'] = $this->calculateTakeHomePay($a, $komponen);
            $data_penggajian[] = $a;
        }

        $data = [
            'title'      => 'Data Penggajian Anggota DPR',
            'penggajian' => $data_penggajian
        ];
        return view('public/penggajian/index', $data);
    }

    public function show($id_anggota)
    {
        $anggota = $this->anggotaModel->find($id_anggota);
        $komponen = $this->penggajianModel->getKomponenByAnggota($id_anggota);
        $take_home_pay = $this->calculateTakeHomePay($anggota, $komponen);

        $data = [
            'title'         => 'Detail Penggajian',
            'anggota'       => $anggota,
            'komponen'      => $komponen,
            'take_home_pay' => $take_home_pay
        ];
        return view('public/penggajian/show', $data);
    }

    private function calculateTakeHomePay(array $anggota, array $komponen): float
    {
        $total = 0;
        foreach ($komponen as $k) {
            if ($k['satuan'] == 'Bulan') {
                $total += (float)$k['nominal'];
            }
        }
        
        if ($anggota['status_pernikahan'] == 'Kawin') {
            $tunj_istri = $this->komponenGajiModel->where('nama_komponen', 'Tunjangan Istri/Suami')->first();
            if ($tunj_istri) {
                $isExist = false;
                foreach ($komponen as $k) { if ($k['nama_komponen'] == 'Tunjangan Istri/Suami') $isExist = true; }
                if (!$isExist) $total += (float)$tunj_istri['nominal'];
            }
        }
        
        if (!empty($anggota['jumlah_anak']) && $anggota['jumlah_anak'] > 0) {
            $tunj_anak = $this->komponenGajiModel->where('nama_komponen', 'Tunjangan Anak')->first();
            if ($tunj_anak) {
                $isExist = false;
                foreach($komponen as $k) { if ($k['nama_komponen'] == 'Tunjangan Anak') $isExist = true; }
                if (!$isExist) {
                    $jumlah_anak_dihitung = min((int)$anggota['jumlah_anak'], 2);
                    $total += (float)$tunj_anak['nominal'] * $jumlah_anak_dihitung;
                }
            }
        }
        return $total;
    }
}