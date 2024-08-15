<!doctype html>
<html lang="en">

<head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title><?= $title ?></title>

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- fontawesome -->
        <link rel="stylesheet" href="<?= base_url('fontawesome-free-5.15.4-web/css/all.css') ?>">

        <!-- datatables -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

        <style>
                body {
                        font-family: 'monserat', sans-serif;
                }
        </style>
</head>

<body>
        <div class="m-3">
                <div class="text-center mb-3">
                        <h5>Hasil perangkingan SPK metode SAW</h5>
                        <p>Berikut nilai preferensi dan hasil perankingan yang di dapat setelah dilakukan perhitungan.</p>
                        <hr>
                </div>
                <div class="table-responsive">
                        <table id="#" class="table table-striped">
                                <thead>
                                        <th>No</th>
                                        <th>Nama Alternatif</th>
                                        <th>Nilai Preferensi</th>
                                        <th><i>Ranking</i></th>
                                </thead>
                                <tbody>
                                        <?php $no = 1 ?>
                                        <?php $peringkat = 1 ?>
                                        <?php foreach ($hasil as $row) : ?>
                                                <tr>
                                                        <td><?= $no++ ?></td>
                                                        <td><?= $row['alternatif'] ?></td>
                                                        <td><?= $row['nilai'] ?></td>
                                                        <td class="fw-bold"><?= "(" . $peringkat++ . ")" ?></td>
                                                        <!-- <td class="fw-bold text-danger"> -->
                                                        <?php // $row['nilai'] <= 0.7 ? "Tidak Bagus" : "Bagus" 
                                                        ?></td>
                                                        <!-- </td> -->
                                                </tr>
                                        <?php endforeach ?>
                                </tbody>
                        </table>
                </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
        <!-- chart -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
                window.onload = function() {
                        window.print(); // Memanggil dialog print
                        window.onafterprint = function() {
                                window.history.back(); // Kembali ke halaman sebelumnya setelah print
                        }
                }
        </script>
</body>

</html>