<?php 

use \core\Database;

class Products {
    private $db;
    private $on_action;
    private $response_status_query;

    public function __construct() {
        $this->db = new Database();
    }

    private function insert_thumbnails(string $thumbnail_id) : bool {
        $total_files = count($_FILES["files"]["tmp_name"]);

        $success_insert_blobs = array_filter($_FILES["files"]["tmp_name"] , function($value) use($thumbnail_id) {
            $binary_file = file_get_contents($value);
            $sql = "INSERT INTO thumbnails VALUES (:id, :image)";
            $payloads = [
                ":id" => $thumbnail_id,
                ":image" => $binary_file
            ];
            $success = $this->db->query($sql)->bindValue($payloads)->execute()->rowCount();

            return boolval($success);
        });

        return $total_files === count($success_insert_blobs);
    }

    private function insert() {
        $sql = "INSERT INTO products (code, `name`, category, for_gender, price, discount, max_purchase, stock, sold, `description`, tags, rating, thumbnail_id) VALUES (:code, :name, :category, :for_gender, :price, :discount, :max_purchase, :stock, :sold, :description, :tags, :rating, :thumbnail_id)";

        $bind_values = [];
        foreach ($_POST as $key => $value) {
            $bind_values[":{$key}"] = $value;
        }
        
        $thumbnail_id = "THUMB_" . strtoupper(custom_random(12));
        $bind_values[":thumbnail_id"] = $thumbnail_id;

        $product_status = $this->db->query($sql)->bindValue($bind_values)->execute()->rowCount();
        $thumbnails_status = $this->insert_thumbnails($thumbnail_id);

        $this->response_status_query = $product_status && $thumbnails_status;
        return $this;
    }

    public function action(string $action) : object {
        $this->on_action = $action;
        $this->$action();
        return $this;
    }

    public function json() : string {
        $responses = [
            "meta" => [
                "action" => $this->on_action
            ],
            "result" => [
                "success" => $this->response_status_query
            ]
        ];

        return json_encode($responses);
    }


}

