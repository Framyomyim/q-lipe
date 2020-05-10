<?php 

    defined( 'Q_APP' ) or die( 'คุณไม่มีสิทธิ์เข้าถึงไฟล์นี้โดยตรง' );

    /**
     * Config Url
     * เป็นไฟล์ตั้งค่าสำหรับเว็บไซต์ URL
     */

    /**
     * @var BASE_URL
     *  URL ของเว็บไซต์
     */
    define( 'BASE_URL' , 'http://localhost/htdocs/Q-Lipe/' );

    /**
     * @var UN_PERMISSION
     * File ที่ไม่สามารถเข้าได้โดยตรงในโฟลเดอร์ Public
     * จะเป็นไฟล์ที่สร้างไว้เพื่อดึงเข้ามาแสดงผล
     */
    define( 'UN_PERMISSION' , array(
        // ตัวอย่าง : 'php/welcome_page'
        // ดังนั้น URL http://localhost/Q-Lipe/php/welcome_page จะไม่สามารถใช้งานได้ (นอกเสียจากจะใช้ method load->php() เพื่อใช้งานเท่านั้น)
    ) );

?>