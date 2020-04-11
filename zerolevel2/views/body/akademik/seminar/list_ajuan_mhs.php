<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

			<div class="block-header">
                <h1><?php echo $pageTitle;?></h1>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Pendaftaran Seminar KP, Seminar Proposal, Seminar Konsep Skripsi (Hasil) dan Sidang Sarjana</h2>
                        </div>
                        <div class="body">
                            <h5>Persyaratan pendaftaran</h5>
                            <p>Untuk seminar KP (Kerja Praktek) harus telah menyelesaikan Kerja Praktek di lapangan. Untuk pendaftar seminar proposal/skripsi, mahasiswa harus sedang mengontrak matakuliah Skripsi pada semester aktif, jumlah SKS lulus sudah memenuhi, tidak ada disiplin (pelanggaran) akademik dan mengisi/mengupload informasi tambahan. Untuk informasi tambahan lainnya, disesuaikan sesuai petunjuk dibawah ini.
                            <h5>Seminar Kerja Praktek</h5>
                            <p>Informasi yang perlu diisi adalah: Lokasi dan Tanggal Kerja Praktek. Dokumen yang wajib diupload adalah: file laporan KP (pdf).</p>
                            <h5>Seminar Proposal Judul</h5>
                            <p>Informasi yang perlu diisi adalah: Judul proposal, nama KDK dan nama-nama calon dosen pembimbing 1 dan 2. Dokumen yang wajib diupload adalah: file proposal (pdf).</p>
                            <h5>Seminar Konsep Skripsi (Seminar Hasil)</h5>
                            <p>Informasi yang perlu diisi adalah: Judul skripsi dan nama dosen pembimbing 1 dan 2. Dokumen yang wajib diupload adalah: file skripsi dan bukti skripsi telah disetujui untuk diseminarkan oleh 2 orang dosen pembimbing.</p>
                            <h5>Sidang Sarjana</h5>
                            <p>Informasi yang perlu diisi adalah: Judul skripsi dan nama dosen 5 orang dosen penguji. Dokumen yang wajib diupload adalah: file skripsi dan bukti skripsi telah disetujui untuk sidang sarjana oleh 5 orang dosen penguji.</p>
                        </div>
                        <div class="header">
                            <h2><?php echo $subtitle;?></h2>
                        </div>
                        <div class="body">

                            <?php if($this->session->flashdata('message')) {?>  
                            <div class="alert alert-dismissable alert-<?php echo $this->session->flashdata('type');?>">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <?php echo $this->session->flashdata('message');?>
                            </div>
                            <?php }?>  


                            <div class="button-demo">
                                <button type="button" class="btn btn-primary btn-lg waves-effect" data-toggle="modal" data-target="#modalFormSeminar" data-form="formTambah"><i class="fa fa-fw fa-plus" aria-hidden="true"></i> Daftar Seminar</button>
                            </div>

                            <div class="table-responsive">
                                <table id="tabelData" class="table table-bordered table-striped dataTable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Jenis Seminar</th>
                                            <th>Judul</th>
                                            <th>Informasi Tambahan</th>
                                            <th>Dokumen</th>
                                            <th>Tanggal Pengajuan</th>
                                            <th>Keterangan</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=1;?>
                                        <?php foreach($request as $list) { ?>
                                        <tr>
                                            <td><?php echo $i;?></td>
                                            <td><?php echo $list['jenisSeminar'];?></td>
                                            <td><?php echo $list['judul'];?></td>
                                            <td><?php echo $list['infoTambahan'];?></td>
                                            <td>
                                                <?php if ($list['file']) { 
                                                    foreach ($list['file'] as $key => $value) {
                                                        echo "<a href='".$value."' target='_BLANK'>"."File".($key+1)."</a> ";
                                                    }
                                                }?>
                                            </td>
                                            <td><?php echo $list['tglRequest'];?></td>
                                            <td><?php echo $list['komentar'];?></td>
                                            <td>
                                                <span class="label bg-<?php echo $list['prosesColor'];?>"><?php echo $list['prosesStatus'];?></span>
                                            </td>
                                            <td style='white-space: nowrap'>
                                                <a href="<?php echo site_url('mahasiswa/seminar/detail/').$list['idRequest'];?>" class="btn btn-xs btn-info waves-effect" role="button">
                                                    Detail
                                                </a>
                                                <?php if ($list['authorized']) {?>
                                                <button class="btn btn-xs btn-danger waves-effect buttonHapus" data-id="<?php echo $list['idRequest'];?>">Delete</button>
                                                <?php }?>
                                            </td> 
                                        </tr> 
                                        <?php $i++;}?> 
                                    </tbody>
                                </table>
                            </div>  

                        </div>
                    </div>
                </div>
            </div>

            <!-- Modals utk menampilkan form input user -->
            <div class="modal fade" id="modalFormSeminar" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Pendaftaran Seminar</h4>
                        </div>

                        <div class="modal-body">
                            <?php echo form_open_multipart();?>
                                <input type="hidden" name="id">
                                <input type="hidden" name="jenisSeminar">
                                <div class="form-group form-float">
                                    <label class="form-label">Jenis Seminar</label>
                                    <div class="form-line">
                                        <select class="form-control show-tick" id="jenisSeminar" required>
                                            <option value="">Pilih jenis seminar</option>
                                            <?php foreach ($seminar as $key) {?>
                                                <option value="<?php echo $key['idReqField'];?>"><?php echo $key['formField'];?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>
                                <div id="divInfo">
                                    <div class="form-group form-float">
                                        <label class="form-label" id="judul">Judul Skripsi</label>
                                        <div class="form-line">
                                           <textarea rows="2" class="form-control no-resize" name="judul" required></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <label class="form-label">Informasi Tambahan</label>
                                        <div class="form-line">
                                           <textarea rows="5" class="form-control no-resize" name="infoTambahan" required></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div id="divFile">    
                                    <div class="form-group form-float">
                                        <label class="form-label">Upload Dokumen</label> 
                                        <small class="col-red"><span class="fileinfo"></span></small>
                                        <input name="dokumen[]" type="file" multiple="" required>
                                    </div>
                                    
                                    <div class="alert alert-info">
                                         <i class="material-icons">info</i>
                                        Spesifikasi File: Filetype=pdf|jpg|jpeg; Max size=3 Mb utk tiap file;
                                    </div>
                                </div>

                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-link waves-effect" type="submit">SUBMIT</button>
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- #END# Modals utk menampilkan form input user -->
                     