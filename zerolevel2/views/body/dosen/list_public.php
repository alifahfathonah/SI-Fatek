<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"><h3><?php echo $pageTitle;?></h3><small>Source: Database Fakultas Teknik</small></div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="tabel-dosen" class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>Nim</th>
                                            <th>Nama</th>
                                            <th>Nip</th>
                                            <th>Jurusan</th>
                                            <th>Prodi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=1;?>
                                        <?php foreach($dosen as $list) { ?>
                                        <tr>
                                            <td><?php echo $i;?></td>
                                            <td><a href="<?php echo site_url("public/dosen/id/").$list['nip'];?>" target="_blank"><?php echo $list['nama'];?></a></td>
                                            <td><?php echo $list['nip'];?></td>
                                            <td><?php echo $list['jurusan'];?></td>
                                            <td><?php echo $list['prodi'];?></td>
                                        </tr>
                                        <?php $i++;}?>
                                    </tbody>
                                </table>
                            </div>          
                        </div>
                    </div>
                </div>
            </div>