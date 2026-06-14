$(document).ready(function () {
    $(document).on("change", "input.document", function () {
        readDocURL(this);
    });

    $(document).on("click", ".radio-button", function (event) {
        $(".radio-button").not(this).prop("checked", false);
        $(".radio-button").val("");
        $(this).val(1);
    });

    $(document).on("click", ".upload-document .icon-remove", function () {
        console.log(1);
        let _parent = $(this).parents(".upload-document");
        $(_parent).removeClass("show pdf image video");
        $(_parent).find("input.remove").val(1);
    });

    $(document).on("click", ".upload-document .icon-edit", function () {
        console.log(1);
        let _parent = $(this).parents(".upload-document");
        $(_parent).find("input.document").trigger("click");
    });

    $(document).on(
        "click",
        ".upload-document-section .upload-doc",
        function (event) {
            var parent = $(this).parents(".upload-document-section");
            $(parent).find(".upload-doc").hide();
            $(parent).find(".upload-multiple-file input").trigger("click");
            $(parent).find(".upload-section").show();
        },
    );

    $(document).on(
        "click",
        ".upload-document-section .upload-document:not(.identity-verification) .icon-cross",
        function () {
            var _this = $(this);
            $(_this).parents(".upload-item").remove();
        },
    );
});

function readDocURL(element) {
    var parent = $(element).parents(".upload-document");
    var file = element.files[0];

    parent.removeClass("show pdf image video");

    parent.next(".file-name").html("");
    if ($(element).val() != "" && $(element).valid()) {
        parent.next(".file-name").html(file["name"]);
        var ext = file["name"].substr(file["name"].lastIndexOf(".") + 1);
        if ($.inArray(ext, ["pdf", "docx", "doc"]) > -1) {
            parent.addClass("show pdf");
        } else if ($.inArray(ext, ["mp4", "mov", "m4a"]) > -1) {
            parent.addClass("show video");
            $(parent)
                .find(".icon-video source")
                .attr("src", URL.createObjectURL(file));
            $(parent).find(".icon-video")[0].load();
        } else {
            $(parent)
                .find(".icon-image")
                .attr("src", window.URL.createObjectURL(file));
            parent.addClass("show image");
        }

        if (
            $(parent).parents(".upload-item")[0] ==
            $(parent).parents(".upload-multiple-file").children().first()[0]
        ) {
            var ce = parent.parents(".upload-item").clone();
            ce.find("input").val("").trigger("change");

            ce.find(".file-name").html("");
            ce.find(".upload-document").removeClass("show");
            $(parent).closest(".upload-multiple-file").prepend(ce);

            if ($('.upload-document input[type="radio"]').length == 2) {
                $($('.upload-document input[type="radio"]')[1])
                    .prop("checked", true)
                    .trigger("change");
            }

            var sectionsCount = 0;
            $(parent)
                .closest(".upload-multiple-file")
                .find(".upload-item")
                .each(function () {
                    $(this)
                        .find("input")
                        .each(function () {
                            var txtName = this.getAttribute("name");
                            txtName = txtName.replace(
                                /\[\d+\]+/g,
                                "[" + sectionsCount + "]",
                            );
                            this.setAttribute("name", txtName);
                        });
                    sectionsCount++;
                });
        }
    } else {
        parent.find("input").val("");
        if ($(".upload-multiple-file .upload-item").length > 1) {
            //
        }
    }
}
