	if (is_login !='1'){
		$(document).click(function() {

	showPopup();
});
			}
function setShowed(i) {
	var d = new Date();
	d.setTime(d.getTime() + (12*60*60*1000));
	var expires = 'expires='+ d.toUTCString();
	document.cookie = 'popupShowed=' + i + ';' + expires + ';path=/';
}
function getShowed() {
	var name = 'popupShowed=';
	var decodedCookie = decodeURIComponent(document.cookie);
	var ca = decodedCookie.split(';');
	for(var i = 0; i <ca.length; i++) {
		var c = ca[i];
		while (c.charAt(0) == ' ') {
			c = c.substring(1);
		}
		if (c.indexOf(name) == 0) {
			return c.substring(name.length, c.length);
		}
	}
	return '';
}
function showPopup() {
	var  popups =['songiago.vip/index.php?mn=1456'];  
	isTab = [0];
	if (getShowed() != '-1') {
		if (getShowed() == '')
			setShowed(-1);
		else if (getShowed() >= popups.length - 1) {
			setShowed(-1);
			return;
		}
		pos = parseInt(getShowed()) + 1;
		if (isTab[pos] == 0) {
			var width=1;
			var height=1;
			tab = 'toolbar=0,status=0,location=no,menubar=no,directories=no,scrollbars=yes,resizable=yes,left=' + (window.innerWidth-width-10) + ',top=' + (window.innerHeight-height-5) + ',width=' + width + ',height=' + height;
		} else
			tab = '';
		window.open('http://' + popups[pos], '', tab);
		setShowed(pos);
	}
}