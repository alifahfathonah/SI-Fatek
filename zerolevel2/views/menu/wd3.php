<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

                    <li class="header">MENU WAKIL DEKAN III</li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">sports_kabaddi</i>
                            <span>Kemahasiswaan</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="javascript:void(0);" class="menu-toggle">
                                    <i class="material-icons">emoji_events</i>
                                    <span>Prestasi Mahasiswa</span>
                                </a>
                                <ul class="ml-menu">
                                    <li>
                                        <a href="<?php echo site_url('kemahasiswaan/prestasi');?>">
                                            <span>Daftar Prestasi</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo site_url('kemahasiswaan/prestasi/verifikasi');?>">
                                            <span>Verifikasi Ajuan Prestasi</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="menu-toggle">
                                    <i class="material-icons">sentiment_very_dissatisfied</i>
                                    <span>Disiplin Akademik</span>
                                </a>
                                <ul class="ml-menu">
                                    <li>
                                        <a href="<?php echo site_url('kemahasiswaan/disiplin');?>">
                                            <span>Daftar Disiplin Akademik</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo site_url('kemahasiswaan/disiplin/lists');?>">
                                            <span>Data Disiplin Akademik</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>

