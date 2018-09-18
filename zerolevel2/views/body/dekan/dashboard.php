<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

			<div class="block-header">
                <h2><?php echo $pageTitle;?></h2>
            </div>

            <!-- Widgets -->
            <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-red hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">people</i>
                        </div>
                        <div class="content">
                            <div class="text">MAHASISWA</div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $API['jlhMhs'];?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>               
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-green hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">school</i>
                        </div>
                        <div class="content">
                            <div class="text">ALUMNI</div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $API['jlhAlu'];?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-blue hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">local_library</i>
                        </div>
                        <div class="content">
                            <div class="text">DOSEN</div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $API['jlhDsn'];?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-purple hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">person</i>
                        </div>
                        <div class="content">
                            <div class="text">PEGAWAI</div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $API['jlhPgw'];?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- #END# Widgets -->

            <div class="row clearfix">
                <!-- Line1 Chart -->
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Jumlah Mahasiswa Baru & Alumni per Tahun</h2>
                        </div>
                        <div class="body">
                            <div id="chart-mhs-alumni" class="graph"></div>
                        </div>
                    </div>
                </div>
                <!-- #END# Line1 Chart -->
            </div>

            <div class="row clearfix">
                <!-- Bar1 Chart -->
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Jumlah Mahasiswa Aktif per Jurusan</h2>
                        </div>
                        <div class="body">
                            <div id="chart-mhs-aktif-jurusan" class="graph"></div>
                        </div>
                    </div>
                </div>
                <!-- #END# Bar1 Chart -->
                <!-- Bar1 Chart -->
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Jumlah Mahasiswa Aktif per Prodi</h2>
                        </div>
                        <div class="body">
                            <div id="chart-mhs-aktif-prodi" class="graph"></div>
                        </div>
                    </div>
                </div>
                <!-- #END# Bar1 Chart -->
            </div>

            <div class="row clearfix">
                <!-- Bar1 Chart -->
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Jumlah Alumni per Jurusan</h2>
                        </div>
                        <div class="body">
                            <div id="chart-alu-jurusan" class="graph"></div>
                        </div>
                    </div>
                </div>
                <!-- #END# Bar1 Chart -->
                <!-- Bar1 Chart -->
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Jumlah Alumni per Prodi</h2>
                        </div>
                        <div class="body">
                            <div id="chart-alu-prodi" class="graph"></div>
                        </div>
                    </div>
                </div>
                <!-- #END# Bar1 Chart -->
            </div>            

            <div class="row clearfix">
                <!-- Bar1 Chart -->
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Jumlah Dosen per Jurusan</h2>
                        </div>
                        <div class="body">
                            <div id="chart-dsn-jurusan" class="graph"></div>
                        </div>
                    </div>
                </div>
                <!-- #END# Bar1 Chart -->
                <!-- Bar1 Chart -->
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Jumlah Dosen per Prodi</h2>
                        </div>
                        <div class="body">
                            <div id="chart-dsn-prodi" class="graph"></div>
                        </div>
                    </div>
                </div>
                <!-- #END# Bar1 Chart -->
            </div> 

<script type="text/javascript">
    
    var data1   = <?php echo json_encode($API['mhs']);?>;
    var data2   = <?php echo json_encode($API['mhsjur']);?>;
    var data3   = <?php echo json_encode($API['mhspro']);?>;
    var data4   = <?php echo json_encode($API['alujur']);?>;
    var data5   = <?php echo json_encode($API['alupro']);?>;
    var data6   = <?php echo json_encode($API['dosjur']);?>;
    var data7   = <?php echo json_encode($API['dospro']);?>;
</script>            