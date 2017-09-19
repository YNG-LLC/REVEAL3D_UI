<?php

  $connect = mysqli_connect("localhost", "printerUser", "yngprinter17!", "manipulate");  
  $output = '';  
  $sql = "SELECT * FROM materialDB ORDER BY task_id ASC";  
  $result = mysqli_query($connect, $sql);  
  $output .= '  
    <div class="table-responsive">  
      <table class="table table-bordered">  
        <tr> 
          <th width="100%" style="text-align:center;" >Available Actions</th>

          <th width="10%" style="text-align:center;" >Task ID</th>   
          <th width="10%" style="text-align:center;" >Material</th>  
          <th width="15%" style="text-align:center;" >Bed0_First_Layer</th>
          <th width="15%" style="text-align:center;" >Bed0_Sec_Layer</th>
          <th width="15%" style="text-align:center;" >HotEnd0_First_Layer</th>
          <th width="15%" style="text-align:center;" >HotEnd0_Sec_Layer</th>
          <th width="15%" style="text-align:center;" >Bed1_First_Layer</th>
          <th width="15%" style="text-align:center;" >Bed1_Sec_Layer</th> 
          <th width="15%" style="text-align:center;" >HotEnd1_First_Layer</th>
          <th width="15%" style="text-align:center;" >HotEnd1_Sec_Layer</th>
        </tr>';

  if(mysqli_num_rows($result) > 0){

      while($row = mysqli_fetch_array($result)){  

        $output .= '  
                  <tr>  
                    <td style="text-align:center;" ><button type="button" name="delete_btn" data-id3="'.$row["task_id"].'" class="btn btn-danger btn_delete"><i class="fa fa-trash-o fa-1x"></i></button></td>
                    <td style="text-align:center;">'.$row["task_id"].'</td>
                    <td style="text-align:center;" class="Material" data-id1="'.$row["task_id"].'" contenteditable>'.$row["Material"].'</td>  
                    <td style="text-align:center;" class="Bed0_First_Layer" data-id2="'.$row["task_id"].'" contenteditable>'.$row["Bed0_First_Layer"].'</td>  
                    <td style="text-align:center;" class="Bed0_Sec_Layer" data-id3="'.$row["task_id"].'" contenteditable>'.$row["Bed0_Sec_Layer"].'</td> 
                    <td style="text-align:center;" class="HotEnd0_First_Layer" data-id4="'.$row["task_id"].'" contenteditable>'.$row["HotEnd0_First_Layer"].'</td> 
                    <td style="text-align:center;" class="HotEnd0_Sec_Layer" data-id5="'.$row["task_id"].'" contenteditable>'.$row["HotEnd0_Sec_Layer"].'</td> 
                    <td style="text-align:center;" class="Bed1_First_Layer" data-id6="'.$row["task_id"].'" contenteditable>'.$row["Bed1_First_Layer"].'</td> 
                    <td style="text-align:center;" class="Bed1_Sec_Layer" data-id7="'.$row["task_id"].'" contenteditable>'.$row["Bed1_Sec_Layer"].'</td> 
                    <td style="text-align:center;" class="HotEnd1_First_Layer" data-id8="'.$row["task_id"].'" contenteditable>'.$row["HotEnd1_First_Layer"].'</td> 
                    <td style="text-align:center;" class="HotEnd1_Sec_Layer" data-id9="'.$row["task_id"].'" contenteditable>'.$row["HotEnd1_Sec_Layer"].'</td>   
                  </tr>
           ';  
      }
      $output .= '  
        <tr>
          <td style="text-align:center;"><button type="button" name="btn_add" id="btn_add" class="btn btn-success">Add Material</button></td>  
          <td style="text-align:center;" id="taskID" contenteditable>AUTO</td> 
          <td style="text-align:center;" id="Material" contenteditable></td>
          <td style="text-align:center;" id="Bed0_First_Layer" contenteditable></td>
          <td style="text-align:center;" id="Bed0_Sec_Layer" contenteditable></td>
          <td style="text-align:center;" id="HotEnd0_First_Layer" contenteditable></td>
          <td style="text-align:center;" id="HotEnd0_Sec_Layer" contenteditable></td>
          <td style="text-align:center;" id="Bed1_First_Layer" contenteditable></td>
          <td style="text-align:center;" id="Bed1_Sec_Layer" contenteditable></td>
          <td style="text-align:center;" id="HotEnd1_First_Layer" contenteditable></td>  
          <td style="text-align:center;" id="HotEnd1_Sec_Layer" contenteditable></td>  
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
          <td id="taskID" contenteditable>AUTO</td> 
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
