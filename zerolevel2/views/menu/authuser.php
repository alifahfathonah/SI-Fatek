<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">home_work</i>
                            <span>Data</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="<?php echo site_url('data/mahasiswa');?>">
                                    <i class="material-icons">people</i>
                                    <span>Mahasiswa</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('data/alumni');?>">
                                    <i class="material-icons">school</i>
                                    <span>Alumni</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('data/dosen');?>">
                                    <i class="material-icons">local_library</i>
                                    <span>Dosen</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('data/prestasi-mahasiswa');?>">
                                    <i class="material-icons">emoji_events</i>
                                    <span>Prestasi Mahasiswa</span>
                                </a>
                            </li>  
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">library_books</i>
                            <span>Dokumen</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="<?php echo site_url('dokumen');?>">
                                    <i class="material-icons">archive</i>
                                    <span>Repository</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('dokumen/dosen');?>">
                                    <i class="material-icons">folder_shared</i>
                                    <span>Dokumen Dosen</span>
                                </a>
                            </li>
                            
                        </ul>
                    </li>

