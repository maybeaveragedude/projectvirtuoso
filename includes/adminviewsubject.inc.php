<?php
$_SESSION["teachersubjectsName"] = "";
$_SESSION["teachersubjectsDesc"] = "";

require_once 'dbh.inc.php';
require_once 'functions.inc.php';

retrieveSubjects($conn);

echo "<div class='accordion-item'>
        <h2 class='accordion-header' role='tab'><button class='accordion-button collapsed' data-bs-toggle='collapse' data-bs-target='#accordion-1 .item-2' aria-expanded='false' aria-controls='accordion-1 .item-2'>Subject List</button></h2>
        <div class='accordion-collapse collapse item-2' role='tabpanel' data-bs-parent='#accordion-1'>
            <div class='accordion-body'>";


$num = 0;

    foreach ($subName[$num] as $display){
        $tempname = $display['sbjt_name'];
        $tempdesc = $display['sbjt_desc'];
        $tempSubId = $display['sbjt_id'];

        // echo <<<adsubbody
        //     <p class='mb-0' id='subject{$num}' onload='setSubject('{$tempname}', '{$tempdesc}', {$tempSubId})'> </p>
        // adsubbody;

        echo <<<adsubbody
            <p class='mb-0' id='subject{$num}'>Subject Name: {$tempname}. Subject Description: {$tempdesc}. Subject ID: {$tempSubId}</p>
        adsubbody;

        // echo "<p class='mb-0'>Test</p>"

        $num += 1;

    }

echo "
            </div>
        </div>
    </div>";
?>
