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
                            <img src="<?php echo $pegawai['foto'];?>" class="img-responsive img-thumbnail"/>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="header bg-cyan">
                            <h2>
                                <?php echo $pegawai['nama'];?>
                            </h2>
                        </div>
                        <div class="body">
                            <dl class="dl-horizontal">
                                <dt>Tanggal Lahir</dt>
                                <dd><?=$pegawai['tglLahir']?></dd> 
                                <dt>Alamat Rumah</dt>
                                <dd><?php echo $pegawai['alamat'];?>&nbsp;</dd>                                  
                                <dt>Nomor HP</dt>
                                <dd><?php echo $pegawai['hp'];?>&nbsp;</dd>
                                <dt>Email</dt>
                                <dd><?php echo $pegawai['email'];?>&nbsp;</dd>                                  
                            </dl>

                            <small>Last Update: <?php echo $pegawai['tglUpdate']; ?></small>
                        </div>
                    </div>
                </div>
            </div>