    $(document).ready( function () {
        var table = $('#currenciesTable').DataTable({
            dom: 'Bfrtip',
            buttons: [ {
            extend: 'colvis',
            columnText: function ( dt, idx, title ) {
                return (idx+1)+': '+title;
            }
        } ]
        });
    new $.fn.dataTable.Buttons( table, {
        buttons: [
            {
                text: 'Export to CSV',
                action: function ( e, dt, node, conf ) {
                    var url = "/export";
                    document.location.href = window.location+url;
                }
            }
        ]
    } );
 
    table.buttons( 1, null ).container().appendTo(
        table.table().container()
    );
    } );

