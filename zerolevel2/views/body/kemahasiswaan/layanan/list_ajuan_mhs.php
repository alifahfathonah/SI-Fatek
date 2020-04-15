<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

			<div class="block-header">
                <h1><?php echo $pageTitle;?></h1>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
                            <p>Layanan administrasi kemahasiswaan adalah layanan online yang dapat digunakan mahasiswa untuk permintaan atau pengajuan surat-surat yang berhubungan dengan bidang kemahasiswaan, seperti:</p>
                            <ol>
                                <?php foreach ($layanan as $key) {?>
                                    <li><?php echo $key['formField'];?></li>
                                <?php }?>
                            </ol>

                        </div>
                        <div class="header">
                            <h2><?php echo $subtitle;?></h2>
                        </div>
                        <div class="body">

                            <?php if($this->session->flashdata('message')) {?>  
                            <div class="alert alert-dismissable alert-<?php echo $this->session->flashdata('type');?>">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <?php echo $this->session->flashdata('message');?>
                            </div>
                            <?php }?>  


                            <div class="button-demo">
                                <button type="button" class="btn btn-primary btn-lg waves-effect" data-toggle="modal" data-target="#modalFormLayananAkademik" data-form="formTambah"><i class="fa fa-fw fa-plus" aria-hidden="true"></i> Ajukan Permintaan</button>
                            </div>

                            <div class="table-responsive">
                                <table id="tabelData" class="table table-bordered table-striped dataTable">
                                    <thead>
                                        <tr>
                                            <th width="10">No</th>
                                            <th width="100">Jenis Layanan</th>
                                            <th>Informasi Tambahan</th>
                                            <th width="30">Dokumen</th>
                                            <th width="50">Tanggal Pengajuan</th>
                                            <th width="50">Keterangan</th>
                                            <th width="70">Status</th>
                                            <th width="50">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=1;?>
                                        <?php foreach($request as $list) { ?>
                                        <tr>
                                            <td><?php echo $i;?></td>
                                            <td><?php echo $list['jenisLayanan'];?></td>
                                            <td><?php echo $list['infoTambahan'];?></td>
                                            <td>
                                                <?php if ($list['file']) { 
                                                    foreach ($list['file'] as $key => $value) {
                                                        echo "<a href='".$value."' target='_BLANK'>"."File".($key+1)."</a> ";
                                                    }
                                                }?>
                                            </td>
                                            <td><?php echo $list['tglRequest'];?></td>
                                            <td><?php echo $list['komentar'];?></td>
                                            <td>
                                                <span class="label bg-<?php echo $list['prosesColor'];?>"><?php echo $list['prosesStatus'];?></span>
                                            </td>
                                            <td style='white-space: nowrap'>
                                                <a href="<?php echo site_url('mahasiswa/layanan-akademik/detail/').$list['idRequest'];?>" class="btn btn-xs btn-info waves-effect" role="button">
                                                    Detail
                                                </a>
                                                <?php if ($list['authorized']) {?>
                                                <button class="btn btn-xs btn-danger waves-effect buttonHapus" data-id="<?php echo $list['idRequest'];?>">Delete</button>
                                                <?php }?>
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

            <!-- Modals utk menampilkan form input user -->
            <div class="modal fade" id="modalFormLayananAkademik" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel"></h4>
                        </div>

                        <div class="modal-body">
                            <?php echo form_open_multipart();?>
                                <input type="hidden" name="id">
                                <input type="hidden" name="jenisLayanan">
                                <div class="form-group form-float">
                                    <label class="form-label">Jenis Layanan</label>
                                    <div class="form-line">
                                        <select class="form-control show-tick" id="jenisLayanan" required>
                                            <option value="">Pilih jenis layanan</option>
                                            <?php foreach ($layanan as $key) {?>
                                                <option value="<?php echo $key['idReqField'];?>"><?php echo $key['formField'];?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group form-float" id="divInfo">
                                    <label class="form-label">Informasi Tambahan</label>
                                    <div class="form-line">
                                       <textarea rows="2" class="form-control no-resize" name="infoTambahan"></textarea>
                                    </div>
                                </div>

                                <div id="divFile"> 
                                    <div class="form-group form-float">
                                        <label class="form-label" id="judulDok">Upload Dokumen</label> 
                                        <small class="col-red"><span class="fileinfo"></span></small>
                                        <input name="dokumen[]" type="file" multiple="">
                                    </div>
                                    
                                    <div class="alert alert-info">
                                         <i class="material-icons">info</i>
                                        Spesifikasi File: Filetype=pdf|jpg|jpeg; Max size=3 Mb utk tiap file;
                                    </div>
                                </div>

                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-link waves-effect" type="submit">SUBMIT</button>
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- #END# Modals utk menampilkan form input user -->
                     