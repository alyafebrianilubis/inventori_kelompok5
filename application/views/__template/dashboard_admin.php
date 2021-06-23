<div class="row">
  <div class="col-lg-3">
    <!-- small box -->
    <div class="small-box bg-orange">
      <div class="inner">
        <h3><?= $total_users; ?></h3>

        <p>Jumlah User</p>
      </div>
      <div class="icon">
        <i class="ion ion-android-contacts"></i>
      </div>
      <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-olive">
      <div class="inner">
        <h3><?= $total_petugas; ?></h3>

        <p>Jumlah Petugas Inventaris</p>
      </div>
      <div class="icon">
        <i class="ion ion-ios-people"></i>
      </div>
      <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-maroon">
      <div class="inner">
        <h3><?= $total_supplier; ?></h3>

        <p>Jumlah Supplier</p>
      </div>
      <div class="icon">
        <i class="fa fa-shopping-cart"></i>
      </div>
      <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-lime">
      <div class="inner">
        <h3><?= $total_supplier; ?></h3>

        <p>Jumlah Barang</p>
      </div>
      <div class="icon">
        <i class="ion ion-cube"></i>
      </div>
      <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
</div>
<!-- ./row -->

<div class="row">

  <div class="col md-4 col-md-4 col-sm-6 col-xs-12">
    <!-- Info Boxes Style 2 -->
    <div class="info-box bg-green">
      <span class="info-box-icon"><i class="glyphicon glyphicon-stats"></i></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Total Pengadaan</span>
        <span class="info-box-number"><?= $total_pengadaan ?></span>

        <div class="progress">
          <div class="progress-bar" style="width: 100%"></div>
        </div>
        <span class="progress-description"> <?= $total_pengadaan_bulan_ini ?> pengadaan bulan ini
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
    <div class="info-box bg-orange">
      <span class="info-box-icon"><i class="glyphicon glyphicon-stats"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Total Penempatan</span>
        <span class="info-box-number"><?= $total_penempatan ?></span>

        <div class="progress">
          <div class="progress-bar" style="width: 100%"></div>
        </div>
        <span class="progress-description"><?= $total_penempatan_bulan_ini ?> penempatan bulan ini
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- Info Boxes Style 2 -->
    <div class="info-box bg-olive">
      <span class="info-box-icon"><i class="glyphicon glyphicon-arrow-right"></i></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Total Permohonan Pengadaan</span>
        <span class="info-box-number"><?= $total_permohonan_pengadaan ?></span>

        <div class="progress">
          <div class="progress-bar" style="width: 100%"></div>
        </div>
        <span class="progress-description"> <?= $total_permohonan_pengadaan_bulan_ini ?> permohonan pengadaan bulan ini
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
    <div class="info-box bg-yellow">
      <span class="info-box-icon"><i class="glyphicon glyphicon-arrow-left"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Total Permohonan Penempatan</span>
        <span class="info-box-number"><?= $total_permohonan_penempatan ?></span>

        <div class="progress">
          <div class="progress-bar" style="width: 100%"></div>
        </div>
        <span class="progress-description"><?= $total_permohonan_penempatan_bulan_ini ?> permohonan penempatan bulan ini
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
  </div>
  <!-- /.col -->


  <div class="col-lg-4">
    <!--Time line permohonan hari ini start-->
    <ul class="timeline">

      <!-- timeline time label -->
      <li class="time-label">
        <span class="bg-red">
          <?php echo date('d F Y'); ?>
        </span>
      </li>
      <!-- /.timeline-label -->

      <!-- timeline item header-->
      <li>
        <!-- timeline icon -->
        <i class="glyphicon glyphicon-arrow-right"></i>
        <div class="timeline-item">
          <h3 class="timeline-header"><a href="#">Update Laporan <br> Pengadaan Hari Ini</a></h3>
        </div>
      </li>
      <!-- END timeline header -->

      <?php foreach ($update_pengadaan_hari_ini as $update_pengadaan_today) : ?>
        <!-- jika status == 1 atau laporan diterima -->
        <?php if ($update_pengadaan_today->status == 1) : ?>
          <!-- timeline item -->
          <li>
            <!-- timeline icon -->
            <i class="glyphicon glyphicon-ok bg-green"></i>
            <div class="timeline-item">

              <h3 class="timeline-header"><a href="<?= base_url() ?>Pengadaan/detail_pengadaan/<?= $update_pengadaan_today->id_pengadaan; ?>">Pengadaan <?= $update_pengadaan_today->id_pengadaan ?></a> yang diajukan oleh <?= $update_pengadaan_today->petugas_peminta ?></h3>

              <div class="timeline-body">
                telah diterima oleh <?= $update_pengadaan_today->petugas_penyetuju ?>
              </div>
              <!-- END timeline item -->

              <!-- jika status == 2 atau laporan ditolak -->
            <?php elseif ($update_pengadaan_today->status == 2) : ?>
              <!-- timeline item -->
          <li>
            <!-- timeline icon -->
            <i class="glyphicon glyphicon-remove bg-red"></i>
            <div class="timeline-item">

              <h3 class="timeline-header"><a href="<?= base_url() ?>Pengadaan/detail_pengadaan/<?= $update_pengadaan_today->id_pengadaan; ?>">Pengadaan <?= $update_pengadaan_today->id_pengadaan ?></a> yang diajukan oleh <?= $update_pengadaan_today->petugas_peminta ?></h3>

              <div class="timeline-body">
                ditolak oleh <?= $update_pengadaan_today->petugas_penyetuju ?>
              </div>
              <!-- END timeline item -->

              <!-- jika status == 0 atau laporan masih pending -->
            <?php elseif ($update_pengadaan_today->status == 0) : ?>
              <!-- timeline item -->
          <li>
            <!-- timeline icon -->
            <i class="fa fa-hourglass-half bg-yellow"></i>
            <div class="timeline-item">

              <h3 class="timeline-header"><a href="<?= base_url() ?>Pengadaan/detail_pengadaan/<?= $update_pengadaan_today->id_pengadaan; ?>">Pengadaan <?= $update_pengadaan_today->id_pengadaan ?></a> yang diajukan oleh <?= $update_pengadaan_today->petugas_peminta ?></h3>

              <div class="timeline-body">
                belum mendapat respon
              </div>
            </div>
          </li>
          <!-- END timeline item -->
        <?php endif; ?>
      <?php endforeach; ?>
    </ul>
    <!--Time line permohonan hari ini -->
  </div>

  <div class="col-lg-4">
    <!--Time line permohonan hari ini start-->
    <ul class="timeline">

      <!-- timeline time label -->
      <li class="time-label ">
        <span class="">
        </span>
      </li>
      <!-- /.timeline-label -->

      <li class="pt-2">
        <!-- timeline icon -->
        <i class="glyphicon glyphicon-arrow-left"></i>
        <div class="timeline-item">
          <h3 class="timeline-header"><a href="#">Update Laporan <br> Penempatan Hari Ini</a></h3>
        </div>
      </li>
      <!-- END timeline header -->

      <?php foreach ($update_penempatan_hari_ini as $update_penempatan_today) : ?>
        <!-- jika status == 1 atau laporan diterima -->
        <?php if ($update_penempatan_today->status == 1) : ?>
          <!-- timeline item -->
          <li>
            <!-- timeline icon -->
            <i class="glyphicon glyphicon-ok bg-green"></i>
            <div class="timeline-item">

              <h3 class="timeline-header"><a href="<?= base_url() ?>penempatan/detail_penempatan/<?= $update_penempatan_today->id_penempatan; ?>">penempatan <?= $update_penempatan_today->id_penempatan ?></a> yang diajukan oleh <?= $update_penempatan_today->petugas_peminta ?></h3>

              <div class="timeline-body">
                telah diterima oleh <?= $update_penempatan_today->petugas_penyetuju ?>
              </div>
              <!-- END timeline item -->

              <!-- jika status == 2 atau laporan ditolak -->
            <?php elseif ($update_penempatan_today->status == 2) : ?>
              <!-- timeline item -->
          <li>
            <!-- timeline icon -->
            <i class="glyphicon glyphicon-remove bg-red"></i>
            <div class="timeline-item">

              <h3 class="timeline-header"><a href="<?= base_url() ?>penempatan/detail_penempatan/<?= $update_penempatan_today->id_penempatan; ?>">penempatan <?= $update_penempatan_today->id_penempatan ?></a> yang diajukan oleh <?= $update_penempatan_today->petugas_peminta ?></h3>

              <div class="timeline-body">
                ditolak oleh <?= $update_penempatan_today->petugas_penyetuju ?>
              </div>
              <!-- END timeline item -->

              <!-- jika status == 0 atau laporan masih pending -->
            <?php elseif ($update_penempatan_today->status == 0) : ?>
              <!-- timeline item -->
          <li>
            <!-- timeline icon -->
            <i class="fa fa-hourglass-half bg-yellow"></i>
            <div class="timeline-item">

              <h3 class="timeline-header"><a href="<?= base_url() ?>penempatan/detail_penempatan/<?= $update_penempatan_today->id_penempatan; ?>">penempatan <?= $update_penempatan_today->id_penempatan ?></a> yang diajukan oleh <?= $update_penempatan_today->petugas_peminta ?></h3>

              <div class="timeline-body">
                belum mendapat respon
              </div>
            </div>
          </li>
          <!-- END timeline item -->
        <?php endif; ?>
      <?php endforeach; ?>
    </ul>
    <!--Time line permohonan hari ini -->
  </div>


