<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

            <div class="block-header">
                <h2><?php echo $pageTitle;?></h2>
            </div>
            
            <div class="row clearfix">
                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="header bg-cyan">
                            <h2>Foto Profil</h2>
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