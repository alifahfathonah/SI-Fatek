<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
           <div class="col-md-8">
                <div class="row clearfix">
                    <section class="activities">
                        
                        <span class="font-18 col-blue"><i class="fa fa-fw fa-bullhorn"></i> Pengumuman</span> 
                        <?php if($authorized) {?>
                            <button type="waves-effect" class="btn btn-xs btn-primary waves-effect pull-right" data-toggle="modal" data-target="#modalFormPost" data-form="formTambah"><i class="fa fa-plus" aria-hidden="true"></i></button>
                        <?php }?>

                        <?php foreach($announce as $list) { ?>
                        <section class="event">
                            <span class="thumb-sm avatar pull-left mr-sm">
                                <img src="<?php echo $list['pic'];?>">
                            </span>
                                <a href="<?php echo $list['url'];?>"><?php echo $list['nama'];?></a>
                            </h4>
                            <p class="fs-sm text-muted small"><?php echo $list['subtitle'];?><br><?php echo $list['tanggal'];?></p>
                            <p class="fs-mini"><?php echo $list['content'];?></p>
                            <div class="attachment">
                                <small>
                                <?php if ($list['file']) {?>
                                    <?php foreach ($list['file'] as $key => $value) {?>       
                                        <a href="<?php echo $value;?>" target="_BLANK"><i class="fa fa-file" aria-hidden="true"></i> Attachment <?php echo $key+1;?></a>&nbsp;
                                    <?php }?>
                                <?php }?>
                                </small>
                            </div>
                            <footer>
                                <?php if($list['owner']) {?>
                                    <ul class="post-links pull-right" >
                                        <li><a href="#" data-toggle="modal" data-target="#modalFormPost" data-form="formEdit" data-id="<?php echo $list['idAnnounce'];?>"><i class="fa fa-edit"></i> Edit</a></a>
                                        </li>
                                        <li><a href="#" class="hapusPost" data-id="<?php echo $list['idAnnounce'];?>"><i class="fa fa-trash"></i> Delete</a>
                                        </li>
                                    </ul>
                                <?php }?>
                            </footer>
                        </section>
                        <?php }?>

                        <section class="event">
                            <span class="thumb-sm avatar pull-left mr-sm">
                                <img src="<?php echo base_url('images/logo.png');?>">
                            </span>
                                <a href="#">Administrator</a>
                            </h4>
                            <p class="fs-sm text-muted small">Wed, Apr 1 2020, 0:00 am</p>
                            <p class="fs-mini">Vivat academia! Vivant professores! Vivat membrum quod libet Vivant membra quae libet Semper sint in flore. Vivant omnes virgines Faciles, formosae. Vivant et mulieres Tenerae, amabiles Bonae, laboriosae.</p>
                            <div class="attachment"></div>
                            <footer></footer>
                        </section>
                    </section>
                </div>
            </div>

            <!-- Modals utk menampilkan form input post -->
            <div class="modal fade" id="modalFormPost" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content modal-col-light-blue">
                        <div class="modal-header">
                            <h4 class="modal-title" id="smallModalLabel">Posting Pengumuman</h4>
                            <span class="small col-white">Text max. 200 characters. Upload attachment files if necessary</span>
                        </div>
                        <div class="modal-body">
                            <?php echo form_open_multipart();?>
                                <input type="hidden" name="id">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <textarea rows="3" class="form-control no-resize" name="announce" maxlength = "200"></textarea>
                                    </div>
                                </div>

                                <div class="form-group form-float">
                                    <label class="form-label">Upload File Attachment</label>
                                    <input name="dokumen[]" type="file" multiple="">
                                    <small><span class="doc-empty"></span></small>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-link waves-effect">POSTING</button>
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">BATAL</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
            <!-- #END# Modals utk menampilkan form input post-->    

            <div class="col-md-4">

            </div>

<script type="text/javascript">
    var url_timeline = "<?php echo site_url('dashboard');?>";
</script>         