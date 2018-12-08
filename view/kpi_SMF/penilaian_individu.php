  
  <div class="row">
  <div class="eq-height">
					        <div class="col-sm-3 eq-box-sm ">
					
					            <!--Basic Panel-->
					            <!--===================================================-->
					            <div class="panel pad-all">
					                <div class="panel-body">
                                    <form class="form-horizontal  pad-all" name="form-pi" id="form-pi" method="post">
                                    <div class="row">
                                    <input  id="uk" style="display:none" name="uk" class="form-control" type="text">
					                           
                                    <input style="display:none" type="text" id="id_jenis" name="id_jenis" value="5">
                                    <input  style="display:none" type="text" id="id_pi" name="id_pi">
                                    <input style="display:none" type="text" id="id_grup" name="id_grup">
					                        <div class="col-sm-4">
					                            <div class="form-group">
					                                <label class="control-label">NIP</label>

					                                <input disabled id="nip" name="nip" class="form-control" type="text" style="width:100px">
					                            </div>
					                        </div>
					                        <div class="col-sm-4">
					                            <div class="form-group">
					                                <label class="control-label">Nama Pegawai</label>
                                                    <div class="input-group mar-btm">
                                                    <input disabled style="width:150px" name="nama_pegawai" id="nama_pegawai" placeholder="Search" class="form-control" type="text">
                                                    <span class="input-group-addon" onCLick="search()"><i class="fa fa-search"></i></span>
                                                   
                                                    </div>
					                            </div>
					                        </div>
					                    </div>

                                        <div class="row">
					                        <div class="col-sm-4">
					                            <div class="form-group">
					                                <label class="control-label">Periode </label>
					                                <input  id="awal" name="awal" class="form-control" type="date">
					                            </div>
					                        </div>
					                        <div class="col-sm-4">
					                            <div class="form-group">
					                                <label class="control-label">Sampai</label>
                                                    <div class="input-group mar-btm">
                                                    <input  name="akhir" id="akhir" placeholder="Search" class="form-control" type="date">
                                                    
                                                    </div>
					                            </div>
					                        </div>
					                    </div> 
					                    <div class="row">
					                        <div class="col-sm-9 text-left">
					                            <a href="javascript:void(0)" class="btn btn-mint" id="simpan" name="simpan" type="submit" onClick="simpanPI();return false;">Save</a> 
					                        </div>
                                            <div class="col-sm-9 text-left buttoenedit">
					                            <a href="javascript:void(0)" class="btn btn-warning" id="edit" name="edit" type="submit" onClick="simpanPI();return false;">Edit</a> 
                                                <a href="javascript:void(0)" class="btn btn-mint" id="simpan" name="simpan" type="submit" onClick="$('#simpan').show('slow');$('.buttoenedit').hide('slow');document.getElementById('form-pi').reset(); return false;">Buat Baru</a> 
					                        
                                            </div>
                                             
					                    </div>
					                
                                       
                                            </form>

					                        </div>
					                </div>
					            </div>
					            <!--===================================================-->
					            <!--End Basic Panel-->
                                <div class="col-sm-4 eq-box-sm">
					
                    <!--Panel with Header-->
                    <!--===================================================-->
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">List Data Penilaian Kerja Individu</h3>
                        </div>
                        <div class="panel-body">
                        <div class="dataTables_filter" id="demo-dt-addrow_filter" style="margin-right:5px">
              <label>Search:<input aria-controls="demo-dt-addrow" class="form-control input-sm" placeholder="" type="search" id="search" onkeydown="if(event.keyCode=='13'){loadDataPI(0);}" ></label>
             
						</div>
                        <div id="gridPI"  style="width:100%;height: 300px;" class="ag-theme-balham"></div>
                        <div class="paging pull-right mar-all"> 
					    </div>
                        </div>
                    </div>
                    <!--===================================================-->
                    <!--End Panel with Header-->
        
                </div>
					        </div>
                            
  </div>
 <button class="btn btn-primary btn-icon mar-all" onclick="getRowData()"><i class="fa fa-folder icon-2x"></i> SAVE KPI</button>
 <button class="btn btn-success btn-icon mar-all" onclick="downloadKPI()"><i class="fa fa-cloud-download icon-2x"></i> Download KPI</button>
<div id="myGrid"  style="width:100%;height: 900px;" class="ag-theme-balham"></div> 



<script> 
 $('.judul-menu').html('Penilaian Kerja Individu');
$('.buttoenedit').hide();

