<?php
$conn = mysqli_connect("localhost", "root", "", "virtuoso");
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT t.t_ID,t.t_name,t.t_email,t.t_status,p.t_sub,p.t_years,p.t_brief,p.t_fid,p.t_url,p.t_up_fid FROM teacher AS t LEFT JOIN t_proposal AS p ON t.t_ID= p.t_fid;";
$result = $conn -> query($sql);

if ($result -> num_rows > 0){
    while ($row = $result -> fetch_assoc()){
    echo "<tr>
    <td style='width: 265px;font-size: 24px;'>".$row["t_name"]."</td>
    <td style='width: 924px;'>
        <div><a class='btn btn-primary' data-bs-toggle='collapse' aria-expanded='false' aria-controls='collapse-1' href='#collapse-".$row["t_ID"]."' role='button' style='float: right;'>View</a>
            <div class='collapse' id='collapse-".$row["t_ID"]."' class='collapse' style='clear: right;'>
                <div class='row'>
                    <div class='col'>
                        <p>Subject</p>
                    </div>
                    <div class='col-xl-9'>
                        <p style='text-align: left;'>".$row["t_sub"]."</p>
                    </div>
                </div>
                <div class='row'>
                    <div class='col'>
                        <p>Brief Background</p>
                    </div>
                    <div class='col-xl-9'>
                        <p style='text-align: left;'>".$row["t_brief"]."</p>
                    </div>
                </div>
                <div class='row'>
                    <div class='col'>
                        <p>Experience</p>
                    </div>
                    <div class='col-xl-9'>
                        <p style='text-align: left;'>".$row["t_years"]."</p>
                    </div>
                </div>";
                //fetch doc upload id
                $sqlF = "SELECT * from uploads WHERE up_id='".$row["t_up_fid"]."';";
                $resultF = $conn -> query($sqlF);

                if ($resultF -> num_rows > 0){
                    //when there is a file upload
                    while ($rowF = $resultF -> fetch_assoc()){
                        //fetch doc name and fetch doc from uploads folder
                        
                        echo "<div class='row'>
                            <div class='col'>
                                <p>Portfolio</p>
                            </div>
                            <div class='col-xl-9'>
                                <a style='text-align: left;' href='uploads/".$rowF["file_name"]."' download>
                                <p style='text-align: left;'>".$rowF["file_name"]."</p>
                                </a>
                            </div>
                        </div>";
                    }
                }else{
                    //where there is no file upload
                    echo "<div class='row'>
                            <div class='col'>
                                <p>Portfolio</p>
                            </div>
                            <div class='col-xl-9'>
                                <p style='text-align: left;'>No uploaded files</p>
                            </div>
                        </div>";
                }
                echo "<div class='row'>
                    <div class='col'>
                        <p>Link</p>
                    </div>
                    <div class='col-xl-9'>
                        <p style='text-align: left;'>".$row["t_url"]."</p>
                    </div>
                </div>";
                //for status 0 = awaiting approval
                if ($row["t_status"] == '0'){
                    echo "<div class='row'>
                        <div class='col'>
                            <p>Status</p>
                        </div>
                        <div class='col-xl-9'>
                            <p style='text-align: left;color: rgb(0,0,0,0.5);'>Pending</p>
                        </div>
                    </div>";
                //for status 1 = active
                } elseif ($row["t_status"] == '1') {
                    echo "<div class='row'>
                        <div class='col'>
                            <p>Status</p>
                        </div>
                        <div class='col-xl-9'>
                            <p style='text-align: left;color: rgb(52,231,7);'>Active</p>
                        </div>
                    </div>";
                //for status 2 = disabled
                } elseif ($row["t_status"] == '2') {
                    echo "<div class='row'>
                        <div class='col'>
                            <p>Status</p>
                        </div>
                        <div class='col-xl-9'>
                            <p style='text-align: left;color: rgb(231,7,7);''>Disabled</p>
                        </div>
                    </div>";
                } else {
                    echo "<div class='row'>
                        <div class='col'>
                            <p>Status</p>
                        </div>
                        <div class='col-xl-9'>
                            <p style='text-align: left;color: rgb(231,7,7);''>Error</p>
                        </div>
                    </div>";
                }
                include_once 'includes/functions.inc.php';
                echo "<button class='btn btn-primary' type='button'>Activate</button><button class='btn btn-primary' type='button' style='margin-left: 20px;''>Deactivate</button>
            </div>
        </div>
    </td>
</tr>";
    }
}
?>