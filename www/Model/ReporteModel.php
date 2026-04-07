<?php

require_once("../DataBase/DbConfig.php");



class ReporteModel
{

    public function  readOficina()
    {
        $db = new MyDB;
        $db->busyTimeout(5000);
      
        $sql = " SELECT * 
FROM OFICINA; ";

        $ret = $db->query($sql);
        return  $ret;
        
       
        $db->close();
    }


    public function  readRobo()
    {
        $db = new MyDB;
        $db->busyTimeout(5000);
        $sql = " SELECT * 
FROM ROBO; ";

        $ret = $db->query($sql);
        return  $ret;
        $db->close();
    }


    public function  readBaja()
    {
        $db = new MyDB;
        $db->busyTimeout(5000);
        $sql = " SELECT * 
FROM BAJA; ";

        $ret = $db->query($sql);
        return  $ret;
        $db->close();
    }
    public function  readIncorporacion()
    {
        $db = new MyDB;
        $db->busyTimeout(5000);
        $sql = " SELECT * 
FROM INCORPORACION; ";

        $ret = $db->query($sql);
        return  $ret;
        $db->close();
    }

    public function  readTodoFiltro()
    {
        $db = new MyDB;
        $db->busyTimeout(5000);
        $sql = " SELECT * 
FROM TODO_FILTRO; ";

        $ret = $db->query($sql);
        return  $ret;
        $db->close();
    }





}
