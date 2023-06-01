<?php include_once('master/header.php') ;
include_once ('master/database.php');
?>

<?php


?>

<div class="category_section layout_padding">
    <div class="container">
        <div class="category_main">
            <h2 class="category_text">Category</h2>

            <div class="category_menu">
                <ul>
                    <li><a href="#" onclick="displayProductsByCate('Asus')">Asus</a></li>
                    <li><a href="#" onclick="displayProductsByCate('Macbook')">Macbook</a></li>
                    <li><a href="#" onclick="displayProductsByCate('Dell')">Dell</a></li>
                    <li><a href="#" onclick="displayProductsByCate('HP')">HP</a></li>
                </ul>
            </div>
            <script>
                function displayProductsByCate(category) {
                    // Redirect to product.php and pass the selected category as a parameter
                    window.location.href = 'sort_by_cate.php?category=' + encodeURIComponent(category);
                }</script>
            <script>
                function productDetails($prd_name,$prd_id) {
                    window.location.href = 'product.php?prd_name=' + encodeURIComponent($prd_name)+"&prd_id="+encodeURIComponent($prd_id);
                }
            </script>

        </div>
    </div>
</div>

<div class="computers_section_2">
    <div class="container-fluid">
        <div class="computer_main">
            <div class="row">
                <div class="col-md-4">
                    <div class="computer_img"><img src="./assets/images/img2.jpg"></div>
                    <h4 class="computer_text">Macbook Air 2022 13.6 inch Apple M2 – 16GB RAM 512GB SSD</h4>
                    <div class="computer_text_main">
                        <h4 class="dell_text">Macbook</h4>
                        <h6 class="price_text">$700</h6>

                    </div>
                    <div class="cart_bt_1"><a href="#">Add To Cart</a></div>
                </div>
                <div class="col-md-4">
                    <div class="computer_img"><img src="./assets/images/img1.jpg"></div>
                    <h4 class="computer_text">Laptop Asus Vivobook M1403QA-LY022W R5 5600H/8GB/512GB</h4>
                    <div class="computer_text_main">
                        <h4 class="dell_text">Asus</h4>
                        <h6 class="price_text">$500</h6>

                    </div>
                    <div class="cart_bt_1"><a href="#">Add To Cart</a></div>
                </div>
                <div class="col-md-4">
                    <div class="computer_img"><img src="./assets/images/laptop-dell.jpg"></div>
                    <h4 class="computer_text">Dell XPS 13 Plus 9320 (2022) - I7/32GB/1TB/UHD 4K Touch</h4>
                    <div class="computer_text_main">
                        <h4 class="dell_text">Dell</h4>
                        <h6 class="price_text">$550</h6>

                    </div>
                    <div class="cart_bt_1"><a href="#">Add To Cart</a></div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="computers_section_2">
    <div class="container-fluid">
        <div class="computer_main">
            <div class="row">
                <div class="col-md-4">
                    <div class="computer_img"><img src="./assets/images/laptop-hp.jpg"></div>
                    <h4 class="computer_text">Laptop HP Pavilion 15 eg2062TU i3 1215U/8GB/256GB</h4>
                    <div class="computer_text_main">
                        <h4 class="dell_text">HP</h4>
                        <h6 class="price_text">$600</h6>

                    </div>
                    <div class="cart_bt_1"><a href="#">Add To Cart</a></div>
                </div>
                <div class="col-md-4">
                    <div class="computer_img"><img src="./assets/images/macbook.jpg"></div>
                    <h4 class="computer_text">Macbook Air 2020 i3 8GB 256GB | MWTJ2/ MWTL2/ MWTK2</h4>
                    <div class="computer_text_main">
                        <h4 class="dell_text">Apple</h4>
                        <h6 class="price_text">$1900</h6>

                    </div>
                    <div class="cart_bt_1"><a href="#">Add To Cart</a></div>
                </div>
                <div class="col-md-4">
                    <div class="computer_img"><img src="./assets/images/laptop-dell2.jpeg"></div>
                    <h4 class="computer_text">Laptop Dell Latitude 7390 2in1</h4>
                    <div class="computer_text_main">
                        <h4 class="dell_text">Dell</h4>
                        <h6 class="price_text">$4500</h6>

                    </div>
                    <div class="cart_bt_1"><a href="#">Add To Cart</a></div>
                </div>
            </div>
        </div>
    </div>
</div>





<?php include_once('master/footer.php') ;?>


