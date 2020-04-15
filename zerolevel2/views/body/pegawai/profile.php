<?php defined('BASEPATH') OR exit('No direct script access allowed')?>

            <div class="block-header">
                <h1><?php echo $pageTitle;?></h1>
            </div>

            <?php if($this->session->flashdata('message')) {?>  
            <div class="alert alert-dismissable alert-<?=$this->session->flashdata('type')?>">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?=$this->session->flashdata('message')?>
            </div>
            <?php }?> 
            
            <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
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
                            <img src="<?=$pegawai['foto']?>" class="img-responsive img-thumbnail"/>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="header bg-cyan">
                            <h2>
                                <?=$pegawai['nama']?>
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
                                <dt>Tanggal Lahir</dt>
                                <dd><?=$pegawai['tglLahir2']?></dd>  
                                <dt>Alamat Rumah</dt>
                                <dd><?=$pegawai['alamat']?>&nbsp;</dd>                                  
                                <dt>Mobile Phone</dt>
                                <dd><?=$pegawai['hp']?>&nbsp;</dd>
                                <dt>Email</dt>
                                <dd><?=$pegawai['email']?>&nbsp;</dd>

                            </dl>

                            <small>Last Update: <?=$pegawai['tglUpdate']?></small>
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
                            <?=form_open(site_url('pegawai/profile/update'))?>
                                <input name="id" type="hidden" value="<?=$pegawai['idPegawai']?>">

                                <div class="form-group">
                                    <label class="form-label">Name </label>
                                    <div class="form-line">
                                        <input type="text" name="nama" class="form-control" value="<?=$pegawai['nama']?>" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Tanggal Lahir </label>
                                    <div class="form-line">
                                        <input type="text" name="tglLahir" class="datepicker form-control" value="<?=$pegawai['tglLahir']?>" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Alamat </label>
                                    <div class="form-line">
                                        <input type="text" name="alamat" class="form-control" value="<?=$pegawai['alamat']?>">
                                    </div>
                                </div>                             

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <label class="form-label">Email</label>
                                            <div class="form-line">
                                                <input type="email" name="email" class="form-control" value="<?=$pegawai['email']?>">
                                            </div>
                                        </div>
                                        <div class="col-xs-6">
                                            <label class="form-label">Mobile Phone</label>
                                            <div class="form-line">
                                                <input type="number" name="hp" class="form-control" value="<?=$pegawai['hp']?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Password baru </label>
                                    <div class="form-line">
                                        <input type="text" name="password" class="form-control">
                                    </div>
                                    <small class="col-red">Kosongkan jika tidak ingin mengganti</small>
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

                            <?=form_open_multipart(site_url('pegawai/profile/change-pic'))?>
                                <input name="id" type="hidden" value="<?=$pegawai['idPegawai']?>">
                                
                                <div class="form-group">
                                    <span class="form-control-static">
                                        <img src="<?=$pegawai['foto']."?".time()?>" class="img-responsive img-thumbnail"/>
                                    </span>
                                </div>

                                <div class="form-group">
                                    <label>Foto profil baru</label>
                                    <div class="form-line">
                                        <input name="fotopegawai" type="file" required>
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