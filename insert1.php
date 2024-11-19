<?php
$patientName=$_POST['patientName'];
$patientAge=$_POST['patientAge'];
$patientEmail=$_POST['patientEmail'];
$patientID=$_POST['patientID'];
$patientGender=$_POST['patientGender'];
$diseaseName=$_POST['diseaseName'];
$enrollmentDate=$_POST['enrollmentDate'];
$nextAppointmentDate=$_POST['nextAppointmentDate'];
$previousPrescription=$_POST['previousPrescription'];
$tabletName=$_POST['tabletName'];
$syrupName=$_POST['syrupName'];
$patientSex=$_POST['patientSex'];
$tabletPrice=$_POST['tabletPrice'];
$syrupPrice=$_POST['syrupPrice'];
$wardType=$_POST['wardType'];

if (!empty($patientID) || !empty($patientAge) || !empty($patientEmail) || !empty($patientGender) || !empty($patientName) || ){
    $host = "localhost:3307";
    $dbUsername = "root@";
    $dbPassword = "";
    $dbname = "hospitalmanagemnetsystem";

    //create connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);

    if (mysqli_connect_error()) {
        die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    }
    else{
        $SELECT = "SELECT patientEmail From hospital Where patientEmail = ? Limit 1";
        $INSERT = "INSERT Into hospital (patientName, patientID , patientAge , patientGender) values (? ,? ,? ,? )";
        
        //prepare statement
        $stmt = $conn->prepare($SELECT);
        $stmt->bind_param("s", $patientEmail);
        $stmt->execute();
        $stmt -> bind_result($patientEmail);
        $stmt->store_result();
        $rnum= $stmt -> num_rows;

        if ($rnum ==0)
        {
            $stmt->close();

            $stmt = $conn->prepare($INSERT);
            $stmt->bind_param("siis", $patientName , $patientID, $patientAge, $patientGender);
            $stmt->execute();
            echo "New record inserted sucessfully";
        }
        else{
            echo "Someone already register using this email";
        }
        $stmt-> close();
        $conn-> close();
    }
}
else{
    echo "all field are required";
    die();
}
?>