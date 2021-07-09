var body = document.body;

function on() {
  document.getElementById("overlay").style.display = "block";
  body.classList.add("stopscrolling"); 
}

function off() {
  document.getElementById("overlay").style.display = "none";
  body.classList.remove("stopscrolling"); 
}

