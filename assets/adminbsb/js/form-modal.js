/*!
 * Custom Javascript for Bootstrap Admin BSB Material Design 
 * 
 * Crafted by: 
 * Xaverius Najoan      xnajoan@gmail.com
 * 
 *
 *
 */

// Script untuk modal with AJAX request (JQuery Plugin: Select Plugin, Bootstrap Tags Input, SweetAlert)
$(function () {

    // Modal form Publikasi
    $('#modalFormPublikasi').on('show.bs.modal', function (event) {

        var button = $(event.relatedTarget);
        var id = button.data('id');
        var form = button.data('form');
        $(this).find('form')[0].reset();
        $('form').validate().resetForm();
        $('form [name="id"]').val('');
        $('form [name="tahun"]').selectpicker("refresh");

        if (form == "formTambah") {
            $(this).find('form').attr('action', window.location.href + '/tambah');
            $(this).find(':submit').addClass('buttonTambah').removeClass('buttonEdit');
            $(this).find('.modal-title').text('Tambah Publikasi')
        }
        else if (form == "formEdit") {
            $(this).find(':submit').addClass('buttonEdit').removeClass('buttonTambah');
            $(this).find('form').attr('action', window.location.href + '/edit');
            $(this).find('.modal-title').text('Edit Publikasi');

            $.ajax({
                url : window.location.href + '/detail/' + id,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                    $('form [name="id"]').val(data.idPublikasi);
                    $('form [name="judul"]').val(data.judul);
                    $('form [name="jurnal"]').val(data.di);
                    $('form [name="tempat"]').val(data.tempat);
                    $('form [name="tahun"]').selectpicker('val',data.tahun);

                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        }
    });

    // Modal form Kelola user
    $('#modalFormUser').on('show.bs.modal', function (event) {
        
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var form = button.data('form');
        $(this).find('form')[0].reset();
        $('form').validate().resetForm();
        $('form [name="id"]').val('');
        $('form [name="grup"]').selectpicker("refresh");

        if (form == "formTambah") {

            $(this).find('form').attr('action', window.location.href + '/tambah');
            $(this).find(':submit').addClass('buttonTambah').removeClass('buttonEdit');
            $(this).find('.modal-title').text('Tambah User');
        }

        else if (form == "formEdit") {
            $(this).find(':submit').addClass('buttonEdit').removeClass('buttonTambah');
            $(this).find('form').attr('action', window.location.href + '/edit');
            $(this).find('.modal-title').text('Edit User');

            $.ajax({
                url : window.location.href + '/detail/' + id,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                    $('form [name="id"]').val(data.idUser);
                    $('form [name="nama"]').val(data.nama);
                    $('form [name="username"]').val(data.username);
                    $('form [name="grup"]').selectpicker('val',data.grup);
                    $('form [name="kodeGrup"]').val(data.kodeGrup);
                    $('form [name="namaUnit"]').val(data.namaUnit);
                    $('form [name="posisi"]').val(data.posisi);
                    $('form [name="kodeUnit"]').val(data.kodeUnit);
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        }
    });

    // Modal form Kelola kategori dokumen
    $('#modalFormDocgroup').on('show.bs.modal', function (event) {

        var button = $(event.relatedTarget);
        var id = button.data('id');
        var form = button.data('form');
        $(this).find('form')[0].reset();
        $('form').validate().resetForm();
        $('form [name="id"]').val('');

        if (form == "formTambah") {

            $(this).find('form').attr('action', window.location.href + '/tambah');
            $(this).find(':submit').addClass('buttonTambah').removeClass('buttonEdit');
            $(this).find('.modal-title').text('Tambah Kategori Dokumen');
        }

        else if (form == "formEdit") {

            $(this).find(':submit').addClass('buttonEdit').removeClass('buttonTambah');
            $(this).find('form').attr('action', window.location.href + '/edit');
            $(this).find('.modal-title').text('Edit Kategori Dokumen');

            $.ajax({
                url : window.location.href + '/detail/' + id,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                    $('form [name="id"]').val(data.idDocgroup);
                    $('form [name="nama"]').val(data.docgroupJenisDoc);
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        }
    });

    // Modal form Kelola lab/studio
    $('#modalFormLabstudio').on('show.bs.modal', function (event) {
        
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var form = button.data('form');
        $(this).find('form')[0].reset();
        $('form').validate().resetForm();
        $('form [name="id"]').val('');
        $('form [name="jurusan"]').selectpicker("refresh");

        if (form == "formTambah") {
        
            $(this).find('form').attr('action', window.location.href + '/tambah');
            $(this).find(':submit').addClass('buttonTambah').removeClass('buttonEdit');
            $(this).find('.modal-title').text('Tambah Laboratorium / Studio');
        }

        else if (form == "formEdit") {
            $(this).find(':submit').addClass('buttonEdit').removeClass('buttonTambah');
            $(this).find('form').attr('action', window.location.href + '/edit');
            $(this).find('.modal-title').text('Edit Laboratorium / Studio');

            $.ajax({
                url : window.location.href + '/detail/' + id,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                    $('form [name="id"]').val(data.idLabstudio);
                    $('form [name="nama"]').val(data.labstudioNama);
                    $('form [name="jurusan"]').selectpicker('val',data.labstudioJurKode);
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        }
    });

    // Modal form Kelola dosen
    $('#modalFormDosen').on('show.bs.modal', function (event) {
        
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var form = button.data('form');
        $(this).find('form')[0].reset();
        $('form').validate().resetForm();
        $('form [name="id"]').val('');
        $('form [name="jurusan"]').selectpicker("refresh");
        $('form [name="prodi"]').selectpicker("refresh");
        $('form [name="showInPublic"]').selectpicker("refresh");

        if (form == "formTambah") {
            $(this).find('form').attr('action', window.location.href + '/tambah');
            $(this).find(':submit').addClass('buttonTambah').removeClass('buttonEdit');
            $(this).find('.modal-title').text('Tambah Dosen');
        }

        else if (form == "formEdit") {
            $(this).find(':submit').addClass('buttonEdit').removeClass('buttonTambah');
            $(this).find('form').attr('action', window.location.href + '/edit');
            $(this).find('.modal-title').text('Edit Dosen');

            $.ajax({
                url : window.location.href + '/detail/' + id + '/json',
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                    $('form [name="id"]').val(data.idDosen);
                    $('form [name="nama"]').val(data.nama);
                    $('form [name="tglLahir"]').val(data.tglLahir);
                    $('form [name="tmt"]').val(data.tmt);
                    $('form [name="nip"]').val(data.nip);
                    $('form [name="nidn"]').val(data.nidn);
                    $('form [name="kodePegawai"]').val(data.kodePegawai);
                    $('form [name="jabatan"]').val(data.jabatan);
                    $('form [name="alamat"]').val(data.alamat);
                    $('form [name="jurusan"]').selectpicker('val',data.kodeJurusan + '|' + data.jurusan);
                    $('form [name="prodi"]').selectpicker('val',data.kodeProdi + '|' + data.prodi);
                    $('form [name="email"]').val(data.email);
                    $('form [name="hp"]').val(data.hp);
                    $('form [name="sintaId"]').val(data.sintaId);
                    $('form [name="googleId"]').val(data.googleId);
                    $('form [name="scopusId"]').val(data.scopusId);
                    $('form [name="interest"]').val(data.interest);
                    $('form [name="bio"]').val(data.bio);
                    $('form [name="status"]').selectpicker('val',data.status);
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        }
    });

    // Modal form Dokumen multipleuser
    $('#modalFormDocMultiUser').on('show.bs.modal', function (event) {
       //alert('tes');
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var form = button.data('form');
        $(this).find('form')[0].reset();
        $('form').validate().resetForm();
        $('form [name="id"]').val('');
        $('.doc-baru').text('');
        $('.doc-empty').text('');
        $('form [name="dsndoc"]').tagsinput('removeAll');
        $('form [name="mhsdoc"]').tagsinput('removeAll'); 

        if (form == "formTambah") {
            $(this).find('form').attr('action', window.location.href + '/tambah');
            $(this).find(':submit').addClass('buttonTambah').removeClass('buttonEdit');
            $(this).find('.modal-title').text('Tambah Dokumen');
            $('form [name="dokumen"]').attr("required", true);
            if (typeof loadMe !== 'undefined') {
                if (loadMe.tipe == 'peg') $('form [name="dsndoc"]').tagsinput('add', { "id": loadMe.id , "nama": loadMe.nama });
                if (loadMe.tipe == 'mhs') $('form [name="mhsdoc"]').tagsinput('add', { "id": loadMe.id , "nama": loadMe.nama });
            }
        }

        else if (form == "formEdit") {
            $(this).find(':submit').addClass('buttonEdit').removeClass('buttonTambah');
            $(this).find('form').attr('action', window.location.href + '/edit');
            $(this).find('.modal-title').text('Edit Dokumen');
            $(this).find('.doc-baru').text('Baru');
            $('form [name="dokumen"]').attr("required", false);
            $(this).find('.doc-empty').text('Biarkan kosong, jika tidak ingin mengganti dokumen');

            $.ajax({
                url : window.location.href + '/detail/' + id,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                    $('form [name="id"]').val(data.idDokumen);
                    $('form [name="nama"]').val(data.dokumenNama);
                    $('form [name="deskripsi"]').val(data.dokumenDeskripsi);
                    $('form [name="nomor"]').val(data.dokumenNomor);
                    $('form [name="jenis"]').selectpicker('val',data.dokumenDocgroupId);
                    $('form [name="tahun"]').selectpicker('val',data.dokumenTahun);

                    $.each(data.user, function(k,v) {
                        $.each(v.detail, function(key, value) {
                            if (value.tipe == 'p') {
                                $('form [name="dsndoc"]').tagsinput('add', { "id": value.id , "nama": value.nama });
                            } else {
                                $('form [name="mhsdoc"]').tagsinput('add', { "id": value.id , "nama": value.nama });
                            }
                        });
                    });
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        }        
    });

    // Modal form Prestasi
    $('#modalFormPrestasi').on('show.bs.modal', function (event) {
        
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var form = button.data('form');
        $(this).find('form')[0].reset();
        $('form').validate().resetForm();
        $('form [name="id"]').val('');
        $('form [name="tingkat"]').selectpicker("refresh");
        $('.doc-empty').text('');
        $('form [name="mhsdoc"]').tagsinput('removeAll');

        if (form == "formTambah") {
        
            $(this).find('form').attr('action', window.location.href + '/tambah');
            $(this).find('.modal-title').text('Tambah Prestasi Mahasiswa');
            $('form [name="dokumen[]"]').attr("required", true);
            if (typeof loadMe !== 'undefined') {
                if (loadMe.tipe == 'mhs') $('form [name="mhsdoc"]').tagsinput('add', { "id": loadMe.id , "nama": loadMe.nama });
            }         
        }

        else if (form == "formEdit") {
            $(this).find('form').attr('action', window.location.href + '/edit');
            $(this).find('.modal-title').text('Edit Prestasi Mahasiswa');
            $(this).find('.doc-empty').text('Biarkan kosong, jika tidak ingin mengganti dokumen');
            $('form [name="dokumen[]"]').attr("required", false);

            $.ajax({
                url : window.location.href + '/detail/' + id,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                    $('form [name="id"]').val(data.idPrestasi);
                    $('form [name="prestasi"]').val(data.prestasi);
                    $('form [name="even"]').val(data.even);
                    $('form [name="tingkat"]').selectpicker('val',data.tingkat);
                    $('form [name="tglLomba"]').val(data.tglLomba);
                    $('form [name="dokumen[]"]').attr("required", false);

                    $.each(data.user, function(k,v) {
                        $.each(v.detail, function(key, value) {
                            $('form [name="mhsdoc"]').tagsinput('add', { "id": value.id , "nama": value.nama });
    
                        });
                    });
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        }
    });

    // Modal form Disiplin
    $('#modalFormDisiplin').on('show.bs.modal', function (event) {
        
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var form = button.data('form');
        $(this).find('form')[0].reset();
        $('form').validate().resetForm();
        $('form [name="id"]').val('');
        $('form [name="mhsdoc"]').tagsinput('removeAll');

        if (form == "formTambah") {
        
            $(this).find('form').attr('action', window.location.href + '/tambah');
            $(this).find('.modal-title').text('Tambah Disiplin Akademik');    
        }

        else if (form == "formEdit") {
            $(this).find('form').attr('action', window.location.href + '/edit');
            $(this).find('.modal-title').text('Edit Disiplin Akademik');

            $.ajax({
                url : window.location.href + '/detail/' + id,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                    $('form [name="id"]').val(data.idDisiplin);
                    $('form [name="disiplin"]').val(data.disiplin);
                    $('form [name="tglStart"]').val(data.tglStart);
                    $('form [name="tglEnd"]').val(data.tglEnd);

                    $.each(data.user, function(k,v) {
                        $.each(v.detail, function(key, value) {
                            $('form [name="mhsdoc"]').tagsinput('add', { "id": value.id , "nama": value.nama });
    
                        });
                    });
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        }
    });

    // Modal form Announcement
    $('#modalFormPost').on('show.bs.modal', function (event) {
        
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var form = button.data('form');
        $(this).find('form')[0].reset();
        $('form').validate().resetForm();
        $('form [name="id"]').val('');
        $('.doc-empty').text('');

        if (form == "formTambah") {
            $(this).find(':submit').text('TEMPEL');
            $(this).find('form').attr('action', url_timeline + '/add_post');
            $(this).find('.modal-title').text('Tempel Pengumuman');
        }

        else if (form == "formEdit") {
            $(this).find(':submit').text('EDIT');
            $(this).find('form').attr('action', url_timeline + '/update_post');
            $(this).find('.modal-title').text('Edit Pengumuman');
            $(this).find('.doc-empty').text('Biarkan kosong, jika tidak ingin mengganti file attachment');

            $.ajax({
                url : url_timeline + '/detail_post/' + id,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                    $('form [name="id"]').val(data.idAnnounce);
                    $('form [name="announce"]').val(data.content);
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        }
    });

    // Modal form Approval
    $('#modalFormApproval').on('show.bs.modal', function (event) {
        
        var button = $(event.relatedTarget);
        var form = button.data('form');
        var action = button.data('action');

        if (form == "single") {
            var id = button.data('id');
        }

        else if (form == "bulk") {
            var id = [];
            $.each($("#tabelApproval input[name='check']:checked"), function(){
                id.push($(this).val());
            });
            id = id.join('-');
            if (id == "") return false;
        }

        $.ajax({
            url : url_verikasi + 'detail_approval/' + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                $.each(data, function(i, item) {
                    var $tr = $('<tr>').append(
                        $('<td>').text(item.item1),
                        $('<td>').text(item.item2),
                        $('<td>').text(item.item3),
                        $('<td>').text(item.item4)
                    );
                    $('#tabelApprove tbody').append($tr);
                });
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });

        $(this).find('form')[0].reset();
        $('form').validate().resetForm();
        $('form [name="id"]').val(id);
        $('#tabelApprove tbody').empty();

        if (action == "approve") {

            $(this).find('form').attr('action', url_verikasi + 'approve');
            $(this).find('.modal-title .subtitle').text('Disetujui!');
            $(this).find(':submit').addClass('bg-orange').removeClass('bg-red');
            $(this).find(':submit').html('DISETUJUI');

        }

        else if (action == "reject") {
            $(this).find('form').attr('action', url_verikasi + 'reject');
            $(this).find('.modal-title .subtitle').text('Ditolak!');
            $(this).find(':submit').addClass('bg-red').removeClass('bg-orange');
            $(this).find(':submit').html('DITOLAK');
        }
    });

    // Modal form Kelola Layanan
    $('#modalAdminLayanan').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var form = button.data('form');
        $(this).find('form')[0].reset();
        $('form').validate().resetForm();
        $('form [name="id"]').val('');
        $('form [name="status"]').selectpicker("refresh");

        if (form == "formTambah") {
            $(this).find('form').attr('action', window.location.href + '/tambah');
            $(this).find('.modal-title').text('Tambah Form Field');
        }

        else if (form == "formEdit") {
            $(this).find('form').attr('action', window.location.href + '/edit');
            $(this).find('.modal-title').text('Edit Form Field');

            $.ajax({
                url : window.location.href + '/detail/' + id,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                    $('form [name="id"]').val(data.idReqField);
                    $('form [name="form"]').val(data.form);
                    $('form [name="formField"]').val(data.formField);
                    $('form [name="infoRequired"]').val(data.infoRequired);
                    $('form [name="fileRequired"]').val(data.fileRequired);
                    $('form [name="urutan"]').val(data.urutan);
                    $('form [name="status"]').selectpicker('val',data.status);
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        }
    });

    // Modal form Layanan Akademik
    $('#modalFormLayananAkademik').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var form = button.data('form');
        $(this).find('form')[0].reset();
        $('form').validate().resetForm();
        $('form [name="id"]').val('');
        $('#jenisLayanan').prop("disabled", false);
        $('#jenisLayanan').selectpicker('refresh');
        $('#divInfo').hide();
        $('#divFile').hide();
        $('#judulDok').text('');
        $('.fileinfo').text('');
        $('.doc-empty').text('');
        $('form [name="infoTambahan"]').empty();

        if (form == "formTambah") {
        
            $(this).find('form').attr('action', window.location.href + '/tambah');
            $(this).find('.modal-title').text('Permintaan Layanan Administrasi Akademik');
            $('#judulDok').text('Upload Dokumen');
        }

    });

    // Modal form Seminar
    $('#modalFormSeminar').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var form = button.data('form');
        $(this).find('form')[0].reset();
        $('form').validate().resetForm();
        $('form [name="id"]').val('');
        $('form [name="jenisSeminar"]').selectpicker("refresh");
        $('#divInfo').hide();
        $('#divFile').hide();
        $('.fileinfo').text('');
        $('form [name="infoTambahan"]').empty();

        if (form == "formTambah") {
        
            $(this).find('form').attr('action', window.location.href + '/tambah');   
        }

    });

    // Modal form Update Status (Process)
    $('#modalFormUpdateStatus').on('show.bs.modal', function (event) {
        
        var button = $(event.relatedTarget);
        var form = button.data('form');
        var action = button.data('action');

        if (action == "single") {
            var id = button.data('id');
        }

        else if (action == "bulk") {
            var id = [];
            $.each($("#tabelApproval input[name='check']:checked"), function(){
                id.push($(this).val());
            });
            id = id.join('-');
            if (id == "") return false;
        }

        $.ajax({
            url : url_update_status + 'detail_approval/' + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                $.each(data, function(i, item) {
                    var $tr = $('<tr>').append(
                        $('<td>').text(item.item1),
                        $('<td>').text(item.item2),
                        $('<td>').text(item.item3),
                        $('<td>').text(item.item4)
                    );
                    $('#tabelApprove tbody').append($tr);
                });
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });

        //$(this).find('form').reset();
        $('form').validate().resetForm();
        $('form [name="id"]').val(id);
        $('#tabelApprove tbody').empty();
        $(this).find(':submit').removeClass('bg-red bg-orange bg-green');

        if (form == "process") {
            $(this).find('.modal-title').text('Proses Pengajuan');
            $(this).find(':submit').addClass('bg-orange');
            $(this).find(':submit').html('PROCESS');
            $('form [name="status"]').val('process');

        }

        else if (form == "reject") {
            $(this).find('.modal-title').text('Tolak Pengajuan');
            $(this).find(':submit').addClass('bg-red');
            $(this).find(':submit').html('REJECT');
            $('form [name="status"]').val('reject');
        }

        else if (form == "done") {
            $(this).find('.modal-title').text('Selesaikan Pengajuan');
            $(this).find(':submit').addClass('bg-green');
            $(this).find(':submit').html('DONE');
            $('form [name="status"]').val('done');
        }

    });    

});

$(function () {

    $('#jenisLayanan').on('change', function() {
        $('#divInfo').hide();
        $('#divFile').hide();
        $('form [name="infoTambahan"]').empty();

        if (!this.value) {$('form [name="jenisLayanan"]').val(''); return false;}

        $.ajax({
            url : window.location.href + '/detail_layanan/' + this.value,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                $('form [name="jenisLayanan"]').val(data.formField);
                if (data.infoRequired) {
                    $('#divInfo').show();
                    $('form [name="infoTambahan"]').append(data.infoRequired);
                }
                if (data.fileRequired) {
                    $('#divFile').show();
                    $('.fileinfo').text('(' + data.fileRequired + ')');
                }
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });

    });

    $('#jenisSeminar').on('change', function() {
        $('#divInfo').hide();
        $('#divFile').hide();
        $('form [name="infoTambahan"]').empty();

        if (!this.value) {$('form [name="jenisSeminar"]').val(''); return false;} 

        $.ajax({
            url : window.location.href + '/detail_seminar/' + this.value,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                $('form [name="jenisSeminar"]').val(data.formField);
                if (data.infoRequired) {
                    $('#divInfo').show();
                    $('form [name="infoTambahan"]').append(data.infoRequired);
                }
                if (data.fileRequired) {
                    $('#divFile').show();
                    $('.fileinfo').text('(' + data.fileRequired + ')');
                }

                switch (data.formField) {
                    case "Seminar Kerja Praktek"    : 
                        $('#judul').text('Judul Laporan KP'); break;
                    case "Seminar Proposal Judul"    : 
                        $('#judul').text('Judul Proposal'); break;
                    case "Seminar Konsep Skripsi (Hasil)"    : 
                        $('#judul').text('Judul Skripsi'); break;
                    case "Sidang Sarjana"    : 
                        $('#judul').text('Judul Skripsi'); break;
                } 
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });

    });

});

// Script untuk hapus data via AJAX request (JQuery Plugin: SweetAlert)
$(function () {
    $('#tabelData').on('click', ".buttonHapus", function() {

        var csrf_test_name = $("input[name=csrf_test_name]").val();
        var id = $(this).data('id');

        swal({
            title: "Apakah anda yakin?",
            text: "Data ini akan dihapus?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Sangat yakin!",
            closeOnConfirm: false,
        }, function() {
            $.ajax({
                type: "POST",
                url : window.location.href + '/delete/',
                data: {'csrf_test_name' : csrf_test_name, 'id':id},
            })
            .done(function() {
                swal({
                    title: "Berhasil", 
                    text: "Berhasil dihapus",
                    type: "success"
                },function() {
                    location.reload();
                });
            })
            .error(function(jqXHR, textStatus, errorThrown) {
                swal("Gagal", "Gagal dihapus!", "error");
            });
        });    

    });
});

// Script untuk hapus data via AJAX request (JQuery Plugin: SweetAlert)
$(function () {
    $('.hapusPost').on('click', function(){
        var csrf_test_name = $("input[name=csrf_test_name]").val();
        var id = $(this).data('id');

        swal({
            title: "Apakah anda yakin?",
            text: "Posting ini akan dihapus?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Sangat yakin!",
            closeOnConfirm: false,
        }, function() {
            $.ajax({
                type: "POST",
                url : url_timeline + '/delete_post/',
                data: {'csrf_test_name' : csrf_test_name, 'id':id},

            })
            .done(function() {
                swal({
                    title: "Berhasil", 
                    text: "Berhasil dihapus",
                    type: "success"
                },function() {
                    location.reload();
                });
            })
            .error(function(jqXHR, textStatus, errorThrown) {
                swal("Gagal", "Gagal dihapus!", "error");
            });
        }); 

    });

});