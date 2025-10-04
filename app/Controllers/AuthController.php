<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PenggunaModel;

class AuthController extends BaseController
{
    public function index()
    {
        // Tampilkan halaman login
        return view('login');
    }

    public function process()
    {
        // 1. Ambil data dari form
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // 2. Validasi
        if (empty($username) || empty($password)) {
            return redirect()->to('/login')->with('error', 'Username dan Password tidak boleh kosong.');
        }

        // 3. Cek ke database
        $model = new PenggunaModel();
        $user = $model->where('username', $username)->first();

        if ($user) {
            // 4. Verifikasi password
            if (password_verify($password, $user['password'])) {
                // 5. Buat session
                $session = session();
                $sessionData = [
                    'id_pengguna' => $user['id_pengguna'],
                    'username'    => $user['username'],
                    'nama_depan'  => $user['nama_depan'],
                    'role'        => $user['role'],
                    'isLoggedIn'  => TRUE
                ];
                $session->set($sessionData);

                // 6. Redirect berdasarkan role
                if ($user['role'] == 'Admin') {
                    return redirect()->to('/admin/dashboard');
                } else {
                    return redirect()->to('/public/dashboard');
                }
            }
        }

        // 7. Jika login gagal
        return redirect()->to('/login')->with('error', 'Username atau Password salah.');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}