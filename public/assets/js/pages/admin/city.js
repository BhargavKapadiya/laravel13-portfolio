if (typeof filter_city_url === "undefined") { var filter_city_url = ""; }
if (typeof exists_url === "undefined") { var exists_url = ""; }
if (typeof delete_city_url === "undefined") { var delete_city_url = ""; }

$(function () {
    if ($('.data-table').length) {
        var table = $('.data-table').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: {
                type: "POST",
                url: filter_city_url,
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false },
                { data: 'name_en', name: 'name_en' },
                { data: 'name_ar', name: 'name_ar' },
                { data: 'action', name: 'action', orderable: false, searchable: false, class: "text-white-space text-center" },
            ]
        });
    }

    $(document).on('click', '.delete', function () {
        var data_id = $(this).data("id");
        Swal.fire({
            title: "Delete city",
            text: "Are you sure you want to delete this city?",
            showCloseButton: true,
            confirmButtonText: "Yes, delete it",
            customClass: {
                confirmButton: "btn-danger",
            },
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: delete_city_url,
                    data: { id: data_id },
                    success: function (data) {
                        if (typeof data !== "undefined") {
                            if (typeof data.status !== "undefined" && data.status == true) {
                                table.ajax.reload();
                                successToast(data.message);
                            } else {
                                errorToast(data.message);
                            }
                        } else {
                            errorToast("Oops! Something went wrong. Please try again.");
                        }
                    },
                    error: function (data) {
                        errorToast("Oops! Something went wrong. Please try again.");
                    }
                });
            }
        });
    });

    if (typeof validate !== 'function' && $.fn.validate) {
        $(".city-form-validate").validate({
            rules: {
                name_en: {
                    required: true,
                    normalizer: function (value) { return $.trim(value); },
                    minlength: 2,
                    maxlength: 255,
                    remote: {
                        type: "POST",
                        url: exists_url,
                        async: false,
                        beforeSend: function () { $("#name").attr('disabled', true) }, complete: function () { $("#name").attr('disabled', false) },
                        data: {
                            id: $('input[name="id"]').val(),
                        }
                    },
                },
                name_ar: {
                    required: true,
                    normalizer: function (value) { return $.trim(value); },
                    minlength: 2,
                    maxlength: 255,
                    remote: {
                        type: "POST",
                        url: exists_url,
                        data: {
                            id: $('input[name="id"]').val(),
                        }
                    },
                }
            },
            messages: {
                name_en: {
                    required: "Please enter a city name",
                },
                name_ar: {
                    required: "Please enter a city name",
                }
            }
        });
    }
});
