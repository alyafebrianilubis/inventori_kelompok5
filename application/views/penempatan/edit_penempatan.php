<div class="row">
  <div class="col-lg-12">
    <section class="panel">
      <header class="panel-heading">
        Form Tambah Penempatan
      </header>
      <?php
      if ($this->session->flashdata('msg'));
      echo $this->session->flashdata('msg');

      ?>
      <div class="panel-body">
        <?php $attributes = array('class' => 'form-horizontal group-border hover-stripped', 'method' => 'post');
        echo form_open_multipart('Penempatan/update_penempatan', $attributes); ?>

        <div class="form-group">
          <div class="col-sm-3">
            <input class="form-control" name="id_penempatan" value="<?= $edit_penempatan->id_penempatan; ?>" readonly>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-6"><label for="date">Tanggal</label>
            <input type="date" name="datedepart" id="date" class="form-control" value="<?= date('Y-m-d', strtotime($edit_penempatan->tgl_permintaan_penempatan)); ?>" required>
          </div>
        </div>

        <div class="form-group">
          <div class="col-sm-6"><label>Lokasi</label><select class="form-control" id="id_lokasi" name="id_lokasi" required>
              <option value="">pilih..</option>
              <?php foreach ($lokasi as $lks) : ?>
                <?php if ($edit_penempatan->id_lokasi == $lks->id_lokasi) {
                ?> <option selected value="<?= $lks->id_lokasi; ?>"><?= $lks->nama_lokasi; ?>, <?php echo $lks->fakultas; ?></option>
                <?php } else { ?>
                  <option value="<?= $lks->id_lokasi; ?>"><?= $lks->nama_lokasi; ?>, <?php echo $lks->fakultas; ?></option> <?php } ?>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-6"><label>Pegawai Penganggung Jawab</label><select class="form-control" id="EMP_ID" name="EMP_ID" required>
              <option value="">pilih..</option>
              <?php foreach ($pegawai as $spl) : ?>
                <?php if ($edit_penempatan->pegawai_penanggung_jawab == $spl->EMP_ID) {
                ?> <option selected value="<?= $spl->EMP_ID; ?>"><?= $spl->EMP_NAME; ?></option>
                <?php } else { ?>
                  <option value="<?= $spl->EMP_ID; ?>"><?= $spl->EMP_NAME; ?></option> <?php } ?>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
        <?php foreach ($item_barang as $brg_item) : ?>
          <div class="form-group fieldGroup">
            <div class="input-group">

              <div class="col-sm-7"><label>Barang</label>
                <select class="form-control" id="id_barang[]" name="id_barang[]" required>
                  <option value="">pilih..</option>
                  <?php foreach ($barang as $brg) { ?>
                    <?php if ($brg_item->id_barang == $brg->id_barang) {
                    ?>
                      <?php if ($brg->jumlah > 0) : ?>
                        <?php if ($brg->jumlah <= 10) : ?>
                          <option style="color:red" selected value="<?php echo $brg->id_barang; ?>"> <?php echo $brg->nama_barang; ?> (stok: <?php echo $brg->jumlah; ?> )
                          <?php else : ?>
                          <option selected value="<?php echo $brg->id_barang; ?>"> <?php echo $brg->nama_barang; ?> (stok: <?php echo $brg->jumlah; ?> )
                          <?php endif; ?>
                        <?php endif; ?>
                      <?php } else { ?>
                        <?php if ($brg->jumlah > 0) : ?>
                          <?php if ($brg->jumlah <= 10) : ?>
                          <option style="color:red" value="<?php echo $brg->id_barang; ?>"> <?php echo $brg->nama_barang; ?> (stok: <?php echo $brg->jumlah; ?> )
                          <?php else : ?>
                          <option value="<?php echo $brg->id_barang; ?>"> <?php echo $brg->nama_barang; ?> (stok: <?php echo $brg->jumlah; ?> )
                          <?php endif; ?>
                        <?php endif; ?>
                      <?php } ?>
                    <?php } ?>
                </select>
              </div>
              <div class="col-sm-4">
                <label>Jumlah</label><input class="form-control" name="jumlah[]" type="text" value="<?php echo $brg_item->jumlah; ?>"> <?= form_error('jumlah', '<small class="text-danger">', '</small>'); ?>
              </div>
              <div class="input-group-addon">
                <a href="javascript:void(0)" class="btn btn-success addMore"><i class="fa fa-plus"></i></a>
              </div>
              <div class="input-group-addon">
                <a href="javascript:void(0)" class="btn btn-danger remove"><i class="fa fa-trash"></i></a>
              </div>

            </div>
          </div>
        <?php endforeach; ?>
      </div>
  </div>

  <hr>
  <div class=" form-group" style="padding-left: 42%">
    <div class="col-md-6">
      <input type="submit" name="Save" class="btn btn-info">
      <a href="<?= base_url(); ?>Penempatan" class="btn btn-danger">Cancel</a>
    </div>
  </div>



  <div class="form-group fieldGroupCopy" style="display: none;">
    <div class="input-group">
      <div class="col-sm-7"><label>Barang</label>
        <select class="form-control" id="id_barang[]" name="id_barang[]">
          <option value="">pilih..</option>
          <?php foreach ($barang as $brg) : ?>
            <?php if ($brg->jumlah > 0) : ?>
              <?php if ($brg->jumlah <= 10) : ?>
                <option style="color:red" value="<?php echo $brg->id_barang; ?>"> <?php echo $brg->nama_barang; ?> (stok: <?php echo $brg->jumlah; ?> )
                <?php else : ?>
                <option value="<?php echo $brg->id_barang; ?>"> <?php echo $brg->nama_barang; ?> (stok: <?php echo $brg->jumlah; ?> )
                <?php endif; ?>
              <?php endif; ?>
            <?php endforeach; ?>
        </select>
      </div>
      <div class="col-sm-4">
        <label>Jumlah</label><input class="form-control" name="jumlah[]" type="text" value="<?= set_value('jumlah') ?>"> <?= form_error('jumlah', '<small class="text-danger">', '</small>'); ?>
      </div>
      <div class="input-group-addon">
        <a href="javascript:void(0)" class="btn btn-danger remove"><i class="fa fa-trash"></i></a>
      </div>
    </div>
  </div>

  <?php form_close(); ?>

</div>
</section>

</div>
</div>
<!-- page end-->
<!--Table starts-->


<!--Table ends-->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.rawgit.com/igorescobar/jQuery-Mask-Plugin/1ef022ab/dist/jquery.mask.min.js"></script>
<script>
  $(document).ready(function() {
    // membatasi jumlah inputan
    var maxGroup = 10;

    //melakukan proses multiple input 
    $(".addMore").click(function() {
      if ($('body').find('.fieldGroup').length < maxGroup) {
        var fieldHTML = '<div class="form-group fieldGroup">' + $(".fieldGroupCopy").html() + '</div>';
        $('body').find('.fieldGroup:last').after(fieldHTML);
      } else {
        alert('Maximum ' + maxGroup + ' groups are allowed.');
      }
    });

    //remove fields group
    $("body").on("click", ".remove", function() {
      $(this).parents(".fieldGroup").remove();
    });
  });
</script>