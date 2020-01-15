var delayvpt = (function() {
    var timer = 0;
    return function(callback, ms) {
        clearTimeout(timer);
        timer = setTimeout(callback, ms);
    };
})();

$('#tukhoaxlc').keyup(function() {
    delayvpt(function() {
        AutoComplete();
    }, 500);
});

function AutoComplete() {
    var keyword = $.trim($('#tukhoaxlc').val());
    if (keyword != "" && $.trim($('#tukhoaxlc').val()).length > 1) {
        $('.autocomplete-suggestions').html('<span id="loading"></span>');
        $('.autocomplete-suggestions').css('display', 'block');
        $.ajax({
            type: "POST",
            url: base_url + "search.php",
            data: "key=" + keyword,
            success: function(message) {
                tukhoa = keyword.toLowerCase().replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a").replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e").replace(/ì|í|ị|ỉ|ĩ/g, "i").replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o").replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u").replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y").replace(/đ/g, "d").replace(/[éèêë]/g, "e").replace(/[îï]/g, "i").replace(/[ô]/g, "o").replace(/[ùû]/g, "u").replace(/[ñ]/g, "n").replace(/[äæ]/g, "ae").replace(/[öø]/g, "oe").replace(/[ü]/g, "ue").replace(/[ß]/g, "ss").replace(/[å]/g, "aa").replace(/[^-a-z0-9~\s\.:;+=_]/g, '').replace(/[\s\.:;=+]+/g, '+').replace(/-+-/g, "-").replace(/^\-+|\-+$/g, "");
                if (message != "") {
                    $('.autocomplete-suggestions').html(message);
                } else {
                    $('.autocomplete-suggestions').html('<a href="'+ base_url + 'search/' + tukhoa + '/" id="text-search-key">Nhấn Enter để tìm kiếm nâng cao</a>');
                }
            }
        });
    } else {
        $('.autocomplete-suggestions').html('');
    }
}