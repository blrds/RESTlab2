<?php
    class CategoryProduct{
        private $conn;
        private $products_table_name="products";
        private $category_table_name="categories";

        public $id;
        public $product_code;
        public $product_name;
        public $description;
        public $standard_cost;
        public $category;

        public function __construct($db, $category){
            $this->conn=$db;
            $this->category=$category;
        }
       
        function read(){
            $query = "SELECT id, product_code, product_name, description, standard_cost, category 
                        FROM ".$this->products_table_name."
                        WHERE category=".$this->category."
                        ORDER BY product_name";
            $stmt=$this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }
    }
?>