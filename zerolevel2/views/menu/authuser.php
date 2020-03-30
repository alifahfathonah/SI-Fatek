<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

                    <li>
                        <a href="<?php echo site_url('data/mahasiswa');?>">
                            <i class="material-icons">people</i>
                            <span>Data Mahasiswa</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('data/alumni');?>">
                            <i class="material-icons">school</i>
                            <span>Data Alumni</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('data/dosen');?>">
                            <i class="material-icons">local_library</i>
                            <span>Data Dosen</span>
                        </a>
                    </li>  
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">library_books</i>
                            <span>Dokumen</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="<?php echo site_url('dokumen');?>">Repository Fakultas</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('dokumen/dosen');?>">Dokumen Dosen</a>
                            </li>
                            
                        </ul>
                    </li>

