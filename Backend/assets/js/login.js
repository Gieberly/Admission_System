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