<?php 
require_once("./Entities/product.class.php");
require_once("./Entities/category.class.php");

if (isset($_POST["btnsubmit"])) {
    //Lấy giá trị từ form collection
    $productName = $_POST["txtName"];
    $cateID = $_POST["txtCateID"];
    $price = $_POST["txtPrice"];
    $quantity = $_POST["txtQuantity"];
    $description = $_POST["txtDescription"];
    $picture = $_FILES["txtPicture"];
    //Khởi tạo đối tượng product

    $newProduct = new Product($productName, $cateID, $price, $quantity, $description, $picture);

    //lưu csdl
    $result = $newProduct->save();
    if (!$result) {
        # code...
      header("Location:add_product.php?failure");
    } else {
        header("Location:add_product.php?inserted");
    }
}
?>
<?php include_once("header.php") ?>

<?php 
if (isset($_GET["inserted"])) {
    # code...
    echo "<h2> Thêm sản phẩm thành công </h2>";
}
?>

<!--form san pham-->

<form method="post" enctype="multipart/form-data" class="text-center">
    <!--ten sp-->
    <div class="row">
        <div class="lbltitle">
            <label> Tên sản phẩm </label>
        </div>
        <div class="lblinput">
            <input type="text" name="txtName" value="<?php echo isset($_POST["txtName"]) ? $_POST["txtName"] : ""; ?>">
        </div>
    </div>
    <!--mo ta sp-->
    <div class="row">
        <div class="lbltitle">
            <label> Mô tả sản phẩm </label>
        </div>
        <div class="lblinput">
            <input type="text" cols="21" rows="10" name="txtDescription" value="<?php echo isset($_POST["txtDescription"]) ? $_POST["txtDescription"] : ""; ?>">
        </div>
    </div>
    <!--so luong sp-->
    <div class="row">
        <div class="lbltitle">
            <label> số lượng sản phẩm </label>
        </div>
        <div class="lblinput">
            <input type="text" name="txtQuantity" value="<?php echo isset($_POST["txtQuantity"]) ? $_POST["txtQuantity"] : ""; ?>">
        </div>
    </div>
    <!--gia sp-->
    <div class="row">
        <div class="lbltitle">
            <label> Giá sản phẩm </label>
        </div>
        <div class="lblinput">
            <input type="text" name="txtPrice" value="<?php echo isset($_POST["txtPrice"]) ? $_POST["txtPrice"] : ""; ?>">
        </div>
    </div>
    <!--loai sp-->
    <div class="row">
        <div class="lbltitle">
            <label> Loại sản phẩm </label>
        </div>
        <select name="txtCateID">
            <option value="" selected>--Chọn loại--</option>
            <?php
                $cates = Category::list_category();
                foreach ($cates as $item){
                    echo "<option value=".$item["CateID"].">".$item["CategoryName"]."</option>";
                }
            ?>
        </select>
    </div>
    <!--hinh anh sp-->
    <div class="row">
        <div class="lbltitle">
            <label> Hình ảnh sản phẩm </label>
        </div>
        <div class="lblinput">
            <input type="file" id="txtPicture" name="txtPicture" accept=".PNG,.GTF,.JPG">
        </div>    
    </div>
    <br>
    <!--submit-->
    <div class="row">
        <div class="submit">
            <input class="btn btn-primary" type="submit" name="btnsubmit" value="Thêm sản phẩm">
        </div>
    </div>
</form>
<?php include_once("footer.php") ?> 