<?php 
// Start session 
session_start(); 

// Get data from session 
$sessData = !empty($_SESSION['sessData'])?$_SESSION['sessData']:''; 

// Get status from session 
if(!empty($sessData['status']['msg'])){ 
$statusMsg = $sessData['status']['msg']; 
$status = $sessData['status']['type']; 
unset($_SESSION['sessData']['status']); 
} 

// Include and initialize DB class 
require_once 'DB.class.php'; 
$db = new DB(); 

// Fetch the users data 
$users = $db->getRows('users', array('order_by'=>'id DESC')); 

// Retrieve status message from session 
if(!empty($_SESSION['statusMsg'])){ 
echo '<p>'.$_SESSION['statusMsg'].'</p>'; 
unset($_SESSION['statusMsg']); 
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>index</title>
</head>
<body>
<div class="row m-5">
<div class="col-md-12 head ">
    <h5>Users</h5>
    <!-- Add link -->
    <div class="float-right">
        <a href="add.php" class="btn btn-success"><i class="plus"></i> New User</a>
    </div>
</div>

<!-- Status message -->
<?php if(!empty($statusMsg)){ ?>
    <div class="alert alert-<?php echo $status; ?>"><?php echo $statusMsg; ?></div>
<?php } ?>

<!-- List the users -->
<table class="table table-striped table-bordered ">
    <thead class="thead-dark">
        <tr>
            <th width="5%">#</th>
            <th width="20%">Name</th>
            <th width="25%">Email</th>
            <th width="18%">Phone</th>
            <th width="18%">Created</th>
            <th width="14%">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if(!empty($users)){ $i=0; foreach($users as $row){ $i++; ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['phone']; ?></td>
            <td><?php echo $row['created']; ?></td>
            <td>
                <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-warning">edit</a>
                <a href="action.php?action_type=delete&id=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure to delete data?');">delete</a>
            </td>
        </tr>
        <?php } }else{ ?>
        <tr><td colspan="5">No user(s) found...</td></tr>
        <?php } ?>
    </tbody>
</table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
