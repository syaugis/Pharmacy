<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'id' => 1,
            'name' => 'Captopril Indofarma 12.5mg ',
            'description' => 'Captopril Indofarma merupakan obat generik yang digunakan untuk mengurangi tekanan darah pada penderita hipertensi, gagal jantung kongestif, dan mengurangi kekambuhan dari stroke. ',
            'image' => 'captrofil.jpg',
            'price' => 181,
            'stock' => 23,
            'category_id' => 1,
            'store_id' => 1,
            'created_at' => '2023-10-10 09:46:44',
            'updated_at' => '2023-10-12 14:21:06'
        ]);

        Product::create([
            'id' => 2,
            'name' => 'Amoxicillin If 500mg ',
            'description' => 'Amoksisilin atau Amoxicillin Indo Farma merupakan obat antibiotika yang digunakan untuk mengatasi infeksi pada saluran pernafasan atas, infeksi saluran kemih, saluran cerna, kulit dan jaringan lunak. Amoksisilin (antibiotik golongan beta-laktam) adalah obat golongan penisilin yang bersifat bakteriolitik bekerja dengan cara menghambat sintesis dinding sel bakteri dengan memutus rantai polimer peptidoglikan sehingga tidak terbentuk.',
            'image' => 'amoxicillin.jpg',
            'price' => 592,
            'stock' => 43,
            'category_id' => 1,
            'store_id' => 1,
            'created_at' => '2023-10-10 11:22:01',
            'updated_at' => '2023-10-19 05:51:40'
        ]);

        Product::create([
            'id' => 3,
            'name' => 'Cefila 200mg ',
            'description' => 'Cefila merupakan antibiotik yang digunakan untuk mengatasi infeksi pada saluran pernafasan atas, infeksi saluran kemih dan kelamin, kulit dan jaringan lunak serta demam tifoid pada anak.\r\n\r\nCefila mengandung Cefixime yaitu antibiotik spektrum luas golongan Sefalosporin generasi ketiga yang aktif terhadap bakteri Gram negatif maupun Gram positif.\r\n\r\nCefixime bersifat bakteriosidal yang bekerja dengan cara mengikat satu atau lebih PBP (Penicillin-Binding Protein) pada sintesis dinding sel bakteri dengan memutus rantai polimer peptidoglikan sehingga tidak terbentuk. Hal tersebut dapat mengakibatkan kematian sel bakteri.',
            'image' => 'cefila.jpg',
            'price' => 42827,
            'stock' => 10,
            'category_id' => 1,
            'store_id' => 1,
            'created_at' => '2023-10-10 11:31:18',
            'updated_at' => '2023-10-16 19:57:51'
        ]);

        Product::create([
            'id' => 4,
            'name' => 'Asam Mefenamat Berno 500mg',
            'description' => 'Asam Mefenamat Berno adalah obat generik yang digunakan sebagai pereda nyeri, dismenore, nyeri ringan khususnya ketika pasien juga mengalami peradangan, dan mengurangi gangguan inflamasi (peradangan) secara umum. Asam Mefenamat termasuk dalam golongan Nonsteroidal Anti-Inflammatory Drug (NSAID) yang memiliki mekanisme kerja dalam mengatasi nyeri sebagai berikut: • Menghambat kerja dari enzim siklooksigenasi (COX) dimana enzim ini berfungsi dalam membantu pembentukan prostaglandin saat terjadinya luka dan menyebabkan rasa sakit serta peradangan. Ketika kerja enzim COX terhalangi, maka produksi prostaglandin lebih sedikit, sehingga rasa sakit dan peradangan akan berkurang.',
            'image' => 'asmef_berno.png',
            'price' => 434,
            'stock' => 50,
            'category_id' => 1,
            'store_id' => 1,
            'created_at' => '2023-10-10 11:31:18',
            'updated_at' => NULL
        ]);

        Product::create([
            'id' => 5,
            'name' => 'Gea Tensimeter Aneroid Mi-1001',
            'description' => 'Alat tensi jarum, untuk membantu mengukur tekanan dara.\r\n\r\nDengan melakukan pembelian produk Alat Kesehatan di K24klik maka Anda telah mengetahui cara penggunaan produk tersebut dengan benar. K24Klik tidak bertanggungjawab terhadap kerusakan produk Alat Kesehatan yang disebabkan karena kesalahan penggunaan oleh pelanggan. Batas waktu pengaduan produk Alat Kesehatan yang rusak adalah 2x24 jam sejak barang diterima pelanggan. ',
            'image' => 'aneroid.jpg',
            'price' => 129920,
            'stock' => 7,
            'category_id' => 2,
            'store_id' => 1,
            'created_at' => '2023-10-10 11:31:18',
            'updated_at' => '2023-10-16 19:57:51'
        ]);
    }
}
