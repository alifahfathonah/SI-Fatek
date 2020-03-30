$(function () { 

    var directory = [

    {
        text: 'Dekan',
        href: 'dekan',
    },
    {
        text: 'Bidang I',
        href: 'wd1',
    },
    {
        text: 'Bidang II',
        href: 'wd2',
    },
    {
        text: 'Bidang III',
        href: 'wd3'  ,
    },
    {
        text: 'Jurusan',
        selectable: false,

        nodes: [
        {
            text: 'Jurusan Teknik Sipil',
            href: 'jurusan45',
        },
        {
            text: 'Jurusan Arsitektur',
            href: 'jurusan42',
        },
        {
            text: 'Jurusan Teknik Elektro',
            href: 'jurusan43',
        },
        {
            text: 'Jurusan Teknik Mesin',
            href: 'jurusan44',
        },
        ]
    },
    {
        text: 'Prodi',
        selectable: false,
        nodes: [
        {
            text: 'Prodi Teknik Sipil',
            href: 'prodi14',
        },
        {
            text: 'Prodi Teknik Lingkungan',
            href: 'prodi94',
        },
        {
            text: 'Prodi Arsitektur',
            href: 'prodi15',
        },
        {
            text: 'Prodi PWK',
            href: 'prodi16',
        },
        {
            text: 'Prodi Teknik Elektro',
            href: 'prodi12',
        },
        {
            text: 'Prodi Teknik Informatika',
            href: 'prodi77',
        },
        {
            text: 'Prodi Teknik Mesin',
            href: 'prodi13',
        },
        ]
    },
    {
        text: 'Bag. Umum',
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
              $('.subtitle').text(node.text);
            },
    });

    if (typeof nodeId !== 'undefined') {
        $('#directory').treeview('selectNode', [ nodeId, { silent: true } ]);
    }


});