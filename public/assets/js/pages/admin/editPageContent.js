$(function () {
    CKEDITOR.replace("page_content", {
        height: "350px",
        toolbarGroups: [
            { name: "styles", groups: ["styles"] },
            {
                name: "paragraph",
                groups: [
                    "list",
                    "indent",
                    "blocks",
                    "align",
                    "bidi",
                    "paragraph",
                ],
            },
            { name: "insert", groups: ["insert"] },
            { name: "basicstyles", groups: ["basicstyles", "cleanup"] },
            { name: "colors", groups: ["colors"] },
            { name: "clipboard", groups: ["clipboard", "undo"] },
            {
                name: "editing",
                groups: ["find", "selection", "spellchecker", "editing"],
            },
            { name: "forms", groups: ["forms"] },
            { name: "links", groups: ["links"] },
            { name: "document", groups: ["mode", "document", "doctools"] },
        ],
        removeButtons:
            "Save,Language,Templates,NewPage,Preview,Print,Replace,Find,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,Flash,Smiley,Iframe,Font,About",
        image_previewText: " ",
        removeDialogTabs: "image:advanced;image:Link",
        filebrowserUploadUrl: image_upload_url,
        filebrowserUploadMethod: "form",
    });

    // Setup validation
    if (typeof validate !== "function" && $.fn.validate) {
        var validation = $(".edit-page-form-validate").validate({
            ignore: [],
            rules: {
                page_content: {
                    required: function () {
                        CKEDITOR.instances.page_content.updateElement();

                        var editorcontent = $("#page_content")
                            .val()
                            .replace(/<[^>]*>/gi, "")
                            .replace(/&nbsp;/g, "")
                            .trim();

                        return editorcontent.length === 0;
                    },
                },
            },
            messages: {
                page_content: {
                    required: "Please enter a page content",
                },
            },
        });
    }
});
