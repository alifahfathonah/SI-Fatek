<?php defined('BASEPATH') OR exit('No direct script access allowed')?>

            <div class="block-header">
                <h2><?=$pageTitle?></h2>
            </div>

            <?php if($this->session->flashdata('message')) {?>  
            <div class="alert alert-dismissable alert-<?=$this->session->flashdata('type')?>">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?=$this->session->flashdata('message')?>
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
                            <img src="<?=$dosen['foto']?>" class="img-responsive img-thumbnail"/>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="header bg-cyan">
                            <h2>
                                <?=$dosen['nama']?>
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
                                <dt>Departement</dt>
                                <dd><?=$dosen['jurusan']?> / <?=$dosen['prodi']?></dd>  
                                <dt>Position/Vocation</dt>
                                <dd><?=$dosen['jabatan']?>&nbsp;</dd>
                                <dt>Office</dt>
                                <dd><?=$dosen['alamat']?>&nbsp;</dd>                                  
                                <dt>Research Field</dt>
                                <dd><?=$dosen['interest']?>&nbsp;</dd> 
                                <dt>Mobile Phone</dt>
                                <dd><?=$dosen['hp']?>&nbsp;</dd>
                                <dt>Email</dt>
                                <dd><?=$dosen['email']?>&nbsp;</dd>                                   
                                <dt>Sinta ID</dt>
                                <dd><?=$dosen['sintaId']?>&nbsp;</dd>
                                <dt>Google Scholar ID</dt>
                                <dd><?=$dosen['googleId']?>&nbsp;</dd>                             
                                <dt>Scopus Author ID</dt>
                                <dd><?=$dosen['scopusId']?>&nbsp;</dd>

                            </dl>

                            <div class="biografi">
                                <div class="well">
                                    <small><?=$dosen['bio']?></small>
                                </div>
                            </div>

                            <div class="link">
                                <h5>External Link</h5>
                                <div class="list-group">
                                    <a href="<?=site_url('public/dosen/id/'. $dosen['nip'])?>" target="_blank" class="list-group-item list-group-item-action">Fatek Digital Card</a>
                                    <?php if (isset($dosen['sintaUrl'])): ?> <a href="<?=$dosen['sintaUrl']?>" target="_blank" class="list-group-item list-group-item-action">Science and Technology Index</a><?php endif;?>
                                    <?php if (isset($dosen['googleUrl'])): ?> <a href="<?=$dosen['googleUrl']?>" target="_blank" class="list-group-item list-group-item-action">Google Scholar</a><?php endif;?>
                                    <?php if (isset($dosen['scopusUrl'])): ?> <a href="<?=$dosen['scopusUrl']?>" target="_blank" class="list-group-item list-group-item-action">Scopus Author</a><?php endif;?>
                                </div>
                            </div>
                            <small>Last Update: <?=$dosen['tglUpdate']?></small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">

                    <div class="card">
                        <div class="header bg-blue">
                            <h2>
                                <?=$dosenSiaAPI->nama?> <small>Source: Database Akademik Unsrat</small>
                            </h2>
                        </div>
                        <div class="body">
                            <dl class="dl-horizontal">
                                <dt>NIP</dt>
                                <dd><?=$dosenSiaAPI->nip?>&nbsp;</dd>                                  
                                <dt>NIDN</dt>
                                <dd><?=$dosenSiaAPI->nidn?>&nbsp;</dd>
                                <dt>Fakultas</dt>
                                <dd><?=$dosenSiaAPI->fakultas?>&nbsp;</dd>
                                <dt>Jurusan</dt>
                                <dd><?=$dosenSiaAPI->jurusan?>&nbsp;</dd>                              
                                <dt>Prodi</dt>
                                <dd><?=$dosenSiaAPI->prodi?>&nbsp;</dd>
                                <dt>Jenis Pegawai</dt>
                                <dd><?=$dosenSiaAPI->jenisPegawai?>&nbsp;</dd>
                                <dt>Status Ikatan Kerja</dt>
                                <dd><?=$dosenSiaAPI->statusIkatanKerja?>&nbsp;</dd>                              
                                <dt>Status Aktifitas</dt>
                                <dd><?=$dosenSiaAPI->statusAktifitas?>&nbsp;</dd>
                                <dt>Status Pegawai</dt>
                                <dd><?=$dosenSiaAPI->statusPegawai?>&nbsp;</dd>                                
                            </dl>
                            <small>Last Update: <?=$dosenSiaAPI->lastUpdate?></small>
                        </div>
                    </div>

                    <div class="card">
                        <div class="header bg-green">
                            <h2>
                                <?=$dosenSdmAPI->nama?> <small>Source: Database Kepegawaian Unsrat</small>
                            </h2>
                        </div>
                        <div class="body">
                            <dl class="dl-horizontal">
                                <dt>NIP</dt>
                                <dd><?=$dosenSdmAPI->nip?>&nbsp;</dd>                                  
                                <dt>Kode Lain</dt>
                                <dd><?=$dosenSdmAPI->kodeLain?>&nbsp;</dd>
                                <dt>Alamat Rumah</dt>
                                <dd><?=$dosenSdmAPI->alamat?>&nbsp;</dd>
                                <dt>Tempat Tanggal Lahir</dt>
                                <dd><?=$dosenSdmAPI->tempatLahir." ".$dosenSdmAPI->tanggalLahir?>&nbsp;</dd>                                  
                                <dt>Jenis Kelamin</dt>
                                <dd><?=$dosenSdmAPI->jenisKelamin?>&nbsp;</dd>
                                <dt>Status Pegawai</dt>
                                <dd><?=$dosenSdmAPI->statusPegawai?>&nbsp;</dd>
                                <dt>No Karpeg</dt>
                                <dd><?=$dosenSdmAPI->noKarpeg?>&nbsp;</dd>                                
                                <dt>Tahun Serdos</dt>
                                <dd><?=$dosenSdmAPI->tahunSerdos?>&nbsp;</dd>
                                <dt>Jabatan Fungsional</dt>
                                <dd><?=$dosenSdmAPI->jabatanFungsional?>&nbsp;</dd>                                  
                                <dt>Pangkat/Golongan</dt>
                                <dd><?=$dosenSdmAPI->pangkatGolongan?>&nbsp;</dd>                                  
                                <dt>Agama</dt>
                                <dd><?=$dosenSdmAPI->agama?>&nbsp;</dd>
                                <dt>Status Nikah</dt>
                                <dd><?=$dosenSdmAPI->statusNikah?>&nbsp;</dd>                                  
                                <dt>No Hp</dt>
                                <dd><?=$dosenSdmAPI->noHp?>&nbsp;</dd>
                                <dt>Email</dt>
                                <dd><?=$dosenSdmAPI->email?>&nbsp;</dd>
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
                                        <td><?=$list->tahunLulus?></td>
                                        <td><?=$list->jenjang." ".$list->bidangIlmu?></td>
                                        <td><?=$list->pt." ".$list->lokasi?></td>
                                    </tr> 
                                    <?php }?>                           
                                </tbody>
                            </table>
                            <small>Last Update: <?=$dosenSdmAPI->lastUpdate?></small>
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
                            <?=form_open(site_url('dosen/profile/update'))?>
                                <input name="dosenId" type="hidden" value="<?=$dosen['dosenId']?>">

                                <div class="form-group">
                                    <label class="form-label">Name </label>
                                    <small>(Your name to be display in public)</small>
                                    <div class="form-line">
                                        <input type="text" name="nama" class="form-control" value="<?=$dosen['nama']?>" required>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="form-label">Position/Vocation </label>
                                    <small>(Your position/vocation in university/faculty/departement/lab/unit.)</small>
                                    <div class="form-line">
                                        <input type="text" name="jabatan" class="form-control" value="<?=$dosen['jabatan']?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Office </label>
                                    <small>(Where to find you at the university. Describe the name/number of the building/room/studio/lab/unit, where other can find you)</small>
                                    <div class="form-line">
                                        <input type="text" name="alamat" class="form-control" value="<?=$dosen['alamat']?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Research Field </label>
                                    <small>(Multiple field separated by commas)</small>
                                    <div class="form-line">
                                        <input type="text" name="interest" class="form-control" value="<?=$dosen['interest']?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Summary of yourself </label>
                                    <small>(The short introduction about yourself. Who are you that people might interested)</small>
                                    <div class="form-line">
                                        <textarea rows="4" class="form-control no-resize" name="bio"><?=$dosen['bio']?></textarea>
                                    </div>
                                </div>                                

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <label class="form-label">Email</label>
                                            <div class="form-line">
                                                <input type="email" name="email" class="form-control" value="<?=$dosen['email']?>">
                                            </div>
                                        </div>
                                        <div class="col-xs-6">
                                            <label class="form-label">Mobile Phone</label>
                                            <div class="form-line">
                                                <input type="number" name="hp" class="form-control" value="<?=$dosen['hp']?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <label class="form-label">Sinta ID</label>
                                            <div class="form-line">
                                                <input type="text" name="sintaId" class="form-control" value="<?=$dosen['sintaId']?>">
                                            </div>
                                        </div>
                                        <div class="col-xs-4">
                                            <label class="form-label">Google Scholar ID</label>
                                            <div class="form-line">
                                                <input type="text" name="googleId" class="form-control" value="<?=$dosen['googleId']?>">
                                            </div>
                                        </div>
                                        <div class="col-xs-4">
                                            <label class="form-label">Scopus Author ID</label>
                                            <div class="form-line">
                                                <input type="text" name="scopusId" class="form-control" value="<?=$dosen['scopusId']?>">
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

            <!-- Modals utk menampilkan form update foto -->
            <div class="modal fade" id="modalFormPhoto" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Update Foto Profil</h4>
                        </div>

                        <div class="modal-body">

                            <?=form_open_multipart(site_url('dosen/profile/change-pic'))?>
                                <input name="dosenId" type="hidden" value="<?=$dosen['dosenId']?>">
                                
                                <div class="form-group">
                                    <span class="form-control-static">
                                        <img src="<?=$dosen['foto']."?".time()?>" class="img-responsive img-thumbnail"/>
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