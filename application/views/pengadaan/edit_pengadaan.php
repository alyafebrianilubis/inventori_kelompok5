<?php


/*foreach ($results as $menulists) {


  @$menulistRow .= "<tr class='gradeA odd'>

								<td class='center'>" . $menulists->MENU_TEXT . "

								<td>" . $menulists->MENU_URL . "

								<td>" . $menulists->SORT_ORDER . "

								<td class=center>" . $menulists->PARENT_ID . "";


}*/
?>

<div class="row">
  <div class="col-lg-12">
    <section class="panel">
      <header class="panel-heading">
        Form Tambah Pengadaan
      </header>
      <?php
      if ($this->session->flashdata('msg'));
      echo $this->session->flashdata('msg');
      ?>
      <div class="panel-body">
        <?php $attributes = array('class' => 'form-horizontal group-border hover-stripped', 'method' => 'post');
        echo form_open_multipart('Pengadaan/update_pengadaan', $attributes); ?>
        <div class="form-group">
          <div class="col-sm-3">
            <input class="form-control" name="id_pengadaan" value="<?= $edit_pengadaan->id_pengadaan; ?>" readonly>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-6"><label for="date">Tanggal</label>
            <input type="date" name="datedepart" id="date" class="form-control" required value="<?= date('Y-m-d', strtotime($edit_pengadaan->tgl_permintaan)); ?>"> <?= form_error('date', '<small class="text-danger">', '</small>'); ?>
          </div>
          <div class=" col-sm-6"><label>Supplier</label><select class="form-control" id="id_supplier" name="id_supplier" required>
              <option value="">select..</option>

              <?php foreach ($supplier as $spl) { ?>
                <?php if ($edit_pengadaan->id_supplier == $spl->id_supplier) {
                ?> <option selected value="<?= $spl->id_supplier; ?>"><?= $spl->nama_supplier; ?></option>
                <?php } else { ?>
                  <option value="<?= $spl->id_supplier; ?>"><?= $spl->nama_supplier; ?></option> <?php } ?>
              <?php } ?>
            </select>
            <?= form_error('id_supplier', '<small class="text-danger">', '</small>'); ?>
          </div>
        </div>

        <?php foreach ($item_barang as $brg_item) : ?>
          <div class="form-group fieldGroup">
            <div class="input-group">
              <div class="col-sm-4"><label>Barang</label>


                <select class="form-control" id="id_barang[]" name="id_barang[]">
                  <option value="">select..</option>

                  <?php foreach ($barang as $brg) { ?>
                    <?php if ($brg_item->id_barang == $brg->id_barang) {
                    ?>
                      <?php if ($b->jumlah <= 10) : ?>
                        <option style="color:red" selected value="<?= $brg->id_barang; ?>"><?= $brg->nama_barang; ?>(stok: <?php echo $brg->jumlah; ?> )</option>
                      <?php else : ?>
                        <option selected value="<?php echo $brg->id_barang; ?>"> <?php echo $b->nama_barang; ?> ( )
                        <?php endif; ?>
                      <?php } else { ?>
                        <?php if ($b->jumlah <= 10) : ?>
                        <option style="color:red" value="<?= $brg->id_barang; ?>"><?= $brg->nama_barang; ?>(stok: <?php echo $brg->jumlah; ?> )</option>
                      <?php else : ?>
                        <option selected value="<?php echo $brg->id_barang; ?>"> <?php echo $b->nama_barang; ?> ( )
                        <?php endif; ?> <?php } ?>
                    <?php } ?>

                </select>
              </div>
              <div class="col-sm-4">

                <label>Jumlah</label><input class="form-control" name="jumlah[]" type="text" value="<?php echo $brg_item->jumlah; ?>"> <?= form_error('jumlah', '<small class="text-danger">', '</small>'); ?>
              </div>

              <div class="col-sm-4">
                <label>Harga</label>
                <input class="form-control" name="harga[]" type="int" value="<?= $brg_item->harga; ?>"> <?= form_error('harga', '<small class="text-danger">', '</small>'); ?>
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
      <a href="<?= base_url(); ?>pengadaan" class="btn btn-danger">Cancel</a>
    </div>
  </div>

  <div class="form-group fieldGroupCopy hidden" style="display: none;">
    <div class="input-group">
      <div class="col-sm-4"><label>Barang</label>
        <select class="form-control" id="id_barang[]" name="id_barang[]">
          <option value="">select..</option>
          <?php foreach ($barang as $brg_item) : ?>
            <?php if ($brg_item->jumlah <= 10) : ?>
              <option style="color:red" value="<?php echo $brg_item->id_barang; ?>"> <?php echo $brg_item->nama_barang; ?> (stok: <?php echo $brg_item->jumlah; ?> )
              <?php else : ?>
              <option value="<?php echo $brg_item->id_barang; ?>"> <?php echo $brg_item->nama_barang; ?> (stok: <?php echo $brg_item->jumlah; ?> )
              <?php endif; ?>
            <?php endforeach; ?>
        </select>
      </div>
      <div class="col-sm-4">
        <label>Jumlah</label><input class="form-control" name="jumlah[]" type="text" value="<?= set_value('jumlah') ?>"> <?= form_error('jumlah', '<small class="text-danger">', '</small>'); ?>
      </div>

      <div class="col-sm-4">
        <label>Harga</label><input class="form-control" name="harga[]" type="text" value="<?= set_value('harga') ?>"> <?= form_error('harga', '<small class="text-danger">', '</small>'); ?>
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

<script type="text/javascript">
  $(document).ready(function() {
    // Format mata uang.
    $('.uang').mask('0.000.000.000', {
      reverse: true
    });
  })
</script>