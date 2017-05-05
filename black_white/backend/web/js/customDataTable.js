/* 
 * The code above put the data-tables in page
 */

    $(document).ready(function () {
       
        // Setup - add a text input to each header cell
        $('table  thead  .search ').each(function () {
            var title = $(this).text();
            $(this).append('<br><br><input type="text" placeholder="Search ' + title + '" />');
        });

        // DataTable
        var table = $('table').DataTable({
            responsive: true,
            keys: true
        });

        // Apply the search
        table.columns().every(function () {
            var that = this;

            $('input', this.header()).on('keyup change', function () {
                if (that.search() !== this.value) {
                    that
                            .search(this.value)
                            .draw();
                }
            });
        });

    });

