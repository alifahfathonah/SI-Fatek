<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

            <div class="block-header">
                <h2><?php echo $pageTitle;?></h2>
            </div>

            <?php if($this->session->flashdata('message')) {?>  
            <div class="alert alert-dismissable alert-<?=$this->session->flashdata('type')?>">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?=$this->session->flashdata('message')?>
            </div>
            <?php }?> 
           
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
                            <ul class="header-dropdown m-r--5">
                                <li>
                                    <span data-toggle="modal" data-target="#modalFormProfile">
                                        <a href="javascript:void(0);" data-toggle="tooltip" title="Update my profile">
                                            <i class="material-icons">edit</i>
                                        </a>
                                    </span>
                                </li>
                            </ul>
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
                            <p>
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
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modals utk menampilkan form update profile -->
            <div class="modal fade" id="modalFormProfile" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Update My Profile</h4>
                        </div>

                        <div class="modal-body">
                            <?=form_open(site_url('mahasiswa/profile/edit'))?>
                            <input name="nim" type="hidden" value="<?php echo $mahasiswa['nim']; ?>">

                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs tab-nav-right" role="tablist">
                                <li role="presentation" class="active"><a href="#home-modal" data-toggle="tab">DATA UTAMA</a></li>
                                <li role="presentation"><a href="#address-modal" data-toggle="tab">DATA ALAMAT</a></li>
                                <li role="presentation"><a href="#family-modal" data-toggle="tab">DATA KELUARGA</a></li>
                                <li role="presentation"><a href="#other-modal" data-toggle="tab">DATA LAIN</a></li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="home-modal">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Jalur Masuk*</label>
                                                <div class="form-line">
                                                    <select class="form-control show-tick" data-live-search="true" name="jalur_masuk" required>
                                                        <option value="" <?php if ($mahasiswa['jalur_masuk'] == "") echo "selected";?>>Pilih</option>
                                                        <option value="Jalur Undangan" <?php if ($mahasiswa['jalur_masuk'] == "Jalur Undangan") echo "selected";?>>SNMPTN / Jalur Undangan</option>
                                                        <option value="SBMPTN" <?php if ($mahasiswa['jalur_masuk'] == "SBMPTN") echo "selected";?>>SBMPTN</option>
                                                        <option value="Tumou Tou" <?php if ($mahasiswa['jalur_masuk'] == "Tumou Tou") echo "selected";?>>Tumou Tou</option>
                                                        <option value="Sumikolah" <?php if ($mahasiswa['jalur_masuk'] == "Sumikolah") echo "selected";?>>Sumikolah</option>
                                                        <option value="Kemitraan" <?php if ($mahasiswa['jalur_masuk'] == "Kemitraan") echo "selected";?>>Kemitraan</option>
                                                    </select>
                                                </div>
                                                
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Beasiswa*</label>
                                                <div class="form-line">
                                                    <select class="form-control show-tick" data-live-search="true" name="beasiswa" required>
                                                        <option value="" <?php if ($mahasiswa['beasiswa'] == "") echo "selected";?>>Tanpa Beasiswa</option>
                                                        <option value="Bidik Misi" <?php if ($mahasiswa['beasiswa'] == "Bidik Misi") echo "selected";?>>Bidik Misi</option>
                                                        <option value="Mapalus" <?php if ($mahasiswa['beasiswa'] == "Mapalus") echo "selected";?>>Mapalus</option>
                                                        <option value="PPA" <?php if ($mahasiswa['beasiswa'] == "PPA") echo "selected";?>>PPA</option>
                                                        <option value="Lainnya" <?php if ($mahasiswa['beasiswa'] == "Lainnya") echo "selected";?>>Lainnya</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Tempat Lahir*</label>
                                                <div class="form-line">
                                                    <input name="tempat_lahir" class="form-control" value="<?php echo $mahasiswa['tempat_lahir'];?>" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Email*</label>
                                                <div class="form-line">
                                                    <input name="email" class="form-control" type="email" value="<?php echo $mahasiswa['email'];?>" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>No Telepon/Handphone*</label>
                                                <div class="form-line">
                                                    <input name="nohp" class="form-control" value="<?php echo $mahasiswa['nohp'];?>" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                
                                    <div class="form-group">
                                        <label>Status Pernikahan</label>
                                        <input name="status_nikah" type="radio" id="radio_1" value="Belum Menikah" <?php if ($mahasiswa['status_nikah']=='Belum Menikah') echo "checked";?>/>
                                        <label for="radio_1">Belum Menikah</label>
                                        <input name="status_nikah" type="radio" id="radio_2" value="Sudah Menikah" <?php if ($mahasiswa['status_nikah']=='Sudah Menikah') echo "checked";?>/>
                                        <label for="radio_2">Sudah Menikah</label>
                                    </div>

                                    <label>Riwayat Pendidikan Formal*</label>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon">SD</span>
                                            <div class="form-line">
                                                <input name="sd" type="text" class="form-control" value="<?php echo $mahasiswa['sd'];?>" required>
                                            </div>
                                        </div>


                                        <div class="input-group">
                                            <span class="input-group-addon">SMP</span>
                                            <div class="form-line">
                                                <input name="smp" type="text" class="form-control" value="<?php echo $mahasiswa['smp'];?>" required>
                                            </div>
                                        </div>

                                        <div class="input-group">
                                            <span class="input-group-addon">SMA</span>
                                            <div class="form-line">
                                                <input name="sma" type="text" class="form-control" value="<?php echo $mahasiswa['sma'];?>" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="address-modal">
                                    <div class="form-group">
                                        <label>Alamat Rumah (Asal)</label>
                                        <div class="form-line">
                                            <input name="alamat" id="alamat" class="form-control" value="<?php echo $mahasiswa['alamat'];?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Alamat Orang Tua</label>
                                        <div class="form-line">
                                            <input name="alamat_ortu" class="form-control" value="<?php echo $mahasiswa['alamat_ortu'];?>">
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <label>Alamat Tempat Tinggal (Di Manado)</label>
                                        <div class="form-line">
                                            <input name="alamat_manado" id="alamatManado" class="form-control" value="<?php echo $mahasiswa['alamat_manado'];?>">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Status Tempat Tinggal (Di Manado)</label>
                                        <input name="status_rumah" type="radio" id="radio_3" value="kos" <?php if ($mahasiswa['status_rumah']=='kos') echo "checked";?>/>
                                        <label for="radio_3">Kos</label>
                                        <input name="status_rumah" type="radio" id="radio_4" value="rumah kontrak" <?php if ($mahasiswa['status_rumah']=='rumah kontrak') echo "checked";?>/>
                                        <label for="radio_4">Kontrak</label>
                                        <input name="status_rumah" type="radio" id="radio_5" value="rumah saudara" <?php if ($mahasiswa['status_rumah']=='rumah saudara') echo "checked";?>/>
                                        <label for="radio_5">Rumah Saudara</label>
                                        <input name="status_rumah" type="radio" id="radio_6" value="dengan ortu" <?php if ($mahasiswa['status_rumah']=='dengan ortu') echo "checked";?>/>
                                        <label for="radio_6">Tinggal dengan Orang Tua</label>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Jarak tempat tinggal di Manado dari Kampus</label>

                                                <div class="input-group">
                                                    <div class="form-line">
                                                        <input name="jarak" class="form-control" value="<?php echo $mahasiswa['jarak'];?>">
                                                    </div>
                                                    <span class="input-group-addon">Km</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Transportasi yang digunakan</label>
                                        <input name="transportasi" type="radio" id="radio_7" value="mobil" <?php if ($mahasiswa['transportasi']=='mobil') echo "checked";?>/>
                                        <label for="radio_7">Mobil</label>
                                        <input name="transportasi" type="radio" id="radio_8" value="motor" <?php if ($mahasiswa['transportasi']=='motor') echo "checked";?>/>
                                        <label for="radio_8">Motor</label>
                                        <input name="transportasi" type="radio" id="radio_9" value="angkutan umum" <?php if ($mahasiswa['transportasi']=='angkutan umum') echo "checked";?>/>
                                        <label for="radio_9">Angkutan Umum</label>
                                        <input name="transportasi" type="radio" id="radio_10" value="jalan kaki" <?php if ($mahasiswa['transportasi']=='jalan kaki') echo "checked";?>/>
                                        <label for="radio_10">Jalan Kaki</label>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="family-modal">

                                    <div class="row clearfix">
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                            <div class="form-group">
                                                <label>Anak ke</label>
                                                <div class="form-line">
                                                    <input name="anak_ke" class="form-control" value="<?php echo $mahasiswa['anak_ke'];?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                            <div class="form-group">
                                                <label>dari</label>
                                                <div class="form-line">
                                                    <input name="bersaudara" class="form-control" value="<?php echo $mahasiswa['bersaudara'];?>">
                                                </div>
                                                <label>bersaudara</label>
                                            </div>
                                        </div>
                                    </div>
                                   
                                    <div class="form-group">
                                        <label>Nama Ayah</label>
                                        <div class="form-line">
                                            <input name="nama_ayah" class="form-control" value="<?php echo $mahasiswa['nama_ayah'];?>">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Pekerjaan Ayah</label>
                                                <div class="form-line">
                                                    <input name="pekerjaan_ayah" class="form-control" value="<?php echo $mahasiswa['pekerjaan_ayah'];?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Pendidikan Terakhir Ayah</label>
                                                <div class="form-line">
                                                    <select class="form-control show-tick" data-live-search="true" name="pendidikan_ayah">
                                                        <option value="" >Pilih</option>
                                                        <option value="SD" <?php if ($mahasiswa['pendidikan_ayah'] == 'SD') echo "selected";?>>SD</option>
                                                        <option value="SMP" <?php if ($mahasiswa['pendidikan_ayah'] == 'SMP') echo "selected";?>>SMP</option>
                                                        <option value="SMA" <?php if ($mahasiswa['pendidikan_ayah'] == 'SMA') echo "selected";?>>SMA</option>
                                                        <option value="D3" <?php if ($mahasiswa['pendidikan_ayah'] == 'D3') echo "selected";?>>D3</option>
                                                        <option value="S1" <?php if ($mahasiswa['pendidikan_ayah'] == 'S1') echo "selected";?>>S1</option>
                                                        <option value="S2" <?php if ($mahasiswa['pendidikan_ayah'] == 'S2') echo "selected";?>>S2</option>
                                                        <option value="S3" <?php if ($mahasiswa['pendidikan_ayah'] == 'S3') echo "selected";?>>S3</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>No Telepon / HP Ayah</label>
                                                <div class="form-line">
                                                    <input name="telp_ayah" class="form-control" value="<?php echo $mahasiswa['telp_ayah'];?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr/>
                                    <div class="form-group">
                                        <label>Nama Ibu</label>
                                        <div class="form-line">
                                            <input name="nama_ibu" class="form-control" value="<?php echo $mahasiswa['nama_ibu'];?>">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Pekerjaan Ibu</label>
                                                <div class="form-line">
                                                    <input name="pekerjaan_ibu" class="form-control" value="<?php echo $mahasiswa['pekerjaan_ibu'];?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Pendidikan Terakhir Ibu</label>
                                                <div class="form-line">
                                                    <select class="form-control show-tick" data-live-search="true" name="pendidikan_ibu">
                                                        <option value="" >Pilih</option>
                                                        <option value="SD" <?php if ($mahasiswa['pendidikan_ibu'] == 'SD') echo "selected";?>>SD</option>
                                                        <option value="SMP" <?php if ($mahasiswa['pendidikan_ibu'] == 'SMP') echo "selected";?>>SMP</option>
                                                        <option value="SMA" <?php if ($mahasiswa['pendidikan_ibu'] == 'SMA') echo "selected";?>>SMA</option>
                                                        <option value="D3" <?php if ($mahasiswa['pendidikan_ibu'] == 'D3') echo "selected";?>>D3</option>
                                                        <option value="S1" <?php if ($mahasiswa['pendidikan_ibu'] == 'S1') echo "selected";?>>S1</option>
                                                        <option value="S2" <?php if ($mahasiswa['pendidikan_ibu'] == 'S2') echo "selected";?>>S2</option>
                                                        <option value="S3" <?php if ($mahasiswa['pendidikan_ibu'] == 'S3') echo "selected";?>>S3</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>No Telepon / HP Ibu</label>
                                                <div class="form-line">
                                                    <input name="telp_ibu" class="form-control" value="<?php echo $mahasiswa['telp_ibu'];?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr/>
                                    <div class="form-group">
                                        <label>Nama Wali</label>
                                        <div class="form-line">
                                            <input name="nama_wali" class="form-control" value="<?php echo $mahasiswa['nama_wali'];?>">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Pekerjaan Wali</label>
                                                <div class="form-line">
                                                    <input name="pekerjaan_wali" class="form-control" value="<?php echo $mahasiswa['pekerjaan_wali'];?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Pendidikan Terakhir Wali</label>
                                                <div class="form-line">
                                                    <select class="form-control show-tick" data-live-search="true" name="pendidikan_wali">
                                                        <option value="" >Pilih</option>
                                                        <option value="SD" <?php if ($mahasiswa['pendidikan_wali'] == 'SD') echo "selected";?>>SD</option>
                                                        <option value="SMP" <?php if ($mahasiswa['pendidikan_wali'] == 'SMP') echo "selected";?>>SMP</option>
                                                        <option value="SMA" <?php if ($mahasiswa['pendidikan_wali'] == 'SMA') echo "selected";?>>SMA</option>
                                                        <option value="D3" <?php if ($mahasiswa['pendidikan_wali'] == 'D3') echo "selected";?>>D3</option>
                                                        <option value="S1" <?php if ($mahasiswa['pendidikan_wali'] == 'S1') echo "selected";?>>S1</option>
                                                        <option value="S2" <?php if ($mahasiswa['pendidikan_wali'] == 'S2') echo "selected";?>>S2</option>
                                                        <option value="S3" <?php if ($mahasiswa['pendidikan_wali'] == 'S3') echo "selected";?>>S3</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>No Telepon / HP Wali</label>
                                                <div class="form-line">
                                                    <input name="telp_wali" class="form-control" value="<?php echo $mahasiswa['telp_wali'];?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="other-modal">
                                    <label>Akun Media Sosial</label>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon"><i class="fa fa-facebook-square"></i></span>
                                        <div class="form-line">
                                            <input name="facebook" type="text" class="form-control" value="<?php echo $mahasiswa['facebook'];?>" placeholder="Facebook">
                                        </div>
                                    </div>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon"><i class="fa fa-twitter-square"></i></span>
                                        <div class="form-line">
                                            <input name="twitter" type="text" class="form-control" value="<?php echo $mahasiswa['twitter'];?>" placeholder="@Twitter">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Website Pribadi</label>
                                        <div class="form-line">
                                            <input name="website" type="text" class="form-control" value="<?php echo $mahasiswa['website'];?>">
                                        </div>
                                    </div>      

                                    <div class="form-group">
                                        <label>Hobi</label>
                                        <div class="form-line">
                                            <input name="hobi" type="text" class="form-control" value="<?php echo $mahasiswa['hobi'];?>">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Cita-cita Masa Kecil</label>
                                        <div class="form-line">
                                            <input name="cita_cita" type="text" class="form-control" value="<?php echo $mahasiswa['cita_cita'];?>">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Organisasi yg pernah diikuti</label>
                                        <div class="form-line">
                                            <input name="organisasi" type="text" class="form-control" value="<?php echo $mahasiswa['organisasi'];?>">
                                        </div>
                                    </div>
                                </div>
                            </div>

                                <button type="submit" class="btn btn-primary btn-lg m-t-15 waves-effect">UPDATE</button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END#  Modals utk menampilkan form update profile -->