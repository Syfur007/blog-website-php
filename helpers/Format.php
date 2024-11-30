<?php
class Format{
    public function formaDate($date) {
        return date('F j, Y , g:i a', strtotime($date));
    }

    public function textShroten($text, $limit = 400){
       $text = $text. " ";
       $text = substr($text, 0, $limit);
       $text = $text."......";
       return $text;
    }

    public function validation($data){
        $data = trim($data);
        $data = htmlspecialchars($data);
        $data = stripslashes($data);
        return $data;
    }

    public function title(){
        $path = $_SERVER['SCRIPT_FILENAME'];
        $title = basename($path,  '.php');
        $title = str_replace("_", " ", $title);
        if ($title == 'index') {
           $title = "home";
        }elseif($title == "contact"){
             $title = "contact";
        }
        return $title = ucwords($title);
    }
}