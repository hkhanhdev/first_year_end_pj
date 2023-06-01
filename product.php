<?php include_once ('master/header.php');
include_once ('master/database.php'); ?>

<?php
$prd_name = $_GET['prd_name'];
$prd_id = $_GET['prd_id'];
$sql = "select p.prd_id,p.prd_name,p.prd_price,p.prd_image,c.cate_id,c.cate_name from tbl_product p left join tbl_category c on p.cate_id = c.cate_id where prd_id = $prd_id;";
$result = mysqli_query($conn,$sql);
$row = $result->fetch_assoc();

$conn->close();
?>

<div class="computers_section_2">
    <div class="container-fluid">
        <div class="computer_main">
            <div class="row">
                <div class="col-md-12">
                    <div class="computer_img"><img src="./assets/images/<?php echo $row['prd_image']?>"></div>
                    <h4 class="computer_text"><?php echo $row['prd_name']?></h4>
                    <div class="computer_text_main">
                        <h4 class="dell_text"><?php echo $row['cate_name'] ?></h4>
                        <div class="quantity-section">
                            <div class="quantity-input">
                                <button id="decrease-btn">-</button>
                                <input type="number" id="quantity" value="1" min="1">
                                <button id="increase-btn">+</button>
                            </div>
                        </div>
                        <h6 class="price_text" id="price">$<?php echo $row['prd_price']?></h6>

                    </div>

                    <div class="cart_bt_1"><a href="javascript:void(0);" onclick="addToCart('<?php echo $row['prd_name']; ?>','<?php echo $row['prd_id']; ?>','<?php echo $row['prd_price']; ?>')">Add To Cart</a></div>
                </div>

            </div>
        </div>
    </div>
</div>
<script>
    const decreaseBtn = document.getElementById("decrease-btn");
    const increaseBtn = document.getElementById("increase-btn");
    const quantityInput = document.getElementById("quantity");
    const priceElement = document.getElementById("price");
    const priceText = priceElement.textContent;
    const price = parseInt(priceText.substring(1));

    decreaseBtn.addEventListener("click", () => {
        if (quantityInput.value > 1) {
            quantityInput.value = parseInt(quantityInput.value) - 1;
            updateTotalPrice();
        }
    });

    increaseBtn.addEventListener("click", () => {
        quantityInput.value = parseInt(quantityInput.value) + 1;
        updateTotalPrice();
    });
    function updateTotalPrice() {
        const quantity = parseInt(quantityInput.value);
        const updatedPrice = price*quantity;
        priceElement.textContent = "$" + updatedPrice;
    }

</script>







<?php include_once ('master/footer.php')?>
