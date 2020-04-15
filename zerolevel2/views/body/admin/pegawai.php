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
                                <button type="button" class="btn btn-primary btn-lg waves-effect" data-toggle="modal" data-target="#modalFormPegawai" data-form="formTambah">Tambah</button>
                            </div>

                            <div class="table-responsive">
                                <table id="tabelData" class="table table-bordered table-striped table-hover dataTable tabelDosen">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Nip</th>
                                            <th>Status</th>
                                            <th>Last Update</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody> 
                                        <?php $i=1;?>
                                        <?php foreach($pegawai as $list) { ?>
                                        <tr>
                                            <td><?php echo $i;?></td>
                                            <td><a href="<?php echo site_url('admin/pegawai/detail/'.$list['idPegawai']);?>"><?php echo $list['nama'];?></a></td>
                                            <td><?php echo $list['nip'];?></td>
                                            <td><?php echo $list['status'];?></td>
                                            <td><?php echo $list['tglUpdate'];?></td>
                                            <td style='white-space: nowrap'>
                                                <button type="button" class="btn btn-xs btn-warning waves-effect" data-toggle="modal" data-target="#modalFormPegawai" data-form="formEdit" data-id="<?php echo $list['idPegawai'];?>">Edit</button>
                                                <button class="btn btn-xs btn-danger waves-effect buttonHapus" data-id="<?php echo $list['idPegawai'];?>">Delete</button>
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

            <!-- Modals utk menampilkan form input pegawai -->
            <div class="modal fade" id="modalFormPegawai" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Tambah Pegawai</h4>
                        </div>

                        <div class="modal-body">
                            <?php echo form_open(site_url('admin/pegawai/tambah'));?>
                                <input type="hidden" name="id">
                                <div class="form-group form-float">
                                    <label class="form-label">Nama</label>
                                    <div class="form-line">
                                        <input type="text" name="nama" class="form-control" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <label class="form-label">Nip</label>
                                            <div class="form-line">
                                                <input type="number" name="nip" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-xs-6">
                                            <label class="form-label">Tanggal Lahir</label>
                                            <div class="form-line">
                                                <input type="text" name="tglLahir" class="datepicker form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Alamat Rumah</label>
                                    <div class="form-line">
                                        <input type="text" name="alamat" class="form-control">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <label class="form-label">Email</label>
                                            <div class="form-line">
                                                <input type="email" name="email" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-xs-6">
                                            <label class="form-label">Nomor HP</label>
                                            <div class="form-line">
                                                <input type="number" name="hp" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Password</label>
                                    <div class="form-line">
                                        <input type="text" name="password" class="form-control">
                                    </div>
                                    <small><span class="pass-empty"></span></small>
                                </div>

                                <div class="form-group">
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
            <!-- #END# Modals utk menampilkan form input pegawai -->           