//--Film Info
$(document).ready(function () {
    // rating
    var filmId = $("#film_id").val();

    function scorehint(score) {
        var text = "";
        switch (parseInt(score)) {
            case 1:
                text = "Dở tệ";
                break;
            case 2:
                text = "Dở";
                break;
            case 3:
                text = "Không hay";
                break;
            case 4:
                text = "Không hay lắm";
                break;
            case 5:
                text = "Bình thường";
                break;
            case 6:
                text = "Xem được";
                break;
            case 7:
                text = "Có vẻ hay";
                break;
            case 8:
                text = "Hay";
                break;
            case 9:
                text = "Rất hay";
                break;
            default:
                text = "Tuyệt vời";
        }
        return text;
    }

    $('#star').raty({
        half:false,
        noRatedMsg:"Bạn đã thực hiện đánh giá phim này",
        score:function () {
            return $(this).attr('data-score');
        },

        mouseover:function (score, evt) {
            $("#hint").html(scorehint(score));
        },
        mouseout:function (score, evt) {
            $("#hint").html("");
        },
        click:function (score, evt) {
            $.ajax({
                'url':'/ajax/rate/' + filmId,
                'type':'POST',
                'dataType':'JSON',
                'data':{'score':score}
            }).done(function (data) {
                    if (data.status) {
                        if (typeof data.ratePoint != 'undefined') {
                            $('.box-rating .average').html(data.ratePoint);
                            $('.box-rating #rate_count').html(data.rateCount);
                            $('.box-rating #average').html(data.ratePoint);
                            $('.box-rating #div_average').show();
                            $('#star').raty('score', data.ratePoint);
                            $("#hint").html("");
                            $('#star').raty('readOnly', true);
                        }
                    } else {
						 _alert((webLanguage['Add_to_favorite_successful'] ? webLanguage['Add_to_favorite_successful'] : 'Add to favorite successful'));
                       // $('#star').raty('readOnly', true);
                    }
                    //auto if _fxStatus==0
                });
        }
    });
    if (filmId) {
        $.ajax({
            'url':'/ajax/getRate/' + filmId,
            'type':'POST',
            'dataType':'JSON'
        }).done(function (data) {
                if (data.status) {
                    if (typeof data.ratePoint != 'undefined') {
                        $('.box-rating .average').html(data.ratePoint);
                        $('.box-rating #rate_count').html(data.rateCount);
                        $('.box-rating #average').html(data.ratePoint);
                        $('.box-rating #div_average').show();
                        $('#star').raty('score', data.ratePoint);
                        if (data.status == 1) {
                            $('#star').raty('readOnly', true);
                        }
                    }
                }
                //auto if _fxStatus==0
            });
    }
});
