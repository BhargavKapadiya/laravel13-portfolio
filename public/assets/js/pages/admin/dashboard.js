$(document).ready(function () {
    if (typeof validate !== 'function' && $.fn.validate) {
        var validator = $(".form-validate").validate({
            rules: {
                to_date: {
                    greaterThanDate: "#from_date",
                }
            },
        });
    }

    $(document).on('click', '.clear_filter', function () {
        $('#from_date').val('');
        $('#to_date').val('');
        $('#search-form').submit();
    });

    if ($('.data-table').length) {
        var table = $('.data-table').DataTable({
            responsive: true,
            "language": {
                "emptyTable": "No nominated charity found"
            }
        });
    }
});
