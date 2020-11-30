<?php
include_once "config.php";
$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if(!$connection) {
    throw new Exception("Not Connected To Database");
} 
$query  = "SELECT * FROM tasks WHERE complete = 0 ORDER BY ID DESC";
$result = mysqli_query($connection, $query); 

$complete_tasks_query = "SELECT * FROM tasks WHERE complete = 1 ORDER BY ID DESC";
$result_complete_tasks = mysqli_query($connection, $complete_tasks_query); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.4.1/milligram.css">
    <style>
        body{

            margin-top: 30px;

        }
        #main{

            padding: 0px 150px 0x 150px;

        }
        #action{

            width: 150px;

        }
    </style>
</head>
<body>
    <div class="container" id="main">
        <h1>Task Manager</h1>

        <?php
        if(mysqli_num_rows($result_complete_tasks) > 0){
            ?>
            <h4>Complete Tasks</h4>
            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th>ID</th>
                        <th>Task</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                while($cdata = mysqli_fetch_assoc($result_complete_tasks)) {
                    $time_stamp = strtotime($cdata['date']);
                    $cdate = date("jS M, Y", $time_stamp);
                        ?>
                            <tr>
                                <td><input class="label-inline" type="checkbox" value="<?php echo $cdata['id']; ?>"></td>
                                <td><?php echo $cdata['id'];   ?></td>
                                <td><?php echo $cdata['task']; ?></td>
                                <td><?php echo $cdate; ?></td>
                                <td><a href="#">Delete</a></td>
                            </tr>
                        <?php
                }
                ?>
            </tbody>
            </table>
            <p>...</p>
            <?php
        }
        ?>

        <?php
        if(mysqli_num_rows($result) == 0){
            ?>
            <p>No Tasks Found</p>
            <?php
        } else {
            ?>
            <h4>Upcoming Tasks</h4>
            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th>ID</th>
                        <th>Task</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <?php
                    while( $data = mysqli_fetch_assoc( $result ) ) {
                        $time_stamp = strtotime($data['date']);
                        $date = date("jS M, Y", $time_stamp);
                        ?><tr>
                            <td><input class="label-inline" type="checkbox" value="<?php echo $data['id']; ?>"></td>
                            <td><?php echo $data['id'];   ?></td>
                            <td><?php echo $data['task']; ?></td>
                            <td><?php echo $date; ?></td>
                            <td><a href="index.php?delete=1">Delete</a> | <a href="#">Edit</a> | <a href="#">Complete</a></td>
                            </tr>
                        <?php
                    }
                    mysqli_close($connection);
                    ?>
                    </tbody>
                </table>
                <select id="">
                    <option value="0">With Selected</option>
                    <option value="del">Delete</option>
                    <option value="complete">Mark As Complete</option>
                </select>
                <input class="button-primary" type="submit" value="submit">
                
            <?php
        }
        ?> 
        <p>...</p>
        <h4>Add Task</h4>
        <form method="post" action="tasks.php">
            <fieldset>
                <?php
                    $added = $_GET['added']??'';
                    if($added) {
                        echo "<p>Task Successfully Added</p>";
                    }
                ?>
                <label for="task">Task</label>
                <input type="text" placeholder="Task Details" id="task" name="task" value="<?php ?>">
                <label for="date">Date</label>
                <input type="date" placeholder="Task Date" id="date" name="date" value="<?php ?>">

                <input class="button-primary" type="submit" value="Add Task">
                <input type="hidden" name="action" value="add">
            </fieldset>
        </form>    
    </div>
</body>
</html>