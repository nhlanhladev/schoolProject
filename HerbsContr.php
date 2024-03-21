<?php
require_once 'Herbs.php';

class HerbController  {
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function getAllHerbs() {
        return $this->model->getAllHerbs();
    }

    public function insertHerb($name, $description) {
                return $this->model->insertHerb($name, $description);
    }

    public function deleteHerb($id) {
               return $this->model->deleteHerb($id);

    }

    // Implement functions for updating herbs

    public function getHouseholdInterests() {
        
             return $this->model->getHouseholdInterests();

    }

    public function insertHouseholdInterest($household, $herbIds) {
               return $this->model->insertHouseholdInterest($household, $herbIds);
    }

    public function deleteHouseholdInterest($id) {
              return $this->model->deleteHouseholdInterest($id);
    }

    // Implement functions for updating household interests

    public function getSummaryOfInterests() {
                return $this->model->getSummaryOfInterests();

    }
}
?>


?>