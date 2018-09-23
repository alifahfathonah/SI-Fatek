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
                             <img src="<?php echo $alumni->foto;?>" class="img-responsive img-thumbnail" alt=""/>
                        </div>
                    </div>
                </div>

                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header bg-green">
                            <h2>
                                <?php echo $alumni->nama;?> <small>Source: Database Akademik Unsrat</small>
                            </h2>
                        </div>
                        <div class="body">
                            <dl class="dl-horizontal">
                                
                                <dt>Nim</dt>
                                <dd><?php echo $alumni->nim;?></dd>

                                <dt>Judul Skripsi/TA</dt>
                                <dd><?php echo $alumni->judulTa;?></dd>
                                
                                <dt>Angkatan</dt>
                                <dd><?php echo $alumni->angkatan;?></dd>

                                <dt>Jurusan / Prodi</dt>
                                <dd><?php echo $alumni->jurusan." / ".$alumni->prodi;?></dd>

                                <dt>Tanggal Lulus</dt>
                                <dd><?php echo $alumni->tanggalLulus;?></dd>

                                <dt>Tanggal Wisuda</dt>
                                <dd><?php echo $alumni->tanggalWisuda;?></dd>

                                <dt>Tanggal Ijazah</dt>
                                <dd><?php echo $alumni->tanggalIjazah;?></dd>

                                <dt>No Ijazah</dt>
                                <dd><?php echo $alumni->noIjazah;?></dd>

                                <dt>Gelar / Predikat</dt>
                                <dd ><?php echo $alumni->gelar." / ".$alumni->predikatKelulusan;?></dd>

                                <dt>Dosen Pembimbing</dt>
                                <dd>
                                    <?php foreach($alumni->pembimbing as $list) { ?>
                                        <a href="<?php echo site_url('admin/detail/dosen/').$list->nip;?>"><?php echo $list->nama;?></a><br/>
                                    <?php }?>
                                </dd>
                                <dt>Email</dt>
                                <dd><?php echo $alumni->email;?></dd>
                                <dt>No Hp</dt>
                                <dd><?php echo $alumni->noHp;?></dd>

                            </dl>                   
                        </div>
                    </div>
                </div>
            </div>      