<?php
        function delete_folder($folder_path){
            if(file_exists($folder_path)){
            $fp = opendir($folder_path);
            if ( $fp ) {
                    while ($f = readdir($fp)) {
                            $file = $folder_path . "/" . $f;
                            if ($f == "." || $f == "..") {
                                    continue;
                            }
                            else if (is_dir($file) && !is_link($file)) {
                                    delete_folder($file);
                            }
                            else {
                                    unlink($file);
                            }
                    }
                    closedir($fp);
                    rmdir($folder_path);
            }
            }            
        }
        
    	function create_folder($folder_path,$permission=0777,$opt=true)
    	{
    		if(!file_exists($folder_path)) {
    				if(@mkdir($folder_path,$permission,$opt)) {
    				 return true;   
    					
    				}else{
    				    return false;
    				}	    	
        	}else{
        	   return true;
        	}		
    	}
        
        function save_file($filename,$data,$flags = null){
            if(!$flags){
                $flags = 0;
            }
            @file_put_contents($filename,$data,$flags);
        }
        
        $folder_name = 'code';
        
        delete_folder($folder_name);
        create_folder($folder_name);
        
        for($i=1;$i<100;$i++){
            unset($new_file);
            $new_file = $folder_name.'/'.$i;
            create_folder($new_file);
            save_file($new_file.'/'.md5($i).'.txt',rand(1,9999999999999));
        }
                        	
?>