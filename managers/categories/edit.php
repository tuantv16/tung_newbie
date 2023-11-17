
 
<?php 
include_once('database/db_connect.php');

$id = "";
$name = "";
$status = "";

$error = "";
$success = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET["id"])) {
        ?>
            <script>
                window.location.href = "/category.php";
            </script>
        <?php
        exit;
    }

    $id = $_GET["id"];

    $sql = "SELECT * FROM categories WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        // Dữ liệu được tìm thấy
        $row = mysqli_fetch_assoc($result);
        $name = $row['name'];
        $status = $row['status'];
        //echo $row['status'];
         //echo $row['name'];
        // echo '<pre>';
        // var_dump($row);

    
    } 

    mysqli_close($conn);

}


if (isset($_POST['updateForm'])) {
  
    $id = $_POST["id"];
    $name = $_POST["name"];
    $status = $_POST["status"];
    
    $error = false;

    if (empty($name)) {
        echo 'Hãy nhập dữ liệu';
        $error = true;
    }


    if (!$error) {
        $sql = "UPDATE categories " .
                "SET name = '$name', status = '$status' " .
                "WHERE id = $id";

        $result = $conn->query($sql);

        if($result) {
            ?>
                <script>
                    window.location.href = "/category.php";
                </script>
            <?php
       
        }
    } 
}
?>

<form action="" method="post" class="was-validated">    
<input type="hidden" value="<?php echo $id; ?>" name="id">
<div class="form-group">
    <label for="name">Sửa tên danh mục:</label>
    <input type="text" class="form-control" id="name" placeholder="" name="name" value="<?php echo $name; ?>">
    <!-- <div class="valid-feedback">Valid.</div> -->
    <!-- <div class="invalid-feedback">Please fill out this field.</div> -->
</div>

<div class="form-inline">
    <div class="form-check" style="margin:5px 20px 20px 0px">
        <label class="form-check-label" for="radio1">
            <input type="radio" class="form-check-input" id="radio1" name="status" value="0" 
            <?php 
            if($status==0)
            {
                echo 'checked';
            }
            ?> 
            >Kích hoạt
        </label>
    </div>

    <div class="form-check" style="margin:5px 20px 20px 0px">
        <label class="form-check-label" for="radio2">
            <input type="radio" class="form-check-input" id="radio2" name="status" value="1" 
            <?php 
            if($status==1)
            { 
                echo 'checked';
            }
            ?> 
            >Vô hiệu hóa
        </label>
    </div>

</div>

<button type="submit" class="btn btn-primary" name="updateForm" style="margin:0px 0px 20px 0px">Gửi</button>
<a href="/category.php" class="btn btn-primary" name="back" style="margin:0px 0px 20px 0px">Quay Lại</a>
</form>