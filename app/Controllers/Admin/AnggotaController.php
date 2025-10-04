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

    // Menampilkan form tambah data (CREATE)
    public function new()
    {
        $data = [
            'title' => 'Form Tambah Data Anggota'
        ];
        return view('admin/anggota/new', $data);
    }

    // Memproses data dari form tambah
    public function create()
    {
        // Aturan validasi input
        $rules = [
            'id_anggota'      => 'required|is_unique[anggota.id_anggota]',
            'nama_depan' => 'required|alpha_space',
            'nama_belakang' => 'required|alpha_space',
            'jabatan' => 'required',
            'status_pernikahan' => 'required',
            'jumlah_anak' => 'required'
        ];

        if (!$this->validate($rules)) {
            // Jika validasi gagal, kembali ke form dengan pesan error
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Simpan data ke database
        $this->anggotaModel->insert($this->request->getPost());
        return redirect()->to('/admin/anggota')->with('success', 'Data anggota berhasil ditambahkan.');
    }

    // Menampilkan form edit data (UPDATE)
    public function edit($id)
    {
        $data = [
            'title'   => 'Form Ubah Data Anggota',
            'anggota' => $this->anggotaModel->find($id)
        ];
        return view('admin/anggota/edit', $data);
    }
    
    // Memproses data dari form ubah
    public function update($id)
    {
        // Validasi sama seperti create
        $rules = [
            'nama_depan' => 'required|alpha_space',
            'nama_belakang' => 'required|alpha_space',
            'jabatan' => 'required',
            'status_pernikahan' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Update data di database
        $this->anggotaModel->update($id, $this->request->getPost());
        return redirect()->to('/admin/anggota')->with('success', 'Data anggota berhasil diubah.');
    }

    // Menghapus data (DELETE)
    public function delete($id)
    {
        $this->anggotaModel->delete($id);
        return redirect()->to('/admin/anggota')->with('success', 'Data anggota berhasil dihapus.');
    }
}