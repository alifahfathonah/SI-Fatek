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
                                <button type="button" class="btn btn-primary btn-lg waves-effect" data-toggle="modal" data-target="#modalFormLabstudio" data-form="formTambah">Tambah</button>
                            </div>

                            <div class="table-responsive">
                                <table id="tabelData" class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>Nama Lab/Studio</th>
                                            <th>Kode Jurusan</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody> 
                                        <?php foreach($labstudio as $list) { ?>
                                        <tr>
                                            <td><?php echo $list['labstudioNama'];?></td>
                                            <td><?php echo $list['labstudioJurKode'];?></td>
                                            <td style='white-space: nowrap'>
                                                <button type="button" class="btn btn-xs btn-warning waves-effect" data-toggle="modal" data-target="#modalFormLabstudio" data-form="formEdit" data-id="<?php echo $list['idLabstudio'];?>">Edit</button>
                                                <button class="btn btn-xs btn-danger waves-effect buttonHapus" data-id="<?php echo $list['idLabstudio'];?>">Delete</button>
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

            <!-- Modals utk menampilkan form input lab/studio -->
            <div class="modal fade" id="modalFormLabstudio" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Tambah Laboratorium / Studio</h4>
                        </div>

                        <div class="modal-body">
                            <?php echo form_open(site_url('admin/labstudio/tambah'));?>
                                <input type="hidden" name="id">
                                <div class="form-group form-float">
                                    <label class="form-label">Nama</label>
                                    <div class="form-line">
                                        <input type="text" name="nama" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <label class="form-label">Jurusan</label>
                                    <div class="form-line">
                                        <select class="form-control show-tick" data-live-search="true" name="jurusan">
                                            <option value="45" selected>Teknik Sipil</option>
                                            <option value="42">Arsitektur</option>
                                            <option value="43">Teknik Elektro</option>
                                            <option value="44">Teknik Mesin</option>
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
            <!-- #END# Modals utk menampilkan form input lab/studio -->                 