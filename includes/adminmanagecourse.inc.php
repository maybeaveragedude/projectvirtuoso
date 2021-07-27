<?php

     $num=0;

//COURSE PART
foreach ($_SESSION["course"][$num] as $display) {
// echo '<pre>'; print_r($display); echo '</pre>';

$tempCourseId = $display['course_id'];
$tempname = $display['course_name'];
$tempdesc = $display['course_desc'];
$tempstatus = $display['course_status'];
$tempTFID = $display['t_fid'];
// $tempTID = $_SESSION["teacherid"];
echo <<<GFG
      <form method="post"

GFG;


    switch ($tempstatus){
            case "0":
              echo "style='background-color: rgba(0,0,0,0.1);'";
              break;
            case "1":
              echo "style='background-color: rgba(52,231,7,0.1);'";
              break;
            case "2":
              echo "style='background-color: rgba(237,7,7,0.1);'";
              break;
            default:
              break;
          }


echo <<<GFG
      action="includes/adminapprovecourse.inc.php">
        <input type="hidden" id="custId" name="courseID" value="{$tempCourseId}">
          <div class="coursetitle" id="coursetitle{$tempCourseId}">
            <a class="btn btn-primary listgroupdropMain subjectList" style="font-size: 20px; margin: 14px 0px;"data-bs-toggle="collapse" aria-expanded="false" aria-controls="collapse-{$num}" href="#collapseCourse-{$num}" role="button"><strong>{$tempname}</strong></a>
            <input class="simpleTextEdit" type="button" style="background-color: inherit; margin: 14px 0px; color:blue;" value="Preview" onclick="redirectViewCourse({$tempCourseId})"></input>
            <input type="submit" name="approve" class="simpleTextEdit" style="background-color: inherit; margin: 14px 0px; color:green;" value="Approve" )"></input>
            <input type="submit" name="revoke" class="simpleTextEdit"  style="background-color: inherit; margin: 14px 0px;" value="Revoke" )"></input>
              <div class="collapse" id="collapseCourse-{$num}">
GFG;
  //DISPLAY ORDERED SUBTOPICS
  $subsnum = 0;
  foreach ($_SESSION["courseSubtopics"] as $coursesubsDisp){
    $tempinnercourse = $coursesubsDisp[$subsnum]['course_fid'];
    // $tempTopSubname = $coursesubsDisp[$subsnum];
    // $tempSubdesc = $coursesubsDisp[$subsnum]['sub_desc'];
    // $tempSubFId = $coursesubsDisp['sbjt_fid'];
    // $tempTopicId = $coursesubsDisp['topic_id'];
    // echo '<pre>'; print_r($coursesubsDisp); echo '</pre>';

    if($tempCourseId == $tempinnercourse){
      // echo '<pre>'; print_r($coursesubsDisp); echo '</pre>';

      $innercount = 0;
      foreach ($coursesubsDisp as $count) {
        $tempSubname = $count['sub_name'];
        echo <<<GFG
            <div class="singleTopicRow" id="singleTopicRow{$subsnum}">
              <a class="btn btn-primary listgroupdropMain TopicList" style="padding-top: 0px; padding-bottom: 2px;margin-left: 24px; margin-top: 0px; margin-bottom: 12px;" data-bs-toggle="collapse" aria-expanded="false" aria-controls="collapse-{$subsnum}" href="#collapseTopic-{$subsnum}" role="button">{$tempSubname}</a>

        GFG;


        echo <<<GFG



                </div>
        GFG;
        $innercount += 1;
      }
      $subsnum +=1;

      }

  }

  // switch ($tempstatus){
  //   case "0":
  //     echo "<div><p style='color: rgb(0,0,0,0.5);'><small>Pending</small></p></div>";
  //     break;
  //   case "1":
  //     echo "<div><p style='color: rgb(52,231,7);'><small>Approved</small></p></div>";
  //     break;
  //   case "2":
  //     echo "<div><p style='color: rgb(231,7,7);'><small>Revoked</small></p></div>";
  //     break;
  //   default:
  //     break;
  // }

echo <<<GFG

        </div>
    </div>
  </form>


GFG;
// <div class="singleSubjectRowLine" style="margin: 0px auto 0px 24px; width: 140px; text-align: center !important; align: center;"></div>
$num += 1;
}
?>

<script>
        function redirectViewCourse(tempCourseId){ //redirect to preview course
          window.location.href=`learnerdisplay.php?course=${tempCourseId}`;
        }
</script>
