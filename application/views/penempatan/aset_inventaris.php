<?php if ($this->session->userdata('msg'))
  echo "<span class='alert alert-success'>" . $this->session->userdata('msg') . "</span>";
?>

<div class="row">
  <div class="col-xs-12">
    <div class="box box-solid box-default">
      <div class="box-header">
        <h3 class="box-title">Data Aset Inventaris yang Ditempatkan </h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
          <table class="display table table-bordered table-striped dataTable" id="example1">
            <thead>
              <tr>
                <th>No.</th>
                <th>Qrcode</th>
                <th>Kategori <br> barang</th>
                <th>Detail Barang</th>
                <th>Detail Penempatan</th>
                <th>Lokasi</th>
                <th>Keterangan</th>
                <th width="100px">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1;
              foreach ($keluar_item as $ki) : ?>
                <tr>

                  <td><?= $i; ?></td>
                  <td><img src="<?php echo base_url('pengadaan/generate_qrcode/' . $ki->id_barang); ?>" width="100" height="100"></td>
                  <td>
                    <br /><?= $ki->nama_kategori; ?>
                  </td>
                  <td>
                    <a href="<?= base_url('assets_user/img/') . $ki->gambar; ?>" class="btn btn-primary-outline"><i class=" fa fa-file-image-o"></i> </a>
                    <br>
                    <?= $ki->nama_barang ?><br>
                    <?= $ki->jumlah_keluar; ?> buah
                  </td>
                  <td><?= $ki->id_penempatan; ?><br><?= date('d M Y', strtotime($ki->tgl_keluar)); ?>
                    <br>
                    penanggung jawab : <?= $ki->penanggung_jawab; ?>
                  </td>
                  <td><?= $ki->nama_lokasi ?>, <br><?= $ki->fakultas; ?><br>
                  </td>
                  <td><?= $ki->keterangan; ?>
                  </td>

                  <td>

                    <!-- kalau status masih waiting -->
                    <a href="<?= base_url() ?>penempatan/detail_aset_inventaris/<?= $ki->id; ?>" class="btn btn-primary"><i class=" fa fa-eye"></i> </a>

                    <!-- Modal Hapus-->
                    <div class="modal fade" id="deletepenempatan<?= $ki->id_penempatan; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteBusLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>

                          <div class="modal-body text-danger">
                            <h3>APAKAH ANDA YAKIN INGIN MENGHAPUS DATA PENEMPATAN INI?</h3>
                            <h3>PERUBAHAN TIDAK DAPAT DIKEMBALIKAN</h3>
                          </div>

                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <a href="<?= base_url('penempatan/hapus_penempatan/' . $ki->id_penempatan); ?>"><button type="button" class="btn btn-danger">Ya</button></a>
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