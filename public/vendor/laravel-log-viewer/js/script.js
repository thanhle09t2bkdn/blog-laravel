$(document).ready(function () {
    $('.table-container tr').on('click', function () {
        $('#' + $(this).data('display')).toggle();
    });
    $('#delete-log, #clean-log, #delete-all-log').click(function () {
        return confirm('Are you sure?');
    });
});
