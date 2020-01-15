function loadEpisodes(){$.get(url_episodes,function(e){$("#list-eps").html(e),$("#ep-"+current_episode).addClass("active"),$("#server-"+current_server).addClass("server-active")})}var index=0,current_caption=1,current_server="",current_time=0,current_index=0,current_episode="",server_default=9,movie_id=$("#media-player").attr("movie-id"),player_token=$("#media-player").attr("player-token"),current_token="",url_playlist="",url_episodes=base_url+"get_episodes/"+movie_id+"/"+player_token,load_count=0,auto_next=!0,is_error=!1;loadEpisodes();
function updateMovieView(e) {
    $.ajax({
        url: base_url + "ajax/movie_update_view/",
        type: "POST",
        dataType: "json",
        data: {
            id: e
        },
        success: function() {}
    })
}