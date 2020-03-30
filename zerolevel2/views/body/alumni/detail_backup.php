<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

			<div class="block-header">
                <h2><?php echo $pageTitle;?></h2>
            </div>

            <div class="row clearfix">
                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="header bg-green">
                            <h2>Foto Profil</h2>
                        </div>
                        <div class="body">
                             <img src="<?php echo $alumniAPI->foto;?>" class="img-responsive img-thumbnail" alt=""/>
                        </div>
                    </div>
                </div>

                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header bg-green">
                            <h2>
                                <?php echo $alumniAPI->nama;?> <small>Source: Database Akademik Unsrat</small>
                            </h2>
                        </div>
                        <div class="body">
                            <dl class="dl-horizontal">
                                
                                <dt>Nim</dt>
                                <dd><?php echo $alumniAPI->nim;?></dd>

                                <dt>Judul Skripsi/TA</dt>
                                <dd><?php echo $alumniAPI->judulTa;?></dd>
                                
                                <dt>Angkatan</dt>
                                <dd><?php echo $alumniAPI->angkatan;?></dd>

                                <dt>Jurusan / Prodi</dt>
                                <dd><?php echo $alumniAPI->jurusan." / ".$alumniAPI->prodi;?></dd>

                                <dt>Tanggal Lulus</dt>
                                <dd><?php echo $alumniAPI->tanggalLulus;?></dd>

                                <dt>Tanggal Wisuda</dt>
                                <dd><?php echo $alumniAPI->tanggalWisuda;?></dd>

                                <dt>Tanggal Ijazah</dt>
                                <dd><?php echo $alumniAPI->tanggalIjazah;?></dd>

                                <dt>No Ijazah</dt>
                                <dd><?php echo $alumniAPI->noIjazah;?></dd>

                                <dt>Gelar / Predikat</dt>
                                <dd ><?php echo $alumniAPI->gelar." / ".$alumniAPI->predikatKelulusan;?></dd>

                                <dt>Dosen Pembimbing</dt>
                                <dd>
                                    <?php foreach($alumniAPI->pembimbing as $list) { ?>
                                        <a href="<?php echo site_url('admin/detail/dosen/').$list->nip;?>"><?php echo $list->nama;?></a><br/>
                                    <?php }?>
                                </dd>
                                <dt>Email</dt>
                                <dd><?php echo $alumniAPI->email;?></dd>
                                <dt>No Hp</dt>
                                <dd><?php echo $alumniAPI->noHp;?></dd>

                            </dl>                   
                        </div>
                    </div>
                </div>
            </div>      