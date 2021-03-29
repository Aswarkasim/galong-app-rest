<div class="row">
    <div class="col-md-5">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Data Table With Full Features</h3>
            </div>
            <!-- /.box-header -->

            <div class="box-body">
                <table class="table DataTable">
                    <thead>
                        <tr>
                            <th width="40px">No</th>
                            <th>Role</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($role as $row) { ?>
                            <tr>
                                <td><?= $no; ?></td>
                                <td><?= $row->role ?></td>
                                <td>
                                    <a href="<?= $edit . $row->id_role  ?>" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i> </a>
                                    <a href="<?= $delete . $row->id_role  ?>" class="btn btn-sm btn-warning"><i class="fa fa-trash"></i> </a>
                                </td>
                            </tr>
                            <?php $no++;
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- /.box-body -->
</div>