
<div class="row">
	
  <div class="tab-base mar-all">
    <!--Nav Tabs-->

    <ul class="nav nav-tabs">
      <li>
				<a href="#demo-lft-tab-1" data-toggle="tab">
						<span class="block text-center">
							<i class="fa fa-home fa-2x"></i> 
						</span>
						Dashboard
					</a>
			</li>

      <li class="active">
				<a href="#demo-lft-tab-2" data-toggle="tab">
						<span class="block text-center">
							<i class="fa fa-laptop fa-2x"></i> 
						</span>
						View Data
					</a> 
			</li>
            <li>
				<a href="#demo-lft-tab-pensiun" data-toggle="tab">
						<span class="block text-center">
							<i class="fa fa-sign-out fa-2x"></i> 
						</span>
						List Pensiun/Keluar
					</a>
			</li>
      <li> 
			<a href="#demo-lft-tab-3" data-toggle="tab">
						<span class="block text-center">
							<i class="fa fa-lightbulb-o fa-2x"></i> 
						</span>
						Help
					</a> 
			</li>
    </ul>

    <div class="tab-content">
      <div class="tab-pane fade" id="demo-lft-tab-1"></div>

      <div class="tab-pane fade active in" id="demo-lft-tab-2">
        <div class="fixed-table-toolbar">
         
        </div>
				
<div class="panel-group accordion" id="accordion" >
	<div class="panel" style="border:none">
					
					                <!--Accordion title-->
					                <div class="panel-heading">
					                    <h4 class="panel-title">
					                        <a data-parent="#accordion" data-toggle="collapse" href="#collapseOne" aria-expanded="true" class="text-warning"><i class="fa fa-folder"></i> Data Pegawai</a>
					                    </h4>
					                </div>
													
													<div class="panel-collapse collapse in" id="collapseOne" aria-expanded="true" style="">
        <div class="panel-body">
          <div class="dataTables_wrapper form-inline dt-bootstrap no-footer" id="demo-dt-addrow_wrapper">
            <div class="newtoolbar">
              <div class="table-toolbar-left" id="demo-custom-toolbar2">
                 <div class="btn-group">
              <button class="btn btn-mint btn-labeled fa fa-edit btn-sm" onclick="proses_pensiun();">Proses Pensiun/Keluar</button> 
								 </div>
              </div>
            </div>
            <div class="dataTables_filter" id="demo-dt-addrow_filter">
              <label>Search:<input aria-controls="demo-dt-addrow" class="form-control input-sm" placeholder="" type="search" id="search" onkeydown="if(event.keyCode=='13'){loaddata(0);}" ></label>
             
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
</div>
      </div>
</div>
      <div class="tab-pane fade" id="demo-lft-tab-pensiun">
      <div class="ag-theme-balham" id="myGridMutasi" style="height: 400px;width:100%;">
              </div>
          </div>
      <div class="tab-pane fade" id="demo-lft-tab-3">
           
      </div>
    </div>
  </div>
	
	
</div>

	<div class="row pad-all">
	 
							<div id="profilePage"></div>
	 
							</div>

	
	<script charset="utf-8" type="text/javascript">
		$('.judul-menu').html('Mutasi Jabatan Pegawai');
