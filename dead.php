<?php  
$DBH =null;
try {
	$DBH = new PDO("mysql:host=localhost;dbname=pagination", 'root', '');
	//return $DBH;
} catch (PDOException $e) {
	echo $e->getMessage();
}

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$perpage = isset($_GET['per-page']) && $_GET['per-page']<=50 ? (int)$_GET['per-page'] : 5;
echo $start = ($page>1)? ($page*$perpage)-$perpage : 0;

$STH = $DBH->prepare("SELECT * FROM `articles` LIMIT $start, $perpage");
$STH->execute();
$data = $STH->fetchAll(PDO::FETCH_OBJ);
//echo json_encode($data);

$STH1 = $DBH->prepare("SELECT * FROM `articles`");
$STH1->execute();
$count = $STH1->rowCount();
$pages = ceil($count / $perpage);
echo $pages;
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php foreach ($data as $key): ?>
	<p><?= $key->id; ?>: <?= $key->title; ?></p>
<?php endforeach; ?>

<?php for ($i=1; $i <=$pages ; $i++):?>
	<a href="?page=<?= $i; ?>"><?= $i; ?></a>
<?php endfor; ?>
</body>
</html>