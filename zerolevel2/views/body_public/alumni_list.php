<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"><h3><?php echo $pageTitle;?></h3><small>Source: Database akademik Universitas Sam Ratulangi</small></div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="tabel-alumni" class="table table-bordered table-striped table-hover dataTable basicTab">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Nim</th>
                                            <th>Angkatan</th>
                                            <th>Jurusan</th>
                                            <th>Prodi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=1;?>
                                        <?php foreach($alumni as $list) { ?>
                                        
                                        <tr>
                                            <td><a href="<?php echo site_url("public/alumni/nim/").$list->nim;?>" target="_blank"><?php echo $list->nama;?></a></td>
                                            <td><?php echo $list->nim;?></td>
                                            <td><?php echo $list->angkatan;?></td>
                                            <td><?php echo $list->jurusan;?></td>
                                            <td><?php echo $list->prodi;?></td>

                                        </tr>
                                        <?php $i++;}?>
                                    </tbody>
                                </table>
                            </div>          
                        </div>

                    </div>
                </div>
            </div>