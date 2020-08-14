  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>



<script>
$(document).ready(function(){

$(document).on('click' , '.bn-edit' ,function(){
    var id = this.id;
    $.ajax({
      url: 'read.php',
      type: 'POST',
      dataType: 'JSON',
      data: {"id":id,"type":"single"},
      success:function(response){
        $("#edit-modal").modal('show');
        $('#title').val(response.title);
        $('#description').val(response.description);
        $('#url').val(response.url);
        $("#category").val(response.category);
        $("#id").val(id);
      }
    });
  });


$(document).on('click' , '#update' ,function(){
    $.ajax({
        url: 'edit.php',
        type: 'POST',
        dataType: 'JSON',
        data: $("#frmEdit").serialize(),
        success:function(response){
          $("#messageModal").modal('show');
          $("#msg").html(response);
          $("#edit-modal").modal('hide');
          loadData();
        }
      });
  });

$(document).on('click' , '.bn-delete' ,function(){
  if(confirm("Are you sure want to delete the record?")) {
    var id = this.id;
    $.ajax({
      url: 'delete.php',
      type: 'POST',
      dataType: 'JSON',
      data: {"id":id},
      success:function(response){
        loadData();
      }
    });
  }
});
});

function loadData() {
$.ajax({
  url: 'read.php',
  type: 'POST',
  data: {"type":"all"},
  success:function(response){
    $("#container").html(response);
  }
});
}

</script>