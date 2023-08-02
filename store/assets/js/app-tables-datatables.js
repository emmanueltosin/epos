var App = (function () {
  'use strict';

  App.dataTables = function( ){
      setTimeout(function(){
          $("#table3").attr('style','display:table !important;min-width:100% !important;');
      },100)

      $("#table3").dataTable(
          {
              buttons: [
                  'copy', 'excel', 'pdf', 'print'
              ],

              dom:  "<'row be-datatable-header'<'col-sm-2'l><'col-sm-5 text-right'B><'col-sm-4 text-right'f>>" +
                  "<'row be-datatable-body'<'col-sm-12'tr>>" +
                  "<'row be-datatable-footer'<'col-sm-5'i><'col-sm-7'p>>"
          }
      );
  };

  return App;
})(App || {});
