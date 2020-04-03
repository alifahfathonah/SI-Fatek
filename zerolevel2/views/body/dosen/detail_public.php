<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="col-xs-12 col-sm-4 col-md-4">
                                <img src="<?php echo $dosen['foto'];?>" class="img-responsive img-thumbnail foto-dosen" alt=""/>
                            </div>
                            <div class="col-xs-12 col-sm-8 col-md-8">
                                <blockquote>
                                    <h3 id="nama"><?php echo $dosen['nama'];?></h3>
                                    <?php if ($dosen['jabatan']) {?>
                                        <small><?php echo $dosen['jabatan'];?></small>
                                    <?php }?>
                                </blockquote>

                                <?php if ($dosen['bio']) {?>
                                <div class="well well-sm">
                                    <span class="biografi"><?php echo $dosen['bio'];?></span>
                                </div>
                                <?php }?>

                                <dl class="dl-horizontal">
                                    
                                    <dt>ID</dt>
                                    <dd id="id"><?php echo $dosen['nip'];?></dd>
                                    
                                    <dt>Office</dt>
                                    <dd id="office"><?php echo $dosen['alamat'];?></dd>

                                    <dt>Email</dt>
                                    <dd id="office"><?php echo $dosen['email'];?></dd>

                                    <dt>Departement</dt>
                                    <dd id="departement"><?php echo $dosen['jurusan']." / ".$dosen['prodi'];?></dd>
                                    
                                    <dt>Research Field</dt>
                                    <dd id="interest"><?php echo $dosen['interest'];?></dd>

                                </dl>
<!-- 
                                <h4>Education</h4>

                                <div class="table-responsive">
                                    <table id="tabel-pendidikan" class="table table-hover">
                                        <tbody> 
                                        <?php foreach($edu as $list) { ?>
                                            <tr>
                                                <td><?php echo $list->tahunLulus;?></td>
                                                <td><?php echo $list->jenjang." ".$list->bidangIlmu;?></td>
                                                <td><?php echo $list->pt." ".$list->lokasi;?></td>
                                            </tr> 
                                            <?php }?>                       
                                        </tbody>
                                    </table>
                                </div>
 -->
                                <h4>Publication</h4>

                                <div class="list-group">

                                    <?php if ($dosen['sintaId']) {?> <a href="<?php echo $dosen['sintaId'];?>" target="_blank" class="list-group-item list-group-item-action">Science and Technology Index</a><?php }?>
                                    <?php if ($dosen['googleId']) {?> <a href="<?php echo $dosen['googleId'];?>" target="_blank" class="list-group-item list-group-item-action">Google Scholar</a><?php }?>
                                    <?php if ($dosen['scopusId']) {?> <a href="<?php echo $dosen['scopusId'];?>" target="_blank" class="list-group-item list-group-item-action">Scopus Author</a><?php }?>

                                </div>
                                
                                <div class="table-responsive">
                                    <table id="tabel-publikasi" class="table table-hover">
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
            </div>