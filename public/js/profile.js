var menu1 = document.getElementById("general");
var menu2 = document.getElementById("security");
var menu3 = document.getElementById("notifications");
var content1 = document.getElementById("general-content");
var content2 = document.getElementById("security-content");
var content3 = document.getElementById("notifications-content");


menu1.addEventListener("click", function() {
 
  content1.style.display = "block";
  content2.style.display = "none";
  content3.style.display = "none";
 
  menu1.classList.add("active");
  menu2.classList.remove("active");
  menu3.classList.remove("active");
 
});

menu2.addEventListener("click", function() {

  content2.style.display = "block";
  content1.style.display = "none";
  content3.style.display = "none";
 
  menu1.classList.remove('active'); 
  menu3.classList.remove("active");
 
  menu2.classList.add("active");
});

menu3.addEventListener("click", function() {
 
  content1.style.display = "none";
  content2.style.display = "none";
   content3.style.display = "block";

  menu1.classList.remove('active'); 
  menu2.classList.remove("active");
   menu3.classList.add("active");
});

