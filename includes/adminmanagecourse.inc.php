<?php
require_once "includes/dbh.inc.php";
$sql = "SELECT * FROM courses";
echo "<div class='accordion-item'>
        <h2 class='accordion-header' role='tab'><button class='accordion-button collapsed' data-bs-toggle='collapse' data-bs-target='#accordion-1 .item-1' aria-expanded='true' aria-controls='accordion-1 .item-1'>Course List</button></h2>
        <div class='accordion-collapse collapse item-1 text-start' role='tabpanel' data-bs-parent='#accordion-1'>
            <div class='accordion-body'>
                <div><a class='btn btn-primary listgroupdropMain' data-bs-toggle='collapse' aria-expanded='true' aria-controls='collapse-12' href='#collapse-12' role='button' style='font-family: Lato, sans-serif;'>Show Content</a>
                    <div class='collapse' id='collapse-12'>
                        <div class='row'>
                            <div class='col'>
                                <div>Content lmao</div>
                            </div>
                            <div class='col'>
                                <div>This content</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div><a class='btn btn-primary listgroupdropMain' data-bs-toggle='collapse' aria-expanded='true' aria-controls='collapse-13' href='#collapse-13' role='button' style='font-family: Lato, sans-serif;'>Show Content</a>
                    <div class='collapse' id='collapse-13' style='font-family: Lato, sans-serif;'>
                        <p>Collapse content.</p>
                    </div>
                </div>
                <div><a class='btn btn-primary listgroupdropMain' data-bs-toggle='collapse' aria-expanded='true' aria-controls='collapse-14' href='#collapse-14' role='button' style='font-family: Lato, sans-serif;'>Show Content</a>
                    <div class='collapse' id='collapse-14'>
                        <p style='font-family: Lato, sans-serif;'>Collapse content.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>";
?>
