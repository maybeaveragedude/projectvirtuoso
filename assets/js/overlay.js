var body = document.body;
var hide = document.getElementById("overlay");

function on() {
  document.getElementById("overlay").style.display = "block";
  body.classList.add("stopscrolling"); 
    // hide.addEventListener('click', function (event) {
    //         document.getElementById("overlay").style.display = "none";
    //         body.classList.remove("stopscrolling"); 
    //     });
}

function off() {
  document.getElementById("overlay").style.display = "none";
  body.classList.remove("stopscrolling"); 
  // hide.addEventListener('click', function (event) {
  //           off();
  //       });
}

hide.addEventListener('click', function (event) {
            off();
        });
