if (typeof get_notification_link === "undefined") { var get_notification_link = ""; }

$(document).ready(function () {
    if (typeof window.moment === 'undefined') {
        console.log("Moment.js not found. Loading...");
        var script = document.createElement('script');
        script.src = window.location.origin + "/assets/libs/moment/moment.min.js"; // use latest version as needed
        script.type = 'text/javascript';
        script.onload = function () {
            console.log("Moment.js loaded successfully.");
        };
        document.head.appendChild(script);
    } else {
        console.log("Moment.js is already loaded.");
    }

    if ($('.notification-list').length) {
        $(document).on('click hover', '.notification-icon', function () {
            $(".notification-list").find(".notification-body").empty();
            $.ajax({
                url: get_notification_link,
                type: 'POST',
                beforeSend: function () {
                    $('.notification-body').html(`<a href="javascript:void(0)" class="dropdown-item notify-item">Loading...</a>`);
                },
                success: function (response) {
                    $('.notification-body').html('');
                    if (response != "" && typeof response !== "undefined" && response.status == 1 && response.result !== "undefined" && response.result.length) {
                        var domElement = '';
                        $.each(response.result, function (k, v) {
                            var redirect_url = "javascript:;";
                            if (v.redirect_on != null) {
                                // if (v.type == 1 || v.type == 2) {
                                //     redirect_url = userUrl.replace('ids', v.redirect_on)
                                // }
                            }
                            var created_at = new Date(v.created_at);
                            if (typeof moment === 'function' && !!window.moment) {
                                created_at = moment(v.created_at).format('DD/MM/YYYY, h:mm a');
                            }
                            domElement += `<a href="${redirect_url}" class="dropdown-item notify-item border-bottom"><p class="notify-details ml-0">${v.text}<small class="text-muted opacity8 notify-time">${created_at}</small></p></a>`;
                        });

                        $('.notification-body').html(domElement);
                        $(".notification-icon-badge").remove();

                        if ($(".slimscroll").length) {
                            $(".slimscroll").slimScroll({ height: "auto", position: "right", size: "4px", touchScrollStep: 20, color: "#9ea5ab" });
                        }
                    } else {
                        $('.notification-body').html(`<a href="javascript:void(0)" class="dropdown-item notify-item">No notification found</a>`);
                    }
                }
            })
        })
    }
})
