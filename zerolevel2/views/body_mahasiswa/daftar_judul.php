<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

            <div class="block-header">
                <h2>DAFTAR JUDUL SKRIPSI</h2>
            </div>         
            
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
                            <?php if($this->session->flashdata('message')) {?>  
                            <div class="alert alert-dismissable alert-<?php echo $this->session->flashdata('type');?>">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <?php echo $this->session->flashdata('message');?>
                            </div>
                            <?php }?>
                            <!-- Tabel judul -->
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable basicTabel">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Judul</th>
                                            <th>Laboratorium/Studio</th>
                                            <th>Status</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=1;?>
                                        <?php foreach($judul as $list) { ?>
                                        
                                        <tr>
                                            <td><?php echo $i;?></td>
                                            <td><?php echo $list['judulTa'];?></td>
                                            <td><?php echo $list['labstudioNama'];?></td>
                                            <td><?php echo $list['judulStatus'];?></td>
                                            <td style='white-space: nowrap'>
                                                <button type="button" class="btn btn-primary waves-effect" data-toggle="modal" data-target="#modalDetailJudul" data-form="formEdit" data-id="<?php echo $list['judulId'];?>">Apply</button>
                                            </td>
                                        </tr>
                                        <?php $i++;}?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- #END# Tabel judul -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modals utk menampilkan form input judul -->
            <div class="modal fade" id="modalDetailJudul" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Apply Judul Skripsi</h4>
                        </div>

                        <div class="modal-body">
                            <?php echo form_open_multipart(site_url('mahasiswa/judul/apply-judul'));?>
                                <input type="hidden" name="idJudul">
                                <div class="form-group form-float">
                                    <label class="form-label">Judul</label>
                                    <div class="form-line">
                                        <span class="judul"></span>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <label class="form-label">Dosen Pembimbing</label>
                                    <div class="form-line">
                                        <span class="dosen"></span>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <label class="form-label">Keywords</label>
                                    <div class="form-line">
                                        <span class="keyword"></span>
                                    </div>
                                </div>                            
                                <div class="form-group form-float">
                                    <label class="form-label">Laboratorium/Studio</label>
                                    <div class="form-line">
                                        <span class="labstudio"></span>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <label class="form-label">Upload file proposal skripsi</label>
                                    <input type="file" name="dokumen" class="form-control-file">
                                </div>
                                <button class="btn btn-primary waves-effect" type="submit">Submit</button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Modals utk menampilkan form input judul -->            
