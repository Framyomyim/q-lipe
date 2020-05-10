<?php 

    defined( 'Q_APP' ) or die( 'คุณไม่มีสิทธิ์เข้าถึงไฟล์นี้โดยตรง' );

    /**
     * 
     * Core App.php
     * คลาสสำหรับการเริ่มต้นโปรแกรม
     */

    class App {

        public $load = null;

        private $_key_core = array(
            'Load'
        );

        public function __construct() {
            foreach( $this->_key_core as $core ) {
                if( file_exists( SYSTEM_PATH . 'Core/' . $core . '.php' ) ) {
                    require_once SYSTEM_PATH . 'Core/' . $core . '.php';
                }
            }

            $this->set_ini();
        }

        public function set_ini() {
            $this->load = new Load;
        }

        public function render( callable $callback ,  $params = null ) {
            $callback( $params );
        }

    }

?>
