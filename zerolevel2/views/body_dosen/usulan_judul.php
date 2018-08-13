<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

            <div class="block-header">
                <h2>USULAN JUDUL</h2>
            </div>
            
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
                        	<div class="button-demo js-modal-buttons">
                                <button type="button" class="btn btn-primary btn-lg waves-effect">Tambah Judul</button>
                            </div>
                            <!-- Tabel judul -->
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Judul</th>
                                            <th>Keywords</th>
                                            <th>Tanggal usulan</th>
                                            <th>Diusulkan ke laboratorium/studio</th>
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
                                            <td><?php echo $list['keyword'];?></td>
                                            <td><?php echo $list['tglUsul'];?></td>
                                            <td><?php echo $list['namaLabStudio'];?></td>
                                            <td><?php echo $list['status'];?></td>
                                            <td style='white-space: nowrap'>
                                                <div class="tes2">
                                                    <button type="button" class="btn btn-xs btn-warning waves-effect">Edit</button>
                                                 </div>
                                                
                                                <button type="button" class="btn btn-xs btn-danger waves-effect">Hapus</button>
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

            <!-- Modals utk menampilkan tambah judul -->
            <div class="modal fade" id="mdModal" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Tambah Judul Skripsi</h4>
                        </div>

                        <div class="modal-body">
                            <?php echo form_open(site_url('dosen/judul/tambah'),'id="form_tambah_judul"');?>
                                <div class="form-group form-float">
                                    <label class="form-label">Judul</label>
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="judul" required>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <label class="form-label">Diusulkan ke laboratorium/studio</label>
                                    <div class="form-line">
                                        <select class="form-control show-tick" data-live-search="true" name="labstudio">
                                            <option value ="">-- Pilih --</option>
                                            <?php foreach($labstudio as $list) { ?>
                                            <option value ="<?php echo $list['kodeLabStudio'];?>"><?php echo $list['namaLabStudio'];?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group form-float">
                                    <label class="form-label">Keywords</label>
                                    <div class="form-line">
                                        <input type="text" class="form-control" data-role="tagsinput" name="tags">
                                    </div>
                                    <span id="helpBlock" class="help-block small">Kata kunci bisa lebih dari satu, dipisahkan dengan tanda koma.</span>
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
            <!-- #END# Modals utk menampilkan tambah judul -->
