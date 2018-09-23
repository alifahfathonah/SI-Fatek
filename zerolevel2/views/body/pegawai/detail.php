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
                            <img src="<?php echo $pegawai->foto;?>" class="img-responsive img-thumbnail"/>
                        </div>
                    </div>
                </div>

                <div class="col-lg-10 col-md-10 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="header bg-green">
                            <h2>
                                <?php echo $pegawai->nama;?> <small>Source: Database Kepegawaian Unsrat</small>
                            </h2>
                        </div>
                        <div class="body">
                            <dl class="dl-horizontal">
                                <dt>NIP</dt>
                                <dd><?php echo $pegawai->nip; ?>&nbsp;</dd>                                  
                                <dt>Kode Lain</dt>
                                <dd><?php echo $pegawai->kodeLain; ?>&nbsp;</dd>
                                <dt>Alamat Rumah</dt>
                                <dd><?php echo $pegawai->alamat; ?>&nbsp;</dd>
                                <dt>Tempat Tanggal Lahir</dt>
                                <dd><?php echo $pegawai->tempatLahir." ".$pegawai->tanggalLahir; ?>&nbsp;</dd>                                  
                                <dt>Jenis Kelamin</dt>
                                <dd><?php echo $pegawai->jenisKelamin; ?>&nbsp;</dd>
                                <dt>Status Pegawai</dt>
                                <dd><?php echo $pegawai->statusPegawai; ?>&nbsp;</dd>
                                <dt>Kategori Pegawai</dt>
                                <dd><?php echo $pegawai->kategoriPegawai; ?>&nbsp;</dd>
                                <dt>Jenis Pegawai</dt>
                                <dd><?php echo $pegawai->jenisPegawai; ?>&nbsp;</dd>
                                <dt>Satuan Kerja</dt>
                                <dd><?php echo $pegawai->satuanKerja; ?>&nbsp;</dd>
                                <dt>No Karpeg</dt>
                                <dd><?php echo $pegawai->noKarpeg; ?>&nbsp;</dd>
                                <dt>Jabatan Fungsional</dt>
                                <dd><?php echo $pegawai->jabatanFungsional; ?>&nbsp;</dd>                                  
                                <dt>Pangkat/Golongan</dt>
                                <dd><?php echo $pegawai->pangkatGolongan; ?>&nbsp;</dd>                                  
                                <dt>Agama</dt>
                                <dd><?php echo $pegawai->agama; ?>&nbsp;</dd>
                                <dt>Status Nikah</dt>
                                <dd><?php echo $pegawai->statusNikah; ?>&nbsp;</dd>                                  
                                <dt>No Hp</dt>
                                <dd><?php echo $pegawai->noHp; ?>&nbsp;</dd>
                                <dt>Email</dt>
                                <dd><?php echo $pegawai->email; ?>&nbsp;</dd>
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
                                    <?php foreach($pegawai->edu as $list) { ?>
                                    <tr>
                                        <td><?php echo $list->tahunLulus;?></td>
                                        <td><?php echo $list->jenjang." ".$list->bidangIlmu;?></td>
                                        <td><?php echo $list->pt." ".$list->lokasi;?></td>
                                    </tr> 
                                    <?php }?>                           
                                </tbody>
                            </table>
                            <small>Last Update: <?php echo $pegawai->lastUpdate; ?></small>
                        </div>
                    </div>

                </div>
            </div>