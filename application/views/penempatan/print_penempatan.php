<div class="row">
  <div class="col-md-12">
    <div class="portlet light">
      <div class="portlet-body">
        <div class="invoice">
          <div class="row invoice-logo">
            <div class="col-xs-6 invoice-logo-space">
              <img src="<?= base_url(); ?>assets/pages/media/invoice/walmart.png" class="img-responsive" alt="" />
            </div>
            <div class="col-xs-6">
              <p> #<?php echo $detail_penempatan->id_penempatan; ?> / <?php echo $detail_penempatan->tgl_permintaan_penempatan; ?>
              </p>

            </div>
          </div>
          <hr />
          <div class="row">
            <div class="col-xs-6">
              <h3>Detail Penempatan:</h3>
              <ul class="list-unstyled">
                <li> <b>Lokasi penempatan : </b> <a> <?php echo $detail_penempatan->nama_lokasi; ?></a>
                </li>
                <li> <b>Penanggungjawab : </b> <a><?php echo $detail_penempatan->EMP_NAME; ?></a> </li>
                <li> &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&ensp; <i class="fa fa-envelope mr"> </i> <a><?php echo $detail_penempatan->EMP_EMAIL; ?></a>
                </li>
                <li>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<i class="fa fa-phone"> </i> <a><?php echo $detail_penempatan->EMP_CELL; ?></a>
                </li>
              </ul>
            </div>
            <div class="col-xs-2">

            </div>
            <div class="col-xs-4 invoice-payment">
              <div id="invoice">
                <div class="date">Tanggal Penempatan: <?php echo date('d M Y', strtotime($detail_penempatan->tgl_ditempatkan)); ?></div>
                <div class="date">Status Penempatan <?php if ($detail_penempatan->_diselesaikan == 1) {
                                                      echo "<span class='label label-success'>Telah ditempatkan</span>";
                                                    } else {
                                                      echo "<span class='label label-warning'>Belum ditempatkan</span>";
                                                    }
                                                    ?>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12">
              <table class="table table-striped table-hover">
                <thead>
                  <tr>
                    <th>No</th>
                    <th> Item</th>
                    <th class="hidden-xs"> Jumlah</th>
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
                    </tr>
                  <?php $n++;
                  } ?>

                </tbody>
              </table>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-4">
              <div class="well">
                <address>
                  <p><strong>Di <i>request</i> oleh &nbsp : </strong><?= $detail_penempatan->petugas_peminta; ?></p>
                  <p><strong>Disetujui oleh &nbsp : </strong><?= $detail_penempatan->petugas_penyetuju; ?></p>
                  <p><strong>Diselesaikan oleh &nbsp : </strong><?= $detail_penempatan->petugas_penyelesai; ?></p>
                </address>
              </div>
            </div>
            <div class="col-xs-8 invoice-block">
              <br />
              <a class="btn btn-lg btn-success hidden-print margin-bottom-5" onclick="javascript:window.print();"> Print
                <i class="fa fa-print"></i>
              </a>
              <img src="<?php echo base_url('penempatan/generate_qrcode_penempatan/' .  $detail_penempatan->id_penempatan); ?>" width="100" height="100" class="pull-right">
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>