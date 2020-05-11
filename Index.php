<?php 

    /**
     * Open Source PHP Framework
     * QLipe
     * @copyright 2020 
     * @license GPL 3.0
     * @author Kittichai Mala-in
     * @link https://www.facebook.com/frammhe
     */

    /**
     * @var Q_APP
     * ในเชิงโปรแกรมมิ่งนั้นตัวแปรนี้จะใช้ในการตรวจสอบว่าผู้ใช้งานนั้นได้เข้าผ่าน Index.php หรือไม่
     */
    defined( 'Q_APP' ) or define( 'Q_APP' , '1.0.0' );

    /**
     * @var BASE_PATH
     * พาธที่เรียกตั้งแต่พาธแรกของตัวเว็บแอพพลิเคชั่น
     */
    defined( 'BASE_PATH' ) or define( 'BASE_PATH' , str_replace( DIRECTORY_SEPARATOR , '/' , realpath( dirname( __FILE__ ) ) ) . '/' );

    /**
     * @var SYSTEM_PATH
     * พาธสำหรับโฟลเดอร์ System
     */
    defined( 'SYSTEM_PATH' ) or define( 'SYSTEM_PATH' , BASE_PATH . 'System/' );

    /**
     * @var APP_PATH
     * พาธสำหรับโฟลเดอร์ Application
     */
    defined( 'APP_PATH' ) or define( 'APP_PATH' , BASE_PATH . 'Application/' );

    /**
     * @var APP_FOLDER_NAME
     * ใช้ตรวจสอบในโฟลเดอร์ Application ว่ารายชื่อโฟลเดอร์ใน Array มีจริงหรือไม่
     */
    defined( 'APP_FOLDER_NAME' ) or define( 'APP_FOLDER_NAME' , array(
        'Assets',
        'Config',
        'Public'
    ) );

    
    /**
     * 
     * ทำการตรวจสอบว่ารายชื่อโฟลเดอร์ใน @var APP_FOLDER_NAME มีจริงหรือไม่
     */
    $q_isdir = false;
    foreach( APP_FOLDER_NAME as $folder ) {
        if( is_dir( APP_PATH . $folder ) ) {
            $q_isdir = true;
        }
    }

    /**
     * 
     * ถ้าหากทั้งสามโฟลเดอร์ที่ทำการตรวจสอบไม่มีอยู่จริง
     * ระบบจะสั่งการให้หยุดการทำงานของเว็บไซต์ทันที
     */
    if( $q_isdir === FALSE ) exit( '<strong>เกิดข้อผิดพลาด :</strong> กรุณาตรวจสอบรายชื่อโฟลเดอร์ดังนี้ 1.Assets 2.Config และ 3.Public ในโฟลเดอร์ Application ถ้าหากไม่มีให้ทำการสร้าง 3 โฟลเดอร์นี้ขึ้นมา ' );

    
    /**
     * 
     * ไฟล์ Core หลักสำหรับเริ่มต้นทำงานของโปรแกรม
     */
    require_once SYSTEM_PATH . 'Core/QLipe.php';

?>
