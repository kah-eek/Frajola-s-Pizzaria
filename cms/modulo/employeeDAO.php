<?php

    function getEmployees(){
        $sql = "SELECT func.idFuncionario, func.nome, func.celular, func.telefone, func.email, func.sexo, func.cpf, func.dtNasc,func.salario, estcvl.estado_civil, prv.privilegio, usr.usuario, usr.senha, usr.foto_perfil
        FROM tbl_funcionario AS func
        INNER JOIN tbl_usuario AS usr ON usr.idFuncionario = func.idFuncionario
        INNER JOIN tbl_estado_civil AS estcvl ON estcvl.idEstadoCivil = func.idEstadoCivil
        INNER JOIN tbl_privilegio AS prv ON prv.idPrivilegio = usr.idPrivilegio";

        $query = mysql_query($sql);

        return mysql_fetch_array($query);
    }

    function getEmployeeById($employeeId){

        $sql = "SELECT func.idFuncionario, func.nome, func.celular, func.telefone, func.email, func.sexo, func.cpf, func.dtNasc,func.salario, estcvl.estado_civil, prv.privilegio, usr.usuario, usr.senha, usr.foto_perfil
        FROM tbl_funcionario AS func
        INNER JOIN tbl_usuario AS usr ON usr.idFuncionario = func.idFuncionario
        INNER JOIN tbl_estado_civil AS estcvl ON estcvl.idEstadoCivil = func.idEstadoCivil
        INNER JOIN tbl_privilegio AS prv ON prv.idPrivilegio = usr.idPrivilegio
        WHERE func.idFuncionario = ".$employeeId;

        $query = mysql_query($sql);

        return mysql_fetch_array($query);
    }

    function getEmployeeId($cpf){

        //GETTING EMPLOYEE'S ID
        $getEmployeeId = "SELECT idFuncionario FROM tbl_funcionario WHERE cpf = '".$cpf."'";
        $rs = mysql_query($getEmployeeId);

        $employeeId = mysql_fetch_array($rs);
        return $employeeId["idFuncionario"];
    }

    function existsCpf($cpf){
        $i = 0;

        $sql = "SELECT cpf FROM tbl_funcionario WHERE cpf = '".$cpf."'";

        $query = mysql_query($sql);

        while($rs = mysql_fetch_array($query)){
            $i++;
        }

        if($i == 0){
            return false;
        }else{
            return true;
        }
    }

    function deleteEmployeeById($employeeId){
      //TODO
    }

?>
