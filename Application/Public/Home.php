<?php 

    defined( 'Q_APP' ) or die( 'คุณไม่มีสิทธิ์เข้าถึงไฟล์นี้โดยตรง' );

    // ค่าเริ่มต้นสำหรับโปรแกรม

    $app = new App;
    $app::render( function( $datas ) use ( $app ) {
        $app->load->php( 'welcome' );
    } );

?>