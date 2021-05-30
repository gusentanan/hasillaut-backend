<?php

    namespace lib\products;

    use lib\products\productInterfaces\InProduct;
    use lib\products\ProductBase;
    use databases\DatabaseControl;
    use lib\admin\AdminData;

class Product implements InProduct{

        private $db;
        private $err;
        private $product;

        function __construct(DatabaseControl $db)
        {
            $this->db = $db;

        }

        public function addProduct(ProductBase $product)
        {
            $conn = $this->db->getConnection();
            $this->product = $product;

            try{
                $fotoProduct = $this->product->getFotoProduct();
                $namaProduct = $this->product->getNamaProduct();
                $hargaProduct = $this->product->getHargaProduct();
                $deskripsi = $this->product->getDescProduct();
                $kategori = $this->product->getKategori();
                $kodeProduct = $this->product->getKodeProduct();

                $stmt = $conn->prepare("INSERT INTO product (foto_Product, nama_product, harga_product, desc_product, kategori_product, kode_product) VALUES(?,?,?,?,?,?)");
                $stmt->bind_param("ssdsii", $fotoProduct, $namaProduct, $hargaProduct, $deskripsi, $kategori, $kodeProduct);
                $stmt->execute();

                return true;


            }catch(\Exception $e){
                 echo $e->getMessage();
                 return false;
            }
        }

        public function updateProduct(ProductBase $product)
        {
            $conn = $this->db->getConnection();
            $this->product = $product;

            try{
                $fotoProduct = $this->product->getFotoProduct();
                $namaProduct = $this->product->getNamaProduct();
                $hargaProduct = $this->product->getHargaProduct();
                $deskripsi = $this->product->getDescProduct();
                $kategori = $this->product->getKategori();
                $kodeProduct = $this->product->getKodeProduct();

                $productData = $this->getSingleProduct();
                $productID = $productData['product_id'];

                $stmt = $conn->prepare("UPDATE product SET foto_product=?, nama_product=?, harga_product=?, desc_product=?, kategori_product=?, kode_product=? WHERE product_id=?");
                $stmt->bind_param("ssisiii", $fotoProduct, $namaProduct, $hargaProduct, $deskripsi, $kategori, $kodeProduct, $productID);
                $stmt->execute();

                return true;


            }catch(\Exception $e){
                 echo $e->getMessage();
                 return false;
            }

            
        }

        public function deleteProduct()
        {
            $conn = $this->db->getConnection();

            try{
                if(isset($_GET['id'])){
                    $productID = $_GET['id'];
                    $stmt = $conn->prepare("DELETE FROM product WHERE product_id = ?");
                    $stmt->bind_param("i", $productID);
                    $stmt->execute();
                    
                    return true;
                }

            }catch(\Exception $e){
                $e->getMessage();
                return false;
            }
        }

        public function getSingleProduct(){
            $conn = $this->db->getConnection();
            
            try{
                if(isset($_GET['id'])){
                    $productID = $_GET['id'];
                    $stmt = $conn->prepare("SELECT * FROM product WHERE product_id = ?");
                    $stmt->bind_param("i", $productID);
                    $res = $stmt->execute();
                    $res = $stmt->get_result();

                    return $res->fetch_assoc();
                }

            }catch(\Exception $e){
                $e->getMessage();
                return false;
            }
        }



        public function getProductByIdAdmin($admin_id){
            $conn = $this->db->getConnection();

            try{
                $stmt = $conn->prepare("SELECT product_id, foto_product, nama_product, harga_product, desc_product, a.username_admin AS AdminPemilik, k.nama_kategori AS kategori FROM product
                                        JOIN admin AS a
                                            ON a.admin_id = product.kode_product
                                        JOIN kategori AS k
                                            ON k.kategori_id = product.kategori_product WHERE kode_product = ?");

                $stmt->bind_param("i", $admin_id);
                $res =$stmt->execute();

                $res = $stmt->get_result();
                

                return $res;

            }catch(\Exception $e){
                echo $e->getMessage();
                return false;
            }
        }

        public function getProductByKategori(){
            $conn = $this->db->getConnection();
            $kategori = $_GET['id'];
            try{
                $stmt = $conn->prepare("SELECT * FROM product WHERE kategori_product = ?");
                $stmt->bind_param("i", $kategori);
                $stmt->execute();

                $res = $stmt->get_result();

                return $res;


            }catch(\Exception $e){
                echo $e->getMessage();
                return false;
            }
        }

        public function getKategoriByID($kategori){
            $conn = $this->db->getConnection();

            try{
                $stmt = $conn->prepare("SELECT * FROM kategori WHERE kategori_id = ?");
                $stmt->bind_param("i", $kategori);
                $res = $stmt->execute();

                $res = $stmt->get_result();
                

                return $res->fetch_assoc();

            }catch(\Exception $e){
                echo $e->getMessage();
                return false;
            }
        
        }


        public function getKategori(){
            $conn = $this->db->getConnection();

            try{
                $stmt = $conn->prepare("SELECT * FROM kategori");
                $res = $stmt->execute();

                $res = $stmt->get_result();
                

                return $res;

            }catch(\Exception $e){
                echo $e->getMessage();
                return false;
            }
        }

        public function getAllProduct(){
            $conn = $this->db->getConnection();

            try{
                $stmt = $conn->prepare("SELECT *, k.nama_kategori AS kategori FROM product JOIN kategori AS k ON k.kategori_id = product.kategori_product");
                $stmt->execute();
                $res = $stmt->get_result();

                return $res;


            }catch(\Exception $e){
                echo $e->getMessage();
                return false;
            }
        }

        public function getProductByFilter($query){
            $conn = $this->db->getConnection();

            try{
                $stmt = $conn->prepare($query);
                $stmt->execute();

                $res = $stmt->get_result();

                return $res;

            }catch(\Exception $e){
                echo $e->getMessage();
                return false;
            }
        }

        public function getProductBySearch($search){
            $conn = $this->db->getConnection();

            try{
                $stmt = $conn->prepare("SELECT * FROM product JOIN kategori AS k ON k.kategori_id = product.kategori_product WHERE nama_product LIKE '%$search%';");
                $stmt->execute();

                $res = $stmt->get_result();

                return $res;

            }catch(\Exception $e){
                echo $e->getMessage();
                return false;
            }
        }

        public function totalInventory(){
            $conn = $this->db->getConnection();

            try{
                $stmt = $conn->prepare("SELECT SUM(product.harga_product) AS total_harga, kategori.nama_kategori FROM product JOIN kategori ON kategori.kategori_id = kategori_product GROUP BY kategori_product;");
                $stmt->execute();

                $res = $stmt->get_result();

                return $res;

            }catch(\Exception $e){
                echo $e->getMessage();
                return false;
            }
        }

        public function getLastError(){
            return $this->err;
        }

        
}

?>