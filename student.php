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
     

  <div class="modal-body style ='transition:2s;">

<?php
if(isset($_POST['registerbtn'])){

// kvstore API url
$url = 'http://localhost/api/student/add/index.php';
// Collection object
$First_Name =$_POST['First_Name'];
$Middle_Name=$_POST['Middle_Name'];
$Last_Name=$_POST['Last_Name'];
$Date_Birth = $_POST['Date_Birth'];
$NationalId=$_POST['NationalId'];
$county=$_POST['county'];
$Country=$_POST['Country'];
$course =$_POST['course'];
$data = [
  "First_Name" =>"$First_Name",
  "Middle_Name"=>"$Middle_Name",
  "Last_Name"=> "$Last_Name",
  "Date_Birth"=>"$Date_Birth " ,
  "NationalId"=>"$NationalId" ,
  "county"=>"$county",
  "Country"=>"$Country" ,
  "course"=>"$course"
];
// Initializes a new cURL session
$curl = curl_init($url);
// Set the CURLOPT_RETURNTRANSFER option to true
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
// Set the CURLOPT_POST option to true for POST request
curl_setopt($curl, CURLOPT_POST, true);
// Set the request data as JSON using json_encode function
curl_setopt($curl, CURLOPT_POSTFIELDS,  json_encode($data));
// Set custom headers for RapidAPI Auth and Content-Type header
curl_setopt($curl, CURLOPT_HTTPHEADER, [
  'X-RapidAPI-Host:http://localhost/api/student/add/index.php',
 
  'Content-Type: application/json'
]);
// Execute cURL request with all previous settings
$response = curl_exec($curl);
// Close cURL session
curl_close($curl);
echo $response . PHP_EOL;
}

?>
<form  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">

</form>

<form  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">

            <div class="form-group">
            <label>Firstname</label>
            <input type="text" name="First_Name" class="form-control  " placeholder="First name..." Maxlength=60 required> </div>
            <div class="form-group">
            <label>Second name</label>
            <input type="text" name="Middle_Name" class=" form-control" placeholder=" Middle name.." Maxlength=60 required></div>
            <div class="form-group">
                <label>Last name</label>
                <input type="text" name="Last_Name" class="form-control " placeholder="Last Name.." Maxlength=60 required> 
            </div>
            <div class="form-group">
                <label>Date of birth</label>
                <input type="date" name="Date_Birth" class=" form-control" placeholder="Date Birth..">

            </div>
            <div class="form-group">
                <label>National Id</label>
                <input type="NationalId or Passport" name="NationalId" class="form-control" placeholder="Nationa Id..."  Maxlength=8 required>
            </div>
            <div class="form-group">
                <label>County</label>
                <input type="County" name="county" class="form-control" placeholder="County..." Maxlength=60 required>
            </div>
            <div class="form-group">
                <label>Country</label>
                <?php 
                   $query = "SELECT * FROM countries";

                   $res =$conn->query($query);
                   echo "<select name='Country' class='form-control' placeholder='Country...'>
                   ";
                   while (($row = $res->fetch_assoc()) != null)
                   {
                       echo "<option value = '{$row['name']}'";
                       
                           
                       echo ">{$row['name']}</option>";
                   }
                   echo "</select>"; ?>
            </div>
            <div class="form-group">
            <?php 
                   $query = "SELECT * FROM coursees";

                   $res =$conn->query($query);
                   echo "<select  name='course' class='form-control' placeholder='Course...'>
                   ";
                   while (($row = $res->fetch_assoc()) != null)
                   {
                       echo "<option value = '{$row['title']}'";
                       
                           
                       echo ">{$row['Id']}&nbsp;&nbsp; </i>&nbsp;{$row['title']}</option>";
                   }
                   echo "</select>"; ?>
                  
                
            </div>
          
          
                 
        
    
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
              Add Student details
            </button>
    </h6>
  </div>

  <div class="card-body">
<h3 class ="my-1 p-2">Registered students</h3>
<div class="table-responsive">


<?php 
$data = json_decode(file_get_contents("http://64.227.44.162/api/student/"));

           echo '<table class="table table-bordered" id="dataTable" my-1 width="100%" cellspacing="0" >';
      echo "<thead style='background:lightgray;'>";
      echo "<th>Student Id</th>";
          echo "<th>First Name</th>";
          echo "<th>Middle Name</th>";
          echo "<th>Last name</th>";
          echo "<th>Date of birth</th>";
          echo "<th>National Id</th>";
          echo "<th>County</th>";
          echo "<th>Country</th>";
          echo "<th>Course</th>";
          echo "<th>Time Registered</th>";
          echo "<th>Edit</th>";
          echo "<th>Delete</th>";
         
      echo "</thead>";
   
foreach($data as $row){
  foreach ($row as $value){
   
      echo "<tr>";
          echo "<td>" . $value ->id. "</td>";
          echo "<td>" . $value->First_Name . "</td>";
          echo "<td>" . $value->Middle_Name . "</td>";
          echo "<td>" . $value->Last_Name . "</td>";
          echo "<td>" . $value->Date_Birth . "</td>";
          echo "<td>" . $value->NationalId . "</td>";
          echo "<td>" . $value->county . "</td>";
          echo "<td>" . $value->Country . "</td>";
          echo "<td>" . $value->course . "</td>"; 
          echo "<td>" . $value->Time_to_register . "</td>";

          echo '<td>';
          ?>
         
           <form action='<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>' method="post">
                    <input type="hidden" name="edit_id" value="">
                    <button  type="submit" name="edit_btn" class="btn btn-success"> EDIT</button>
                </form>
                <?php
               echo '</td>';
          echo  '<td>';

          ?>
<?php
/*
if (isset($_POST['delete_btn'])){
  
   function curl_del($path)
  { 
    $path="http://localhost/api/student/readone/";
      $url = $this->__url.$path;
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
      $result = curl_exec($ch);
      $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
      curl_close($ch);
  
      return $result;
  }
} */
?>



<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
          <input type="hidden" name="delete_id" value="">
          <button type="submit" name="delete_btn" class="btn btn-danger btn-action bn-delete"> DELETE</button>
         </form>
         <?php
    
              echo '</td>';
               echo '</td>';
       
  
       
      echo "</tr>";
    }

  }
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


