<?php

namespace App\Controllers;

use App\Models\AlternatifModel;
use App\Models\PenilaianModel;

class Alternatif extends BaseController
{
    protected $alternatif;
    protected $penilaian;

    public function __construct()
    {
        $this->alternatif = new AlternatifModel();
        $this->penilaian = new PenilaianModel();
    }

    public function index()
    {
        // Pengecekan session login
        if (session()->get('login') != "login") {
            // Jika tidak ada session 'login', redirect ke halaman login dengan pesan error
            session()->setFlashdata('error', 'Anda harus login terlebih dahulu.');
            return redirect()->to('/login');
        }
        $data = [
            'title' => 'Data Alternatif',
            'alternatif' => $this->alternatif->findAll() // Gunakan data alternatif berdasarkan periode
        ];
        return view('alternatif/index', $data);
    }

    // public function autoKode()
    // {
    //     return json_encode($this->alternatif->generateCode());
    // }

    public function tambah()
    {
        // Pengecekan session login
        if (session()->get('login') != "login") {
            // Jika tidak ada session 'login', redirect ke halaman login dengan pesan error
            session()->setFlashdata('error', 'Anda harus login terlebih dahulu.');
            return redirect()->to('/login');
        }

        $data = [
            'title' => 'Tambah Data Alternatif',
            'validation' => \Config\Services::validation()
        ];
        return view('alternatif/tambah', $data);
    }

    public function simpan()
    {
        // validasi input
        if (!$this->validate([
            'alternatif' => [
                // 'rules' => 'required|is_unique[alternatif.alternatif]',
                'errors' => [
                    'required' => 'nama {field} harus diisi!',
                    // 'is_unique' => 'alternatif {field} sudah ada!'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/alternatif/simpan')->withInput()->with('validation', $validation);
        }

        // session()->setFlashdata('pesan', $isipesan);

        $this->alternatif->save([
            'alternatif' => $this->request->getVar('alternatif'),
            'nik' => $this->request->getPost('nik'),
        ]);

        // pesan data berhasil ditambah
        $isipesan = '<script> alert("Alternatif berhasil ditambahkan!") </script>';
        session()->setFlashdata('pesan', $isipesan);

        return redirect()->to('/alternatif');
    }

    public function edit($id)
    {
        // Pengecekan session login
        if (session()->get('login') != "login") {
            // Jika tidak ada session 'login', redirect ke halaman login dengan pesan error
            session()->setFlashdata('error', 'Anda harus login terlebih dahulu.');
            return redirect()->to('/login');
        }

        $data = [
            'title' => 'Edit Alternatif',
            'alternatif' => $this->alternatif->find($id),
            'validation' => \Config\Services::validation()
        ];
        return view('alternatif/edit', $data);
    }

    public function update($id)
    {
        // validasi input
        if (!$this->validate([
            'alternatif' => [
                // 'rules' => 'required|is_unique[alternatif.alternatif]',
                'errors' => [
                    'required' => 'nama {field} harus diisi!',
                    // 'is_unique' => 'alternatif {field} sudah ada!'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/Alternatif/edit/' . $id)->withInput()->with('validation', $validation);
        }

        $this->alternatif->save([
            'id_alternatif' => $id,
            'alternatif' => $this->request->getVar('alternatif'),
            'nik' => $this->request->getPost('nik'),
        ]);

        // pesan data berhasil ditambah
        $isipesan = '<script> alert("Alternatif berhasil diupdate!") </script>';
        session()->setFlashdata('pesan', $isipesan);

        return redirect()->to('/alternatif');
    }

    public function delete($id)
    {
        // Pengecekan session login
        if (session()->get('login') != "login") {
            // Jika tidak ada session 'login', redirect ke halaman login dengan pesan error
            session()->setFlashdata('error', 'Anda harus login terlebih dahulu.');
            return redirect()->to('/login');
        }

        $db = db_connect(); // Dapatkan instance koneksi database
        $db->transStart(); // Mulai transaksi

        try {
            // Hapus data dari tabel anak (penilaian) terlebih dahulu
            $this->penilaian->where('id_alternatif', $id)->delete();

            // Kemudian hapus data dari tabel induk (cuti)
            $this->alternatif->delete($id);

            $db->transComplete(); // Selesaikan transaksi

            if ($db->transStatus() === FALSE) {
                // Jika ada yang salah, transaksi akan dirollback
                session()->setFlashdata('error', 'Gagal menghapus data alternatif.');
                return redirect()->to('/alternatif');
            }

            // Jika tidak ada masalah, set pesan sukses
            session()->setFlashdata('pesan', '<script> alert("Data alternatif berhasil dihapus!") </script>');
            return redirect()->to('/alternatif');
        } catch (\Exception $e) {
            $db->transRollback(); // Rollback transaksi jika terjadi exception
            session()->setFlashdata('error', 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage());
            return redirect()->to('/alternatif');
        }
    }
}
