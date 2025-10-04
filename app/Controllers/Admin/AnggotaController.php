<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AnggotaModel;

class AnggotaController extends BaseController
{
    protected $anggotaModel;

    public function __construct()
    {
        // Inisialisasi model di constructor
        $this->anggotaModel = new AnggotaModel();
    }

    // Menampilkan daftar anggota
    public function index()
    {
        $data = [
            'title'   => 'Kelola Data Anggota DPR',
            'anggota' => $this->anggotaModel->findAll()
        ];
        return view('admin/anggota/index', $data);
    }

    // Menampilkan DETAIL satu anggota (READ)
    public function show($id)
    {
        $data = [
            'title'   => 'Detail Anggota DPR',
            'anggota' => $this->anggotaModel->find($id)
        ];
        // Jika data tidak ditemukan, tampilkan halaman 404
        if (empty($data['anggota'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Anggota dengan ID ' . $id . ' tidak ditemukan.');
        }
        return view('admin/anggota/show', $data);
    }
}