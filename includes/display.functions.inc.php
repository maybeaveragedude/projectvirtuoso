<?php
function getMaterial($conn, $viewSubtopicID, $tempMatSubId, $tempMatFId, $matExist, $tempQuizFId){
  echo <<<GFG
        <script>

        var correctCounter = 0;

        </script>
  GFG;  // echo '<pre>'; print_r($tempMatSubId); echo '</pre>';
  // $testgeneralQuizCount = 0;

if ($viewSubtopicID == $tempMatSubId) {
  // echo '<pre>'; print_r($viewSubtopicID); echo '</pre>';

     $matnum = 0; //for id
     foreach ($_SESSION["GlobalMaterial"][$matnum] as $matDisplay){
         $tempMatTitle = $matDisplay['mat_name'];
         $tempMatContents = $matDisplay['mat_contents'];
         $tempMatVisualFile = $matDisplay['mat_file_upload_fid'];
         $imageSrc = getImage($conn, $tempMatVisualFile);

         $tempMatID = $matDisplay['mat_id'];


         if ($tempMatFId == $tempMatID){

             echo <<<GFG

             <section class="editor" id="section{$tempMatTitle}" style="padding-bottom: 0px; padding-top: 75px">

                 <div class="col maindisplay" >
                   <h2 style="padding: 16px 0px">{$tempMatTitle}</h2>
                   <pre id="innersection{$tempMatTitle}" style="text-align: justify; white-space: pre-wrap; font-family: var(--bs-font-sans-serif); font-size: 16px;">{$tempMatContents}</pre>
                   <div class=" justify-content-xxl-center align-items-xxl-center" style="padding: 56px 0px; margin: auto; justify-contents:middle; text-align: center; min-height: 200px;">
                     <img id="anothersection{$tempMatTitle}" src="{$imageSrc}" style="width: 400; height: auto; object-fit:cover;" alt=""/>
                   </div>
                 </div>
             </section>

             <script>

             var maindocElement{$matnum} = document.getElementById('innersection{$tempMatTitle}');
             var taggedSubID{$matnum} = $tempMatSubId;
             var anotherdocElement{$matnum} = document.getElementById('anothersection{$tempMatTitle}');

             // var scrollSubtopics{$matnum} = document.getElementById('hrefSUBIDFor{$tempMatSubId}');
             var scrollSubtopicsName{$matnum} = document.getElementById('subname{$tempMatSubId}');
             var descContainer = document.getElementById('descContainer');
             var subnameContainer = document.getElementById('subnameContainer');

             // var testID{$matnum} = "#"+maindocElement{$matnum}.id;

             //
             // var seenInViewport{$matnum} = function(maindocElement{$matnum}){
             //   console.log(isInViewport(maindocElement{$matnum}));
             //
             //   if(isInViewport(maindocElement{$matnum})){
             //     viewedMatCounter ++;
             //     console.log("div seen"+ viewedMatCounter);
             //   }
             //
             // }
             //
             // $(testID{$matnum}).one("scroll", seenInViewport{$matnum}(maindocElement{$matnum}));
             // // console.log("div seen"+ viewedMatCounter);


             var repeat{$matnum} = document.getElementById('side{$tempMatTitle}');


             // console.log(maindocElement{$matnum});

             document.addEventListener('scroll', function () {


                 if (isInViewport(maindocElement{$matnum}) || isInViewport(anotherdocElement{$matnum})){

                   // console.log(testID{$matnum});
                   // console.log(anotherdocElement{$matnum}.id);
                   // console.log(taggedSubID{$matnum});





                   repeat{$matnum}.classList.add("atThisSection");
                   // console.log(descContainer);

                   descContainer.innerHTML = tempDesc{$tempMatSubId};
                   subnameContainer.innerHTML = tempSubNameDisplay{$tempMatSubId};

                   // console.log(tempDesc{$tempMatSubId});

                    // scrollSubtopics{$matnum}.click();


                 } else {
                   repeat{$matnum}.classList.remove("atThisSection");
                   // scrollSubtopics{$matnum}.style.display = "none";

                 }

             }

             , {
                 passive: true
             });

             </script>

             GFG;
             $matExist += 1;


             $quizI = 0;
             $quizCount = 0;
             foreach ($_SESSION["quizRepo"][$quizI] as $quizDisplay){
                 $tempQuizQuestion = $quizDisplay['quiz_question'];
                 $tempQuizID = $quizDisplay['quiz_id'];
                 $tempQuizDisplayOrder = $quizDisplay['display_order'];

                 if ($tempQuizFId == $tempQuizID){
                   $quizCount += 1;
                   // $testgeneralQuizCount += 1;


                   echo <<<GFG
                         <script>
                               globalQuizCounter ++;
                               // console.log(globalQuizCounter);
                               document.getElementById("totalQuizCount").innerHTML = globalQuizCounter;

                         </script>

                         <section class="editor" style="padding-bottom: 0px; padding-top: 75px">

                             <div class="col maindisplay quizSection">
                             <h4 style="padding: 16px 0px">{$tempMatTitle}: Question {$quizCount}</h4>

                             <pre id="innerinnersection{$tempQuizID}" style="white-space: pre-wrap; font-family: var(--bs-font-sans-serif); font-size: 16px;">{$tempQuizQuestion}</pre>


                           <script>
                                 var secondocElement{$tempQuizID} = document.getElementById('innerinnersection{$tempQuizID}');

                                 var sideBarMatSections{$tempQuizID} = document.getElementById('side{$tempMatTitle}');

                                 document.addEventListener('scroll', function () {



                                   if (isInViewport(secondocElement{$tempQuizID})){
                                           sideBarMatSections{$tempQuizID}.classList.add("atThisSection");
                                           // scrollSubtopics{$matnum}.click();


                                   } else {
                                           // sideBarMatSections{$tempQuizID}.classList.remove("atThisSection");
                                   }

                                 }

                                   , {
                                     passive: true
                                 });


                               </script>

                   GFG;

                   $questionI = 0;
                   $quizQuestionCount = 0;
                   foreach ($_SESSION["quizQuestionChoices"][$questionI] as $quizQuestionDisplay){
                       $tempQuestionLabel = $quizQuestionDisplay['choice'];
                       $tempQuestionBool = $quizQuestionDisplay['true_false'];
                       $tempQuestionQuizFID = $quizQuestionDisplay['quiz_fid'];

                       if ($tempQuizID == $tempQuestionQuizFID){
                         $quizQuestionCount += 1;




                         echo <<<GFG


                             <div class="col" style="padding: 12px;">
                                 <div  class="form-check">
                                   <input class="form-check-input" type="radio" name="quiz{$tempQuizID}" id = "quiz{$tempQuizID}choice{$quizQuestionCount}" value="$tempQuestionLabel">
                                   <label class="form-check-label helloRadio" for="quiz{$tempQuizID}choice{$quizQuestionCount}">$tempQuestionLabel</label>
                                 </div>
                             </div>

                         GFG;
                         if ($tempQuestionBool == 1){

                           //this is to store in js whick radio is the correct one
                           echo <<<GFG
                                 <script>
                                      // globalQuizCounter = {$quizQuestionCount};
                                      // console.log(globalQuizCounter);
                                      var jsquiz{$tempQuizID} = "quiz{$tempQuizID},{$tempQuestionLabel}";
                                      console.log(jsquiz{$tempQuizID});
                                      var tempthisquestion{$tempQuizID} = "$tempQuestionLabel";

                                 </script>

                            GFG;
                         }

                       }
                       $questionI += 1;
                     }

                     echo <<<GFG

                               </div>

                           </section>


                     GFG;
                 }
                 $quizI += 1;
               }

           }
           $matnum +=1;

   }
 }
}

