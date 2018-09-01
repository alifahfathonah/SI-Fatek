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
    $('.basicTabel').DataTable({
        responsive: true,
    });
});

//Modal form judul
$(function () {
    $('#modalDetailJudul').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');

        $.ajax({
            url : window.location.href + '/detail_judul/' + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                $('form [name="idJudul"]').val(data.judulId);
                $('.judul').text(data.judulTa);
                $('.dosen').text(data.judulNamaDosen);
                $('.keyword').text(data.judulKeyword);
                $('.labstudio').text(data.labstudioNama);

            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
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