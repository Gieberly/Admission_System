
<?php
include('config.php');
// Include mpdf library file
require_once __DIR__ . '../vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf();
//error_reporting(0);
// if (strlen($_SESSION['aid']==0)) {
//     $id=$_GET['aid'];
// }
//      else{
//         header('location:logout.php');
//     }

// if(isset($_GET['id']) && $_GET['id'] > 0){
//     $id = $_GET['id'];
//     }
//         else{
//         header('location:index.php');
//     }
$aid=$_GET['admission_data'];



$citizenship = '';

$sql = "SELECT * FROM admission_data WHERE ref_id ='$aid'";
$result = $con->query($sql);
if (!$result) {
    die("Error in SQL query: " . $con->error);
}



$sql = "SELECT * FROM tbl_employees WHERE ref_id ='$aid'";
$result = $con->query($sql);
if (!$result) {
    die("Error in SQL query: " . $con->error);
}
$rows = $result->fetch_all(MYSQLI_ASSOC); // fetch all rows as associative arrays
foreach ($rows as $row) {
    $firstname = $row['first_name'] ?? ''; // use null coalescing operator to avoid undefined index notices
    $middlename = $row['middle_name'] ?? '';
    $lastname = $row['last_name'] ?? '';
    $extname = $row['ext_name'] ?? '';

    $gender = $row['sex'];
    $dateofbirth =$row['birthday'];
    $placeofbirth =$row['place_of_birth'];
    $civilstatus =$row['civil_status'];
    $citizenship =$row['citizenship'];
    $citizenship2 =$row['dualCitizenship'];
    $byBirth =$row['byBirth'];
    $byNaturalization =$row['byNaturalization'];
    $dualCitizenshipDropdown =$row['dualCitizenshipDropdown']; 
    $weight =$row['weight'];
    $height =$row['height'];
    $bloodtype =$row['blood_type'];

    $re_houseblock =$row['re_houseblock'];
    $re_municipality =$row['re_municipality'];
    $re_subdivision =$row['re_subdivision'];
    $re_street =$row['re_street'];
    $re_province =$row['re_province'];
    $re_barangay =$row['re_barangay'];
    $re_zipcode =$row['re_zipcode'];

    $per_houseblock =$row['per_houseblock'];
    $per_municipality =$row['per_municipality'];
    $per_subdivision =$row['per_subdivision'];
    $per_street =$row['per_street'];
    $per_province =$row['per_province'];
    $per_barangay =$row['per_barangay'];
    $per_zipcode =$row['per_zipcode'];

    $mobile_no =$row['mobile_no'];
    $telephone_no =$row['telephone_no'];
    $email =$row['email'];
    $gsis_no =$row['gsis_no'];
    $pagibig_no =$row['pagibig_no'];
    $philhealth_no =$row['philhealth_no'];
    $sss_no =$row['sss_no'];
    $tin_no =$row['tin_no'];
    $agency_employment_no =$row['agency_employment_no'];

}


$stmt = $con->prepare("SELECT * FROM tbl_employees_family WHERE ref_id = '$aid'");
$stmt->bind_param("i", $aid); // "i" specifies that the parameter should be bound as an integer
$stmt->execute();
$result = $stmt->get_result();
if (!$result) {
    die("Error in SQL query: " . $con->error);
}
$rows = $result->fetch_all(MYSQLI_ASSOC); // fetch all rows as associative arrays
foreach ($rows as $row) {
    $SpouseFamily = $row['SpouseFamilyName'];
    $SpouseMiddle = $row['SpouseMiddleName'];
    $SpouseFirst = $row['SpouseFirstName'];
    $Occupation =$row['Occupation'];
    $Mobile =$row['Mobile'];
 
    $FatherFamily = $row['FatherFamilyName'];
    $FatherMiddle = $row['FatherMiddleName'];
    $FatherFirst = $row['FatherFirstName'];
    $Father_Occupation =$row['Father_Occupation'];
    $Father_Mobile =$row['Father_Mobile'];
 
    $MotherFamily = $row['MotherFamilyName'];
    $MotherMiddle = $row['MotherMiddleName'];
    $MotherFirst = $row['MotherFirstName'];
    $Mother_Occupation =$row['Mother_Occupation'];
    $Mother_Mobile =$row['Mother_Mobile'];
    
}

$stmt = $con->prepare("SELECT * FROM tbl_children WHERE ref_id = '$aid'");
$stmt->bind_param("i", $aid); // "i" specifies that the parameter should be bound as an integer
$stmt->execute();
$result = $stmt->get_result();
if (!$result) {
    die("Error in SQL query: " . $con->error);
}
$rowsChildren = $result->fetch_all(MYSQLI_ASSOC); // fetch all rows as associative arrays






$stmt = $con->prepare("SELECT * FROM tbl_cseligibility WHERE ref_id = '$aid' ORDER BY date_of_exam desc ");
$stmt->bind_param("i", $aid); // "i" specifies that the parameter should be bound as an integer
$stmt->execute();
$result = $stmt->get_result();
if (!$result) {
    die("Error in SQL query: " . $con->error);
}
$rowsCE = $result->fetch_all(MYSQLI_ASSOC); // fetch all rows as associative arrays

//---------------------------------
// $stmt = $con->prepare("SELECT * FROM tbl_workexperience WHERE ref_id = '$aid' ");
// $stmt->bind_param("i", $aid); // "i" specifies that the parameter should be bound as an integer
// $stmt->execute();
// $result = $stmt->get_result();
// if (!$result) {
//     die("Error in SQL query: " . $con->error);
// }
// $rowsEH = $result->fetch_all(MYSQLI_ASSOC); // fetch all rows as associative arrays

$sql = "SELECT * FROM tbl_workexperience WHERE ref_id ='$aid' ORDER BY from_date desc";
$result = $con->query($sql);
if (!$result) {
    die("Error in SQL query: " . $con->error);
}
$rowsEH = $result->fetch_all(MYSQLI_ASSOC); // fetch all rows as associative arrays

$sql = "SELECT * FROM tbl_employees_voluntarywork WHERE ref_id ='$aid' ORDER BY vi_inc_from desc";
$result = $con->query($sql);
if (!$result) {
    die("Error in SQL query: " . $con->error);
}
$rowsVW = $result->fetch_all(MYSQLI_ASSOC); // fetch all rows as associative arrays

$sql = "SELECT * FROM tbl_employees_training WHERE ref_id ='$aid' ORDER BY tp_from desc";
$result = $con->query($sql);
if (!$result) {
    die("Error in SQL query: " . $con->error);
}
$rowsLD = $result->fetch_all(MYSQLI_ASSOC); // fetch all rows as associative arrays



if($citizenship=='Filipino'){
    $filNationalityChecked='checked="checked"';
}else{$filNationalityChecked='';}

