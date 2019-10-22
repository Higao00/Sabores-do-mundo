<?php 
	class Upload{
        var $tipo;
        var $nome;
        var $tamanho;
         
        function Upload(){
        //Criando objeto
        }
         
        function UploadArquivo($arquivo, $pasta){ 
            if(isset($arquivo)){
                $nomeOriginal = $arquivo["name"]; 
                $tamanho = $arquivo["size"];
                 
                if (move_uploaded_file($arquivo["tmp_name"], $pasta . $nomeOriginal)){ 

                    $this->nome=$pasta . $nomeOriginal;
                    $this->tamanho=number_format($arquivo["size"]/1024, 2) . "KB";
                    return true; 
                }else{ 
                    return false;
                } 
            }
        } 
    }

    class Image{
    	/**
    	 * @param string form_field - The HTML form field name to check
    	 * @param string upload_path - Image uploading path
    	 * @param string image_name - Name for the saving image file
    	 * @param string width - width for the resizing image
    	 * @param string height - height for the resizing image
    	 */
    	function upload_image($form_field, $upload_path, $image_name, $width, $height)
    	{
    		//image upload
    		if(isset($_FILES[$form_field]))
    		{
    			//get uploading file's extention
    			$extention=strtolower($_FILES[$form_field]["type"]);
    			
    			$exp_del = "."; //end delimiter
    			$file_name = $_FILES[$form_field]["name"];
    			$file_name = explode($exp_del, $file_name);
    			$extention = strtolower(end($file_name));
    			
    			//validate uploading file
    			$validate=$this->validate_uploading_file($form_field, $extention);
    			
    			if($validate)
    			{
    				//build path if does not exists
    				if(!is_dir($upload_path)){ mkdir($upload_path, 0755); }
    				
    				//here you can use two types of methods to resize image
    				//first one is resize image to the aspect ratio
    				//second one is crop image to the provided width and height
    				//you can use one of the following two methods to perform above operations
    				
    				//resize image and save
    				$this->create_thumb($_FILES[$form_field]["tmp_name"], $upload_path.$image_name, $width, $height, $extention);
    				
    				return true;
    			}
    			else
    			{
    				return false;
    			}
    		}
    		else
    		{
    			return false;
    		}
    	}
    	
    	/**
    	 * @param string path_to_image - Path for the source image
    	 * @param string path_to_thumb - Path for the saving image
    	 * @param string thumb_width - New width for the saving image
    	 * @param string thumb_height - New height for the saving image
    	 * @param string extension - image file's extension
    	 */
    	function create_thumb($path_to_image, $path_to_thumb, $thumb_width, $thumb_height, $extention)
    	{
    		$thumb_width=intval($thumb_width);
    		$thumb_height=intval($thumb_height);
    		
    		$x1_source=0;
    		$y1_source=0;
    		
    		//get uploading image's width and height
    		list($width, $height, $img) = $this->get_image_width_height($extention, $path_to_image);
    		
    		//resize image for the aspect ratio
    		if($width > $height)
    		{
    			if($thumb_height>$thumb_width)
    			{
    				$new_width=$width;
    				$new_height=floor($new_width*($thumb_height/$thumb_width));
    				
    				$y1_source=floor(($height-$new_height)/2);
    			}
    			else
    			{
    				$new_height=$height;
    				$new_width=floor($new_height*($thumb_width/$thumb_height));
    				
    				$x1_source=floor(($width-$new_width)/2);
    			}
    		}
    		else
    		{
    			if($thumb_height>$thumb_width)
    			{
    				$new_height=$height;
    				$new_width=floor($new_height*($thumb_width/$thumb_height));
    				
    				$x1_source=floor(($width-$new_width)/2);
    			}
    			else
    			{
    				$new_width=$width;
    				$new_height=floor($new_width*($thumb_height/$thumb_width));
    				
    				$y1_source=floor(($height-$new_height)/2);
    			}
    		}
    		
    		if($thumb_width > $width)
    		{
    			$thumb_width=$width;
    			$new_width=$width;
    			
    			$x1_source=0;
    		}
    		else
    		{
    			$x1_source=floor(($width-$new_width)/2);
    		}
    		
    		if($thumb_height > $height)
    		{
    			$thumb_height=$height;
    			$new_height=$height;
    			
    			$y1_source=0;
    		}
    		else
    		{
    			$y1_source=floor(($height-$new_height)/2);
    		}
    		
    		$tmp_img=$this->create_temp_image($thumb_width, $thumb_height);
    		
    		// copy and resize old image into new image
    		imagecopyresampled($tmp_img, $img, 0, 0, $x1_source, $y1_source, $thumb_width, $thumb_height, $new_width, $new_height);
    		
    		$this->save_image($extention, $path_to_thumb, $tmp_img);
    	}
    	
    	/**
    	 * @param string extension - Width for the temporary image
    	 * @param string height - Height for the temporary image
    	 */
    	function get_image_width_height($extension, $path_to_image)
    	{
    		$extension=strtolower($extension);
    		
    		// load image and get image size
    		if($extension == "jpg" || $extension == "jpeg")
    		{
    			$img = imagecreatefromjpeg($path_to_image);
    		}
    		else if( $extension == "gif")
    		{
    			$img = imagecreatefromgif($path_to_image);
    		}
    		else if( $extension == "png")
    		{
    			$img = imagecreatefrompng($path_to_image);
    		}
    		
    		$width = imagesx($img);
    		$height= imagesy($img);
    		
    		return array($width, $height, $img);
    	}
    	
    	/**
    	 * @param string width - Width for the temporary image
    	 * @param string height - Height for the temporary image
    	 */
    	function create_temp_image($width, $height)
    	{
    		// create a new temporary image
    		$tmp_img = imagecreatetruecolor($width, $height);
    		
    		//making a transparent background for image
    		imagealphablending($tmp_img, false);
    		$color_transparent = imagecolorallocatealpha($tmp_img, 0, 0, 0, 127);
    		imagefill($tmp_img, 0, 0, $color_transparent);
    		imagesavealpha($tmp_img, true);
    		
    		return $tmp_img;
    	}
    	
    	/**
    	 * @param string extension - image file's extension
    	 * @param string path - Path for the image which should be uploaded
    	 * @param string tmp_img - Temporary image which was created using GD libarary
    	 */
    	function save_image($extension, $path, $tmp_img)
    	{
    		$extension=strtolower($extension) ;
    		
    		// save thumbnail into a file
    		if( $extension == "jpg" || $extension == "jpeg" )
    		{
    			imagejpeg( $tmp_img, $path, 100 );
    		}
    		else if( $extension == "gif")
    		{
    			imagegif( $tmp_img, $path, 100 );
    		}
    		else if( $extension == "png")
    		{
    			imagepng( $tmp_img, $path, 9 );
    		}
    	}
    	
    	/**
    	 * @param string $field - The HTML form field name to check.
    	 * @param string extension - image file's extension
    	 */
    	function validate_uploading_file($field, $extension)
    	{
    		//assume uploading file is not a valid image
    		$match_found=false;
    		
    		//set valid file types and extensions for image upload
    		$file_types=array();

    		$file_types[]=array("type" => "image/jpeg", "ext" => "jpg");
    		$file_types[]=array("type" => "image/png", "ext" => "png");
    		$file_types[]=array("type" => "image/jpg", "ext" => "jpg");
    		$file_types[]=array("type" => "image/gif", "ext" => "gif");

    		foreach($file_types as $file_type)
    		{
    			$this_file_type=strtolower($_FILES[$field]["type"]);
    			
    			if($this_file_type == strtolower($file_type["type"]) && $extension == strtolower($file_type["ext"]))
    			{
    				$match_found=true;
    				break;
    			}
    		}
    		
    		return $match_found;
    	}
    	
    	/**
    	 * @param string path_to_image - Path for the source image
    	 */
    	function is_valid_image($path_to_image)
    	{
    		//assume uploading file is not a valid image
    		$valid = false;
    		
    		//check if file exists
    		if(@file_exists($path_to_image))
    		{
    			try{
    				//validate uploading file
    				$image_size = getimagesize($path_to_image);
    				
    				if(isset($image_size[2]) && in_array($image_size[2], array(IMAGETYPE_GIF , IMAGETYPE_JPEG ,IMAGETYPE_PNG , IMAGETYPE_BMP)))
    				{
    					$valid = true;
    				}
    			}
    			catch(Exception $e)
    			{
    			}
    		}
    		
    		return $valid;
    	}
    }

    // $dados = [];

    // $dado['id_user'] = 1665;
    // $dado['titulo'] = 'Testa Final API';
    // $dado['msg'] = 'Esse é o Teste Final';
    // $dado['icon'] = 'https://immobilebusiness.com.br/home/assets/img/icons/site/favicon.png';
    // $dado['link_red'] = 'https://desenvolvimento.ibsystem.com.br';


    // $dados[] = $dado;

    function envia_notificacao($dados){

    	include "conexao.php";

    	$notificacoes = [];
    	$notifica_linha;

    	foreach ($dados as $key => $value) {
    		if(isset($value['id_user'])){
    			$query = mysqli_query($db, "SELECT `endpoint`, `auth`, `p256dh` FROM `subscribers` WHERE `usuario` = ".$value['id_user']." ")or die(mysqli_error($db));

    			if(mysqli_num_rows($query)){

    				while ($assoc = mysqli_fetch_assoc($query)) {

    					$notifica_linha = null;
    					
    					$notifica_linha['auth'] = $assoc;
    					$notifica_linha['dados'] = $value;

    					$notificacoes[] = $notifica_linha;
    				}
    			}

    		}	
    	}

    	$curl = curl_init();

    	curl_setopt($curl, CURLOPT_URL, 'https://notificacao.ibsystem.com.br/demosite/get_notification.php');
    	curl_setopt($curl,CURLOPT_SSL_VERIFYPEER, false);

    	curl_setopt($curl, CURLOPT_POSTFIELDS, 
    	http_build_query($notificacoes));

    	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    	$result = curl_exec($curl);

    	$aux = curl_getinfo($curl);

    	var_dump($aux);
    	var_dump($result);
    	var_dump(curl_error($curl));

    	curl_close($curl);
    }

    function monta_lista_receita($aux){
        if (count($aux) > 0) {
            foreach ($aux as $key => $value) {
                ?>
                <div class="card" style="margin-top: 45px;">
                    <!-- Card content -->
                    <div class="card-body">
                        <!--Carousel Wrapper-->
                        <div id="carousel-<?php echo($key); ?>" class="carousel slide carousel-fade" data-ride="carousel">
                            <!--Slides-->
                            <div class="carousel-inner" role="listbox">
                                <!--First slide-->
                                <?php 
                                    $aux_foto = '';

                                    $foto_receita = new FotoReceita();
                                    $aux_foto = $foto_receita->executeQuery('SELECT FR.id, FR.receita, FR.path_foto, FR.usuario, FR.timestamp FROM foto_receita AS FR INNER JOIN receita ON FR.receita = receita.id WHERE receita.id ='.$value->getId());

                                    if (count($aux_foto) > 0) {
                                        foreach ($aux_foto as $chave => $foto) {
                                            ?>
                                           <div class="carousel-item <?php if($chave == 0){echo 'active';} ?>">
                                               <img class="d-block w-100" src="<?php echo($foto->getPath_foto()); ?>" onclick="location.href='exibe_receita.php?id_receita=<?php echo($value->getId()); ?>'">
                                           </div>
                                           <?php
                                        }
                                    }
                                ?>
                               
                            </div>
                            <!--/.Slides-->
                            <!--Controls-->
                            <a class="carousel-control-prev" href="#carousel-<?php echo($key); ?>" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carousel-<?php echo($key); ?>" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                            <!--/.Controls-->
                        </div>
                        <br>
                        <!-- Title -->
                        <div class="row">
                            <div class="col-sm-6 col-12">
                                <h4 class="card-title"><a style="font-size: 26px; font-weight: bold; text-transform: uppercase;" onclick="location.href='exibe_receita.php?id_receita=<?php echo($value->getId()); ?>'"><?php echo $value->getTitulo(); ?></a></h4>
                            </div>

                            <div class="col-sm-2 col-6">
                                <h5 class="font-weight-bold py-2" style="padding-top: 0px!important;"> <i class="far fa-clock"> </i> <?php echo number_format($value->getTempo_preparo(), 2, ':', ''); ?></h5>
                            </div>

                            <div class="col-sm-2 col-6">
                                <?php 

                                    $conexao = new conexao();

                                    $media = $conexao->selectDB("SELECT AVG(`avaliacao`) AS media FROM `avaliacao` WHERE `receita` = ".$value->getId()." GROUP BY `receita` ORDER BY media DESC");

                                    $media = intval($media[0]->media);

                                    for($i = 1; $i <= 5; $i++){
                                        if($i <= $media){
                                            ?>
                                            <span class="fa fa-star checked"></span>
                                            <?php
                                        }else{
                                            ?>
                                            <span class="fa fa-star"></span>
                                            <?php
                                        }
                                    }
                                ?>
                                
                            </div>

                            <div class="col-md-2">
                                <?php 
                                    $pais = new Pais();
                                    $aux = $pais->executeQuery("SELECT `pais`.* FROM `pais` INNER JOIN `receita` ON `pais`.`id` = `receita`.`pais` WHERE `receita`.`id` = ".$value->getId());

                                    if(count($aux)){
                                        ?>
                                        <a href="#" style="font-size: 16px; font-weight: bold; color: #000;">
                                            <img src="<?php echo($aux[0]->getPath_icon()); ?>" width="30">
                                            <?php echo $aux[0]->getNome(); ?>
                                        </a>
                                        <?php
                                    }
                                ?>
                            </div>

                        </div>
                    </div>
                </div>
                <?php
            }
        }else{
            ?>
            <div class="card" style="margin-top: 45px;">
                <!-- Card content -->
                <div class="card-body" align="center">
                    <i class="fas fa-grin-beam-sweat" style="font-size: 68px;"></i>
                    <p style="font-size: 28px; font-weight: bold; ">
                        Não há Receitas cadastradas nessa Categoria <br>Cadastre uma agora Mesmo !
                    </p>
                </div>
            </div>
            <?php  
        }
    }

    function manda_notifica($query, $titulo, $msg, $link){

        $notificacao = new Subscribers();
        $aux = $notificacao->executeQuery($query);

        $notificacoes = [];
        $notifica_linha;

        foreach ($aux as $key => $value) {

            $dado = '';
            $dado['titulo'] = $titulo;
            $dado['msg'] = $msg;
            $dado['icon'] = 'http://descomplicasms.com/saboresdomundo/images/icons/icon-512x512.png';
            $dado['link_red'] = $link;

            $notifica_linha['dados'] = $dado;

            $notifica_linha['auth']['endpoint'] = $value->getEndpoint();
            $notifica_linha['auth']['p256dh'] = $value->getP256dh();
            $notifica_linha['auth']['auth'] = $value->getAuth();

            $notificacoes[] = $notifica_linha;
        }

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, 'https://notificacao.ibsystem.com.br/demosite/get_notification.php');
        curl_setopt($curl,CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($curl, CURLOPT_POSTFIELDS, 
        http_build_query($notificacoes));

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($curl);

        // $aux = curl_getinfo($curl);
        curl_close($curl);
    }
?>