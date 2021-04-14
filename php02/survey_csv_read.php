<?php
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

$sql = 'SELECT * FROM survey';
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

if($status == false){
  $error = $stmt->errorInfo();
  exit('sqlError' . $error[2]);
  }else{
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $output = "";
    foreach($result as $record){
      $output .= "<tr>";
      $output .= "<td>{$record['your_name']}</td>";
      $output .= "<td>{$record['email']}</td>";
      $output .= "<td>{$record['age']}</td>";
      $output .= "<td>{$record['gender']}</td>";
      $output .= "<td>{$record['aspiration']}</td>";
      $output .= "</td>";
    }
  }

?>
