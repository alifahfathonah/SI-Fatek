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
                        <div class="body">

                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="info">
                                            <th></th>
                                            <th>Diajukan Oleh</th>
                                            <th>Detail Prestasi</th>
                                            <th>Mahasiswa</th>
                                            <th>Dokumen Bukti</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($prestasi as $list) { ?>
                                        <tr>
                                            <td><input type="checkbox" id="md_checkbox_<?php echo $list['idPrestasi'];?>" class="filled-in chk-col-blue" name="check" value="<?php echo $list['idPrestasi'];?>"/><label for="md_checkbox_<?php echo $list['idPrestasi'];?>"></label>
                                            </td>
                                            <td><a href="<?php echo site_url('detail/mahasiswa/').$list['nim'];?>" target="_BLANK"><?php echo $list['nama'];?></a></td>
                                            <td>
                                                <?php echo $list['prestasi'];?><br/>
                                                <?php echo $list['even'];?><br/>
                                                Tingkat : <?php echo $list['tingkat'];?><br/>
                                                Tanggal : <?php echo $list['tglLomba'];?><br/>
                                            </td>
                                            <td>
                                                <?php foreach ($list['mahasiswa'] as $key) {?>
                                                    <a href="<?php echo site_url('detail/mahasiswa/').$key['nim'];?>" target="_BLANK"><?php echo $key['nama'];?></a><br/>
                                                <?php }?>
                                            </td>
                                            <td>
                                                <?php foreach ($list['bukti'] as $key => $value) {
                                                    echo "<a href='".$value."' target='_BLANK'>"."Dokumen ".($key+1)."</a><br/>";
                                                }?>
                                            </td>
                                            <td><?php echo $list['status'];?></td>
                                            <td style='white-space: nowrap'>
                                                <button type="button" class="btn btn-warning btn-xs waves-effect js-modal-buttons" data-toggle="modal" data-color="orange" data-target="#modalFormApproval" data-form="single" data-action="approve" data-id="<?php echo $list['idPrestasi'];?>">Disetujui</button>
                                                <button type="button" class="btn btn-danger btn-xs waves-effect js-modal-buttons" data-toggle="modal" data-color="red" data-target="#modalFormApproval" data-form="single" data-action="reject" data-id="<?php echo $list['idPrestasi'];?>">Ditolak</button>
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
                                                <button type="button" class="btn btn-warning btn-lg waves-effect js-modal-buttons" data-toggle="modal" data-color="orange" data-target="#modalFormApproval" data-form="bulk" data-action="approve">Disetujui</button>
                                                <button type="button" class="btn btn-danger btn-lg waves-effect js-modal-buttons" data-toggle="modal" data-color="red" data-target="#modalFormApproval" data-form="bulk" data-action="reject">Ditolak</button>
                                            </td>
                                        </tr> 
                                    </tfoot>
                                </table>
                            </div>  

                        </div>
                    </div>
                </div>
            </div>

            <!-- Modals utk menampilkan form approval -->
            <div class="modal fade modalColored" id="modalFormApproval" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Ajuan Prestasi Mahasiswa <span class="subtitle"></span></h4>
                        </div>

                        <div class="modal-body">
                            <div class="table">
                                <table id="tabelApprove">
                                    <thead>
                                        <tr>
                                            <th>Diajukan oleh</th>
                                            <th>Ranking</th>
                                            <th>Event</th>
                                            <th>Tanggal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>

                            <?php echo form_open();?>
                                <input type="hidden" name="id">
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-lg waves-effect" type="submit">Disetujui</button>
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- #END# Modals utk menampilkan form approval -->

<script type="text/javascript">
    var url_verikasi = "<?php echo site_url('kemahasiswaan/prestasi/');?>";
</script>           
             