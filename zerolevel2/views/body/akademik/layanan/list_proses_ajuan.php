<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

			<div class="block-header">
                <h1><?php echo $pageTitle;?></h1>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
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

                            <div class="table-responsive">
                                <table class="table table-bordered" id="tabelApproval">
                                    <thead>
                                        <tr class="info">
                                            <th></th>
                                            <th>Nama</th>
                                            <th>Nim</th>
                                            <th>Jenis Layanan</th>
                                            <th>Informasi Tambahan</th>
                                            <th>Dokumen</th>
                                            <th>Tgl. Pengajuan</th>
                                            <th>Keterangan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($request as $list) { ?>
                                        <tr>
                                            <td><input type="checkbox" id="md_checkbox_<?php echo $list['idRequest'];?>" class="filled-in chk-col-blue" name="check" value="<?php echo $list['idRequest'];?>"/><label for="md_checkbox_<?php echo $list['idRequest'];?>"></label>
                                            </td>
                                            <td><a href="<?php echo site_url('detail/mahasiswa/').$list['nim'];?>"><?php echo $list['nama'];?></a></td>
                                            <td><?php echo $list['nim'];?></td>
                                            <td><?php echo $list['layanan'];?></td>
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
                                            <td style='white-space: nowrap'>
                                                <button type="button" class="btn btn-warning btn-xs waves-effect js-modal-buttons" data-toggle="modal" data-color="orange" data-target="#modalFormUpdateStatus" data-action="single" data-form="process" data-id="<?php echo $list['idRequest'];?>">Process</button>
                                                <button type="button" class="btn btn-danger btn-xs waves-effect js-modal-buttons" data-toggle="modal" data-color="red" data-target="#modalFormUpdateStatus" data-action="single" data-form="reject" data-id="<?php echo $list['idRequest'];?>">Reject</button>
                                                <button type="button" class="btn btn-success btn-xs waves-effect js-modal-buttons" data-toggle="modal" data-color="green" data-target="#modalFormUpdateStatus" data-action="single" data-form="done" data-id="<?php echo $list['idRequest'];?>">Done</button>
                                            
                                            </td> 
                                        </tr> 
                                        <?php }?> 
                                    </tbody>
                                    <tfoot>
                                        <tr class="info">
                                            <td colspan="3"><img src="<?php echo base_url('images/arrow_ltr.png');?>">
                                                <input type="checkbox" id="checkAll" class="filled-in chk-col-blue"/><label for="checkAll">Pilih semua</label>
                                            </td>
                                            <td colspan="8">Aksi untuk yang terpilih: &nbsp; 
                                                <button type="button" class="btn btn-warning btn-lg waves-effect js-modal-buttons" data-toggle="modal" data-color="orange" data-target="#modalFormUpdateStatus" data-action="bulk" data-form="process">Process</button>
                                                <button type="button" class="btn btn-danger btn-lg waves-effect js-modal-buttons" data-toggle="modal" data-color="red" data-target="#modalFormUpdateStatus" data-action="bulk" data-form="reject">Reject</button>
                                                <button type="button" class="btn btn-success btn-lg waves-effect js-modal-buttons" data-toggle="modal" data-color="green" data-target="#modalFormUpdateStatus" data-action="bulk" data-form="done">Done</button>
                                            </td>
                                        </tr> 
                                    </tfoot>
                                </table>
                            </div>  

                        </div>
                    </div>
                </div>
            </div>

            <!-- Modals utk menampilkan form status update -->
            <div class="modal fade modalColored" id="modalFormUpdateStatus" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel"></h4>
                        </div>

                        <div class="modal-body">

                            <div class="table">
                                <table id="tabelApprove">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Nim</th>
                                            <th>Prodi</th>
                                            <th>Jenis Layanan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>

                            <?php echo form_open(site_url('akademik/layanan/process_request'));?>

                            <input type="hidden" name="id">
                            <input type="hidden" name="status">

                            <div class="form-group form-float">
                                <label class="form-label">Keterangan</label>
                                <div class="form-line">
                                   <textarea rows="2" class="form-control no-resize" name="komentar"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-link waves-effect" type="submit">Update Status</button>
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- #END# Modals utk menampilkan form status update -->

<script type="text/javascript">
    var url_update_status = "<?php echo site_url('akademik/layanan/');?>";
</script> 
                     