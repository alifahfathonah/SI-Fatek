<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

			<div class="block-header">
                <h2><?php echo $pageTitle;?></h2>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Daftar Alumni | <span class="subtitle">Semua Angkatan</span></h2>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4 form-control-label">
                                    <label>Pilih Angkatan</label>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <select class="form-control show-tick" data-live-search="true" id="table-filter">
                                                <option value="">Semua</option>
                                                <?php $i = date('Y') - 4; $max = $i-10;
                                                for ($i;$i>=$max;$i--) {?>
                                                    <option value="<?php echo $i;?>"><?php echo $i;?></option>
                                                <?php }?>
                                            </select> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <!-- Tabel Alumni -->
                                <table class="table table-bordered table-striped table-hover tblListMhsApi">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Nim</th>
                                            <th>Angkatan</th>
                                            <th>Jurusan</th>
                                            <th>Prodi</th>
                                            <th>Tahun Lulus</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=1;?>
                                        <?php foreach($alumniApi as $list) { ?>
                                        
                                        <tr>
                                            <td><?php echo $i;?></td>
                                            <td><a href="<?php echo site_url('detail/alumni/').$list->nim;?>"><?php echo $list->nama;?></a></td>
                                            <td><?php echo $list->nim;?></td>
                                            <td><?php echo $list->angkatan;?></td>
                                            <td><?php echo $list->jurusan;?></td>
                                            <td><?php echo $list->prodi;?></td>
                                            <td><?php echo $list->tahunLulus;?></td>                                           
                                        </tr>
                                        <?php $i++;}?>
                                    </tbody>
                                </table>
                                <!-- #END# Tabel Alumni -->
                            </div> 
                        </div>
                    </div>
                </div>
            </div>        