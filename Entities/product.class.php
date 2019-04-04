<?php 
    require_once("./config/db.class.php");

    class Product{
        public $productID;
        public $productName;
        public $cateID;
        public $price;
        public $quantity;
        public $description;
        public $picture;

        public function __construct($productName, $cateID, $price, $quantity, $description, $picture)
        {
            # code...
            $this->productName = $productName;
            $this->cateID = $cateID;
            $this->price = $price;
            $this->quantity = $quantity;
            $this->description = $description;
            $this->picture = $picture;
        }

        //lưu sp
        public function save()
        {
            $file_temp = $this->picture['tmp_name'];
            $user_file = $this->picture['name'];
            $timestamp = date("Y").date("m").date("d").date("h").date("i").date("s");
            $filepath = "./images/".$timestamp.$user_file;
            if(move_uploaded_file($file_temp, $filepath)==false)
            {
               // echo($filepath);
                return false;
            }
            else{
               // echo("aaaaaaaaaaaaaaaaaaaaaa");
            }
            
            # code...
            $db = new Db();
            //Thêm product vào csdl
            $sql = "INSERT INTO `product` (`ProductName` , `CateID` , `Price` , `Quantity` , `Description` , `Picture` )
                    VALUES ( '$this->productName', '$this->cateID', '$this->price', '$this->quantity', '$this->description', '$filepath')";
            
            $result = $db->query_execute($sql);
			//echo($result);

            return $result;
        }

        public static function list_product(){
            $db = new Db();
            $sql = "SELECT * FROM product";
            $result = $db->select_to_array($sql);
            return $result;
        }
    
		public static function list_product_by_cateid($cateid)
		{
			$db =new db();
			$sql="SELECT * FROM product WHERE CateID='$cateid' ";
			$result = $db->select_to_array($sql);
			return $result;
			
		}
		//lấy danh sách sản phẩm cùng loại
		public static function list_product_relate($cateid , $id)
		{
			$db =new db();
			$sql="SELECT * FROM product WHERE CateID='$cateid' AND productID!='$id'";
			$result = $db->select_to_array($sql);
			return $result;
		}
		public static function get_product($id)
		{
			$db =new db();
			$sql="SELECT * FROM product WHERE productID='$id'";
			$result = $db->select_to_array($sql);
			return $result;
		}
	}
?>