function getSessionedMaterial($conn, $viewSubtopicID, $tempMatSubId, $tempMatFId, $matExist, $tempQuizFId){
  echo <<<GFG
        <script>

        var correctCounter = 0;

        </script>
  GFG;  // echo '<pre>'; print_r($tempMatSubId); echo '</pre>';
  // $testgeneralQuizCount = 0;

if ($viewSubtopicID == $tempMatSubId) {
  // echo '<pre>'; print_r($viewSubtopicID); echo '</pre>';

     $matnum = 0; //for id
     foreach ($_SESSION["GlobalMaterial"][$matnum] as $matDisplay){
         $tempMatTitle = $matDisplay['mat_name'];
         $tempMatContents = $matDisplay['mat_contents'];
         $tempMatVisualFile = $matDisplay['mat_file_upload_fid'];
         $imageSrc = getImage($conn, $tempMatVisualFile);

         $tempMatID = $matDisplay['mat_id'];


         if ($tempMatFId == $tempMatID){

             echo <<<GFG

             <section class="editor" id="section{$tempMatTitle}" style="padding-bottom: 0px; padding-top: 75px">

                 <div class="col maindisplay" >
                   <h2 style="padding: 16px 0px">{$tempMatTitle}</h2>
                   <pre id="innersection{$tempMatTitle}" style="text-align: justify; white-space: pre-wrap; font-family: var(--bs-font-sans-serif); font-size: 16px;">{$tempMatContents}</pre>
                   <div class=" justify-content-xxl-center align-items-xxl-center" style="padding: 56px 0px; margin: auto; justify-contents:middle; text-align: center; min-height: 200px;">
                     <img id="anothersection{$tempMatTitle}" src="{$imageSrc}" style="width: 400; height: auto; object-fit:cover;" alt=""/>
                   </div>
                 </div>
             </section>

             <script>

             var maindocElement{$matnum} = document.getElementById('innersection{$tempMatTitle}');
             var taggedSubID{$matnum} = $tempMatSubId;
             var anotherdocElement{$matnum} = document.getElementById('anothersection{$tempMatTitle}');

             // var scrollSubtopics{$matnum} = document.getElementById('hrefSUBIDFor{$tempMatSubId}');
             var scrollSubtopicsName{$matnum} = document.getElementById('subname{$tempMatSubId}');
             var descContainer = document.getElementById('descContainer');
             var subnameContainer = document.getElementById('subnameContainer');

             // var testID{$matnum} = "#"+maindocElement{$matnum}.id;

             //
             // var seenInViewport{$matnum} = function(maindocElement{$matnum}){
             //   console.log(isInViewport(maindocElement{$matnum}));
             //
             //   if(isInViewport(maindocElement{$matnum})){
             //     viewedMatCounter ++;
             //     console.log("div seen"+ viewedMatCounter);
             //   }
             //
             // }
             //
             // $(testID{$matnum}).one("scroll", seenInViewport{$matnum}(maindocElement{$matnum}));
             // // console.log("div seen"+ viewedMatCounter);


             var repeat{$matnum} = document.getElementById('side{$tempMatTitle}');


             // console.log(maindocElement{$matnum});

             document.addEventListener('scroll', function () {


                 if (isInViewport(maindocElement{$matnum}) || isInViewport(anotherdocElement{$matnum})){

                   // console.log(testID{$matnum});
                   // console.log(anotherdocElement{$matnum}.id);
                   // console.log(taggedSubID{$matnum});


                   if (viewedMatArray.includes("mat{$tempMatID}")){

                   } else {
                     viewedMatArray.push("mat{$tempMatID}"); //if seen, add into array
                     viewedMatCounter = viewedMatArray.length;
                     viewedMatCounter += correctCounter;
                     document.getElementById("userProgress").value = viewedMatCounter;
                     var totalPercentage = (viewedMatCounter/globalMatCounter)*100;
                     document.getElementById("progressPercentage").innerHTML = totalPercentage.toFixed(2)+"%";

                     // console.log(viewedMatArray.length);


                   }



                   repeat{$matnum}.classList.add("atThisSection");
                   // console.log(descContainer);

                   descContainer.innerHTML = tempDesc{$tempMatSubId};
                   subnameContainer.innerHTML = tempSubNameDisplay{$tempMatSubId};

                   // console.log(tempDesc{$tempMatSubId});

                    // scrollSubtopics{$matnum}.click();


                 } else {
                   repeat{$matnum}.classList.remove("atThisSection");
                   // scrollSubtopics{$matnum}.style.display = "none";

                 }

             }

             , {
                 passive: true
             });

             </script>

             GFG;
             $matExist += 1;


             $quizI = 0;
             $quizCount = 0;
             foreach ($_SESSION["quizRepo"][$quizI] as $quizDisplay){
                 $tempQuizQuestion = $quizDisplay['quiz_question'];
                 $tempQuizID = $quizDisplay['quiz_id'];
                 $tempQuizDisplayOrder = $quizDisplay['display_order'];

                 if ($tempQuizFId == $tempQuizID){
                   $quizCount += 1;
                   // $testgeneralQuizCount += 1;


                   echo <<<GFG
                         <script>
                               globalQuizCounter ++;
                               // console.log(globalQuizCounter);
                               document.getElementById("totalQuizCount").innerHTML = globalQuizCounter;

                         </script>

                         <section class="editor" style="padding-bottom: 0px; padding-top: 75px">

                             <div class="col maindisplay quizSection">
                             <h4 style="padding: 16px 0px">{$tempMatTitle}: Question {$quizCount}</h4>

                             <pre id="innerinnersection{$tempQuizID}" style="white-space: pre-wrap; font-family: var(--bs-font-sans-serif); font-size: 16px;">{$tempQuizQuestion}</pre>


                           <script>
                                 var secondocElement{$tempQuizID} = document.getElementById('innerinnersection{$tempQuizID}');

                                 var sideBarMatSections{$tempQuizID} = document.getElementById('side{$tempMatTitle}');

                                 document.addEventListener('scroll', function () {



                                   if (isInViewport(secondocElement{$tempQuizID})){
                                           sideBarMatSections{$tempQuizID}.classList.add("atThisSection");
                                           // scrollSubtopics{$matnum}.click();


                                   } else {
                                           // sideBarMatSections{$tempQuizID}.classList.remove("atThisSection");
                                   }

                                 }

                                   , {
                                     passive: true
                                 });


                               </script>

                   GFG;

                   $questionI = 0;
                   $quizQuestionCount = 0;
                   foreach ($_SESSION["quizQuestionChoices"][$questionI] as $quizQuestionDisplay){
                       $tempQuestionLabel = $quizQuestionDisplay['choice'];
                       $tempQuestionBool = $quizQuestionDisplay['true_false'];
                       $tempQuestionQuizFID = $quizQuestionDisplay['quiz_fid'];

                       if ($tempQuizID == $tempQuestionQuizFID){
                         $quizQuestionCount += 1;




                         echo <<<GFG


                             <div class="col" style="padding: 12px;">
                                 <div  class="form-check">
                                   <input class="form-check-input" type="radio" name="quiz{$tempQuizID}" id = "quiz{$tempQuizID}choice{$quizQuestionCount}" value="$tempQuestionLabel">
                                   <label class="form-check-label helloRadio" for="quiz{$tempQuizID}choice{$quizQuestionCount}">$tempQuestionLabel</label>
                                 </div>
                             </div>

                         GFG;
                         if ($tempQuestionBool == 1){

                           //this is to store in js whick radio is the correct one
                           echo <<<GFG
                                 <script>
                                      // globalQuizCounter = {$quizQuestionCount};
                                      // console.log(globalQuizCounter);
                                      var jsquiz{$tempQuizID} = "quiz{$tempQuizID},{$tempQuestionLabel}";
                                      console.log(jsquiz{$tempQuizID});
                                      var tempthisquestion{$tempQuizID} = "$tempQuestionLabel";

                                 </script>

                            GFG;
                         }

                       }
                       $questionI += 1;
                     }

                     echo <<<GFG
                                <input id="submitquiz{$tempQuizID}" class="hoverableCard" type="button" value="Submit" style="padding: 8px 18px; background: rgb(72, 61, 139); border: 0px; color:	#FFD700 !important; border-radius: 6px 6px 6px 6px; transition: 0.1s;"></input>
                               </div>

                           </section>
                           <script>



                               if (attemptedQuizArray.includes("quiz{$tempQuizID}")){
                                      document.getElementById('submitquiz{$tempQuizID}').disabled =  true;
                                      // correctCounter ++;
                                      correctCounter = attemptedQuizArray.length;

                                      // viewedMatCounter ++;
                                      document.getElementById("userProgress").value = viewedMatCounter;

                                }



                             document.getElementById('submitquiz{$tempQuizID}').onclick = function (){
                               // console.log($('input[name=quiz{$tempQuizID}]:checked').val());

                               if ($('input[name=quiz{$tempQuizID}]:checked').val() == tempthisquestion{$tempQuizID}){


                                 if (attemptedQuizArray.includes("quiz{$tempQuizID}")){

                                 } else {
                                   attemptedQuizArray.push("quiz{$tempQuizID}"); //if correct, add into array
                                   alert('Correct');
                                   correctCounter = attemptedQuizArray.length;
                                   // viewedMatCounter ++;
                                   tempTotal = correctCounter + viewedMatCounter;
                                   document.getElementById("userProgress").value = tempTotal;
                                   totalPercentage = (tempTotal/globalMatCounter)*100;
                                   document.getElementById("progressPercentage").innerHTML = totalPercentage.toFixed(2)+"%";



                                 }


                                console.log(attemptedQuizArray);
                                document.getElementById("attemptedQuizCount").innerHTML = correctCounter;
                                document.getElementById('submitquiz{$tempQuizID}').disabled =  true;



                               }  else {
                                 alert('Incorrect');
                                }

                             }

                           </script>

                     GFG;
                 }
                 $quizI += 1;
               }

           }
           $matnum +=1;

   }
 }
}
