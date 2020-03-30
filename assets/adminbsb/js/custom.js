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
    //$('ul.list a[href="'+ url +'"]').addClass('toggled').parents('li').addClass('active').closest('ul').show();

    $('ul.list a').filter(function() {
        return this.href == url;
    }).addClass('toggled').parents('li').addClass('active').closest('ul').show();
});

//function for color modal
$(function () {
    $('.js-modal-buttons').on('click', function () {
        var color = $(this).data('color');
        $('.modalColored .modal-content').removeAttr('class').addClass('modal-content modal-col-' + color);

    });
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

    $("#checkAll").click(function(){
        $('input:checkbox').not(this).prop('checked', this.checked);
    });

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

    $('.actionTabel').DataTable({
        responsive: true,
        paging: false,
        "columnDefs": [{
            'sortable': false, 
            "targets": 'no-sort',
        }],
        "order": [[ 4, "asc" ]]
    });  

    $('.tblListAllDoc').DataTable({
        responsive: true,
        "pageLength":10,
        "columnDefs": [
            {
                "targets": [ 4 ],
                "visible": false,
                "searchable": true
            },
            {
                "targets": [ 5 ],
                "searchable": false
            }
        ]
    });

    if (typeof kodeUnit !== 'undefined') {
        $('.tblListAllDoc').DataTable().column(4).search(kodeUnit).draw();
    }

    $('.tabelDosen').DataTable({
        dom: 'Bfrtip',
        responsive: true,
        "pageLength":50,
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
});

//function for select angkatan
$(function () {
    var table = $('.tblListMhsApi').DataTable({
       dom: 'Bfrtip',
        responsive: true,
        "pageLength":50,
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
    });

    $('#table-filter').on('change', function(){
       table.columns(3).search(this.value).draw();
       if (this.value == "") {$('.subtitle').text('Semua Angkatan');}
       else {$('.subtitle').text('Angkatan '+this.value);}
    });
});


//function for typeahead and bloodhound
$(function () {
    if (typeof prefetch_dsn !== 'undefined') {
        
        var dosen = new Bloodhound({
          datumTokenizer: Bloodhound.tokenizers.obj.whitespace('nama'),
          queryTokenizer: Bloodhound.tokenizers.whitespace,
          prefetch: prefetch_dsn,

        });

        dosen.initialize();

        $('#tags-input-dosen').tagsinput({
            itemValue: 'id',
            itemText: 'nama',
            typeaheadjs: {
                name: 'dosen',
                displayKey: 'nama',
                source: dosen.ttAdapter(),
                templates: {
                    empty: [
                    '<div>unable to find</div>'
                    ].join('\n'),
                    suggestion: function(e) { return ('<div><strong>' + e.nama + '</strong> - ' + e.id + '</div>')}, 
                }
            } 
        });

        var mhs = new Bloodhound({
          datumTokenizer: Bloodhound.tokenizers.obj.whitespace('nama'),
          queryTokenizer: Bloodhound.tokenizers.whitespace,
          prefetch: prefetch_mhs,

        });

        mhs.initialize();

        $('#tags-input-mhs').tagsinput({
            itemValue: 'id',
            itemText: 'nama',
            typeaheadjs: {
                name: 'mhs',
                displayKey: 'nama',
                source: mhs.ttAdapter(),
                templates: {
                    empty: [
                    '<div>unable to find</div>'
                    ].join('\n'),
                    suggestion: function(e) { return ('<div><strong>' + e.nama + '</strong> - ' + e.id + '</div>')}, 
                }
            } 
        });

    }
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
                    $('form [name="id"]').val(data.idUser);
                    $('form [name="nama"]').val(data.nama);
                    $('form [name="username"]').val(data.username);
                    $('form [name="grup"]').selectpicker('val',data.grup);
                    $('form [name="namaUnit"]').val(data.namaUnit);
                    $('form [name="position"]').val(data.position);
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

    // Modal form Approval Proposal
    $('#modalFormApproveProposal').on('show.bs.modal', function (event) {
        
        var button = $(event.relatedTarget);
        var form = button.data('form');
        var action = button.data('action');
        $('form [name="comment"]').prop("required",false);
        $("#label-comment").empty();


        if (form == "single") {
            var id = button.data('id');
        }

        else if (form == "bulk") {
            var id = [];
            $.each($(".actionTabel input[name='check']:checked"), function(){
                id.push($(this).val());
            });
            id = id.join('-');
            if (id == "") return false;
        }

        $.ajax({
            url : window.location.href + '/get/' + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                $.each(data, function(i, item) {
                    var $tr = $('<tr>').append(
                        $('<td>').text(item.nama),
                        $('<td>').text(item.nim),
                        $('<td>').text(item.jurusan_alias),
                        $('<td>').text(item.prodi_alias)
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

            $(this).find('form').attr('action', window.location.href + '/approve');
            $(this).find('.modal-title').text('Proposal judul DISETUJUI');
            $(this).find(':submit').addClass('bg-light-blue').removeClass('bg-orange');
            $(this).find(':submit').html('DISETUJUI');
            $(this).find('.div-comment').empty();
            $(this).find('#label-comment').empty();

        }

        else if (action == "reject") {
            $(this).find('form').attr('action', window.location.href + '/reject');
            $(this).find('.modal-title').text('Proposal judul DITOLAK');
            $(this).find(':submit').addClass('bg-red').removeClass('bg-light-blue');
            $(this).find(':submit').html('DITOLAK');
            $(this).find('.div-comment').empty().append("<textarea rows='2' class='form-control no-resize' name='comment'></textarea>");
            $('form [name="comment"]').prop("required",true);
            $(this).find('#label-comment').append('Alasan ditolak');
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