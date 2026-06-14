if (typeof filter_cms_page_url === "undefined") { var filter_cms_page_url = ""; }

$(function () {
    if ($('.data-table').length) {
        var table = $('.data-table').DataTable({
            "pageLength": 25,
            responsive: true,
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: {
                type: "POST",
                url: filter_cms_page_url,
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false },
                { data: 'page_name', name: 'page_name' },
                { data: 'action', name: 'action', orderable: false, searchable: false, class: "text-center" },
            ]
        });
    }

    if (typeof validate !== 'function' && $.fn.validate) {
        var validator = $(".cms-page-form-validate").validate({

        });

        $.validator.addClassRules("short-title", {
            required: true,
            minlength: 5,
            maxlength: 20,
        });

        $.validator.addClassRules("title", {
            required: true,
            minlength: 5,
            maxlength: 50,
        });

        $.validator.addClassRules("heading", {
            required: true,
            minlength: 5,
            maxlength: 50,
        });

        $.validator.addClassRules("link", {
            required: true,
            normalizer: function (value) { return $.trim(value); },
            url: true
        });

        $.validator.addClassRules("contents", {
            required: true,
            normalizer: function (value) { return $.trim(value); },
            minlength: 5,
            maxlength: 750,
        });

        $.validator.addMethod('minImageWidth', function (value, element, minWidth) {
            if (value == '') {
                return true;
            }
            return ($(element).data('imageWidth') || 0) == minWidth;
        }, function (minWidth, element) {
            var imageWidth = $(element).data('imageWidth');
            return (imageWidth)
                ? ("Your image's width must be " + minWidth + "px")
                : "Accepted image formats: jpg, jpeg, png.";
        });

        $.validator.addMethod('minImageHeight', function (value, element, minHeight) {
            if (value == '') {
                return true;
            }
            return ($(element).data('imageHeight') || 0) == minHeight;
        }, function (minHeight, element) {
            var imageHeight = $(element).data('imageHeight');
            return (imageHeight)
                ? ("Your image's height must be " + minHeight + "px")
                : "Accepted image formats: jpg, jpeg, png.";
        });
    }

    var $images = $('.images');

    $('.images').change(function () {
        $images = $(this);
        $imgContainer = $(this).parent().find('div.imgContainer');
        $images.removeData('imageWidth');
        $imgContainer.hide().empty();

        var file = this.files[0];
        var permitted = ['image/jpg', 'image/jpeg', 'image/png'];
        if ($.inArray(file.type, permitted) > -1) {
            var img = new Image;
            img.onload = function () {
                var imageWidth = img.width;
                var imageHeight = img.height;
                $images.data('imageWidth', imageWidth);
                $images.data('imageHeight', imageHeight);
                var c = validator.element($images);
                if (c) {
                    $imgContainer.append('<img src="' + window.URL.createObjectURL(file) + '" width="250px" height="150px">').show();
                }
            }
            img.src = window.URL.createObjectURL(file);
        } else {
            validator.element($images);
        }
    });

    var $videos = $('.videos');
    $('.videos').change(function () {
        $videos = $(this);
        $vidContainer = $(this).parent().find('div.vidContainer');
        $vidContainer.hide().empty();

        var file = this.files[0];
        var permitted = ['video/mp4'];
        if ($.inArray(file.type, permitted) > -1) {
            $vidContainer.append('<video width="320" controls><source src="' + URL.createObjectURL(file) + '" type="video/mp4">Your browser does not support the video tag.</video>').show();
        } else {
            validator.element($videos);
        }
    });

    var $banners = $('.banners');

    $('.banners').change(function () {
        $banners = $(this);
        $imgContainer = $(this).parent().find('div.imgContainer');
        $banners.removeData('imageWidth');
        $imgContainer.hide().empty();

        var file = this.files[0];
        var permitted = ['image/jpg', 'image/jpeg', 'image/png'];
        if ($.inArray(file.type, permitted) > -1) {
            var img = new Image;
            img.onload = function () {
                var imageWidth = img.width;
                var imageHeight = img.height;
                $banners.data('imageWidth', imageWidth);
                $banners.data('imageHeight', imageHeight);
                var c = validator.element($banners);
                if (c) {
                    $imgContainer.append('<img src="' + window.URL.createObjectURL(file) + '" width="70px">').show();
                }
            }
            img.src = window.URL.createObjectURL(file);
        } else {
            validator.element($banners);
        }
    });
});
