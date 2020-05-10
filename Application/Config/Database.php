<?php 

    defined( 'Q_APP' ) or die( 'คุณไม่มีสิทธิ์เข้าถึงไฟล์นี้โดยตรง' );

    /**
     * 
     * Config Database
     * ไฟล์สำหรับเก็บข้อมูลสำหรับเชื่อมต่อ ฐานข้อมูล
     */

    define( 'DATABASE_INFO' , [
        // สำคัญ
        'database_type' => 'mysql',
        'database_name' => 'webboard',
        'server' => 'localhost',
        'username' => 'root',
        'password' => '',
    
        // ทุกลิสต์ต่อไปนี้คือตัวเลือกเสริม
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_general_ci',
        'port' => 3306,
        'prefix' => '',
    
        // (ปกติจะเป็น false เนื่องจากจะสามารถทำงานได้เร็วขึ้น)
        'logging' => false,
        'socket' => '/tmp/mysql.sock',
        'option' => [
            PDO::ATTR_CASE => PDO::CASE_NATURAL
        ],

        'command' => [
            'SET SQL_MODE=ANSI_QUOTES'
        ]
    ] );

?>