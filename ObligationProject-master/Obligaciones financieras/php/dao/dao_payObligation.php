<?php 
#Author: ristian Malaver
#Date: 30/10/2020
#Description : Is DAO Obligation
include "../class/connectionDB.php";
class DaoPayObligation


{
  private $objConntion;
  private $arrayResult;
  private $intValidatio;

  public function __construct()
  {
    $this->objConntion = new Connection();
    $this->arrayResult = array();
    $this->intValidatio;
  }
 
  #Description: Function list Bank
  #Date:30/10/2020
  #Author:Cristian Malaver
  public function selectBank()
  {
    try {
      $con = $this->objConntion->connect();
      $con->query("SET NAMES 'utf8'");
      if ($con != null) {
        if ($result = $con->query("SELECT * FROM bank")) {

          while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $this->arrayResult[] = $row;
          };
          mysqli_free_result($result);
        }
      }
      $con->close();
    } catch (Exception $e) {
      echo 'Exception captured: ', $e->getMessage(), "\n";
      $this->intValidatio = 0;
    }
    return json_encode($this->arrayResult);
  }
  #Description: Function list type obligation
  #Date:30/10/2020
  #Author:Cristian Malaver
  public function selectTypeObligation()
  {
    try {
      $con = $this->objConntion->connect();
      $con->query("SET NAMES 'utf8'");
      if ($con != null) {
        if ($result = $con->query("SELECT * FROM credit_type")) {

          while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $this->arrayResult[] = $row;
          };
          mysqli_free_result($result);
        }
      }
      $con->close();
    } catch (Exception $e) {
      echo 'Exception captured: ', $e->getMessage(), "\n";
      $this->intValidatio = 0;
    }
    return json_encode($this->arrayResult);
  }
    #Description: Function list type interes
  #Date:30/10/2020
  #Author:Cristian Malaver
  public function selectTypeInteres()
  {
    try {
      $con = $this->objConntion->connect();
      $con->query("SET NAMES 'utf8'");
      if ($con != null) {
        if ($result = $con->query("SELECT * FROM interesting_type")) {

          while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $this->arrayResult[] = $row;
          };
          mysqli_free_result($result);
        }
      }
      $con->close();
    } catch (Exception $e) {
      echo 'Exception captured: ', $e->getMessage(), "\n";
      $this->intValidatio = 0;
    }
    return json_encode($this->arrayResult);
  }
    #Description: Function list method amortization
  #Date:30/10/2020
  #Author:Cristian Malaver
  public function selectMethodAmortization()
  {
    try {
      $con = $this->objConntion->connect();
      $con->query("SET NAMES 'utf8'");
      if ($con != null) {
        if ($result = $con->query("SELECT * FROM amortization_type")) {

          while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $this->arrayResult[] = $row;
          };
          mysqli_free_result($result);
        }
      }
      $con->close();
    } catch (Exception $e) {
      echo 'Exception captured: ', $e->getMessage(), "\n";
      $this->intValidatio = 0;
    }
    return json_encode($this->arrayResult);
  }
  #Description: Function of query to maximo contract
  #Date:30/10/2020
  #Author:Cristian Malaver

  public function selectClientMaximo($user, $password)

  {
    try {
      $datos = json_decode(file_get_contents("https://rentingautomayor.maximo.com/maxrest/rest/os/RA_CLIENTE?_format=json&_lid=" . $user . "&_lpwd=" . $password . ""), true);
      $nit = "";
      $select = [];
      $nodatos[0] = "POR ENTREGAR";
      $nodatos[1] = "RENTING USAD";
      $nodatos[2] = "SINIESTRO";
      $nodatos[3] = "RENTENS";
      $nodatos[4] = "RENTNEW";
      $nodatos[5] = "RENTUSED";
      foreach ($datos as $key => $value) {

        $cliente = $value["RA_CLIENTESet"]["LOCATIONS"];
        for ($i = 0; $i < count($cliente); $i++) {
          if (isset($cliente[$i]["Attributes"]["DESCRIPTION"]["content"])) {
            $descripcion = ($cliente[$i]["Attributes"]["DESCRIPTION"]["content"]);
            $nit = ($cliente[$i]["Attributes"]["LOCATION"]["content"]);

            if ($nit != $nodatos[0] && $nit != $nodatos[1] && $nit != $nodatos[2] && $nit != $nodatos[3] && $nit != $nodatos[4] && $nit != $nodatos[5]) {

              array_push($select, array("Client_nit" => $nit, "Client_name" => $descripcion));
            }
          }
        }
      }
    } catch (Exception $e) {
      echo 'Exception captured: ', $e->getMessage(), "\n";
      $this->intValidatio = 0;
    }
    return json_encode($select);
  }

  public function selectContractMaximo($user, $password, $nit)
  {
    try {
      $datos = json_decode(file_get_contents("https://rentingautomayor.maximo.com/maxrest/rest/os/RA_CONTRATOS?_format=json&_lid=" . $user . "&_lpwd=" . $password . "&RACLIENTE=" . $nit . ""), true);
      $select = [];
      foreach ($datos as $key => $value) {

        $contrato = $value["RA_CONTRATOSSet"]["RA_CONTRATOCLIENTE"];
        for ($i = 0; $i < count($contrato); $i++) {
          if (isset($contrato[$i]["Attributes"]["DESCRIPTION"]["content"])) {
            $descripcion = ($contrato[$i]["Attributes"]["DESCRIPTION"]["content"]);
            $codeContrat = ($contrato[$i]["Attributes"]["RACODIGOCONTRATO"]["content"]);
            array_push($select, array("Contract_id" => $codeContrat, "Contract_name" => $descripcion));
          }
        }
      }
    } catch (Exception $e) {
      echo 'Exception captured: ', $e->getMessage(), "\n";
      $this->intValidatio = 0;
    }
    return json_encode($select);
  }

  //$obj = new DaoObligation();
  //echo $obj -> contractQuery("MAXADMIN", "Renting123*", "830058272");
  #Description: Function for get obligation
  #Date:30/10/2020
  #Author:Cristian Malaver
  public function getObligation()
  {
    try {
      $con = $this->objConntion->connect();
      $con->query("SET NAMES 'utf8'");
      if ($con != null) {
        if ($result = $con->query("SELECT obligation_cod,client_idmax,client_name,client_contract,OB.Bank_id,BA.Bank_name,obligation_id 
        FROM obligation OB
        INNER JOIN bank BA
        ON OB.Bank_id=BA.Bank_id 
        ORDER BY desembolso_date ASC")) {

          while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $this->arrayResult[] = $row;
          };
          mysqli_free_result($result);
        }
      }
      $con->close();
    } catch (Exception $e) {
      echo 'Exception captured: ', $e->getMessage(), "\n";
      $this->intValidatio = 0;
    }
    return json_encode($this->arrayResult);
  }
 
  public function getPayObligation($code)
  {
    try {
      $con = $this->objConntion->connect();
      $con->query("SET NAMES 'utf8'");
    
      if ($con != null) {
        if ($result = $con->query(" SELECT obligation_cod,initial_value,O.cuotes_number, pay_obligation_actual_cuote, pay_missing_cuotes, pay_Date ,pay_value FROM pay_obligation PO
        INNER JOIN obligation O 
        ON PO.obligation_id=O.obligation_id
        WHERE O.obligation_cod='$code'")) {

          while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $this->arrayResult[] = $row;
          };
          mysqli_free_result($result);
        }
      }
      $con->close();
    } catch (Exception $e) {
      echo 'Exception captured: ', $e->getMessage(), "\n";
      $this->intValidatio = 0;
    }
    return json_encode($this->arrayResult);
  }
  public function getObligationSearch($data)
  {
    try {
      $con = $this->objConntion->connect();
      $con->query("SET NAMES 'utf8'");
    
      if ($con != null) {
        if ($result = $con->query("SELECT obligation_cod,client_idmax,client_name,client_contract,OB.Bank_id,BA.Bank_name,obligation_id 
        FROM obligation OB
        INNER JOIN bank BA
        ON OB.Bank_id=BA.Bank_id 
        WHERE client_name LIKE '%$data%' OR client_idmax LIKE '%$data%' OR obligation_cod LIKE '%$data%'
        ORDER BY desembolso_date ASC")) {

          while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $this->arrayResult[] = $row;
          };
          mysqli_free_result($result);
        }
      }
      $con->close();
    } catch (Exception $e) {
      echo 'Exception captured: ', $e->getMessage(), "\n";
      $this->intValidatio = 0;
    }
    return json_encode($this->arrayResult);
  }
  #Description: Function for create a new obligation
  public function newObligation($objObligation)
  {
    try {
   
      $con = $this->objConntion->connect();
      $con->query("SET NAMES 'utf8'");
      if ($con != null) {
        $dataObligation = "'" . $objObligation->__getClient_idmax() . "','" .
          $objObligation->__getClient_name() . "','" .
          $objObligation->__getClient_contract() . "','" .
          $objObligation->__getBank_id() . "','" .
          $objObligation->__getCredit_type_id() . "','" .
          $objObligation->__getInteresting_type_id() . "','" .
          $objObligation->__getAmortization_type_id() . "','" .
          $objObligation->__getDesembolso_date() . "','" .
          $objObligation->__getInitial_value() . "','" .
          $objObligation->__getCuotes_number() . "','" .
          $objObligation->__getResidual_number() . "','" .
          $objObligation->__getDtf() . "','" .
          $objObligation->__getDtf_points() . "','" .
          $objObligation->__getIbr() . "','" .
          $objObligation->__getIbr_points() . "','" .
          $objObligation->__getTasafija() . "','" .
          $objObligation->__getStat_id() . "','" .
          $objObligation->__getObligation_cod() . "'";
         if ($con->query('INSERT INTO obligation ( client_idmax, client_name, client_contract, Bank_id, credit_type_id, 
         interesting_type_id, amortization_type_id, desembolso_date, initial_value, cuotes_number, 
         residual_number, dtf, dtf_points, ibr, ibr_points, fixed_rate,Stat_id, obligation_cod) VALUES ('. $dataObligation.')')) {
          $this->intValidatio = 1;
        } else {
          $this->intValidatio = 0;
        }
      }
      $con->close();
    } catch (Exception $e) {
      echo 'Exception captured: ', $e->getMessage(), "\n";
      $this->intValidatio = 0;
    }
    return $this->intValidatio;
  }
  #Description: Function for update obligation
  public function updateObligation($objObligation)
  {
    try {
      $con = $this->objConntion->connect();
      $con->query("SET NAMES 'utf8'");
      if ($con != null) {
        $dataObligation = "client_idmax='".$objObligation->__getClient_idmax() ."',
        client_name='" .$objObligation->__getClient_name() ."',
        client_contract='".$objObligation->__getClient_contract()."',
        client_contract_name='".$objObligation->__getClient_contract_name()."',
        Bank_id='".$objObligation->__getBank_id()."',
        credit_type_id='".$objObligation->__getCredit_type_id()."',
        interesting_type_id='".$objObligation->__getInteresting_type_id()."',
        amortization_type_id='".$objObligation->__getAmortization_type_id()."',
        desembolso_date='".$objObligation->__getDesembolso_date()."',
        initial_value='".$objObligation->__getInitial_value()."',
        cuotes_number='".$objObligation->__getCuotes_number()."',
        residual_number='".$objObligation->__getResidual_number()."',
        dtf='".$objObligation->__getDtf()."',
        dtf_points='".$objObligation->__getDtf_points()."',
        ibr='".$objObligation->__getIbr()."',
        ibr_points='".$objObligation->__getIbr_points()."',
        tasafija='".$objObligation->__getTasafija()."',
        Stat_id='".$objObligation->__getStat_id(). "'
        WHERE obligation_cod ='".$objObligation->__getObligation_cod();

        if ($con->query(  "UPDATE obligation SET ".$dataObligation."'" )) 
         
         { $this->intValidatio = 1;
        } else {
          $this->intValidatio = 0;
        }
      }
      $con->close();
    } catch (Exception $e) {
      echo 'Exception captured: ', $e->getMessage(), "\n";
      $this->intValidatio = 0;
    }
    return $this->intValidatio;
  }
  #Description: Function for delete obligation
  public function deleteObligation($objObligation)
  {
    try {
      $con = $this->objConntion->connect();
      $con->query("SET NAMES 'utf8'");
      if ($con != null) {

        $dataObligation = "WHERE obligation_cod ='".$objObligation->__getObligation_cod()."'";
       // echo "UPDATE obligation SET Stat_id = 4 ".$dataObligation;
        if ($con->query(  "UPDATE obligation SET Stat_id = 4 ".$dataObligation)) 
         
         { $this->intValidatio = 1;
        } else {
          $this->intValidatio = 0;
        }
      }
      $con->close();
    } catch (Exception $e) {
      echo 'Exception captured: ', $e->getMessage(), "\n";
      $this->intValidatio = 0;
    }
    return $this->intValidatio;
  }
}
