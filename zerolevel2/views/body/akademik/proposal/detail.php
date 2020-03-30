<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

            <div class="block-header">
                <h2><?php echo $pageTitle;?></h2>
            </div>
           
            <div class="row clearfix">

                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
                            <dl class="dl-horizontal">
                                <dt>Judul</dt>
                                <dd><?php echo $judul; ?>&nbsp;</dd>
                                <dt>Nama</dt>
                                <dd><?php echo $nama; ?>&nbsp;</dd>
                                <dt>NIM</dt>
                                <dd><?php echo $nim; ?>&nbsp;</dd>
                                <dt>Prodi</dt>
                                <dd><?php echo $nama_prodi; ?>&nbsp;</dd>                                  
                                <dt>Jurusan</dt>
                                <dd><?php echo $nama_jurusan; ?>&nbsp;</dd>  
                                <dt>Jumlah SKS Lulus</dt>
                                <dd><?php echo $sksLulus; ?> SKS&nbsp;</dd>              
                                <dt>Status MK. Skripsi</dt>
                                <dd><span class="label bg-<?php echo ($kontrakSkripsi=="Sedang dikontrak" ? "green" : "orange");?>"><?php echo $kontrakSkripsi; ?></span>&nbsp;</dd>                                  
                                <dt>Pelanggaran Akademik</dt>
                                <dd><span class="label bg-<?php echo ($pelanggaranAk=="Tidak ada" ? "green" : "orange");?>"><?php echo $pelanggaranAk; ?></span>&nbsp;</dd>
                                <dt>Dokumen Pendukung</dt>
                                <dd>
                                    <?php foreach ($dokumen as $key => $value) {
                                        echo "<a href='".$value."' target='_BLANK'>"."Dokumen ".($key+1)."</a><br/>"; 
                                    }?>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header bg-cyan">
                            <h2>
                                History Pengusulan
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table id="tabelData" class="table table-bordered table-hover dataTable">
                                    <thead>
                                        <tr>
                                            <th>Proses</th>
                                            <th>Tanggal</th>
                                            <th>Status</th>
                                            <th>User</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=1;?>
                                        <?php foreach($history as $list) { ?>
                                        <tr>
                                            <td><?php echo $i;?></td>
                                            <td><?php echo $list['tgl'];?></td>
                                            <td><?php echo $list['comment'];?></td>
                                            <td><?php echo $list['userPerform'];?></td>
                                        </tr> 
                                        <?php $i++;}?>                         
                                    </tbody>
                                </table>
                            </div>  
                        </div>
                    </div>
                </div>
            </div>