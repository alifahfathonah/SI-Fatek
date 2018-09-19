<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"><h3>DATA ALUMNI</h3><small>Source: Database akademik Universitas Sam Ratulangi</small></div>
                        <div class="panel-body">
                            <div class="col-xs-12 col-sm-4 col-md-4">
                                <img src="<?php echo $alumni->foto;?>" class="img-responsive img-thumbnail" alt=""/>
                            </div>
                            <div class="col-xs-12 col-sm-8 col-md-8">
                                <h3 id="nama"><?php echo $alumni->nama;?></h3>
                                <div class="well well-sm">
                                    <h4>Judul Skripsi/TA</h4>
                                    <span class="judul"><?php echo $alumni->judulTa;?></span>
                                </div>
                                <dl class="dl-horizontal">
                                    
                                    <dt>Nim</dt>
                                    <dd><?php echo $alumni->nim;?></dd>
                                    
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
                                                <a href="<?php echo site_url("public/dosen/id/").$list->nip;?>"><?php echo $list->nama;?></a><br/>
                                            <?php }?>
                                    </dd>

                                </dl>                   

                            </div>              
                        </div>

                    </div>
                </div>
            </div>