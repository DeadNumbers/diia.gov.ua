export default function adaptiveTable() {
    const table = $('table');
    if (table) {
        $.each(table, function() {
            if (!$(this).parent().hasClass('table-responsive')) {
                $(this).addClass('table');
                $(this).wrap('<div class="table-responsive">');
            }
        });
    }
}
