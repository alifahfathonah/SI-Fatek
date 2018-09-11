<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

            <div class="block-header">
                <h2><?php echo $pageTitle;?></h2>
            </div>
            
            <div class="row clearfix">
                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <img src="<?php echo $dosen['foto'];?>" class="img-responsive img-thumbnail"/>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="header bg-cyan">
                            <h2>
                                <?php echo $dosen['nama'];?> <small>Source: Database Fatek</small>
                            </h2>
                        </div>
                        <div class="body">
                            <dl class="dl-horizontal">
                                <dt>Biografi singkat</dt>
                                <dd><?php echo $dosen['bio']; ?>&nbsp;</dd>
                                <dt>Office Address</dt>
                                <dd><?php echo $dosen['alamat']; ?>&nbsp;</dd>                                  
                                <dt>Nomor HP</dt>
                                <dd><?php echo $dosen['hp']; ?>&nbsp;</dd>
                                <dt>Jurusan</dt>
                                <dd><?php echo $dosen['jurusan']; ?>&nbsp;</dd>                                  
                                <dt>Program Studi</dt>
                                <dd><?php echo $dosen['prodi']; ?>&nbsp;</dd>
                                <dt>Email</dt>
                                <dd><?php echo $dosen['email']; ?>&nbsp;</dd>                                  
                                <dt>Research field</dt>
                                <dd><?php echo $dosen['interest']; ?>&nbsp;</dd>                                  
                                <dt>Sinta ID</dt>
                                <dd><?php echo $dosen['sintaId']; ?>&nbsp;</dd>
                                <dt>Google Scholar ID</dt>
                                <dd><?php echo $dosen['googleId']; ?>&nbsp;</dd>                                  
                                <dt>Scopus Author ID</dt>
                                <dd><?php echo $dosen['scopusId']; ?>&nbsp;</dd>
                                <dt>Last Update</dt>
                                <dd><?php echo $dosen['tglUpdate']; ?>&nbsp;</dd>
                            </dl>
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
                        </div>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-7 col-md-7 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="header bg-cyan">
                            <h2>
                                Publikasi
                            </h2>
                        </div>
                        <div class="body">
                            <div class="list-group">

                                <?php if (isset($dosen['sintaUrl'])) {?> <a href="<?php echo $dosen['sintaUrl'];?>" target="_blank" class="list-group-item list-group-item-action">Science and Technology Index</a><?php }?>
                                <?php if (isset($dosen['googleUrl'])) {?> <a href="<?php echo $dosen['googleUrl'];?>" target="_blank" class="list-group-item list-group-item-action">Google Scholar</a><?php }?>
                                <?php if (isset($dosen['scopusUrl'])) {?> <a href="<?php echo $dosen['scopusUrl'];?>" target="_blank" class="list-group-item list-group-item-action">Scopus Author</a><?php }?>

                            </div>
                            <div class="table-responsive">
                                <table id="tabel-publikasi" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Tahun</th>
                                            <th>Judul Publikasi</th>
                                            <th>Jurnal/Prosiding</th>
                                        </tr>
                                    </thead>
                                    <tbody> 
                                        <?php foreach($publikasi as $list) { ?>
                                        <tr>
                                            <td><?php echo $list['tahun'];?></td>
                                            <td><?php echo $list['judul'];?></td>
                                            <td><?php echo $list['di']." ".$list['tempat'];?></td>
                                        </tr> 
                                        <?php }?>                           
                                    </tbody>
                                </table>
                            </div>  
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="header bg-green">
                            <h2>
                                Riwayat Pendidikan <small>Source: Database Kepegawaian Unsrat</small>
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
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
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
            

    


           
            
            