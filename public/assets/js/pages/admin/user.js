if (typeof filter_url === "undefined") {
    var filter_url = "";
}
if (typeof delete_url === "undefined") {
    var delete_url = "";
}
if (typeof block_url === "undefined") {
    var block_url = "";
}
if (typeof view_url === "undefined") {
    var view_url = "";
}
if (typeof exists_url === "undefined") {
    var exists_url = "";
}

function allRecordsInExportAction(e, dt, button, config) {
    var self = this;
    var oldStart = dt.settings()[0]._iDisplayStart;
    dt.one("preXhr", function (e, s, data) {
        // Just this once, load all data from the server...
        data.start = 0;
        data.length = 2147483647;
        dt.one("preDraw", function (e, settings) {
            // Call the original action function
            if (button[0].className.indexOf("buttons-copy") >= 0) {
                $.fn.dataTable.ext.buttons.copyHtml5.action.call(
                    self,
                    e,
                    dt,
                    button,
                    config,
                );
            } else if (button[0].className.indexOf("buttons-excel") >= 0) {
                $.fn.dataTable.ext.buttons.excelHtml5.available(dt, config)
                    ? $.fn.dataTable.ext.buttons.excelHtml5.action.call(
                          self,
                          e,
                          dt,
                          button,
                          config,
                      )
                    : $.fn.dataTable.ext.buttons.excelFlash.action.call(
                          self,
                          e,
                          dt,
                          button,
                          config,
                      );
            } else if (button[0].className.indexOf("buttons-csv") >= 0) {
                $.fn.dataTable.ext.buttons.csvHtml5.available(dt, config)
                    ? $.fn.dataTable.ext.buttons.csvHtml5.action.call(
                          self,
                          e,
                          dt,
                          button,
                          config,
                      )
                    : $.fn.dataTable.ext.buttons.csvFlash.action.call(
                          self,
                          e,
                          dt,
                          button,
                          config,
                      );
            } else if (button[0].className.indexOf("buttons-pdf") >= 0) {
                $.fn.dataTable.ext.buttons.pdfHtml5.available(dt, config)
                    ? $.fn.dataTable.ext.buttons.pdfHtml5.action.call(
                          self,
                          e,
                          dt,
                          button,
                          config,
                      )
                    : $.fn.dataTable.ext.buttons.pdfFlash.action.call(
                          self,
                          e,
                          dt,
                          button,
                          config,
                      );
            } else if (button[0].className.indexOf("buttons-print") >= 0) {
                $.fn.dataTable.ext.buttons.print.action(e, dt, button, config);
            }
            dt.one("preXhr", function (e, s, data) {
                // DataTables thinks the first item displayed is index 0, but we're not drawing that.
                // Set the property to what it was before exporting.
                settings._iDisplayStart = oldStart;
                data.start = oldStart;
            });
            // Reload the grid with the original page. Otherwise, API functions like table.cell(this) don't work properly.
            setTimeout(dt.ajax.reload, 0);
            // Prevent rendering of the full data to the DOM
            return false;
        });
    });
    // Requery the server with the new one-time export settings
    dt.ajax.reload();
}

