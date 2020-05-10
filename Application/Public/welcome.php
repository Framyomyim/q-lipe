<?php 
    defined( 'Q_APP' ) or die( 'คุณไม่มีสิทธิ์เข้าถึงไฟล์นี้โดยตรง' );
    $start = microtime( true );
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ยินดีต้อนรับเข้าสู่ Q Lipe - PHP Framework (Tiny & Fast)</title>
</head>
<body>

</body>
</html>
<?php 
    $end = microtime( true );
    $time_taken = ( $end - $start ) * 1000;
    $time_taken = round( $time_taken , 5 );
     
    echo "เวลาในการเปิดหน้าเว็บไซต์ : {$time_taken} วินาที.";
    
?>