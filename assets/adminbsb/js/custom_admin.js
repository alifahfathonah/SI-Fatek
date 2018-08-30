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

//Script pengaturan class DataTable pada tabel tertentu
$(function () {
    //Exportable table
    $('.js-exportable').DataTable({
        dom: 'Bfrtip',
        responsive: true,
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
});

//Modal input
$(function () {
    $('.js-modal-buttons .btn').on('click', function () {
        var color = $(this).data('color');
        $('#mdModal .modal-content').removeAttr('class').addClass('modal-content modal-col-' + color);
        $('#mdModal').modal('show');
    });
});



//Untuk pengaturan validasi form
$(function () {
    $('#form_tambah_judul').validate({
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