<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Thanh toán đơn hàng</title>
    <link rel="stylesheet" href="assets/css/style_payment_page.css">

</head>
<body>

<div class="container">

    <form action="">

        <div class="row">

            <div class="col">

                <h3 class="title">Thông tin thanh toán</h3>

                <div class="inputBox">
                    <span>Full name :</span>
                    <input type="text" placeholder="full name">
                </div>
                <div class="inputBox">
                    <span>E-mail :</span>
                    <input type="email" placeholder="vidu@gmail.com">
                </div>
                <div class="inputBox">
                    <span>Địa chỉ :</span>
                    <input type="text" placeholder="Tỉnh/Thành phố-Quân/huyện-Phường">
                </div>
                <div class="inputBox">
                    <span>Zip code :</span>
                    <input type="text" placeholder="000084">
                </div>
                <div class="inputBox">
                    <span>Số tiền thanh toán :</span>
                    $<input type="text" placeholder="500">
                </div>
                
                    
            </div>

            <div class="col">

                <h3 class="title">Hình thức thanh toán</h3>

                <div class="inputBox">
                    <span>Các loại thẻ :</span>
                    <img src="assets/images/card_img.png" alt="">
                </div>
                <div class="inputBox">
                    <span>Tên trên thẻ :</span>
                    <input type="text" placeholder="Tên trên thẻ">
                </div>
                <div class="inputBox">
                    <span>Số thẻ :</span>
                    <input type="text" placeholder="1111-2222-3333-4444">
                </div>
                <div class="inputBox">
                    <span>Ngày hết hạn :</span>
                    <input type="text" placeholder="D/M/Y">
                </div>

                <div class="flex">
                    <div class="inputBox">
                        <span>CVC :</span>
                        <input type="text" placeholder="1234">
                    </div>
                </div>

            </div>
    
        </div>

        <input type="submit" value="Tiến hành thanh toán" class="submit-btn">

    </form>

</div>    
    
</body>
</html>

<?php include_once ('master/footer.php')?>