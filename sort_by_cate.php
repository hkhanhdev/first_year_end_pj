<?php include_once ('master/header.php');
include_once ('master/database.php');
?>

<?php
if (isset($_GET['category'])) {
    $category = $_GET['category'];
    $sql = "SELECT *FROM (
  SELECT p.prd_id, p.prd_name, c.cate_id, c.cate_name, p.prd_price,p.prd_image
  FROM tbl_product p 
  LEFT JOIN tbl_category c ON p.cate_id = c.cate_id
) AS npt
WHERE npt.cate_name = '$category';";
    $result = mysqli_query($conn, $sql);
$retrieve_cate = "select c.cate_name from tbl_category c";
$ket_qua = mysqli_query($conn,$retrieve_cate);
}
?>
<div class="category_section layout_padding">
    <div class="container">
        <div class="category_main">
            <h2 class="category_text">Category</h2>

            <div class="category_menu">
                <ul>
                    <?php while ($roww = $ket_qua->fetch_assoc()) { ?>
                        <li><a href="#" onclick="displayProductsByCate('<?php echo $roww["cate_name"];?>')"><?php echo $roww["cate_name"]?></a></li>
                        <!--                    <li><a href="#" onclick="displayProductsByCate('Macbook')">Macbook</a></li>-->
                        <!--                    <li><a href="#" onclick="displayProductsByCate('Dell')">Dell</a></li>-->
                        <!--                    <li><a href="#" onclick="displayProductsByCate('HP')">HP</a></li>-->
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="computers_section_2">
    <div class="container-fluid">
        <div class="computer_main">
            <div class="row">'
                <?php while ($row = $result->fetch_assoc()) { ?>
                <div class="col-md-4">
                    <div class="computer_img"><img src="./assets/images/<?php echo $row['prd_image']?>"></div>
                        <h4 class="computer_text"><?php echo $row['prd_name']?></h4>
                        <div class="computer_text_main">
                            <h4 class="dell_text"><?php echo $row["cate_name"]?></h4>
                            <h6 class="price_text">$<?php echo $row["prd_price"]?></h6>
                            </div>
                        <div class="cart_bt_1"><a href="javascript:void(0);" onclick="productDetails('<?php echo $row['prd_name']; ?>','<?php echo $row['prd_id']; ?>','<?php echo $row['prd_price']; ?>')">View details</a></div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

</body>


<script>
    function displayProductsByCate($category) {
        // Redirect to product.php and pass the selected category as a parameter
        window.location.href = 'sort_by_cate.php?category=' + encodeURIComponent($category);
    }
    function productDetails($prd_name,$prd_id) {
        window.location.href = 'product.php?prd_name=' + encodeURIComponent($prd_name)+"&prd_id="+encodeURIComponent($prd_id);
    }
</script>

<?php
$conn->close();
include_once ('master/footer.php')
?>

