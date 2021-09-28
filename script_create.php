<?php include '../session.php'; ?>

<?php
  session_start();
  include_once '../callbacks/config.php';
  include_once '../callbacks/functions.php';
  

  if(isset($_POST['function']) && $_POST['function'] == 'saveScripts') 
  {
    $html = '';
    $title = $_POST['title'];
    $content = $_POST['content'];
    $userid = $_SESSION['userid'];
    $sql = "INSERT INTO scripts(user_id,contents) VALUES('".$userid."','".$content."')";
    // $script_result = mysqli_query($con,$script_query);

    if ($con->query($sql) === TRUE) {
        echo "Success";
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }

    echo $script_result;
  }

  if(isset($_GET['scriptId']) && $_GET['function'] == 'getScript') 
  {
    // var_dump($_GET);
    $html = '';
    $scriptId = $_GET['scriptId'];
    $script_query = "select * from scripts where id = ".$scriptId;
    $script_result = mysqli_query($con,$script_query);
     if(mysqli_num_rows($script_result) > 0) {
      $row = mysqli_fetch_assoc($script_result);
      header('Content-Type: application/json');
      echo json_encode($row);
      exit;
    } else {
      header('Content-Type: application/json');
      echo json_encode('error');
    }
    // echo $script_result;
  }

  if(isset($_POST['scriptId']) && $_POST['function'] == 'updateScripts') 
  {
    // $id=$_POST['scriptId'];

    // echo $id;
    $query="update scripts set contents = '".$_POST['content']."' where id = " . $_POST['scriptId'];
    // var_dump($query);
    // echo $query;
    $ans=mysqli_query($con,$query);

    if($ans)
    {
      echo 1;
    }
    else
      echo 0;
    // die();
  }
?>
