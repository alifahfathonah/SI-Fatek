$(function () { 

    var directory = [

    {
        text: 'Dekan',
        judu: 'Dekan',
        href: 'dekan',
    },
    {
        text: 'Bidang I',
        judu: 'Bidang I',
        href: 'wd1',
    },
    {
        text: 'Bidang II',
        judu: 'Bidang II',
        href: 'wd2',
    },
    {
        text: 'Bidang III',
        judu: 'Bidang III',
        href: 'wd3'  ,
    },
    {
        text: 'Jurusan',
        selectable: false,

        nodes: [
        {
            text: 'Teknik Sipil',
            judu: 'Jurusan Teknik Sipil',
            href: 'jurusan45',
        },
        {
            text: 'Arsitektur',
            judu: 'Jurusan Arsitektur',
            href: 'jurusan42',
        },
        {
            text: 'Teknik Elektro',
            judu: 'Jurusan Teknik Elektro',
            href: 'jurusan43',
        },
        {
            text: 'Teknik Mesin',
            judu: 'Jurusan Teknik Mesin',
            href: 'jurusan44',
        },
        ]
    },
    {
        text: 'Prodi',
        selectable: false,
        nodes: [
        {
            text: 'Teknik Sipil',
            judu: 'Prodi Teknik Sipil',
            href: 'prodi14',
        },
        {
            text: 'Teknik Lingkungan',
            judu: 'Prodi Teknik Lingkungan',
            href: 'prodi94',
        },
        {
            text: 'Arsitektur',
            judu: 'Prodi Arsitektur',
            href: 'prodi15',
        },
        {
            text: 'PWK',
            judu: 'Prodi PWK',
            href: 'prodi16',
        },
        {
            text: 'Teknik Elektro',
            judu: 'Prodi Teknik Elektro',
            href: 'prodi12',
        },
        {
            text: 'Teknik Informatika',
            judu: 'Prodi Teknik Informatika',
            href: 'prodi77',
        },
        {
            text: 'Teknik Mesin',
            judu: 'Prodi Teknik Mesin',
            href: 'prodi13',
        },
        ]
    },
    {
        text: 'Bag. Umum',
        judu: 'Bag. Umum',
        href: 'umum'  ,
    }
    ];


    $('#directory').treeview({
        levels: 99,
        data: directory,
        expandIcon: 'glyphicon glyphicon-chevron-right',
        collapseIcon: 'glyphicon glyphicon-chevron-down',
        showTags: true,

        onNodeSelected: function(event, node) {
              $('.tblListAllDoc').DataTable().columns(4).search(node.href).draw();
              $('.subtitle').text(node.judu);
              $('html, body').animate({
                    scrollTop: $(".scrollhere").offset().top -80
                }, 2000);
            },
    });

    if (typeof nodeId !== 'undefined') {
        $('#directory').treeview('selectNode', [ nodeId, { silent: true } ]);
    }


});