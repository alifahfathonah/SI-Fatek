/*!
 * Custom Javascript
 * by Xaverius Najoan
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

//Modal form user
$(function () {
    $('#modalFormUser').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var form = button.data('form');
        $('form').validate().resetForm();
        $('form [name="grup"]').selectpicker("refresh");
        $('.pass-empty').text('');

        if (form == "formTambah") {
            $(this).find('form')[0].reset();
            $(this).find('form').attr('action', window.location.href + '/tambah');
            $(this).find(':submit').addClass('buttonTambah').removeClass('buttonEdit');
            $(this).find('.modal-title').text('Tambah User');
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
                    $('form [name="userId"]').val(data.userId);
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

    $('.buttonHapusUser').on('click', function () {
        var csrf_test_name = $("input[name=csrf_test_name]").val();
        var id = $(this).data('id');

        swal({
            title: "Are you sure?",
            text: "You will not be able to recover!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false,
        }, function() {
            $.ajax({
                type: "POST",
                url : window.location.href + '/delete/',
                data: {'csrf_test_name' : csrf_test_name, "userId":id},
            })
            .done(function() {
                swal({
                    title: "Deleted", 
                    text: "Akun user berhasil dihapus", 
                    type: "success"
                },function() {
                    location.reload();
                });
            })
            .error(function(jqXHR, textStatus, errorThrown) {
                swal("Oops", "We couldn't connect to the server!", "error");
            });
        });    

    });
});

//Untuk pengaturan validasi form
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