<?php
/**
 * Created by PhpStorm.
 * User: popkaEshy
 * Date: 07.02.2019
 * Time: 21:37
 */

namespace Alexandr\Animator\Base;

class UploadBra
{
    protected $name;
    protected $names;
    protected $tmp_name;
    protected $tmp_names;
    protected $type_file;
    protected $type_files;
    protected $file_size;
    protected $file_sizes;
    protected $string_to_search;
    protected $regex;
    protected $num_matches;

    public function __construct()
    {
        $this->name = $_FILES['photo']['name'];
        $this->tmp_name = $_FILES['photo']['tmp_name'];
        $this->file_size = $_FILES['photo']['size'];
        $this->type_file = $_FILES['photo']['type'];
        $this->names = $_FILES['photos']['name'];
        $this->tmp_names = $_FILES['photos']['tmp_name'];
        $this->file_sizes = $_FILES['photos']['size'];
        $this->type_files = $_FILES['photos']['type'];
    }


    public function upload_image($path)
    {
        for ($i = 0; $i < count($this->tmp_name); $i++) {
            $string_to_search = $this->type_file[$i];
            $regex = "/image/";
            $num_matches = preg_match($regex, $string_to_search);
            $name = md5(uniqid());
            $ext = explode('.',$this->name[$i]);
            $ext = $ext[count($ext)-1];
            $names[]=$name.'.'.$ext;
            if ($num_matches > 0) {
                if ($this->file_size[$i] < 1048576) {
                    move_uploaded_file($this->tmp_name[$i], "$path/$name.$ext");
                    return $names;
                } else {
                        $fail = 'файл ' . $this->name[$i] . ' слишком большой и не будет загружен' . '<br>';
                        return 'toobig';
                }

            } else {
               return false;
            }
        }

    }

    public function upload_images($path,$characterName,$countMultiPhoto=0)
    {
        $count = $countMultiPhoto;
        for ($i=0; $i < count($this->tmp_names); $i++) {
            $string_to_search = $this->type_files[$i];
            $regex = "/image/";
            $num_matches = preg_match($regex, $string_to_search);
            $characterName=str_replace(' ','_',$characterName);
            $count++;
            $name = $characterName.$count;
            $ext = explode('.',$this->names[$i]);
            $ext = $ext[count($ext)-1];
            $namesfoto[]=$name.'.'.$ext;
            if ($num_matches > 0) {
                if ($this->file_size[$i] < 1048576) {
                    move_uploaded_file($this->tmp_names[$i], "$path/$name.$ext");

                } else {
                    $fail = 'файл ' . $this->names[$i] . ' слишком большой и не будет загружен' . '<br>';
                    return 'toobig';
                }

            } else {
                return false;
            }
        }
        return $namesfoto;
    }

}
