if (typeof filter_url === "undefined") { var filter_url = ""; }
if (typeof delete_url === "undefined") { var delete_url = ""; }
if (typeof exists_url === "undefined") { var exists_url = ""; }

$(function () {
    if ($('.data-table').length) {
        var table = $('.data-table').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: {
                type: "POST",
                url: filter_url,
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false },
                { data: 'question', name: 'question' },
                { data: 'answer', name: 'answer' },
                { data: 'action', name: 'action', orderable: false, searchable: false, class: "text-white-space text-center" },
            ]
        });
    }

    $(document).on('click', '.delete', function () {
        var $button = $(this);
        var data_id = $(this).data("id");
        Swal.fire({
            title: "Delete FAQ",
            text: "Are you sure you want to delete this FAQ?",
            showCloseButton: true,
            confirmButtonText: "Yes, delete it",
            customClass: {
                confirmButton: "btn-danger",
            },
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "DELETE",
                    url: delete_url.replace('faqid', data_id),
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
        $(".faqs-form-validate").validate({
            rules: {
                question: {
                    required: true,
                    normalizer: function (value) { return $.trim(value); },
                    maxlength: 1000,
                    remote: {
                        type: "POST",
                        url: exists_url,
                        async: false,
                        beforeSend: function () { $("#question").attr('disabled', true) }, complete: function () { $("#question").attr('disabled', false) },
                        data: {
                            id: $('input[name="id"]').val(),
                        }
                    },
                },
                answer: {
                    required: true,
                    normalizer: function (value) { return $.trim(value); },
                    maxlength: 5000,
                },
            },
            messages: {
                question: {
                    required: "Please enter a question",
                    remote: "This question already exists",
                },
                answer: {
                    required: "Please enter an answer",
                },
            }
        });
    }
});
