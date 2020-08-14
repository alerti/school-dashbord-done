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
if(isset($_POST['registerbtn'])){

// kvstore API url
$url = 'http://localhost/api/student/course/add/index.php';
// Collection object
$Id =$_POST['code'];
$title=$_POST['name'];


$data = [
  "Id" =>"$Id",
  "title"=>"$title",
 
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
  'X-RapidAPI-Host:http://localhost/api/student/course/add/index.php',
 
  'Content-Type: application/json'
]);
// Execute cURL request with all previous settings
$response = curl_exec($curl);
// Close cURL session
curl_close($curl);
echo $response . PHP_EOL;
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
$data = json_decode(file_get_contents("http://localhost/api/student/course"));

           echo '<table class="table table-bordered" id="dataTable" my-1 width="100%" cellspacing="0" >';
      echo "<thead style='background:lightgray;'>";
      echo "<th>Course Code</th>";
          echo "<th>Course Name</th>";
          echo "<th>Time Registered</th>";
        
         
      echo "</thead>";
   
foreach($data as $row){
  foreach ($row as $value){
   
      echo "<tr>";
          echo "<td>" . $value ->Id. "</td>";
          echo "<td>" . $value->title . "</td>";
          echo "<td>" . $value->timereigistered . "</td>";
       

          echo '<td>';
  }}
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