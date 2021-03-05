var popup = document.querySelector(".popup");
var btn = document.querySelector(".popup-btn");
var close = document.querySelector(".close");
var reg = document.getElementById("registration");
var auth = document.getElementById("authorization");

btn.addEventListener("click", function(event){
	event.preventDefault();
	reg.style.display = "block";
	auth.style.display = "none";
	popup.classList.remove("hidden");
});

popup.addEventListener("click", function(event) {
  if (event.target == this) {
	reg.style.display = "block";
	auth.style.display = "none";
	popup.classList.add("hidden");
  }
});

close.addEventListener("click", function(event){
	auth.style.display = "none";
	reg.style.display = "none";
	popup.classList.add("hidden");
});

function display(){
	if(reg.style.display == "none"){
		reg.style.display = "block";
		auth.style.display = "none";
	}else{
		reg.style.display = "none";
		auth.style.display = "block";
	}
}