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

$(function () {
    //Tooltip
    $('[data-toggle="tooltip"]').tooltip({
        container: 'body'
    });

    //Popover
    $('[data-toggle="popover"]').popover();

    //Widgets count
    $('.count-to').countTo();

    //Generate graphs
    if (typeof graphs !== 'undefined') {
        for (var i = 0; i < graphs.length; i++) {
            getMorris(graphs[i].type, graphs[i].element, graphs[i].data, graphs[i].param);
        } 
    }

    //Get from API
    if (typeof urlApi !== 'undefined') {
        getDataApi('userDokumen', urlApi);
    }

})

// DataTable pada tabel spesifik. (JQuery Plugin: JQuery DataTable)
$(function () {
    //Exportable table
    $('.js-exportable').DataTable({
        dom: 'Bfrtip',
        responsive: true,
        "pageLength":50,
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });

    $('.basicTabel').DataTable({
        responsive: true,
    }); 

    $('.tabelDosen').DataTable({
        dom: 'Bfrtip',
        responsive: true,
        "pageLength":50,
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
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
        $(this).find('form')[0].reset();
        $('form').validate().resetForm();
        $('form [name="id"]').val('');
        $('form [name="keyword"]').tagsinput('removeAll');
        $('form [name="labstudio"]').selectpicker("refresh");
        
        if (form == "formTambah") {

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
        $(this).find('form')[0].reset();
        $('form').validate().resetForm();
        $('form [name="id"]').val('');
        $('form [name="grup"]').selectpicker("refresh");
        $('form [name="password"]').prop("required",false);
        $('.pass-empty').text('');

        if (form == "formTambah") {

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
                    $('form [name="id"]').val(data.docgroupId);
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
                    $('form [name="id"]').val(data.labstudioId);
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
                    $('form [name="id"]').val(data.dosenId);
                    $('form [name="nama"]').val(data.nama);
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
                    $('form [name="showInPublic"]').selectpicker('val',data.showInPublic);
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        }
    }); 

    // Modal form Dokumen
    $('#modalFormDoc').on('show.bs.modal', function (event) {
        
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var form = button.data('form');
        $(this).find('form')[0].reset();
        $('form').validate().resetForm();
        $('form [name="id"]').val('');

        if (form == "formTambah") {
            $(this).find('form').attr('action', window.location.href + '/tambah');
            $(this).find(':submit').addClass('buttonTambah').removeClass('buttonEdit');
            $(this).find('.modal-title').text('Tambah Dokumen');
        }
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

// Script untuk getDataApi
function getDataApi(type, url) {
    if (type === 'userDokumen') {
        var urlApi = url;

        $(function () {

            var delay = (function(){
                var timer = 0;
                return function(callback, ms){
                    clearTimeout (timer);
                    timer = setTimeout(callback, ms);
                };
            })();

            $('#modalFormDoc').on("keyup",'.kotak .form-control',function() {
            
                var thisid = $(this).attr("id")
                var loader = "#loader" + thisid;
                var respon = "#respon" + thisid;
                var data   = $("#" + thisid).val();
                
                $(loader).empty();
                $(loader).append('<i class="fa fa-spinner fa-spin"></i>');
                $(respon).empty();
                
                delay(function() {          
                    $.ajax({
                        type: 'GET',
                        url: urlApi,
                        data: {id:data},
                        dataType:'json',
                        success: function(data) {
                            $(loader).empty().append('<span class="fa fa-check"></span>');
                            $(loader).parents('.entry').removeClass('has-error').addClass('has-success');
                            $(respon).append(data[0].nama);
                        },
                        
                        error: function(error) {
                            $(loader).empty().append('<span class="fa fa-remove"></span>');
                            $(loader).parents('.entry').removeClass('has-success').addClass('has-error');
                            $(respon).append('ID Tidak ditemukan!');
                        }
                    }); 
                }, 1000);   
            });

            var counter = 2;
            
            $('#modalFormDoc').on('click', '.btn-add', function(e)
            {
                e.preventDefault();

                var controlForm = $('.controls .kotak:first'),
                    currentEntry = $(this).parents('.entry:first'),
                    newEntry = $(currentEntry.clone()).appendTo(controlForm);

                newEntry.find('input').val('');
                newEntry.find('input').attr("id",counter);      
                newEntry.find('.loader').attr("id",'loader'+counter).empty();
                newEntry.find('.respon').attr("id",'respon'+counter).empty();
                newEntry.find('.loader').parents('.entry').removeClass('has-error').removeClass('has-success');
                //$(loader).parents('.entry').removeClass('has-error').addClass('has-success');
                
                counter++;
                
                controlForm.find('.entry:not(:last) .btn-add')
                    .removeClass('btn-add').addClass('btn-remove')
                    .removeClass('btn-success').addClass('btn-danger')
                    .html('<i class="material-icons">remove_circle</i>');
            }).on('click', '.btn-remove', function(e)
            {
                $(this).parents('.entry:first').remove();

                e.preventDefault();
                return false;
            });
            
        });

    }
}

// Script untuk chart (JQuery Plugin: MorrisChart)
function getMorris(type, element, data, param) {
    if (type === 'line') {
        Morris.Line({
            element: element,
            data: data,
            xkey: param.xkey,
            ykeys: param.ykeys,
            labels: param.labels,
            lineColors: param.lineColors,
            lineWidth: param.lineWidth,
        });
    } else if (type === 'bar') {
        Morris.Bar({
            element: element,
            data: data,
            xkey: param.xkey,
            ykeys: param.ykeys,
            labels: param.labels,
            barColors: param.barColors,
        });
    } else if (type === 'area') {
        Morris.Area({
            element: element,
            data: data,
            xkey: param.xkey,
            ykeys: param.ykeys,
            labels: param.labels,
            pointSize: param.pointSize,
            hideHover: param.hideHover,
            lineColors: param.lineColors,
        });
    } else if (type === 'donut') {
        Morris.Donut({
            element: element,
            data: data,
            colors: param.colors,
            formatter: function (y) {
                return y
          }
        });
    }
}