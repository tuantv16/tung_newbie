
<?php
include_once('database/db_connect.php');
    
$id = "";
$categories = "";
$titles = "";
$contents = "";
$status = "";

$error = "";
$success = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET["id"])) {
        ?>
            <script>
                window.location.href = "/posts.php";
            </script>
        <?php
        exit;
    }

    $id = $_GET["id"];

    $sql = "SELECT * FROM posts WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $categoryId = $row['category_id'];
        $titles = $row['titles'];
        $contents = $row['contents'];
        $status = $row['status'];
    } 
    //mysqli_close($conn);
}

if (isset ($_POST['updateForm'])) {

    $id = $_POST['id'];
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
        $sql = "UPDATE posts
                SET category_id='$categoryId', titles='$titles', contents='$contents', status='$status' 
                WHERE id = $id";
        $result = $conn->query($sql);

        if ($result) {
            ?>
                <script>
                    window.location.href = "/posts.php";
                </script>
            <?php
        }
    }
}
?>
<?php 

// get select box category
function listCategory($conn) {
    $results = [];
    $sql = "SELECT id, name FROM categories WHERE status = 0 order by id desc";
    $result = $conn->query($sql);
 
    while($row = $result->fetch_assoc()) { 
        $results[] = $row;
    }

    return $results;
}
   
 $categories = listCategory($conn);  

 function getDataById($conn, $idCustom) {
    $results = [];
    $posts = "SELECT * FROM posts WHERE id=$idCustom";
    $query = $conn->query($posts); 
    $data = $query->fetch_object();
    $results = (array) $data;
    return $results;
 }

 $data = getDataById($conn, $id);
?>

<form action="" method="post" class="was-validated">
<input type="hidden" value="<?php echo $id; ?>" name="id">
<div class="form-group">
    <label for="name">Chọn danh mục:</label>
    <select class="form-control" name="category_id" >
        <option value=""></option>
        <?php 
            if(!empty($categories)) {
                foreach($categories as $row) {
                    $id = $row['id'];
                    $name = $row['name'];
                    //$textSelected = $categoryId == $id ? 'selected' : '';
                    $textSelected = '';
                    if($categoryId == $id) {
                        $textSelected = 'selected';
                    }
        ?>

    <option value="<?php echo $id; ?>" <?php echo $textSelected;?>><?php echo $name; ?></option>;
    
        <?php 
                }
            }
        ?>
    
    </select>
</div>

<div class="form-group">
    <label for="name">Sửa tên bài viết:</label>
    <input type="text" class="form-control" id="titles" placeholder="" name="titles" value="<?php echo $data['titles']; ?>">
</div>

<div class="form-group">
    <label for="name">Sửa nội dung bài viết:</label>
    <textarea type="text" class="form-control" id="contents" placeholder="" name="contents" rows="10" ><?php echo $data['contents']; ?></textarea>
</div>
                
<div class="form-inline">
    <div class="form-check" style="margin:5px 20px 20px 0px">
        <label class="form-check-label" for="radio1">
            <input type="radio" class="form-check-input" id="radio1" name="status" value="0" <?php echo $status == 0 ? 'checked' : ''; ?>>Kích hoạt
        </label>
    </div>

    <div class="form-check" style="margin:5px 20px 20px 0px">
        <label class="form-check-label" for="radio2">
            <input type="radio" class="form-check-input" id="radio2" name="status" value="1" <?php echo $status == 1 ? 'checked' : ''; ?>>Vô hiệu hóa
        </label>
    </div>
</div>
           
<button type="submit" class="btn btn-primary" name="updateForm" style="margin:0px 0px 20px 0px">Gửi</button>
<a href="/posts.php" class="btn btn-primary" name="back" style="margin:0px 0px 20px 0px">Quay Lại</a>
</form>