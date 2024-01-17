<?php 
    session_start();
    if(isset($_SESSION['email'])){
    include('includes/connection.php');
    if(isset($_POST['upload'])){
        $file_name = $_FILES['document']['name'];
        $file_tmp_name = $_FILES['document']['tmp_name'];
        $upload_status = move_uploaded_file($file_tmp_name,"documents/" . $file_name);
        if($upload_status){
            echo "<script type='text/javascript'>
              alert('document saved successfully...'); 
          </script>";
        }
        else{
            echo "<script type='text/javascript'>
              alert('Error...Plz try again');
            window.location.href = 'user_dashboard.php';  
          </script>";
        }
        if($upload_status){
            $query = "update tasks set file_name = '$file_name' where tid = $_GET[id]";
            $query_run = mysqli_query($connection,$query);
            if($query_run){
            echo "<script type='text/javascript'>
                alert('document uploaded successfully...');
                window.location.href = 'user_dashboard.php';  
            </script>";
            }
            else{
            echo "<script type='text/javascript'>
                alert('Error...Plz try again.');
                window.location.href = 'user_dashboard.php';
            </script>";
            }
        }
    }
?>
<html>
<head>
    <title>ETMS</title>
    <!-- jQuery file -->
    <script src="includes/juqery_latest.js"></script>
    <!-- Bootstrap files -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- External CSS file -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="row">
        <div class="col-md-3 m-auto" id="home_page">
            <center>
                <h3>Upload the document</h3>
                <?php 
                    $query = "select * from tasks where tid = $_GET[id]";
                    $query_run = mysqli_query($connection,$query);
                    while($row = mysqli_fetch_assoc($query_run)){
                        ?>
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <input type="hidden" name="id" class="form-control" />
                            </div>
                            <div class="form-group">
                                <input type="file" class="form-control" name="document">
                            </div>
                            <button type="submit" class="btn btn-danger" name="upload">Upload</button>
                            <a href="user_dashboard.php" class="btn btn-primary">Dashboard</a>
                        </form>
                        <?php
                    }
                 ?>
            </center>
        </div>
    </div>
</body>
</html> 
<?php  
}
else{
    header('Location:user_login.php');
}
?>