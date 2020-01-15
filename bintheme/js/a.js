$.ajax({
    url: base_url + "ajax/load_login_status",
    type: "GET",
    dataType: "json",
    success: function(e) {
        $("#top-user").html(e.content), 1 == e.is_login && (is_login = !0)
    }
}), $("#request-form").submit(function(e) {
    var a = $(this).serializeArray(),
        t = $(this).attr("action");
    $.ajax({
        url: t,
        type: "POST",
        data: a,
        dataType: "json",
        success: function(e) {
            if ($(".error-block").hide(), 0 == e.status)
                for (var a in e.messages) $("#error-" + a).show(), $("#error-" + a).text(e.messages[a]);
            1 == e.status && ($("#message-success").show(), setTimeout(function() {
                $("#message-success").hide()
            }, 5e3), document.getElementById("request-form").reset())
        }
    }), e.preventDefault()
});
jQuery("#btn-toggle-error").on("click", function() {
        jQuery.post("/ajax/error/", {
            film_id: filmInfo.filmID,
            episode_id: filmInfo.episodeID
        }, function(a) {
            1 == a && toastr.info("Thông báo của bạn đã được gửi đi, BQT sẽ khắc phục trong thời gian sớm nhất. Thank!")
        }), jQuery(this).remove()
    }),jQuery("#btn-add-favorite").on("click", function() {
         $.ajax({
            method: "POST",
            url: base_url + "ajax/user_favorite",
            data: {
            filmID: filmInfo.filmID
            },
            success: function(a) {
                                1 == a ? toastr.info("Lỗi", "Bạn cần đăng nhập để sử dụng chức năng này") : 2 == a ? toastr.info("Phim đã được xóa khỏi tủ phim của bạn.") : 3 == a && (jQuery(".btn-text").html("Xóa khỏi tủ phim"), toastr.info("Phim đã được thêm vào tủ phim của bạn."))
            }
        }), !1
});