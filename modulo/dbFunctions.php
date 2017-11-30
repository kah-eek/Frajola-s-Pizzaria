<?php

    //CONNECT TO DB pizzaria
    function connectToDB(){
        mysql_connect("localhost","root","bcd127");
        mysql_select_db("pizzaria");
    }

    function login($username, $password){
        $sql = "SELECT usuario,senha FROM tbl_usuario WHERE usuario = '".$username."' AND senha = '".$password."'";

        $query = mysql_query($sql);

        if(mysql_num_rows($query) != 0){
            return true;
        }else{
            return false;
        }
    }

    function getEmployeeByLogin($username,$password){
        $sql = "SELECT func.idFuncionario, func.nome, func.celular, func.telefone, func.email, func.sexo, func.cpf, func.dtNasc,func.salario, estcvl.estado_civil, prv.privilegio, usr.usuario, usr.senha, usr.foto_perfil
        FROM tbl_funcionario AS func
        INNER JOIN tbl_usuario AS usr ON usr.idFuncionario = func.idFuncionario
        INNER JOIN tbl_estado_civil AS estcvl ON estcvl.idEstadoCivil = func.idEstadoCivil
        INNER JOIN tbl_privilegio AS prv ON prv.idPrivilegio = usr.idPrivilegio
        WHERE usr.usuario = '".$username."' AND usr.senha = '".$password."'";

        $query = mysql_query($sql);

        if(mysql_num_rows($query) != 0){
            return mysql_fetch_array($query);
        }else{
            return -1;
        }
    }

    function getEmployeeIdByLogin($username,$password){
        $sql = "SELECT idFuncionario FROM tbl_usuario WHERE usuario = '".$username."' AND senha = '".$password."'";

        $query = mysql_query($sql);

        if(mysql_num_rows($query) != 0){
            return mysql_fetch_array($query);
        }else{
            return -1;
        }
    }

?>
