<?php

// include '_inc/func.php';


if (isset($_GET['edit'])) {
  
  $host = 'localhost';
  $user = 'root';
  $password = '';
  $database = 'practice';
  $db = new mysqli($host, $user, $password, $database);

  // $db = dbConnect();
  // $sql = "SELECT * FROM contact where id = ".$_GET['id'].""; 
  $sql = "SELECT * FROM contact WHERE id = " . intval($_GET['id']);

  $result = $db->query($sql);
  $row1 = $result->fetch_assoc();
  
  
}

// Update the form 
if (isset($_POST['update'])) {
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $database = 'practice';
    $db = new mysqli($host, $user, $password, $database);

    $fname = $db->real_escape_string($_POST["fname"]); 
    $lname = $db->real_escape_string($_POST["lname"]); 
    $email = $db->real_escape_string($_POST["email"]);

    $id = intval($_POST['id']);
    $sql = "UPDATE contact SET fname='$fname', lname='$lname', email='$email' WHERE id=$id";

    // $sql = "UPDATE contact SET fname='$fname', lname='$lname', email='$email' ";

    if ($db->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $db->error;
    }

    $db->close();
}
//<!-- same file as testForm.php is used for displying the form. -->

?>
<?php
echo "<h1>Test Form</h1>";

if (isset($_POST["submit"])) {

      $host = 'localhost';
      $user = 'root';
      $password = '';
      $database = 'practice'; // Change this to your actual DB name

      // Create connection
      $db = new mysqli($host, $user, $password, $database);
      // $db = dbConnect();
    // Check connection
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }

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
        $db->close();

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
      <option value="" selected>Please select</option>
      <option value="volvo">Volvo</option>
      <option value="suzuki">Suzuki</option>
      <option value="honda">Honda</option>
      <option value="audi">Audi</option>
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

<table>
  <thead>
    <tr>
      <th>id</th>
      <th>fname</th>
      <th>lname</th>
      <th>email</th>
      <th>cars</th>
      <th>edit</th>
    </tr>
  </thead>

  <tbody>
  <?php
  $host = 'localhost';
  $user = 'root';
  $password = '';
  $database = 'practice';
  $db = new mysqli($host, $user, $password, $database);
  // $db = dbConnect();
  $sql = "SELECT * FROM contact order by id desc;"; 

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
      echo '</tr>';
    }
  }
  $db->close();
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
    </tr>
  </tfoot>
</table>

