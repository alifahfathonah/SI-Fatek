$(function () {
    //Widgets count
    $('.count-to').countTo();

});
 

$(function () {
    getMorris('line', 'chart-mhs-alumni', data1, {'xkey': 'angkatan',
                        'ykeys': ['mahasiswa', 'alumni'],
                        'labels' : ['Mahasiswa Baru','Alumni'],
                        'lineColors' : ['rgb(0, 188, 212)', 'rgb(233, 30, 99)'],
                        'lineWidth' : 3,     
                    });
    getMorris('donut', 'chart-mhs-aktif-jurusan', data2, {'colors' : ['rgb(233, 30, 99)', 'rgb(0, 188, 212)', 'rgb(255, 152, 0)', 'rgb(0, 150, 136)'],   
                    });

    getMorris('bar', 'chart-mhs-aktif-prodi', data3, {'xkey': 'prodi',
                        'ykeys': ['jumlah'],
                        'labels' : ['Jumlah Mahasiswa'],
                        'barColors' : ['rgb(0, 188, 212)'],   
                    }); 

    getMorris('donut', 'chart-alu-jurusan', data4, {'colors' : ['rgb(233, 30, 99)', 'rgb(0, 188, 212)', 'rgb(255, 152, 0)', 'rgb(0, 150, 136)'],   
                    });

    getMorris('bar', 'chart-alu-prodi', data5, {'xkey': 'prodi',
                        'ykeys': ['jumlah'],
                        'labels' : ['Jumlah Alumni'],
                        'barColors' : ['rgb(255, 152, 0)'],   
                    });

    getMorris('donut', 'chart-dsn-jurusan', data6, {'colors' : ['rgb(233, 30, 99)', 'rgb(0, 188, 212)', 'rgb(255, 152, 0)', 'rgb(0, 150, 136)'],   
                    });

    getMorris('bar', 'chart-dsn-prodi', data7, {'xkey': 'prodi',
                        'ykeys': ['jumlah'],
                        'labels' : ['Jumlah Dosen'],
                        'barColors' : ['rgb(233, 30, 99)'],   
                    });                                          
});


function getMorris(type, element, data, graph) {
    if (type === 'line') {
        Morris.Line({
            element: element,
            data: data,
            xkey: graph.xkey,
            ykeys: graph.ykeys,
            labels: graph.labels,
            lineColors: graph.lineColors,
            lineWidth: graph.lineWidth,
        });
    } else if (type === 'bar') {
        Morris.Bar({
            element: element,
            data: data,
            xkey: graph.xkey,
            ykeys: graph.ykeys,
            labels: graph.labels,
            barColors: graph.barColors,
        });
    } else if (type === 'area') {
        Morris.Area({
            element: element,
            data: data,
            xkey: graph.xkey,
            ykeys: graph.ykeys,
            labels: graph.labels,
            pointSize: graph.pointSize,
            hideHover: graph.hideHover,
            lineColors: graph.lineColors,
        });
    } else if (type === 'donut') {
        Morris.Donut({
            element: element,
            data: data,
            colors: graph.colors,
            formatter: function (y) {
                return y
          }
        });
    }
}

