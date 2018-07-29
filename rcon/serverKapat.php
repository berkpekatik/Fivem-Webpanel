<?php
   exec('c:\WINDOWS\system32\cmd.exe /c taskkill /f /im conhost.exe');
  exec('c:\WINDOWS\system32\cmd.exe /c taskkill /f /im cmd.exe');
  exec('c:\WINDOWS\system32\cmd.exe /c taskkill /f /im FXServer.exe');
  
	echo "<script>window.close();</script>";
?>