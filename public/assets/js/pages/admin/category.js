if (typeof filter_url === "undefined") { var filter_url = ""; }
if (typeof delete_url === "undefined") { var delete_url = ""; }
if (typeof exists_url === "undefined") { var exists_url = ""; }

$(function () {
    if ($(".data-table").length) {
        var table = $(".data-table").DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: {
                type: "POST",
                url: filter_url,
            },
            columns: [
                { data: "DT_RowIndex", name: "DT_RowIndex", searchable: false, orderable: false, width: "50px" },
                { data: "name", name: "name" },
                { data: "action", name: "action", orderable: false, searchable: false, class: "text-white-space text-center" },
            ],
        });
    }

    $(document).on("click", ".delete", function () {
        var data_id = $(this).data("id");
        Swal.fire({
            title: "Delete category",
            text: "Are you sure you want to delete this category?",
            showCloseButton: true,
            confirmButtonText: "Yes, delete it",
            customClass: {
                confirmButton: "btn-danger",
            },
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "DELETE",
                    url: delete_url.replace('categoryid', data_id),
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
                            errorToast(
                                "Oops! Something went wrong. Please try again."
                            );
                        }
                    },
                    error: function (data) {
                        errorToast(
                            "Oops! Something went wrong. Please try again."
                        );
                    },
                });
            }
        });
    });

    if (typeof validate !== "function" && $.fn.validate) {
        $(".form-validate").on('submit', function (e) {
            extraFieldValidations();
            e.preventDefault();
            let isValid = $(this).validate().form();
            if (isValid) {
                return true;
            } else {
                return false;
            }
        });
        $(".form-validate").validate({
            rules: {
                name: {
                    required: true,
                    normalizer: function (value) {
                        return $.trim(value);
                    },
                    alphadash: true,
                    maxlength: 255,
                    remote: {
                        type: "POST",
                        url: exists_url,
                        async: false,
                        beforeSend: function () { $("#name").attr('disabled', true) }, complete: function () { $("#name").attr('disabled', false) },
                        data: {
                            id: $('input[name="id"]').val(),
                        },
                    },
                },
            },
            messages: {
                name: {
                    required: "Please enter a category name",
                    remote: "This category name is already exists!",
                },
            },
        });
    }
});

function extraFieldValidations() {
    if ($(".category-name").length) {
        $(".category-name").each(function () {
            let element = $(this);
            $(this).rules("add", {
                required: true,
                normalizer: function (value) {
                    return $.trim(value);
                },
                alphadash: true,
                unique: true,
                maxlength: 255,
                remote: {
                    type: "POST",
                    url: exists_url,
                    async: false,
                    mode: "abort",
                    beforeSend: function (e) { $(element).attr('disabled', true) }, complete: function () { $(element).attr('disabled', false) },
                    data: {
                        id: $('input[name="id"]').val(),
                        name: $(this).val(),
                    },
                },
                messages: {
                    required: "Please enter a category name",
                    remote: "This category name is already exists!",
                },
            });
        });
    }
}
