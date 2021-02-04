    $(document).ready( function () {
        var table = $('#userList').DataTable({
            dom: 'Bfrtip',
            buttons: [ {
            extend: 'colvis',
            columnText: function ( dt, idx, title ) {
                return (idx+1)+': '+title;
            }
        } ]
        });
    } );