</div>

<div class="row">
  <div class="col-lg-8">
    <!--work progress start-->
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Laporan Persediaan Barang</h3>
      </div>
      <div class="box-body">
        <table class="table table-hover personal-task">
          <tbody>
            <tr>
              <th>Stok barang</th>
              <th>Nama</th>
            </tr>
            <?php foreach ($persediaan_barang as $pd) : ?>
              <?php if ($pd->jumlah <= 10) : ?>
                <tr>
                  <td><span class="date">
                      <font style="text-decoration:blink; color:#F00; font-size:18px">
                        <span class='label label-danger'><?= $pd->jumlah; ?></span>
                      </font>
                    </span> <span class="time">
                    </span></td>
                  <td><a href="#"><?= $pd->nama_barang; ?></a></td>
                </tr>
              <?php else : ?>
                <tr>
                  <td><span class="date">
                      <span class='label label-success'><?= $pd->jumlah; ?></span> </span> <span class="time">
                    </span></td>
                  <td><a href="#"><?= $pd->nama_barang; ?></a></td>
                </tr>
              <?php endif; ?>
            <?php endforeach; ?>
          </tbody>
          <tfoot>

          </tfoot>
        </table>
      </div>
    </div>
    <!--work progress end-->
  </div>

  <div class="col md-4 col-md-4 col-sm-6 col-xs-12">
    <div class="info-box bg-olive">
      <span class="info-box-icon"><i class="glyphicon glyphicon-download"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Total Jumlah Barang Masuk</span>
        <span class="info-box-number"><?= $jumlah_barang_masuk; ?></span>

        <div class="progress">
          <div class="progress-bar" style="width: 100%"></div>
        </div>
        <span class="progress-description">
          <?= $jumlah_barang_masuk_bulan_ini; ?> barang masuk bulan ini
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- Info Boxes Style 2 -->
    <div class="info-box bg-maroon">
      <span class="info-box-icon"><i class="glyphicon glyphicon-upload"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Total Jumlah Barang Keluar</span>
        <span class="info-box-number"><?= $jumlah_barang_keluar; ?></span>

        <div class="progress">
          <div class="progress-bar" style="width: 100%"></div>
        </div>
        <span class="progress-description">
          <?= $jumlah_barang_keluar_bulan_ini; ?> barang keluar bulan ini
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>


  </div>
  <!-- /.col -->
</div>