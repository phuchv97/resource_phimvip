<?php
if (!defined('RK_MEDIA')) die("You does have access to this!");
class Comment_Model {
	public static function rand_notice() {
		$input = array(
			"Comment lịch sự không nói tục, chửi bậy.", 
			"Không yêu cầu những phim chiếu rạp khi chưa có HD", 
			"Không dẫn link từ web khác vào."
		);
		return $input[array_rand($input)];
	}
}
