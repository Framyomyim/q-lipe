<?php 

    defined( 'Q_APP' ) or die( 'คุณไม่มีสิทธิ์เข้าถึงไฟล์นี้โดยตรง' );

    /**
     * 
     * Core Load.php
     * คลาสสำหรับการดึงไฟล์ต่างๆเช่น Core , Helper , JS , CSS , Public
     */

    class Load {
        
        /**
         * @method Load->core
         * @param $path พาธไฟล์ Core ที่ท่านจะเรียกใช้งาน
         */
        public function core( $path ) {
            if( file_exists( SYSTEM_PATH . 'Core/' . $path . '.php' ) ) {
                require_once SYSTEM_PATH . 'Core/' . $path . '.php';
            } else if( file_exists( APP_PATH . 'Core/' . $path . '.php' ) ) {
                require_once APP_PATH . 'Core/' . $path . '.php';
            } else {
                exit( '<strong>เกิดข้อผิดพลาด :</strong> ไม่พบไฟล์ Core ที่ท่านเรียกใช้งาน' );
            }

            return new $path();
        }

        /**
         * @method Load->helper
         * @param $path พาธไฟล์ Helper ที่ท่านจะเรียกใช้งาน
         */
        public function helper( $path ) {
            if( file_exists( SYSTEM_PATH . 'Helper/' . $path . '.php' ) ) {
                require_once SYSTEM_PATH . 'Helper/' . $path . '.php';
            } else if( file_exists( APP_PATH . 'Helper/' . $path . '.php' ) ) {
                require_once APP_PATH . 'Helper/' . $path . '.php';
            } else {
                exit( '<strong>เกิดข้อผิดพลาด :</strong> ไม่พบไฟล์ Helper ที่ท่านเรียกใช้งาน' );
            }

            return true;
        }

        /**
         * @method Load->php
         * @param $path พาธไฟล์ php ที่ท่านจะเรียกใช้งาน
         * โดย method นี้จะเรียกไฟล์ที่อยู่ใน โฟลเดอร์ Application/Public/
         */
        public function php( $path , $datas = null ) {
            if( file_exists( APP_PATH . 'Public/' . $path . '.php' ) ) {
                if( $datas != null ) {
                    
                    foreach( $datas as $data ) {
                        $varName = array_search( $data , $datas );
                        $varValue = $data;

                        if( isset( ${ $varName } ) ) {
                            exit( '<strong>เกิดข้อผิดพลาด :</strong> array() ชื่อ ' . $varName . ' ซ้ำกันตัวแปรอื่น' );
                        } else {
                            ${ $varName } = $varValue;
                        }
                    }
                    
                }
                require_once APP_PATH . 'Public/' . $path . '.php';
            } else {
                exit( '<strong>เกิดข้อผิดพลาด :</strong> ไม่พบไฟล์ PHP ที่ท่านเรียกใช้งาน' );
            }

            return true;
        }

        /**
         * @method Load->html
         * @param $path พาธไฟล์ html ที่ท่านจะเรียกใช้งาน
         * โดย method นี้จะเรียกไฟล์ที่อยู่ใน โฟลเดอร์ Application/Public/
         */
        public function html( $path , $datas = null ) {
            $html = '';
            if( file_exists( APP_PATH . 'Public/' . $path . '.html' ) ) {
                $html = file_get_contents( APP_PATH . 'Public/' . $path . '.html' );
                if( $datas != null ) {
                    $search = array();
                    $replace = array();

                    foreach( $datas as $data ) {
                        array_push( $search , array_search( $data , $datas ) );
                    }

                    foreach( $datas as $data ) {
                        array_push( $replace , $data );
                    }

                    $html = str_replace( $search , $data , $html );
                }
            } else {
                exit( '<strong>เกิดข้อผิดพลาด :</strong> ไม่พบไฟล์ HTML ที่ท่านเรียกใช้งาน' );
            }

            return $html;
        }

        /**
         * @method Load->javascript
         * @param $path พาธไฟล์ javascript ที่ท่านจะเรียกใช้งาน
         * โดย method นี้จะเรียกไฟล์ที่อยู่ใน โฟลเดอร์ Application/Assets/Js
         * @param $attributes เก็บข้อมูลแบบ Array โดยต้องกำหนด Array Key และ Values
         * Array Key = Attribute
         * Values = Value of Attribute
         */
        public function javascript( $path , $customLink = false , array $attributes = array() ) {
            $urlGet = '';

            if( $customLink === false ) {
                if( ! file_exists( APP_PATH . 'Assets/Js/' . $path . '.js' ) ) {
                    exit( '<strong>เกิดข้อผิดพลาด :</strong> ไม่พบไฟล์ JavaScript ที่ท่านเรียกใช้งาน' );
                } else {
                    $urlGet = BASE_URL . 'Application/Assets/Js/' . $path . '.js';
                }
            } else {
                $urlGet = $path;
            }

            $attr = '';
            foreach( $attributes as $atr ) {
                $attr .= array_search( $atr , $attributes ) . '="' . $atr . '" ';
            }

            return '<script src="' . $urlGet . '" '. $attr .'></script>';
        }

        /**
         * @method Load->css
         * @param $path พาธไฟล์ css ที่ท่านจะเรียกใช้งาน
         * โดย method นี้จะเรียกไฟล์ที่อยู่ใน โฟลเดอร์ Application/Assets/Css
         * @param $attributes เก็บข้อมูลแบบ Array โดยต้องกำหนด Array Key และ Values
         * Array Key = Attribute
         * Values = Value of Attribute
         */
        public function css( $path , $customLink = false , array $attributes = array() ) {
            $urlGet = '';

            if( $customLink === false ) {
                if( ! file_exists( APP_PATH . 'Assets/Css/' . $path . '.css' ) ) {
                    exit( '<strong>เกิดข้อผิดพลาด :</strong> ไม่พบไฟล์ CSS ที่ท่านเรียกใช้งาน' );
                } else {
                    $urlGet = BASE_URL . 'Application/Assets/Css/' . $path . '.css';
                }
            } else {
                $urlGet = $path;
            }

            $attr = '';
            foreach( $attributes as $atr ) {
                $attr .= array_search( $atr , $attributes ) . '="' . $atr . '" ';
            }

            return '<link rel="stylesheet" href="' . $urlGet . '" '. $attr .'>';
        }

        /**
         * @method Load->img
         * @param $path พาธไฟล์ img ที่ท่านจะเรียกใช้งาน
         * โดย method นี้จะเรียกไฟล์ที่อยู่ใน โฟลเดอร์ Application/Assets/Img
         * @param $attributes เก็บข้อมูลแบบ Array โดยต้องกำหนด Array Key และ Values
         * Array Key = Attribute
         * Values = Value of Attribute
         */
        public function img( $path , $customLink = false , array $attributes = array() ) {
            $urlGet = '';

            if( $customLink === false ) {
                if( ! file_exists( APP_PATH . 'Assets/Img/' . $path ) ) {
                    exit( '<strong>เกิดข้อผิดพลาด :</strong> ไม่พบไฟล์ รูปภาพ ที่ท่านเรียกใช้งาน' );
                } else {
                    $urlGet = BASE_URL . 'Application/Assets/Img/' . $path;
                }
            } else {
                $urlGet = $path;
            }

            $attr = '';
            foreach( $attributes as $atr ) {
                $attr .= array_search( $atr , $attributes ) . '="' . $atr . '" ';
            }

            return '<img src="' . $urlGet . '" ' . $attr . '>';
        }

    }

?>