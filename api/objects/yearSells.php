<?php
    class YearSells{
        private $conn;
        private $products_table_name="products";
        private $orderDetails_table_name="order_details";
        private $orders_table_name="orders";

        public $order_date;
        public $id;
        public $product_code;
        public $product_name;
        public $category;
        public $quantiny;
        
        public $year;

        public function __construct($db, $product, $year){
            $this->conn=$db;
            $this->product_name=$product;
            $this->year=$year;
        }
       
        function read(){
            $where=" ";
            if($this->product_name!=""){
                $where="WHERE products.product_name=".$this->product_name;
                if($this->year!=0)$where=$where." AND";
            }
            if($this->year!=0){
                if($this->product_name=="")$where=" WHERE ";
                $where=$where." year(order_date)=".$this->year;
            }
            $query = "SELECT month(order_date), products.id, product_code, product_name, category, quantity 
                        FROM ".$this->products_table_name."
                        JOIN ".$this->orderDetails_table_name."
                        ON ".$this->products_table_name.".id=".$this->orderDetails_table_name.".product_id
                        JOIN ".$this->orders_table_name."
                        ON ".$this->orderDetails_table_name.".order_id=".$this->orders_table_name.".id
                        ".$where." 
                        ORDER BY month(order_date)";
           $stmt=$this->conn->prepare($query);

            $stmt->execute();
            
            return $stmt;
        }
    }
?>