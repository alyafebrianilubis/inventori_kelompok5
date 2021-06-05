<?php if ($this->session->userdata('msg'))
    echo "<span class='alert alert-success'>" . $this->session->userdata('msg') . "</span>";
?>

<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Data Barang | <a href='<?= base_url(); ?>Barang/tambah_barang' class='btn btn-info'>
                        Tambah Barang <i class="fa fa-plus"></i>
                    </a></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                    <table class="display table table-bordered table-striped dataTable" id="example1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Qrcode</th>
                                <th>Nama Barang</th>
                                <th>Merek</th>
                                <th>Jumlah</th>
                                <th>Gambar</th>
                                <th>Keterangan</th>
                                <th>Kategori</th>
                                <th style="width:120px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php $i = 1;
                            foreach ($item as $brg) : ?>
                                <tr>
                                    <!-- <td><?= $array_item; ?></td> -->
                                    <td><?= $i; ?></td>
                                    <td><img src="<?php echo base_url('barang/generate_qrcode/' . $brg->id_barang); ?>" width="100" height="100">

                                    </td>
                                    <td><?= $brg->nama_barang; ?></td>
                                    <td><?= $brg->merek; ?></td>
                                    <td>
                                        <?php if ($brg->jumlah <= 10) : ?>
                                            <span class='label label-danger'><?= $brg->jumlah; ?></span>
                                        <?php else : ?>
                                            <span class='label label-success'><?= $brg->jumlah; ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td> <img src=" <?= base_url('assets_user/img/') . $brg->gambar; ?>" class="img-fluid" alt="..." width="100"> </td>
                                    <td><?= $brg->keterangan; ?></td>
                                    <td><?php echo $brg->nama_kategori; ?></td>
                                    <td><a href="<?= base_url() ?>Barang/edit_barang/<?= $brg->id_barang; ?>" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                        <a data-toggle="modal" href="#deleteBarang<?= $brg->id_barang; ?>" data-url="" class="btn btn-danger confirm_delete" title="Hapus" class="btn btn-danger" data-toggle="tooltip" data-placement="left" title="Hapus Pegawai"><i class="fa fa-trash"></i></a>
                                        <a href="<?= base_url() ?>Barang/detail_barang/<?= $brg->id_barang; ?>" class="btn btn-info"><i class="fa fa-eye"></i></a>



                                        <!-- Modal Hapus-->
                                        <div class="modal fade" id="deleteBarang<?= $brg->id_barang; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteBusLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>

                                                    <div class="modal-body text-danger">
                                                        <h3>APAKAH ANDA YAKIN INGIN MENGHAPUS DATA PEGAWAI?</h3>
                                                        <h3>PERUBAHAN TIDAK DAPAT DIKEMBALIKAN</h3>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                        <a href="<?= base_url('Barang/hapus_barang/' . $brg->id_barang); ?>"><button type="button" class="btn btn-danger" onclick="return confirm('Anda yakin ingin menghapus data pasien ini?')">Ya</button></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END Modal -->
                                </tr>
                            <?php $i++;
                            endforeach; ?>
                        </tbody>
                    </table>

                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

    </div>
    <!-- /.col -->
</div>
<!-- page end-->