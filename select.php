<?php

  $connect = mysqli_connect("localhost", "printerUser", "yngprinter17!", "manipulate");  
  $output = '';  
  $sql = "SELECT * FROM materialDB ORDER BY task_id ASC";  
  $result = mysqli_query($connect, $sql);  
  $output .= '  
    <div class="table-responsive">  
      <table class="table table-bordered">  
        <tr> 
          <th width="100%">Available Actions</th>
          <th width="10%">Task ID</th>   
          <th width="10%">Material</th>  
          <th width="15%">Bed0_First_Layer</th>
          <th width="15%">Bed0_Sec_Layer</th>
          <th width="15%">HotEnd0_First_Layer</th>
          <th width="15%">HotEnd0_Sec_Layer</th>
          <th width="15%">Bed1_First_Layer</th>
          <th width="15%">Bed1_Sec_Layer</th> 
          <th width="15%">HotEnd1_First_Layer</th>
          <th width="15%">HotEnd1_Sec_Layer</th>
        </tr>';

  if(mysqli_num_rows($result) > 0){

      while($row = mysqli_fetch_array($result)){  

        $output .= '  
                  <tr>  
                    <td><button type="button" name="delete_btn" data-id3="'.$row["task_id"].'" class="btn btn-danger btn_delete"><i class="fa fa-trash-o fa-1x"></i></button></td>
                    <td>'.$row["task_id"].'</td>
                    <td class="Material" data-id1="'.$row["task_id"].'" contenteditable>'.$row["Material"].'</td>  
                    <td class="Bed0_First_Layer" data-id2="'.$row["task_id"].'" contenteditable>'.$row["Bed0_First_Layer"].'</td>  
                    <td class="Bed0_Sec_Layer" data-id3="'.$row["task_id"].'" contenteditable>'.$row["Bed0_Sec_Layer"].'</td> 
                    <td class="HotEnd0_First_Layer" data-id4="'.$row["task_id"].'" contenteditable>'.$row["HotEnd0_First_Layer"].'</td> 
                    <td class="HotEnd0_Sec_Layer" data-id5="'.$row["task_id"].'" contenteditable>'.$row["HotEnd0_Sec_Layer"].'</td> 
                    <td class="Bed1_First_Layer" data-id6="'.$row["task_id"].'" contenteditable>'.$row["Bed1_First_Layer"].'</td> 
                    <td class="Bed1_Sec_Layer" data-id7="'.$row["task_id"].'" contenteditable>'.$row["Bed1_Sec_Layer"].'</td> 
                    <td class="HotEnd1_First_Layer" data-id8="'.$row["task_id"].'" contenteditable>'.$row["HotEnd1_First_Layer"].'</td> 
                    <td class="HotEnd1_Sec_Layer" data-id9="'.$row["task_id"].'" contenteditable>'.$row["HotEnd1_Sec_Layer"].'</td>   
                  </tr>
           ';  
      }
      $output .= '  
        <tr>
          <td><button type="button" name="btn_add" id="btn_add" class="btn btn-success">Insert Row Here</button></td>  
          <td id="taskID" contenteditable></td> 
          <td id="Material" contenteditable></td>
          <td id="Bed0_First_Layer" contenteditable></td>
          <td id="Bed0_Sec_Layer" contenteditable></td>
          <td id="HotEnd0_First_Layer" contenteditable></td>
          <td id="HotEnd0_Sec_Layer" contenteditable></td>
          <td id="Bed1_First_Layer" contenteditable></td>
          <td id="Bed1_Sec_Layer" contenteditable></td>
          <td id="HotEnd1_First_Layer" contenteditable></td>  
          <td id="HotEnd1_Sec_Layer" contenteditable></td>  
        </tr>  
      '; 
       
  }else{
      $output .= '<tr>  
                    <td colspan="10" align="center"><b style="color:red">
                    </style>Please Add a Material Before Printing</b></td>  
                  </tr><br>';

      $output .= '  
        <tr>
          <td><button type="button" name="btn_add" id="btn_add" class="btn btn-success">Add Material</button></td>  
          <td id="taskID" contenteditable></td> 
          <td id="Material" contenteditable></td>
          <td id="Bed0_First_Layer" contenteditable></td>
          <td id="Bed0_Sec_Layer" contenteditable></td>
          <td id="HotEnd0_First_Layer" contenteditable></td>
          <td id="HotEnd0_Sec_Layer" contenteditable></td>
          <td id="Bed1_First_Layer" contenteditable></td>
          <td id="Bed1_Sec_Layer" contenteditable></td>
          <td id="HotEnd1_First_Layer" contenteditable></td>  
          <td id="HotEnd1_Sec_Layer" contenteditable></td>  
        </tr>  
      ';  
  }  
  $output .= '</table>  
      </div>';  
  echo $output;  
 ?>
