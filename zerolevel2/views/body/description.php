<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

			<div class="block-header">
                <h1><?php echo $pageTitle;?></h1>
            </div>

            <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">

                            <p class="lead">Current Version : 2.7</p>
                            <h5>Change log since previous version</h5>
                            <ol>
                                <li>Tambahan fitur pegawai</li>
                                <li>Tambahan fitur edit dokumen</li>
                                <li>Tambahan fitur tagging dosen dan mahasiswa pada menu dokumen</li>
                                <li>Repository dokumen untuk semua unit kerja.</li>
                                <li>Tambahan fitur detail mahasiswa (alamat, sekolah, minat, dll), data prestasi, data disiplin (pelanggaran) akademik.</li>
                                <li>Tambahan fitur detail dosen (tanggal lahir)</li>
                                <li>Fitur baru: wall (pengumuman, bday), akademik (Layanan administrasi dan pendaftaran seminar) dan kemahasiswaan (prestasi mahasiswa dan disiplin akademik), notifikasi</li>
                            </ol>
                            
                        </div>
                    </div>

                    <div class="card">
                        <div class="header">
                            <h2>Sample Page</h2>
                        </div>
                        <div class="body">
                            <h5>User Mahasiswa</h5>
                            <ul>
                                <li>
                                    <a href="<?php echo site_url('testing/layanan');?>">
                                        Contoh Formulir Permintaan Layanan Administrasi Akademik
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('testing/seminar');?>">
                                        Contoh Formulir Pendaftaran Seminar
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('testing/prestasi');?>">
                                        Contoh Formulir Pengajuan Data Prestasi
                                    </a>
                                </li>
                            </ul>
                            
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">

                            <h2>Fitur Utama</h2>
                            <ol>
                                <li>Profil (Dosen, mahasiswa, alumni, pegawai)</li>
                                <li>Dokumen (Dosen, mahasiswa, pegawai, repository fakultas <span class="badge bg-cyan">New</span> dokumen unit kerja)</li>
                                <li>Data (Mahasiswa, alumni, dosen, sesuai unit masing-masing)</li>
                                <li>Statistik (Fakultas, jurusan, prodi, sesuai unit masing-masing)</li>
                                <li>Wall <span class="badge bg-cyan">New</span>
                                    <ul>
                                        <li>Pengumuman fakultas, jurusan, prodi.</li>
                                        <li>Dosen ultah hari ini</li>
                                    </ul>
                                </li>
                                <li>Akademik <span class="badge bg-cyan">New</span> <span class="badge bg-orange">Belum diaktifkan</span>
                                    <ul>
                                        <li>Layanan administrasi akademik,</li>
                                        <li>Pendaftaran Seminar kp/proposal/hasil/sidang</li>
                                        <li>Monitoring history disposisi berkas</li>
                                    </ul>
                                </li>
                                <li>Kemahasiswaan <span class="badge bg-cyan">New</span>
                                    <ul>
                                        <li>Prestasi Mahasiswa (Dapat diajukan oleh mahasiswa ybs atau ditambahkan langsung oleh Bidang III)</li>
                                        <li>Disiplin (Pelanggaran) akademik mahasiswa (Ditambahkan langsung oleh Bidang III)</li>
                                    </ul>
                                </li>
                                <li>Notifikasi <span class="badge bg-cyan">New</li>
                            </ol>

                            <h2>Fitur untuk Tiap-tiap user</h2>
                            <h3>Fitur untuk User Dosen</h3>
                            <ol>
                                <li>Wall (Melihat pengumuman sesuai fakultas/jurusan/prodi dosen ybs) <span class="badge bg-cyan">New</span></li>
                                <li>Profil (Profil dosen, edit profil, foto profil, profil publik)</li>
                                <li>Dokumen (Dokumen dosen yg diupload sendiri oleh dosen ybs atau dokumen yang ditag dari dosen lain atau ditag oleh unit kerja (fakultas/jurusan/prodi)) <span class="badge bg-cyan">New</span></li>
                                <li>Publikasi (Publikasi dosen)</li>
                            </ol>
                            
                            <h3>Fitur untuk User Mahasiswa</h3>
                            <ol>
                                <li>Wall (Melihat pengumuman sesuai fakultas/jurusan/prodi mahasiswa ybs)</li>
                                <li>Profil (Profil mahasiswa, data akademik, data prestasi dan data disiplin akademik)</li>
                                <li>Dokumen (Dokumen mahasiswa yang ditag oleh unit kerja (fakultas/jurusan/prodi))</li>
                                <li>Akademik <span class="badge bg-cyan">New</span> <span class="badge bg-orange">Belum diaktifkan</span>
                                    <ul>
                                        <li>Layanan administrasi akademik (Permintaan layanan administrasi akademik, seperti surat, SK, surat pengantar dan monitoring proses disposisi)</li>
                                        <li>Pendaftaran seminar (Seminar kp, proposal, seminar hasil, sidang sarjana, dan monitoring proses disposisi)</li>
                                    </ul>
                                </li>
                                <li>Kemahasiswaan <span class="badge bg-cyan">New</span>
                                    <ul>
                                        <li>Pengajuan data prestasi mahasiswa (Diajukan oleh mahasiswa, diverifikasi oleh WD3. Dapat menandai mahasiswa lain yang memiliki prestasi sama.)</li>
                                    </ul>
                                </li>
                            </ol>

                            <h3>Fitur untuk User Pegawai <span class="badge bg-cyan">New</span></h3>
                            <ol>
                                <li>Wall (Melihat pengumuman fakultas (Dekan, WD, Kabag)) <span class="badge bg-cyan">New</span></li>
                                <li>Profil (Profil pegawai, edit profil, foto profil)</li>
                                <li>Dokumen (Dokumen pegawai yg diupload sendiri oleh pegawai ybs atau dokumen yang ditag oleh unit kerja (fakultas/jurusan/prodi)) <span class="badge bg-cyan">New</span></li>
                            </ol>

                            <h3>Fitur untuk User Pimpinan <small>(Dekan, WD, Jurusan, Prodi)</small></h3>
                            <p><span class="badge bg-cyan">New</span> Modul pengumuman. Pimpinan fakultas (Dekan, WD, Jurusan, Prodi) dapat memposting pengumuman yang dilihat oleh dosen/mahasiswa sesuai jurusan dan prodi masing-masing.</p>

                            <h4>Dekan</h4>
                            <ol>
                                <li>Data (Mahasiswa, alumni, dosen, prestasi mahasiswa, disiplin akademik fakultas)</li>
                                <li>Statistik (Statistik fakultas)</li>
                                <li>Dokumen (Dokumen dekan, dokumen dosen fakultas)</li>
                                <li>Akademik <span class="badge bg-cyan">New</span> <span class="badge bg-orange">Belum diaktifkan</span>
                                    <ul>
                                        <li>Layanan administrasi (Disposisi permintaan yang ditujukan pada dekan, melihat daftar semua permintaan layanan administrasi untuk tingkat fakultas, dan melihat detail berkas termasuk history disposisi)</li>
                                        <li>Pendaftaran seminar (Disposisi pendaftaran yang ditujukan pada dekan, melihat daftar semua pendaftaran seminar untuk tingkat fakultas, dan melihat detail berkas termasuk history disposisi)</li>
                                    </ul>
                                </li>
                            </ol>

                            <h4>WD 1</h4>
                            <ol>
                                <li>Data fakultas (Mahasiswa, alumni, dosen, prestasi mahasiswa, disiplin akademik fakultas)</li>
                                <li>Statistik (Statistik fakultas)</li>
                                <li>Dokumen (Dokumen wd1, dokumen dosen fakultas)</li>
                                <li>Akademik <span class="badge bg-cyan">New</span> <span class="badge bg-orange">Belum diaktifkan</span>
                                    <ul>
                                        <li>Layanan administrasi (Disposisi permintaan yang ditujukan pada wd1, melihat daftar semua permintaan layanan administrasi untuk tingkat fakultas, dan melihat detail berkas termasuk history disposisi)</li>
                                        <li>Pendaftaran seminar (Disposisi pendaftaran yang ditujukan pada wd1, melihat daftar semua pendaftaran seminar untuk tingkat fakultas, dan melihat detail berkas termasuk history disposisi)</li>
                                    </ul>
                                </li>
                            </ol>

                            <h4>WD 2</h4>
                            <ol>
                                <li>Data fakultas (Mahasiswa, alumni, dosen, prestasi mahasiswa, disiplin akademik fakultas)</li>
                                <li>Statistik (Statistik fakultas)</li>
                                <li>Dokumen (Dokumen wd2, dokumen dosen fakultas)</li>
                            </ol>

                            <h4>WD 3</h4>
                            <ol>
                                <li>Data fakultas (Mahasiswa, alumni, dosen, prestasi mahasiswa, disiplin akademik fakultas)</li>
                                <li>Statistik (Statistik fakultas)</li>
                                <li>Dokumen (Dokumen wd3, dokumen dosen fakultas)</li>
                                <li>Kemahasiswaan <span class="badge bg-cyan">New</span>
                                    <ul>
                                        <li>Prestasi Mahasiswa (Daftar prestasi mahasiswa, Verifikasi ajuan prestasi mahasiswa)</li>
                                        <li>Disiplin Akademik (Tambah data disiplin (pelanggaran))</li>
                                    </ul>
                                </li>
                            </ol>

                            <h4>Jurusan <small>(Kajur/Sekjur)</small></h4>
                            <ol>
                                <li>Data Jurusan (Mahasiswa, alumni, dosen, prestasi mahasiswa, disiplin akademik jurusan)</li>
                                <li>Statistik (Statistik jurusan)</li>
                                <li>Dokumen (dokumen jurusan, dokumen dosen jurusan)</li>
                                <li>Akademik <span class="badge bg-cyan">New</span> <span class="badge bg-orange">Belum diaktifkan</span>
                                    <ul>
                                        <li>Layanan administrasi (Disposisi permintaan yang ditujukan pada jurusan, melihat daftar semua permintaan layanan administrasi untuk tingkat jurusan, dan melihat detail berkas termasuk history disposisi)</li>
                                        <li>Pendaftaran Seminar (Disposisi pendaftaran yang ditujukan pada jurusan, melihat daftar semua pendaftaran seminar untuk tingkat jurusan, dan melihat detail berkas termasuk history disposisi)</li>
                                    </ul>
                                </li>
                            </ol>

                            <h4>Prodi <small>(Koprodi)</small></h4>
                            <ol>
                                <li>Data Prodi (Mahasiswa, alumni, dosen, prestasi mahasiswa, disiplin akademik prodi)</li>
                                <li>Statistik (Statistik prodi)</li>
                                <li>Dokumen (dokumen prodi, dokumen dosen prodi)</li>
                                <li>Akademik <span class="badge bg-cyan">New</span> <span class="badge bg-orange">Belum diaktifkan</span>
                                    <ul>
                                        <li>Layanan administrasi (Disposisi permintaan yang ditujukan pada prodi, melihat daftar semua permintaan layanan administrasi untuk tingkat prodi, dan melihat detail berkas termasuk history disposisi)</li>
                                        <li>Pendaftaran Seminar (Disposisi pendaftaran yang ditujukan pada prodi, melihat daftar semua pendaftaran seminar untuk tingkat prodi, dan melihat detail berkas termasuk history disposisi)</li>
                                    </ul>
                                </li>
                            </ol>


                        </div>
                    </div>
                </div>
            </div>

        
             