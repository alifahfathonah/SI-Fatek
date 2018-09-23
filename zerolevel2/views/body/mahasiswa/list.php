<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

			<div class="block-header">
                <h2><?php echo $pageTitle;?></h2>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Daftar Mahasiswa <?php echo $subtitle;?></h2>
                            <ul class="header-dropdown m-r--5" data-toggle="tooltip" data-placement="left" title="Filter berdasarkan status">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="<?php echo site_url('admin/data/mahasiswa');?>">Status Aktif</a></li>
                                        <li><a href="<?php echo site_url('admin/data/mahasiswa/all');?>">Semua</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <!-- Tabel Mahasiswa -->
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Nim</th>
                                            <th>Status</th>
                                            <th>Jalur Masuk</th>
                                            <th>Sumber Dana</th>
                                            <th>Jurusan</th>
                                            <th>Prodi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=1;?>
                                        <?php foreach($mahasiswa as $list) { ?>

                                        <tr>
                                            <td><?php echo $i;?></td>
                                            <td><a href="<?php echo site_url('admin/detail/mahasiswa/').$list->nim;?>"><?php echo $list->nama;?></a></td>
                                            <td><?php echo $list->nim;?></td>
                                            <td><?php echo $list->statusMahasiswa;?></td>
                                            <td><?php echo $list->jalurMasuk;?></td>
                                            <td><?php echo $list->sumberDana;?></td>
                                            <td><?php echo $list->jurusan;?></td>
                                            <td><?php echo $list->prodi;?></td>

                                        </tr>
                                        <?php $i++;}?>
                                    </tbody>
                                </table>
                                <!-- #END# Tabel Mahasiswa -->
                            </div> 
                        </div>
                    </div>
                </div>
            </div>