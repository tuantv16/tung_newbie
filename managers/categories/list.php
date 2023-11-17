<script>
function confirmDelete(id) {

  let text = "Bạn có chắc chắn muốn xóa mục này không?";
  if (confirm(text) == true) {
    location.href= '?action=delete&id='+id;
  } 

}
</script>

<div class="table_row">
    <div class="table-responsive">
    <table class="table table-striped">

        <thead>
            <tr>
                <th>ID</th>
                <th>Tên danh mục</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
                
            </tr>
        </thead>

        <tbody>
            <?php 
                include_once('database/db_connect.php');
                
                $sql = "SELECT * FROM categories";
                $result = $conn->query($sql);

                if (!$result) {
                    die("kết nối thất bại" . $conn->error);
                }

                $i=0;
                while($row = $result->fetch_assoc()) {
                $i++;

                $idCustom = $row['id'];
               
                ?>
                    <tr>
                        <td><?php echo $i;?></td>
                        <td><?php echo $row["name"]?></td>
                        <td><?php echo $row["status"] == 0 ? 'Kích hoạt' : 'Vô hiệu hóa';?></td>
                        <td>
                            <a class="btn btn-primary" href="<?php echo '?action=edit&id='.$idCustom ?>">Edit</a> 
                            <!-- <a class="btn btn-primary" href="/managers/categories/edit.php?id=<?php // echo $i ?>">Edit2</a>  -->
                            <a class="btn btn-danger" href="javascript:void(0)" onclick="confirmDelete('<?php echo $idCustom?>')">Delete</a>
                        </td>
                    </tr>
                <?php 
                }      
            ?>
         
        </tbody>
    </table>
    </div>
</div>
            
            
