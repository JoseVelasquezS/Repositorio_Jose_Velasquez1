<?php
#Author: cristian malaver
#Date: 30/10/2020
#Description : Is BO obligation
include "../dto/dto_obligation.php";
include "../dao/dao_obligation.php";
header("Content-type: application/json; charset=utf-8");
class BoObligation
{
  private $objObligation;
  private $objDao;
  private $intValidate;

  public function __construct()
  {
    $this->objObligation = new DtoObligation();
    $this->objDao = new DaoObligation();
  }

  #Description: Function for create a new obligation
  public function newObligation(
    $code,
    $name,
    $desembolso_date,
    $initial_value,
    $cuotes_number,
    $residual_number,
    $dtf,
    $dtf_points,
    $ibr,
    $ibr_points,
    $fixed_rate,
    $client_idmax,
    $client_contract,
    $Bank_id,
    $credit_type_id,
    $interesting_type_id,
    $amortization_method,
    $Stat_id
  ) {
    try {
      $this->objObligation->__setObligation(
        $code,
        $name,
        $desembolso_date,
        $initial_value,
        $cuotes_number,
        $residual_number,
        $dtf,
        $dtf_points,
        $ibr,
        $ibr_points,
        $fixed_rate,
        $client_idmax,
        $client_contract,
        $Bank_id,
        $credit_type_id,
        $interesting_type_id,
        $amortization_method,
        $Stat_id
      );
      $intValidate = $this->objDao->newObligation($this->objObligation);
    } catch (Exception $e) {
      echo 'Exception captured: ', $e->getMessage(), "\n";
      $intValidate = 0;
    }
    return $intValidate;
  }
  #Description: Function for update a new obligation
  public function updateObligation($nitMaximo, $ClientName, $clientContract, $clientContractName, $bank, $typeCredit, $typeInteres, $typeAmortization, $desembolsoDate, $initialValue, $cuotesNumber, $residualNumber, $dtf, $dtfPoints, $ibr, $ibrPoints, $tasafija, $status, $obligationCod)
  {
    try {
      $this->objObligation->__setUpdateObligation($nitMaximo, $ClientName, $clientContract, $clientContractName, $bank, $typeCredit, $typeInteres, $typeAmortization, $desembolsoDate, $initialValue, $cuotesNumber, $residualNumber, $dtf, $dtfPoints, $ibr, $ibrPoints, $tasafija, $status, $obligationCod);
      $intValidate = $this->objDao->updateObligation($this->objObligation);
    } catch (Exception $e) {
      echo 'Exception captured: ', $e->getMessage(), "\n";
      $intValidate = 0;
    }
    return $intValidate;
  }
  #Description: Function for create a new obligation
  public function deleteObligation($obligationCod)
  {
    try {
      $this->objObligation->__setCod($obligationCod);
      $intValidate = $this->objDao->deleteObligation($this->objObligation);
    } catch (Exception $e) {
      echo 'Exception captured: ', $e->getMessage(), "\n";
      $intValidate = 0;
    }
    return $intValidate;
  }

  #Description: Function list Bank
  public function selectBank()
  {
    try {
      $intValidate = $this->objDao->selectBank();
    } catch (Exception $e) {
      echo 'Exception captured: ', $e->getMessage(), "\n";
      $intValidate = 0;
    }
    return $intValidate;
  }
  #Description: Function list type obligation
  public function getTypeObligation()
  {
    try {
      $intValidate = $this->objDao->selectTypeObligation();
    } catch (Exception $e) {
      echo 'Exception captured: ', $e->getMessage(), "\n";
      $intValidate = 0;
    }
    return $intValidate;
  }
  #Description: Function list type interes
  public function getTypeInteres()
  {
    try {
      $intValidate = $this->objDao->selectTypeInteres();
    } catch (Exception $e) {
      echo 'Exception captured: ', $e->getMessage(), "\n";
      $intValidate = 0;
    }
    return $intValidate;
  }
  #Description: Function list method of amortization
  public function getMethodAmortization()
  {
    try {
      $intValidate = $this->objDao->selectMethodAmortization();
    } catch (Exception $e) {
      echo 'Exception captured: ', $e->getMessage(), "\n";
      $intValidate = 0;
    }
    return $intValidate;
  }

  #Description: Function select client to maximo
  public function selectClientMaximo()
  {
    try {
      $user = $this->objObligation->__getUser();
      $password = $this->objObligation->__getPassword();
      $intValidate = $this->objDao->selectClientMaximo($user, $password);
    } catch (Exception $e) {
      echo 'Exception captured: ', $e->getMessage(), "\n";
      $intValidate = 0;
    }
    return $intValidate;
  }
  #Description: Function select client to maximo
  public function selectContractMaximo($nit)
  {
    try {
      $user = $this->objObligation->__getUser();
      $password = $this->objObligation->__getPassword();
      $intValidate = $this->objDao->selectContractMaximo($user, $password, $nit);
    } catch (Exception $e) {
      echo 'Exception captured: ', $e->getMessage(), "\n";
      $intValidate = 0;
    }
    return $intValidate;
  }


