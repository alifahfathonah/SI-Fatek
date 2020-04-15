<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

            <div class="block-header">
                <h1><?php echo $pageTitle;?></h1>
            </div>
           
            <div class="row clearfix">

                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
                            <dl class="dl-horizontal">

                                <dt>Nama</dt>
                                <dd><?php echo $nama; ?>&nbsp;</dd>
                                <dt>NIM</dt>
                                <dd><?php echo $nim; ?>&nbsp;</dd>
                                <dt>Prodi</dt>
                                <dd><?php echo $nama_prodi; ?>&nbsp;</dd>                                  
                                <dt>Jurusan</dt>
                                <dd><?php echo $nama_jurusan; ?>&nbsp;</dd>
                            </dl>

                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Jenis Layanan</th>
                                        <th>Informasi Tambahan</th>
                                        <th>Dokumen</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?php echo $jenisLayanan; ?></td>
                                        <td><?php echo $infoTambahan; ?></td>
                                        <td>
                                            <?php if ($file) { 
                                                foreach ($file as $key => $value) {
                                                    echo "<a href='".$value."' target='_BLANK'>"."File".($key+1)."</a><br/>"; 
                                                }
                                             }?>
                                        </td>

                                    </tr>
                                </tbody>
                            </table>


                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header bg-cyan">
                            <h2>
                                History Disposisi
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table id="tabelData" class="table table-bordered table-hover dataTable">
                                    <thead>
                                        <tr>
                                            <th>Proses</th>
                                            <th>Tanggal</th>
                                            <th>Keterangan</th>
                                            <th>Status</th>
                                            <th>User</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=1;?>
                                        <?php foreach($disposisi as $list) { ?>
                                        <tr>
                                            <td><?php echo $i;?></td>
                                            <td><?php echo $list['prosesTgl'];?></td>
                                            <td><?php echo $list['komentar'];?></td>
                                            <td>
                                                <span class="label bg-<?php echo $list['prosesColor'];?>"><?php echo $list['prosesStatus'];?></span>
                                            </td>
                                            <td><?php echo $list['fromUser'];?></td>
                                        </tr> 
                                        <?php $i++;}?>                         
                                    </tbody>
                                </table>
                            </div>  
                        </div>
                    </div>
                </div>
            </div>