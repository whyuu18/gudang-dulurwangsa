<?php

namespace App\Models;

use CodeIgniter\Model;

class HasilModel extends Model
{
    protected $table      = 'hasil';
    protected $primaryKey = 'id_hasil';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['kode_hasil', 'id_alternatif', 'nilai', 'status'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function getDataByTahun($tahun = null)
    {
        if (!is_null($tahun)) {
            $this->where('tahun', $tahun);
        }
        return $this->findAll();
    }

    public function simpanHasil($data)
    {
        return $this->insert($data);
    }


    public function getPeriode()
    {
        $builder = $this->db->table('hasil');
        $builder->select('*');
        $query = $builder->get();

        return $query->getResultArray();
    }

    public function getCountHasilUnik()
    {
        $builder = $this->db->table('hasil');
        // Gunakan COUNT(DISTINCT column_name) untuk menghitung jumlah nilai unik
        $builder->select('COUNT(DISTINCT kode_hasil) as jumlah_unik');
        $query = $builder->get();

        return $query->getRow()->jumlah_unik; // Mengembalikan jumlah unik sebagai integer
    }

    // untuk pie chart
    public function getPieChart()
    {
        // Mengakses database dan mempersiapkan query
        $builder = $this->db->table('hasil');

        // Menulis conditional count sebagai parameter dari select()
        $builder->select("
                        SUM(CASE WHEN status = 'layak' THEN 1 ELSE 0 END) AS jumlah_layak,
                        SUM(CASE WHEN status = 'tidak layak' THEN 1 ELSE 0 END) AS jumlah_tidak_layak
                    ", false); // false untuk mencegah CI4 dari mengecek nama field atau tabel

        // Menjalankan query dan mendapatkan hasilnya
        $query = $builder->get();

        // Mengambil hasil query
        $result = $query->getRowArray(); // Untuk single row, atau getResultArray() untuk multiple rows

        // $result sekarang berisi 'jumlah_layak' dan 'jumlah_tidak_layak'
        return $result;
    }

    // untuk bar chart
    public function getBarChart($tahun)
    {
        $query = $this->db->query("SELECT 
                                      id_bulan,
                                      id_tahun,
                                      SUM(CASE WHEN status = 'layak' THEN 1 ELSE 0 END) AS jumlah_layak,
                                      SUM(CASE WHEN status = 'tidak layak' THEN 1 ELSE 0 END) AS jumlah_tidak_layak
                                    FROM 
                                      hasil
                                    WHERE 
                                      id_tahun = ?
                                    GROUP BY 
                                      id_bulan, id_tahun
                                    ORDER BY 
                                      id_bulan ASC", [$tahun]);
        return $query->getResultArray();
    }


    public function hitungStatusPerBulanPerTahun($tahun)
    {
        $builder = $this->db->table('hasil');

        $builder->select('id_bulan, 
                          SUM(CASE WHEN status = "layak" THEN 1 ELSE 0 END) as jumlah_layak,
                          SUM(CASE WHEN status = "tidak layak" THEN 1 ELSE 0 END) as jumlah_tidak_layak');
        $builder->where('id_tahun', $tahun);
        $builder->groupBy('id_bulan');
        $query = $builder->get();

        return $query->getResultArray();
    }

    public function getDataHasil()
    {
        $builder = $this->builder();
        $builder->select('hasil.*, alternatif.*');
        $builder->join('alternatif', 'alternatif.id_alternatif=hasil.id_alternatif');
        $builder->orderBy('hasil.nilai', 'DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }
}
