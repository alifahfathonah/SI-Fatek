<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

            <div class="block-header">
                <h1><?php echo $pageTitle;?></h1>
            </div>
            
            <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="header bg-cyan">
                            <h2>Foto Profil</h2>
                        </div>
                        <div class="body">
                            <img src="<?php echo $dosen['foto'];?>" class="img-responsive img-thumbnail"/>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="header bg-cyan">
                            <h2>
                                <?php echo $dosen['nama'];?>
                            </h2>
                        </div>
                        <div class="body">
                            <dl class="dl-horizontal">
                                <dt>Tanggal Lahir</dt>
                                <dd><?=$dosen['tglLahir']?></dd> 
                                <dt>Jabatan</dt>
                                <dd><?php echo $dosen['jabatan'];?>&nbsp;</dd>
                                <dt>Office Address</dt>
                                <dd><?php echo $dosen['alamat'];?>&nbsp;</dd>                                  
                                <dt>Nomor HP</dt>
                                <dd><?php echo $dosen['hp'];?>&nbsp;</dd>
                                <dt>Jurusan</dt>
                                <dd><?php echo $dosen['jurusan'];?>&nbsp;</dd>                                  
                                <dt>Program Studi</dt>
                                <dd><?php echo $dosen['prodi'];?>&nbsp;</dd>
                                <dt>Email</dt>
                                <dd><?php echo $dosen['email'];?>&nbsp;</dd>                                  
                                <dt>Research Field</dt>
                                <dd><?php echo $dosen['interest'];?>&nbsp;</dd>
                            </dl>

                            <div class="link">
                                <h5>External Link</h5>
                                <div class="list-group">
                                    <a href="<?php echo site_url('public/dosen/id/'. $dosen['nip']);?>" target="_blank" class="list-group-item list-group-item-action">Fatek Digital Card</a>
                                    <?php if (isset($dosen['sintaUrl'])) {?> <a href="<?php echo $dosen['sintaUrl'];?>" target="_blank" class="list-group-item list-group-item-action">Science and Technology Index</a><?php }?>
                                    <?php if (isset($dosen['googleUrl'])) {?> <a href="<?php echo $dosen['googleUrl'];?>" target="_blank" class="list-group-item list-group-item-action">Google Scholar</a><?php }?>
                                    <?php if (isset($dosen['scopusUrl'])) {?> <a href="<?php echo $dosen['scopusUrl'];?>" target="_blank" class="list-group-item list-group-item-action">Scopus Author</a><?php }?>
                                </div>
                            </div>
                            <small>Last Update: <?php echo $dosen['tglUpdate']; ?></small>
                        </div>
                    </div>
                </div>
            </div>