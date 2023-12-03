//Announcement Popup
window.addEventListener("load",function(){
	setTimeout(
	function open(event){
		document.querySelector(".announcement_popup").style.display = "block";
	},
	50
	)
});

document.querySelector("#close").addEventListener
("click", function(){
	document.querySelector(".announcement_popup").style.display = "none";
});
//Announcement Popup

document.getElementById('joinUsButton').addEventListener('click', function () {
    var form = document.getElementById('loginForm');
    form.style.display = (form.style.display === 'none' || form.style.display === '') ? 'block' : 'none';
});