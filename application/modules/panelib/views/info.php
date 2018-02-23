
<!DOCTYPE HTML>
<html>
  <head>
    
    <title>News</title>
          
		<link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.6/cosmo/bootstrap.min.css" rel="stylesheet" integrity="sha384-OiWEn8WwtH+084y4yW2YhhH6z/qTSecHZuk/eiWtnvLtU+Z8lpDsmhOKkex6YARr" crossorigin="anonymous">
		<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-hQpvDQiCJaD2H465dQfA717v7lu5qHWtDbWNPvaTJ0ID5xnPUlVXnKzq7b8YUkbN" crossorigin="anonymous">
  </head>
  <body>
    <div class='container'>
        <div class="row" style='margin-top:50px'>
        <?php  $sub = $this->Mainmodel->info();
		$no = 1;
		foreach ($sub->result_array() as $rows){
		echo '
        <div class="col-sm-10">
          <h3 class="title"><a href="'.htmlspecialchars ($rows['url_redirect'],ENT_QUOTES,'UTF-8').'" role="button">'.htmlspecialchars ($rows['url_external'],ENT_QUOTES,'UTF-8').'</a></h3>  
      </div>
      <hr>
        ';
		}
		?>
      </div>
      <hr>
          </div> 
    <?php  $sub = $this->Mainmodel->fbpixel();
      $no = 1;
      foreach ($sub->result_array() as $rows){
      echo '
            '.$rows['konten'].'
      ';
      }
    ?> 
  </body>
</html>