<?php
include('includes/header.php'); 
include('includes/navbar.php'); 
include('includes/dbconfig.php'); 
?>


<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New student Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     

      

<?php 


   

 function uniqidReal($lenght = 13) {
  // uniqid gives 13 chars, but you could adjust it to your needs.
  if (function_exists("random_bytes")) {
      $bytes = random_bytes(ceil($lenght / 2));
  } elseif (function_exists("openssl_random_pseudo_bytes")) {
      $bytes = openssl_random_pseudo_bytes(ceil($lenght / 2));
  } else {
      throw new Exception("no cryptographically secure random function available");
  }
  return substr(bin2hex($bytes), 0, $lenght);
}

$id= $title= "";
 if (isset($_POST['registerbtn'])){

   //$id =uniqid();
 $id=htmlspecialchars($_POST['code']);
  $title=htmlspecialchars($_POST['name']);
 //$username =htmlspecialchars($_POST['username']);
 //$password =htmlspecialchars($_POST['password']);
 //$hash = password_hash($password, PASSWORD_DEFAULT);
/*

 $check = "SELECT id ,NationalId FROM  studnet_register";
 $result = $conn ->query($check);
 while($row = $result->fetch_assoc())
 {
   if ( $_POST['NationalId'] === $row['NationalId']){
     echo '<div class="alert alert-danger" role="alert">
     Failed. Cross Check your <code> National id </code>then refresh to Try again <strong><code>Note:</code> It seems someone else is using this National id</strong>
   </div>'; 
 
   exit();
  
    }
break;
  }
  */

 $student = "INSERT INTO coursees(Id,title,timereigistered)VALUES ('$id','$title',NOW())";



 if($conn->query($student)===true){
   echo '<button type="button" class="btn btn-outline-success">Student data added successfully</button>';
 }
 else{
   echo "failed" .$student.  '<br>' .$conn->error;
 }
 }

 
 ?>
   <div class="modal-body style ='transition:2s;">

<form  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">

            <div class="form-group">
            <label>Code</label>
            <input type="text" name="code" class="form-control  " placeholder="Code..." Maxlength=60 required> </div>
            <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class=" form-control" placeholder=" Name.." Maxlength=60 required></div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="registerbtn" class="btn btn-primary">Save</button>
        </div>
      </form>

    </div>
  </div>
</div>
</div>

<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary my-3">Admin Profile 
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">
              Add a Course
            </button>
    </h6>
  </div>

  <div class="card-body">
<h3 class ="my-1 p-2">Saved Units</h3>
<div class="table-responsive">
<?php
  

    $sql = "SELECT * FROM coursees ORDER BY timereigistered
    DESC";
    if($result = mysqli_query($conn, $sql)){

      if(mysqli_num_rows($result) > 0){
     
      echo '<table class="table table-bordered" id="dataTable" width="100%" cellspacing="1">';
      echo "<thead style='background:lightgray;'>";
      echo "<th>Course Code</th>";
          echo "<th>Title</th>";
          echo "<th>Time Of registration</th>";
          
          echo "<th>Edit</th>";
          echo "<th>Delete</th>";
         
      echo "</thead>";
  while($row = mysqli_fetch_array($result)){

      echo "<tr>";
          echo "<td>" . $row['Id'] . "</td>";
          echo "<td>" . $row['title'] . "</td>";
          echo "<td>" . $row['timereigistered'] . "</td>";
  echo '<td>
           <form action="" method="post">
                    <input type="hidden" name="edit_id" value="">
                    <button  type="submit" name="edit_btn" class="btn btn-success"> EDIT</button>
                </form>';
               echo '</td>';
          echo  '<td>
          <form action="" method="post">
          <input type="hidden" name="delete_id" value="">
          <button type="submit" name="delete_btn" class="btn btn-danger"> DELETE</button>
         </form>';
              echo '</td>';
               echo '</td>';;
       
  
       
      echo "</tr>";
     
      
  }

  mysqli_free_result($result);
    } else{
        echo "No records matching your query were found.";
    }
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
}
echo '</table>';
 
// Close connection

$conn->close();
?>
</div>
  </div>
</div>

</div>
<!-- /.container-fluid -->

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>