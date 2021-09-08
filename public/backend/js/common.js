function clearForm() {
    $('#form-search').find("input[type=text], textarea, select").val("");
}

function checkAll() {
    var isCheck = $('#check-all').is(':checked') ? 1 : 0;
    if (isCheck) {
        $('#table-list input[type=checkbox]').prop('checked', true);
    } else {
        $('#table-list input[type=checkbox]').prop('checked', false);
    }
}
function checkItem() {
    $('#check-all').prop('checked', false);
}

/**
 * Delete items
 */
function deleteItems() {
    $('#form-delete-items').submit();
}
