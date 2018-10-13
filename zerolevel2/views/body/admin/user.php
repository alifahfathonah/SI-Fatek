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
                                <button type="button" class="btn btn-primary btn-lg waves-effect" data-toggle="modal" data-target="#modalFormUser" data-form="formTambah">Tambah</button>
                            </div>

                            <div class="table-responsive">
                                <table id="tabelData" class="table table-bordered table-striped table-hover dataTable basicTabel">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Username</th>
                                            <th>Grup</th>
                                            <th>Nama Unit</th>
                                            <th>Position</th>
                                            <th>Kode Unit</th>
                                            <th>Last Login</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody> 
                                        <?php foreach($users as $list) { ?>
                                        <tr>
                                            <td><?php echo $list['nama'];?></td>
                                            <td><?php echo $list['username'];?></td>
                                            <td><?php echo $list['grup'];?></td>
                                            <td><?php echo $list['namaUnit'];?></td>
                                            <td><?php echo $list['position'];?></td>
                                            <td><?php echo $list['kodeUnit'];?></td>
                                            <td><?php echo $list['lastLogin'];?></td>
                                            <td style='white-space: nowrap'>
                                                <button type="button" class="btn btn-xs btn-warning waves-effect" data-toggle="modal" data-target="#modalFormUser" data-form="formEdit" data-id="<?php echo $list['userId'];?>">Edit</button>
                                                <button class="btn btn-xs btn-danger waves-effect buttonHapus" data-id="<?php echo $list['userId'];?>">Delete</button>
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

            <!-- Modals utk menampilkan form input user -->
            <div class="modal fade" id="modalFormUser" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Tambah User</h4>
                        </div>

                        <div class="modal-body">
                            <?php echo form_open(site_url('admin/user/tambah'));?>
                                <input type="hidden" name="id">
                                <div class="form-group form-float">
                                    <label class="form-label">Nama</label>
                                    <div class="form-line">
                                        <input type="text" name="nama" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <label class="form-label">Username</label>
                                    <div class="form-line">
                                        <input type="text" name="username" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <label class="form-label">Grup</label>
                                    <div class="form-line">
                                        <select class="form-control show-tick" data-live-search="true" name="grup">
                                            <option value="fakultas" selected>Fakultas</option>
                                            <option value="wd">WD</option>
                                            <option value="jurusan">Jurusan</option>
                                            <option value="prodi">Prodi</option>
                                            <option value="lab/studio">Lab / Studio</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <label class="form-label">Nama Unit</label>
                                    <div class="form-line">
                                        <input type="text" name="namaUnit" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <label class="form-label">Posisi</label>
                                    <div class="form-line">
                                        <input type="text" name="position" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <label class="form-label">Kode Unit</label>
                                    <div class="form-line">
                                        <input type="text" name="kodeUnit" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <label class="form-label">Password</label>
                                    <div class="form-line">
                                        <input type="password" name="password" class="form-control">
                                    </div>
                                    <small><span class="pass-empty"></span></small>
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
            <!-- #END# Modals utk menampilkan form input user -->                 