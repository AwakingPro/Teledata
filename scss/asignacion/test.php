<?php
if(isset($_POST['ch']) && !empty($_POST['ch'])){
        echo join(",",$_POST['ch']);
        if(isset($_POST['prod']) && !empty($_POST['prod'])){
        echo join(",",$_POST['prod']);
    }
}else{
  echo 'failed';
}
?>

	




