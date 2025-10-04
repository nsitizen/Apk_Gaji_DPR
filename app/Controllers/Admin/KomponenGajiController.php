<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KomponenGajiModel;

class KomponenGajiController extends BaseController
{
    protected $komponenGajiModel;

    public function __construct()
    {
        $this->komponenGajiModel = new KomponenGajiModel();
    }

    // Menampilkan DAFTAR komponen
    public function index()
    {
        $data = [
            'title'    => 'Kelola Komponen Gaji & Tunjangan',
            'komponen' => $this->komponenGajiModel->findAll()
        ];
        return view('admin/komponengaji/index', $data);
    }

    // Menampilkan DETAIL satu komponen
    public function show($id)
    {
        $data = [
            'title'    => 'Detail Komponen Gaji',
            'komponen' => $this->komponenGajiModel->find($id)
        ];
        if (empty($data['komponen'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Komponen Gaji tidak ditemukan.');
        }
        return view('admin/komponengaji/show', $data);
    }
}