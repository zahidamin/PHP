<?php

// include '_inc/func.php';


if (isset($_GET['edit'])) {
  
  // $host = 'localhost';
  // $user = 'root';
  // $password = '';
  // $database = 'practice';
  // $db = new mysqli($host, $user, $password, $database);

  // $db = dbConnect();
  // $sql = "SELECT * FROM contact where id = ".$_GET['id'].""; 
  $sql = "SELECT * FROM contact WHERE id = " . intval($_GET['id']);

  $result = $db->query($sql);
  $row1 = $result->fetch_assoc();
  
  
}

// Update the form 
if (isset($_POST['update'])) {
    // $host = 'localhost';
    // $user = 'root';
    // $password = '';
    // $database = 'practice';
    // $db = new mysqli($host, $user, $password, $database);

    $fname = $db->real_escape_string($_POST["fname"]); 
    $lname = $db->real_escape_string($_POST["lname"]); 
    $email = $db->real_escape_string($_POST["email"]);
    $cars = $db->real_escape_string($_POST["cars"]);

    $id = intval($_POST['id']);
    $sql = "UPDATE contact SET fname='$fname', lname='$lname', email='$email', cars='$cars' WHERE id=$id";

    // $sql = "UPDATE contact SET fname='$fname', lname='$lname', email='$email' ";

    if ($db->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $db->error;
    }

    // $db->close();
}

// Delete the record

if (isset($_GET['del'])) {
  
  $idd = $_GET['id'];
  $sql = "UPDATE contact SET 
  status=1 
  WHERE id=$idd";

//  $idd = $_GET['id'];
//   $sql = "DELETE FROM contact WHERE id = $idd";
  $db->query($sql);
  echo "The record $idd has been deleted successfully";
}


// Restored Section


if (isset($_GET['restore'])) {
  
  $idd = $_GET['id'];
  $sql = "UPDATE contact SET 
  status=0 
  WHERE id=$idd";

//  $idd = $_GET['id'];
//   $sql = "DELETE FROM contact WHERE id = $idd";
  $db->query($sql);
  echo "The record $idd has been restored successfully";
}


?>
<?php
echo "<h1>Test Form</h1>";

if (isset($_POST["submit"])) {

      // $host = 'localhost';
      // $user = 'root';
      // $password = '';
      // $database = 'practice'; // Change this to your actual DB name
      // $db = new mysqli($host, $user, $password, $database);
      // $db = dbConnect();
    // Check connection
    // if ($db->connect_error) {
    //     die("Connection failed: " . $db->connect_error);
    // }

    // column variables
    $fname = $db->real_escape_string($_POST["fname"]); 
    $lname = $db->real_escape_string($_POST["lname"]); 
    $email = $db->real_escape_string($_POST["email"]);
    $cars = $_POST["cars"];

    // MySQL query to insert data
    $sql = "INSERT INTO contact (fname, lname, email, cars) VALUES ('$fname', '$lname', '$email', '$cars')"; //Note: Wrong way: using double quotes both inside and outside

    if ($db->query($sql) === TRUE) {
        echo "New record inserted successfully";
        } else {
            echo "Error: " . $sql. "<br>". $db->error;
        }
        
        // Close connection
        // $db->close();

}
?> 
<br><br>

<form method="POST" action="index.php?page=testForm"> 
  <input type="hidden" name="id" value="<?php echo $row1['id']; ?>"> 
  <label for="fname">First name:</label><br>
  <input type="text" id="fname" name="fname" value="<?php echo $row1['fname'];?>"><br><br>
  <label for="fname">Last name:</label><br>
  <input type="text" id="lname" name="lname" value="<?php echo $row1['lname'];?>"><br><br>

  <label for="email">Email:</label><br>
  <input type="text" id="email" name="email" value="<?php echo $row1['email'];?>"><br><br>

  <label for="cars">Choose a car:</label>
    <select name="cars" id="cars">
      <option value="">Please select</option>
      <option value="volvo" <?php if (isset($_GET['edit'])){if ($row1['cars']=='volvo') {echo 'selected';}}?> >Volvo</option>
      <option value="suzuki"<?php if (isset($_GET['edit'])){if ($row1['cars']=='suzuki') {echo 'selected';}}?>>Suzuki</option>
      <option value="honda"<?php if (isset($_GET['edit'])){if ($row1['cars']=='honda') {echo 'selected';}}?>>Honda</option>
      <option value="audi"<?php if (isset($_GET['edit'])){if ($row1['cars']=='audi') {echo 'selected';}}?>>Audi</option>
    </select>
