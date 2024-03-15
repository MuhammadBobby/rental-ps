<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title"> Staff Data Tables </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Data Tables</a></li>
                <li class="breadcrumb-item active" aria-current="page">Staff Data Tables</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <a href="" class="btn btn-success">Add Data</a>
                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th class="col-1">No.</th>
                                <th>Name</th>
                                <th>Shift</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $num = 1;
                            foreach ($staff as $st) :
                            ?>
                                <tr>
                                    <td><?= $num++ ?></td>
                                    <td><?= $st['Nama'] ?></td>
                                    <td><label class="badge <?= $st['Shift'] === 'siang' ? 'badge-light' : 'badge-dark' ?>"><?= $st['Shift'] ?></label></td>
                                    <td>
                                        <a href="" class="btn-sm btn-warning">Edit</a>
                                        <a href="" class="btn-sm btn-danger">Delete</a>
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