<?php 

require_once PATH_APP . "models/Products.model.php";

class AddProducts extends Products {
    public function __construct() {
        parent::__construct();
        $this->on_action = "add product";
    }
    private function insert_thumbnails(string $thumbnail_id) : bool {
        $total_files = count($_FILES["files"]["tmp_name"]);

        $success_insert_blobs = array_filter($_FILES["files"]["tmp_name"] , function($value) use($thumbnail_id) {
            $image_name = custom_random(28) . ".png";
            $image_path = PATH_APP . "../public/assets/img/products/";
            move_uploaded_file($value, $image_path . $image_name);

            $sql = "INSERT INTO thumbnails VALUES (:id, :image)";
            $payloads = [
                ":id" => $thumbnail_id,
                ":image" => $image_name
            ];
            $success = $this->db->query($sql)->bindValue($payloads)->execute()->status();

            return boolval($success);
        });

        return $total_files === count($success_insert_blobs);
    }

    public function execute() {
        $sql = "INSERT INTO products (code, `name`, category, for_gender, price, discount, max_purchase, stock, sold, `description`, tags, rating, thumbnail_id) VALUES (:code, :name, :category, :for_gender, :price, :discount, :max_purchase, :stock, :sold, :description, :tags, :rating, :thumbnail_id)";

        $bind_values = [];
        foreach ($_POST as $key => $value) {
            $bind_values[":{$key}"] = $value;
        }
        
        $thumbnail_id = "THUMB_" . strtoupper(custom_random(12));
        $bind_values[":thumbnail_id"] = $thumbnail_id;

        $product_status = $this->db->query($sql)->bindValue($bind_values)->execute()->rowCount();
        $thumbnails_status = $this->insert_thumbnails($thumbnail_id);

        $this->query_status = $product_status && $thumbnails_status;
        return $this;
    }
    

}