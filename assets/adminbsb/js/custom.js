/*!
 * Custom Javascript for Bootstrap Admin BSB Material Design 
 * 
 * Crafted by: 
 * Xaverius Najoan      xnajoan@gmail.com
 * 
 *
 *
 */

 //Add li class 'active' for selected left menu
$(function () {
    var url = window.location;
    var element = $('ul.list a').filter(function() {
        return this.href == url;
    }).addClass('active').parent();
    if (element.is('li')) {
        element.addClass('active');
    }
});

// DataTable pada tabel spesifik. (JQuery Plugin: JQuery DataTable)
$(function () {
    //Exportable table
    $('.js-exportable').DataTable({
        dom: 'Bfrtip',
        responsive: true,
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });

    $('.basicTabel').DataTable({
        responsive: true,
    });
});

// Untuk pengaturan validasi form (JQuery Plugin: Jquery Validation)
$(function () {
    $('form').validate({
        highlight: function (input) {
            $(input).parents('.form-line').addClass('error');
        },
        unhighlight: function (input) {
            $(input).parents('.form-line').removeClass('error');
        },
        errorPlacement: function (error, element) {
            $(element).parents('.form-group').append(error);
        }
    });
});

// Script untuk modal with AJAX request (JQuery Plugin: Select Plugin, Bootstrap Tags Input, SweetAlert)
$(function () {

    // Modal form Publikasi
    $('#modalFormPublikasi').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var form = button.data('form');
        $('form').validate().resetForm();
        $('form [name="tahun"]').selectpicker("refresh");

        if (form == "formTambah") {
            $(this).find('form')[0].reset();
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
                    $('form [name="id"]').val(data.publikasiId);
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

    // Modal form Judul skripsi
    $('#modalFormJudul').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var form = button.data('form');
        $('form').validate().resetForm();
        $('form [name="keyword"]').tagsinput('removeAll');
        $('form [name="labstudio"]').selectpicker("refresh");
        if (form == "formTambah") {
            $(this).find('form')[0].reset();
            $(this).find('form').attr('action', window.location.href + '/tambah');
            $(this).find(':submit').addClass('buttonTambah').removeClass('buttonEdit');
            $(this).find('.modal-title').text('Tambah Usulan Judul');
        }
        else if (form == "formEdit") {
            $(this).find(':submit').addClass('buttonEdit').removeClass('buttonTambah');
            $(this).find('form').attr('action', window.location.href + '/edit');
            $(this).find('.modal-title').text('Edit Usulan Judul')
            $.ajax({
                url : window.location.href + '/detail/' + id,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                    $('form [name="id"]').val(data.judulId);
                    $('form [name="judul"]').val(data.judulTa);
                    $('form [name="labstudio"]').selectpicker('val',data.judulKodeLabstudio);
                    $('form [name="keyword"]').tagsinput('add',data.judulKeyword);

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
        $('form').validate().resetForm();
        $('form [name="grup"]').selectpicker("refresh");
        $('form [name="password"]').prop("required",false);
        $('.pass-empty').text('');

        if (form == "formTambah") {
            $(this).find('form')[0].reset();
            $(this).find('form').attr('action', window.location.href + '/tambah');
            $(this).find(':submit').addClass('buttonTambah').removeClass('buttonEdit');
            $(this).find('.modal-title').text('Tambah User');
            $('form [name="password"]').prop("required",true);
        }

        else if (form == "formEdit") {
            $(this).find(':submit').addClass('buttonEdit').removeClass('buttonTambah');
            $(this).find('form').attr('action', window.location.href + '/edit');
            $(this).find('.modal-title').text('Edit User');
            $(this).find('.pass-empty').text('Biarkan kosong, jika tidak ingin mengganti password');

            $.ajax({
                url : window.location.href + '/detail/' + id,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                    $('form [name="id"]').val(data.userId);
                    $('form [name="nama"]').val(data.nama);
                    $('form [name="username"]').val(data.username);
                    $('form [name="grup"]').selectpicker('val',data.grup);
                    $('form [name="namaUnit"]').val(data.namaUnit);
                    $('form [name="kodeUnit"]').val(data.kodeUnit);
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        }
    });


});

// Script untuk hapus data via AJAX request (JQuery Plugin: SweetAlert)
$(function () {
    $('.buttonHapus').on('click', function () {
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