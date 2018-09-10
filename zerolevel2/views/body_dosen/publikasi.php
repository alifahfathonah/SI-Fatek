<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

			<div class="block-header">
                <h2>Publikasi</h2>
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
                                <table id="tabel-publikasi" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Tahun</th>
                                            <th>Judul Publikasi</th>
                                            <th>Jurnal/Prosiding</th>
                                        </tr>
                                    </thead>
                                    <tbody> 
                                        <?php foreach($publikasi as $list) { ?>
                                        <tr>
                                            <td><?php echo $list['tahun'];?></td>
                                            <td><?php echo $list['judul'];?></td>
                                            <td><?php echo $list['di']." ".$list['tempat'];?></td>
                                        </tr> 
                                        <?php }?>                           
                                    </tbody>
                                </table>
                            </div>  

                        </div>
                    </div>
                </div>
            </div>