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
                                <button type="button" class="btn btn-primary btn-lg waves-effect" data-toggle="modal" data-target="#modalFormDosen" data-form="formTambah">Tambah</button>
                            </div>

                            <div class="table-responsive">
                                <table id="tabelData" class="table table-bordered table-striped table-hover dataTable tabelDosen">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Nip</th>
                                            <th>Jurusan</th>
                                            <th>Prodi</th>
                                            <th>Last Update</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody> 
                                        <?php $i=1;?>
                                        <?php foreach($dosen as $list) { ?>
                                        <tr>
                                            <td><?php echo $i;?></td>
                                            <td><a href="<?php echo site_url('admin/dosen/detail/'.$list['nip']);?>"><?php echo $list['nama'];?></a></td>
                                            <td><?php echo $list['nip'];?></td>
                                            <td><?php echo $list['jurusan'];?></td>
                                            <td><?php echo $list['prodi'];?></td>
                                            <td><?php echo $list['tglUpdate'];?></td>
                                            <td style='white-space: nowrap'>
                                                <button type="button" class="btn btn-xs btn-warning waves-effect" data-toggle="modal" data-target="#modalFormDosen" data-form="formEdit" data-id="<?php echo $list['dosenId'];?>">Edit</button>
                                                <button class="btn btn-xs btn-danger waves-effect buttonHapus" data-id="<?php echo $list['dosenId'];?>">Delete</button>
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

            <!-- Modals utk menampilkan form input lab/studio -->
            <div class="modal fade" id="modalFormDosen" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Tambah Dosen</h4>
                        </div>

                        <div class="modal-body">
                            <?php echo form_open(site_url('admin/dosen/tambah'));?>
                                <input type="hidden" name="id">
                                <div class="form-group form-float">
                                    <label class="form-label">Nama</label>
                                    <div class="form-line">
                                        <input type="text" name="nama" class="form-control" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <label class="form-label">Nip</label>
                                            <div class="form-line">
                                                <input type="number" name="nip" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-xs-4">
                                            <label class="form-label">NIDN</label>
                                            <div class="form-line">
                                                <input type="number" name="nidn" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-xs-4">
                                            <label class="form-label">Kode Pegawai</label>
                                            <div class="form-line">
                                                <input type="number" name="kodePegawai" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <label class="form-label">Jabatan Struktural</label>
                                            <div class="form-line">
                                                <input type="text" name="jabatan" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-xs-6">
                                            <label class="form-label">Alamat Kantor</label>
                                            <div class="form-line">
                                                <input type="text" name="alamat" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <label class="form-label">Jurusan</label>
                                            <div class="form-line">
                                                <select class="form-control show-tick" data-live-search="true" name="jurusan">
                                                    <option value="45|TEKNIK SIPIL" selected>TEKNIK SIPIL</option>
                                                    <option value="42|ARSITEKTUR">ARSITEKTUR</option>
                                                    <option value="43|TEKNIK ELEKTRO">TEKNIK ELEKTRO</option>
                                                    <option value="44|TEKNIK MESIN">TEKNIK MESIN</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xs-6">
                                            <label class="form-label">Program Studi</label>
                                            <div class="form-line">
                                                <select class="form-control show-tick" data-live-search="true" name="prodi">
                                                    <option value="14|TEKNIK SIPIL" selected>TEKNIK SIPIL</option>
                                                    <option value="94|TEKNIK LINGKUNGAN">TEKNIK LINGKUNGAN</option>
                                                    <option value="15|ARSITEKTUR">ARSITEKTUR</option>
                                                    <option value="16|PERENCANAAN WILAYAH DAN KOTA">PERENCANAAN WILAYAH DAN KOTA</option>
                                                    <option value="12|TEKNIK ELEKTRO">TEKNIK ELEKTRO</option>
                                                    <option value="77|INFORMATIKA">INFORMATIKA</option>
                                                    <option value="13|TEKNIK MESIN">TEKNIK MESIN</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <label class="form-label">Email</label>
                                            <div class="form-line">
                                                <input type="email" name="email" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-xs-6">
                                            <label class="form-label">Nomor HP</label>
                                            <div class="form-line">
                                                <input type="number" name="hp" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <label class="form-label">Sinta ID</label>
                                            <div class="form-line">
                                                <input type="text" name="sintaId" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-xs-4">
                                            <label class="form-label">Google Scholar ID</label>
                                            <div class="form-line">
                                                <input type="text" name="googleId" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-xs-4">
                                            <label class="form-label">Scopus Author ID</label>
                                            <div class="form-line">
                                                <input type="text" name="scopusId" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Research Field</label>
                                    <div class="form-line">
                                        <input type="text" name="interest" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Biografi singkat</label>
                                    <div class="form-line">
                                        <textarea rows="4" class="form-control no-resize" name="bio"></textarea>
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
            <!-- #END# Modals utk menampilkan form input lab/studio -->                 