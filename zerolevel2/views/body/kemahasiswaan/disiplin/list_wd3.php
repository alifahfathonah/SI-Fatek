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

                            <div class="button-demo">
                                <button type="button" class="btn btn-primary btn-lg waves-effect" data-toggle="modal" data-target="#modalFormDisiplin" data-form="formTambah">Tambah</button>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered" id="tabelData">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Mahasiswa</th>
                                            <th>Keterangan</th>
                                            <th>Tgl. Mulai</th>
                                            <th>Tgl. Selesai</th>
                                            <th class="no-sort">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=1;?>
                                        <?php foreach($disiplin as $list) { ?>
                                        <tr>
                                            <td><?php echo $i;?></td>
                                            <td>
                                                <?php foreach ($list['mahasiswa'] as $key) {?>
                                                    <a href="<?php echo site_url('detail/mahasiswa/').$key['nim'];?>" target="_BLANK"><?php echo $key['nama'];?></a><br/>
                                                <?php }?>
                                            </td>
                                            <td><?php echo $list['disiplin'];?></td>
                                            <td><?php echo $list['tglStart'];?></td>
                                            <td><?php echo $list['tglEnd'];?></td>
                                            <td style='white-space: nowrap'>
                                                <button type="button" class="btn btn-xs btn-warning waves-effect" data-toggle="modal" data-target="#modalFormDisiplin" data-form="formEdit" data-id="<?php echo $list['idDisiplin'];?>">Edit</button>
                                                <button class="btn btn-xs btn-danger waves-effect buttonHapus" data-id="<?php echo $list['idDisiplin'];?>">Delete</button>
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

            <!-- Modals utk menampilkan form Prestasi -->
            <div class="modal fade" id="modalFormDisiplin" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Disiplin Akademik</h4>
                        </div>

                        <div class="modal-body">
                            <?php echo form_open(site_url('kemahasiswaan/disiplin/tambah'));?>
                                <input type="hidden" name="id">
                                <div class="form-group form-float">
                                    <label class="form-label">Tag Mahasiswa</label>
                                    <small>(Tandai nama-nama mahasiswa yang mendapat disiplin ini)</small>
                                    <div class="form-line">
                                        <input id="tags-input-mhs" name="mhsdoc" required="true">
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <label class="form-label">Keterangan</label>
                                    <div class="form-line">
                                        <textarea rows="5" class="form-control no-resize" placeholder="Berikan keterangan atau penjelasan tentang disiplin ini" name="disiplin" required></textarea>
                                    </div>
                                </div>

                                <div class="form-group form-float">
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <label class="form-label">Berlaku mulai tanggal</label>
                                            <div class="form-line">
                                                <input type="text" name="tglStart" class="datepicker form-control">
                                            </div>
                                        </div>
                                        <div class="col-xs-6">
                                            <label class="form-label">Berlaku s/d tanggal</label>
                                            <div class="form-line">
                                                <input type="text" name="tglEnd" class="datepicker form-control">
                                            </div>
                                        </div>
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
            <!-- #END# Modals utk menampilkan form Prestasi -->

<script type="text/javascript">
    var prefetch_mhs = "<?php echo URL_API.'daftar/mahasiswa/2';?>";
</script>               