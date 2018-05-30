<?php


    $files = [];
    foreach($_FILES['images']['error'] as $key => $value){
        if($_FILES['images']['error'][$key] == UPLOAD_ERR_OK){
            $temp = $_FILES['images']['tmp_name'][$key];
            $type = array_reverse(explode('/',$_FILES['images']['type'][$key]))[0];
            $name = 1;


            foreach(glob('../images/category/'.$_POST['category'].'/'.$_POST['file'].'/*') as $fileName){
                $data = array_reverse(mb_split('/',$fileName))[0];
                $name = max(explode('.',$data),$name);
            }
            $file = '../images/category/'.$_POST['category'].'/'.$_POST['file'].'/'.($name[0]+1).'.'.$type;

            move_uploaded_file($temp,$file);


            $img = getimagesize($file);
            $height = $img[1] / ($img[0]/340);

            array_push($files,['url'=>$file,'height'=>$height]);


        }
    }
    echo json_encode($files);
?>
