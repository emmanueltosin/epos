var App = (function () {
  'use strict';

  App.dataTables = function( ){

    //We use this to apply style to certain elements
    $.extend( true, $.fn.dataTable.defaults, {
      dom:
        "<'row be-datatable-header'<'col-sm-6'l><'col-sm-6'f>>" +
        "<'row be-datatable-body'<'col-sm-12'tr>>" +
        "<'row be-datatable-footer'<'col-sm-5'i><'col-sm-7'p>>"
    } );
    //Enable toolbar button functions
	 $("#table3").dataTable({
			  buttons: [
            {
                extend: 'copyHtml5',
                exportOptions: {
                   columns: ':visible'
                }
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                   columns: ':visible'
                }
            },
			{
                extend: 'print',
                exportOptions: {
                   columns: ':visible'
                }
            },
            'colvis'
        ],
		  'filter':true,
		  'bFilter':true,
		  "lengthMenu": [[6, 10, 25, 50, -1], [6, 10, 25, 50, "All"]],
		  dom:  "<'row be-datatable-header'<'col-sm-2'l><'col-sm-6 text-right'B><'col-sm-4 text-right'f>>" +
				"<'row be-datatable-body'<'col-sm-12'tr>>" +
				"<'row be-datatable-footer'<'col-sm-5'i><'col-sm-7'p>>"
		 });

  };

  return App;
})(App || {});
