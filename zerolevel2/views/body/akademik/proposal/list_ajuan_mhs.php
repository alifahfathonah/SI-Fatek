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
                                <button type="button" class="btn btn-primary btn-lg waves-effect" data-toggle="modal" data-target="#modalFormProposal" data-form="formTambah">Daftar Seminar</button>
                            </div>

                            <div class="table-responsive">
                                <table id="tabelData" class="table table-bordered table-striped table-hover dataTable">
                                    <thead>
                                        <tr>
                                            <th>Judul Skripsi</th>
                                            <th>Status Terakhir</th>
                                            <th>Tanggal</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody> 
                                        <?php foreach($data as $list) { ?>
                                        <tr>
                                            <td><?php echo $list['judul'];?></td>
                                            <td><?php echo $list['lastComment'];?></td>
                                            <td><?php echo $list['lastDate'];?></td>
                                            <td style='white-space: nowrap'>
                                                <a href="<?php echo site_url('detail/proposal/').$list['idProposal'];?>" class="btn btn-xs btn-info waves-effect" role="button">
                                                    Detail
                                                </a>
                                                <?php if ($list['lastStatus'] == "proposal1") {?>
                                                <button class="btn btn-xs btn-danger waves-effect buttonHapus" data-id="<?php echo $list['idProposal'];?>">Delete</button>
                                                <?php }?>

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
            <div class="modal fade" id="modalFormProposal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Daftar Seminar Proposal</h4>
                        </div>

                        <div class="modal-body">
                            <?php echo form_open_multipart('mahasiswa/proposal/tambah');?>
                                <div class="form-group form-float">
                                    <label class="form-label">Judul Skripsi</label>
                                    <div class="form-line">
                                       <textarea rows="3" class="form-control no-resize" name="judul" required></textarea>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <label class="form-label">Jumlah SKS Lulus</label>
                                    <div class="form-line">
                                        <input type="number" name="sksLulus" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <label class="form-label">Apakah sedang mengontrak MK. Skripsi?</label>
                                            <div class="form-line">
                                                <select class="form-control show-tick" data-live-search="true" name="kontrakSkripsi">
                                                    <option value="0" selected>Tidak</option>
                                                    <option value="1">Ya</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xs-6">
                                            <label class="form-label">Apakah ada pelanggaran akademik?</label>
                                            <div class="form-line">
                                                <select class="form-control show-tick" data-live-search="true" name="pelanggaranAk">
                                                    <option value="0">Tidak</option>
                                                    <option value="1" selected>Ya</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>  

                                <div class="form-group form-float">
                                    <label class="form-label">Upload Dokumen Pendukung</label>
                                    <input name="dokumen[]" type="file" multiple="" required>
                                </div>
                                
                                <div class="alert alert-info">
                                     <i class="material-icons">info</i>
                                    Spesifikasi File: Filetype=pdf; Max Size=5 Mb.
                                </div>

                                <button class="btn btn-primary waves-effect" type="submit">DAFTAR</button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Modals utk menampilkan form input user -->                 