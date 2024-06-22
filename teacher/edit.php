<?php 
 if (!isset($_SESSION['ACCOUNT_ID'])){
    redirect(web_root."index.php");
   }

// $autonum = New Autonumber();
// $res = $autonum->single_autonumber(2);
 @$TeacherID = $_GET['id'];
    if($TeacherID==''){
  redirect("index.php");
}
  $stud = New teacher();
  $s_teacher = $stud->select_teacher($TeacherID);

  $birthday = date_format(date_create($s_teacher->BirthDate),'m/d/Y');
  $mv = date_format(date_create($s_teacher->BirthDate),'m');
  $m =date_format(date_create($s_teacher->BirthDate),'M');
  $d = date_format(date_create($s_teacher->BirthDate),'d');
  $y = date_format(date_create($s_teacher->BirthDate),'Y');


  if ($s_teacher->Gender == 'Male') {
    # code...
   $radio =  '<div class="col-md-8">
             <div class="col-lg-5">
                <div class="radio">
                  <label><input   id="optionsRadios1" name="optionsRadios" type="radio" value="Female">Female</label>
                </div>
              </div>

              <div class="col-lg-4">
                <div class="radio">
                  <label><input id="optionsRadios2"  checked="True" name="optionsRadios" type="radio" value="Male">Male</label>
                </div>
              </div> 
             
          </div>';
  }else{
       $radio =  '<div class="col-md-8">
             <div class="col-lg-5">
                <div class="radio">
                  <label><input   id="optionsRadios1"  checked="True" name="optionsRadios" type="radio" value="Female">Female</label>
                </div>
              </div>

              <div class="col-lg-4">
                <div class="radio">
                  <label><input id="optionsRadios2"  name="optionsRadios" type="radio" value="Male"> Male</label>
                </div>
              </div> 
             
          </div>';

  }

  

     
   
 ?> 

<section id="feature" class="transparent-bg">
    <div class="container">
       <div class="center wow fadeInDown">
             <h2 class="page-header">Update teacher</h2>
        </div>

        <div class="row">
            <div class="features">

                 <form class="form-horizontal span6  wow fadeInDown" action="controller.php?action=edit" method="POST"> 
               
                         <input class="form-control input-sm" id="TeacherID" name="TeacherID" placeholder=
                            "Teacher ID" type="hidden" value="<?php echo $s_teacher->ID;?>">

                         <input class="form-control input-sm" id="IDNO" name="IDNO" placeholder=
                            "Teacher ID" type="hidden" value="<?php echo $s_teacher->TeacherID;?>"  onkeyup="javascript:capitalize(this.id, this.value);" autocomplete="off">
                  <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "Firstname">Firstname:</label>

                      <div class="col-md-8">
                        
                         <input class="form-control input-sm" id="Firstname" name="Firstname" placeholder=
                            "Firstname" type="text" value="<?php echo $s_teacher->Firstname;?>" required  onkeyup="javascript:capitalize(this.id, this.value);" autocomplete="off">
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "Lastname">Lastname:</label>

                      <div class="col-md-8">
                        
                         <input class="form-control input-sm" id="Lastname" name="Lastname" placeholder=
                            "Lastname" type="text" value="<?php echo $s_teacher->Lastname;?>" required  onkeyup="javascript:capitalize(this.id, this.value);" autocomplete="off">
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "Middlename">Middlename:</label>

                      <div class="col-md-8">
                        
                         <input class="form-control input-sm" id="Middlename" name="Middlename" placeholder=
                            "Middlename" type="text" value="<?php echo $s_teacher->Middlename;?>" required  onkeyup="javascript:capitalize(this.id, this.value);" autocomplete="off">
                      </div>
                    </div>
                  </div>

                   <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "Address">Address:</label>

                      <div class="col-md-8">
                        
                         <input class="form-control input-sm" id="Address" name="Address" placeholder=
                            "Address" type="text" value="<?php echo $s_teacher->Address;?>" required  onkeyup="javascript:capitalize(this.id, this.value);" autocomplete="off">
                      </div>
                    </div>
                  </div> 

                  <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "Gender">Sex:</label>

                      <?php
                        echo $radio;
                      ?>

                    </div>
                  </div> 


                  <div class="form-group">
                      <div class="rows">
                        <div class="col-md-8">
                          <h4>
                          <div class="col-md-4">
                            <label class="col-lg-12 control-label">Date of Birth</label>
                          </div>

                          <div class="col-lg-3">
                            <select class="form-control input-sm" name="month">
                              <option>Month</option>
                              <?php


                                 echo '<option SELECTED value='.$mv.'>'.$m.'</option>';

                                 $mon = array('Jan' => 1 ,'Feb'=> 2,'Mar' => 3 ,'Apr'=> 4,'May' => 5 ,'Jun'=> 6,'Jul' => 7 ,'Aug'=> 8,'Sep' => 9 ,'Oct'=> 10,'Nov' => 11 ,'Dec'=> 12 );    
                                
                            
                                foreach ($mon as $month => $value ) { 
                                # code...
                               
                                echo '<option value='.$value.'>'.$month.'</option>';
                                }
                              
                                   
                              ?>
                            </select>
                          </div>
 
                          <div class="col-lg-2">
                            <select class="form-control input-sm" name="day">
                              <option>Day</option>
                            <?php 
                             echo '<option SELECTED value='.$d.'>'.$d.'</option>';
                              $d = range(1, 31);
                              foreach ($d as $day) {
                                echo '<option value='.$day.'>'.$day.'</option>';
                              }
                            
                            ?>
                              
                            </select>
                          </div>

                          <div class="col-lg-3">
                            <select class="form-control input-sm" name="year">
                              <option>Year</option>
                            <?php 
                                echo '<option SELECTED value='.$y.'>'.$y.'</option>';
                                $years = range(2010, 1900);
                                foreach ($years as $yr) {
                                echo '<option value='.$yr.'>'.$yr.'</option>';
                                }
                            
                            ?>
                            
                            </select>
                          </div>
                          </h4>
                        </div>
                      </div>
                    </div> 
                   <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "ContactNo">Mobile No:</label>

                      <div class="col-md-8">
                        
                         <input class="form-control input-sm" id="ContactNo" name="ContactNo" placeholder=
                            "Mobile Number" type="any" value="<?php echo $s_teacher->ContactNo;?>" required  onkeyup="javascript:capitalize(this.id, this.value);" autocomplete="off">
                      </div>
                    </div>
                  </div> 
                            
             <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "idno"></label>

                      <div class="col-md-8">
                       <button class="btn btn-mod btn-sm" name="save" type="submit" ><span class="fa fa-save fw-fa"></span>  Save</button> 
                          <!-- <a href="index.php" class="btn btn-info"><span class="fa fa-arrow-circle-left fw-fa"></span></span>&nbsp;<strong>List of Users</strong></a> -->
                       </div>
                    </div>
                  </div> 
        </form>


            
            </div><!--/.services-->
        </div><!--/.row-->  
    </div><!--/.container-->
</section><!--/#feature-->
 
       