<br><br>

<?php
if (isset($_GET['edit'])) {
  echo '<button name="update">Update</button>';
}
else {
  echo '<button name="submit">Submit</button>';
}
?>
</form>

<br>


<!-- this is a test form to insert data into the database. -->
<h2>Active List</h2>
<table>
  <thead>
    <tr>
      <th>id</th>
      <th>fname</th>
      <th>lname</th>
      <th>email</th>
      <th>cars</th>
      <th>edit</th>
      <th>delete</th>
    </tr>
  </thead>

  <tbody>
  <?php
  // $host = 'localhost';
  // $user = 'root';
  // $password = '';
  // $database = 'practice';
  // $db = new mysqli($host, $user, $password, $database);
  // $db = dbConnect();
  $sql = "SELECT * FROM contact WHERE status = 0 order by id desc;"; 

  $result = $db->query($sql);
  if ($result) {
    while ($row = $result->fetch_assoc()) {
      echo '<tr>';
      echo '<td>'.$row["id"].'</td>';
      echo '<td>'.$row["fname"].'</td>';
      echo '<td>'.$row["lname"].'</td>';
      echo '<td>'.$row["email"].'</td>';
      echo '<td>'.$row["cars"].'</td>';
      echo '<td><a href="index.php?page=testForm&edit&id='.$row["id"].'">Edit</a></td>';
      echo '<td><a href="index.php?page=testForm&del&id='.$row["id"].'">Delete</a></td>';
      echo '</tr>';
    }
  }
  // $db->close();
  ?>
  </tbody>
  
  <tfoot>
    <tr>
      <th>id</th>
      <th>fname</th>
      <th>lname</th>
      <th>email</th>
      <th>cars</th>
      <th>edit</th>
      <th>delete</th>
    </tr>
  </tfoot>
</table>

<br><br>

<h2>Inactive List</h2>
<table>
  <thead>
    <tr>
      <th>id</th>
      <th>fname</th>
      <th>lname</th>
      <th>email</th>
      <th>cars</th>
      <th>edit</th>
      <th>restore</th>
    </tr>
  </thead>

  <tbody>
  <?php
  // $host = 'localhost';
  // $user = 'root';
  // $password = '';
  // $database = 'practice';
  // $db = new mysqli($host, $user, $password, $database);
  // $db = dbConnect();
  $sql = "SELECT * FROM contact WHERE status = 1 order by id desc;"; 

  $result = $db->query($sql);
  if ($result) {
    while ($row = $result->fetch_assoc()) {
      echo '<tr>';
      echo '<td>'.$row["id"].'</td>';
      echo '<td>'.$row["fname"].'</td>';
      echo '<td>'.$row["lname"].'</td>';
      echo '<td>'.$row["email"].'</td>';
      echo '<td>'.$row["cars"].'</td>';
      echo '<td><a href="index.php?page=testForm&edit&id='.$row["id"].'">Edit</a></td>';
      echo '<td><a href="index.php?page=testForm&restore&id='.$row["id"].'">Restore</a></td>';
      echo '</tr>';
    }
  }
  // $db->close();
  ?>
  </tbody>
  
  <tfoot>
    <tr>
      <th>id</th>
      <th>fname</th>
      <th>lname</th>
      <th>email</th>
      <th>cars</th>
      <th>edit</th>
      <th>restore</th>
    </tr>
  </tfoot>
</table>
