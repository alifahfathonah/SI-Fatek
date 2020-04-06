<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

			<div class="block-header">
                <h1><?php echo $pageTitle;?></h1>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Layanan Administrasi Akademik</h2>
                        </div>
                        <div class="body">
                            <p>Layanan administrasi akademik adalah layanan online yang dapat digunakan mahasiswa untuk permintaan atau pengajuan surat-surat yang berhubungan dengan administrasi akademik seperti:</p>
                            <ol>
                                <li>Tanda-tangan berita acara seminar konsep skripsi (hasil)</li>
                                <li>Membuat SK 3 (SK seminar konsep skripsi)</li>
                                <li>Surat Keterangan Persetujuan Ujian Khusus</li>
                                <li>DPNA Ujian Khusus</li>
                                <li>Upload Nilai Ujian Khusus</li>
                                <li>Tanda Tangan Berita Acara Sidang</li>
                                <li>Membuat SK 4 (SK Ujian Skripsi)</li>
                                <li>Surat Keterangan Upload Nilai Skripsi</li>
                                <li>Surat Keterangan Siap Yudisium</li>
                                <li>Hapus Mata Kuliah</li>
                            </ol>

                        </div>
                        <div class="header">
                            <h2><?php echo $subtitle;?></h2>
                        </div>
                        <div class="body">

                            <div class="button-demo">
                                <button type="button" class="btn btn-primary btn-lg waves-effect" data-toggle="modal" data-target="#modalFormLayananAkademik" data-form="formTambah"><i class="fa fa-fw fa-plus" aria-hidden="true"></i> Ajukan Permintaan</button>
                            </div>

                            <div class="table-responsive">
                                <table id="tabelData" class="table table-bordered table-striped dataTable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Jenis Layanan</th>
                                            <th>Informasi Tambahan</th>
                                            <th>Dokumen</th>
                                            <th>Tanggal Pengajuan</th>
                                            <th>Keterangan</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>  

                        </div>
                    </div>
                </div>
            </div>

            <!-- Modals utk menampilkan form input user -->
            <div class="modal fade" id="modalFormLayananAkademik" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Permintaan Layanan Administrasi Akademik</h4>
                        </div>

                        <div class="modal-body">
                            <?php echo form_open_multipart();?>
                                <input type="hidden" name="id">
                                <div class="form-group form-float">
                                    <label class="form-label">Jenis Layanan</label>
                                    <div class="form-line">
                                        <select class="form-control show-tick" data-live-search="true" name="jenisLayanan" id="jenisLayanan" required>
                                            <option value="">Pilih jenis layanan</option>
                                            <option value="Tanda Tangan Berita Acara Seminar Konsep Skripsi (Hasil)">Tanda Tangan Berita Acara Seminar Konsep Skripsi (Hasil)</option>
                                            <option value="Membuat SK 3 (SK Seminar Konsep Skripsi)">Membuat SK 3 (SK Seminar Konsep Skripsi)</option>
                                            <option value="Surat Keterangan Persetujuan Ujian Khusus">Surat Keterangan Persetujuan Ujian Khusus</option>
                                            <option value="DPNA Ujian Khusus">DPNA Ujian Khusus</option>
                                            <option value="Upload Nilai Ujian Khusus">Upload Nilai Ujian Khusus</option>
                                            <option value="Tanda Tangan Berita Acara Sidang">Tanda Tangan Berita Acara Sidang</option>
                                            <option value="Membuat SK 4 (SK Ujian Skripsi)">Membuat SK 4 (SK Ujian Skripsi)</option>
                                            <option value="Surat Keterangan Upload Nilai Skripsi">Surat Keterangan Upload Nilai Skripsi</option>
                                            <option value="Surat Keterangan Siap Yudisium">Surat Keterangan Siap Yudisium</option>
                                            <option value="Hapus Mata Kuliah">Hapus Mata Kuliah</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group form-float" id="divInfo">
                                    <label class="form-label">Informasi Tambahan</label>
                                    <div class="form-line">
                                       <textarea rows="2" class="form-control no-resize" name="infoTambahan"></textarea>
                                    </div>
                                </div>

                                <div id="divFile">    
                                    <div class="form-group form-float">
                                        <label class="form-label">Upload Dokumen</label> 
                                        <small class="col-red"><span class="fileinfo"></span></small>
                                        <input name="dokumen[]" type="file" multiple="">
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
                     