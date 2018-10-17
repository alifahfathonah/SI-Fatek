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

                                        <ul class="fa-ul">
  <li><i class="fa-li fa fa-check-square"></i>List icons</li>
  <li><i class="fa-li fa fa-check-square"></i>can be used</li>
  <li><i class="fa-li fa fa-spinner fa-spin"></i>as bullets</li>
  <li><i class="fa-li fa fa-square"></i>in lists</li>
</ul>

                            <div class="button-demo">
                                <button type="button" class="btn btn-primary btn-lg waves-effect" data-toggle="modal" data-target="#modalFormDoc" data-form="formTambah">Tambah</button>
                            </div>

                            <!-- Tabel dokumen -->
                            <div class="table-responsive">
                                <table id="tabelData" class="table table-bordered table-striped table-hover dataTable basicTabel">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Dokumen / Deskripsi</th>
                                            <th>Nomor</th>
                                            <th>Tahun</th>
                                            <th>Kategori</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=1;?>
                                        <?php foreach($dokumen as $list) { ?>
                                        
                                        <tr>
                                            <td><?php echo $i;?></td>
                                            <td>
                                                <a href="<?php echo $list['dokumenFile'];?>" target="_blank"><?php echo $list['dokumenNama'];?></a><br>
                                                <small><?php echo $list['dokumenDeskripsi'];?></small>
                                            </td>
                                            <td><?php echo $list['dokumenNomor'];?></td>
                                            <td><?php echo $list['dokumenTahun'];?></td>
                                            <td><?php echo $list['docgroupJenisDoc'];?></td>
                                            <td style='white-space: nowrap'>
                                                <button class="btn btn-xs btn-danger waves-effect buttonHapus" data-id="<?php echo $list['dokumenId'];?>">Delete</button>
                                            </td>                                            
                                        </tr>
                                        <?php $i++;}?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- #END# Tabel dokumen -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modals utk menampilkan form tambah dokumen -->
            <div class="modal fade" id="modalFormDoc" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Tambah Dokumen</h4>
                        </div>

                        <div class="modal-body">
                            <?php echo form_open_multipart(site_url('admin/dokumen/tambah'));?>
                                <input type="hidden" name="id">
                                <div class="form-group form-float">
                                    <label class="form-label">Nama Dokumen</label>
                                    <div class="form-line">
                                        <input type="text" name="nama" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <label class="form-label">Deskripsi</label>
                                    <div class="form-line">
                                        <textarea rows="2" class="form-control no-resize" placeholder="Deskripsi singkat tentang dokumen ini. Kosongkan jika tidak ada" name="deskripsi"></textarea>
                                    </div>
                                </div>

                                <div class="form-group form-float">
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <label class="form-label">Nomor Dokumen</label>
                                            <div class="form-line">
                                                <input type="text" name="nomor" placeholder="Kosongkan jika tidak ada" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-xs-4">
                                            <label class="form-label">Jenis Dokumen</label>
                                            <div class="form-line">
                                                <select class="form-control show-tick" data-live-search="true" name="jenis">
                                                    <?php foreach ($docgroup as $list) {;?>
                                                    <option value="<?php echo $list['docgroupId'];?>"><?php echo $list['docgroupJenisDoc'];?></option>
                                                    <?php }?>                                                   
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xs-4">
                                            <label class="form-label">Tahun</label>
                                            <div class="form-line">
                                                <select class="form-control show-tick" data-live-search="true" name="tahun">
                                                    <?php $i = date('Y');
                                                    for ($i;$i>=2015;$i--) {?>
                                                        <option value="<?php echo $i;?>"><?php echo $i;?></option>
                                                    <?php }?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group form-float">
                                    <label class="form-label">Dosen / Mahasiswa</label>

                                    <div class="controls"> 
                                        <small>Masukkan NIP Dosen/Pegawai atau NIM mahasiswa yang terkait dengan dokumen ini. Klik icon + untuk menambah field</small>
                                        <div class="kotak">
                                            <div class="entry input-group">
                                                <span class="input-group-addon">
                                                    <div id="loader1" class="loader"></div>
                                                </span>                     
                                                <input class="form-line form-control" name="user[]" id= "1"/>
                                                <span class="input-group-addon">
                                                    <div id="respon1" class="respon"></div>
                                                </span>
                                                <span class="input-group-addon">
                                                </span>
                                                <button class="btn btn-add" type="button">
                                                    <i class="material-icons">person_add</i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group form-float">
                                    <label class="form-label">Upload Dokumen</label>
                                    <input name="dokumen" type="file">
                                </div>
                                
                                <div class="alert alert-info">
                                     <i class="material-icons">info</i>
                                    Spesifikasi File: Filetype=pdf jpg jpeg xls xlsx doc docx mde; Max Size=20 Mb.
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
            <!-- #END# Modals utk menampilkan form tambah dokumen -->

<script type="text/javascript">
    var urlApi = "<?php echo URL_API . "welcome/get_user/";?>";
</script>                          