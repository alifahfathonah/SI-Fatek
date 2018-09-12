<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

            <div class="block-header">
                <h2><?php echo $pageTitle;?></h2>
            </div>

            <?php if($this->session->flashdata('message')) {?>  
            <div class="alert alert-dismissable alert-<?php echo $this->session->flashdata('type');?>">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?php echo $this->session->flashdata('message');?>
            </div>
            <?php }?> 
            
            <div class="row clearfix">
                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="header bg-cyan">
                            <h2>Foto Profil</h2>
                            <ul class="header-dropdown m-r--5">
                                <li>
                                    <span data-toggle="modal" data-target="#modalFormPhoto">
                                        <a href="javascript:void(0);" data-toggle="tooltip" title="Update my photo">
                                            <i class="material-icons">edit</i>
                                        </a>
                                    </span>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <img src="<?php echo $dosen['foto'];?>" class="img-responsive img-thumbnail"/>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="header bg-cyan">
                            <h2>
                                <?php echo $dosen['nama'];?>
                                <small>Source: Database Fatek</small>
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
                            <dl class="dl-horizontal">
                                <dt>Biografi singkat</dt>
                                <dd><?php echo $dosen['bio'];?>&nbsp;</dd>
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
                                <dt>Sinta ID</dt>
                                <dd><?php echo $dosen['sintaId'];?>&nbsp;</dd>
                                <dt>Google Scholar ID</dt>
                                <dd><?php echo $dosen['googleId'];?>&nbsp;</dd>                                  
                                <dt>Scopus Author ID</dt>
                                <dd><?php echo $dosen['scopusId'];?>&nbsp;</dd>

                            </dl>
                            <div class="link">
                                <h5>External Link</h5>
                                <div class="list-group">
                                    <a href="<?php echo site_url('public/dosen/id/'. $dosen['nip']);?>" target="_blank" class="list-group-item list-group-item-action">Fatek Digital Card - Public Access</a>
                                    <?php if (isset($dosen['sintaUrl'])) {?> <a href="<?php echo $dosen['sintaUrl'];?>" target="_blank" class="list-group-item list-group-item-action">Science and Technology Index</a><?php }?>
                                    <?php if (isset($dosen['googleUrl'])) {?> <a href="<?php echo $dosen['googleUrl'];?>" target="_blank" class="list-group-item list-group-item-action">Google Scholar</a><?php }?>
                                    <?php if (isset($dosen['scopusUrl'])) {?> <a href="<?php echo $dosen['scopusUrl'];?>" target="_blank" class="list-group-item list-group-item-action">Scopus Author</a><?php }?>
                                </div>
                            </div>
                            <small>Last Update: <?php echo $dosen['tglUpdate']; ?></small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="header bg-green">
                            <h2>
                                <?php echo $dosenAPI->nama;?> <small>Source: Database Kepegawaian Unsrat</small>
                            </h2>
                        </div>
                        <div class="body">
                            <dl class="dl-horizontal">
                                <dt>NIP</dt>
                                <dd><?php echo $dosenAPI->nip; ?>&nbsp;</dd>                                  
                                <dt>NIDN</dt>
                                <dd><?php echo $dosenAPI->nidn; ?>&nbsp;</dd>
                                <dt>Alamat Rumah</dt>
                                <dd><?php echo $dosenAPI->alamat; ?>&nbsp;</dd>
                                <dt>Tempat Tanggal Lahir</dt>
                                <dd><?php echo $dosenAPI->tempatLahir." ".$dosenAPI->tanggalLahir; ?>&nbsp;</dd>                                  
                                <dt>Jenis Kelamin</dt>
                                <dd><?php echo $dosenAPI->jenisKelamin; ?>&nbsp;</dd>
                                <dt>Status Pegawai</dt>
                                <dd><?php echo $dosenAPI->statusPegawai; ?>&nbsp;</dd>
                                <dt>No Karpeg</dt>
                                <dd><?php echo $dosenAPI->noKarpeg; ?>&nbsp;</dd>                                
                                <dt>Tahun Serdos</dt>
                                <dd><?php echo $dosenAPI->tahunSerdos; ?>&nbsp;</dd>
                                <dt>Jabatan Fungsional</dt>
                                <dd><?php echo $dosenAPI->jabatanFungsional; ?>&nbsp;</dd>                                  
                                <dt>Pangkat/Golongan</dt>
                                <dd><?php echo $dosenAPI->pangkatGolongan; ?>&nbsp;</dd>                                  
                                <dt>Agama</dt>
                                <dd><?php echo $dosenAPI->agama; ?>&nbsp;</dd>
                                <dt>Status Nikah</dt>
                                <dd><?php echo $dosenAPI->statusNikah; ?>&nbsp;</dd>                                  
                                <dt>No Hp</dt>
                                <dd><?php echo $dosenAPI->noHp; ?>&nbsp;</dd>
                                <dt>Email</dt>
                                <dd><?php echo $dosenAPI->email; ?>&nbsp;</dd>
                            </dl>
                            <h5>Riwayat Pendidikan</h5>
                            <table id="tabel-publikasi" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Tahun</th>
                                        <th>Bidang Ilmu</th>
                                        <th>Perguruan Tinggi</th>
                                    </tr>
                                </thead>
                                <tbody> 
                                    <?php foreach($dosenAPI->edu as $list) { ?>
                                    <tr>
                                        <td><?php echo $list->tahunLulus;?></td>
                                        <td><?php echo $list->jenjang." ".$list->bidangIlmu;?></td>
                                        <td><?php echo $list->pt." ".$list->lokasi;?></td>
                                    </tr> 
                                    <?php }?>                           
                                </tbody>
                            </table>
                            <small>Last Update: <?php echo $dosenAPI->lastUpdate; ?></small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modals utk menampilkan form update profile -->
            <div class="modal fade" id="modalFormProfile" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Update Profile Dosen</h4>
                        </div>

                        <div class="modal-body">
                            <?php echo form_open(site_url('dosen/profile/update'));?>
                                <input name="dosenId" type="hidden" value="<?php echo $dosen['dosenId']; ?>">

                                <div class="form-group">
                                    <label>Nama Lengkap</label>
                                    <div class="form-line">
                                        <input name="nama" class="form-control" value="<?php echo $dosen['nama'];?>" required>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label>Office Address</label>
                                    <div class="form-line">
                                        <input name="alamat" class="form-control" value="<?php echo $dosen['alamat'];?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <label>Email</label>
                                            <div class="form-line">
                                                <input name="email" type="email" class="form-control" value="<?php echo $dosen['email'];?>">
                                            </div>
                                        </div>
                                        <div class="col-xs-6">
                                            <label>Nomor HP</label>
                                            <div class="form-line">
                                                <input name="hp" type="number" class="form-control" value="<?php echo $dosen['hp'];?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <label>Sinta ID</label>
                                            <div class="form-line">
                                                <input name="sintaId" class="form-control" value="<?php echo $dosen['sintaId'];?>">
                                            </div>
                                        </div>
                                        <div class="col-xs-4">
                                            <label>Google Scholar ID</label>
                                            <div class="form-line">
                                                <input name="googleId" class="form-control" value="<?php echo $dosen['googleId'];?>">
                                            </div>
                                        </div>
                                        <div class="col-xs-4">
                                            <label>Scopus Author ID</label>
                                            <div class="form-line">
                                                <input name="scopusId" class="form-control" value="<?php echo $dosen['scopusId'];?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Research Field</label>
                                    <div class="form-line">
                                        <input name="interest" class="form-control" value="<?php echo $dosen['interest'];?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Biografi singkat</label>
                                    <div class="form-line">
                                        <textarea rows="4" class="form-control no-resize" placeholder="Biografi singkat tentang anda" name="bio"><?php echo $dosen['bio'];?></textarea>
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

            <!-- Modals utk menampilkan form update foto -->
            <div class="modal fade" id="modalFormPhoto" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Update Foto Profil</h4>
                        </div>

                        <div class="modal-body">

                            <?php echo form_open_multipart(site_url('dosen/profile/change-pic'));?>
                                <input name="dosenId" type="hidden" value="<?php echo $dosen['dosenId']; ?>">
                                
                                <div class="form-group">
                                    <span class="form-control-static">
                                        <img src="<?php echo $dosen['foto']."?".time();?>" class="img-responsive img-thumbnail"/>
                                    </span>
                                </div>

                                <div class="form-group">
                                    <label>Foto profil baru</label>
                                    <div class="form-line">
                                        <input name="fotodosen" type="file" required>
                                    </div>
                                </div>

                                <div class="alert alert-info">
                                    <span class="glyphicon glyphicon-info-sign"></span>
                                    Spesifikasi foto: Filetype=jpg,jpeg.
                                </div>
                                
                                <button type="submit" class="btn btn-primary btn-lg m-t-15 waves-effect">UPLOAD</button>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END#  Modals utk menampilkan form update foto --> 