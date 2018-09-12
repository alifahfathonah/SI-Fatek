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
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active">
                                    <a href="#profile" data-toggle="tab">
                                        <i class="material-icons">person</i> Profile
                                    </a>
                                </li>
                                <li role="presentation">
                                	<a href="#fotoProfil" data-toggle="tab">
                                        <i class="material-icons">face</i> Foto Profil
                                    </a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="profile">
                                	<?php echo form_open(site_url('dosen/profile/simpan'));?>
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

										<button type="submit" class="btn btn-primary btn-lg m-t-15 waves-effect">SIMPAN</button>
									</form>
								</div>	

                                <div role="tabpanel" class="tab-pane fade" id="fotoProfil">

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
                            </div>
                        </div>
                    </div>
                </div>
            </div>