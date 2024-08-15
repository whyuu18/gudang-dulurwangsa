<?php

namespace App\Models;

use CodeIgniter\Model;

class AlternatifModel extends Model
{
    protected $table      = 'alternatif';
    protected $primaryKey = 'id_alternatif';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['nik', 'id_bulan', 'id_tahun', 'alternatif', 'tgl_lahir', 'alamat', 'jns_kelamin', 'no_telp', 'file'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    // membuat kode alternatif auto
    // public function generateCode()
    // {
    //     $builder = $this->table('alternatif');
    //     $builder->selectMax('kode', 'kodeMax');
    //     $query = $builder->get();

    //     if ($query->getNumRows() > 0) {
    //         $row = $query->getRow();
    //         $kodeMax = $row->kodeMax;

    //         // Mengambil angka dari kode terakhir (menghapus 'A' dan mengkonversi ke integer)
    //         $number = intval(substr($kodeMax, 1));

    //         // Menambahkan 1 ke angka tersebut
    //         $newNumber = $number + 1;

    //         // Membentuk kode baru dengan format 'A' diikuti oleh angka baru
    //         $newKode = 'A' . $newNumber;
    //     } else {
    //         // Jika tidak ada data, mulai dari 'A1'
    //         $newKode = 'A1';
    //     }

    //     return $newKode;
    // }

    public function getPeriode($bulan, $tahun)
    {
        $builder = $this->db->table('alternatif');
        $builder->select('*');
        $builder->where('id_bulan', $bulan);
        $builder->where('id_tahun', $tahun);
        $query = $builder->get();

        return $query->getResultArray();
    }
}
