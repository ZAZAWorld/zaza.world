<?php
class ModelSnipet {

    static function getUrlParams ($params) {
        $res = array();
        $get = $_GET;
        if (isset($get['page']))
            unset($get['page']);

        foreach ($params as $param_key=>$param_val) {
            if (isset($get[$param_key])) {
                unset($get[$param_key]);
            }
            $res[] = $param_key.'='.$param_val;
        }

        foreach ($get as $param_key=>$param_val){
            $res[] = $param_key.'='.$param_val;
        }

        $res = implode("&", $res);
        $res = '?'.$res;

        return $res;
    }

    static function formatDate ($val, $format) {
        $val = strtotime($val);
		if ($val!=null)
			$val = date($format, $val);
		return $val;
    }

    static function getImage($image_path) {
        //echo '/upload\/'.$image_path; exit();
        if (!file_exists('upload/'.$image_path)) {
            return '/upload/product.png';
        }


        return '/upload/'.$image_path;
    }

    static function getCssImage($image_path) {
        //echo '/upload\/'.$image_path; exit();
        if (!file_exists('upload/'.$image_path)) {
            return '/upload/product.png';
        }


        return 'upload/'.$image_path;
    }

    public static function translitString ($string) {
		$ar = array('А'=>'A','Б'=>'B','В'=>'V','Г'=>'G','Д'=>'D','Е'=>'E','Ё'=>'YO','Ж'=>'ZH','З'=>'Z','И'=>'I','Й'=>'J','К'=>'K',
										'Л'=>'L','М'=>'M','М'=>'N','О'=>'O','П'=>'P','Р'=>'R','С'=>'S','Т'=>'T','У'=>'U','Ф'=>'F','Х'=>'H','Ц'=>'C','Ч'=>'CH',
										'Ш'=>'SH','Щ'=>'CSH','Ь'=>'','Ы'=>'Y','Ъ'=>'','Э'=>'E','Ю'=>'YU','Я'=>'YA','а'=>'a','б'=>'b','в'=>'v','г'=>'g',
										'д'=>'d','е'=>'e','ё'=>'yo','ж'=>'zh','з'=>'z','и'=>'i','й'=>'j','к'=>'k','л'=>'l','м'=>'m','н'=>'n','о'=>'o',
										'п'=>'p','р'=>'r','с'=>'s','т'=>'t','у'=>'u','ф'=>'f','х'=>'h','ц'=>'c','ч'=>'ch','ш'=>'sh','щ'=>'csh','ь'=>'',
										'ы'=>'y','ъ'=>'','э'=>'e','ю'=>'yu','я'=>'ya',' '=>'-','&'=>'','='=>'','/'=>'-','\"'=>'','?'=>'');

		return str_replace(array_keys($ar),array_values($ar), $string);
	}

	public static function setImage ($file, $path = 'images', $image_type = false) { // функция по до
		

		if (!$file->isValid())
			return false;
		
        $path = 'upload/'.$path;

        //$real_path =

		$file_extension = $file->getClientOriginalExtension();

		$file_name = $file->getClientOriginalName();
		$file_name = pathinfo($file_name, PATHINFO_FILENAME);
		$file_name = static::translitString($file_name);

		$new_file = time().'_'.$file_name.'_crop.'.$file_extension;
		$file_name = time().'_'.$file_name.'.'.$file_extension;

		$file->move($path, $file_name);

		if ($image_type == 'large'){ // big image
			$new_file  = $file_name;
		}
		else if ($image_type == 'small'){
            $img = Image::make(public_path().'/'.$path.'/'.$file_name);

            $img = Image::make($file->getRealPath());
            $img->resize(150, 200);
            $img->save();

            $new_file  = $file_name;
		}
		else if ($image_type == 'file'){
           
            $new_file  = $file_name;
		}
		else { // normal image
            $img = Image::make(public_path().'/'.$path.'/'.$file_name);
            $img->resize(800, null, function ($constraint) {
				$constraint->aspectRatio();
				$constraint->upsize();
			});
            $img->save();

            $new_file  = $file_name;
		}

		$file_name = $new_file;

		return  '/'.$path.'/'.$file_name;
	}

	static function image_resize($source_path, $destination_path, $newwidth, $newheight = FALSE, $quality = true ) {
		ini_set("gd.jpeg_ignore_warning", 1); // иначе на некотоых jpeg-файлах не работает

		list($oldwidth, $oldheight, $type) = getimagesize($source_path);

		switch ($type) {
			case IMAGETYPE_JPEG: $typestr = 'jpeg'; break;
			case IMAGETYPE_GIF: $typestr = 'gif' ;break;
			case IMAGETYPE_PNG: $typestr = 'png'; break;
		}

		// анимация
		if($type == 1){
			$images = new Imagick($source_path);
			if($images->getNumberImages() > 1){
				$images = $images->coalesceImages();
				$oldwidth  = $images->getImageWidth();
				$oldheight = $images->getImageHeight();

				if (!$newheight) { $newheight = round($newwidth * $oldheight/$oldwidth); }
				elseif (!$newwidth) { $newwidth = round($newheight * $oldwidth/$oldheight); }

				do {
					$images->scaleImage($newwidth, $newheight);
				} while ($images->nextImage());
				$images = $images->deconstructImages();
				$images->writeImages($destination_path, true);

				return;
			}
		}

		$function = "imagecreatefrom$typestr";
		$src_resource = $function($source_path);

		if (!$newheight) { $newheight = round($newwidth * $oldheight/$oldwidth); }
		elseif (!$newwidth) { $newwidth = round($newheight * $oldwidth/$oldheight); }
		$destination_resource = imagecreatetruecolor($newwidth,$newheight);

		imagecopyresampled($destination_resource, $src_resource, 0, 0, 0, 0, $newwidth, $newheight, $oldwidth, $oldheight);

		imagegammacorrect($destination_resource, 1, 1.1);

		if ($type == 2) { # jpeg
			imageinterlace($destination_resource, 1);
			imagejpeg($destination_resource, $destination_path, $quality);
		}
		else { # gif, png
			$function = "image$typestr";
			$function($destination_resource, $destination_path);
		}

		imagedestroy($destination_resource);
		imagedestroy($src_resource);
	}
}
