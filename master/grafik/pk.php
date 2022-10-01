    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-8">         
          <!-- BAR CHART -->
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Bar Chart</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
            <?php /*
for ($bulan = 1; $bulan <= 12; $bulan++) {
mysql_select_db($database_koneksi, $koneksi);
$query_rs_grafik = "SELECT periode_penerimaankas, tanggal_penerimaankas, count(kode_penerimaankas) as BykTransaksi FROM `tb_penerimaankas` WHERE month(tanggal_penerimaankas) = ".$bulan." AND periode_penerimaankas = '".$ta."'";
$rs_grafik = mysql_query($query_rs_grafik, $koneksi) or die(mysql_error());
$row_rs_grafik = mysql_fetch_assoc($rs_grafik);
$totalRows_rs_grafik = mysql_num_rows($rs_grafik);

	if (empty($row_rs_grafik['BykTransaksi'])) {
		$jumlah_produk[] = 0 . ",";
	}else{ 
		$jumlah_produk[] = $row_rs_grafik['BykTransaksi'] . ",";
	}
}

*/
?>  
              <div class="chart">
                <canvas id="barChart" style="height:230px"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
        <!-- /.col (RIGHT) -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->