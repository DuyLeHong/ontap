<?php 
    class SanPham {

        public $id;
        public $name;
        public $loaisp;
        public $imgUrl;
        public $price;

        public function __construct($id, $name, $loaisp, $imgUrl, $price) {
            $this->id = $id;
            $this->name = $name;
            $this->loaisp = $loaisp;
            $this->imgUrl = $imgUrl;
            $this->price = $price;
        }
    }
?>