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
                            <div class="button-demo">
                                <button type="button" class="btn btn-primary btn-lg waves-effect" data-toggle="modal" data-target="#modalFormPublikasi" data-form="formTambah">Tambah</button>
                            </div>

                            <div class="table-responsive">
                                <table id="tabelData" class="table table-bordered table-striped table-hover dataTable basicTabel">
                                    <thead>
                                        <tr>
                                            <th>Tahun</th>
                                            <th>Judul Publikasi</th>
                                            <th>Jurnal/Prosiding</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody> 
                                        <?php foreach($publikasi as $list) { ?>
                                        <tr>
                                            <td><?php echo $list['tahun'];?></td>
                                            <td><?php echo $list['judul'];?></td>
                                            <td><?php echo $list['di']." ".$list['tempat'];?></td>
                                            <td style='white-space: nowrap'>
                                                <button type="button" class="btn btn-xs btn-warning waves-effect" data-toggle="modal" data-target="#modalFormPublikasi" data-form="formEdit" data-id="<?php echo $list['idPublikasi'];?>">Edit</button>
                                                <button class="btn btn-xs btn-danger waves-effect buttonHapus" data-id="<?php echo $list['idPublikasi'];?>">Delete</button>
                                            </td>
                                        </tr> 
                                        <?php }?>                           
                                    </tbody>
                                </table>
                            </div>  

                        </div>
                    </div>
                </div>
            </div>

            <!-- Modals utk menampilkan form input publikasi -->
            <div class="modal fade" id="modalFormPublikasi" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Tambah Publikasi</h4>
                        </div>

                        <div class="modal-body">
                            <?php echo form_open(site_url('dosen/publikasi/tambah'));?>
                                <input type="hidden" name="id">
                                <div class="form-group form-float">
                                    <label class="form-label">Judul Publikasi</label>
                                    <div class="form-line">
                                        <input type="text" name="judul" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <label class="form-label">Jurnal / Prosiding</label>
                                    <div class="form-line">
                                        <input type="text" name="jurnal" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <label class="form-label">Tempat</label>
                                    <div class="form-line">
                                        <input type="text" name="tempat" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <label class="form-label">Tahun</label>
                                    <div class="form-line">
                                        <select class="form-control show-tick" data-live-search="true" name="tahun">
                                            <?php $i = date('Y');
                                            for ($i;$i>=1995;$i--) {?>
                                                <option value="<?php echo $i;?>"><?php echo $i;?></option>
                                            <?php }?>
                                        </select>
                                    </div>
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
            <!-- #END# Modals utk menampilkan form input publikasi -->              