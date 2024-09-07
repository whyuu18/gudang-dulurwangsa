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

        $alternatifList = $this->alternatif->findAll();
        foreach ($alternatifList as $key => $alternatif) {
            // Memeriksa apakah sudah ada penilaian untuk alternatif ini
            $isPenilaianExists = $this->penilaian->where('id_alternatif', $alternatif['id_alternatif'])->countAllResults() > 0;
            $alternatifList[$key]['isPenilaianExists'] = $isPenilaianExists;
        }

        $data = [
            'title' => 'Data Alternatif',
            'alternatif' => $alternatifList
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
        $alternatif = new alternatifModel();
        
        // validasi input
        $rules = [
            'alternatif' => [
                'rules' => 'required|is_unique[alternatif.alternatif]|alpha_space',
                'errors' => [
                    'required' => 'Nama wajib diisi!',
                    'is_unique' => 'Nama sudah terdaftar!',
                    'alpha_space' => 'Nama tidak valid!'
                ]
            ],
            'nik' => [
                'rules' => 'required|min_length[16]|numeric|is_unique[alternatif.nik]',
                'errors' => [
                    'required' => 'NIK wajib diisi!',
                    'min_length' => 'NIK wajib 16 karakter!',
                    'numeric' => 'NIK wajib berupa angka!',
                    'is_unique' => 'NIK sudah terdaftar!'
                ]
            ]
        ];

        if(!$this->validate($rules)){
            session()->setFlashdata('errors', $this->validator->listErrors());
            return redirect()->back();
        }

        $alternatif->save($this->request->getPost());

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
        $rules = [
            'alternatif' => [
                'rules' => 'required|alpha_space',
                'errors' => [
                    'required' => 'Nama wajib diisi!',
                    'alpha_space' => 'Nama tidak valid!'
                ]
            ],
            'nik' => [
                'rules' => 'required|min_length[16]|numeric',
                'errors' => [
                    'required' => 'NIK wajib diisi!',
                    'min_length' => 'NIK wajib 16 karakter!',
                    'numeric' => 'NIK wajib berupa angka!'
                ]
            ]
        ];

        if(!$this->validate($rules)){
            session()->setFlashdata('errors', $this->validator->listErrors());
            return redirect()->back();
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
