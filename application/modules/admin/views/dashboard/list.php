<p>
    <h4><i class="fa fa-warning"></i> Stok telah mencapai batas minimum</h4>
</p>
<div class="table-responsive">
    <p>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
            <i class="fa fa-cogs"></i> Atur batas minimum
        </button>
    </p>
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Stok Minimum</h4>
                </div>
                <?php echo form_open('admin/dashboard/edit_min') ?>
                <div class="modal-body">
                    <label for="">Batas Minimum</label>
                    <input name="stok_min" value="<?= $konfigurasi->stok_min ?>" class="form-control" type="number">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
                <?php echo form_close() ?>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <table class="table DataTable table-hover">
        <thead>
            <tr>
                <th>No.</th>
                <th>ID Barang</th>
                <th>Nama Barang</th>
                <th>Jenis Barang</th>
                <th>Stok</th>
                <th>Satuan</th>
            </tr>
        </thead>
        <tbody id="targetData">
            <?php $no = 1;
            foreach ($min_barang as $row) { ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= $row->id_barang ?></td>
                    <td><?= $row->nama_barang ?></td>
                    <td><?= $row->nama_jenis ?></td>
                    <td><?= $row->stok ?></td>
                    <td><?= $row->nama_satuan ?></td>
                </tr>
                <?php $no++;
            } ?>
        </tbody>
    </table>

</div>