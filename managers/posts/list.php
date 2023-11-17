<script>
function confirmDelete(id) {
  let text = "Bạn có chắc chắn muốn xóa mục này không?";
  if (confirm(text) == true) {
    location.href= '?action=delete&id='+id;
  } 
}
</script>

<?php 
    include_once('database/db_connect.php');
 
    $limit = 10;
    $begin = 0;
    if(isset($_GET['page'])) {
        $begin = ($_GET['page'] - 1) * $limit;
    }

    $selectAll = "SELECT * FROM posts";
    $data = $conn->query($selectAll);

    $totalPage = ceil($data->num_rows / $limit);

    $sql = "SELECT posts.id, posts.category_id, posts.titles, posts.contents, posts.status, categories.name as category_name
            FROM posts
            LEFT JOIN categories
            ON categories.id = posts.category_id
            order by posts.id desc
            LIMIT $limit OFFSET $begin
            ";
    $allPosts = $conn->query($sql);
    
    if (!$allPosts) {
        die("kết nối thất bại" . $conn->error);
    }

    function getActionPage($currentPage, $type) {
        $result = 1;
        if ($type == 'truoc') {
            $result = $currentPage - 1;
        }
        
        if ($type == 'sau') {
            $selectAll = "SELECT * FROM posts";  
            $result = $currentPage + 1;
        }

        return $result;
    }

    function getStatus($currentPage, $totalPage) {
        if($currentPage == 1){
            return 'false';
        } 
        return 'true';
    }

    function getStatus2($currentPage, $totalPage) {
        if($currentPage == $totalPage){
            return 'false';
        } 
        return 'true';
    }

    if(isset($_GET['page'])) {
        $prev = getActionPage($_GET['page'], 'truoc');
        $next = getActionPage($_GET['page'], 'sau');
        $status = getStatus($_GET['page'], $totalPage);
        $status2 = getStatus2($_GET['page'], $totalPage);
    }
?>

<div class="table_row">
    <div class="table-responsive">
    <table class="table table-striped">

        <thead>
            <tr>
                <th>ID</th>
                <th>Danh mục bài viết</th>
                <th>Tiêu đề bài viết</th>
                <th>Nội dung bài viết</th>
                <th>Trạng thái</th>
                <th style = "width: 200px"></th>
            </tr>
        </thead>

        <tbody>
            <?php
                $i=1;
                while($row = $allPosts->fetch_assoc()) {
                $rowsNumber = $begin + $i++;
                    if ($allPosts->num_rows > 0) {
                            
                            $idCustom = $row['id'];
                            $categoryName = $row['category_name'];
                            //$categoryName = getNameCategory($conn, $row['category_id']);
                    ?>
                        <tr>
                            <td><?php echo $rowsNumber;?></td>
                            <td><?php echo $categoryName; ?></td>
                            <td><?php echo $row["titles"]?></td>
                            <td><?php echo $row["contents"]?></td>
                            <td><?php echo $row["status"] == 0 ? 'Kích hoạt' : 'Vô hiệu hóa'; ?></td>
                            <td>
                                <a class="btn btn-primary" href="<?php echo '?action=edit&id='.$idCustom ?>">Edit</a> 
                                <a class="btn btn-danger" href="javascript:void(0)" onclick="confirmDelete('<?php echo $idCustom?>')">Delete</a>
                            </td>
                        </tr>
                        <?php
                    }
                }
            ?>

        </tbody>
    </table>

    <ul class="pagination">
        <li class="<?php echo $status == 'false' ? 'disabled' : '' ?>"><a href="?page=1" onclick="return <?php echo $status; ?>">START</a></li>
        <li class="<?php echo $status == 'false' ? 'disabled' : '' ?>"><a href="?page=<?php echo $prev; ?>" onclick="return <?php echo $status; ?>"><<</a></li>
        
        <?php 
            for($j = 1; $j <= $totalPage; $j++) {
                $active = '';

                if(isset($_GET['page'])) {
                    $active = $_GET['page'] == $j ? 'active' : '';
                } 

                if (!isset($_GET['page']) && $j == 1) {
                    $active = 'active';
                }
                
        ?>
                <li><a href="?page=<?php echo $j; ?>" class="<?php echo $active; ?>"><?php echo $j; ?></a></li>
                <?php
            }
        ?>

        <li class="<?php echo $status2 == 'false' ? 'disabled' : '' ?>"><a href="?page=<?php echo $next; ?>" onclick="return <?php echo $status2; ?>">>></a></li>
        <li class="<?php echo $status2 == 'false' ? 'disabled' : '' ?>"><a href="?page= <?php echo $totalPage; ?>" onclick="return <?php echo $status2; ?>">END</a></li>

    </ul>

    </div>
</div>
            
            
