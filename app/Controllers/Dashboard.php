<?php

namespace App\Controllers;

use App\Models\KriteriaModel;
use App\Models\SubKriteriaModel;
use App\Models\AlternatifModel;
use App\Models\PenilaianModel;
use App\Models\UsersModel;
use App\Models\HasilModel;

class Dashboard extends BaseController
{
    protected $kriteria;
    protected $subKriteria;
    protected $alternatif;
    protected $penilaianAlternatif;
    protected $user;
    protected $hasil;
    protected $dataForChart;
    protected $dataTahun;

    public function __construct()
    {

        $this->kriteria = new KriteriaModel();
        $this->subKriteria = new subKriteriaModel();
        $this->alternatif = new AlternatifModel();
        $this->penilaianAlternatif = new PenilaianModel();
        $this->user = new UsersModel();
        $this->hasil = new HasilModel();
        $this->dataForChart = new HasilModel();

        // membuat range tahun untuk keperluan periode
        $thnAwal = 2022;
        $thnAkhir = intval(date('Y'));
        $jumlahThn = $thnAkhir - $thnAwal;
        $this->dataTahun = [];
        for ($i = 0; $i <= $jumlahThn; $i++) {
            $this->dataTahun[] = $thnAwal + $i;
        }
    }

    public function index($tahun = null)
    {
        // Pengecekan session login
        if (session()->get('login') != "login") {
            // Jika tidak ada session 'login', redirect ke halaman login dengan pesan error
            session()->setFlashdata('error', 'Anda harus login terlebih dahulu.');
            return redirect()->to('/login');
        }

        $tahun = $this->request->getVar('tahun');

        $data = [
            'title' => 'Dashboard',
            'bulan' => $this->hasil->getDataByTahun($tahun),
            'countKriteria' => $this->kriteria->countAllResults(),
            'countSubKriteria' => $this->subKriteria->countAllResults(),
            'countAlternatif' => $this->alternatif->countAllResults(),
            'countPenilaianAlternatif' => $this->penilaianAlternatif->countAllResults(),
            'countUser' => $this->user->countAllResults(),
            'countHasil' => $this->hasil->getCountHasilUnik(),
            'tahun' => $tahun,
            'dataTahun' => $this->dataTahun,
        ];
        return view('index', $data);
    }

    public function home()
    {
        // Pengecekan session login
        if (session()->get('login') != "login") {
            // Jika tidak ada session 'login', redirect ke halaman login dengan pesan error
            session()->setFlashdata('error', 'Anda harus login terlebih dahulu.');
            return redirect()->to('/login');
        }

        $data = [
            'title' => 'Simple Additive Weighting',
            'adaPilihan' => $this->kriteria->getPilihanSubKriteria(),
        ];
        return view('index', $data);
    }

    public function pieChart()
    {
        $chartData = $this->hasil->getPieChart();
        return $this->response->setJSON($chartData);
    }

    public function barChart($tahun = null)
    {

        $chartData = $this->hasil->getBarChart($tahun);

        return $this->response->setJSON($chartData);
    }
}
