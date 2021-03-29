<p>
    <h4><i class="fa fa-warning"></i> Tabsis Minus</h4>
</p>
<div class="table-responsive">
    <!-- /.modal -->
    <table class="table DataTable table-hover">
        <thead>
            <tr>
                <th>No.</th>
                <th>NAMA SNATRI</th>
                <th>NAMA PANGGILAN</th>
                <th>TABSIS</th>
            </tr>
        </thead>
        <tbody id="targetData">
            <?php $no = 1;
            foreach ($min_tabsis as $row) { ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= $row->nama_santri ?></td>
                    <td><?= $row->nama_panggilan ?></td>
                    <td><?= 'Rp. ' . nominal($row->tabsis) ?></td>
                </tr>
            <?php $no++;
            } ?>
        </tbody>
    </table>

</div>