//<![CDATA[
           // specify the columns
           var columnDefs = [
            {headerName: "NIP", field: "nip", width: 190, filterParams:{newRowsAction: 'keep'}},
			{headerName: "NIK", field: "nik", width: 190, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Nama", field: "nama", width: 190, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Direktorat", field: "nama_group", width: 190, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Jabatan", field: "nama_uk", width: 190, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Username", field: "username", width: 190, filterParams:{newRowsAction: 'keep'}},
           {headerName: "E-Mail", field: "email", width: 190, filterParams:{newRowsAction: 'keep'}},
           
        ];

        var autoGroupColumnDef = {
           headerName: "Group",
           width: 200,
           field: 'nama_group',
           valueGetter: function(params) {
               if (params.node.group) {
                   return params.node.key;
               } else {
                   return params.data[params.colDef.field];
               }
           },
           headerCheckboxSelection: true,
           // headerCheckboxSelectionFilteredOnly: true,
           cellRenderer:'agGroupCellRenderer',
           cellRendererParams: {
               checkbox: true
           }
        };

        var gridOptions = {
           enableSorting: true,
           enableFilter: true,
           suppressRowClickSelection: false,
           onRowDoubleClicked: proses_pensiun, 
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
           defaultColDef:{
               editable: false,
               enableRowGroup:true,
               enablePivot:true,
               enableValue:true
           }
        };

        // setup the grid after the page has finished loading 
           var gridDiv = document.querySelector('#myGrid');
           new agGrid.Grid(gridDiv, gridOptions);

           // do http request to get our sample data - not using any framework to keep the example self contained.
           // you will probably use a framework like JQuery, Angular or something else to do your HTTP calls.
           function loaddata(jml){
            var search = 0;
            if($('#search').val() !==''){
              search = $('#search').val();
            }
           $.ajax({
                                   url: BASE_URL+'users/list/'+search+'/'+jml,
                                   headers: {
                                       'Authorization': localStorage.getItem("Token"),
                                       'X_CSRF_TOKEN':'donimaulana',
                                       'Content-Type':'application/json'
                                   },
                                   dataType: 'json',
                                   type: 'get',
                                   contentType: 'application/json', 
                                   processData: false,
                                   success: function( data, textStatus, jQxhr ){
                      
                        
                     gridOptions.api.setRowData(data.result);
                     paging(data.total,'loaddata');
                                   },
                                   error: function( jqXhr, textStatus, errorThrown ){
                                       alert('error');
                                   }
                               });

           }
           
           loaddata(0);
					 
					 
        
        function proses_pensiun(){
            var selectedRows = gridOptions.api.getSelectedRows();
            // alert('>>'+selectedRows+'<<<');
            if(selectedRows == ''){
               onMessage('Silahkan Pilih Pegawai yang akan dipensiun Terlebih dahulu!');
               return false;
            }else{
                var selectedRowsString = '';
           selectedRows.forEach( function(selectedRow, index) {
            
               if (index!==0) {
                   selectedRowsString += ', ';
               }
               selectedRowsString += selectedRow.id;
           });
          

//POPUP
bootbox.dialog({ 
                   message:$('<div></div>').load('view/pegawai/input_pensiun.php'),
                   animateIn: 'bounceIn',
                   animateOut : 'bounceOut',
									 backdrop: false,
                   size:'large',
                   buttons: {
                       success: {
                           label: "Save",
                           className: "btn-primary",
                           callback: function() {
                            $('#txtIdUser').val(selectedRowsString);
                               if(simpan()){
                                           return true;
                                       }else{
                                           return false;
                                       }
                                       
                           }
                       },

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

                     
                       
    getOptions("id_alasan",BASE_URL+"master/getmaster?id=23");
   
//	getOptions("txtjabfung",BASE_URL+"master/jabatan_asn");
	//getOptions("txtjabatan",BASE_URL+"master/jabatan_struktural");
	//getOptions("txtgolongan",BASE_URL+"master/golongan_pegawai");

//END POPUP




						}

        }


             function simpan(){
                  var direktorat	= $('#pejabat').val();
                  var tgl_pensiun = 	$('#tgl_pensiun').val();
                     if(empty($('#id_alasan').val())){
												 onMessage("Data 'Nama Pejabat' Wajib diisi");
                           
                           return false;
												}else if(empty($('#tgl_keluar').val())){
												 onMessage("Data 'TMT' Wajib diisi");
                           
                           return false;
												}else if(empty($('#pejabat').val())){
												 onMessage("Data 'Nama Pejabat' Wajib diisi");
                           
                           return false;
												}else if(empty($('#no_sk').val())){
												 onMessage("Data 'No SK' Wajib diisi");
                           
                           return false;
												}else{
												
														var data = formJson('form-pensiun');//$("#form-upload").serializeArray();
														$.ajax({
														url: BASE_URL+'pegawai/savepensiun',
														headers: {
																'Authorization': localStorage.getItem("Token"),
																'X_CSRF_TOKEN':'donimaulana',
																'Content-Type':'application/json'
																},
																dataType: 'json',
																type: 'post',
																contentType: 'application/json', 
																processData: false,
																data:data,
																success: function( data, textStatus, jQxhr ){
																										hasil=data.hasil;
																										message=data.message; 
																											 if(hasil=="success"){         
																																
																																	 $.niftyNoty({
																																									 type: 'success',
																																									 title: 'Success',
																																									 message: message,
																																									 container: 'floating',
																																									 timer: 5000
																																							 });
																																	// $("#f_id_edit").val(data.id);
                                                                                                                                     loaddata(0);
                                                                                                                                     loadMutasi();
																																	 $('.modal').modal('hide');
																														 }else{
																																		 
																																	return false;	
																														 }
																		 
																		 
																	},
																	error: function( jqXhr, textStatus, errorThrown ){
																			 $.niftyNoty({
																														type: 'danger',
																														title: 'Warning!',
																														message: message,
																														container: 'floating',
																														timer: 5000
																												});
																	}
																});
													 
                       }  
             }
             
             
           
           
  //]]>
  
  

    
  var columnDefsHis = [
            {headerName: "Nama", field: "nama", width: 190, filterParams:{newRowsAction: 'keep'}},
            {headerName: "Tgl.Keluar", field: "tgl_keluar", width: 190, filterParams:{newRowsAction: 'keep'}},
            {headerName: "Alasan", field: "alasan", width: 190, filterParams:{newRowsAction: 'keep'}},
			
           
           {headerName: "Keterangan", field: "keterangan", width: 190, filterParams:{newRowsAction: 'keep'}},
           {headerName: "No.SK", field: "no_sk", width: 190, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Pejabat penandatangan", field: "dir_tujuan", width: 190, filterParams:{newRowsAction: 'keep'}},
             ];

        var gridOptionsMutasi = {
           enableSorting: true,
           enableFilter: true,
           suppressRowClickSelection: false, 
           groupSelectsChildren: true,
           debug: true,
            rowSelection: 'single',
           enableColResize: true,
           rowGroupPanelShow: 'always',
           pivotPanelShow: 'always',
           enableRangeSelection: true,
           columnDefs: columnDefsHis,
           pagination: false,
           paginationPageSize: 50,
           autoGroupColumnDef: autoGroupColumnDef,
           defaultColDef:{
               editable: false,
               enableRowGroup:true,
               enablePivot:true,
               enableValue:true
           }
        };

        // setup the grid after the page has finished loading 
           var gridDiv = document.querySelector('#myGridMutasi');
           new agGrid.Grid(gridDiv, gridOptionsMutasi);
   
           function loadMutasi(){
            $.ajax({
                                   url: BASE_URL+'users/listpensiun',
                                   headers: {
                                       'Authorization': localStorage.getItem("Token"),
                                       'X_CSRF_TOKEN':'donimaulana',
                                       'Content-Type':'application/json'
                                   },
                                   dataType: 'json',
                                   type: 'get',
                                   contentType: 'application/json', 
                                   processData: false,
                                   success: function( data, textStatus, jQxhr ){
                      
                        
                                    gridOptionsMutasi.api.setRowData(data.result); 
                                   },
                                   error: function( jqXhr, textStatus, errorThrown ){
                                       alert('error');
                                   }
                               });
           }
     

           loadMutasi();
function cari(a){
    if (a.value.length > 4) {
          // do search for this.value here
          alert('search');
     }
}
           

  </script><script src="js/login.js" type="text/javascript">
</script>
 