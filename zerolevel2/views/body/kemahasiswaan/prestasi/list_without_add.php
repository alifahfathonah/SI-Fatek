<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

			<div class="block-header">
                <h1><?php echo $pageTitle;?></h1>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Daftar Mahasiswa</h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Mahasiswa</th>
                                            <th>Nim</th>
                                            <th>Jurusan</th>
                                            <th>Prodi</th>
                                            <th>Prestasi</th>
                                            <th>Tingkat</th>
                                            <th>Tgl. Kegiatan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=1;?>
                                        <?php foreach($prestasi as $list) { ?>
                                        <tr>
                                            <td><?php echo $i;?></td>
                                            <td><a href="<?php echo site_url('detail/mahasiswa/').$list['nim'];?>"><?php echo $list['nama'];?></a></td>
                                            <td><?php echo $list['nim'];?></td>
                                            <td><?php echo $list['jurusan_alias'];?></td>
                                            <td><?php echo $list['prodi_alias'];?></td>
                                            <td><?php echo $list['prestasi'];?> <?php echo $list['even'];?></td>
                                            <td><?php echo $list['tingkat'];?></td>
                                            <td><?php echo $list['tglLomba'];?></td>
                                        </tr> 
                                        <?php $i++;}?>                        
                                    </tbody>
                                </table>
                            </div>  

                        </div>
                    </div>
                </div>
            </div>