$(function () {
    if ($(".data-table").length) {
        var table = $(".data-table").DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ordering: false,
            dom: "<'row'<'col-12 col-md'l><'col-12 col-md-auto text-center'B><'col-12 col-md-auto'f>><'row'<'col-12'tr>><'row'<'col-12 col-md-5'i><'col-12 col-md-7'p>>",
            buttons: [
                {
                    extend: "csv",
                    className: "py-2 px-3 btn-primary",
                    title: "Users",
                    action: allRecordsInExportAction,
                    exportOptions: {
                        columns: ":not(.not-export)",
                    },
                },
            ],
            ajax: {
                type: "GET",
                url: filter_url,
            },
            columns: [
                { data: "DT_RowIndex", name: "DT_RowIndex", searchable: false },
                { data: "name", name: "name" },
                { data: "email", name: "email" },
                { data: "phone_number", name: "phone_number" },
                {
                    data: "status",
                    name: "status",
                    orderable: false,
                    searchable: false,
                },
                {
                    data: "action",
                    name: "action",
                    orderable: false,
                    searchable: false,
                    class: "text-white-space text-center",
                },
            ],
        });
    }

    $(document).on("click", ".delete", function () {
        var $button = $(this);
        var data_id = $(this).data("id");
        Swal.fire({
            title: "Delete user",
            text: "Are you sure you want to delete this user?",
            showCloseButton: true,
            confirmButtonText: "Yes, delete it",
            customClass: {
                confirmButton: "btn-danger",
            },
            showLoaderOnConfirm: true,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "DELETE",
                    url: delete_url.replace("userid", data_id),
                    data: { id: data_id },
                    success: function (data) {
                        if (typeof data !== "undefined") {
                            if (
                                typeof data.status !== "undefined" &&
                                data.status == true
                            ) {
                                table.ajax.reload();
                                successToast(data.message);
                            } else {
                                errorToast(data.message);
                            }
                        } else {
                            errorToast(
                                "Oops! Something went wrong. Please try again.",
                            );
                        }
                    },
                    error: function (data) {
                        errorToast(
                            "Oops! Something went wrong. Please try again.",
                        );
                    },
                });
            }
        });
    });

    $(document).on("click", ".block-unblock", function () {
        var _this = $(this);
        var data_id = $(this).data("id");
        var data_status = $(this).data("status");
        var title = data_status == 1 ? "Activate user" : "Deactivate user";
        var text =
            data_status == 1
                ? "Are you sure you want to activate this user account?"
                : "Are you sure you want to deactivate this user account?";
        var btnText =
            data_status == 1 ? "Yes, activate it" : "Yes, deactivate it";
        var btnClass = data_status == 1 ? "btn-success" : "btn-danger";
        var status = data_status == 1 ? 1 : 2;
        var data_title =
            data_status != 1
                ? "<i class='bx bxs-lock'></i>"
                : "<i class='bx bxs-lock-open'></i>";
        data_status = data_status == 1 ? 2 : 1;
        Swal.fire({
            title: title,
            text: text,
            showCloseButton: true,
            confirmButtonText: btnText,
            customClass: {
                confirmButton: btnClass,
            },
            showLoaderOnConfirm: true,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: block_url,
                    data: { id: data_id, status: status },
                    success: function (data) {
                        if (typeof data !== "undefined") {
                            if (
                                typeof data.status !== "undefined" &&
                                data.status == true
                            ) {
                                successToast(data.message);
                                _this.data("status", data_status);
                                _this.html(data_title);
                                table.ajax.reload();
                            } else {
                                errorToast(data.message);
                            }
                        } else {
                            errorToast(
                                "Oops! Something went wrong. Please try again.",
                            );
                        }
                    },
                    error: function (data) {
                        errorToast(
                            "Oops! Something went wrong. Please try again.",
                        );
                    },
                });
            }
        });
    });

    $(document).on("click", ".view", function () {
        var data_id = $(this).data("id");
        if (typeof data_id !== "undefined" && data_id != "") {
            $.ajax({
                type: "POST",
                url: view_url.replace("userid", data_id),
                data: { id: data_id },
                success: function (data) {
                    if (typeof data.data !== "undefined" && data.data != null) {
                        data = data.data;
                        $("#name").html(data.name);
                        $("#email").html(data.email);
                        $("#phone_number").html(
                            `${data?.phone_number} ${data.phone_number}`,
                        );

                        $("#viewUserModal").modal({ show: true });
                    } else {
                        errorToast(
                            "Oops! Something went wrong. Please try again.",
                        );
                    }
                },
                error: function (data) {
                    errorToast("Oops! Something went wrong. Please try again.");
                },
            });
        }
    });

    $("#viewUserModal").on("hidden.bs.modal", function () {
        $("#viewUserModal").find("span").html("");
    });

    if (typeof validate !== "function" && $.fn.validate) {
        $(".form-validate").validate({
            rules: {
                name: {
                    required: true,
                    normalizer: function (value) {
                        return $.trim(value);
                    },
                    maxlength: 255,
                },
                country_code: {
                    required: true,
                    normalizer: function (value) {
                        return $.trim(value);
                    },
                },
                email: {
                    required: true,
                    normalizer: function (value) {
                        return $.trim(value);
                    },
                    maxlength: 255,
                    remote: {
                        type: "POST",
                        url: exists_url,
                        async: false,
                        beforeSend: function () {
                            $("#email").attr("disabled", true);
                        },
                        complete: function () {
                            $("#email").attr("disabled", false);
                        },
                        data: {
                            id: $('input[name="id"]').val(),
                        },
                    },
                },
                phone_number: {
                    required: true,
                    normalizer: function (value) {
                        return $.trim(value);
                    },
                    digits: true,
                    minlength: 7,
                    maxlength: 15,
                },
                photo: {
                    required: false,
                    normalizer: function (value) {
                        return $.trim(value);
                    },
                    extension: "png|jpg|jpeg",
                    filesize: 5000000,
                },
            },
            messages: {
                name: {
                    required: "Please enter a name",
                },
                email: {
                    required: "Please enter a email",
                    remote: "This email is already exists",
                },
                country_code: {
                    required: "Please select country code",
                },
                phone_number: {
                    required: "Please enter a phone number",
                    minlength: $.validator.format(
                        "Please enter at least {0} digits.",
                    ),
                    maxlength: $.validator.format(
                        "Maximum {0} digits allowed.",
                    ),
                },
                photo: {
                    required: "Please select a profile image",
                    filesize: "Photo size must be less than or equal to 5MB",
                },
            },
            errorPlacement: function (error, element) {
                if (
                    element.attr("name") === "phone_number" ||
                    element.attr("name") === "country_code"
                ) {
                    error.appendTo(element.closest(".phone-wrapper"));
                } else {
                    error.insertAfter(element);
                }
            },
        });
    }
});
