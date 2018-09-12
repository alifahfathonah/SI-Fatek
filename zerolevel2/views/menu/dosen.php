<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

                    <li>
                        <a href="<?php echo site_url('dosen');?>">
                            <i class="material-icons">home</i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">person</i>
                            <span>Profile</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="<?php echo site_url('dosen/profile/edit');?>">Edit Profile</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('public/dosen/id/'.$this->session->userdata['logged_in_portal']['dosen']['nip']);?>" target="_blank">Public Profile</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="<?php echo site_url('dosen/publikasi');?>">
                            <i class="material-icons">import_contacts</i>
                            <span>Publikasi</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('dosen/document');?>">
                            <i class="material-icons">library_books</i>
                            <span>Dokumen</span>
                        </a>
                    </li>