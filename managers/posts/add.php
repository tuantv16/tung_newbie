
<?php
include_once('database/db_connect.php');

if (isset ($_POST['submit'])) {
    $categoryId = $_POST['category_id'];
    $titles = $_POST['titles'];
    $contents = $_POST['contents'];
    $status = $_POST['status'];

    $error = false;

    if (empty($titles) || empty($contents)) {
        echo 'Hãy nhập dữ liệu';
        $error = true;
    }

    if (!$error) {
        $posts = "INSERT INTO posts (category_id, titles, contents, status) 
                    VALUES ('$categoryId','$titles','$contents','$status')";
        $upload = $conn->query($posts);
    
        if ($upload) {
            ?>
                <script>
                    window.location.href = "/posts.php";
                </script>
            <?php
        }
    }
}
?>

<form action="" method="post" class="was-validated">
<div class="form-group">
    <label for="name">Chọn danh mục:</label>
    <select class="form-control" name="category_id" >
        <option value=""></option>
        <?php 
            $sql = "SELECT * FROM categories WHERE status=0";
            $result = $conn->query($sql);
  
            while($row = $result->fetch_assoc()) { 
        ?>
        <option value="<?php echo $row['id'] ?>" ><?php echo $row['name'] ?></option>
        <?php } ?>  
    </select>
</div>

<div class="form-group">
    <label for="name">Tên bài viết:</label>
    <input type="text" class="form-control" id="titles" placeholder="" name="titles">
</div>

<div class="form-group">
    <label for="name">Nội dung bài viết:</label>
    <textarea type="text" class="form-control" id="contents" placeholder="" name="contents" rows="10"></textarea>
</div>

<div class="form-inline">
    <div class="form-check" style="margin:5px 20px 20px 0px">
        <label class="form-check-label" for="radio1">
            <input type="radio" class="form-check-input" id="radio1" name="status" value="0" checked>Kích hoạt
        </label>
    </div>

    <div class="form-check" style="margin:5px 20px 20px 0px">
        <label class="form-check-label" for="radio2">
            <input type="radio" class="form-check-input" id="radio2" name="status" value="1">Vô hiệu hóa
        </label>
    </div>
</div>

<button type="submit" class="btn btn-primary" name="submit" style="margin:0px 0px 20px 0px">Gửi</button>
<a href="/posts.php" class="btn btn-primary" name="back" style="margin:0px 0px 20px 0px">Quay Lại</a>
</form>