<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

                    <li class="header">DAFTAR MENU</li>
                    <li>
                        <a href="<?php echo site_url('dashboard');?>">
                            <i class="material-icons">home</i>
                            <span>Beranda</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('mahasiswa/profile');?>">
                            <i class="material-icons">person</i>
                            <span>My Profile</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('mahasiswa/dokumen');?>">
                            <i class="material-icons">library_books</i>
                            <span>My Documents</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">account_balance</i>
                            <span>Akademik</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">sports_kabaddi</i>
                            <span>Kemahasiswaan</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="<?php echo site_url('mahasiswa/prestasi');?>"><span>Pengajuan Data Prestasi</span></a>
                            </li>
                        </ul>
                    </li>