  #Description: Function get obligation 
  public function getObligation()
  {
    try {
      $intValidate = $this->objDao->getObligation();
    } catch (Exception $e) {
      echo 'Exception captured: ', $e->getMessage(), "\n";
      $intValidate = 0;
    }
    return $intValidate;
  }
   #Description: Function get pay obligation 
   public function getPayObligation($code)
   {
     try {
       $intValidate = $this->objDao->getPayObligation($code);
     } catch (Exception $e) {
       echo 'Exception captured: ', $e->getMessage(), "\n";
       $intValidate = 0;
     }
     return $intValidate;
   }
  #Description: Function get obligation 
  public function getObligationSearch($dataSearch)
  {
    try {
      $intValidate = $this->objDao->getObligationSearch($dataSearch);
    } catch (Exception $e) {
      echo 'Exception captured: ', $e->getMessage(), "\n";
      $intValidate = 0;
    }
    return $intValidate;
  }
    #Description: Function get obligation 
    public function selectObligation($dataCode)
    {
      try {
        $intValidate = $this->objDao->selectObligation($dataCode);
      } catch (Exception $e) {
        echo 'Exception captured: ', $e->getMessage(), "\n";
        $intValidate = 0;
      }
      return $intValidate;
    }
}


$obj = new BoObligation();
/// We get the json sent
$getData = file_get_contents('php://input');
$data = json_decode($getData);

/**********CREATE ************/
if (isset($data->POST)) {
  if ($data->POST == "POST") {
    echo $obj->newObligation(
      $data->obligation_cod,
      $data->client_name,
      $data->desembolso_date,
      $data->initial_value,
      $data->cuotes_number,
      $data->residual_number,
      $data->dtf,
      $data->dtf_points,
      $data->ibr,
      $data->ibr_points,
      $data->fixed_rate,
      $data->client_idmax,
      $data->client_contract,
      $data->Bank_id,
      $data->credit_type_id,
      $data->interesting_type_id,
      $data->amortization_type_id,
      $data->Stat_id
    );
  }
  if ($data->POST == "POST_UPDATE") {
    echo $obj->updateObligation($data->nitMaximo, $data->ClientName, $data->clientContract, $data->clientContractName, $data->bank, $data->typeCredit, $data->typeInteres, $data->typeAmortization, $data->desembolsoDate, $data->initialValue, $data->cuotesNumber, $data->residualNumber, $data->dtf, $data->dtfPoints, $data->ibr, $data->ibrPoints, $data->tasafija, $data->status, $data->obligationCod);
  }
  if ($data->POST == "POST_DELETE") {
    echo $obj->deleteObligation($data->obligationCod);
  }
}

/**********READ AND CONSULT ************/
if (isset($data->GET)) {
  if ($data->GET == "GET") {
    echo $obj->selectObligation($data->obligation_cod);
  }
  if ($data->GET == "GET_LIST_BANK") {
    echo $obj->selectBank();
  }
  if ($data->GET == "GET_CLIENT_MAXIMO") {
    echo $obj->selectClientMaximo();
  }
  if ($data->GET == "GET_CLIENT_CONTRACT_MAXIMO") {
    echo $obj->selectContractMaximo($data->nit);
  }
  if ($data->GET == "GET_OBLIGATION") {

    echo $obj->getObligation();
  }
  if ($data->GET == "GET_OBLIGATION_SEARCH") {

    echo $obj->getObligationSearch($data->searchObligation);
  }
  if ($data->GET == "GET_TYPE_OBLIGATION") {
    echo $obj->getTypeObligation();
  }
  if ($data->GET == "GET_TYPE_INTERES") {
    echo $obj->getTypeInteres();
  }
  if ($data->GET == "GET_METHOD_AMORTIZATION") {
    echo $obj->getMethodAmortization();
  }
  if ($data->GET == "GET_PAY_OBLIGATION") {

    echo $obj->getPayObligation($data->$obligation_cod);
  }
}
/**********************/
//echo $obj->selectObligation("WDQWD34"); 
//echo $obj->getMethodAmortization(); 
//echo $obj->deleteObligation('WDQWD34'); 
//echo $obj->updateObligation('11141346111', 'Holas6456asa', 'CCP1dfsd1111', 'Holdfsa', '2', '2', '2', '2', '2020-08-15', '111121121', '41', '711928700', '0', '0',"3" ,"2", "0", 3,'WDQWD34'); 
//echo $obj->selectClientMaximo($user, $password); 