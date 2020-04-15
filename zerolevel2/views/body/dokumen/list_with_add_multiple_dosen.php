<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

            <div class="block-header">
                <h1><?php echo $pageTitle;?></h1>
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
                        <div class="header">
                            <h2><?php echo $subtitle;?></h2>
                        </div>
                        <div class="body">

                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-4 align-right">
                                    <label>Filter Kategori Dokumen</label>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <select class="form-control show-tick" id="selectKategoriDokumen">
                                                <option value="">Semua</option>
                                                <?php foreach ($docgroup0 as $key) {?>
                                                    <option value="<?php echo $key['docgroupJenisDoc'];?>"><?php echo $key['docgroupJenisDoc'];?></option>
                                                <?php }?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="button-demo">
                                <button type="button" class="btn btn-primary btn-lg waves-effect" data-toggle="modal" data-target="#modalFormDocMultiUser" data-form="formTambah">Tambah</button>
                            </div>

                            

                            <!-- Tabel dokumen -->
                            <div class="table-responsive">
                                <table id="tabelData" class="table table-bordered table-striped table-hover tabelListDokumen">
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
                                                <?php if ($list['ownerId'] == $ownerId) {?>
                                                <button type="button" class="btn btn-xs btn-warning waves-effect" data-toggle="modal" data-target="#modalFormDocMultiUser" data-form="formEdit" data-id="<?php echo $list['idDokumen'];?>">Edit</button>
                                                <?php }?>
                                                <button class="btn btn-xs btn-danger waves-effect buttonHapus" data-id="<?php echo $list['idDokumen'];?>">Delete</button>
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
            <div class="modal fade" id="modalFormDocMultiUser" tabindex="-1" role="dialog">
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
                                                <select class="form-control show-tick" name="jenis">
                                                    <?php foreach ($docgroup as $list) {;?>
                                                    <option value="<?php echo $list['idDocgroup'];?>"><?php echo $list['docgroupJenisDoc'];?></option>
                                                    <?php }?>                                                   
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xs-4">
                                            <label class="form-label">Tahun</label>
                                            <div class="form-line">
                                                <select class="form-control show-tick" name="tahun">
                                                    <?php $i = date('Y');
                                                    for ($i;$i>=1980;$i--) {?>
                                                        <option value="<?php echo $i;?>"><?php echo $i;?></option>
                                                    <?php }?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <label class="form-label">Tag Dosen</label>
                                    <small>(Tandai nama-nama dosen yang terkait dengan dokumen ini)</small>
                                    <div class="form-line">
                                        <input id="tags-input-dosen" name="dsndoc">
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <label class="form-label">Tag Mahasiswa</label>
                                    <small>(Tandai nama-nama mahasiswa yang terkait dengan dokumen ini)</small>
                                    <div class="form-line">
                                        <input id="tags-input-mhs" name="mhsdoc">
                                    </div>
                                </div>

                                <div class="form-group form-float">
                                    <label class="form-label">Tag Pegawai</label>
                                    <small>(Tandai nama-nama pegawai yang terkait dengan dokumen ini)</small>
                                    <div class="form-line">
                                        <input id="tags-input-peg" name="pegdoc">
                                    </div>
                                </div>

                                <div class="form-group form-float">
                                    <label class="form-label">Upload Dokumen <span class="doc-baru"></span></label>
                                    <input name="dokumen" type="file">
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
            <!-- #END# Modals utk menampilkan form tambah dokumen -->

<script type="text/javascript">
    var prefetch_dsn = "<?php echo URL_API.'daftar/dosen/2';?>";
    var prefetch_mhs = "<?php echo URL_API.'daftar/mahasiswa/2';?>";
    var prefetch_peg = "<?php echo site_url('api/list-pegawai/');?>";
    <?php if(isset($loadMe)) {?>
        var loadMe = <?php echo json_encode($loadMe); ?>;
    <?php }?>
</script>