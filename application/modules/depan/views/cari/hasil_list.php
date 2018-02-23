<?php
  if(!empty($booktable ))  
 { 
    
      $output = '';
      $outputdata = '';  
      $outputtail ='';

      $output .= '<div class="table-responsive">
                   <table class="table table-bordered">
                  <thead>
                          <tr>
            <th>Judul</th>
                              <th>Pengarang</th>
                              <th>Penerbit</th>
              </tr>
           
                   </thead>
                   <tbody>
                   ';
                  
      foreach ($booktable as $objects)    
     {   
           $outputdata .= ' 
                
                    <tr> 
                <td >'.$objects->judul.'</td>
                <td >'.$objects->pengarang.'</td>
                <td>'.$objects->penerbit.'</td>
                    </tr> 
                
           ';
        //  echo $outputdata; 
                
          }  

         $outputtail .= ' 
                         </tbody>
                         </table>
                         </div>';
         
         echo $output; 
         echo $outputdata; 
         echo $outputtail; 
 }  
 
 else  
 {  
      echo 'Data Not Found';  
 } 