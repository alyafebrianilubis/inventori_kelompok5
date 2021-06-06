<?php if ($this->session->userdata('msg'))
  echo "<span class='alert alert-success'>" . $this->session->userdata('msg') . "</span>";
?>

<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Data penempatan | <a href='<?= base_url(); ?>penempatan/tambah_penempatan' class='btn btn-info'>
            Permohonan penempatan <i class="fa fa-plus"></i>
          </a></h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
          <table class="display table table-bordered table-striped dataTable" id="example1">
            <thead>
              <tr>
                <th>No.</th>
                <th>No penempatan</th>
                <th>Tanggal Permintaan <br> Penempatan</th>
                <th>Lokasi</th>
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
              foreach ($penempatan as $pgd) : ?>
                <tr>

                  <td><?= $i; ?></td>
                  <td><?= $pgd->id_penempatan; ?></td>
                  <td><?= date('d M Y', strtotime($pgd->tgl_permintaan_penempatan)); ?></td>
                  <td><?= $pgd->nama_lokasi ?>,
                    <br><?= $pgd->fakultas; ?>
                  </td>
                  <td>


                    <?php if ($pgd->status == 0) : ?>
                      <a href="#" class="label label-warning">
                        <span class="icon text-white-50">
                          <i class="fa fa-hourglass-half"></i>
                        </span>
                        <span class="text">Pending</span>
                      </a>
                    <?php elseif ($pgd->status == 1) : ?>
                      <a href="#" class="label label-success">
                        <span class="icon text-white-50">
                          <i class="fa fa-check"></i>
                        </span>
                        <span class="text">Disetujui</span>
                      </a>
                    <?php else : ?>
                      <a href="#" class="label label-danger">
                        <span class="icon text-white-50">
                          <i class="fa fa-close"></i>
                        </span>
                        <span class="text">Ditolak</span>
                      </a>
                    <?php endif; ?>
                  </td>
                  <td>
                    <!-- Manager hanya bisa lihat detail dan print -->
                    <?php if ($this->session->userdata('group_id') == 2) : ?>
                      <!-- kalau status masih waiting -->
                      <a href="<?= base_url() ?>penempatan/detail_penempatan/<?= $pgd->id_penempatan; ?>" class="btn btn-primary"><i class=" fa fa-eye"></i> </a>
                      <!-- kalau penempatan udah selesai baru bisa diprint -->
                      <?php if ($pgd->status == 1 && $pgd->_diselesaikan == 1) : ?>
                        <a href="<?= base_url() ?>penempatan/print_penempatan/<?= $pgd->id_penempatan; ?>" class="btn btn-default"><i class=" fa fa-file"></i> </a>
                      <?php endif; ?>
                    <?php else :  ?>

                      <!-- kalau belum diterima atau ditolak manager tidak bisa diproses-->
                      <!-- atau kalo sudah diterima dan sudah diproses tidak bisa lagi diproses-->
                      <?php if (($pgd->status == 0 || $pgd->status == 2)) : ?>
                        <a href="#" class="btn btn-default disabled " title="selesaikan">
                          <span class=" icon text-white-50">
                            <i class="fa  fa-check-square-o"></i>
                          </span>
                        </a>
                        <!-- kalau sudah diselesaikan tidak bisa lagi diselesaikan-->
                      <?php elseif ($pgd->status == 1 && $pgd->_diselesaikan == 1) : ?>
                        <a href="" class="btn btn-success disabled" title="selesai">
                          <span class=" icon text-white-50">
                            <i class="fa  fa-check-square-o"></i>
                          </span>
                        </a>
                        <!-- kalau sudah diterima manager baru bisa diselesaikan-->
                      <?php else : ?>
                        <a href="<?= base_url(); ?>penempatan/selesaikan_penempatan/<?= $pgd->id_penempatan; ?>" class="btn btn-success" title="selesaikan">
                          <span class="icon text-white-50">
                            <i class="fa  fa-check-square-o"></i>
                          </span>

                        </a>
                      <?php endif; ?>

                      <!-- kalau status masih waiting -->
                      <!-- kalau belum disetujui atau ditolak baru boleh diedit -->
                      <?php if ($pgd->status == 0) : ?>
                        <a href="<?= base_url() ?>penempatan/edit_penempatan/<?= $pgd->id_penempatan; ?>" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                      <?php endif; ?>
                      <a href="<?= base_url() ?>penempatan/detail_penempatan/<?= $pgd->id_penempatan; ?>" class="btn btn-primary"><i class=" fa fa-eye"></i> </a>
                      <a data-toggle="modal" href="#deletepenempatan<?= $pgd->id_penempatan; ?>" data-url="" class="btn btn-danger confirm_delete" title="Hapus" class="btn btn-danger" data-toggle="tooltip" data-placement="left" title="Hapus penempatan"><i class="fa fa-trash"></i></a>

                      <!-- kalau penempatan udah selesai baru bisa diprint -->
                      <?php if ($pgd->status == 1 && $pgd->_diselesaikan == 1) : ?>
                        <a href="<?= base_url() ?>penempatan/print_penempatan/<?= $pgd->id_penempatan; ?>" class="btn btn-default"><i class=" fa fa-file"></i> </a>
                      <?php endif; ?>
                    <?php endif; ?>

                    <!-- persetujuan hanya untuk manager -->
                    <?php if ($this->session->userdata('group_id') == 2) : ?>
                      <!-- Aktion penyetujuan pemasukan pengeluaran -->
                  <td>
                    <?php if ($pgd->status == 0) : ?>
                      <a class="btn btn-info" data-toggle="modal" href="#sign-modal1<?= $pgd->id_penempatan; ?>">
                        <span class=" icon text-white-50">
                          <i class="fa fa-thumbs-up"></i>
                        </span>
                      </a>

                      <a data-toggle="modal" href="#sign-modal2<?= $pgd->id_penempatan; ?>" class="btn btn-danger">
                        <span class=" icon text-white-50">
                          <i class="fa fa-thumbs-down"></i>
                        </span>
                      </a>

                    <?php elseif ($pgd->status == 1) : ?>
                      <a href="#<?= $pgd->id_penempatan; ?>" class="btn btn-info" data-toggle="tooltip" disabled="disabled">
                        <span class=" icon text-white-50">
                          <i class="fa fa-thumbs-up"></i>
                        </span>
                      </a>

                    <?php elseif ($pgd->status == 2) :  ?>
                      <a href="#<?= $pgd->id_penempatan; ?>" class="btn btn-danger" data-toggle="tooltip" disabled="disabled">
                        <span class=" icon text-white-50">
                          <i class="fa fa-thumbs-down"></i>
                        </span>
                      </a>
                    <?php endif; ?>
                  <?php endif; ?>


                  <!-- Modal Hapus-->
                  <div class="modal fade" id="deletepenempatan<?= $pgd->id_penempatan; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteBusLabel" aria-hidden="true">
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
                          <a href="<?= base_url('penempatan/hapus_penempatan/' . $pgd->id_penempatan); ?>"><button type="button" class="btn btn-danger">Ya</button></a>
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



