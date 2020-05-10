<?php

    defined( 'Q_APP' ) or die( 'คุณไม่มีสิทธิ์เข้าถึงไฟล์นี้โดยตรง' );

    use Medoo\Medoo;

    /**
     * 
     * Core Database.php
     * คลาสสำหรับจัดการฐานข้อมูล
     */

    require_once APP_PATH . 'Core/Medoo.php';

    class Database extends Medoo {
        
        public $db;
        public function __construct( array $database_info = DATABASE_INFO ) {
            try {
                $this->db = new Medoo( $database_info );
            } catch( Exception $e ) {
                die( '<strong>เกิดข้อผิดพลาด :</strong> ' . $e->getMessage() );
            }
        }

        public function get_instance() {
            return $this->db;
        }

        public function select( $table , $join , $columns = null , $where = null ) {
            return $this->db->select( $table , $join , $columns , $where);
        }

        public function insert( $table , $datas ) {
            return $this->db->insert( $table , $datas );
        }

        public function update( $table , $data , $where = null ) {
            return $this->db->update( $table , $data , $where );
        }

        public function delete( $table , $where ) {
            return $this->db->delete( $table, $where );
        }

        public function replace( $table , $columns , $where = null ) {
            return $this->db->replace( $table , $columns , $where );
        }

        public function get( $table , $join = null , $columns = null , $where = null ) {
            return $this->db->get( $table , $join , $columns , $where );
        }

        public function has( $table , $join , $where = null ) {
            return $this->db->has( $table , $join , $where );
        }

        public function rand( $table , $join = null , $columns = null , $where = null ) {
            return $this->db->rand( $table , $join , $columns , $where );
        }

        public function count( $table , $join = null , $column = null , $where = null ) {
            return $this->db->count( $table , $join , $column , $where );
        }

        public function max( $table , $join , $column = null , $where = null ) {
            return $this->db->max( $table , $join , $column , $where );
        }

        public function min( $table , $join , $column = null , $where = null ) {
            return $this->db->min( $table , $join , $column , $where );
        }

        public function avg( $table , $join , $column = null , $where = null ) {
            return $this->db->avg( $table , $join , $column , $where );
        }

        public function sum( $table , $join , $column = null , $where = null ) {
            return $this->db->sum( $table , $join , $column , $where );
        }

        public function id() {
            return $this->db->id();
        }

        public function create( $table , $columns , $options = null ) {
            return $this->db->create( $table , $columns , $options );
        }

        public function drop( $table ) {
            return $this->db->drop( $table );
        }

        public function query( $query , $map = [] ) {
            return $this->db->query( $query , $map );
        }

        public function debug() {
            return $this->db->debug();
        }

        public function error() {
            return $this->db->error();
        }

        public function log() {
            return $this->db->log();
        }

        public function last() {
            return $this->db->last();
        }

        public function info() {
            return $this->db->info();
        }

    }

?>