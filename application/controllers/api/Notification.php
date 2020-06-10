<?php
defined('BASEPATH') or exit('No direct script access allowed');



class Notification extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }
        public function index()
    {
        $curl = curl_init();
        $status = 'pinjam';
        $get_token = $this->db->query("SELECT id_user_pjm, `user_pjm`.`token` FROM `peminjaman` JOIN `user_pjm` ON `user_pjm`.`id`=`peminjaman`.`id_user_pjm` WHERE `peminjaman`.`status` = 'pinjam'")->result_array();
        // var_dump($get_token);
        // die;
        foreach ($get_token as $value) {

            $registration_ids = '["' . $value['token'] . '"]';
        }
        //         var_dump($registration_ids);
        // die;
        $authKey = "key=AAAAOQQ1QLY:APA91bHLMtvfJPN6_4P6VarEiA8mVgOX0PWp6sgpVfF9YzCR5ztZz6tq_3VQoNmzSTV_QNapbuxPn1FPDHRlnOWiSgr8dUh8oTK_-MbCBewpKFKkTdW5uXgmkIeL10xXkD1BRjD6ADEL";

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => '{
  "registration_ids": ' . $registration_ids . ',
  "notification": {
      "title":"Peringatan!",
      "body":"Anda memiliki status peminjaman yang belum dikembalikan!"
  }
 
}',
            CURLOPT_HTTPHEADER => array(
                "authorization: " . $authKey,
                "cache-control: no-cache",
                "content-type: application/json"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $response;
        }
    }
}
