<?php


    class UserFeature{
        private $db;
        private $err;
        
        function __construct($con)
        {
            $this->db = $con;
        }


        function profile_update($id, $fname, $lname, $foto, $alamat, $kota, $provinsi, $kodepos){
            try{
            // if(isset($_POST['update'])){
            //     $id = $_SESSION['user_id'];
            //     $fname = $_POST['first_name'];
            //     $lname = $_POST['last_name'];
            //     $foto = $_POST['foto'];
            //     $alamat = $_POST['alamat'];
            //     $kota = $_POST['kota'];
            //     $provinsi = $_POST['provinsi'];
            //     $kodepos = $_POST['kodepos'];
            // }
                $stmt = $this->db->prepare("SELECT * FROM user WHERE user_id='$id'");
                $stmt->execute();
                $res = $stmt->get_result();

                if($res['user_id'] == $id){
                    $update = $this->db->prepare("UPDATE user SET first_name = $fname, last_name = $lname, foto = $foto, alamat = $alamat, kota = $kota, provinsi = $provinsi, kodepos = $kodepos");
                    $update->execute();

                    if($update){
                        //success
                        header("somewhere di lautan lepas");
                    }
                    else{
                        $this->err = "Profile tidak berhasil diperbaharui";
                        //not updated
                        header("somewhere di lautan lepas");
                    }
                }
            }
            catch(Exception $e){
                echo $e->getMessage();
                return false;
            }
        }

        public function getLastError(){
    
            return $this->err;
        }
    }
?>