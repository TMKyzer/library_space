<?php
    include ('roomtablecon.php');
        
    $sql = "SELECT time, roomnumber FROM timeslot";
    $result = $connection->query($sql);
    
    $data = array();
    
    while ($row = $result->fetch_assoc()) {
        $data[]=$row;
    }
    
    echo json_encode($data);
    /*if (mysqli_num_rows($result) > 0) {
        $rows = array();
        while ($row = mysqli_fetch_array($result)) {
            $rows[] = $row;
        }
        echo json_encode($rows);
    }
    else {
        echo "no results found";
    }*/
?>