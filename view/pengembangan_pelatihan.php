<div class="tab-base">
    <!--Nav Tabs-->
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#demo-lft-tab-2">Users</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade" id="demo-lft-tab-1"></div>
        <div class="tab-pane fade active in" id="demo-lft-tab-2">
            <div class="fixed-table-toolbar">
            </div>
            <div class="panel-body">
                <div class="dataTables_wrapper form-inline dt-bootstrap no-footer" id="demo-dt-addrow_wrapper">
                    <div class="newtoolbar">
                        <div class="table-toolbar-left" id="demo-custom-toolbar2">
                            <div class="btn-group">
                                <button class="btn btn-primary btn-labeled fa fa-plus-square btn-sm" id=
                                "demo-bootbox-bounce">Add
                                </button>
                                <button class=
                                        "btn btn-warning btn-labeled fa fa-edit btn-sm" onclick=
                                        "proses_edit();">Edit
                                </button>
                                <button class=
                                        "btn btn-danger btn-labeled fa fa-close btn-sm" onclick=
                                        "proses_delete();">Delete
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="dataTables_filter" id="demo-dt-addrow_filter">
                        <label>Search:<input aria-controls="demo-dt-addrow" class="form-control input-sm" placeholder=""
                                             type="search" id="search"
                                             onkeydown="if(event.keyCode=='13'){loaddata(0, this);}"></label>
                    </div>
                </div>
                <div class="bootstrap-table">
                    <div class="fixed-table-container" style="padding-bottom: 0px;">
                        <div class="ag-theme-balham" id="myGrid" style="height: 400px;width:100%;">
                        </div>

                        <div class="paging pull-right mar-all">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="demo-lft-tab-3"></div>
    </div>
