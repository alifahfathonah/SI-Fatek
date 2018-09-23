<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

            <div class="block-header">
                <h2><?php echo $pageTitle;?></h2>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Daftar Pegawai Fakultas Teknik</h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <!-- Tabel Pegawai -->
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Nip</th>
                                            <th>Status</th>
                                            <th>Pangkat/Gol</th>
                                            <th>Fungsional</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=1;?>
                                        <?php foreach($pegawai as $list) { ?>

                                        <tr>
                                            <td><?php echo $i;?></td>
                                            <td><a href="<?php echo site_url("admin/detail/pegawai/").$list->nip;?>"><?php echo $list->nama;?></a></td>
                                            <td><?php echo $list->nip;?></td>
                                            <td><?php echo $list->statusPegawai;?></td>
                                            <td><?php echo $list->pangkatGolongan;?></td>
                                            <td><?php echo $list->jabatanFungsional;?></td>

                                        </tr>
                                        <?php $i++;}?>
                                    </tbody>
                                </table>
                                <!-- #END# Tabel Pegawai -->
                            </div> 
                        </div>
                    </div>
                </div>
            </div>