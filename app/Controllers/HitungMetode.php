<?php

namespace App\Controllers;

use App\Models\HitungMetodeModel;
use App\Models\AlternatifModel;
use App\Models\KriteriaModel;
use App\Models\PenilaianModel;
use App\Models\SubKriteriaModel;
use App\Models\HasilModel;

class HitungMetode extends BaseController
{
    protected $getHitung;
    protected $penilaian;
    protected $alternatif;
    protected $kriteria;
    protected $subKriteria;
    protected $dataBulan;
    protected $dataTahun;
    protected $hasil;

    public function __construct()
    {
        $this->getHitung = new HitungMetodeModel();
        $this->penilaian = new PenilaianModel();
        $this->alternatif = new AlternatifModel();
        $this->kriteria = new KriteriaModel();
        $this->subKriteria = new SubKriteriaModel();
        $this->hasil = new HasilModel();
    }

    public function index()
    {
        // Pengecekan session login
        if (session()->get('login') != "login") {
            // Jika tidak ada session 'login', redirect ke halaman login dengan pesan error
            session()->setFlashdata('error', 'Anda harus login terlebih dahulu.');
            return redirect()->to('/login');
        }

        $kriteria = $this->getHitung->getDistinctKriteria();
        $dataPenilaian = $this->getHitung->getAllPenilaian();
        $nilaiMaxMin = $this->getHitung->getNilaiMaxMin();

        // dd($nilaiMaxMin);
        $nilaiMax = [];
        foreach ($nilaiMaxMin as $nMax) {
            $nilaiMax[] = $nMax['nilaiMax'];
        }

        $nilaiMin = [];
        foreach ($nilaiMaxMin as $nMin) {
            $nilaiMin[] = $nMin['nilaiMin'];
        }

        $data = [];
        $data_id = [];
        foreach ($dataPenilaian as $penilaian) {
            // $data[$penilaian['id_alternatif']][$penilaian['id_kriteria']] = $penilaian['nilai'];
            $data[$penilaian['alternatif']][$penilaian['id_kriteria']] = $penilaian['nilai'];
            $data_id[$penilaian['id_alternatif']][$penilaian['id_kriteria']] = $penilaian['nilai'];
        }

        return view('Perhitungan/index', [
            'title' => 'Perhitungan',
            'kriteria' => $kriteria,
            'data' => $data,
            'data_id' => $data_id,
            'alternatif' => $this->alternatif->findAll(),
            'nilaiMax' => $nilaiMax,
            'nilaiMin' => $nilaiMin,
        ]);
    }

    public function simpanData()
    {
        $alternatif = $this->request->getVar('alternatif[]');
        $nilai = $this->request->getVar('nilai[]');

        // Inisialisasi kode unik di sini, sehingga setiap baris data dalam proses ini akan memiliki kode yang sama
        $kodeUnik = uniqid('hasil-', true);

        for ($i = 0; $i < count($alternatif); $i++) {
            // Cek apakah data sudah ada di database
            $existingData = $this->hasil->where([
                'id_alternatif' => $alternatif[$i],
            ])->first();

            $data = [
                'kode_hasil' => $kodeUnik,
                'id_alternatif' => $alternatif[$i],
                'nilai' => $nilai[$i],
            ];

            if ($existingData) {
                // Jika data sudah ada, lakukan update
                $this->hasil->update($existingData['id_hasil'], $data); // Pastikan 'id' adalah nama primary key dari tabel hasil
                session()->setFlashdata('pesan', 'Maaf, Data perhitungan sudah tersimpan di database!');
            } else {
                // Jika data belum ada, lakukan insert
                $this->hasil->save($data);
                session()->setFlashdata('pesan', 'Data perhitungan berhasil disimpan!');
            }
        }

        return redirect()->to('/perhitungan');
    }
}