</div>
<script charset="utf-8" type="text/javascript">
    //<![CDATA[
    // specify the columns
    var columnDefs = [

        {headerName: "No Disposisi", field: "no_disposisi", width: 190, filterParams: {newRowsAction: 'keep'}},
        {headerName: "NIP / NIK", field: "nopeg", width: 190, filterParams: {newRowsAction: 'keep'}},
        {headerName: "Nama", field: "nama_pegawai", width: 190, filterParams: {newRowsAction: 'keep'}},
        {headerName: "Jabatan", field: "jabatan", width: 190, filterParams: {newRowsAction: 'keep'}},
        {headerName: "Created Date", field: "created", width: 190, filterParams: {newRowsAction: 'keep'}},
        {headerName: "Created By", field: "createdby", width: 190, filterParams: {newRowsAction: 'keep'}},
        {headerName: "Status", field: "statue", width: 190, filterParams: {newRowsAction: 'keep'}},

    ];

    var autoGroupColumnDef = {
        headerName: "Group",
        width: 200,
        field: 'nama_group',
        valueGetter: function (params) {
            if (params.node.group) {
                return params.node.key;
            } else {
                return params.data[params.colDef.field];
            }
        },
        headerCheckboxSelection: true,
        // headerCheckboxSelectionFilteredOnly: true,
        cellRenderer: 'agGroupCellRenderer',
        cellRendererParams: {
            checkbox: true
        }
    };

    var gridOptions = {
        enableSorting: true,
        enableFilter: true,
        suppressRowClickSelection: false,
        onRowDoubleClicked: proses_edit,
        groupSelectsChildren: true,
        debug: true,
        rowSelection: 'single',
        enableColResize: true,
        rowGroupPanelShow: 'always',
        pivotPanelShow: 'always',
        enableRangeSelection: true,
        columnDefs: columnDefs,
        pagination: false,
        paginationPageSize: 50,
        autoGroupColumnDef: autoGroupColumnDef,
        defaultColDef: {
            editable: false,
            enableRowGroup: true,
            enablePivot: true,
            enableValue: true
        }
    };

    // setup the grid after the page has finished loading
    var gridDiv = document.querySelector('#myGrid');
    new agGrid.Grid(gridDiv, gridOptions);

    // do http request to get our sample data - not using any framework to keep the example self contained.
    // you will probably use a framework like JQuery, Angular or something else to do your HTTP calls.
    function loaddata(jml = 0) {
        var search = 0;
        if ($('#search').val() !== '') {
            search = $('#search').val();
        }
        $.ajax({
            url: BASE_URL + 'pengembangan_pelatihan/list/' + jml + '/' +search,
            headers: {
                'Authorization': localStorage.getItem("Token"),
                'X_CSRF_TOKEN': 'donimaulana',
                'Content-Type': 'application/json'
            },
            dataType: 'json',
            type: 'get',
            contentType: 'application/json',
            processData: false,
            success: function (data, textStatus, jQxhr) {
                gridOptions.api.setRowData(data.result);
                pagingDatatable(data.total, data.limit, 'loaddata');
            },
            error: function (jqXhr, textStatus, errorThrown) {
                alert('error');
            }
        });

    }

    loaddata(0);

    function proses_delete() {
        var selectedRows = gridOptions.api.getSelectedRows();
        if (selectedRows == '') {
            onMessage('Silahkan Pilih Group Terlebih dahulu!');
            return false;
        } else {
            var selectedRowsString = '';
            selectedRows.forEach(function (selectedRow, index) {

                if (index !== 0) {
                    selectedRowsString += ', ';
                }
                selectedRowsString += selectedRow.id;
            });
            submit_get(BASE_URL + 'pengembangan_pelatihan/delete/?id=' + selectedRowsString, loaddata);


        }
    }

    function proses_edit() {
        var selectedRows = gridOptions.api.getSelectedRows();
        if (selectedRows == '') {
            onMessage('Silahkan Pilih Group Terlebih dahulu!');
            return false;
        } else {
            var selectedRowsString = '';
            selectedRows.forEach(function (selectedRow, index) {

                if (index !== 0) {
                    selectedRowsString += ', ';
                }
                selectedRowsString += selectedRow.id;
            });

            $.ajax({
                url: BASE_URL + 'pengembangan_pelatihan/get/?id=' + selectedRowsString,
                headers: {
                    'Authorization': localStorage.getItem("Token"),
                    'X_CSRF_TOKEN': 'donimaulana',
                    'Content-Type': 'application/json'
                },
                dataType: 'json',
                type: 'get',
                contentType: 'application/json',
                processData: false,
                success: function (res, textStatus, jQxhr) {
                    // $('#f_user_username').val(res[0].username);
                    // $('#f_user_edit').val(res[0].username);
                    $('#id').val(res.data.id);
                    $('#no_disposisi').val(res.data.no_disposisi);
                    $('#laporan').val(res.data.laporan);
                    $("#laporan").trigger("chosen:updated");
                    $('#monev').val(res.data.monev);
                    $("#monev").trigger("chosen:updated");
                    $('#jenis_perjalanan').val(res.data.jenis_perjalanan);
                    $("#jenis_perjalanan").trigger("chosen:updated");
                    $('#jenis').val(res.data.jenis);
                    $("#jenis").trigger("chosen:updated");
                    $('#jenis_biaya').val(res.data.jenis_biaya);
                    $("#jenis_biaya").trigger("chosen:updated");
                    $('#nama_pegawai').val(res.data.nama_pegawai);
                    $('#jabatan').val(res.data.jabatan);
                    console.log(res.data.tanggal);
                    for (var i = 0; i < res.data.tanggal.length; i++) {
                        if (i == 0){
                            $("#tanggal").val(res.data.tanggal[i].tanggal);
                        }
                        else{
                            console.log("else" + i);
                            var row = $(
                                '<div class="form-group body-remove-calendar">' +
                                '<label class="col-sm-3 control-label" for="demo-hor-inputemail"></label>' +
                                '<div class="col-sm-5">' +
                                '<input type="date" name="tanggal[]" class="form-control tanggal" style="padding: 0 !important;" value='+res.data.tanggal[i].tanggal+' />' +
                                '</div>' +
                                '<div class="col-xs-3 pull right">' +
                                '<div class="btn btn-default btn-sm btn-remove-calendar">' +
                                '<i class="fa fa-trash-o"></i>' +
                                '</div>' +
                                '</div>' +
                                '</div>');
                            $(".body-content-calendar").append(row);
                        }
                    };
                    for (var i = 0; i < res.data.biaya_uraian.length; i++) {
                        if (i == 0){
                            $("#biaya_uraian").val(res.data.biaya_uraian[i].biaya_uraian);
                            $("#biaya_nominal").val(res.data.biaya_uraian[i].biaya_nominal);
                        }
                        else{
                          var row = $(
                                     '<div class="form-group body-remove">' +
                                     '<label class="col-sm-3 control-label"></label>' +
                                     '<div class="body-detail">' +
                                     '<div class="col-sm-3">' +
                                     '<input type="text" name="biaya_uraian[]" class="form-control biaya_uraian" placeholder="Uraian" value='+res.data.biaya_uraian[i].biaya_uraian+' />' +
                                     '</div>' +
                                     '<div class="col-sm-3">' +
                                     '<input type="text" name="biaya_nominal[]" class="form-control biaya_nominal" placeholder="Biaya" value='+res.data.biaya_uraian[i].biaya_nominal+' />' +
                                     '</div>' +
                                     '</div>' +
                                     '<div class="col-xs-3 pull right">' +
                                     '<div class="btn btn-default btn-sm btn-remove">' +
                                     '<i class="fa fa-trash-o"></i>' +
                                     '</div>' +
                                     '</div>' +
                                     '</div>');
                                 $(".body-content").append(row);
                        }
                    };



                    // $('#nopeg').val(res.data.nopeg);
                    // $("#nopeg").trigger("chosen:updated");
                    // $('#no_disposisi').val(res.data.no_disposisi);
                    // $('#no_disposisi').val(res.no_disposisi);
                    // $('#no_disposisi').val(res.no_disposisi);
                    // $('#no_disposisi').val(res.no_disposisi);
                    // $('#no_disposisi').val(res.no_disposisi);
                    // $('#no_disposisi').val(res.no_disposisi);
                    // $('#no_disposisi').val(res.no_disposisi);
                    // $('#no_disposisi').val(res.no_disposisi);
                    // $('#no_disposisi').val(res.no_disposisi);
                    // $('#no_disposisi').val(res.no_disposisi);


                },
                error: function (jqXhr, textStatus, errorThrown) {
                    alert('error');
                }
            });


            bootbox.dialog({
                title: "<i class=\"fa fa-users\"><\/i> Edit Group",
                message: $('<div></div>').load('view/pengembangan_pelatihan/add.php'),
                animateIn: 'bounceIn',
                animateOut: 'bounceOut',
                buttons: {
                    success: {
                        label: "Save",
                        className: "btn-primary",
                        callback: function () {

                            if (simpan('edit')) {
                                return true;
                            } else {
                                return false;
                            }

                        }
                    },

                    main: {
                        label: "Cancel",
                        className: "btn-warning",
                        callback: function () {
                            $.niftyNoty({
                                type: 'dark',
                                message: "Bye Bye",
                                container: 'floating',
                                timer: 5000
                            });
                        }
                    }
                }
            });
        }

    }

    $('#demo-bootbox-bounce').on('click', function () {
        getOptions("f_user_id_group", BASE_URL + "users/getgroup");
        getOptions("f_uk", BASE_URL + "uk_index/option");
        getOptionsEdit("f_user_status_aktif", BASE_URL + "Appdata/getstatus", 1);


        bootbox.dialog({
            title: "<i class=\"fa fa-user\"><\/i> Add New User",
            message: $('<div></div>').load('view/pengembangan_pelatihan/add.php'),
            animateIn: 'bounceIn',
            animateOut: 'bounceOut',
            buttons: {
                success: {
                    label: "Save",
                    className: "btn-primary",
                    callback: function () {

                        if (simpan('add')) {
                            return true;
                        } else {
                            return false;
                        }

                    }
                },

                main: {
                    label: "Cancel",
                    className: "btn-warning",
                    callback: function () {
                        $.niftyNoty({
                            type: 'dark',
                            message: "Bye Bye",
                            container: 'floating',
                            timer: 5000
                        });
                    }
                }
            }
        });
    });
</script>
<script src="js/login.js" type="text/javascript">
</script>
 