<!-- Modal Nerima -->
<?php foreach ($penempatan as $rows) : ?>

  <div class="modal fade" id="sign-modal1<?php echo $rows->id_penempatan; ?>" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
          <h4 class="modal-title">Tanda Tangan Untuk Menerima Penempatan</h4>
        </div>

        <div class="modal-body">
          <img src="<?php echo base_url($sig['img']); ?>" alt="">
        </div>
        <br>
        <div class="modal-footer">


          <button type="button" class="btn btn-secondary" data-dismiss="modal"></i>Cancel</button>
          <a href="<?= base_url('Penempatan/nerima_penempatan/' . $rows->id_penempatan); ?>">
            <button type="button" class="btn btn-primary" onclick="return confirm('Anda yakin ingin meneriman penempatan ini?')"><i class="fa fa-check"></i>Save</button>
        </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
<?php endforeach; ?>


<!-- Modal Tolak -->
<?php foreach ($penempatan as $rows1) : ?>
  <div class="modal fade" id="sign-modal2<?php echo $rows1->id_penempatan; ?>" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
          <h4 class="modal-title" style="color:#FF0000;">Tanda Tangan Untuk Menolak Penempatan</h4>
        </div>

        <div class="modal-body">
          <img src="<?php echo base_url($sig['img']); ?>" alt="">
        </div>
        <br>
        <div class="modal-footer">


          <button type="button" class="btn btn-secondary" data-dismiss="modal"></i>Cancel</button>
          <a href="<?= base_url('Penempatan/tolak_penempatan/' . $rows1->id_penempatan); ?>">
            <button type="button" class="btn btn-danger" onclick="return confirm('Anda yakin ingin menolak penempatan ini?')"><i class="fa fa-check"></i> Save</button>
        </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
<?php endforeach; ?>