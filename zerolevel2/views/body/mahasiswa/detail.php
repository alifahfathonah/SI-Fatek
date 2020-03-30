<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

            <div class="block-header">
                <h2><?php echo $pageTitle;?></h2>
            </div>
           
            <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header bg-green">
                            <h2>Foto Profil</h2>
                        </div>
                        <div class="body">
                            <img src="<?php echo $mhsAPI->foto;?>" class="img-responsive img-thumbnail"/>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header bg-green">
                            <h2>
                                <?php echo $mhsAPI->nama;?>
                                <small>NIM: <?php echo $mhsAPI->nim;?></small>
                            </h2>
                        </div>
                        <div class="body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs tab-nav-right" role="tablist">
                                <li role="presentation" class="active"><a href="#home" data-toggle="tab">DATA UTAMA</a></li>
                                <li role="presentation"><a href="#address" data-toggle="tab">DATA ALAMAT</a></li>
                                <li role="presentation"><a href="#family" data-toggle="tab">DATA KELUARGA</a></li>
                                <li role="presentation"><a href="#other" data-toggle="tab">DATA LAIN</a></li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="home">
                                    <dl class="dl-horizontal">
                                        <dt>Tempat Tanggal Lahir</dt>
                                        <dd><?php echo $mahasiswa['tempat_lahir']. " ".$mhsAPI->tanggalLahir;?></dd>

                                        <dt>Jenis Kelamin</dt>
                                        <dd><?php echo $mhsAPI->jenisKelamin;?></dd>

                                        <dt>Jurusan / Program Studi</dt>
                                        <dd><?php echo $mhsAPI->jurusan; ?> / <?php echo $mhsAPI->prodi; ?></dd>
    
                                        <dt>Angkatan</dt>
                                        <dd><?php echo $mhsAPI->angkatan; ?></dd>                           

                                        <dt>Jalur Masuk</dt>
                                        <dd><?php echo $mahasiswa['jalur_masuk']; ?></dd>

                                        <dt>Beasiswa</dt>
                                        <dd><?php echo $mahasiswa['beasiswa']; ?></dd>

                                        <dt>Email</dt>
                                        <dd><?php echo $mahasiswa['email']; ?></dd>

                                        <dt>Nomor Handphone</dt>
                                        <dd><?php echo $mahasiswa['nohp']; ?></dd>
                                        
                                        <dt>Status Pernikahan</dt>
                                        <dd><?php echo $mahasiswa['status_nikah']; ?></dd>
                                        
                                        <dt>Agama</dt>
                                        <dd><?php echo $mhsAPI->agama; ?></dd>
                                        
                                    </dl>
                                    <label><i class="fa fa-graduation-cap fa-fw"></i> Riwayat Pendidikan</label>
                                    <ol>
                                        <li><span class="label label-info">SD</span> <?php echo $mahasiswa['sd']; ?></li>
                                        <li><span class="label label-info">SMP</span> <?php echo $mahasiswa['smp']; ?></li>
                                        <li><span class="label label-info">SMA</span> <?php echo $mahasiswa['sma']; ?></li>
                                    </ol>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="address">
                                    <p>
                                        <label>Alamat Rumah (Asal)</label><br/>
                                        <?php echo $mahasiswa['alamat'];?>
                                    </p>
                                    <p>
                                        <label>Alamat Orang Tua / Wali</label><br/>
                                        <?php echo $mahasiswa['alamat_ortu'];?>
                                    </p>
                                    <p>
                                        <label>Alamat di Manado</label><br/>
                                        <?php echo $mahasiswa['alamat_manado'];?>
                                    </p>
                                    <p>
                                        <label>Status Tempat Tinggal di Manado</label><br/>
                                        <?php echo $mahasiswa['status_rumah']; ?>
                                    </p>
                                    <p>
                                        <label>Jarak dari Kampus</label><br/>
                                        <?php echo $mahasiswa['jarak']; ?> Km
                                    </p>
                                    <p>
                                        <label>Transportasi yang digunakan</label><br/>
                                        <?php echo $mahasiswa['transportasi']; ?>
                                    </p>    
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="family">
                                    <p>
                                        <label>Anak Ke-</label><?php echo $mahasiswa['anak_ke'];?> 
                                        <label>Dari </label> <?php echo $mahasiswa['bersaudara'];?> <label> bersaudara</label>
                                    </p>
                                    <div class="row">
                                        <div class="col-xs-1">
                                            <span class="label label-info">Ayah</span>
                                        </div>
                                        <div class="col-xs-11">
                                                <label>Nama</label>
                                                <?php echo $mahasiswa['nama_ayah'];?><br/>

                                                <label>Pekerjaan</label>
                                                <?php echo $mahasiswa['pekerjaan_ayah'];?><br/>

                                                <label>Pendidikan Terakhir</label>
                                                <?php echo $mahasiswa['pendidikan_ayah'];?><br/>
                                                
                                                <label>No Telp.</label>
                                                <?php echo $mahasiswa['telp_ayah'];?><br/>                                  
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-1">
                                            <span class="label label-info">Ibu</span>
                                        </div>
                                        <div class="col-xs-11">
                                                <label>Nama</label>
                                                <?php echo $mahasiswa['nama_ibu'];?><br/>

                                                <label>Pekerjaan</label>
                                                <?php echo $mahasiswa['pekerjaan_ibu'];?><br/>

                                                <label>Pendidikan Terakhir</label>
                                                <?php echo $mahasiswa['pendidikan_ibu'];?><br/>
                                                
                                                <label>No Telp.</label>
                                                <?php echo $mahasiswa['telp_ibu'];?><br/>                                   
                                        </div>
                                    </div>
                                    <?php if ($mahasiswa['nama_wali']) {?>
                                    <div class="row">
                                        <div class="col-xs-1">
                                            <span class="label label-info">Wali</span>
                                        </div>
                                        <div class="col-xs-11">
                                                <label>Nama</label>
                                                <?php echo $mahasiswa['nama_wali'];?><br/>

                                                <label>Pekerjaan</label>
                                                <?php echo $mahasiswa['pekerjaan_wali'];?><br/>

                                                <label>Pendidikan Terakhir</label>
                                                <?php echo $mahasiswa['pendidikan_wali'];?><br/>
                                                
                                                <label>No Telp.</label>
                                                <?php echo $mahasiswa['telp_wali'];?><br/>                                  
                                        </div>
                                    </div>
                                    <?php }?>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="other">
                                    <p>
                                        <label><i class="fa fa-facebook-square"></i> Facebook</label><br/>
                                        <?php echo $mahasiswa['facebook'];?>
                                    </p>
                                    <p>
                                        <label><i class="fa fa-twitter-square"></i> Twitter</label><br/>
                                        <?php echo $mahasiswa['twitter'];?>
                                    </p>
                                    <p>
                                        <label>Website Pribadi</label><br/>
                                        <?php echo $mahasiswa['website']; ?>
                                    </p>
                                    <p>
                                        <label>Hobi</label><br/>
                                        <?php echo $mahasiswa['hobi']; ?>
                                    </p>
                                    <p>
                                        <label>Cita-cita masa kecil</label><br/>
                                        <?php echo $mahasiswa['cita_cita']; ?>
                                    </p>
                                    <p>
                                        <label>Organisasi yg pernah diikuti</label><br/>
                                        <?php echo $mahasiswa['organisasi']; ?>
                                    </p>
                                </div>
                            </div>
                            <small>Last Update: <?php echo $mahasiswa['last_update']; ?></small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header bg-green">
                            <h2>Akademik <small>Source: Database Akademik Unsrat</small></h2>
                        </div>
                        <div class="body">
<!--                             <p>
                                <label>Pembimbing Akademik</label><br/>
                                <a href="<?php echo site_url('detail/dosen/').$mhsAPI->nipDosenPembimbingAkademik;?>"><?php echo $mhsAPI->dosenPembimbingAkademik;?></a>
                            </p>
                            <p>
                                <label>IPK</label><br/>
                                <?php echo $mhsAPI->akademik->ipk;?>
                            </p>
                            <p>
                                <label>SKS Kontrak</label><br/>
                                <?php echo $mhsAPI->akademik->sksTotal;?>
                            </p>
                            <p>
                                <label>SKS Lulus</label><br/>
                                <?php echo $mhsAPI->akademik->sksLulus;?>
                            </p>
                            <p>
                                <label>Status Kontrak Skripsi</label><br/>
                                <?php echo $mhsAPI->akademik->statusTa;?>
                            </p> -->
                        </div>
                    </div>
                </div>
            </div>