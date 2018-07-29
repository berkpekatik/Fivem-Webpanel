 <?php 

if ($_GET) 
{

include("mysql/mysqlCon.php"); // veritabanı bağlantımızı sayfamıza ekliyoruz.


if ($db->exec("DELETE FROM vehicles WHERE id =".(int)$_GET['id'])) 
{
    header("location:carjeck.php"); // Eğer sorgu çalışırsa ekle.php sayfasına gönderiyoruz.
}
}

?>