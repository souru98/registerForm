<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Result</title>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" />
 <link rel="stylesheet" type="text/css" href="css/common.css" />
 <script type="text/javascript" charset="utf8" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.0.3.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
 <style>
  td,
  th {
   text-align: center;
  }

  table {
   border: 1px solid grey;
  }
 </style>
</head>

<body>
 <div class="row">
  <?php
  $con = mysqli_connect("localhost", "root", "", "test");
  if (!$con) {
   die("Connection failed: " . mysqli_connect_error());
  }
  $sql = "select * from tbl_users";
  $res = mysqli_query($con, $sql);
  if ($res) {
   if (mysqli_num_rows($res) > 0) {
  ?>

    <div class="col-md-8 col-md-offset-2">
     <div class="alert alert-info text-center">
      Users Details
     </div>
    </div>
    <div class="col-md-8 col-md-offset-2" style="color:white;">
     <table class="table" id="table">
      <thead>
       <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col"></th>
        <th scope="col">Contact</th>
        <th scope="col">Date of Birth</th>
        <th scope="col">Age</th>
        <th scope="col"></th>
       </tr>
      </thead>
      <tbody>
       <?php
       $cnt = 1;
       foreach ($res as $element) {
       ?>
        <tr>
         <td scope="row"><?php echo $cnt; ?></td>
         <td><?php echo htmlentities($element['name']); ?></td>
         <td contenteditable="true" id="user_<?php echo htmlentities($element['id']); ?>"><?php echo htmlentities($element['email']); ?></td>
         <td class="padding:8px 0"><input class="btn btn-sm btn-primary" type="button" name="update" onclick="update_element(<?php echo htmlentities($element['id']); ?>)" value="update"></td>
         <td><?php echo htmlentities($element['contact']); ?></td>
         <td><?php echo htmlentities($element['dob']); ?></td>
         <td><?php echo htmlentities($element['age']); ?></td>
         <td><input class="btn btn-sm btn-danger" type="button" name="delete" onclick="delete_row(<?php echo htmlentities($element['id']); ?>)" value="delete"></td>
        </tr>
       <?php
        $cnt++;
       }
       ?>
      </tbody>
     </table>
   <?php
   } else {
    echo '<div class="col-md-8 col-md-offset-2" style="color:white;"><div class="alert alert-danger">Table is Empty.</div></div>';
   }
  } else {
   echo '<div class="col-md-8 col-md-offset-2" style="color:white;"><div class="alert alert-danger">Fetching error..</div></div>';
  }
   ?>
    </div>
 </div>
 <script>
  function update_element(user_id) {
   var user_email = "user_" + user_id;
   var user_email = document.getElementById(user_email);
   $.ajax({
    type: 'POST',
    url: "includes/update_data.php",
    dataType: "json",
    data: {
     id: user_id,
     email: user_email
    },
    success: function(response) {
     if (response.status) {
      location.reload(true);
     }
    }
   });
  }

  function delete_row(user_id) {
   $.ajax({
    type: 'POST',
    url: "includes/delete_data.php",
    dataType: "json",
    data: {
     id: user_id
    },
    success: function(response) {

     location.reload(true);
     if (response.status) {}
    }
   });
  }
 </script>
</body>

</html>