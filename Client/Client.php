<?php

class info
{
    public $amountInSourceCurrency;

    public $sourceCurrency;

    public $targetCurrency;

}

class Client{

    public $instance = NULL;

    public function __construct()
    {
        $params = array(
            'location'=>'http://localhost/SAMT/Server.php?wsdl',
            'uri' =>  'urn://localhost/SAMT/Server.php?wsdl'  ,
            'trace'=>1,'cache_wsdl'=>WSDL_CACHE_NONE    );
        $this->instance =  new SoapClient(NULL, $params);
    }

    public function Money_Con($info_data)
    {
        return $this->instance->__soapCall('money_convert', [$info_data]);
    }

}

if(isset($_POST['submit']))
{
    $source_money_amount = $_POST['amount'];

    $source_money = $_POST['source'];

    $target_money = $_POST['target'];

    $client = new Client;

    $info_data = new info();

    $info_data->amountInSourceCurrency = $source_money_amount;

    $info_data->sourceCurrency = $source_money;

    $info_data->targetCurrency = $target_money;

    try
    {
        // $return_data = round($client->Money_Con($info_data),2);
        $return_data = $client->Money_Con($info_data);

        header('location: index.php?message= Server Output : '.$return_data);
    }
    catch (Exception $e)
    {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
}

?>