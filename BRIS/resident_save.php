<?php
require 'config/functions.php'; require 'config/database.php';
if($_SERVER['REQUEST_METHOD']!=='POST'){header('Location: residents.php');exit;} verify_token();
$id=(int)($_POST['id']??0);$first=trim($_POST['first_name']??'');$middle=trim($_POST['middle_name']??'');$last=trim($_POST['last_name']??'');$birth=trim($_POST['birth_date']??'')?:null;$sex=trim($_POST['sex']??'')?:null;$phone=trim($_POST['phone']??'')?:null;$email=trim($_POST['email']??'')?:null;$address=trim($_POST['address']??'');$house=(int)($_POST['household_id']??0)?:null;$status=$_POST['status']??'Active';
if(!$first||!$last||!$address||!in_array($status,['Active','Inactive','Moved','Deceased'],true)||($email&&!filter_var($email,FILTER_VALIDATE_EMAIL))){flash('Check required fields and email address.','danger');header('Location: '.($id?'resident_form.php?id='.$id:'resident_form.php'));exit;}
if($id){$s=$pdo->prepare('UPDATE residents SET first_name=?,middle_name=?,last_name=?,birth_date=?,sex=?,phone=?,email=?,address=?,household_id=?,status=? WHERE id=?');$s->execute([$first,$middle?:null,$last,$birth,$sex,$phone,$email,$address,$house,$status,$id]);flash('Resident record updated.');}
else{$s=$pdo->prepare('INSERT INTO residents(first_name,middle_name,last_name,birth_date,sex,phone,email,address,household_id,status) VALUES(?,?,?,?,?,?,?,?,?,?)');$s->execute([$first,$middle?:null,$last,$birth,$sex,$phone,$email,$address,$house,$status]);flash('Resident registered successfully.');}
header('Location: residents.php');exit;
