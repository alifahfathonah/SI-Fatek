<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"><h3><?php echo $pageTitle;?></h3><small>Source: Database akademik Universitas Sam Ratulangi</small></div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="tabel-judul" class="table table-bordered table-striped table-hover dataTable basicTab">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Judul</th>
                                            <th>Nama</th>
                                            <th>Nim</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=1;?>
                                        <?php foreach($judul as $list) { ?>
                                        
                                        <tr>
                                            <td><?php echo $i;?></td>
                                            <td><?php echo $list->judulTa;?></td>
                                            <td><a href="<?php echo site_url("public/alumni/nim/").$list->nim;?>" target="_blank"><?php echo $list->nama;?></a></td>
                                            <td><?php echo $list->nim;?></td>
                                        </tr>
                                        <?php $i++;}?>
                                    </tbody>
                                </table>
                            </div>          
                        </div>

                    </div>
                </div>
            </div>