if($citizenship2=='Dual Citizenship'){
    $dlNationalityChecked='checked="checked"';
}else{$dlNationalityChecked='';}

if($byBirth=='1'){
    $byBirthChecked='checked="checked"';
}else{$byBirthChecked='';}

if($byNaturalization=='1'){
    $byNaturalizationChecked='checked="checked"';
}else{$byNaturalizationChecked='';}



//generate heading
                $html='
                <style>
                    @page {
                     margin-top: 15px;
                    }
                    .main-table{
                    border-top: 0px solid black;
                    border-left: 0px solid black;
                    border-right: 0px solid black;
                    width:100%;
                    }
                    .main-text{
                        font-size:13px;
                    }
                
                </style>
                
                <table class="main-table" align="left" cellspacing="0">
                    
                    <tr>
                        <td style="font-size:14px;font-weight:bold" colspan="20" align="center" valign="top" ><font face=" Old English Text MT">Republic of the Philippines </font>
                    </tr>
                    <tr>
                        <td style="font-size:14px;font-weight:bold" colspan="20" align="center" valign="top" ><font face=" Old English Text MT" font color="rgb(22, 62, 4)"> Benguet State University</font></td>
                    </tr>
                    <tr>
                        <td style="font-size:14px;font-weight:bold" colspan="20" align="center" valign="top" ><font face=" Old English Text MT" font color="rgb(22, 62, 4)"> OFFICE OF UNIVERSITY REGISTRAR</font></td>
                    </tr>
                    
                        <tr>
                            <td align="center" valign="middle" colspan="20" style="font-weight:bold;font-size:14px;"><font face="Arial Black">APPLICATION FOR ADMISSION</font></td>
                        </tr>
                    
                    <tr>
                        <td style="font-size:12px" colspan="14" align="left" valign="top"><b><u><font color="#000000">GENERAL INSTRUCTIONS:</u></b> <br> 1. Read and understand the Admission Guidelines and Requirements in Page 2 before accomplishing this form <br> 2. Use black or blue in in filling out the form <br> 3. Fill out completely and accurately this application form for admission. <br> 4. Write clearly and legibly. <br>  5. Put a check (/) mark where appropriate. <br> 6. Submit application form with complete requirements. &nbsp;</font></td>
                        <td style="border: 1px solid #000000;width:130px"  font-size:9px; colspan="3" align="right" valign="middle"><font face="Arial Narrow" size="1" color="#000000"> ATTACH ONE piece/copy of RECENT 2" x 2" ID Picture (clear/standard photo) with white background and name tag <i>(Signature over printed name)</i></font></td>
                    </tr>
                    <tr>
                        <td style="font-size:12px" colspan="14" align="left" valign="top"><b><u><font size="1" color="#000000">PRIVACY NOTICE:</u></b><br> </font></b></td>
                    </tr>
                    
                    <tr>
                        <td style="font-size:12px" colspan="14" align="left" valign="top"><font size="1" color="#000000">Pursuant to the Data Privacy Act of 2012 and the BSU Data Policy, Personnel from the Office of the University Registrar, concerned Personnel of the</b><br> </font></td>
                    </tr>
                    <tr>
                        <td style="font-size:12px" colspan="14" align="left" valign="top"><b><font size="1" color="#000000"><u>BACKGROUND INFORMATION OF APPLICCANT &nbsp;&nbsp;</u></font></b></td>
                        <td style="font-size:12px" colspan="14" align="left" valign="top"><b><font size="1" color="#000000"></font></b></td>
                        <td style="font-size:12px" colspan="14" align="left" valign="top"><b><font size="1" color="#000000"> &nbsp;&nbsp;</font></b></td>
                    </tr>

                    <tr>
                        <td style="font-size:12px" colspan="14" align="left" valign="top"><b><font size="1" color="#000000"><i> Personal Information:&nbsp;&nbsp;</i></font></b></td>
                        <td style="font-size:12px" colspan="14" align="left" valign="top"><b><font size="1" color="#000000"> &nbsp;&nbsp;</font></b></td>
                    </tr>
                    <tr >
                        <td style="border-left: 1px solid #000000; border-bottom: 1px solid #000000;border-top: 1px solid #000000; width:15px;"  align="right" valign="middle" bgcolor="#EAEAEA"  ><font face="Arial Narrow" size="1" color="#000000"></font></td>
                        <td colspan="5" style="border-right: 1px solid #000000; border-bottom: 1px solid #000000;border-top: 1px solid #000000; width:150px" align="left" valign="middle" bgcolor="#EAEAEA"  ><font face="Arial Narrow" size="1" color="#000000">LAST NAME</font></td>
                        <td colspan="11" style="border-right: 1px solid #000000;border-bottom: 1px solid #000000;font-size:13px;" class="main-text"  align="left" valign="middle"  ><b><font face="Arial Narrow" color="#000000"> &nbsp;'.$lastname.'</font></b></td>
                    </tr>
                    <tr>
                        <td style="border-left: 1px solid #000000; border-bottom: 1px solid #000000; width:15px;border-top: 1px solid #000000; width:15px;" align="right" valign="middle" bgcolor="#EAEAEA"  ><font face="Arial Narrow" size="1" color="#000000"><br></font></td>
                        <td colspan="2" style="border-right: 1px solid #000000;border-bottom: 1px solid #000000;"  align="left" valign="middle" bgcolor="#EAEAEA"  ><font face="Arial Narrow" size="1" color="#000000">FIRST NAME</font></td>
                        <td  colspan="5" style="border-bottom: 1px solid #000000;border-right: 1px solid #000000;font-size:13px;" align="left" valign="middle"  ><b><font face="Arial Narrow" color="#000000"> &nbsp;'.$firstname.'</font></b></td>
                        <td colspan="4" style="border-bottom: 1px solid #000000;border-right: 1px solid #000000;" align="left" valign="top" bgcolor="#EAEAEA"  ><font face="Arial Narrow" size="1" color="#000000">NAME EXTENSION (JR., SR)  </font></td>
                    </tr>
                    <tr>
                        <td height="10" style="border-left: 1px solid #000000;width:15px;border-bottom: 1px solid #000000" align="right" valign="middle" bgcolor="#EAEAEA"  ><font face="Arial Narrow" size="1" color="#000000"></font></td>
                        <td style="border-right: 1px solid #000000;border-bottom: 1px solid #000000;font-size:13px;" colspan="2" align="left" valign="middle" bgcolor="#EAEAEA"  ><font face="Arial Narrow" size="1" color="#000000">MIDDLE NAME</font></td>
                        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000; font-size:13px; " colspan="11" align="left" valign="middle"><b><font face="Arial Narrow" color="#000000">&nbsp;'.$middlename.'</font></b></td>
                        
                    </tr>
                    <tr>
                        <td height="10" style="border-left: 1px solid #000000;border-bottom: 1px solid #000000" align="right" valign="top" bgcolor="#EAEAEA"  ><font face="Arial Narrow" size="1" color="#000000">3.</font></td>
                        <td style="border-right: 1px solid #000000;border-bottom: 1px solid #000000;" colspan="2" align="left" valign="middle" bgcolor="#EAEAEA"><font face="Arial Narrow" size="1" color="#000000">DATE OF BIRTH <br>(mm/dd/yyyy)  </font></td>
                        <td style=" border-right: 1px solid #000000;border-bottom: 1px solid #000000;font-size:13px;" colspan="3" align="left" valign="middle" bgcolor="#FFFFFF" sdval="33105" sdnum="1033;1033;M/D/YYYY"><font face="Arial Narrow" color="#000000">&nbsp;'.$dateofbirth.'</font></td>
                        <td colspan="2" rowspan="3" style="border-right: 1px solid #000000; border-bottom: 1px solid #000000" align="left" valign="middle" bgcolor="#EAEAEA"  ><font face="Arial Narrow" size="1" color="#000000">16. CITIZENSHIP <br/><br/>
                            If holder of  dual citizenship, please indicate details.
                            </font></td>
                        <td colspan="8" rowspan="3" style="border-right: 1px solid #000000; border-bottom: 1px solid #000000;font-size:13px;" align="left" valign="middle"><font face="Arial Narrow" color="#000000"><input type="checkbox" '.$filNationalityChecked.' >&nbsp;Filipino &nbsp; &nbsp; <input type="checkbox" '.$dlNationalityChecked.'>&nbsp;Dual Citizenship<br/>
                            &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<input type="checkbox" '.$byBirthChecked.'>&nbsp;by birth  &nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" '.$byNaturalizationChecked.'>&nbsp; by naturalization<br/>
                            &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;Pls. indicate country:   '.$dualCitizenshipDropdown.'<br/>
                            &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; 
                            
                            </font></td>
                
                    </tr>
                    <tr>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000" height="10" align="right" valign="middle" bgcolor="#EAEAEA"  ><font face="Arial Narrow" size="1" color="#000000">4.</font></td>
                        <td colspan="2" style="border-right: 1px solid #000000; border-bottom: 1px solid #000000;border-right: 1px solid #000000" align="left" valign="middle" bgcolor="#EAEAEA"><font face="Arial Narrow" size="1" color="#000000">PLACE OF BIRTH</font></td>
                        <td style=" border-right: 1px solid #000000;border-bottom: 1px solid #000000;font-size:13px;" colspan="3" align="left" valign="middle" bgcolor="#FFFFFF" sdval="33105" sdnum="1033;1033;M/D/YYYY"><font face="Arial Narrow" color="#000000">&nbsp;'.$placeofbirth.'</font></td>
                        
                    </tr>
                    <tr>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000" align="right" valign="middle" bgcolor="#EAEAEA"  ><font face="Arial Narrow" size="1" color="#000000">5.</font></td>
                        <td colspan="2" style="border-right: 1px solid #000000; border-bottom: 1px solid #000000;border-right: 1px solid #000000" align="left" valign="middle" bgcolor="#EAEAEA"><font face="Arial Narrow" size="1" color="#000000">SEX</font></td>
                        <td style=" border-right: 1px solid #000000;border-bottom: 1px solid #000000;font-size:13px;" colspan="3" align="left" valign="middle" bgcolor="#FFFFFF" sdval="33105" sdnum="1033;1033;M/D/YYYY"><font face="Arial Narrow" color="#000000">&nbsp;'.$gender.'</font></td>
                        
                    </tr>


                    <tr>
                        <td rowspan="4" style="border-bottom: 1px solid #000000; border-left: 1px solid #000000" align="right" valign="top" bgcolor="#EAEAEA"  ><font face="Arial Narrow" size="1" color="#000000">6.</font></td>
                        <td colspan="2" rowspan="4" style="border-right: 1px solid #000000; border-bottom: 1px solid #000000;border-right: 1px solid #000000" align="left" valign="top" bgcolor="#EAEAEA"><font face="Arial Narrow" size="1" color="#000000">CIVIL STATUS</font></td>
                        <td rowspan="4" style=" border-right: 1px solid #000000;border-bottom: 1px solid #000000;font-size:13px;" colspan="3" align="left" valign="top" bgcolor="#FFFFFF" sdval="33105" sdnum="1033;1033;M/D/YYYY"><font face="Arial Narrow" color="#000000">&nbsp;'.$civilstatus.'</font></td>
                        <td colspan="2" rowspan="4" style="border-right: 1px solid #000000; border-bottom: 1px solid #000000" align="left" valign="top" bgcolor="#EAEAEA"  ><font face="Arial Narrow" size="1" color="#000000">17. RESIDENTIAL ADDRESS</font></td>
                        <td style="border-bottom: 1px solid #000000;font-size:13px; " colspan="3" align="center" valign="middle" bgcolor="#FFFFFF"><font face="Arial Narrow">&nbsp;'.$re_houseblock.'</font></td>
                        <td style="border-bottom: 1px solid #000000; border-right: 2px solid #000000;font-size:13px;" colspan="3" align="center" valign="middle" bgcolor="#FFFFFF"><font face="Arial Narrow">&nbsp;'.$re_street.'</font></td>
                    </tr>

                    <tr>
                        
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000" colspan="3" align="center" valign="middle" bgcolor="#FFFFFF"><i><font face="Arial Narrow" size="1">House/Block/Lot No.</font></i></td>
                        <td style="border-bottom: 1px solid #000000; border-right: 2px solid #000000" colspan="3" align="center" valign="middle" bgcolor="#FFFFFF"><i><font face="Arial Narrow" size="1">Street</font></i></td>
                        
                    </tr>

                    <tr>
                        
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000;font-size:13px;" colspan="3" align="center" valign="middle" bgcolor="#FFFFFF"><font face="Arial Narrow">&nbsp;'.$re_subdivision.'</font></td>
                        <td style="border-bottom: 1px solid #000000; border-right: 2px solid #000000;font-size:13px;" colspan="3" align="center" valign="middle" bgcolor="#FFFFFF"><font face="Arial Narrow">&nbsp;'.$re_barangay.'</font></td>
                    </tr>

                    <tr>
                        
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000" colspan="3" align="center" valign="middle" bgcolor="#FFFFFF"><i><font face="Arial Narrow" size="1">Subdivision/Village</font></i></td>
                        <td style="border-bottom: 1px solid #000000; border-right: 2px solid #000000" colspan="3" align="center" valign="middle" bgcolor="#FFFFFF"><i><font face="Arial Narrow" size="1">Barangay</font></i></td>
                        
                    </tr>

                    <tr>
                        <td rowspan="2" style="border-bottom: 1px solid #000000; border-left: 1px solid #000000"  align="right" valign="top" bgcolor="#EAEAEA"  ><font face="Arial Narrow" size="1" color="#000000">7.</font></td>
                        <td colspan="2" rowspan="2" style="border-right: 1px solid #000000; border-bottom: 1px solid #000000;border-right: 1px solid #000000" align="left" valign="top" bgcolor="#EAEAEA"><font face="Arial Narrow" size="1" color="#000000">HEIGHT (m)</font></td>
                        <td style=" border-right: 1px solid #000000;font-size:13px;" colspan="3" align="center" valign="middle" bgcolor="#FFFFFF" sdval="33105" sdnum="1033;1033;M/D/YYYY"><font face="Arial Narrow" color="#000000">&nbsp;'.$height.'</font></td>
                        <td colspan="2" style="border-right: 1px solid #000000; " align="left" valign="middle" bgcolor="#EAEAEA"  ><font face="Arial Narrow" size="1" color="#000000"></font></td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000;font-size:13px;" colspan="3" align="center" valign="middle" bgcolor="#FFFFFF"><font face="Arial Narrow">&nbsp;'.$re_municipality.'</font></td>
                        <td style="border-bottom: 1px solid #000000; border-right: 2px solid #000000;font-size:13px;" colspan="3" align="center" valign="middle" bgcolor="#FFFFFF"><font face="Arial Narrow">&nbsp;'.$re_province.'</font></td>
                    </tr>

                    <tr>

                        <td style=" border-right: 1px solid #000000;border-bottom: 1px solid #000000" colspan="3" align="center" valign="middle" bgcolor="#FFFFFF" sdval="33105" sdnum="1033;1033;M/D/YYYY"><font face="Arial Narrow" color="#000000"></font></td>
                        <td colspan="2" style="border-right: 1px solid #000000; border-bottom: 1px solid #000000" align="left" valign="middle" bgcolor="#EAEAEA"  ><font face="Arial Narrow" size="1" color="#000000" ></font></td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000" colspan="3" height="5" align="center" valign="middle" bgcolor="#FFFFFF"><i><font face="Arial Narrow" size="1">City/Municipality</font></i></td>
                        <td style="border-bottom: 1px solid #000000; border-right: 2px solid #000000" colspan="3" align="center" valign="middle" bgcolor="#FFFFFF"><i><font face="Arial Narrow" size="1">Province</font></i></td>
                        
                    </tr>

                    <tr>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000"  align="right" valign="middle" bgcolor="#EAEAEA"  ><font face="Arial Narrow" size="1" color="#000000">8.</font></td>
                        <td colspan="2" style="border-right: 1px solid #000000; border-bottom: 1px solid #000000;border-right: 1px solid #000000" align="left" valign="middle" bgcolor="#EAEAEA"><font face="Arial Narrow" size="1" color="#000000">WEIGHT (kg)</font></td>
                        <td style=" border-right: 1px solid #000000;border-bottom: 1px solid #000000;font-size:13px;" colspan="3" align="center" valign="middle" bgcolor="#FFFFFF" sdval="33105" sdnum="1033;1033;M/D/YYYY"><font face="Arial Narrow" color="#000000">&nbsp;'.$weight.'</font></td>
                        <td colspan="2" style="border-right: 1px solid #000000; border-bottom: 1px solid #000000" align="left" valign="middle" bgcolor="#EAEAEA" ><font face="Arial Narrow" size="1" color="#000000">&nbsp; ZIP CODE</font></td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000;font-size:13px;" colspan="6" align="center" valign="middle" bgcolor="#FFFFFF"><i><font face="Arial Narrow">&nbsp;'.$re_zipcode.'</font></i></td>
                        
                    </tr>

                    
                    <tr>
                        <td rowspan="2" style="border-bottom: 1px solid #000000; border-left: 1px solid #000000"  align="right" valign="top" bgcolor="#EAEAEA"  ><font face="Arial Narrow" size="1" color="#000000">9.</font></td>
                        <td colspan="2" rowspan="2" style="border-right: 1px solid #000000; border-bottom: 1px solid #000000;border-right: 1px solid #000000" align="left" valign="top" bgcolor="#EAEAEA"><font face="Arial Narrow" size="1" color="#000000">BLOOD TYPE</font></td>
                        <td style=" border-right: 1px solid #000000;font-size:13px;" colspan="3" align="center" valign="middle" bgcolor="#FFFFFF" sdval="33105" sdnum="1033;1033;M/D/YYYY"><font face="Arial Narrow" color="#000000">&nbsp;'.$bloodtype.'</font></td>
                        <td colspan="2" style="border-right: 1px solid #000000; " align="left" valign="middle" bgcolor="#EAEAEA"  ><font face="Arial Narrow" size="1" color="#000000">18. PERMANENT ADDRESS</font></td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000;font-size:13px;" colspan="3" align="center" valign="middle" bgcolor="#FFFFFF"><font face="Arial Narrow">&nbsp;'.$per_houseblock.'</font></td>
                        <td style="border-bottom: 1px solid #000000; border-right: 2px solid #000000;font-size:13px;" colspan="3" align="center" valign="middle" bgcolor="#FFFFFF"><font face="Arial Narrow">&nbsp;'.$per_municipality.'</font></td>
                    </tr>

                    <tr>
                        
                        <td style=" border-right: 1px solid #000000;border-bottom: 1px solid #000000" colspan="3" align="center" valign="middle" bgcolor="#FFFFFF" sdval="33105" sdnum="1033;1033;M/D/YYYY"><font face="Arial Narrow" color="#000000"></font></td>
                        <td colspan="2" style="border-right: 1px solid #000000; border-bottom: 1px solid #000000" align="left" valign="middle" bgcolor="#EAEAEA"  ><font face="Arial Narrow" size="1" color="#000000"></font></td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000" colspan="3" align="center" valign="middle" bgcolor="#FFFFFF"><i><font face="Arial Narrow" size="1">House/Block/Lot No.</font></i></td>
                        <td style="border-bottom: 1px solid #000000; border-right: 2px solid #000000" colspan="3" align="center" valign="middle" bgcolor="#FFFFFF"><i><font face="Arial Narrow" size="1">Street</font></i></td>
                        
                    </tr>

                    <tr>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000" align="right" valign="middle" bgcolor="#EAEAEA"  ><font face="Arial Narrow" size="1" color="#000000">10.</font></td>
                        <td colspan="2" style="border-right: 1px solid #000000; border-bottom: 1px solid #000000;border-right: 1px solid #000000" align="left" valign="middle" bgcolor="#EAEAEA"><font face="Arial Narrow" size="1" color="#000000">GSIS ID NO.</font></td>
                        <td style=" border-right: 1px solid #000000;border-bottom: 1px solid #000000;font-size:13px;" colspan="3" align="center" valign="middle" bgcolor="#FFFFFF" sdval="33105" sdnum="1033;1033;M/D/YYYY"><font face="Arial Narrow" color="#000000">&nbsp;'.$gsis_no.'</font></td>
                        <td colspan="2" style="border-right: 1px solid #000000; border-bottom: 1px solid #000000" align="left" valign="middle" bgcolor="#EAEAEA"  ><font face="Arial Narrow" size="1" color="#000000"></font></td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000;font-size:13px;" colspan="3" align="center" valign="middle" bgcolor="#FFFFFF"><font face="Arial Narrow">&nbsp;'.$per_subdivision.'</font></td>
                        <td style="border-bottom: 1px solid #000000; border-right: 2px solid #000000;font-size:13px;" colspan="3" align="center" valign="middle" bgcolor="#FFFFFF"><font face="Arial Narrow">&nbsp;'. $per_barangay.'</font></td>
                    </tr>

                    <tr>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000" height="5" align="right" valign="middle" bgcolor="#EAEAEA"  ><font face="Arial Narrow" size="1" color="#000000"></font></td>
                        <td colspan="2" style="border-right: 1px solid #000000; border-bottom: 1px solid #000000;border-right: 1px solid #000000" align="left" valign="middle" bgcolor="#EAEAEA"><font face="Arial Narrow" size="1" color="#000000"></font></td>
                        <td style=" border-right: 1px solid #000000;border-bottom: 1px solid #000000" colspan="3" align="center" valign="middle" bgcolor="#FFFFFF" sdval="33105" sdnum="1033;1033;M/D/YYYY"><font face="Arial Narrow" color="#000000"></font></td>
                        <td colspan="2" style="border-right: 1px solid #000000; border-bottom: 1px solid #000000" align="left" valign="middle" bgcolor="#EAEAEA"  ><font face="Arial Narrow" size="1" color="#000000"></font></td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000" colspan="3" align="center" valign="middle" bgcolor="#FFFFFF"><i><font face="Arial Narrow" size="1">Subdivision/Village</font></i></td>
                        <td style="border-bottom: 1px solid #000000; border-right: 2px solid #000000" colspan="3" align="center" valign="middle" bgcolor="#FFFFFF"><i><font face="Arial Narrow" size="1">Barangay</font></i></td>
                        
                    </tr>

                    <tr>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000" align="right" valign="middle" bgcolor="#EAEAEA"  ><font face="Arial Narrow" size="1" color="#000000">11.</font></td>
                        <td colspan="2" style="border-right: 1px solid #000000; border-bottom: 1px solid #000000;border-right: 1px solid #000000" align="left" valign="middle" bgcolor="#EAEAEA"><font face="Arial Narrow" size="1" color="#000000">PAG-IBIG NO.</font></td>
                        <td class="main-text" style=" border-right: 1px solid #000000;border-bottom: 1px solid #000000" colspan="3" align="center" valign="middle" bgcolor="#FFFFFF" sdval="33105" sdnum="1033;1033;M/D/YYYY"><font face="Arial Narrow" color="#000000">&nbsp;'.$pagibig_no.'</font></td>
                        <td colspan="2" style="border-right: 1px solid #000000; border-bottom: 1px solid #000000" align="left" valign="middle" bgcolor="#EAEAEA"  ><font face="Arial Narrow" size="1" color="#000000"></font></td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000" colspan="3" align="center" valign="middle" bgcolor="#FFFFFF"><font face="Arial Narrow">&nbsp;'.$per_municipality.'</font></td>
                        <td style="border-bottom: 1px solid #000000; border-right: 2px solid #000000" colspan="3" align="center" valign="middle" bgcolor="#FFFFFF"><font face="Arial Narrow">&nbsp;'.$per_province.'</font></td>
                    </tr>

                    <tr>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000" height="5" align="right" valign="middle" bgcolor="#EAEAEA"  ><font face="Arial Narrow" size="1" color="#000000"></font></td>
                        <td colspan="2" style="border-right: 1px solid #000000; border-bottom: 1px solid #000000;border-right: 1px solid #000000" align="left" valign="middle" bgcolor="#EAEAEA"><font face="Arial Narrow" size="1" color="#000000"></font></td>
                        <td style=" border-right: 1px solid #000000;border-bottom: 1px solid #000000" colspan="3" align="center" valign="middle" bgcolor="#FFFFFF" sdval="33105" sdnum="1033;1033;M/D/YYYY"><font face="Arial Narrow" color="#000000"></font></td>
                        <td colspan="2" style="border-right: 1px solid #000000; border-bottom: 1px solid #000000" align="left" valign="middle" bgcolor="#EAEAEA"  ><font face="Arial Narrow" size="1" color="#000000" ></font></td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000" colspan="3" height="5" align="center" valign="middle" bgcolor="#FFFFFF"><i><font face="Arial Narrow" size="1">City/Municipality</font></i></td>
                        <td style="border-bottom: 1px solid #000000; border-right: 2px solid #000000" colspan="3" align="center" valign="middle" bgcolor="#FFFFFF"><i><font face="Arial Narrow" size="1">Province</font></i></td>
                        
                    </tr>

                    <tr>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000"  align="right" valign="middle" bgcolor="#EAEAEA"  ><font face="Arial Narrow" size="1" color="#000000">12.</font></td>
                        <td colspan="2" style="border-right: 1px solid #000000; border-bottom: 1px solid #000000;border-right: 1px solid #000000" align="left" valign="middle" bgcolor="#EAEAEA"><font face="Arial Narrow" size="1" color="#000000">PHILHEALTH NO.</font></td>
                        <td class="main-text" style=" border-right: 1px solid #000000;border-bottom: 1px solid #000000" colspan="3" align="center" valign="middle" bgcolor="#FFFFFF" sdval="33105" sdnum="1033;1033;M/D/YYYY"><font face="Arial Narrow" color="#000000">&nbsp;'.$philhealth_no.'</font></td>
                        <td colspan="2" style="border-right: 1px solid #000000; border-bottom: 1px solid #000000" align="left" valign="middle" bgcolor="#EAEAEA" ><font face="Arial Narrow" size="1" color="#000000">&nbsp; ZIP CODE</font></td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000" colspan="6" align="center" valign="middle" bgcolor="#FFFFFF"><i><font face="Arial Narrow">&nbsp;'.$per_zipcode.'</font></i></td>
                        
                    </tr>

                    <tr>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000"  align="right" valign="middle" bgcolor="#EAEAEA"  ><font face="Arial Narrow" size="1" color="#000000">13.</font></td>
                        <td colspan="2" style="border-right: 1px solid #000000; border-bottom: 1px solid #000000;border-right: 1px solid #000000" align="left" valign="middle" bgcolor="#EAEAEA"><font face="Arial Narrow" size="1" color="#000000">SSS NO.</font></td>
                        <td style=" border-right: 1px solid #000000;border-bottom: 1px solid #000000" colspan="3" align="center" valign="middle" bgcolor="#FFFFFF" sdval="33105" sdnum="1033;1033;M/D/YYYY"><font face="Arial Narrow" color="#000000">&nbsp;'.$sss_no.'</font></td>
                        <td colspan="2" style="border-right: 1px solid #000000; border-bottom: 1px solid #000000" align="left" valign="middle" bgcolor="#EAEAEA" ><font face="Arial Narrow" size="1" color="#000000">19. TELEPHONE NO.</font></td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000" colspan="6" align="center" valign="middle" bgcolor="#FFFFFF"><i><font face="Arial Narrow">&nbsp;'.$telephone_no.'</font></i></td>
                        
                    </tr>
                    
                    <tr>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000"  align="right" valign="middle" bgcolor="#EAEAEA"  ><font face="Arial Narrow" size="1" color="#000000">14.</font></td>
                        <td colspan="2" style="border-right: 1px solid #000000; border-bottom: 1px solid #000000;border-right: 1px solid #000000" align="left" valign="middle" bgcolor="#EAEAEA"><font face="Arial Narrow" size="1" color="#000000">TIN NO.</font></td>
                        <td class="main-text" style=" border-right: 1px solid #000000;border-bottom: 1px solid #000000" colspan="3" align="center" valign="middle" bgcolor="#FFFFFF" sdval="33105" sdnum="1033;1033;M/D/YYYY"><font face="Arial Narrow" color="#000000">&nbsp;'.$tin_no.'</font></td>
                        <td colspan="2" style="border-right: 1px solid #000000; border-bottom: 1px solid #000000" align="left" valign="middle" bgcolor="#EAEAEA" ><font face="Arial Narrow" size="1" color="#000000">20. MOBILE NO.</font></td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000" colspan="6" align="center" valign="middle" bgcolor="#FFFFFF"><i><font face="Arial Narrow">&nbsp;'.$mobile_no.'</font></i></td>
                    </tr>

                    <tr>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000"  align="right" valign="middle" bgcolor="#EAEAEA"  ><font face="Arial Narrow" size="1" color="#000000">15.</font></td>
                        <td colspan="2" class="main-text" style="border-right: 1px solid #000000; border-bottom: 1px solid #000000;border-right: 1px solid #000000" align="left" valign="middle" bgcolor="#EAEAEA"><font face="Arial Narrow" size="1" color="#000000">AGENCY EMPLOYEE NO.</font></td>
                        <td class="main-text" style=" border-right: 1px solid #000000;border-bottom: 1px solid #000000" colspan="3" align="center" valign="middle" bgcolor="#FFFFFF" sdval="33105" sdnum="1033;1033;M/D/YYYY"><font face="Arial Narrow" color="#000000">&nbsp;'.$agency_employment_no.'</font></td>
                        <td colspan="2" style="border-right: 1px solid #000000; border-bottom: 1px solid #000000" align="left" valign="middle" bgcolor="#EAEAEA" ><font face="Arial Narrow" size="1" color="#000000">21. EMAIL ADDRESS</font></td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000" colspan="6" align="center" valign="middle" bgcolor="#FFFFFF"><i><font face="Arial Narrow">&nbsp; '.$email.'</font></i></td>
                    </tr>
                    

                    <tr>
                        <td style="border: 2px solid #000000; " colspan="14" height="22" align="left" valign="top" bgcolor="#969696"><b><i><font face="Arial Narrow" color="#FFFFFF">II. FAMILY BACKGROUND</font></i></b></td>
                    </tr>


                    <tr>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000"  align="right" valign="middle" bgcolor="#EAEAEA"  ><font face="Arial Narrow" size="1" color="#000000">22.</font></td>
                        <td colspan="2" style="border-right: 1px solid #000000; border-bottom: 1px solid #000000;border-right: 1px solid #000000" align="left" valign="middle" bgcolor="#EAEAEA"><font face="Arial Narrow" size="1" color="#000000">SPOUSE\'S SURNAME</font></td>
                        <td style=" border-right: 1px solid #000000;border-bottom: 1px solid #000000" colspan="3" align="center" valign="middle" bgcolor="#FFFFFF" sdval="33105" sdnum="1033;1033;M/D/YYYY"><font face="Arial Narrow" color="#000000">&nbsp;'.$SpouseFamily.'</font></td>
                        <td colspan="2" style="border-right: 1px solid #000000; border-bottom: 1px solid #000000; width:160px;" align="left" valign="middle" bgcolor="#EAEAEA" ><font face="Arial Narrow" size="1" color="#000000">23. NAME OF CHILDREN</font></td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000;font-size:13px;" colspan="6" align="center" valign="middle" bgcolor="#FFFFFF"><i><font face="Arial Narrow">DATE OF BIRTH (mm/dd/yyyy)</font></i></td>
                    </tr>

                    <tr>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000"  align="right" valign="middle" bgcolor="#EAEAEA"  ><font face="Arial Narrow" size="1" color="#000000"></font></td>
                        <td colspan="2" style="border-right: 1px solid #000000; border-bottom: 1px solid #000000;border-right: 1px solid #000000" align="left" valign="middle" bgcolor="#EAEAEA"><font face="Arial Narrow" size="1" color="#000000">&nbsp; FIRST NAME</font></td>
                        <td style=" border-right: 1px solid #000000;border-bottom: 1px solid #000000" colspan="3" align="center" valign="middle" bgcolor="#FFFFFF" sdval="33105" sdnum="1033;1033;M/D/YYYY"><font face="Arial Narrow" color="#000000">&nbsp;'.$SpouseFirst.'</font></td>
                        <td colspan="2" rowspan="15" style="border-right: 1px solid #000000; border-bottom: 1px solid #000000;padding-left:2px;font-size:13px;" align="left" valign="top" bgcolor="#EAEAEA" ><font face="Arial Narrow"  color="#000000">
                        ';    
                        foreach ($rowsChildren as $rowChildren) {
        
                            $html=$html.'&nbsp; &nbsp; '.$rowChildren['childName'].'<br/>';
                            }
                                $html=$html.'</font></td>
                                    <td colspan="5" rowspan="13" style="border-right: 1px solid #000000; border-bottom: 1px solid #000000;padding-left:2px;font-size:13px;" align="left" valign="top" ><font face="Arial Narrow"  color="#000000">
                            
                                    ';
                                foreach ($rowsChildren as $rowChildren) {
                                    
                            $html=$html.'&nbsp; &nbsp; '.date("m/d/Y", strtotime($rowChildren['date_of_birth'])).'<br/>';
                            }
                                $html=$html.'
                            
                            </font></i></td>
                            </tr> 
                        
                    <tr>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000"  align="right" valign="middle" bgcolor="#EAEAEA"  ><font face="Arial Narrow" size="1" color="#000000"></font></td>
                        <td colspan="2" style="border-right: 1px solid #000000; border-bottom: 1px solid #000000;border-right: 1px solid #000000" align="left" valign="middle" bgcolor="#EAEAEA"><font face="Arial Narrow" size="1" color="#000000">&nbsp; MIDDLE NAME</font></td>
                        <td style=" border-right: 1px solid #000000;border-bottom: 1px solid #000000" colspan="3" align="center" valign="middle" bgcolor="#FFFFFF" sdval="33105" sdnum="1033;1033;M/D/YYYY"><font face="Arial Narrow" color="#000000">&nbsp;'.$SpouseMiddle.'</font></td>
                        
                    </tr>
                
                
                    <tr>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000"  align="right" valign="middle" bgcolor="#EAEAEA"  ><font face="Arial Narrow" size="1" color="#000000"></font></td>
                        <td colspan="2" style="border-right: 1px solid #000000; border-bottom: 1px solid #000000;border-right: 1px solid #000000" align="left" valign="middle" bgcolor="#EAEAEA"><font face="Arial Narrow" size="1" color="#000000">&nbsp; OCCUPATION</font></td>
                        <td style=" border-right: 1px solid #000000;border-bottom: 1px solid #000000" colspan="3" align="center" valign="middle" bgcolor="#FFFFFF" sdval="33105" sdnum="1033;1033;M/D/YYYY"><font face="Arial Narrow" color="#000000">&nbsp;'.$Occupation.'</font></td>
                        
                    </tr>
                
                
                    <tr>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000"  align="right" valign="middle" bgcolor="#EAEAEA"  ><font face="Arial Narrow" size="1" color="#000000"></font></td>
                        <td colspan="2" style="border-right: 1px solid #000000; border-bottom: 1px solid #000000;border-right: 1px solid #000000" align="left" valign="middle" bgcolor="#EAEAEA"><font face="Arial Narrow" size="1" color="#000000">EMPLOYER/BUSINESS NAME</font></td>
                        <td style=" border-right: 1px solid #000000;border-bottom: 1px solid #000000" colspan="3" align="center" valign="middle" bgcolor="#FFFFFF" sdval="33105" sdnum="1033;1033;M/D/YYYY"><font face="Arial Narrow" color="#000000">&nbsp;</font></td>
                        
                    </tr>
                
                
                    <tr>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000"  align="right" valign="middle" bgcolor="#EAEAEA"  ><font face="Arial Narrow" size="1" color="#000000"></font></td>
                        <td colspan="2" style="border-right: 1px solid #000000; border-bottom: 1px solid #000000;border-right: 1px solid #000000" align="left" valign="middle" bgcolor="#EAEAEA"><font face="Arial Narrow" size="1" color="#000000">&nbsp; BUSINESS ADDRESS</font></td>
                        <td style=" border-right: 1px solid #000000;border-bottom: 1px solid #000000" colspan="3" align="center" valign="middle" bgcolor="#FFFFFF" sdval="33105" sdnum="1033;1033;M/D/YYYY"><font face="Arial Narrow" color="#000000">&nbsp;</font></td>
                        </tr>
                
                
                    <tr>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000"  align="right" valign="middle" bgcolor="#EAEAEA"  ><font face="Arial Narrow" size="1" color="#000000"></font></td>
                        <td colspan="2" style="border-right: 1px solid #000000; border-bottom: 1px solid #000000;border-right: 1px solid #000000" align="left" valign="middle" bgcolor="#EAEAEA"><font face="Arial Narrow" size="1" color="#000000">MOBILE NO.</font></td>
                        <td style=" border-right: 1px solid #000000;border-bottom: 1px solid #000000" colspan="3" align="center" valign="middle" bgcolor="#FFFFFF" sdval="33105" sdnum="1033;1033;M/D/YYYY"><font face="Arial Narrow" color="#000000">&nbsp;'.$Mobile.'</font></td>    
                    </tr>
                
                
                    <tr>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000"  align="right" valign="middle" bgcolor="#EAEAEA"  ><font face="Arial Narrow" size="1" color="#000000">24.</font></td>
                        <td colspan="2" style="border-right: 1px solid #000000; border-bottom: 1px solid #000000;border-right: 1px solid #000000" align="left" valign="middle" bgcolor="#EAEAEA"><font face="Arial Narrow" size="1" color="#000000">FATHER\'S SURNAME</font></td>
                        <td style=" border-right: 1px solid #000000;border-bottom: 1px solid #000000" colspan="3" align="center" valign="middle" bgcolor="#FFFFFF" sdval="33105" sdnum="1033;1033;M/D/YYYY"><font face="Arial Narrow" color="#000000">&nbsp;'.$FatherFamily.'</font></td>
                        
                    </tr>
                
                
                    <tr>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000"  align="right" valign="middle" bgcolor="#EAEAEA"  ><font face="Arial Narrow" size="1" color="#000000"></font></td>
                        <td colspan="2" style="border-right: 1px solid #000000; border-bottom: 1px solid #000000;border-right: 1px solid #000000" align="left" valign="middle" bgcolor="#EAEAEA"><font face="Arial Narrow" size="1" color="#000000">FIRST NAME</font></td>
                        <td style=" border-right: 1px solid #000000;border-bottom: 1px solid #000000" colspan="3" align="center" valign="middle" bgcolor="#FFFFFF" sdval="33105" sdnum="1033;1033;M/D/YYYY"><font face="Arial Narrow" color="#000000">&nbsp;'.$FatherFirst.'</font></td>
                        
                    </tr>
                
                
                    <tr>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000"  align="right" valign="middle" bgcolor="#EAEAEA"  ><font face="Arial Narrow" size="1" color="#000000"></font></td>
                        <td colspan="2" style="border-right: 1px solid #000000; border-bottom: 1px solid #000000;border-right: 1px solid #000000" align="left" valign="middle" bgcolor="#EAEAEA"><font face="Arial Narrow" size="1" color="#000000">MIDDLE NAME</font></td>
                        <td style=" border-right: 1px solid #000000;border-bottom: 1px solid #000000" colspan="3" align="center" valign="middle" bgcolor="#FFFFFF" sdval="33105" sdnum="1033;1033;M/D/YYYY"><font face="Arial Narrow" color="#000000">&nbsp;'.$FatherMiddle.'</font></td>
                        
                    </tr>
                    <tr>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000"  align="right" valign="middle" bgcolor="#EAEAEA"  ><font face="Arial Narrow" size="1" color="#000000"></font></td>
                        <td colspan="2" style="border-right: 1px solid #000000; border-bottom: 1px solid #000000;border-right: 1px solid #000000" align="left" valign="middle" bgcolor="#EAEAEA"><font face="Arial Narrow" size="1" color="#000000">MOBILE NO.</font></td>
                        <td style=" border-right: 1px solid #000000;border-bottom: 1px solid #000000" colspan="3" align="center" valign="middle" bgcolor="#FFFFFF" sdval="33105" sdnum="1033;1033;M/D/YYYY"><font face="Arial Narrow" color="#000000">&nbsp;'.$Father_Mobile.'</font></td>    
                    </tr>
                
                
                    <tr>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000"  align="right" valign="middle" bgcolor="#EAEAEA"  ><font face="Arial Narrow" size="1" color="#000000">25.</font></td>
                        <td colspan="2" style="border-right: 1px solid #000000; border-bottom: 1px solid #000000;border-right: 1px solid #000000" align="left" valign="middle" bgcolor="#EAEAEA"><font face="Arial Narrow" size="1" color="#000000">MOTHER\'S MAIDEN NAME</font></td>
                        <td style=" border-right: 1px solid #000000;border-bottom: 1px solid #000000" colspan="3" align="center" valign="middle" bgcolor="#FFFFFF" sdval="33105" sdnum="1033;1033;M/D/YYYY"><font face="Arial Narrow" color="#000000"></font></td>
                        
                    </tr>
                
                
                    <tr>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000"  align="right" valign="middle" bgcolor="#EAEAEA"  ><font face="Arial Narrow" size="1" color="#000000"></font></td>
                        <td colspan="2" style="border-right: 1px solid #000000; border-bottom: 1px solid #000000;border-right: 1px solid #000000" align="left" valign="middle" bgcolor="#EAEAEA"><font face="Arial Narrow" size="1" color="#000000">SURNAME</font></td>
                        <td style=" border-right: 1px solid #000000;border-bottom: 1px solid #000000" colspan="3" align="center" valign="middle" bgcolor="#FFFFFF" sdval="33105" sdnum="1033;1033;M/D/YYYY"><font face="Arial Narrow" color="#000000">&nbsp;'.$MotherFamily.'</font></td>
                        
                    </tr>
                
                
                    <tr>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000"  align="right" valign="middle" bgcolor="#EAEAEA"  ><font face="Arial Narrow" size="1" color="#000000"></font></td>
                        <td colspan="2" style="border-right: 1px solid #000000; border-bottom: 1px solid #000000;border-right: 1px solid #000000" align="left" valign="middle" bgcolor="#EAEAEA"><font face="Arial Narrow" size="1" color="#000000">FIRST NAME</font></td>
                        <td style=" border-right: 1px solid #000000;border-bottom: 1px solid #000000" colspan="3" align="center" valign="middle" bgcolor="#FFFFFF" sdval="33105" sdnum="1033;1033;M/D/YYYY"><font face="Arial Narrow" color="#000000">&nbsp;'.$MotherFirst.'</font></td>
                        
                    </tr>
                
                    <tr>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000"  align="right" valign="middle" bgcolor="#EAEAEA"  ><font face="Arial Narrow" size="1" color="#000000"></font></td>
                        <td colspan="2" style="border-right: 1px solid #000000; border-bottom: 1px solid #000000;border-right: 1px solid #000000" align="left" valign="middle" bgcolor="#EAEAEA"><font face="Arial Narrow" size="1" color="#000000">MIDDLE NAME</font></td>
                        <td style=" border-right: 1px solid #000000;border-bottom: 1px solid #000000" colspan="3" align="center" valign="middle" bgcolor="#FFFFFF" sdval="33105" sdnum="1033;1033;M/D/YYYY"><font face="Arial Narrow" color="#000000">&nbsp;'.$MotherMiddle.'</font></td>
                        
                    </tr>

                    <tr>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000"  align="right" valign="middle" bgcolor="#EAEAEA"  ><font face="Arial Narrow" size="1" color="#000000"></font></td>
                        <td colspan="2" style="border-right: 1px solid #000000; border-bottom: 1px solid #000000;border-right: 1px solid #000000" align="left" valign="middle" bgcolor="#EAEAEA"><font face="Arial Narrow" size="1" color="#000000">MOBILE NO.</font></td>
                        <td style=" border-right: 1px solid #000000;border-bottom: 1px solid #000000" colspan="3" align="center" valign="middle" bgcolor="#FFFFFF" sdval="33105" sdnum="1033;1033;M/D/YYYY"><font face="Arial Narrow" color="#000000">&nbsp;'.$Mother_Mobile.'</font></td>    
                    </tr>   
         

                    <tr>
                        <td style="font-size:10px;font-weight:bold" colspan="14"><i><font face="Arial Narrow">
                        CSC Form No. 212<br>Revised 2017</font></i>
                        </td>
                    </tr>
                    
                    
                    
                    <tr>
                        <td style="font-size:9px" colspan="14" align="left" valign="top"><b><i><font color="#000000">Academic Background (Fill out ALL that is applicable): (Data will be used to counter check correctness of academic information) &nbsp;</font></i></b></td>
                        
                    </tr>
                    </table>
                 
                    
                    <table style="width:100%;" cellspacing="0">
                        <tr>
                            <td style="font-size:12px"  align="right" valign="middle" bgcolor="#EAEAEA"  ><font face="Arial Narrow"  color="#000000"><i>Signature over printed name</i></font></td>
                            
                        </tr>
                    </table>
                    ';
            
   /////////////////PAGE 2 ////////////////////

    

   

//==============================================================
//==============================================================
//==============================================================
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [215.9,330.2],'margin_left' => '5','margin_right' => '5','margin_top' => '0','margin_bottom' => '2','margin_header' => '2','margin_footer' => '2','orientation'=>'P']);
$mpdf->SetDisplayMode('fullpage');

$mpdf->WriteHTML($html);

// $mpdf->AddPage();
// $mpdf->WriteHTML($html2);

// $mpdf->AddPage();
// $mpdf->WriteHTML($html3);

// $mpdf->AddPage();
// $mpdf->WriteHTML($html4);

// $mpdf->AddPage();
// $mpdf->WriteHTML($html5);

$mpdf->list_indent_first_level = 0; 

//call watermark content and image

$mpdf->showWatermarkText = true;
$mpdf->watermarkTextAlpha = 0.1;

//output in browser
$mpdf->Output();		
?>