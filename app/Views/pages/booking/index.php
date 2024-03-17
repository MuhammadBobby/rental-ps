<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<?php
$session = \Config\Services::session();
?>

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title"> Booking Transaction Tables </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Transaction</a></li>
                <li class="breadcrumb-item active" aria-current="page">Booking Transaction Tables</li>
            </ol>
        </nav>
    </div>

    <!-- notif flSH DATA -->
    <?php if (session()->getFlashdata('pesan')) : ?>
        <div class="alert alert-success text-center fw-bolder fs-4" role="alert">
            <?= session()->getFlashdata('pesan') ?>
        </div>
    <?php endif; ?>


    <div class="row">
        <div class="col grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <a href="/booking/create " class="btn btn-success">Add Data</a>
                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th class="col-1">No.</th>
                                <th>Member</th>
                                <th>Staff</th>
                                <th>Duration</th>
                                <th>Type</th>
                                <th>Date</th>
                                <th>Total Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $num = 1;
                            foreach ($booking as $bk) :
                            ?>
                                <tr>
                                    <td><?= $num++ ?></td>
                                    <td><?= $bk['NamaMember'] ?></td>
                                    <td><?= $bk['NamaStaff'] ?></td>
                                    <td><?= $bk['Durasi'] ?> Jam</td>
                                    <td><?= $bk['NamaBarang'] ?></td>
                                    <td><?= date_format(date_create($bk['TanggalPemesanan']), 'd-m-Y'); ?></td>
                                    <td>Rp. <?= $bk['TotalBiaya'] ?></td>
                                    <td>
                                        <a href="/booking/delete/<?= $bk['PemesananID'] ?>" class="btn-sm btn-danger" onclick="return confirm('Are you sure Delete this data?')">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>