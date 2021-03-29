<!-- Begin Page Content -->
<div class="row">
    <div class="col-lg-12">
        <i class="fa fa-home fa-3x">Beranda</i><br>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="alert alert-success">
            <p>
                <i class="fa fa-user"></i>
                Selamat datang <?= $user->nama_user ?> diaplikasi persediaan barang
            </p>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3><?= count($barang) ?></h3>

                <p>Data Barang</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="<?= base_url('master/barang') ?>" class="small-box-footer">Lihat Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3><?= count($masuk) ?></h3>

                <p>Barang Masuk</p>
            </div>
            <div class="icon">
                <i class="fa fa-download"></i>
            </div>
            <a href="<?= base_url('transaksi/masuk') ?>" class="small-box-footer">Lihat Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3><?= count($keluar) ?></h3>

                <p>Barang Keluar</p>
            </div>
            <div class="icon">
                <i class="fa fa-upload"></i>
            </div>
            <a href="<?= base_url('transaksi/keluar') ?>" class="small-box-footer">Lihat Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                <h3><?= count($santri) ?></h3>

                <p>Santri</p>
            </div>
            <div class="icon">
                <i class="fa fa-user"></i>
            </div>
            <a href="<?= base_url('admin/user') ?>" class="small-box-footer">Lihat Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->


    <!-- Begin Page Content -->
    <div class="row">
        <div class="col-lg-12">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="box">
                            <div class="box-body">
                                <?php include('list.php') ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="box">
                            <div class="box-body">
                                <?php include('min_tabsis.php') ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
<!-- /.container-fluid -->