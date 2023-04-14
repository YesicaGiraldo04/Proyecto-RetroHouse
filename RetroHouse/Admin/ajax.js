let dataTable;
let dataTableIsInitialized = false;

if (dataTableIsInitialized){
    tadaTable.destroy();
}

dataTable = $("#usuarios").DataTable({});

dataTableIsInitialized = true;