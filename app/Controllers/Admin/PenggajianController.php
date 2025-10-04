<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AnggotaModel;
use App\Models\KomponenGajiModel;
use App\Models\PenggajianModel;

class PenggajianController extends BaseController
{
    // Load semua model yang dibutuhkan
    public function __construct(
        protected AnggotaModel $anggotaModel = new AnggotaModel(),
        protected KomponenGajiModel $komponenGajiModel = new KomponenGajiModel(),
        protected PenggajianModel $penggajianModel = new PenggajianModel()
    ) {}

    // Menampilkan DAFTAR penggajian
    public function index()
    {
        $anggota = $this->anggotaModel->findAll();
        $data_penggajian = [];

        foreach ($anggota as $a) {
            $komponen = $this->penggajianModel->getKomponenByAnggota($a['id_anggota']);
            // Hitung Take Home Pay untuk setiap anggota
            $a['take_home_pay'] = $this->calculateTakeHomePay($a, $komponen);
            $data_penggajian[] = $a;
        }

        $data = [
            'title'      => 'Data Penggajian Anggota',
            'penggajian' => $data_penggajian
        ];
        return view('admin/penggajian/index', $data);
    }

    // Menampilkan DETAIL penggajian
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
        return view('admin/penggajian/show', $data);
    }

    // Menampilkan form BUAT penggajian
    public function new()
    {
        $data = [
            'title'         => 'Form Buat Penggajian Anggota',
            'anggota'       => $this->anggotaModel->findAll(),
            'komponen_gaji' => $this->komponenGajiModel->orderBy('jabatan', 'ASC')->findAll()
        ];
        return view('admin/penggajian/new', $data);
    }

    // Memproses form BUAT penggajian
    public function create()
    {
        $id_anggota = $this->request->getPost('id_anggota');
        $komponen_ids = $this->request->getPost('komponen_ids') ?? [];

        // Hapus dulu data lama untuk anggota ini, lalu tambahkan yang baru
        $this->penggajianModel->deleteByAnggota($id_anggota);
        $this->penggajianModel->addKomponenToAnggota($id_anggota, $komponen_ids);

        return redirect()->to('/admin/penggajian')->with('success', 'Data penggajian berhasil dibuat/diperbarui.');
    }

    // Menampilkan form UBAH penggajian
    public function edit($id_anggota)
    {
        $anggota = $this->anggotaModel->find($id_anggota);
        $semua_komponen = $this->komponenGajiModel->orderBy('jabatan', 'ASC')->findAll();
        $komponen_dimiliki = $this->penggajianModel->getKomponenByAnggota($id_anggota);
        
        // Buat array dari ID komponen yang dimiliki untuk memudahkan pengecekan di view
        $ids_komponen_dimiliki = array_column($komponen_dimiliki, 'id_komponen_gaji');

        $data = [
            'title'                 => 'Form Ubah Penggajian',
            'anggota'               => $anggota,
            'semua_komponen'        => $semua_komponen,
            'ids_komponen_dimiliki' => $ids_komponen_dimiliki
        ];
        return view('admin/penggajian/edit', $data);
    }

    // Memproses form UBAH penggajian
    public function update($id_anggota)
    {
        // Ambil daftar komponen yang dipilih dari form
        $komponen_ids = $this->request->getPost('komponen_ids') ?? [];

        // Gunakan $id_anggota dari URL, bukan dari form post
        $this->penggajianModel->deleteByAnggota($id_anggota);
        $this->penggajianModel->addKomponenToAnggota($id_anggota, $komponen_ids);

        return redirect()->to('/admin/penggajian')->with('success', 'Data penggajian berhasil diubah.');
    }

    // HAPUS data penggajian
    public function delete($id_anggota)
    {
        $this->penggajianModel->deleteByAnggota($id_anggota);
        return redirect()->to('/admin/penggajian')->with('success', 'Data penggajian berhasil dihapus.');
    }

    // Method private untuk menghitung Take Home Pay berdasarkan semua aturan
    private function calculateTakeHomePay(array $anggota, array $komponen): float
    {
        $total = 0;
        foreach ($komponen as $k) {
            // Hanya hitung yang satuannya "Bulan" [cite: 43]
            if ($k['satuan'] == 'Bulan') {
                $total += (float)$k['nominal'];
            }
        }
        
        // Aturan Tunjangan Istri/Suami [cite: 40]
        if ($anggota['status_pernikahan'] == 'Kawin') {
            $tunj_istri = $this->komponenGajiModel->where('nama_komponen', 'Tunjangan Istri/Suami')->first();
            if ($tunj_istri) {
                $isExist = false;
                foreach ($komponen as $k) {
                    if ($k['nama_komponen'] == 'Tunjangan Istri/Suami') $isExist = true;
                }
                if (!$isExist) $total += (float)$tunj_istri['nominal'];
            }
        }
        
        // Aturan Tunjangan Anak (maksimal 2) [cite: 40, 41]
        if (!empty($anggota['jumlah_anak']) && $anggota['jumlah_anak'] > 0) {
            $tunj_anak = $this->komponenGajiModel->where('nama_komponen', 'Tunjangan Anak')->first();
            if ($tunj_anak) {
                $isExist = false;
                foreach($komponen as $k) {
                    if ($k['nama_komponen'] == 'Tunjangan Anak') $isExist = true;
                }
                if (!$isExist) {
                    $jumlah_anak_dihitung = min((int)$anggota['jumlah_anak'], 2);
                    $total += (float)$tunj_anak['nominal'] * $jumlah_anak_dihitung;
                }
            }
        }
        
        return $total;
    }
}