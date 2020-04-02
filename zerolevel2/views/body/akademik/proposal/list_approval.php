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

                            <div class="table-responsive">
                                <table class="table table-bordered actionTabel">
                                    <thead>
                                        <tr class="info">
                                            <th class="no-sort"></th>
                                            <th>Tanggal Proses</th>
                                            <th>Nama</th>
                                            <th>NIM</th>
                                            <th>Jurusan / Prodi</th>
                                            <th>SKS Lulus</th>
                                            <th>MK. Skripsi</th>
                                            <th>Pelanggaran Akademik</th>
                                            <th class="no-sort">Dokumen Pendukung</th>
                                            <th class="no-sort">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($data as $list) { ?>
                                        <tr>
                                            <td><input type="checkbox" id="md_checkbox_<?php echo $list['idProposal'];?>" class="filled-in chk-col-blue" name="check" value="<?php echo $list['idProposal'];?>"/><label for="md_checkbox_<?php echo $list['idProposal'];?>"></label>
                                            </td>
                                            <td><?php echo $list['lastDate'];?></td>
                                            <td><a href="<?php echo site_url('detail/mahasiswa/').$list['nim'];?>"><?php echo $list['nama'];?></a></td>
                                            <td><?php echo $list['nim'];?></td>
                                            <td><?php echo $list['nama_jurusan'];?> / <?php echo $list['prodi_alias'];?></td>
                                            <td><?php echo $list['sksLulus'];?></td>
                                            <td>
                                                <span class="label bg-<?php echo ($list['kontrakSkripsi']=="Sedang dikontrak" ? "green" : "orange");?>"><?php echo $list['kontrakSkripsi'];?></span>
                                            </td>
                                            <td>
                                                <span class="label bg-<?php echo ($list['pelanggaranAk']=="Tidak ada" ? "green" : "orange");?>"><?php echo $list['pelanggaranAk'];?></span>
                                            </td>
                                            <td>
                                                <?php foreach ($list['dokumen'] as $key => $value) {
                                                    echo "<a href='".$value."' target='_BLANK'>"."Dokumen ".($key+1)."</a><br/>"; 
                                                }?>
                                            </td>
                                            <td style='white-space: nowrap'>
                                                <a href="<?php echo site_url('detail/proposal/').$list['idProposal'];?>" class="btn btn-xs btn-info waves-effect" role="button">
                                                    Detail
                                                </a>
                                                <button type="button" class="btn btn-primary btn-xs waves-effect js-modal-buttons" data-toggle="modal" data-color="blue" data-target="#modalFormApproveProposal" data-form="single" data-action="approve" data-id="<?php echo $list['idProposal'];?>">Disetujui</button>
                                                <button type="button" class="btn btn-danger btn-xs waves-effect js-modal-buttons" data-toggle="modal" data-color="orange" data-target="#modalFormApproveProposal" data-form="single" data-action="reject" data-id="<?php echo $list['idProposal'];?>">Ditolak</button>
                                            </td> 
                                        </tr> 
                                        <?php }?>                         
                                    </tbody>
                                    <tfoot>
                                        <tr class="info">
                                            <td colspan="2"><img src="<?php echo base_url('images/arrow_ltr.png');?>">
                                                <input type="checkbox" id="checkAll" class="filled-in chk-col-blue"/><label for="checkAll">Pilih semua</label>
                                            </td>
                                            <td>Aksi untuk yang terpilih: </td>
                                            <td colspan="7">
                                                <button type="button" class="btn btn-primary btn-lg waves-effect js-modal-buttons" data-toggle="modal" data-color="blue" data-target="#modalFormApproveProposal" data-form="bulk" data-action="approve">Disetujui</button>
                                                <button type="button" class="btn btn-danger btn-lg waves-effect js-modal-buttons" data-toggle="modal" data-color="orange" data-target="#modalFormApproveProposal" data-form="bulk" data-action="reject">Ditolak</button>
                                            </td>
                                        </tr> 
                                    </tfoot>
                                </table>
                            </div>  

                        </div>
                    </div>
                </div>
            </div>

            <!-- Modals utk menampilkan form approval proposal -->
            <div class="modal fade modalColored" id="modalFormApproveProposal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Persetujuan Proposal Judul</h4>
                        </div>

                        <div class="modal-body">

                            <div class="table">
                                <table id="tabelApprove">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>NIM</th>
                                            <th>Jurusan</th>
                                            <th>Prodi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>

                            <?php echo form_open();?>
                                <input type="hidden" name="id">
                                <div class="form-group form-float" id="div-comment">
                                    <label class="form-label" id="label-comment">Catatan</label>
                                    <div class="form-line">
                                       <textarea rows="2" class="form-control no-resize" name="comment"></textarea>
                                    </div>
                                </div>

                                <button class="btn btn-lg waves-effect" type="submit">Disetujui</button>

                                <div class="alert">
                                     <i class="material-icons">info</i>
                                    Jika disetujui, berkas akan diteruskan ke proses selanjutnya.<br/>
                                    Jika ditolak, berkas akan dikembalikan ke mahasiswa.
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Modals utk menampilkan form approval proposal -->        