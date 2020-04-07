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

                            <div class="button-demo">
                                <button type="button" class="btn btn-primary btn-lg waves-effect" data-toggle="modal" data-target="#modalAdminLayanan" data-form="formTambah">Tambah</button>
                            </div>

                            <div class="table-responsive">
                                <table id="tabelData" class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Nama Layanan</th>
                                            <th>Info Required</th>
                                            <th>File Required</th>
                                            <th>Status</th>
                                            <th>Urutan</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody> 
                                        <?php foreach($layanan as $list) { ?>
                                        <tr>
                                            <td><?php echo $list['layanan'];?></td>
                                            <td><?php echo $list['infoRequired'];?></td>
                                            <td><?php echo $list['fileRequired'];?></td>
                                            <td><?php echo $list['status'];?></td>
                                            <td><?php echo $list['urutan'];?></td>
                                            <td style='white-space: nowrap'>
                                                <button type="button" class="btn btn-xs btn-warning waves-effect" data-toggle="modal" data-target="#modalAdminLayanan" data-form="formEdit" data-id="<?php echo $list['idLayanan'];?>">Edit</button>
                                                <button class="btn btn-xs btn-danger waves-effect buttonHapus" data-id="<?php echo $list['idLayanan'];?>">Delete</button>
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

            <!-- Modals utk menampilkan form input layanan -->
            <div class="modal fade" id="modalAdminLayanan" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel"></h4>
                        </div>

                        <div class="modal-body">
                            <?php echo form_open();?>
                                <input type="hidden" name="id">
                                <div class="form-group form-float">
                                    <label class="form-label">Nama Layanan</label>
                                    <div class="form-line">
                                        <input type="text" name="layanan" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <label class="form-label">Info Tambahan</label>
                                    <div class="form-line">
                                        <textarea rows="2" class="form-control no-resize" name="infoRequired"></textarea>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <label class="form-label">File Required</label>
                                    <div class="form-line">
                                        <input type="text" name="fileRequired" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <label class="form-label">Urutan</label>
                                    <div class="form-line">
                                        <input type="text" name="urutan" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <label class="form-label">Status</label>
                                    <div class="form-line">
                                        <select class="form-control show-tick" name="status">
                                            <option value="0">Tidak Aktif</option>
                                            <option value="1" selected>Aktif</option>
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
            <!-- #END# Modals utk menampilkan form input docgroup -->                 