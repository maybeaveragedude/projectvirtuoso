var subcount = 0;
var topiccount = 0;
var totalcount = subcount + topiccount;
function setSubjectDisplay(displaySubject, displayDesc, subjectID){
    // console.log(displaySubject);
    document.getElementById("subjectname").value = displaySubject;
    document.getElementById("subjectdesc").value = displayDesc;
    document.getElementById("subjectname").readOnly = true;
    document.getElementById("subjectdesc").readOnly = true;
    document.getElementById("menuNewtopic").style.display = "block";

    subcount = 0;
    topiccount = 1;
    document.getElementById("hiddenSubjectID").value = subjectID;
    console.log("Subj ID is " + document.getElementById("hiddenSubjectID").value);

    document.getElementById("hiddenTotalCount").value = subcount+topiccount;
    // console.log("count is " + document.getElementById("hiddenTotalCount").value);

    getExistingSubID(subjectID);

    var element = document.getElementById("dropmenuSubj"); //tweaking the behavior of dropdown menu
    element.setAttribute('aria-expanded', 'false');
    element.classList.toggle("show");

    var element2 = document.getElementById("dropmenuboxSubj"); //tweaking the behavior of dropdown menu
    element2.classList.toggle("show");

    destroySubtopics();

    var elementfid = document.getElementsByClassName("dropdownTopics"); //making the topics to be dependant on the parent subjects
    // console.log(elementfid[0].className);
    for (var i = 0; i <= elementfid.length; i++) {
      // console.log(elementfid[i].className);
      if (elementfid[i].classList.contains(`subjectFIDis${subjectID}`) == true){
        // console.log(elementfid[i].classList.contains(`subjectFIDis${subjectID}`));
        elementfid[i].style.display = "block";
      }
      else{
        elementfid[i].style.display = "none";
        // console.log(elementfid[i].display);
        document.getElementById("topicname").value = "";
        document.getElementById("topicdesc").value = "";
        document.getElementById("topicname").readOnly = true;
        document.getElementById("topicdesc").readOnly = true;


      }
    }
  }

  function systemSetSubjectDisplay(displaySubject, displayDesc, subjectID){
      // console.log(displaySubject);
      document.getElementById("subjectname").value = displaySubject;
      document.getElementById("subjectdesc").value = displayDesc;
      document.getElementById("subjectname").readOnly = true;
      document.getElementById("subjectdesc").readOnly = true;
      document.getElementById("menuNewtopic").style.display = "block";

      subcount = 0;
      topiccount = 1;
      document.getElementById("hiddenTotalCount").value = subcount+topiccount;
      console.log("count is " + document.getElementById("hiddenTotalCount").value);
      getExistingSubID(subjectID);

    }

  function getExistingSubID (subjectID){
    var input = document.createElement("input");

    input.setAttribute("id", "getExistingSubID");

    input.setAttribute("type", "hidden");

    input.setAttribute("name", "getExistingSubID");

    input.setAttribute("value", subjectID);

    //append to form element that you want .
    document.getElementById("teachereditorform").appendChild(input);

    if (document.getElementById("getExistingSubID") !== null){
      document.getElementById("getExistingSubID").value = subjectID;
    }
    console.log(document.getElementById("getExistingSubID").value);


  }

  function newSubj(){
    document.getElementById("subjectname").value = "";
    document.getElementById("subjectdesc").value = "";
    document.getElementById("subjectname").readOnly = false;
    document.getElementById("subjectdesc").readOnly = false;
    document.getElementById("menuNewtopic").style.display = "block";
    destroySubtopics();

    var element = document.getElementById("dropmenuSubj");
    element.setAttribute('aria-expanded', 'false');
    element.classList.toggle("show");
    var element2 = document.getElementById("dropmenuboxSubj");
    element2.classList.toggle("show");

    if (document.getElementById("getExistingSubID") !== null){
      document.getElementById("getExistingSubID").value = null;
    }
    console.log(document.getElementById("getExistingSubID"));
    subcount = 1;
    topiccount = 1;
    document.getElementById("hiddenTotalCount").value = subcount+topiccount;
    console.log("count is " + document.getElementById("hiddenTotalCount").value);



    var elementfid = document.getElementsByClassName("dropdownTopics");
    // console.log(elementfid[0].className);
    // console.log("hello");
    for (var i = 0; i <= elementfid.length; i++) {

        elementfid[i].style.display = "none";
        document.getElementById("topicname").value = "";
        document.getElementById("topicdesc").value = "";
        document.getElementById("topicname").readOnly = true;
        document.getElementById("topicdesc").readOnly = true;

    }
    // var showNewTopic = document.getElementById("menuNewtopic");
    // showNewTopic.style.display = "block";
    // console.log(showNewTopic.style.display);
  }

  function setTopicDisplay(displayTopic, displayDesc, topicID){
    // console.log(displayTopic);
    // console.log(displayDesc);
    document.getElementById("topicname").value = displayTopic;
    document.getElementById("topicdesc").value = displayDesc;
    document.getElementById("topicname").readOnly = true;
    document.getElementById("topicdesc").readOnly = true;

    subcount = 0;
    topiccount = 0;
    document.getElementById("hiddenTopicID").value = topicID;
    console.log("Topic ID is " + document.getElementById("hiddenTopicID").value);
    document.getElementById("hiddenTotalCount").value = subcount+topiccount;
    console.log("count is " + document.getElementById("hiddenTotalCount").value);



    getExistingTopicID(topicID);
    console.log(document.getElementById("getExistingSubID").value);
    var element = document.getElementById("dropmenuTopic");
    element.setAttribute('aria-expanded', 'false');
    element.classList.toggle("show");
    var element2 = document.getElementById("dropmenuboxTopics");
    element2.classList.toggle("show");

    document.getElementById("rowForExistingSubtopics").style.display = "block";
    document.getElementById("miniSelect").style.display = "none";


    var elementfid = document.getElementsByClassName("dropdownSubtopics"); //making the subtopics to be dependant on the parent topics
    // console.log(elementfid[0].className);
    for (var i = 0; i <= elementfid.length; i++) {
      // console.log(elementfid[i].className);
      if (elementfid[i].classList.contains(`topicFIDis${topicID}`) == true){
        // console.log(elementfid[i].classList.contains(`subjectFIDis${subjectID}`));
        elementfid[i].style.display = "block";
      }
      else{
        elementfid[i].style.display = "none";
        // console.log(elementfid[i].display);
        // document.getElementById("topicname").value = "";
        // document.getElementById("topicdesc").value = "";
        // document.getElementById("topicname").readOnly = true;
        // document.getElementById("topicdesc").readOnly = true;

      }
    }
  }

  function systemSetTopicDisplay(displayTopic, displayDesc, topicID, subtopicId){
    // console.log(displayTopic);
    // console.log(displayDesc);
    document.getElementById("topicname").value = displayTopic;
    document.getElementById("topicdesc").value = displayDesc;
    document.getElementById("topicname").readOnly = true;
    document.getElementById("topicdesc").readOnly = true;

    subcount = 0;
    topiccount = 0;
    document.getElementById("hiddenTotalCount").value = 3; //for CASE SELECTION IN PHP
    console.log("count is " + document.getElementById("hiddenTotalCount").value);

    getExistingTopicID(topicID);
    console.log(document.getElementById("getExistingSubID").value);
    // var element = document.getElementById("dropmenuTopic");
    // element.setAttribute('aria-expanded', 'false');
    // element.classList.toggle("show");
    // var element2 = document.getElementById("dropmenuboxTopics");
    // element2.classList.toggle("show");

    document.getElementById("rowForExistingSubtopics").style.display = "block";
    document.getElementById("miniSelect").style.display = "none";
    //
    //
    var elementfid = document.getElementsByClassName("dropdownSubtopics"); //making the subtopics to be dependant on the parent topics
    // console.log(elementfid[0].className);
    for (var i = 0; i <= elementfid.length; i++) {
      // console.log(elementfid[i].className);
      if (elementfid[i].classList.contains(`topicFIDis${topicID}`) == true){
        // console.log(elementfid[i].classList.contains(`subjectFIDis${subjectID}`));
        elementfid[i].style.display = "block";
        if (elementfid[i].id == subtopicId){
          elementfid[i].classList.add("highlightThis");
        }

      }
      else{
        elementfid[i].style.display = "none";
        // console.log(elementfid[i].display);
        // document.getElementById("topicname").value = "";
        // document.getElementById("topicdesc").value = "";
        // document.getElementById("topicname").readOnly = true;
        // document.getElementById("topicdesc").readOnly = true;

      }
    }
  }

  function getExistingTopicID (topicID){
    var input = document.createElement("input");

    input.setAttribute("id", "getExistingTopicID");

    input.setAttribute("type", "hidden");

    input.setAttribute("name", "getExistingTopicID");

    input.setAttribute("value", topicID);

    //append to form element that you want .
    document.getElementById("teachereditorform").appendChild(input);

    if (document.getElementById("getExistingTopicID") !== null){
      document.getElementById("getExistingTopicID").value = topicID;
    }
    console.log(document.getElementById("getExistingTopicID"));


  }

  function newTopic(){
    document.getElementById("topicname").value = "";
    document.getElementById("topicdesc").value = "";
    document.getElementById("topicname").readOnly = false;
    document.getElementById("topicdesc").readOnly = false;

    destroySubtopics();

    topiccount = 1;
    document.getElementById("hiddenTotalCount").value = subcount+topiccount;
    console.log("count is " + document.getElementById("hiddenTotalCount").value);

    var element = document.getElementById("dropmenuTopic");
    element.setAttribute('aria-expanded', 'false');
    element.classList.toggle("show");
    var element2 = document.getElementById("dropmenuboxTopics");
    element2.classList.toggle("show");

    if (document.getElementById("getExistingTopicID") !== null){
      document.getElementById("getExistingTopicID").value = null;
    }
    console.log(document.getElementById("getExistingSubID").value);
    console.log(document.getElementById("getExistingTopicID"));



  }
  function destroySubtopics(){
    document.getElementById("rowForExistingSubtopics").style.display = "none";
    document.getElementById("miniSelect").style.display = "block";

  }
