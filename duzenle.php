 <?php 
include("mysql/mysqlCon.php"); // veritabanı bağlantımızı sayfamıza ekliyoruz. 
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Veritabanı İşlemleri</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

</head>
<body>

<?php 

$sonuc = $db->query("SELECT * FROM vehicles WHERE id =".(int)$_GET['id'])->fetch(PDO::FETCH_ASSOC); 
//id değeri ile düzenlenecek verileri veritabanından alacak sorgu


?>

<div class="container">
<div class="col-md-6">

<form action="" method="post">
    
    <table class="table">
        
        <tr>
            <td>Name</td>
            <td><input type="text" name="namex" class="form-control" value="<?php echo $sonuc['name']; 
                 // Veritabanından verileri çekip inputların içine yazdırıyoruz. ?>">
            </td>
        </tr>
		<tr>
            <td>Model</td>
            <td><input type="text" name="modelx" class="form-control" value="<?php echo $sonuc['model']; 
                 // Veritabanından verileri çekip inputların içine yazdırıyoruz. ?>">
            </td>
        </tr>
		<tr>
            <td>Price</td>
            <td><input type="text" name="pricex" class="form-control" value="<?php echo $sonuc['price']; 
                 // Veritabanından verileri çekip inputların içine yazdırıyoruz. ?>">
            </td>
        </tr>
		<tr>
            <td>Category</td>
            <td><input type="text" name="categoryx" class="form-control" value="<?php echo $sonuc['category']; 
                 // Veritabanından verileri çekip inputların içine yazdırıyoruz. ?>">
            </td>
        </tr>
       

        <tr>
            <td></td>
            <td><input type="submit" class="btn btn-primary" value="Kaydet"></td>
        </tr>

    </table>

</form>
</div>
<div>
<?php 


if ($_POST) { // Post olup olmadığını kontrol ediyoruz.
    
    $fname = $_POST['namex']; // Post edilen değerleri değişkenlere aktarıyoruz
    $fmodel = $_POST['modelx'];
	$fprice = $_POST['pricex'];
	$fcategory = $_POST['categoryx'];
    if ($fname<>"" && $fmodel<>"" && $fprice<>"" && $fcategory<>"") { // Veri alanlarının boş olmadığını kontrol ettiriyoruz.
        
        // Veri güncelleme sorgumuzu yazıyoruz.
        if($db->query("UPDATE vehicles SET name = '".$fname."', model = '".$fmodel."', price = '".$fprice."', category = '".$fcategory."' WHERE id =".$_GET['id'])) 
        {
			
            header("location:carjeck.php"); 
            echo $fname."<br>";
			echo $fmodel."<br>";
			echo $fprice."<br>";
			echo $fcategory."<br>";
			// Eğer güncelleme sorgusu çalıştıysa ekle.php sayfasına yönlendiriyoruz.
        }
        else
        {
            echo "Hata oluştu"; // id bulunamadıysa veya sorguda hata varsa hata yazdırıyoruz.
        }
    }
}

?>
</body>
</html>