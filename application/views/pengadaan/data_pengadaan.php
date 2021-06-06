<?php if ($this->session->userdata('msg'))
  echo "<span class='alert alert-success'>" . $this->session->userdata('msg') . "</span>";
?>

<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Data Pengadaan | <a href='<?= base_url(); ?>Pengadaan/tambah_pengadaan' class='btn btn-info'>
            Permohonan Pengadaan <i class="fa fa-plus"></i>
          </a></h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
          <table class="display table table-bordered table-striped dataTable" id="example1">
            <thead>
              <tr>
                <th>No.</th>
                <th>No Pengadaan</th>
                <th>Tanggal <br> Permintaan <br> Pengadaan</th>
                <th>Supplier</th>
                <th>Total Biaya</th>
                <th>Diminta oleh</th>
                <th>Status</th>
                <th>Aksi</th>
                <!-- persetujuan hanya untuk manager -->
                <?php if ($this->session->userdata('group_id') == 2) : ?>
                  <th>Persetujuan</th>
                <?php endif; ?>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1;
              foreach ($pengadaan as $pgd) : ?>
                <tr>

                  <td><?= $i; ?></td>
                  <td><?= $pgd->id_pengadaan; ?></td>
                  <td><?= date('d M Y', strtotime($pgd->tgl_permintaan)); ?></td>
                  <td><?= $pgd->nama_perusahaan; ?></td>
                  <td><?= $pgd->total_harga; ?></td>
                  <td><?= $pgd->nama_petugas; ?></td>
                  <td><?php if ($pgd->status == 0) : ?>
                      <span class="label label-warning">
                        <span class="icon text-white-50">
                          <i class="fa fa-hourglass-half"></i> Pending</span>
                      </span>
                    <?php elseif ($pgd->status == 1 && $pgd->_dibayar == 1) : ?>
                      <span class="label label-success">
                        <span class="icon text-white-50">
                          <i class="fa fa-check"></i> Disetujui
                        </span>
                      </span>

                    <?php elseif ($pgd->status == 1) : ?>
                      <span class="label label-success">
                        <span class="icon text-white-50">
                          <i class="fa fa-check"></i> Disetujui
                        </span>
                      </span>

                    <?php else : ?>
                      <span class="label label-danger">
                        <span class="icon text-white-50">
                          <i class="fa fa-close"></i> Ditolak
                        </span>
                      </span>
                    <?php endif; ?>
                  </td>

                  <td>
                    <!-- Manager hanya bisa melihat detail -->
                    <?php if ($this->session->userdata('group_id') == 2) : ?>
                      <a href="<?= base_url() ?>Pengadaan/detail_pengadaan/<?= $pgd->id_pengadaan; ?>" class="btn btn-primary"><i class=" fa fa-eye"></i> </a>

                      <!-- Superadmin dan petugas bisa melakukan semua aksi -->
                    <?php else : ?>
                      <!-- kalau belum disetujui atau ditolak baru boleh diedit -->
                      <?php if ($pgd->status == 0) : ?>
                        <a href="<?= base_url() ?>pengadaan/edit_pengadaan/<?= $pgd->id_pengadaan; ?>" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                      <?php endif; ?>
                      <a href="<?= base_url() ?>Pengadaan/detail_pengadaan/<?= $pgd->id_pengadaan; ?>" class="btn btn-primary"><i class=" fa fa-eye"></i> </a>
                      <a data-toggle="modal" href="#deletePengadaan<?= $pgd->id_pengadaan; ?>" data-url="" class="btn btn-danger confirm_delete" title="Hapus" class="btn btn-danger" data-toggle="tooltip" data-placement="left" title="Hapus Pengadaan"><i class="fa fa-trash"></i></a>
                    <?php endif; ?>

                    <!-- persetujuan hanya untuk manager -->
                    <!-- Aktion penyetujuan pemasukan pengeluaran -->
                    <?php if ($this->session->userdata('group_id') == 2) : ?>
                  <td>
                    <?php if ($pgd->status == 0) : ?>
                      <a class="btn btn-info" data-toggle="modal" href="#sign-modal1<?= $pgd->id_pengadaan; ?>">
                        <span class=" icon text-white-50">
                          <i class="fa fa-thumbs-up"></i>
                        </span>
                      </a>

                      <a data-toggle="modal" href="#sign-modal2<?= $pgd->id_pengadaan; ?>" class="btn btn-danger">
                        <span class=" icon text-white-50">
                          <i class="fa fa-thumbs-down"></i>
                        </span>
                      </a>


                    <?php elseif ($pgd->status == 1) : ?>
                      <a href="#<?= $pgd->id_pengadaan; ?>" class="btn btn-info" data-toggle="tooltip" disabled="disabled">
                        <span class=" icon text-white-50">
                          <i class="fa fa-thumbs-up"></i>
                        </span>
                      </a>


                    <?php elseif ($pgd->status == 2) :  ?>
                      <a href="#<?= $pgd->id_pengadaan; ?>" class="btn btn-danger" data-toggle="tooltip" disabled="disabled">
                        <span class=" icon text-white-50">
                          <i class="fa fa-thumbs-down"></i>
                        </span>
                      </a>
                    <?php endif; ?>

                  <?php endif; ?>




                  <!-- Modal Hapus-->
                  <div class="modal fade" id="deletePengadaan<?= $pgd->id_pengadaan; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteBusLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>

                        <div class="modal-body text-danger">
                          <h3>APAKAH ANDA YAKIN INGIN MENGHAPUS DATA PENGADAAN?</h3>
                          <h3>PERUBAHAN TIDAK DAPAT DIKEMBALIKAN</h3>
                        </div>

                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                          <a href="<?= base_url('Pengadaan/hapus_pengadaan/' . $pgd->id_pengadaan); ?>"><button type="button" class="btn btn-danger">Ya</button></a>
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



<!-- Modal Edit -->
<?php foreach ($pengadaan as $rows) : ?>

  <div class="modal fade" id="sign-modal1<?php echo $rows->id_pengadaan; ?>" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
          <h4 class="modal-title">Tanda Tangan Untuk Menerima Pengadaan</h4>
        </div>

        <div class="modal-body">
          <img src="<?php echo base_url($sig['img']); ?>" alt="">
        </div>
        <br>
        <div class="modal-footer">


          <button type="button" class="btn btn-secondary" data-dismiss="modal"></i>Cancel</button>
          <a href="<?= base_url('Pengadaan/nerima_pengadaan/' . $rows->id_pengadaan); ?>">
            <button type="button" class="btn btn-primary" onclick="return confirm('Anda yakin ingin menerima pengadaan ini?')"><i class="fa fa-check"></i> Save</button>
        </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
<?php endforeach; ?>


<?php foreach ($pengadaan as $rows1) : ?>

  <div class="modal fade" id="sign-modal2<?php echo $rows1->id_pengadaan; ?>" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
          <h4 class="modal-title" style="color:#FF0000;">Tanda Tangan Untuk Menolak Pengadaan</h4>
        </div>

        <div class="modal-body">
          <img src="<?php echo base_url($sig['img']); ?>" alt="">
        </div>
        <br>
        <div class="modal-footer">

          <button type="button" class="btn btn-secondary" data-dismiss="modal"></i>Cancel</button>
          <a href="<?= base_url('Pengadaan/tolak_pengadaan/' . $rows1->id_pengadaan); ?>">
            <button type="button" class="btn btn-danger" onclick="return confirm('Anda yakin ingin menolak pengadaan ini?')"><i class="fa fa-check"></i> Save</button>
        </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
<?php endforeach; ?>