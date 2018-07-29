<?php

$config = array 
    ( 
    'ftp_user'  => 'x', 
    'ftp_pass'  => 'x', 
    'domain'    => 'x', 
    'file'      => 'x',       # relative to 'domain' 
    ); 

if(isset($_POST['submit'])) 
    { 
    $fp = fopen($config['file'],'w'); 
    fwrite($fp,stripslashes($_POST['newd'])); 
    fclose($fp); 

    $ftp = ftp_connect($config['domain']); 
    ftp_login($ftp,$config['ftp_user'],$config['ftp_pass']); 
    ftp_put($ftp,$config['file'],$config['file'],FTP_ASCII); 
    ftp_close($ftp); 
    } 

?>