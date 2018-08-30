<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

            <div class="block-header">
                <h2>DOKUMEN DOSEN</h2>
            </div>
            
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
                            <!-- Tabel dokumen -->
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable basicTabel">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Dokumen / Deskripsi</th>
                                            <th>Nomor</th>
                                            <th>Tahun</th>
                                            <th>Kategori</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=1;?>
                                        <?php foreach($dokumen as $list) { ?>
                                        
                                        <tr>
                                            <td><?php echo $i;?></td>
                                            <td>
                                                <a href="<?php echo $list['dokumenFile'];?>" target="_blank"><?php echo $list['dokumenNama'];?></a><br>
                                                <small><?php echo $list['dokumenDeskripsi'];?></small>
                                            </td>
                                            <td><?php echo $list['dokumenNomor'];?></td>
                                            <td><?php echo $list['dokumenTahun'];?></td>
                                            <td><?php echo $list['docgroupJenisDoc'];?></td>
                                        </tr>
                                        <?php $i++;}?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- #END# Tabel dokumen -->
                        </div>
                    </div>
                </div>
            </div>