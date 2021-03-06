 
	<div class="row ">
	 
		<div class="newtoolbar">
		  <div class="table-toolbar-left" id="demo-custom-toolbar2">
		    <div class="btn-group" style="padding-left:10px">
		      <button class="btn btn-mint btn-labeled fa fa-plus-square btn-sm" onClick="addKeluarga();">Add</button>
		      <button class="btn btn-mint btn-labeled fa fa-edit btn-sm" onclick="editKeluarga();">Edit</button>
		      <button class="btn btn-warning btn-labeled fa fa-close btn-sm" onclick="deletKeluarga();">Delete</button>
		    </div>
		  </div>
		</div>
	 
	</div>
    <div class="bootstrap-table">
            <div class="fixed-table-container" style="padding-bottom: 0px;">
              <div class="ag-theme-balham" id="gridKeluarga" style="height: 200px;width:100%;"></div>
               
            </div>
          </div>
    
  

<script>
	

var columnKeluarga = [ 
           {headerName: "NIK", field: "NIK", width: 190, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Nama", field: "nama", width: 190, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Tempat Lahir", field: "tpt_lahir", width: 190, filterParams:{newRowsAction: 'keep'}}, 
           {headerName: "Tgl.Lahir", field: "tgl_lahir", width: 190, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Gender", field: "kelamin", width: 190, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Hubungan", field: "hubkel", width: 190, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Pendidikan", field: "pendidikan", width: 190, filterParams:{newRowsAction: 'keep'}}, 
           {headerName: "Pekerjaan", field: "pekerjaan", width: 190, filterParams:{newRowsAction: 'keep'}},
           {headerName: "Dokumen", field: "url", 
              cellRenderer: function(params) {
                  return '<a href="api/upload/data/'+params.value+'" target="_blank"><i class="fa fa-eye"></i>Lihat Dokumen</a>'
              }
            },
        ];

var gridKeluargaOpt = {
           enableSorting: true,
           enableFilter: true,
           suppressRowClickSelection: false, 
           onRowDoubleClicked: editKeluarga,
           groupSelectsChildren: true,
           debug: true,
            rowSelection: 'single',
           enableColResize: true, 
           enableRangeSelection: true,
           columnDefs: columnKeluarga,
           pagination: false, 
           defaultColDef:{
               editable: false,
               enableRowGroup:false,
               enablePivot:false,
               enableValue:true
           }
        };
        
        


    var gridDiv = document.querySelector('#gridKeluarga');
    new agGrid.Grid(gridDiv, gridKeluargaOpt);
           
   
            
            
          
           
           
          
</script>