<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

			<div class="block-header">
                <h1><?php echo $pageTitle;?></h1>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">

                            <div class="button-demo">
                                <button type="button" class="btn btn-primary btn-lg waves-effect" data-toggle="modal" data-target="#modalFormPrestasi" data-form="formTambah">Tambah</button>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered" id="tabelData">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Event</th>
                                            <th>Ranking</th>
                                            <th>Tanggal</th>
                                            <th>Tingkat</th>
                                            <th>Mahasiswa</th>
                                            <th class="no-sort">Dokumen Bukti</th>
                                            <th>Status</th>
                                            <th class="no-sort">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                </table>
                            </div>  

                        </div>
                    </div>
                </div>
            </div>

            <!-- Modals utk menampilkan form Prestasi -->
            <div class="modal fade" id="modalFormPrestasi" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Prestasi Mahasiswa</h4>
                        </div>

                        <div class="modal-body">
                            <?php echo form_open_multipart(site_url('kemahasiswaan/prestasi/tambah'));?>
                                <input type="hidden" name="id">
                                <div class="form-group form-float">
                                    <label class="form-label">Ranking</label>
                                    <div class="form-line">
                                        <input type="text" name="prestasi" class="form-control" placeholder="Juara berapa..." required>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <label class="form-label">Deskripsi Event/Lomba, Penyelenggara dan Tempat</label>
                                    <div class="form-line">
                                        <textarea rows="2" class="form-control no-resize" placeholder="Deskripsikan dengan lengkap nama even/lomba/kegiatan dan dimana, kapan dilaksanakan dan siapa yang melaksanakan..." name="even" required></textarea>
                                    </div>
                                </div>

                                <div class="form-group form-float">
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <label class="form-label">Tanggal Kegiatan</label>
                                            <div class="form-line">
                                                <input type="text" name="tglLomba" class="datepicker form-control" placeholder="Pilih tanggal kegiatan...">
                                            </div>
                                        </div>
                                        <div class="col-xs-6">
                                            <label class="form-label">Tingkat</label>
                                            <div class="form-line">
                                                <select class="form-control show-tick" name="tingkat">
                                                    <option value="Lokal">Lokal</option> 
                                                    <option value="Regional">Regional</option>
                                                    <option value="Nasional">Nasional</option>
                                                    <option value="Internasional">Internasional</option>     
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <label class="form-label">Tag Mahasiswa</label>
                                    <small>(Tandai nama-nama mahasiswa yang mendapat prestasi ini)</small>
                                    <div class="form-line">
                                        <input id="tags-input-mhs" name="mhsdoc" required>
                                    </div>
                                </div>

                                <div class="form-group form-float">
                                    <label class="form-label">Bukti Pendukung</label>
                                    <small>(Upload satu atau beberapa dokumen pendukung)</small>
                                    <input name="dokumen[]" type="file" multiple="">
                                    <small><span class="doc-empty"></span></small>
                                </div>

                                <div class="alert alert-info">
                                     <i class="material-icons">info</i>
                                    Spesifikasi File: <?php echo $fileSpec;?>.
                                </div>
                                <button class="btn btn-primary waves-effect" type="submit">SIMPAN</button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Modals utk menampilkan form Prestasi -->

<script type="text/javascript">
    var prefetch_mhs = "<?php echo URL_API.'daftar/mahasiswa/2';?>";
</script>               