function downloadKPI(){
    var params = { 
        fileName: 'kpi',
        sheetName: 'kpisheet'
    };

    gridOptions.api.exportDataAsExcel(params);
}
 function simpanPI(){
     var nip = $('#nip').val();
     var id_grup = $('#id_grup').val();
     var nama_pegawai = $('#nama_pegawai').val();
     var awal = $('#awal').val();
     var akhir = $('#akhir').val();
     var id_pi =  $('#id_pi').val();
     
     if(empty(nip)){
        onMessage('NIP Wajib diisi!');
               return false;
     }else if(empty(id_grup)){
        onMessage('NIP dan Nama Wajib diisi!');
               return false;
        }else if(empty(nama_pegawai)){
            onMessage('Nama Pegawai Wajib diisi!');
               return false;
        }else if(empty(awal)){
            onMessage('Periode awal Wajib diisi!');
               return false;
        }else if(empty(akhir)){
            onMessage('Periode akhir Wajib diisi!');
               return false;
        }else{
            $("#nip").prop("disabled", false );
            $("#nama_pegawai").prop("disabled", false );
            var action ='savepi';
            if(!empty(id_pi)){
                action='editpi';
            }
            postForm('form-pi',BASE_URL+'kpi/mpenilaian/'+action,loadDataPI)
            $('#form-pi')[0].reset();
           
            $('#id_grup').val(id_grup)
            $('.buttoenedit').hide();
            $('#simpan').show();
            $( "#nip" ).prop( "disabled", true );
        $( "#nama_pegawai" ).prop( "disabled", true );
        }
        
 }



 var listPI = [
            {headerName: "NIP", field: "nip", width: 190, filterParams:{newRowsAction: 'keep'}},
		 {headerName: "NIK", field: "nik", width: 190, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Nama", field: "nama", width: 190, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Unit Kerja", field: "nama_group", width: 190, filterParams:{newRowsAction: 'keep'}},
            {headerName: "Periode Awal", field: "awal", width: 190, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Akhir", field: "akhir", width: 190, filterParams:{newRowsAction: 'keep'}},
           
        ];

        

        var gridPI = {
           enableSorting: true,
           enableFilter: true,
           suppressRowClickSelection: false, 
					 onRowClicked: bukaPI,
           groupSelectsChildren: true,
           debug: true,
            rowSelection: 'multiple',
           enableColResize: true,
           rowGroupPanelShow: 'always',
           pivotPanelShow: 'always',
           enableRangeSelection: true,
           columnDefs: listPI,
           pagination: false,
           paginationPageSize: 50, 
           defaultColDef:{
               editable: false,
               enableRowGroup:true,
               enablePivot:true,
               enableValue:true
           }
        };

        // setup the grid after the page has finished loading 
           var gridDiv = document.querySelector('#gridPI');
           new agGrid.Grid(gridDiv, gridPI);

           function bukaPI(){
            var selectedRows = gridPI.api.getSelectedRows();
            var nip='';
            var nama_pegawai='';
            var awal ='';
            var akhir ='';
            var id_pi='';
            var id_uk='';
            var profesi='';

            // alert('>>'+selectedRows+'<<<');
            if(selectedRows == ''){
               onMessage('Silahkan Pilih Pegawai Terlebih dahulu!');
               return false;
            }else{
                var selectedRowsString = '';
           selectedRows.forEach( function(selectedRow, index) {
            
               if (index!==0) {
                   selectedRowsString += ', ';
               }
               selectedRowsString += selectedRow.id;
               nip += selectedRow.nip;
               nama_pegawai += selectedRow.nama;
               awal += selectedRow.awal;
               akhir += selectedRow.akhir;
               id_uk += selectedRow.id_uk;
               profesi += selectedRow.profesi;
           });
                        }
                        $('#id_pi').val(selectedRowsString);
                        $('#nama_pegawai').val(nama_pegawai);
                        $('#nip').val(nip);
                        $('#awal').val(awal);
                        $('#akhir').val(akhir); 
                        $('#simpan').hide(); 
                        $('.buttoenedit').show(); 
                        $('#id_grup').val(id_uk);
                         
                        if(empty(profesi)){
                            swal('Perhatian!','KPI Tidak dapat di proses karena pegawai tidak memiliki Profesi SMF/Non-SMF');
                            return false;
                        }else{
                            getJson(prosesData,BASE_URL+'kpi/mpenilaian/listpenilaian?id=5&pid='+selectedRowsString+'&profesi='+profesi);
                        }
                       
           }

           function prosesDataPI(result){
    gridPI.api.setRowData(result.result);
} 

function loadDataPI(jml){
    var search = 0;
            if($('#search').val() !==''){
              search = $('#search').val();
            }
 getJson(prosesDataPI,BASE_URL+'kpi/mpenilaian/listpi/5/'+search+'/'+jml);
}

loadDataPI(0);

           ///////////////////////////////////////////////

 var columnDefs = [ 
  
 {headerName: 'Kegiatan', field: 'node', width: 160,editable:false},
 {headerName: 'Bobot (%)', field: 'bobot', width: 160,editable:false, type: 'valueColumn'},
 {headerName: 'Target Kinerja', field: 'target', width: 120},
 {headerName: 'Capaian', field: 'capaian', width: 120},
 {headerName: 'Capaian (%)', field: 'persen', width: 120},
 {headerName: 'Nilai', field: 'nilai', width: 120, type: 'valueColumn'},  {
        headerName: 'Bobot',
        field: 'total', 
        width: 200
    } , 
 {headerName: 'Keterangan', field: 'keterangan', width: 120},
 {headerName: 'pid', field: 'pid',  hide:true},
 {field: "parent", rowGroup:true, hide:true},
 {field: "child", rowGroup:true, hide:true} 

];

var gridOptions = {
 enableSorting: true,
        enableFilter: true,
        suppressRowClickSelection: false, 
        groupDefaultExpanded: 2,
        groupSelectsChildren: true,
        debug: true,
         rowSelection: 'single',
        enableColResize: true,
        rowGroupPanelShow: 'always',
        pivotPanelShow: 'always',
        enableRangeSelection: true,
        columnDefs: columnDefs,
        onCellValueChanged: function(params) {
         updateTotal(params);
    }, 
        pagination: false,
        autoGroupColumnDef: {
            headerName:'Group',
            field: 'athlete'
        },
 defaultColDef: {
     editable: true
 },
    onGridReady: function (params) {
        params.api.sizeColumnsToFit();
    },
    onCellEditingStarted: function(event) {
        console.log('cellEditingStarted');
    },
    onCellEditingStopped: function(event) {
        console.log('cellEditingStopped');
    }
};
 
function updateTotal(params){
    
    var itemsToUpdate = [];
    var jml=0;
    gridOptions.api.forEachLeafNode( function(node) {
        var datas = node.data;
        datas.total = parseFloat((Number(datas.bobot)/100) * Number(datas.nilai)).toFixed(1);
        jml =  parseFloat(Number(jml) + Number(datas.total)).toFixed(1);
       
        if(node.data.id ==='totalsjumlah'){
          //  datas.bobot=13;
          
          datas.total = jml;
           // datas.total=12;
            
        }
        itemsToUpdate.push(datas);
      // alert(node.data.id);
    });
   // alert(JSON.stringify(itemsToUpdate));
    var res = gridOptions.api.updateRowData({update: itemsToUpdate});
}

function getRowData() {
    var rowData = [];
    gridOptions.api.forEachLeafNode( function(node) {
        rowData.push(node.data);
    });
    //console.log('Row Data:'); 
    save(BASE_URL+'kpi/mpenilaian/savedetail',rowData,tektok);
}

function tektok(){
    var selectedRows = gridPI.api.getSelectedRows();
    var selectedRowsString = '';
    var profesi ='';
           selectedRows.forEach( function(selectedRow, index) {
            
               if (index!==0) {
                   selectedRowsString += ', ';
               }
               selectedRowsString += selectedRow.id; 
               profesi += selectedRow.profesi;
           });
           
           getJson(prosesData,BASE_URL+'kpi/mpenilaian/listpenilaian?id=5&pid='+selectedRowsString+'&profesi='+profesi);
}
 
function onBtForEachLeafNode() {
 console.log('### api.forEachLeafNode() ###');
 gridOptions.api.forEachLeafNode(printNode);
}

function printNode(node, index) {
 var key = node.data.id;
 var value =  node.data.capaian; 
 var year_array = new Array();
 if ( !year_array.hasOwnProperty(node.data.id) ) // if year is not in array yet
    {
        year_array[node.data.id] = new Array(); // create an empty array for it
    }

 year_array[node.data.id].push({
        "capaian": node.data.capaian,
        "persen": node.data.persen 
    });
      console.log(index + ' -> data: ' + JSON.stringify(year_array));

 
}

 var gridDiv = document.querySelector('#myGrid');
 new agGrid.Grid(gridDiv, gridOptions);

function prosesData(result){
 gridOptions.api.setRowData(result);
} 

function loadData(){
 getJson(prosesData,BASE_URL+'kpi/mpenilaian/listpenilaian?id=5');
}

loadData();

function getCharCodeFromEvent(event) {
 event = event || window.event;
 return typeof event.which === 'undefined' ? event.keyCode : event.which;
}

function isCharNumeric(charStr) {
 return !!/\d/.test(charStr);
}

function isKeyPressedNumeric(event) {
 var charCode = getCharCodeFromEvent(event);
 var charStr = String.fromCharCode(charCode);
 return isCharNumeric(charStr);
}

function search(){
    bootbox.dialog({ 
                   message:$('<div></div>').load('view/pegawai/search_pegawai.php'),
                   animateIn: 'bounceIn',
                   animateOut : 'bounceOut',
									 backdrop: false,
                   size:'large',
                   buttons: {
                      

                       main: {
                           label: "Close",
                           className: "btn-warning",
                           callback: function() {
                               $.niftyNoty({
                                   type: 'dark',
                                   message : "Bye Bye",
                                   container : 'floating',
                                   timer : 5000
                               });
                           }
                       }
                   }
                       });
}

</script>