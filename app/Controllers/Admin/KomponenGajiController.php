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

    // Menampilkan form TAMBAH data
    public function new()
    {
        $data = [
            'title' => 'Form Tambah Komponen Gaji'
        ];
        return view('admin/komponengaji/new', $data);
    }

    // Memproses form TAMBAH data
    public function create()
    {
        $rules = [
            'id_komponen_gaji'      => 'required|is_unique[komponen_gaji.id_komponen_gaji]',
            'nama_komponen' => 'required',
            'kategori'      => 'required',
            'jabatan'       => 'required',
            'nominal'       => 'required|numeric',
            'satuan'        => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->komponenGajiModel->insert($this->request->getPost());
        return redirect()->to('/admin/komponengaji')->with('success', 'Komponen gaji berhasil ditambahkan.');
    }

    // Menampilkan form UBAH data
    public function edit($id)
    {
        $data = [
            'title'    => 'Form Ubah Komponen Gaji',
            'komponen' => $this->komponenGajiModel->find($id)
        ];
        return view('admin/komponengaji/edit', $data);
    }

    // Memproses form UBAH data
    public function update($id)
    {
        $rules = [
            'nama_komponen' => 'required',
            'nominal'       => 'required|numeric'
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->komponenGajiModel->update($id, $this->request->getPost());
        return redirect()->to('/admin/komponengaji')->with('success', 'Komponen gaji berhasil diubah.');
    }

    // Memproses HAPUS data
    public function delete($id)
    {
        $this->komponenGajiModel->delete($id);
        return redirect()->to('/admin/komponengaji')->with('success', 'Komponen gaji berhasil dihapus.');
    }
}