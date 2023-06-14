<?php include_once ('master/header.php');
include_once ('master/database.php'); ?>

<?php
$prd_name = $_GET['prd_name'];
$prd_id = $_GET['prd_id'];
$sql = "select p.prd_id,p.prd_name,p.prd_price,p.prd_image,c.cate_id,c.cate_name from tbl_product p left join tbl_category c on p.cate_id = c.cate_id where prd_id = $prd_id;";
$result = mysqli_query($conn,$sql);
$row = $result->fetch_assoc();


?>

<div class="computers_section_2">
    <div class="container-fluid">
        <div class="computer_main">
            <div class="row">
                <div class="col-md-6">
                    <div class="computer_img"><img src="./assets/images/<?php echo $row['prd_image']?>"></div>
                    <h4 class="computer_text" id="prd_name"><?php echo $row['prd_name']?></h4>
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

                    <div class="cart_bt_1"><button type="submit" onclick="addToCart('<?php echo $row['prd_name']; ?>','<?php echo $prd_id; ?>')">Add To Cart</button></div>
                </div>

                <div class="col-md-6">
                    <h1>Chi tiet san pham</h1>
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
    function addToCart(productName, productId) {
        var total_price = document.getElementById('price').textContent.replace('$', '');
        var quantity = document.getElementById('quantity').value;

        // Create a form object
        var form = document.createElement('form');
        form.method = 'POST';
        form.action = 'cart.php';

        // Create hidden input fields for each data parameter
        var prdNameInput = document.createElement('input');
        prdNameInput.type = 'hidden';
        prdNameInput.name = 'prd_name';
        prdNameInput.value = productName;
        form.appendChild(prdNameInput);

        var prdIdInput = document.createElement('input');
        prdIdInput.type = 'hidden';
        prdIdInput.name = 'prd_id';
        prdIdInput.value = productId;
        form.appendChild(prdIdInput);

        var totalPriceInput = document.createElement('input');
        totalPriceInput.type = 'hidden';
        totalPriceInput.name = 'total_price';
        totalPriceInput.value = total_price;
        form.appendChild(totalPriceInput);

        var quantityInput = document.createElement('input');
        quantityInput.type = 'hidden';
        quantityInput.name = 'quantity';
        quantityInput.value = quantity;
        form.appendChild(quantityInput);

        // Append the form to the body and submit it
        document.body.appendChild(form);
        form.submit();
    }

</script>


<?php
$conn->close();
include_once ('master/footer.php')?>
