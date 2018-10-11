<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

			<div class="block-header">
                <h2><?php echo $pageTitle;?></h2>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Daftar Mahasiswa <?php echo $subtitle;?></h2>
                        </div>

                        <div class="body">

                            <form>
                                <div class="row clearfix">
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4 form-control-label">
                                        <label>Pilih Angkatan</label>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <select class="form-control show-tick" onchange="if (this.value) window.location.href=this.value">>
                                                    <?php $i = date('Y'); $max = $i-8;
                                                    for ($i;$i>=$max;$i--) {?>
                                                        <option value="<?php echo $i;?>" <?php if ($i == $angkatan) echo "selected";?>><?php echo $i;?></option>
                                                    <?php }?>
                                                </select> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>                                                      

                            <div class="table-responsive">
                                <!-- Tabel Mahasiswa -->
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Nim</th>
                                            <th>Prodi</th>
                                            <th>Status</th>
                                            <th>SKS Kontrak</th>
                                            <th>SKS Lulus</th>
                                            <th>IPK</th>
                                            <th>Kontrak TA</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=1;?>
                                        <?php foreach($mahasiswa as $list) { ?>

                                        <tr>
                                            <td><?php echo $i;?></td>
                                            <td><a href="<?php echo site_url('admin/detail/mahasiswa/').$list->nim;?>"><?php echo $list->nama;?></a></td>
                                            <td><?php echo $list->nim;?></td>
                                            <td><?php echo $list->prodi;?></td>
                                            <td><?php echo $list->statusMahasiswa;?></td>
                                            <td><?php echo $list->akademik->sksTotal;?></td>
                                            <td><?php echo $list->akademik->sksLulus;?></td>
                                            <td><?php echo $list->akademik->ipk;?></td>
                                            <td><?php echo $list->akademik->statusTa;?></td>                                          

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