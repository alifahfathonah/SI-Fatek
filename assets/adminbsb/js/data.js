$(function () {
    //Widgets count
    $('.count-to').countTo();

});




var URL_API   = "http://localhost/unsrat-api/jumlah/";
$.ajax({
    url: URL_API + 'mahasiswa/fakultas',
    cache: false,
    type: "GET",
    data: {
        'id': '2',
        'by': 'angkatan',
    },
    dataType: "json",
    timeout: 10000,
    success: function(data) {
        Morris.Line({
            element: 'chart-mhs-angkatan',
            data: data,
            xkey: 'mhsAngkatan',
            ykeys: ['jumlah'],
            labels: ['Mahasiswa','Tahun'],
            hideHover: 'auto',
        });
    }
});
