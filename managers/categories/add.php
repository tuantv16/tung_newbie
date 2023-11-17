<form action="" method="post" class="was-validated">

<div class="form-group">
    <label for="name">Tên danh mục mới:</label>

    <input type="text" class="form-control" id="name" placeholder="" name="name">
    <!-- <div class="valid-feedback">Valid.</div> -->
    <!-- <div class="invalid-feedback">Please fill out this field.</div> -->
</div>

<div class="form-inline">
    <div class="form-check" style="margin:5px 20px 20px 0px">
        <label class="form-check-label" for="radio1">
            <input type="radio" class="form-check-input" id="radio1" name="status" value="0" checked>Kích hoạt
        </label>
    </div>

    <div class="form-check" style="margin:5px 20px 20px 0px">
        <label class="form-check-label" for="radio2">
            <input type="radio" class="form-check-input" id="radio2" name="status" value="1" checked>Vô hiệu hóa
        </label>
    </div>

</div>

<button type="submit" class="btn btn-primary" name="submit" style="margin:0px 0px 20px 0px">Gửi</button>
<a href="/category.php" class="btn btn-primary" name="back" style="margin:0px 0px 20px 0px">Quay Lại</a>
</form>
 
                           
<?php 
include_once('database/db_connect.php');

if (isset ($_POST['submit'])) {
    $name = $_POST['name'];
    $status = $_POST['status'];
    $sql = "INSERT INTO categories (name, status) 
            VALUES ('$name','$status')";
    $result = $conn->query($sql);


    if ($result) {
        ?>
            <script>
                window.location.href = "/category.php";
            </script>
        <?php
        
    }
}
?>