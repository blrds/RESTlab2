<?php
    class ProductSells{
        private $conn;
        private $products_table_name="products";
        private $orderDetails_table_name="order_details";
        private $orders_table_name="orders";

        public $id;
        public $product_code;
        public $product_name;
        public $category;
        public $order_date;

        public function __construct($db, $product){
            $this->conn=$db;
            $this->product_name=$product;
        }
       
        function read(){
            $where=" ";
            if($this->product_name!="")$where="WHERE products.product_name=".$this->product_name;
            $query = "SELECT products.id, product_code, product_name, category, order_date 
                        FROM ".$this->products_table_name."
                        JOIN ".$this->orderDetails_table_name."
                        ON ".$this->products_table_name.".id=".$this->orderDetails_table_name.".product_id
                        JOIN ".$this->orders_table_name."
                        ON ".$this->orderDetails_table_name.".order_id=".$this->orders_table_name.".id
                        ".$where." 
                        ORDER BY product_name";
            $stmt=$this->conn->prepare($query);

            $stmt->execute();
            
            return $stmt;
        }
    }
?>