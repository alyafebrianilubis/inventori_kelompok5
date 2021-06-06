<div class="row">
    <div class="col-md-12">
        <!-- BEGIN SAMPLE FORM box-->
        <div class="box">
            <div class="box-title">
                <h4><i class="icon-reorder"></i> Laporan Pengadaan </h4>
                <span class="tools">
                    <a href="javascript:;" class="icon-chevron-down"></a>
                </span>
            </div>
            <div class="box-body">
                <!-- BEGIN FORM-->

                <?php echo form_open('laporan/laporan_pengadaan', array('class' => "form-horizontal form-bordered form-validate", 'method' => 'post')) ?>
                <div class="row">
                    <div class="col-lg-6">
                        <label class="control-label">START DATE</label>
                        <input type="text" data-ad-format="" class="form-control datepicker" name="start_date">
                    </div>
                    <div class="col-lg-6">
                        <label class="control-label">END DATE</label>
                        <input type="text" class="form-control datepicker" name="end_date">
                    </div>
                </div>
                <br>
                <div class="form-actions">
                    <input type="hidden" name="Action" value="Search">
                    <button type="submit" class="btn btn-success">Show Report</button>
                    <button type="reset" class="btn">Cancel</button>
                </div>
                </form>
                <!-- END FORM-->
                <?php if (isset($_REQUEST['Action']) == "Search") { ?>

                    <div class="row ">
                        <div class="col-md-8 col-md-offset-2">
                            <form method="post" action="#">
                                <div class="btn-group pull-right">
                                    <a onclick="print_invoice('printableArea')" class="btn btn-primary">Print</a>
                                    <input name="start_date" value="2017-04-05" type="hidden">
                                    <input name="end_date" value="2017-04-05" type="hidden">

                                </div>
                            </form>

                        </div>
                    </div>

                    <br>
                    <br>
                    <div id="printableArea">
                        <link href="<?= base_url(); ?>assets/laporan.css" rel="stylesheet" type="text/css">


                        <div class="row ">
                            <div class="col-md-8 col-md-offset-2">
                                <header class="clearfix center">
                                    <div id="logo">
                                        <img src="<?= base_url() ?>assets/usu.png">
                                    </div>
                                    <div id="company">
                                        <h2 class="name">Universitas Sumatera Utara</h2>
                                        <div>Kelompok 5</div>
                                        <div>Sistem Inventaris Kelompok 5</div>
                                    </div>

                                </header>
                                <hr>

                                <main class="invoice_report">

                                    <h4>Laporan Pengadaan dari: <strong><?php echo $start ?></strong> sampai
                                        <strong><?php echo $end ?></strong>
                                    </h4>
                                    <br />
                                    <br />

                                    <?php
                                    $key = 0;
                                    $total_cost = 0;
                                    $total_sell = 0;
                                    $total_profit = 0;
                                    $p = 0;
                                    ?>
                                    <?php if (!empty($invoice_details)) : foreach ($invoice_details as $id_pengadaan => $pengadaan) : ?>
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th class="text-left">Data Pengadaan</th>
                                                        <th class="desc">Tanggal
                                                            Pengadaan : <?php echo date('Y-m-d', strtotime($order[$key]->tgl_masuk)) ?></th>
                                                        <th class="desc">
                                                            Kode Pengadaan : <?php echo $order[$key]->id_pengadaan ?></th>
                                                    </tr>
                                                </thead>
                                            </table>
                                            <table border="0" cellspacing="0" cellpadding="0">
                                                <thead>
                                                    <tr style="background-color: #ECECEC">
                                                        <th class="no text-center">No</th>
                                                        <th class="desc text-center">Nama barang</th>
                                                        <th class="qty text-center">Jumlah</th>
                                                        <th class="hrg text-center">Harga</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $k = 1 ?>
                                                    <?php foreach ($pengadaan as $pgd) : ?>
                                                        <tr>
                                                            <td class="no text-center"><?= $k; ?></td>
                                                            <td class="desc text-center"><?= $pgd->nama_barang; ?></td>
                                                            <td class="qty text-center"><?= $pgd->jumlah_masuk; ?></td>
                                                            <td class="hrg text-center"><?= $pgd->harga; ?></td>
                                                        </tr>

                                                        <?php $k++ ?>


                                                    <?php
                                                    endforeach;
                                                    ?>


                                                </tbody>

                                                <tfoot>

                                                    <tr>
                                                        <td colspan="3">Total Harga</td>
                                                        <td class="text-center"><?php echo number_format($order[$key]->total_harga, 2) ?></td>
                                                    </tr>

                                                </tfoot>

                                            </table>
                                            <?php $key++; ?>
                                    <?php endforeach;
                                    endif; ?>

                                </main>
                                <hr>
                                <footer class="text-center">
                                    <!-- <strong><?= $company->name; ?></strong>&nbsp;&nbsp;&nbsp;<?= $company->address; ?> -->
                                </footer>


                            </div>
                        </div>

                    </div>
                <?php } ?>

            </div>
        </div>
        <!-- END SAMPLE FORM box-->
    </div>
</div>

<script type="text/javascript">
    function print_invoice(printableArea) {

        var table = $('#dataTables-example').DataTable();
        table.destroy();

        //$('#dataTables-example').attr('id','none');
        var printContents = document.getElementById(printableArea).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        //$('table').attr('id','dataTables-example');
        location.reload(document.body.innerHTML = originalContents);
        //document.body.innerHTML = originalContents;
    }
</script>