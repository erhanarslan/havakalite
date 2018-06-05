<?php  

class Station {

	public function getStationData($id)
	{
		$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_PORT => "8091",
  CURLOPT_URL => "http://45.55.134.38:8091/station/data?idx=".$id,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",

));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  return "err";
} else {
  $data=gzinflate(base64_decode($response));

  return json_decode($data,true);
}

	}//func end


  public function calculatePm10($val)
  {
    if($val=='-')
    {
      return null;
    }else
   return ($val <=50) ? "rgba(43, 251, 0, 0.5)" :
  (($val <=70) ? "rgba(255, 254, 0, 0.5)" :
   (($val <=100) ? "rgba(254, 157, 0, 0.5)" :
    (($val <=120) ? "rgba(255, 0, 0, 0.5)" :
    (($val <=150) ? "rgba(97, 3, 128, 0.5)" : "rgba(97, 3, 77, 0.5)"))));
   }//calculatePm10 End

   public function getStationInfoAll()
   {
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_PORT => "8091",
      CURLOPT_URL => "http://45.55.134.38:8091/station/info",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
      echo "cURL Error #:" . $err;
    } else {
      $data=gzinflate(base64_decode($response));

      return json_decode($data,true);
    }
   }


}// class end

?>