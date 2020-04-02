<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

			<div class="block-header">
                <h1><?php echo $pageTitle;?></h1>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
                            <div class="table-responsive">
                                 <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Mahasiswa</th>
                                            <th>NIM</th>
                                            <th>Jurusan</th>
                                            <th>Prodi</th>
                                            <th>Keterangan</th>
                                            <th>Tanggal Berlaku</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=1;?>
                                        <?php foreach($disiplin as $list) { ?>
                                        <tr>
                                            <td><?php echo $i;?></td>
                                            <td><a href="<?php echo site_url('detail/mahasiswa/').$list['nim'];?>"><?php echo $list['nama'];?></a></td>
                                            <td><?php echo $list['nim'];?></td>
                                            <td><?php echo $list['jurusan_alias'];?></td>
                                            <td><?php echo $list['prodi_alias'];?></td>
                                            <td><?php echo $list['disiplin'];?></td>
                                            <td><?php echo $list['tglStart'];?> s/d <?php echo $list['tglEnd'];?></td>
                                            <td>
                                                <?php if ($list['status']) {?>
                                                    <span class="label label-success">Tidak berlaku</span>
                                                <?php } else {?>
                                                    <span class="label label-warning">Masih berlaku</span>
                                                <?php }?>    
                                            </td>
                                        </tr> 
                                        <?php $i++;}?>                         
                                    </tbody>
                                </table>
                            </div>  

                        </div>
                    </div>
                </div>
            </div>