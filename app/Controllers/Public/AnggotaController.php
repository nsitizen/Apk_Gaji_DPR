<?php

namespace App\Controllers\Public;

use App\Controllers\BaseController;
use App\Models\AnggotaModel;

class AnggotaController extends BaseController
{
    // Menampilkan DAFTAR anggota
    public function index()
    {
        $anggotaModel = new AnggotaModel();
        $data = [
            'title'   => 'Data Anggota DPR',
            'anggota' => $anggotaModel->findAll()
        ];
        return view('public/anggota/index', $data);
    }

    // Menampilkan DETAIL satu anggota
    public function show($id)
    {
        $anggotaModel = new AnggotaModel();
        $data = [
            'title'   => 'Detail Anggota DPR',
            'anggota' => $anggotaModel->find($id)
        ];
        if (empty($data['anggota'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Anggota tidak ditemukan.');
        }
        return view('public/anggota/show', $data);
    }
}