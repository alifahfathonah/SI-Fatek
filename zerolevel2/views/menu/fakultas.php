<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

                    <li class="header">DAFTAR MENU</li>
                    <li>
                        <a href="<?php echo site_url('fakultas/dashboard');?>">
                            <i class="material-icons">dashboard</i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">people</i>
                            <span>Data Mahasiswa</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="<?php echo site_url('fakultas/data/mahasiswa');?>">Mahasiswa Aktif</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('admin/data/mahasiswa/angkatan/'.(date('Y')-4));?>">Per Angkatan</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('admin/data/mahasiswa/all');?>">Semua Mahasiswa</a>
                            </li>
                            
                        </ul>
                    </li>                    
                    <li>
                        <a href="<?php echo site_url('fakultas/data/alumni');?>">
                            <i class="material-icons">school</i>
                            <span>Data Alumni</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('fakultas/data/dosen');?>">
                            <i class="material-icons">local_library</i>
                            <span>Data Dosen</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('fakultas/data/pegawai');?>">
                            <i class="material-icons">person</i>
                            <span>Data Pegawai</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('admin/dokumen');?>">
                            <i class="material-icons">library_books</i>
                            <span>Dokumen Fakultas</span>
                        </a>
                    </li>