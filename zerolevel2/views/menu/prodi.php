<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

                    <li class="header">MENU PRODI</li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">account_balance</i>
                            <span>Akademik</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="javascript:void(0);" class="menu-toggle">
                                    <i class="material-icons">dynamic_feed</i>
                                    <span>Layanan Administrasi</span>
                                </a>
                                <ul class="ml-menu">
                                    <li>
                                        <a href="<?php echo site_url('akademik/layanan');?>">
                                            <span>Disposisi Permintaan</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo site_url('akademik/layanan/list');?>">
                                            <span>List Permintaan</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>