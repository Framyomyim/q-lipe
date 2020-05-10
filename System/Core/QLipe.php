<?php 

    defined( 'Q_APP' ) or die( 'คุณไม่มีสิทธิ์เข้าถึงไฟล์นี้โดยตรง' );

    /**
     * 
     * Core QLipe.php
     * จะทำการดึงไฟล์หลักที่จำเป็นและประมวลผลข้อมูล
     * เพื่อส่งข้อมูลหรือร้องขอไปที่ไฟล์หลักของ Public
     */

    /**
     * ทำการดึงไฟล์ Core หลัก
     */
    require_once SYSTEM_PATH . 'Core/App.php';


    /**
     * สร้างคลาสหลักในการประมวลผล  
     */ 
    class QLipe_Core {

        /** คุณสมบัติเซิร์ฟเวอร์ที่ต้องการ */
        private $_request = array(
            'PHP_VERSION'       =>      '6',
            'HTTPD_CONF'        =>      'mod_rewrite',
            'PHP_INI'           =>      'pdo'
        );

        /** คุณสมบัติเซิร์ฟเวอร์ของคุณ  */
        private $_client;
        public $_env;

        public function __construct() {

            /** กำหนดคุณสมบัติเซิร์ฟเวอร์  */
            $this->_client = array(
                'PHP_VERSION'       =>      phpversion(),
                'HTTPD_CONF'        =>      null,
                'PHP_INI'           =>      null
            );

            /**
             * ตรวจสอบเวอร์ชั่น PHP
             */
            if( ( int ) $this->_client[ 'PHP_VERSION' ] >= $this->_request[ 'PHP_VERSION' ] ) $this->_env['PHP_VERSION'] = true;
            else $this->_env['PHP_VERSION'] = false;

            /**
             * ตรวจสอบการเปิด mod_rewrite
             */
            if( function_exists( 'apache_get_modules' ) ) if( in_array( 'mod_rewrite' , apache_get_modules() ) ) $this->_env['HTTPD_CONF'] = true;
            else $this->_env['HTTPD_CONF'] = false;

            /**
             * ตรวจสอบการเปิด PDO
             */
            if( defined( 'PDO::ATTR_DRIVER_NAME' ) ) $this->_env['PHP_INI'] = true;
            else $this->_env['PHP_INI'] = false;

            $this->get_config();

            $this->get_loader();

            $requirement = true;
            foreach( $this->_env as $req ) {
                if( ! $req ) exit( '<strong>เกิดข้อผิดพลาด :</strong> คุณสมบัติต่างๆของคุณไม่พร้อมที่จะใช้งาน Q Lipe Framework' );
            }

            $url = isset( $_SERVER[ 'PATH_INFO' ] ) && ( substr( $_SERVER[ 'PATH_INFO' ] , 1 ) ) ? explode( '/' , substr( $_SERVER[ 'PATH_INFO' ] , 1 ) ) : null;
            $this->render_url( $url );

        }

        /** รายชื่อไฟล์ใน Application/Config */
        private $_configs = array(
            'Loader',
            'Route',
            'Url',
            'Database'
        );

        private function get_config() {
            // วนซ้ำเพื่อดึงข้อมูลใน $this->_configs
            foreach( $this->_configs as $srcName ) {
                // ตรวจสอบว่ามีไฟล์อยู๋จริงหรือไม่
                if( file_exists( APP_PATH . 'Config/' . $srcName . '.php' ) ) {
                    // ทำการ require ไฟล์เข้ามาใช้งาน
                    require_once APP_PATH . 'Config/' . $srcName . '.php';
                }
            }
        }

        private function get_loader() {
            // วนซ้ำเพื่อดึงไฟล์ Core ที่กำหนดไว้
            foreach( CORE_LOADER as $core ) {
                if( file_exists( APP_PATH . 'Core/' . $core . '.php' ) ) {
                    require_once APP_PATH . 'Core/' . $core . '.php';
                } else if( SYSTEM_PATH . 'Core/' . $core . '.php' ) {
                    require_once SYSTEM_PATH . 'Core/' . $core . '.php';
                }
            }

            // วนซ้ำเพื่อดึงไฟล์ Helper ที่กำหนดไว้
            foreach( HELPER_LOADER as $helper ) {
                if( file_exists( APP_PATH . 'Helper/' . $helper . '.php' ) ) {
                    require_once APP_PATH . 'Helper/' . $helper . '.php';
                } else if( SYSTEM_PATH . 'Helper/' . $helper . '.php' ) {
                    require_once SYSTEM_PATH . 'Helper/' . $helper . '.php';
                }
            }
        }

        private function render_url( $paths ) {
            if( $paths === null ) {
                // ใช้หน้าหลักที่ตั้งไว้ใน Config
                $defaultPath = DEFAULT_ROUTE;
                if( file_exists( APP_PATH . 'Public/' . $defaultPath . '.php' ) ) {
                    require_once APP_PATH . 'Public/' . $defaultPath . '.php';
                } else {
                    exit( "<strong>เกิดข้อผิดพลาด :</strong> กรุณาตรวจสอบไฟล์ {$defaultPath}.php ในโฟลเดอร์ Application/Public/ ว่ามีอยู่จริงหรือไม่" );
                }
            } else {
                // หาไฟล์ที่อยู่ในพาธ และเรียกใช้ไฟล์นั้น
                if( count( $paths ) > 1 ) {
                    $index = 0;
                    $listenDir = true;
                    $pathToRender = APP_PATH . 'Public/';
                    $checkUnPermission = '';
                    foreach( $paths as $named ) {
                        if( $listenDir === true ) {
                            if( is_dir( $pathToRender . $named ) ) {
                                $pathToRender .= $named . '/';
                                $checkUnPermission .= $named . '/';
                            } else if( is_file( $pathToRender . $named . '.php' ) ) {
                                $checkUnPermission .= $named;
                                if( in_array( $checkUnPermission , UN_PERMISSION ) ) {
                                    die( '<strong>เกิดข้อผิดพลาด :</strong> หน้าเว็บที่ท่านเรียกใช้งาน ถูกจำกัดสิทธิ์การเข้าถึง' );
                                } else {
                                    $pathToRender .= $named . '.php';
                                }
                            } else {
                                break;
                            }
                        } else {
                            break;
                        }

                        $index++;
                    }

                    // ลบ Array ที่เป็นพาธออก ให้เหลือแค่ Parameters
                    for( $i = 0; $i < $index; $i++ ) {
                        array_shift( $paths );
                    }

                    if( is_file( $pathToRender ) ) {
                        $_QLIPE = array();
                        foreach( $paths as $param ) {
                            array_push( $_QLIPE , $param );
                        }

                        require_once $pathToRender;
                    } else {
                        die(  "<strong>เกิดข้อผิดพลาด :</strong> หน้าเว็บที่ท่านเรียก ยังไม่มีในขณะนี้" );
                    }

                } else {
                    if( file_exists( APP_PATH . 'Public/' . $paths[0] . '.php' ) ) {
                        require_once APP_PATH . 'Public/' . $paths[0] . '.php';
                    } else {
                        exit( "<strong>เกิดข้อผิดพลาด :</strong> กรุณาตรวจสอบไฟล์ {$paths[0]}.php ในโฟลเดอร์ Application/Public/ ว่ามีอยู่จริงหรือไม่" );
                    }
                }
            }
        }

    }

    new QLipe_Core;

?>