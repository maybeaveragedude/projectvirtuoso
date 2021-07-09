/*function openTab(evt, respondTab) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(respondTab).style.display = "block";
  evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
*/

var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("tabcontent");
  x[n].style.display = "block";
  //... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = 'Submit';
    document.getElementById("nextBtn").style.display = "none";
    document.getElementById("completeform").style.display = "inline";
    document.getElementById("prevBtn").style.margin = "-65px 200px 0px 20px";
  } else {
    document.getElementById("nextBtn").innerHTML= "<i class='fa fa-angle-right'></i>";
    document.getElementById("nextBtn").style.display = "inline";
    document.getElementById("completeform").style.display = "none";
    document.getElementById("prevBtn").style.margin = "-65px 12px 0px 12px";
  }
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tabcontent");
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form...
  if (currentTab >= x.length) {
    // ... the form gets submitted:
    //document.getElementById("stepform").submit();
      document.getElementById("completeform").click(); 
   return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, j, valid = true;
  x = document.getElementsByClassName("tabcontent");
    console.log(x);
  y = x[currentTab].getElementsByTagName("input");
    console.log(y);
    j = x[currentTab].id;
    console.log(j);
  // A loop that checks every input field in the current tab:
 /* for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false
      valid = false;
    }
      console.log("value ; " + y[i].value);
  }*/
    
   switch(j) {
       case "Step1":
           y = x[0].getElementsByTagName("input");
           for (i = 0; i < y.length; i++){
               var temp = y[i];
               if (temp.type == "checkbox") {
                   if (temp.checked) {
                       valid = true;
                       break;
                   }
                   else {
                       continue;
                   }
               } else if (temp.type == "text") {
                   console.log(temp.value);
                   if (temp.value !== "") {
                       if (email.value !== rptemail.value) {
                           alert ("Repeated email does not match");
                           valid = false;
                           break;
                       } else {
                           valid = true;
                       }
                   }
                   else {
                       alert ("Please check the fields.");
                       valid = false;
                       break;
                   }
               }
           }
               
            break;
       case "Step2":
           y = x[1].getElementsByTagName("input");
           for (i = 0; i < y.length; i++){
               var temp = y[i];
               if (temp.type == "checkbox") {
                   if (temp.checked) {
                       valid = true;
                       break;
                   }
                   else {
                       continue;
                   }
               } else if (temp.type == "text") {
                   console.log(temp.value);
                   if (temp.value !== "") {
                       if (pwd.value !== rptpwd.value) {
                           alert ("Repeated password does not match");
                           valid = false;
                           break;
                       } else {
                           valid = true;
                       }
                   }
                   else {
                       alert ("Please check the fields.");
                       valid = false;
                       break;
                   }
               }
           }
               
            break;
       case "Step3":
           y = x[2].getElementsByTagName("input");
           for (i = 0; i < y.length; i++){
               var temp = y[i];
               if (temp.type == "checkbox") {
                   if (temp.checked) {
                       valid = true;
                       break;
                   }
                   else {
                       continue;
                   } 
               }
                else if (temp.type == "text") {
                       if (temp.value == "") {
                           valid = false;
                           alert ("Please pick a subject or fill in others.");
                           break;
                       } else {
                           valid = true;
                           
                       }
                   }
               }  
           
            break;
        case "Step4":
           y = x[3].getElementsByTagName("input");
           for (i = 0; i < y.length; i++){
               var temp = y[i];
               if (temp.type == "number") {
                   if (temp.value != "") {
                       valid = true;
                       break;
                   }
                   else {
                       y[i].className += " invalid";
                       valid = false;
                       alert ("Please pick a subject or fill in others.");
                   }
               }
           }
           if (briefexptext.value != "") {
               valid = true;
           } else {
               valid = false;
               alert ("Please brief us your educational history.");
               briefexptext.className += " invalid";
           }
            break;
         case "Step5":
           y = x[4].getElementsByTagName("input");
           for (i = 0; i < y.length; i++){
               var temp = y[i];
               if (temp.type == "file") {
                   if (temp.value != "") {
                       valid = true;
                       document.getElementsByClassName("tablinks")[5].className += " finish";
                       break;
                   }
                   else {
                       y[i].className += " invalid";
                       valid = false;
                   }
               } else if (temp.type == "url") {
                   if (temp.value != "") {
                       valid = true;
                       document.getElementsByClassName("tablinks")[5].className += " finish";
                       break;
                   }
                   else {
                       y[i].className += " invalid";
                       valid = false;
                       alert ("Please provide at least ONE credible reference.");
                   }
               }
           }
            break;  
   }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("tablinks")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("tablinks");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";
}