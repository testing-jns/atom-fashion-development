<?php


class Students {
//    private array $students_file_contents;
//    private array $students_directory;
//    private array $students_presence_and_directory;
//    private array $students_data;

    private $students_file_contents;
    private $students_directory;
    private $students_presence_and_directory;
    private $students_data = [];



    public function __construct() {
        $students_json_file = file_get_contents(PATH_SIJA_STUDENTS_JSON);
        $this->students_file_contents = json_decode($students_json_file, true);
    }

    private function getStudentsDir() : void {
        $root_directory = scandir(ROOT_DIR);
        $this->students_directory = array_filter($root_directory, function($content)  {
            if (is_dir(ROOT_DIR . $content)) return true;
        });
    }

    private function getPresenceFromDir() : void {
        $this->students_presence_and_directory = array_map(function(string $student_dir) {
            $presence = explode("_", $student_dir)[0];
            return [
                "presence" => $presence,
                "directory" => $student_dir
            ];
        }, $this->students_directory);
    }

    private function rebuildPersonalStudentsData(array $student_info, int &$directories_detected) : array {
        $rebuild_student_info = [];
        foreach ($this->students_presence_and_directory as $students_pres_dir) {
            if ($student_info["presence"] !== $students_pres_dir["presence"]) {
                $rebuild_student_info = $student_info;
                continue;
            }
            
            $rebuild_student_info = array_merge($student_info, $students_pres_dir);
            $rebuild_student_info["web_link"] = BASE_URL . $students_pres_dir["directory"];
            $directories_detected++;
            break;
        }

        return $rebuild_student_info;
    }

    private function rebuildStudentsData() : void {
        $this->students_data["meta"] = $this->students_file_contents["meta"];

        $directories_detected = 0;
        $this->students_data["sija_students"] = array_map(function(array $student_info) use(&$directories_detected) {
            return $this->rebuildPersonalStudentsData($student_info, $directories_detected);
        }, $this->students_file_contents["students"]);

        $this->students_data["students_length"] = $this->students_file_contents["students_length"];
        $this->students_data["directories_detected"] = $directories_detected;
    }

    public function getStudents() : array {
        $this->getStudentsDir();
        $this->getPresenceFromDir();
        $this->rebuildStudentsData();
        return $this->students_data;
    }
}

