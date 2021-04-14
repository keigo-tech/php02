<?php

//情報の取得
$name = $_POST['name'];
$email = $_POST['email'];
$age = $_POST['age'];
$gender = $_POST['gender'];
$aspiration = $_POST['aspiration'];

//csvファイル作成
// DB接続情報
$dbn = 'mysql:dbname=ivorywolf6_phpkadai02;charset=utf8;port=3306;host=mysql57.ivorywolf6.sakura.ne.jp';
$user = 'ivorywolf6';
$pwd = '*********';

// DB接続
try {
  $pdo = new PDO($dbn, $user, $pwd);
} catch (PDOException $e) {
  echo json_encode(["db error" => "{$e->getMessage()}"]);
  exit();
}

$sql = "INSERT INTO survey(id,your_name,email,age,gender,aspiration) VALUES(null,:your_name,:email,:age,:gender,:aspiration)";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':your_name', $name, PDO::PARAM_STR);
$stmt->bindParam(':email', $email, PDO::PARAM_STR);
$stmt->bindParam(':age', $age, PDO::PARAM_STR);
$stmt->bindParam(':gender', $gender, PDO::PARAM_STR);
$stmt->bindParam(':aspiration', $aspiration, PDO::PARAM_STR);
$status = $stmt->execute();
// var_dump($_POST);
// exit();

if($status == false){
  $error = $stmt->errorInfo();
  exit('sqlError' . $error[2]);
}else{
  header('Location:survey_csv_input.php');
}
?>
