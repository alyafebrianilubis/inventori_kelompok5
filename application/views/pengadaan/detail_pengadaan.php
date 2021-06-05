<section class="content">


  <div class="row">
    <div class="col-md-4">
      <div class="box box">
        <div class="box-body box-profile">

          <h3 class="profile-username text-center"><?php echo $detail_pengadaan->id_pengadaan; ?></h3>

          <p class="text-muted">supplier</p>

          <ul class="list-group list-group-unbordered">
            <li class="list-group-item">
              <b>Nama Supplier</b> <a class="pull-right"><?php echo $detail_pengadaan->nama_supplier; ?></a>
            </li>
            <li class="list-group-item">
              <b>Perusahaan</b> <a class="pull-right"><?php echo $detail_pengadaan->nama_perusahaan; ?></a>
            </li>
            <li class="list-group-item">
              <p class="text-right"><i class="fa fa-envelope mr"> </i> <a><?php echo $detail_pengadaan->email; ?></a></p>
            </li>
            <li class="list-group-item">
              <p class="text-right"><i class="fa fa-phone"> </i> <a><?php echo $detail_pengadaan->no_telpSupplier; ?></a></p>
            </li>
          </ul>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>

    <div class="col-md-8">
      <!-- Detail Pengajuan Permintaan Box -->
      <div class="box box">
        <div class="box-header with-border">
          <h3 class="box-title">Detail Pengajuan Permintaan</h3>
          <div class="text-right">
            <a href="<?= base_url('Pengadaan/data_pengadaan') ?>" class="btn btn-default">Back</a>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-sm-4 mx-auto">
              <strong><i class="fa fa-user"></i> Diajukan oleh</strong>
              <p class="text-muted ml">
                <?php if (empty($detail_pengadaan)) {
                  echo "<span>NO record</span>";
                } else {
                  echo $detail_pengadaan->petugas_peminta;
                } ?>
              </p>
            </div>

            <?php if ($detail_pengadaan->status == 0) : ?>
              <div class="col-sm-4 mx-auto pull-right">

                <p class="text-muted ml">
                  <span>Belum disetujui</span>
                </p>

              </div>

            <?php elseif ($detail_pengadaan->status == 1) : ?>
              <div class="col-sm-4 mx-auto pull-right">
                <strong><i class="fa fa-user"></i> Disetujui oleh</strong>
                <br>
                <p class="text-muted ml"><?php echo $detail_pengadaan->petugas_penyetuju; ?></p>
              </div>

            <?php elseif ($detail_pengadaan->status == 2) : ?>
              <div class="col-sm-4 mx-auto pull-right">
                <strong><i class="fa fa-user"></i> Ditolak oleh</strong>
                <p class="text-muted ml">
                  <?php echo $detail_pengadaan->petugas_penyetuju; ?>
                </p>
              </div>

            <?php endif ?>

          </div>
          <hr>
          <strong><i class="fa fa-cubes"></i> Detail barang</strong>
          <div class="row">
            <div class="col-xs-12">
              <table class="table table-striped table-hover">
                <thead>
                  <tr>
                    <th>No</th>
                    <th> Item</th>
                    <th class="hidden-xs"> Jumlah</th>
                    <th class="hidden-xs"> Harga</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $n = 1;
                  foreach ($barang as $rows) {
                  ?>
                    <tr>
                      <td><?php echo $n; ?></td>
                      <td><?php echo $rows->nama_barang; ?></td>
                      <td><?php echo $rows->jumlah; ?></td>
                      <td class=""><?php echo $rows->harga; ?></td>
                    </tr>
                  <?php $n++;
                  } ?>

                </tbody>
              </table>
              <strong>Total harga : </strong><?php echo $detail_pengadaan->total_harga; ?>
            </div>
          </div>

          <hr>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
  </div>

</section>