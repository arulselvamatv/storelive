<?php
error_reporting(0);
if(isset($_POST["hid"])){
$hid=$_POST["hid"];
$no_rows=count($hid);
// echo $no_rows;
for($i=0;$i<$no_rows;$i++)
{   $hids=$_POST["hid"];
    
    if(isset($_POST["asd_".$hids[$i]])){
        $checkbox=$_POST["asd_".$hids[$i]];
        
        if(isset($checkbox)){

            $asda=$_POST["asda_".$hids[$i]];
            echo $checkbox.'-'.$asda.'</br>';
        }
    }
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post">
        <?php
        $no_rows=5;
        for($i=0;$i<$no_rows;$i++)
        {
        echo'<input type="checkbox" name="asd_'.$i.'" id="asd_'.$i.'" value="'.$i.'"><input type="hidden" name="hid[]" id="hid_'.$i.'" value="'.$i.'"><input type="text" name="asda_'.$i.'" id="asda_'.$i.'" value="'.$i.'"></br>';
        }
        ?>
        
        <input type="submit" value="submit">
    </form>
</body>
</html>
