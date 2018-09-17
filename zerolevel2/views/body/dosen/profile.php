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
                                <dt>Sinta ID</dt>
                                <dd><?php echo $dosen['sintaId'];?>&nbsp;</dd>
                                <dt>Google Scholar ID</dt>
                                <dd><?php echo $dosen['googleId'];?>&nbsp;</dd>                                  
                                <dt>Scopus Author ID</dt>
                                <dd><?php echo $dosen['scopusId'];?>&nbsp;</dd>

                            </dl>

                            <div class="biografi">
                                <div class="well">
                                    <small><?php echo $dosen['bio'];?></small>
                                </div>
                            </div>

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
                <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">

                    <div class="card">
                        <div class="header bg-blue">
                            <h2>
                                <?php echo $dosenSiaAPI->nama;?> <small>Source: Database Akademik Unsrat</small>
                            </h2>
                        </div>
                        <div class="body">
                            <dl class="dl-horizontal">
                                <dt>NIP</dt>
                                <dd><?php echo $dosenSiaAPI->nip; ?>&nbsp;</dd>                                  
                                <dt>NIDN</dt>
                                <dd><?php echo $dosenSiaAPI->nidn; ?>&nbsp;</dd>
                                <dt>Fakultas</dt>
                                <dd><?php echo $dosenSiaAPI->fakultas; ?>&nbsp;</dd>
                                <dt>Jurusan</dt>
                                <dd><?php echo $dosenSiaAPI->jurusan; ?>&nbsp;</dd>                              
                                <dt>Prodi</dt>
                                <dd><?php echo $dosenSiaAPI->prodi; ?>&nbsp;</dd>
                                <dt>Jenis Pegawai</dt>
                                <dd><?php echo $dosenSiaAPI->jenisPegawai; ?>&nbsp;</dd>
                                <dt>Status Ikatan Kerja</dt>
                                <dd><?php echo $dosenSiaAPI->statusIkatanKerja; ?>&nbsp;</dd>                              
                                <dt>Status Aktifitas</dt>
                                <dd><?php echo $dosenSiaAPI->statusAktifitas; ?>&nbsp;</dd>
                                <dt>Status Pegawai</dt>
                                <dd><?php echo $dosenSiaAPI->statusPegawai; ?>&nbsp;</dd>                                
                            </dl>
                            <small>Last Update: <?php echo $dosenSiaAPI->lastUpdate; ?></small>
                        </div>
                    </div>

                    <div class="card">
                        <div class="header bg-green">
                            <h2>
                                <?php echo $dosenSdmAPI->nama;?> <small>Source: Database Kepegawaian Unsrat</small>
                            </h2>
                        </div>
                        <div class="body">
                            <dl class="dl-horizontal">
                                <dt>NIP</dt>
                                <dd><?php echo $dosenSdmAPI->nip; ?>&nbsp;</dd>                                  
                                <dt>Kode Lain</dt>
                                <dd><?php echo $dosenSdmAPI->kodeLain; ?>&nbsp;</dd>
                                <dt>Alamat Rumah</dt>
                                <dd><?php echo $dosenSdmAPI->alamat; ?>&nbsp;</dd>
                                <dt>Tempat Tanggal Lahir</dt>
                                <dd><?php echo $dosenSdmAPI->tempatLahir." ".$dosenSdmAPI->tanggalLahir; ?>&nbsp;</dd>                                  
                                <dt>Jenis Kelamin</dt>
                                <dd><?php echo $dosenSdmAPI->jenisKelamin; ?>&nbsp;</dd>
                                <dt>Status Pegawai</dt>
                                <dd><?php echo $dosenSdmAPI->statusPegawai; ?>&nbsp;</dd>
                                <dt>No Karpeg</dt>
                                <dd><?php echo $dosenSdmAPI->noKarpeg; ?>&nbsp;</dd>                                
                                <dt>Tahun Serdos</dt>
                                <dd><?php echo $dosenSdmAPI->tahunSerdos; ?>&nbsp;</dd>
                                <dt>Jabatan Fungsional</dt>
                                <dd><?php echo $dosenSdmAPI->jabatanFungsional; ?>&nbsp;</dd>                                  
                                <dt>Pangkat/Golongan</dt>
                                <dd><?php echo $dosenSdmAPI->pangkatGolongan; ?>&nbsp;</dd>                                  
                                <dt>Agama</dt>
                                <dd><?php echo $dosenSdmAPI->agama; ?>&nbsp;</dd>
                                <dt>Status Nikah</dt>
                                <dd><?php echo $dosenSdmAPI->statusNikah; ?>&nbsp;</dd>                                  
                                <dt>No Hp</dt>
                                <dd><?php echo $dosenSdmAPI->noHp; ?>&nbsp;</dd>
                                <dt>Email</dt>
                                <dd><?php echo $dosenSdmAPI->email; ?>&nbsp;</dd>
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
                                    <?php foreach($dosenSdmAPI->edu as $list) { ?>
                                    <tr>
                                        <td><?php echo $list->tahunLulus;?></td>
                                        <td><?php echo $list->jenjang." ".$list->bidangIlmu;?></td>
                                        <td><?php echo $list->pt." ".$list->lokasi;?></td>
                                    </tr> 
                                    <?php }?>                           
                                </tbody>
                            </table>
                            <small>Last Update: <?php echo $dosenSdmAPI->lastUpdate; ?></small>
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
                                    <label class="form-label">Nama Lengkap</label>
                                    <div class="form-line">
                                        <input type="text" name="nama" class="form-control" value="<?php echo $dosen['nama'];?>" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <label class="form-label">Nip</label>
                                            <div class="form-line">
                                                <input type="number" name="nip" class="form-control" value="<?php echo $dosen['nip'];?>" required>
                                            </div>
                                        </div>
                                        <div class="col-xs-6">
                                            <label class="form-label">NIDN</label>
                                            <div class="form-line">
                                                <input type="number" name="nidn" class="form-control" value="<?php echo $dosen['nidn'];?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <label class="form-label">Jabatan</label>
                                            <div class="form-line">
                                                <input type="text" name="jabatan" class="form-control" value="<?php echo $dosen['jabatan'];?>">
                                            </div>
                                        </div>
                                        <div class="col-xs-6">
                                            <label class="form-label">Alamat Kantor</label>
                                            <div class="form-line">
                                                <input type="text" name="alamat" class="form-control" value="<?php echo $dosen['alamat'];?>" placeholder="Nama gedung/ruangan/studio/lab/unit tempat anda berkantor" >
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <label class="form-label">Email</label>
                                            <div class="form-line">
                                                <input type="email" name="email" class="form-control" value="<?php echo $dosen['email'];?>">
                                            </div>
                                        </div>
                                        <div class="col-xs-6">
                                            <label class="form-label">Nomor HP</label>
                                            <div class="form-line">
                                                <input type="number" name="hp" class="form-control" value="<?php echo $dosen['hp'];?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <label class="form-label">Sinta ID</label>
                                            <div class="form-line">
                                                <input type="text" name="sintaId" class="form-control" value="<?php echo $dosen['sintaId'];?>">
                                            </div>
                                        </div>
                                        <div class="col-xs-4">
                                            <label class="form-label">Google Scholar ID</label>
                                            <div class="form-line">
                                                <input type="text" name="googleId" class="form-control" value="<?php echo $dosen['googleId'];?>">
                                            </div>
                                        </div>
                                        <div class="col-xs-4">
                                            <label class="form-label">Scopus Author ID</label>
                                            <div class="form-line">
                                                <input type="text" name="scopusId" class="form-control" value="<?php echo $dosen['scopusId'];?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Research Field</label>
                                    <div class="form-line">
                                        <input type="text" name="interest" class="form-control" value="<?php echo $dosen['interest'];?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Introduced yourself</label>
                                    <div class="form-line">
                                        <textarea rows="4" class="form-control no-resize" placeholder="About you. Summary of yourself. Who are you?" name="bio"><?php echo $dosen['bio'];?></textarea>
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