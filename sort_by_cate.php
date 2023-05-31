<?php include_once ('master/header.php');
include_once ('master/database.php');

?>
<div class="category_section layout_padding">
    <div class="container">
        <div class="category_main">
            <h2 class="category_text">Category</h2>

            <div class="category_menu">
                <ul>
                    <li><a href="#" onclick="displayProductsByCate('ASUS')">Asus</a></li>
                    <li><a href="#" onclick="displayProductsByCate('Macbook')">Macbook</a></li>
                    <li><a href="#" onclick="displayProductsByCate('Dell')">Dell</a></li>
                    <li><a href="#" onclick="displayProductsByCate('HP')">HP</a></li>
                </ul>
            </div>
            <script>
                function displayProductsByCate($category) {
                    // Redirect to product.php and pass the selected category as a parameter
                    window.location.href = 'sort_by_cate.php?category=' + encodeURIComponent($category);
                }</script>
            <script>
                function productDetails($prd_name,$prd_id,$prd_price,$prd_quantity = 1) {
                    window.location.href = 'product.php?prd_name=' + encodeURIComponent($prd_name)+"&prd_id="+encodeURIComponent($prd_id)+"&prd_price="+encodeURIComponent($prd_price)+"&quantity="+encodeURIComponent($prd_quantity);
                }
            </script>
        </div>
    </div>
</div>

</body>
<?php
// Retrieve the selected category from the URL parameter
if (isset($_GET['category'])) {
    $category = $_GET['category'];
    $sql = "SELECT *
FROM (
  SELECT p.prd_id, p.prd_name, c.cate_id, c.cate_name, p.prd_price 
  FROM tbl_product p 
  LEFT JOIN tbl_category c ON p.cate_id = c.cate_id
) AS npt
WHERE npt.cate_name = '$category';";
    $result = mysqli_query($conn,$sql);
    if ($result === false) {
        echo "Query failed: " . $conn->error;
    } else {
        echo '<div class="computers_section_2">';
        echo '<div class="container-fluid">';
        echo '<div class="computer_main">';
        echo '<div class="row">';
        while ($row = $result->fetch_assoc()) {

            switch ($row["cate_name"]) {
                case "ASUS":
                    echo '<div class="col-md-12">';
                    echo '<div class="computer_img"><img src="./assets/images/img1.jpg"></div>';
                    break;
                case "Macbook":
                    echo '<div class="col-md-6">';
                    echo '<div class="computer_img"><img src="./assets/images/img2.jpg"></div>';
                    break;
                case "Dell":
                    echo '<div class="col-md-6">';
                    echo '<div class="computer_img"><img src="./assets/images/laptop-dell.jpg"></div>';
                    break;
                case "HP":
                    echo '<div class="col-md-12">';
                    echo '<div class="computer_img"><img src="./assets/images/laptop-hp.jpg"></div>';
                    break;
            }
            echo '<h4 class="computer_text">' . $row["prd_name"] . '</h4>';
            echo '<div class="computer_text_main">';
            echo '<h4 class="dell_text">' . $row["cate_name"] . '</h4>';
            echo '<h6 class="price_text">'."$". $row["prd_price"] . '</h6>';
            echo '</div>';
            echo '<div class="cart_bt_1"><a href="javascript:void(0);" onclick="productDetails(\''.$row['prd_name'].'\',\''.$row['prd_id'].'\',\''.$row['prd_price'].'\')">View details</a></div>';
            echo '</div>';
        }
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
}
$conn->close();
?>



<?php include_once ('master/footer.php')?>
