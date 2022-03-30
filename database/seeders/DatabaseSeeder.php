<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use App\Models\Vision;
use App\Models\History;
use App\Models\Mission;
use App\Models\Service;
use App\Models\Commitee;
use App\Models\Division;
use App\Models\Position;
use App\Models\Shop_Item;
use App\Models\UM_Contact;
use App\Models\Social_Media;
use App\Models\Work_Program;
use App\Models\Product_Color;
use App\Models\Product_Price;
use App\Models\Management_Year;
use App\Models\Product_Gallery;
use App\Models\Maintenance_Info;
use App\Models\Product_Category;
use App\Models\Product_With_Color;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Database `db_himatif`
         */

        /* `db_himatif`.`commitees` */
        $commitees = array(
            array('id' => '1','name' => 'Muhammad Daifullah & M. Bagoes Prastya','photo' => '0d7a9500b8f60c419c0f0c2c54981491d6e1c8ab4417f535f8.png','position_id' => '3','division_id' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => '2','name' => 'Tiara Amalia & Vania Chasimira Sihotang','photo' => '85149c3992a4adf4fd03bdf6c3bd6ca6d712f27d7c16569a99.png','position_id' => '4','division_id' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => '3','name' => 'Nabila Rizka & Cut Nasywa Yumna','photo' => 'cfab4b5fb1d1beb8c2d1e780d8a069cfce86432140fdc3d86d.png','position_id' => '5','division_id' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => '4','name' => 'Yulia Citra Wardani','photo' => '1a00034cc04becc1650bf03c47cf3a7ae0303a1c4980c7b9cd.png','position_id' => '1','division_id' => '2','created_at' => NULL,'updated_at' => NULL),
            array('id' => '5','name' => 'Farhan Al Zuhri Nasution','photo' => '425b5176d01a2bb1fac0be1e636d675d20578809b7665413e7.png','position_id' => '2','division_id' => '2','created_at' => NULL,'updated_at' => NULL),
            array('id' => '6','name' => 'Fadel Majid Muhammad','photo' => '1f15b8936b0f61da7b77177ee58ffc65f0a4e9826a63e7f79b.png','position_id' => '2','division_id' => '2','created_at' => NULL,'updated_at' => NULL),
            array('id' => '7','name' => 'Geylfedra Matthew Panggabean','photo' => '48bbe23086ff0dd6f5da36235bd14b47cde454030467a955f8.png','position_id' => '2','division_id' => '2','created_at' => NULL,'updated_at' => NULL),
            array('id' => '8','name' => 'Andi Farras Thariq Hasibuan','photo' => '21b1c42f4276c29a37ff9da4c4fd186bdad9acbe1803a70795.png','position_id' => '2','division_id' => '2','created_at' => NULL,'updated_at' => NULL),
            array('id' => '9','name' => 'Arafah Nur Ihza','photo' => '555bba60e22d39b1b35a4b12a22eb6c4295ed31fa12b3ae6d9.png','position_id' => '2','division_id' => '2','created_at' => NULL,'updated_at' => NULL),
            array('id' => '10','name' => 'Anggi Yohanes Pardede','photo' => '7a52c27be79e4f0b59c0a35e1cb136dcbf468b5337e71d0c0e.png','position_id' => '2','division_id' => '2','created_at' => NULL,'updated_at' => NULL),
            array('id' => '11','name' => 'Christopher Miando Imanuel M.','photo' => '78a6b4fa9adef94e90c4c37387059a7e4086bae854ace39ead.png','position_id' => '2','division_id' => '2','created_at' => NULL,'updated_at' => NULL),
            array('id' => '12','name' => 'Hari Darmawan','photo' => 'bd8539a9131289d58b79204ea6add7a0b701c07ba48d24f4fd.png','position_id' => '1','division_id' => '3','created_at' => NULL,'updated_at' => NULL),
            array('id' => '13','name' => 'Amira Nurul Amanda','photo' => '3722d80d3491c1ff35dd3625b25500096abae27175d0f2f3fe.png','position_id' => '2','division_id' => '3','created_at' => NULL,'updated_at' => NULL),
            array('id' => '14','name' => 'Hafiza Azhar','photo' => 'b302b9101a8aba6b576792bac90df8c0ed685925520603f4fa.png','position_id' => '2','division_id' => '3','created_at' => NULL,'updated_at' => NULL),
            array('id' => '15','name' => 'Helmut Sharon P.','photo' => '658fa9c478255c6f164f1afa8dfdc73b5b212e701591973a6c.png','position_id' => '2','division_id' => '3','created_at' => NULL,'updated_at' => NULL),
            array('id' => '16','name' => 'Mhd. Luthfi Yandirsyah','photo' => '6275e20753e8d0f9f32cb5834d4eac7b082df2e03e80c114fd.png','position_id' => '2','division_id' => '3','created_at' => NULL,'updated_at' => NULL),
            array('id' => '17','name' => 'Haiqal Rizky Ramadhan','photo' => 'e164ccf101a83fc4af7eecb1e91e49217ed631c8e92c863c07.png','position_id' => '2','division_id' => '3','created_at' => NULL,'updated_at' => NULL),
            array('id' => '18','name' => 'Bella Fransiska Rejeki S.','photo' => '80ca1dd0b6ed133dd34e4acbfe8809c7122cd15f1ca365e4e5.png','position_id' => '2','division_id' => '3','created_at' => NULL,'updated_at' => NULL),
            array('id' => '19','name' => 'Rizka Annisa Hidayat','photo' => '354132e7908ecfb8d9d0f07da57dab3eb29b4721539cc8fe10.png','position_id' => '2','division_id' => '3','created_at' => NULL,'updated_at' => NULL),
            array('id' => '20','name' => 'Fildzah Alifia Lubis','photo' => '5dc2c6a724ac56a2b95c66e4eb63654c4ffbc114baa5cd6951.png','position_id' => '2','division_id' => '3','created_at' => NULL,'updated_at' => NULL),
            array('id' => '21','name' => 'Yehezkiel Edininta Simanjuntak','photo' => 'a94dfece5c3310290af8d90974c2285b1104211235f6e98d18.png','position_id' => '1','division_id' => '4','created_at' => NULL,'updated_at' => NULL),
            array('id' => '22','name' => 'Joyful Martupa Banjarnahor','photo' => '6b6bc0f953857d9d96d76dae6fbf38a533ef807605e629d50d.png','position_id' => '2','division_id' => '4','created_at' => NULL,'updated_at' => NULL),
            array('id' => '23','name' => 'Amelya Batubara','photo' => '32feed521073fd39b03e91796d00b784ef461e42cb3ef4d179.png','position_id' => '2','division_id' => '4','created_at' => NULL,'updated_at' => NULL),
            array('id' => '24','name' => 'Albert','photo' => '0581bf5af6d41ff4ad8b3f9efc78c42cd7ccfa9f4394b0ba15.png','position_id' => '2','division_id' => '4','created_at' => NULL,'updated_at' => NULL),
            array('id' => '25','name' => 'Angeli Rinawati Silaban','photo' => '34cefff8e5631ab8c15c0091b66392195002ac7705457c0f2e.png','position_id' => '2','division_id' => '4','created_at' => NULL,'updated_at' => NULL),
            array('id' => '26','name' => 'Iqbal Fakhriza','photo' => '56d104d3b66c46e7e0a279220f27307466253aa347410ebc7a.png','position_id' => '2','division_id' => '4','created_at' => NULL,'updated_at' => NULL),
            array('id' => '27','name' => 'Margaretha Gok Ashi Naibaho','photo' => '5af928840cce2ca3581640b1b5c7ed78c4623ff089f7dd26ca.png','position_id' => '2','division_id' => '4','created_at' => NULL,'updated_at' => NULL),
            array('id' => '28','name' => 'Mhd. Arsya Fikri','photo' => '0f4c0f150a9cda521abd3e628b9ff974b7e8c22867e4119737.png','position_id' => '2','division_id' => '4','created_at' => NULL,'updated_at' => NULL),
            array('id' => '29','name' => 'Astrid Nainggolan','photo' => '18d37a182925116dae0bc1ec68ce43407879b9289f0447898c.png','position_id' => '1','division_id' => '5','created_at' => NULL,'updated_at' => NULL),
            array('id' => '30','name' => 'Mukhsalmina','photo' => 'df726e308cb35f68282405696718c77a7adbcef1e7d13ed14c.png','position_id' => '2','division_id' => '5','created_at' => NULL,'updated_at' => NULL),
            array('id' => '31','name' => 'Nanda Ambiya','photo' => '486186329c05b429c3e1cf2bd36fc502987c2c6015468cc8b5.png','position_id' => '2','division_id' => '5','created_at' => NULL,'updated_at' => NULL),
            array('id' => '32','name' => 'Aulia Rahman Partomuan Sihite','photo' => '66f6e3b78cecfc2e4e4cef06009e9cfe3bfad6172609c4926a.png','position_id' => '2','division_id' => '5','created_at' => NULL,'updated_at' => NULL),
            array('id' => '33','name' => 'Nada Salsabila','photo' => '4f9d732240c555df145cc3c30d726a2d57be9624deb727c527.png','position_id' => '2','division_id' => '5','created_at' => NULL,'updated_at' => NULL),
            array('id' => '34','name' => 'Irsyad Fauzi','photo' => 'e96f5ac2e941b51a718897b3c46d66c950801bc21d393b5a2f.png','position_id' => '2','division_id' => '5','created_at' => NULL,'updated_at' => NULL),
            array('id' => '35','name' => 'Huzaifah M. Lais Lubis','photo' => '22247e84d5c92bf39f005329577785cf76c85aee827a6400b6.png','position_id' => '2','division_id' => '5','created_at' => NULL,'updated_at' => NULL),
            array('id' => '36','name' => 'Annisa Putri Daulay','photo' => '8af30fe3793ead93345595e006beca04cf53c093c159700b24.png','position_id' => '2','division_id' => '5','created_at' => NULL,'updated_at' => NULL),
            array('id' => '37','name' => 'T. Muhammad Javier Albar','photo' => '25ad38ce06d5f91add22ec86ec0ceddffda4d36f0f9dc49320.png','position_id' => '2','division_id' => '5','created_at' => NULL,'updated_at' => NULL),
            array('id' => '38','name' => 'Naldo Yohardi','photo' => '83680a81ff9f1bbb93dce545c8f58de04acf4f0990c918c026.png','position_id' => '1','division_id' => '9','created_at' => NULL,'updated_at' => NULL),
            array('id' => '39','name' => 'Indah','photo' => '6764ab3888b81f0d25c76beb8564cc9ecdd08c622b64b1ad61.png','position_id' => '2','division_id' => '9','created_at' => NULL,'updated_at' => '2022-03-29 14:05:46'),
            array('id' => '40','name' => 'Karvin Halim','photo' => 'e62f71a0dd441de916c86a77b71b0f240ffbcdc71aa6913046.png','position_id' => '2','division_id' => '9','created_at' => NULL,'updated_at' => NULL),
            array('id' => '41','name' => 'Michael','photo' => 'f1d00f75ff165fde96a7807a28028448681793651e765c1a1d.png','position_id' => '2','division_id' => '9','created_at' => NULL,'updated_at' => NULL),
            array('id' => '42','name' => 'Shelli Athaya','photo' => '214101cd0b722ef124a70720fa4d95ebf169fc0638336591f2.png','position_id' => '1','division_id' => '6','created_at' => NULL,'updated_at' => NULL),
            array('id' => '43','name' => 'Michelle Christine Natalia P.','photo' => '49dcce8291a48ffbdefffdf43e55b1fe8416c9c41276a56dd0.png','position_id' => '2','division_id' => '6','created_at' => NULL,'updated_at' => NULL),
            array('id' => '44','name' => 'Agnes T. Manurung','photo' => '9374c456dd690b623f56cdf0a5ad5bbcbbe5ed9e85fcefa228.png','position_id' => '2','division_id' => '6','created_at' => NULL,'updated_at' => NULL),
            array('id' => '45','name' => 'Kesia Ruth Sandra Purba','photo' => 'e72ed23cbfc1a372abb32d0acfb7f52d8d2e597440c6af2320.png','position_id' => '2','division_id' => '6','created_at' => NULL,'updated_at' => NULL),
            array('id' => '46','name' => 'Masayu Fany Shapura','photo' => 'f56f1358ee597722b37b6aa377c62dbfb30ecdc1f2e4bdfb58.png','position_id' => '2','division_id' => '6','created_at' => NULL,'updated_at' => NULL),
            array('id' => '47','name' => 'Vania Miranda Emmanuela S.','photo' => '88d26d03526af4a28fbdce645810fb31cab8dc95593e645591.png','position_id' => '2','division_id' => '6','created_at' => NULL,'updated_at' => NULL),
            array('id' => '48','name' => 'Fadhil Zuhairsyah','photo' => '634fcad7587bc95cdda3c2a4d2a0de11f04ce9423fd2385ec7.png','position_id' => '2','division_id' => '6','created_at' => NULL,'updated_at' => NULL),
            array('id' => '49','name' => 'Naufal Baginda Zuhdi S.','photo' => 'e7f65ccc9ed8399bec1693ef39ef01d8ece89f3ce33d33abbc.png','position_id' => '2','division_id' => '6','created_at' => NULL,'updated_at' => NULL),
            array('id' => '50','name' => 'Muhammad Ridwan','photo' => '7fbd7986823b4825450098e2dfef05f7964d4009056027021c.png','position_id' => '1','division_id' => '7','created_at' => NULL,'updated_at' => NULL),
            array('id' => '51','name' => 'M. Eldwin Pasaribu','photo' => 'ba6bb272c5e4a9246d5f71716e3d886be49dbff54763349f5c.png','position_id' => '2','division_id' => '7','created_at' => NULL,'updated_at' => NULL),
            array('id' => '52','name' => 'Indriyani Sembiring','photo' => 'cd0c9ee628433f67c1f71f026b0956498878eadc1ebf1d05f5.png','position_id' => '2','division_id' => '7','created_at' => NULL,'updated_at' => NULL),
            array('id' => '53','name' => 'Sity Fadia Al Haya Maswin','photo' => '3c921f217754068422c6f142a5deb11765491cacadc926cf6f.png','position_id' => '2','division_id' => '7','created_at' => NULL,'updated_at' => NULL),
            array('id' => '54','name' => 'Lira Savina','photo' => 'c94eeea56b177b6e083f30cc213f85b5646b6d2e790cbff415.png','position_id' => '2','division_id' => '7','created_at' => NULL,'updated_at' => NULL),
            array('id' => '55','name' => 'Muhammad Zikri Ihsan','photo' => '1d4cc483cf6ad35aa44ce879ea923b99a71eea2b3003fba15e.png','position_id' => '2','division_id' => '7','created_at' => NULL,'updated_at' => NULL),
            array('id' => '56','name' => 'Dwiki Affandi','photo' => '2d0692e8d2fda09b33bb5aea11b172adaab342b8394d7090d6.png','position_id' => '2','division_id' => '7','created_at' => NULL,'updated_at' => NULL),
            array('id' => '57','name' => 'Felix Glenaldi Hutahaean','photo' => '1a0413d347fb9ecfc742be466359f457dc90002bc6129b8897.png','position_id' => '1','division_id' => '8','created_at' => NULL,'updated_at' => NULL),
            array('id' => '58','name' => 'Yoel Hezron Paulitua Simarmata','photo' => '771897d557c2be4bfd6696135ddd66d1f49c514d1cfa5c9e18.png','position_id' => '2','division_id' => '8','created_at' => NULL,'updated_at' => NULL),
            array('id' => '59','name' => 'Rini Royanti Marbun','photo' => '3986d8ff708ce2641a03ff44ec391501571bf609c9b62c9fce.png','position_id' => '2','division_id' => '8','created_at' => NULL,'updated_at' => NULL),
            array('id' => '60','name' => 'Sheren Alvionita Siahaan','photo' => '1c46b4ef36647169ac02378d60c3ef77f48b32464c08234f4a.png','position_id' => '2','division_id' => '8','created_at' => NULL,'updated_at' => NULL),
            array('id' => '61','name' => 'Dhea Novianty Sitompul','photo' => '5fa80e5adbc574101a6291ef1a4e4a3200fa5a361762b117db.png','position_id' => '2','division_id' => '8','created_at' => NULL,'updated_at' => NULL),
            array('id' => '62','name' => 'Sarah Theodora Sinurat','photo' => 'fd6f33eb149db6b063b7c418e99b1c0ba12a1884cf8ae04fb7.png','position_id' => '2','division_id' => '8','created_at' => NULL,'updated_at' => NULL),
            array('id' => '63','name' => 'Vincent Sirait','photo' => '05e177c33f19573329d8c3d84a9c792319dc45efa92554c9e4.png','position_id' => '2','division_id' => '8','created_at' => NULL,'updated_at' => NULL),
            array('id' => '64','name' => 'Grace Ogestin Pasaribu','photo' => '269e15a8a259a5e40308662a769b7b7fa012fcc5c8649da85a.png','position_id' => '2','division_id' => '8','created_at' => NULL,'updated_at' => NULL),
            array('id' => '65','name' => 'Yohana M. Beatrice Panjaitan','photo' => '21fff4edbe4de02bfe044150603fcd724b599249b029d33890.png','position_id' => '2','division_id' => '8','created_at' => NULL,'updated_at' => NULL),
            array('id' => '67','name' => 'Teruna Tegar','photo' => '67d72bd84fa6bbe969ee3939ac2c89ba2427b9fab0e723b532.png','position_id' => '6','division_id' => '2','created_at' => NULL,'updated_at' => NULL),
            array('id' => '68','name' => 'Nayla Rahmi','photo' => '1023ebbe9e2fab9060facf7b15578f30d35a24a96712c0a30d.png','position_id' => '6','division_id' => '2','created_at' => NULL,'updated_at' => NULL),
            array('id' => '69','name' => 'Muhammad Iqbal','photo' => '556a9178e0f87b337d5912913f64097ac2e86949ae9fd91822.png','position_id' => '6','division_id' => '3','created_at' => NULL,'updated_at' => NULL),
            array('id' => '70','name' => 'Vanissya Arbashika','photo' => '4519ed1316bdd5611c14bd2b0de1a8020c3da7c75632f71d23.png','position_id' => '6','division_id' => '3','created_at' => NULL,'updated_at' => NULL),
            array('id' => '71','name' => 'Christine Amanda','photo' => '9a7293c67bdf66d7ec332a9bed81645779180c4ef8c879d925.png','position_id' => '6','division_id' => '4','created_at' => NULL,'updated_at' => NULL),
            array('id' => '72','name' => 'M. Arief Fadhlan','photo' => '144f19b21010fc5abd348301ff8c6d3671aeb30b7ddb80217a.png','position_id' => '6','division_id' => '4','created_at' => NULL,'updated_at' => NULL),
            array('id' => '73','name' => 'Azriel Giantovani','photo' => '9cae663c3071a33e23ef37f17aa9043f4bd24e1a5d14c7e43d.png','position_id' => '6','division_id' => '5','created_at' => NULL,'updated_at' => NULL),
            array('id' => '74','name' => 'Wahyu Sony','photo' => 'a4290bcfa6c7745eb40c711c047e682c7249791795585a8267.png','position_id' => '6','division_id' => '5','created_at' => NULL,'updated_at' => NULL),
            array('id' => '75','name' => 'Jethro Vetrich','photo' => '7143746fc22380a165eb89b76728798f5a7a0b55f8ffd64b55.png','position_id' => '6','division_id' => '5','created_at' => NULL,'updated_at' => NULL),
            array('id' => '76','name' => 'Ivan Tandella','photo' => 'f612a02b417c56f641f243730e4cee91e2cee1632ca1abcf7f.png','position_id' => '6','division_id' => '9','created_at' => NULL,'updated_at' => NULL),
            array('id' => '77','name' => 'M. Afifan Aly Rahman','photo' => 'd0824089689ab0f688df4041edf3e7793bd6440860fded17fa.png','position_id' => '6','division_id' => '7','created_at' => NULL,'updated_at' => NULL),
            array('id' => '78','name' => 'Ridha Arrahmi','photo' => '19169cd54f7a16f88fa917a03f6f42749f260274a7ce62e149.png','position_id' => '6','division_id' => '7','created_at' => NULL,'updated_at' => NULL),
            array('id' => '79','name' => 'Pretty Ohara','photo' => '9c8188eebf3e2d3f60ac382d06679124ef411a1f6b3d64ed76.png','position_id' => '6','division_id' => '8','created_at' => NULL,'updated_at' => NULL),
            array('id' => '80','name' => 'Yeftha El Imani','photo' => 'bd57a16bd69f659b953b7aaf4e64e679182669ce7250eadb4d.png','position_id' => '6','division_id' => '8','created_at' => NULL,'updated_at' => NULL),
            array('id' => '81','name' => 'Betsyeda Valentina','photo' => '170baf710844e6dadd135bb173c71864bd04262a496470fc4b.png','position_id' => '6','division_id' => '8','created_at' => NULL,'updated_at' => NULL)
        );

        /* `db_himatif`.`divisions` */
        $divisions = array(
            array('id' => '1','division' => 'Badan Pengurus Harian','slug' => 'badan-pengurus-harian','alias' => 'BPH','created_at' => NULL,'updated_at' => '2022-03-19 17:31:37'),
            array('id' => '2','division' => 'Pengembangan Sumber Daya Mahasiswa','slug' => 'pengembangan-sumber-daya-mahasiswa','alias' => 'PSDM','created_at' => NULL,'updated_at' => NULL),
            array('id' => '3','division' => 'Multimedia Komunikasi dan Informasi','slug' => 'multimedia-komunikasi-dan-informasi','alias' => 'Mulkominfo','created_at' => NULL,'updated_at' => NULL),
            array('id' => '4','division' => 'Penelitian dan Pengembangan','slug' => 'penelitian-dan-pengembangan','alias' => 'Litbang','created_at' => NULL,'updated_at' => NULL),
            array('id' => '5','division' => 'Olahraga dan Seni','slug' => 'olahraga-dan-seni','alias' => 'Olsen','created_at' => NULL,'updated_at' => NULL),
            array('id' => '6','division' => 'Usaha Mandiri','slug' => 'usaha-mandiri','alias' => 'UM','created_at' => NULL,'updated_at' => NULL),
            array('id' => '7','division' => 'Agama Islam','slug' => 'agama-islam','alias' => 'Agama Islam','created_at' => NULL,'updated_at' => NULL),
            array('id' => '8','division' => 'Agama Kristen','slug' => 'agama-kristen','alias' => 'Agama Kristen','created_at' => NULL,'updated_at' => NULL),
            array('id' => '9','division' => 'Agama Buddha','slug' => 'agama-buddha','alias' => 'Agama Buddha','created_at' => NULL,'updated_at' => NULL)
        );

        /* `db_himatif`.`histories` */
        $histories = array(
            array('id' => '1','history' => 'HIMATIF USU merupakan himpunan mahasiswa pada program studi Teknologi Informasi di Universitas Sumatera Utara yang telah berdiri selama 13 tahun. Himpunan ini berdiri tepatnya pada tanggal 28 April 2008 dengan nama Himatel (Himpunan Mahasiswa Teknik Perangkat Lunak) dan pada tanggal 17 September 2011, Himatel berubah nama menjadi Himatif.','created_at' => NULL,'updated_at' => NULL)
        );

        /* `db_himatif`.`maintenance__infos` */
        $maintenance__infos = array(
            array('id' => '1','is_maintenance' => '0','created_at' => NULL,'updated_at' => '2022-03-20 14:49:04')
        );

        /* `db_himatif`.`management__years` */
        $management__years = array(
            array('id' => '1','year' => 'Himatif 2021/2022','created_at' => NULL,'updated_at' => NULL)
        );

        /* `db_himatif`.`missions` */
        $missions = array(
            array('id' => '1','mission' => 'Menampung semua aspirasi mahasiswa tanpa membedakan Suku, Agama dan Ras (SARA).','created_at' => NULL,'updated_at' => NULL),
            array('id' => '2','mission' => 'Menjalin hubungan baik dengan organisasi kemahasiswaan lainnya tanpa membeda-bedakan Suku, Agama dan Ras (SARA).','created_at' => NULL,'updated_at' => NULL),
            array('id' => '3','mission' => 'Membentuk mahasiswa yang kreatif, produktif, berintelektual dan bermoral tinggi.','created_at' => NULL,'updated_at' => NULL),
            array('id' => '4','mission' => 'Menyelenggarakan dan berkontribusi dalam kegiatan sosial masyarakat sebagai wujud pengabdian terhadap masyarakat.','created_at' => NULL,'updated_at' => NULL)
        );

        /* `db_himatif`.`positions` */
        $positions = array(
            array('id' => '1','position' => 'Koordinator','created_at' => NULL,'updated_at' => NULL),
            array('id' => '2','position' => 'Anggota','created_at' => NULL,'updated_at' => NULL),
            array('id' => '3','position' => 'Ketua Umum dan Wakil Ketua Umum','created_at' => NULL,'updated_at' => NULL),
            array('id' => '4','position' => 'Sekretaris dan Wakil Sekretaris','created_at' => NULL,'updated_at' => NULL),
            array('id' => '5','position' => 'Bendahara dan Wakil Bendahara','created_at' => NULL,'updated_at' => NULL),
            array('id' => '6','position' => 'Anggota Intern','created_at' => NULL,'updated_at' => NULL),
        );

        /* `db_himatif`.`posts` */
        $posts = array(
            array('id' => '1','title' => 'KONGKOW – KONGKOW ILMU PENGETAHUAN ‘Bincang Karir : Raih Mimpi Dunia IT’','slug' => 'kongkow-kongkow-ilmu-pengetahuan-bincang-karir-raih-mimpi-dunia-it','hero_image' => '1638966923_adac4c8c2ddd19bcb535.png','article' => '<p>Kali ini HIMATIF kembali mengadakan kegiatan Kongkil (Kongkow-Kongkow Ilmu Pengetahuan) yang berlangsung pada 09 Oktober 2021 via Zoom. Kegiatan kongkil sendiri kembali diadakan karna dinilai cukup memberikan manfaat kepada para pesertanya. Kongkil yang diadakan HIMATIF kali ini mengusung tema &lsquo;Bincang Karir : Raih Mimpi Dunia IT&rsquo; yang dibawakan oleh Muhammad Fadly Tanjung sebagai pembicara. Muhammad Fadly Tanjung sendiri merupakan alumni Teknologi Informasi Angkatan 2014 yang sekarang bekerja sebagai Software Engineer di Tokopedia.</p>

            <p><a class="lightbox" href="https://www.himatifusu.com/assets/img/news/11-oktober-2021_kongkow-kongkow-ilmu-pengetahuan-bincang-karir-raih-mimpi-dunia-it/img/1x_1638966437_a790aa31304c1ae9553a.png"><img alt="KONGKOW – KONGKOW ILMU PENGETAHUAN ‘Bincang Karir : Raih Mimpi Dunia IT’" class="blur-up lazyloaded" data-src="https://www.himatifusu.com/assets/img/news/11-oktober-2021_kongkow-kongkow-ilmu-pengetahuan-bincang-karir-raih-mimpi-dunia-it/img/2x_1638966437_a790aa31304c1ae9553a.png" src="https://www.himatifusu.com/assets/img/news/11-oktober-2021_kongkow-kongkow-ilmu-pengetahuan-bincang-karir-raih-mimpi-dunia-it/img/2x_1638966437_a790aa31304c1ae9553a.png" /></a></p>

            <p>Dalam materi yang disampaikan, pembicara memberikan banyak pengetahuan terkait kiat-kiat untuk bisa diterima bekerja pada perusahaan impian. Para peserta diajak untuk menyadari kemampuan dan potensi yang dimiliki didalam dirinya (desain, pemrograman, dll) dan dimotivasi untuk tidak gampang menyerah.</p>

            <p><a class="lightbox" href="https://www.himatifusu.com/assets/img/news/11-oktober-2021_kongkow-kongkow-ilmu-pengetahuan-bincang-karir-raih-mimpi-dunia-it/img/1x_1638966488_d5addb10ba6cf14f835d.png"><img alt="KONGKOW – KONGKOW ILMU PENGETAHUAN ‘Bincang Karir : Raih Mimpi Dunia IT’" class="blur-up lazyloaded" data-src="https://www.himatifusu.com/assets/img/news/11-oktober-2021_kongkow-kongkow-ilmu-pengetahuan-bincang-karir-raih-mimpi-dunia-it/img/2x_1638966488_d5addb10ba6cf14f835d.png" src="https://www.himatifusu.com/assets/img/news/11-oktober-2021_kongkow-kongkow-ilmu-pengetahuan-bincang-karir-raih-mimpi-dunia-it/img/2x_1638966488_d5addb10ba6cf14f835d.png" /></a></p>

            <p>Pada sesi ini juga, para peserta juga diberikan latihan-latihan singkat untuk mengukur kemampuan yang dimiliki. Peserta juga diberi kebebasan untuk melakukan tanya jawab kepada pembicara jika ada hal-hal yang ingin mereka ketahui. Hal ini disambut antusias oleh para peserta dengan banyaknya peserta yang bertanya baik secara langsung maupun dari kolom komentar.</p>

            <p><a class="lightbox" href="https://www.himatifusu.com/assets/img/news/11-oktober-2021_kongkow-kongkow-ilmu-pengetahuan-bincang-karir-raih-mimpi-dunia-it/img/1x_1638966584_dc0b93df051133184577.png"><img alt="KONGKOW – KONGKOW ILMU PENGETAHUAN ‘Bincang Karir : Raih Mimpi Dunia IT’" class="blur-up lazyloaded" data-src="https://www.himatifusu.com/assets/img/news/11-oktober-2021_kongkow-kongkow-ilmu-pengetahuan-bincang-karir-raih-mimpi-dunia-it/img/2x_1638966584_dc0b93df051133184577.png" src="https://www.himatifusu.com/assets/img/news/11-oktober-2021_kongkow-kongkow-ilmu-pengetahuan-bincang-karir-raih-mimpi-dunia-it/img/2x_1638966584_dc0b93df051133184577.png" /></a></p>

            <p>Dengan diadakannya acara ini diharapkan peserta mendapat pengetahuan terkait apa yang akan mereka lakukan didalam dunia pekerjaan nantinya, terutama dibidang IT. Peserta juga mendapatkan gambaran akan bagaimana dunia pekerjaan nantinya.</p>','division_id' => '2','viewed' => '13','created_at' => '2021-10-11 07:00:00','updated_at' => '2022-03-18 15:19:55'),
            array('id' => '2','title' => 'Gathering Pengurus Himpunan Mahasiswa Teknologi Informasi 2021/2022','slug' => 'gathering-pengurus-himpunan-mahasiswa-teknologi-informasi-20212022','hero_image' => '1638968765_a1b89acebb4cc5620772.jpg','article' => '<p>HIMATIF Kembali mengadakan kegiatan gathering pengurus yang berlokasi di Taman Cadika - Medan pada tanggal 30 Oktober 2022 dengan tema &#39;Teamwork make the dreamwork&#39;. Kegiatan gathering pengurus HIMATIF ini berlangsung sejak pukul 10.00 WIB sampai 16.30 WIB.</p>

            <p>Kegiatan dikonsep dengan suasana yang santai, riang, sharing dan dipadukan dengan games yang menarik. Kegiatan dimulai dengan pembukaan oleh Wakil Ketua HIMATIF (M. Bagoes Prasetya) dan dilanjutkan dengan kata sambutan dari Koordinator divisi PSDM (Yulia Citra Wardani). Kemudian, kegiatan dilanjutkan dengan penjelasan teknis game yang akan dilaksanakan nantinya setelah ibadah dan makan siang bersama.</p>

            <p><a class="lightbox" href="https://www.himatifusu.com/assets/img/news/02-november-2021_gathering-pengurus-himpunan-mahasiswa-teknologi-informasi-20212022/img/1x_1638968820_09312275cc3fb1a970dd.jpg"><img alt="Gathering Pengurus Himpunan Mahasiswa Teknologi Informasi 2021/2022" data-src="https://www.himatifusu.com/assets/img/news/02-november-2021_gathering-pengurus-himpunan-mahasiswa-teknologi-informasi-20212022/img/2x_1638968820_09312275cc3fb1a970dd.jpg" src="https://www.himatifusu.com/assets/img/news/02-november-2021_gathering-pengurus-himpunan-mahasiswa-teknologi-informasi-20212022/img/2x_1638968820_09312275cc3fb1a970dd.jpg" /></a></p>

            <p>Setelah ibadah dan makan siang bersama dilakukan, games yang tadinya sudah dijelaskan pada para peserta pun dimulai. Terdapat 2 jenis games yang dimainkan pada gathering kali ini, yaitu games estafet dan games keseluruhan. Pada games estafet terdapat 3 pos yang harus dilewati oleh para peserta, para peserta diharuskan mendayung kayak/perahu dari pos 1 ke pos yang lainnya dimana pada masing-masing post terdapat games yang berbeda.</p>

            <p><a class="lightbox" href="https://www.himatifusu.com/assets/img/news/02-november-2021_gathering-pengurus-himpunan-mahasiswa-teknologi-informasi-20212022/img/1x_1638968993_952ae6c4f25b0992aba7.jpg"><img alt="Gathering Pengurus Himpunan Mahasiswa Teknologi Informasi 2021/2022" class="blur-up lazyloaded" data-src="https://www.himatifusu.com/assets/img/news/02-november-2021_gathering-pengurus-himpunan-mahasiswa-teknologi-informasi-20212022/img/2x_1638968993_952ae6c4f25b0992aba7.jpg" src="https://www.himatifusu.com/assets/img/news/02-november-2021_gathering-pengurus-himpunan-mahasiswa-teknologi-informasi-20212022/img/2x_1638968993_952ae6c4f25b0992aba7.jpg" /></a></p>

            <p>Pos 1 berisikan game Tarik stoking dan koin dalam tepung dimana para peserta yang memakai stoking harus meniup lilin yang berada didepannya, setelah selesai peserta menepuk teman kelompoknya untuk lanjut ke game selanjutnya yaitu mengambil 5 koin yang terdapat dalam piring yang berisikan tepung.</p>

            <p><a class="lightbox" href="https://www.himatifusu.com/assets/img/news/02-november-2021_gathering-pengurus-himpunan-mahasiswa-teknologi-informasi-20212022/img/1x_1638968853_3b565cbf45150f1c68c9.jpg"><img alt="Gathering Pengurus Himpunan Mahasiswa Teknologi Informasi 2021/2022" class="blur-up lazyloaded" data-src="https://www.himatifusu.com/assets/img/news/02-november-2021_gathering-pengurus-himpunan-mahasiswa-teknologi-informasi-20212022/img/2x_1638968853_3b565cbf45150f1c68c9.jpg" src="https://www.himatifusu.com/assets/img/news/02-november-2021_gathering-pengurus-himpunan-mahasiswa-teknologi-informasi-20212022/img/2x_1638968853_3b565cbf45150f1c68c9.jpg" /></a></p>

            <p>Pos 2 berisikan lomba balap karung dan makan kerupuk, kemudian pos 3 berisi games paku dalam botol dan tiup pingpong.</p>

            <p><a class="lightbox" href="https://www.himatifusu.com/assets/img/news/02-november-2021_gathering-pengurus-himpunan-mahasiswa-teknologi-informasi-20212022/img/1x_1638968922_6a8d4b4adb986be73f94.jpg"><img alt="Gathering Pengurus Himpunan Mahasiswa Teknologi Informasi 2021/2022" class="blur-up lazyloaded" data-src="https://www.himatifusu.com/assets/img/news/02-november-2021_gathering-pengurus-himpunan-mahasiswa-teknologi-informasi-20212022/img/2x_1638968922_6a8d4b4adb986be73f94.jpg" src="https://www.himatifusu.com/assets/img/news/02-november-2021_gathering-pengurus-himpunan-mahasiswa-teknologi-informasi-20212022/img/2x_1638968922_6a8d4b4adb986be73f94.jpg" /></a></p>

            <p>Untuk pemberhentian akhir, terdapat pos 4 yang menjadi pos terakhir dimana para peserta bermain secara keseluruhan tim. Pada pos ini terdapat games estafet air, estafet sarung dan estafet karet gelang.</p>

            <p><a class="lightbox" href="https://www.himatifusu.com/assets/img/news/02-november-2021_gathering-pengurus-himpunan-mahasiswa-teknologi-informasi-20212022/img/1x_1638968939_5783d3d9c1586d96fd3a.jpg"><img alt="Gathering Pengurus Himpunan Mahasiswa Teknologi Informasi 2021/2022" class="blur-up lazyloaded" data-src="https://www.himatifusu.com/assets/img/news/02-november-2021_gathering-pengurus-himpunan-mahasiswa-teknologi-informasi-20212022/img/2x_1638968939_5783d3d9c1586d96fd3a.jpg" src="https://www.himatifusu.com/assets/img/news/02-november-2021_gathering-pengurus-himpunan-mahasiswa-teknologi-informasi-20212022/img/2x_1638968939_5783d3d9c1586d96fd3a.jpg" /></a></p>

            <p>Kegiatan gathering kemudian diakhiri dengan sesi foto bersama dan pemberian kesan pesan sesama pengurus HIMATIF.</p>

            <p><a class="lightbox" href="https://www.himatifusu.com/assets/img/news/02-november-2021_gathering-pengurus-himpunan-mahasiswa-teknologi-informasi-20212022/img/1x_1638968956_7f86d9960a82127c88f9.jpg"><img alt="Gathering Pengurus Himpunan Mahasiswa Teknologi Informasi 2021/2022" class="blur-up lazyloaded" data-src="https://www.himatifusu.com/assets/img/news/02-november-2021_gathering-pengurus-himpunan-mahasiswa-teknologi-informasi-20212022/img/2x_1638968956_7f86d9960a82127c88f9.jpg" src="https://www.himatifusu.com/assets/img/news/02-november-2021_gathering-pengurus-himpunan-mahasiswa-teknologi-informasi-20212022/img/2x_1638968956_7f86d9960a82127c88f9.jpg" /></a></p>

            <p>Kegiatan yang diikuti oleh 55 orang pengurus HIMATIF 2021/2022 ini bertujuan untuk menjalin silaturami antar pengurus HIMATIF, menjalin kerjasama yang produktif antar pengurus HIMATIF, memberi wadah komunikasi antar pengurus HIMATIF dan, memberi sarana sosialisasi kegiatan antar pengurus HIMATIF.</p>

            <p>Keseruan pada kegiatan gathering pegurus HIMATIF kali ini dapat diakses pada :</p>

            <p><strong>Teaser:</strong></p>

            <p><iframe frameborder="0" scrolling="no" allowfullscreen="allowfullscreen"
                    mozallowfullscreen="mozallowfullscreen" 
                    msallowfullscreen="msallowfullscreen" 
                    oallowfullscreen="oallowfullscreen" 
                    webkitallowfullscreen="webkitallowfullscreen" src="https://www.youtube.com/embed/PHZjLMv6ps0"></iframe></p>

            <p><strong>Video Kegiatan:</strong></p>

            <p><strong><iframe frameborder="0" scrolling="no" allowfullscreen="allowfullscreen"
                    mozallowfullscreen="mozallowfullscreen" 
                    msallowfullscreen="msallowfullscreen" 
                    oallowfullscreen="oallowfullscreen" 
                    webkitallowfullscreen="webkitallowfullscreen" src="https://www.youtube.com/embed/5oCeXRMVU6A"></iframe></strong></p>','division_id' => '2','viewed' => '37','created_at' => '2021-11-02 07:00:00','updated_at' => NULL),
            array('id' => '3','title' => 'Himatif Super League 2021','slug' => 'himatif-super-league-2021','hero_image' => '1638969923_cda7ae3077eca1ab1932.jpg','article' => '<p>Universitas Sumatera Utara,Medan. Himatif melalui divisi olahraga dan seni (OLSEN) kembali mengadakan Himatif Super League (HSL) setelah tahun lalu sempat ditiadakan karena pandemi. Himatif Super League merupakan kompetesi di bidang olahraga futsal yang mempertandingan setiap Angkatan dari Teknologi Informasi. Kompetisi ini menggunakan sistem liga dimana pemenang diambil berdasarkan poin terbanyak.</p>

            <p>Kegiatan ini diselenggarakan dari tanggal 15 Oktober sampai 5 November 2021 di Lapangan Patologi USU .Kegiatan ini berhasil menghimpun antusias dari mahasiswa Teknologi Informasi terbukti dengan terdaftarnya 8 Tim dari seluruh Angkatan aktif dengan jumlah keseluruhan 28 match pertandingan.</p>

            <p>Kegiatan ini dibuka dengan kata sambutan yang disampaikan oleh Ketua Himatif, M. Daifullah dilanjutkan dengan Koordinator olahraga dan seni Astrid Nainggolan. Pertandingan dibuka oleh tim Venom IT dari Angkatan 2019 melawan tim Not Your Boys dari Angkatan 2020. Selama Pertandingan, masing-masing tim menampilkan sisi kompetitifnya untuk memperebutkan hadiah yang telah disiapkan oleh Himatif.</p>

            <p>Mendekati akhir kompetisi, klasmen antara tim memanas sehingga menimbulkan pertandingan penentu antara Beta Tester melawan Venom IT untuk memperebutkan juara utama. Hasil dari pertandingan ini menghasilkan Beta Tester sebagai juara 1 dengan hanya unggul 1 poin dari peringkat kedua yaitu Venom IT. Juara ketiga dimenangkan oleh tim UC 1000, sedangkan untuk kategori Top Scorer dimenangkan oleh Agus Fernando Nainggolan dari tim Badut Fc dan kategori The Best Supporter dimenangkan oleh Angkatan 2021.</p>

            <p><iframe frameborder="0" scrolling="no" allowfullscreen="allowfullscreen"
                    mozallowfullscreen="mozallowfullscreen" 
                    msallowfullscreen="msallowfullscreen" 
                    oallowfullscreen="oallowfullscreen" 
                    webkitallowfullscreen="webkitallowfullscreen" src="https://www.youtube.com/embed/oQ1-9aGB_sI"></iframe></p>','division_id' => '5','viewed' => '48','created_at' => '2021-11-07 07:00:00','updated_at' => '2022-03-16 14:30:53'),
            array('id' => '4','title' => 'Kongkow Bareng (KOBAR) 2021','slug' => 'kongkow-bareng-kobar-2021','hero_image' => '1638970232_1fad1d9749902b2b0fa1.jpg','article' => '<p>Jumat, 19 November 2021 merupakan salah satu hari yang sibuk sekaligus menyenangkan bagi divisi Olsen dan HIMATIF. Karena hari tersebut merupakan hari dilaksanakannya Kobar (Kongkow Bareng). Kegiatan tersebut merupakan salah satu dari program kerja divisi Olsen dimana para mahasiswa dari Teknologi Informasi akan berkumpul bersama diiringi dengan penampilan live music dari rekan-rekan Teknologi Informasi.</p>

            <p>Persiapan kegiatan ini tidak bisa dibilang mudah. Dimulai dengan menentukan tempat yang dirasa cocok di masa pandemi ini, mempersiapkan alat musik yang akan dipakai penampil, dan merancang plan lain untuk acara berhubung cuaca pada saat itu sedang musim hujan. Dua dari tiga persiapan tersebut dapat dihadapi dengan baik. Terkait tempat, Degil House merupakan tempat yang dipilih untuk Kobar di antara beberapa pilihan tempat yang direncanakan sebelumnya. Namun, mengenai cuaca sungguh tidak bisa diprediksi. Acara yang seharusnya dilaksanakan pukul 16.30 sayangnya harus tertunda hingga pukul 18.00 dikarenakan cuaca yang kurang mendukung.</p>

            <p>Namun, terlepas dari penundaan waktu yang cukup lama, semangat dan antusias dari teman-teman Teknologi Informasi yang hadir di lokasi tetap mengalir sehingga acara tetap dapat dilaksanakan dengan baik. Acara dibuka oleh MC, yaitu Muksalmina dan Annisa Putri Daulay. Dilanjutkan dengan kata sambutan oleh Astrid Nainggolan selaku Koordinator Divisi Olsen dan kata sambutan oleh Muhammad Daifullah selaku Ketua Umum HIMATIF.</p>

            <p><a class="lightbox" href="https://www.himatifusu.com/assets/img/news/21-november-2021_kongkow-bareng-kobar-2021/img/1x_1638970561_9e4a302d82fb713e85d7.jpg"><img alt="Kongkow Bareng (KOBAR) 2021" class="blur-up lazyloaded" data-src="https://www.himatifusu.com/assets/img/news/21-november-2021_kongkow-bareng-kobar-2021/img/2x_1638970561_9e4a302d82fb713e85d7.jpg" src="https://www.himatifusu.com/assets/img/news/21-november-2021_kongkow-bareng-kobar-2021/img/2x_1638970561_9e4a302d82fb713e85d7.jpg" /></a></p>

            <p>Penampilan dibuka oleh grup duo Hamba Tuhan, disusul dengan penampilan solo dari Andi Farras yang mendapat begitu banyak sorak sorai dari penonton. Antusias penonton tidak berhenti disitu, sorak sorai penonton masih terdengar mengiringi penampilan yang dibawakan oleh grup Olsen, Meraki, UC 1000 dan Kawan Kumpul band.</p>

            <div class="row">
            <div class="col-md-6 mb-2"><a class="lightbox" href="https://www.himatifusu.com/assets/img/news/21-november-2021_kongkow-bareng-kobar-2021/img/1x_1638970593_1b5a9726e79b49a72d12.jpg"><img alt="Kongkow Bareng (KOBAR) 2021" class="blur-up lazyloaded" data-src="https://www.himatifusu.com/assets/img/news/21-november-2021_kongkow-bareng-kobar-2021/img/2x_1638970593_1b5a9726e79b49a72d12.jpg" src="https://www.himatifusu.com/assets/img/news/21-november-2021_kongkow-bareng-kobar-2021/img/2x_1638970593_1b5a9726e79b49a72d12.jpg" /></a></div>

            <div class="col-md-6"><a class="lightbox" href="https://www.himatifusu.com/assets/img/news/21-november-2021_kongkow-bareng-kobar-2021/img/1x_1638970606_4f012a4be19bc1a27681.jpg"><img alt="Kongkow Bareng (KOBAR) 2021" class="blur-up lazyloaded" data-src="https://www.himatifusu.com/assets/img/news/21-november-2021_kongkow-bareng-kobar-2021/img/2x_1638970606_4f012a4be19bc1a27681.jpg" src="https://www.himatifusu.com/assets/img/news/21-november-2021_kongkow-bareng-kobar-2021/img/2x_1638970606_4f012a4be19bc1a27681.jpg" /></a></div>
            </div>

            <p>Kobar tahun ini cukup berbeda dari kobar tahun &ndash; tahun sebelumnya. Karena kobar tahun ini mendatangkan bintang tamu yaitu band asal medan, &lsquo;Moongazing &amp; Her&lsquo; yang didominasi oleh personel wanita. Sebelum memulai sesi bincang, salah satu personel dari Moongazing &amp; Her, Kak Dara mempersembahkan sebuah lagu dengan suara merdunya.</p>

            <p><a class="lightbox" href="https://www.himatifusu.com/assets/img/news/21-november-2021_kongkow-bareng-kobar-2021/img/1x_1638970621_1acb28c7593c73a63f27.jpg"><img alt="Kongkow Bareng (KOBAR) 2021" class="blur-up lazyloaded" data-src="https://www.himatifusu.com/assets/img/news/21-november-2021_kongkow-bareng-kobar-2021/img/2x_1638970621_1acb28c7593c73a63f27.jpg" src="https://www.himatifusu.com/assets/img/news/21-november-2021_kongkow-bareng-kobar-2021/img/2x_1638970621_1acb28c7593c73a63f27.jpg" /></a></p>

            <p>Kedua MC berbincang-bincang dengan bintang tamu mengenai kehidupan musisi terkhusus musisi wanita di Medan. Banyak ilmu dan pengalaman yang dapat diambil selama interview dengan Moongazing &amp; Her. Diakhir interview Moongazing &amp; Her memberikan harapannya untuk para wanita agar jangan takut untuk berkarya, manfaatkan semua platfrom dan kesempatan yang ada karena tidak ada perbedaan antara musisi wanita dan pria.</p>

            <p><a class="lightbox" href="https://www.himatifusu.com/assets/img/news/21-november-2021_kongkow-bareng-kobar-2021/img/1x_1638970635_537d8a8dc887347e9cc8.jpg"><img alt="Kongkow Bareng (KOBAR) 2021" class="blur-up lazyloaded" data-src="https://www.himatifusu.com/assets/img/news/21-november-2021_kongkow-bareng-kobar-2021/img/2x_1638970635_537d8a8dc887347e9cc8.jpg" src="https://www.himatifusu.com/assets/img/news/21-november-2021_kongkow-bareng-kobar-2021/img/2x_1638970635_537d8a8dc887347e9cc8.jpg" /></a></p>

            <p>Di akhir acara, tentunya MC juga mengumumkan mana penampilan terbaik yang sudah teman-teman Teknologi Informasi tampilkan pada malam itu. Meraki Band terpilih sebagai Best Performance. Selamat teman-teman, kalian keren! Hadiah diserahkan oleh Bang Dani yang berupa merchandise HIMATIF.</p>

            <p><a class="lightbox" href="https://www.himatifusu.com/assets/img/news/21-november-2021_kongkow-bareng-kobar-2021/img/1x_1638970650_8cb8ced129e05374e0c2.jpg"><img alt="Kongkow Bareng (KOBAR) 2021" class="blur-up lazyloaded" data-src="https://www.himatifusu.com/assets/img/news/21-november-2021_kongkow-bareng-kobar-2021/img/2x_1638970650_8cb8ced129e05374e0c2.jpg" src="https://www.himatifusu.com/assets/img/news/21-november-2021_kongkow-bareng-kobar-2021/img/2x_1638970650_8cb8ced129e05374e0c2.jpg" /></a></p>

            <p>Tepat pukul 21.30 WIB, acara Kobar selesai dilaksanakan dan ditutup dengan foto bersama seluruh mahasiswa Teknologi Informasi yang hadir pada malam itu.</p>

            <p><iframe frameborder="0" scrolling="no" allowfullscreen="allowfullscreen"
                    mozallowfullscreen="mozallowfullscreen" 
                    msallowfullscreen="msallowfullscreen" 
                    oallowfullscreen="oallowfullscreen" 
                    webkitallowfullscreen="webkitallowfullscreen" src="https://www.youtube.com/embed/TO93iL0jAYU"></iframe></p>','division_id' => '5','viewed' => '50','created_at' => '2021-11-21 07:00:00','updated_at' => NULL),
            array('id' => '5','title' => 'KONGKOW – KONGKOW ILMU PENGETAHUAN  ‘Become a Legend : Front End Developer’','slug' => 'kongkow-kongkow-ilmu-pengetahuan-become-a-legend-front-end-developer','hero_image' => '1638971400_278782855cca56c962af.png','article' => '<p>Kongkil &ndash; atau kegiatan dari HIMATIF yang memiliki kepanjangan Kongkow Kongkow Ilmu Pengetahuan kembali dilaksanakan pada 27 November 2021. Pada kesempatan kali ini HIMATIF mengusung tema &lsquo;Become A Legend : Front End Developer&rsquo; dan mengundang Putra Yuszar sebagai pembicara pada kegiatan Kongkil kali ini. Putra Yuszar sendiri merupakan alumni dari Teknologi Informasi yang sekarang bekerja sebagai front end di PT Bangunindo Teknusa Jaya.</p>

            <p><a class="lightbox" href="https://www.himatifusu.com/assets/img/news/29-november-2021_kongkow-kongkow-ilmu-pengetahuan-become-a-legend-front-end-developer/img/1x_1638971435_54bf792e97e1ebfac213.png"><img alt="KONGKOW – KONGKOW ILMU PENGETAHUAN  ‘BECOME A LEGEND : FRONT END DEVELOPER’" class="blur-up lazyloaded" data-src="https://www.himatifusu.com/assets/img/news/29-november-2021_kongkow-kongkow-ilmu-pengetahuan-become-a-legend-front-end-developer/img/2x_1638971435_54bf792e97e1ebfac213.png" src="https://www.himatifusu.com/assets/img/news/29-november-2021_kongkow-kongkow-ilmu-pengetahuan-become-a-legend-front-end-developer/img/2x_1638971435_54bf792e97e1ebfac213.png" /></a></p>

            <p>Rangkaian acara dimulai dengan kata sambutan dari Ketua HIMATIF (Muhammad Daifullah) , dan kemudian dilanjutkan oleh pembawaan materi. Materi pada kongkil kali ini mencakup pembelajaran yang harus ditempuh jika ingin menjadi front end developer, portfolio yang harus dipersiapkan dan banyak pengetahuan lain terkait kiat-kiat menjadi front end developer. Kegiatan ini juga dilengkapi oleh sesi tanya jawab yang diikuti oleh antusias para peserta.</p>

            <p><a class="lightbox" href="https://www.himatifusu.com/assets/img/news/29-november-2021_kongkow-kongkow-ilmu-pengetahuan-become-a-legend-front-end-developer/img/1x_1638971458_f494cf8991f662341d26.png"><img alt="KONGKOW – KONGKOW ILMU PENGETAHUAN  ‘BECOME A LEGEND : FRONT END DEVELOPER’" class="blur-up lazyloaded" data-src="https://www.himatifusu.com/assets/img/news/29-november-2021_kongkow-kongkow-ilmu-pengetahuan-become-a-legend-front-end-developer/img/2x_1638971458_f494cf8991f662341d26.png" src="https://www.himatifusu.com/assets/img/news/29-november-2021_kongkow-kongkow-ilmu-pengetahuan-become-a-legend-front-end-developer/img/2x_1638971458_f494cf8991f662341d26.png" /></a></p>

            <p>Dengan diadakannya kegiatan ini, diharapkan dapat memberikan pemahaman dan pengetahuan kepada peserta terkait dunia kerja jika mereka ingin terjun sebagai Front End Developer.</p>','division_id' => '2','viewed' => '53','created_at' => '2021-11-29 07:00:00','updated_at' => NULL),
            array('id' => '6','title' => 'Mystery Event HIMATIF 2021 (Cooking and Donate)','slug' => 'mystery-event-himatif-2021-cooking-and-donate','hero_image' => '1642744952_599a42744fc4061b8bc3.jpg','article' => '<p>Sebagai penutup event akhir tahun 2021, HIMATIF menyelenggarakan Mystery Event, Cooking and Donate. Acara cooking and donate (Coonate) sendiri merupakan lomba masak yang diikuti oleh mahasiswa Teknologi Informasi dan hasilnya akan didonasikan kepada mereka yang membutuhkan. Coonate diadakan pada Sabtu, 18 Desember 2021 di Pendopo Fasilkom-TI.</p>

            <p>Terdapat 4 tim yang mendaftarkan diri pada perlombaan masak kali ini dan menu yang akan dilombakan adalah nasi goreng dan mie goreng. Para peserta diberikan bahan dasar untuk memasak dan diperbolehkan untuk membawa bahan tambahan dari rumah seperti udang, bakso, sosis, dan lain-lain.</p>

            <div class="row">
            <div class="col-md-6 mb-2"><a class="lightbox" href="https://www.himatifusu.com/assets/img/news/20-desember-2021_mystery-event-himatif-2021-cooking-and-donate/img/1x_1642744977_4986f28cf16e63005f82.jpg"><img alt="Mystery Event HIMATIF 2021 (Cooking and Donate)" class="blur-up lazyloaded" data-src="https://www.himatifusu.com/assets/img/news/20-desember-2021_mystery-event-himatif-2021-cooking-and-donate/img/2x_1642744977_4986f28cf16e63005f82.jpg" src="https://www.himatifusu.com/assets/img/news/20-desember-2021_mystery-event-himatif-2021-cooking-and-donate/img/2x_1642744977_4986f28cf16e63005f82.jpg" /></a></div>

            <div class="col-md-6"><a class="lightbox" href="https://www.himatifusu.com/assets/img/news/20-desember-2021_mystery-event-himatif-2021-cooking-and-donate/img/1x_1642744994_0447af4d897a3b6f2056.jpg"><img alt="Mystery Event HIMATIF 2021 (Cooking and Donate)" class="blur-up lazyloaded" data-src="https://www.himatifusu.com/assets/img/news/20-desember-2021_mystery-event-himatif-2021-cooking-and-donate/img/2x_1642744994_0447af4d897a3b6f2056.jpg" src="https://www.himatifusu.com/assets/img/news/20-desember-2021_mystery-event-himatif-2021-cooking-and-donate/img/2x_1642744994_0447af4d897a3b6f2056.jpg" /></a></div>
            </div>

            <p>Dengan dua pilihan menu tadi peserta diberikan waktu untuk membuat kreasi makanan yang selanjutnya akan dinilai oleh para juri. Juri yang menilai masakan merupakan perwakilan dari HIMATIF dan peserta yang berhadir pada acara.</p>

            <div class="row">
            <div class="col-md-6 mb-2"><a class="lightbox" href="https://www.himatifusu.com/assets/img/news/20-desember-2021_mystery-event-himatif-2021-cooking-and-donate/img/1x_1642745376_b137b0e85fc625989e48.jpg"><img alt="Mystery Event HIMATIF 2021 (Cooking and Donate)" class="blur-up lazyloaded" data-src="https://www.himatifusu.com/assets/img/news/20-desember-2021_mystery-event-himatif-2021-cooking-and-donate/img/2x_1642745376_b137b0e85fc625989e48.jpg" src="https://www.himatifusu.com/assets/img/news/20-desember-2021_mystery-event-himatif-2021-cooking-and-donate/img/2x_1642745376_b137b0e85fc625989e48.jpg" /></a></div>

            <div class="col-md-6"><a class="lightbox" href="https://www.himatifusu.com/assets/img/news/20-desember-2021_mystery-event-himatif-2021-cooking-and-donate/img/1x_1642745394_1b07adaa18dbe3e7445e.jpg"><img alt="Mystery Event HIMATIF 2021 (Cooking and Donate)" class="blur-up lazyloaded" data-src="https://www.himatifusu.com/assets/img/news/20-desember-2021_mystery-event-himatif-2021-cooking-and-donate/img/2x_1642745394_1b07adaa18dbe3e7445e.jpg" src="https://www.himatifusu.com/assets/img/news/20-desember-2021_mystery-event-himatif-2021-cooking-and-donate/img/2x_1642745394_1b07adaa18dbe3e7445e.jpg" /></a></div>
            </div>

            <p>Selama acara berlangsung juga diadakan live music yang diisi oleh mahasiswa TI sendiri sebagai wadah penyaluran bakat dan hobi yang dimiliki.</p>

            <p><a class="lightbox" href="https://www.himatifusu.com/assets/img/news/20-desember-2021_mystery-event-himatif-2021-cooking-and-donate/img/1x_1642745518_e983a4174b59831e4406.jpg"><img alt="Mystery Event HIMATIF 2021 (Cooking and Donate)" class="blur-up lazyloaded" data-src="https://www.himatifusu.com/assets/img/news/20-desember-2021_mystery-event-himatif-2021-cooking-and-donate/img/2x_1642745518_e983a4174b59831e4406.jpg" src="https://www.himatifusu.com/assets/img/news/20-desember-2021_mystery-event-himatif-2021-cooking-and-donate/img/2x_1642745518_e983a4174b59831e4406.jpg" /></a></p>

            <p>Untuk keseruan dan kelengkapan acara Mystery Event &ndash; Cooking and Donate kali ini dapat diakses pada halaman youtube himatif :</p>

            <p><iframe frameborder="0" scrolling="no" allowfullscreen="allowfullscreen"
                    mozallowfullscreen="mozallowfullscreen" 
                    msallowfullscreen="msallowfullscreen" 
                    oallowfullscreen="oallowfullscreen" 
                    webkitallowfullscreen="webkitallowfullscreen" src="https://www.youtube.com/embed/0ANkTrnV3z0"></iframe></p>','division_id' => '2','viewed' => '42','created_at' => '2021-12-20 07:00:00','updated_at' => '2022-03-10 17:32:07')
        );

        /* `db_himatif`.`product__categories` */
        $product__categories = array(
            array('id' => '1','category' => 'Merchandise','slug' => 'merchandise','photo' => '1630940027_fca9b40e84832842287d.jpg','created_at' => NULL,'updated_at' => NULL),
            array('id' => '2','category' => 'Makanan & Minuman','slug' => 'makanan-minuman','photo' => '1630940044_8bd9204fbf7f0182a4e8.jpg','created_at' => NULL,'updated_at' => NULL),
            array('id' => '3','category' => 'Souvenir Wisuda','slug' => 'souvenir-wisuda','photo' => '1630940055_5234851312d00dea6c0a.jpg','created_at' => NULL,'updated_at' => NULL)
        );

        /* `db_himatif`.`product__colors` */
        $product__colors = array(
            array('id' => '1','color' => 'White','hex_code' => '#fff','created_at' => NULL,'updated_at' => NULL),
            array('id' => '2','color' => 'Black','hex_code' => '#000','created_at' => NULL,'updated_at' => NULL),
            array('id' => '3','color' => 'Navy','hex_code' => '#0B0B45','created_at' => NULL,'updated_at' => NULL),
            array('id' => '4','color' => 'Army','hex_code' => '#47422A','created_at' => NULL,'updated_at' => NULL),
            array('id' => '5','color' => 'Grey','hex_code' => '#808080','created_at' => NULL,'updated_at' => NULL),
            array('id' => '6','color' => 'Maroon','hex_code' => '#830300','created_at' => NULL,'updated_at' => NULL)
        );

        /* `db_himatif`.`product__galleries` */
        $product__galleries = array(
            array('id' => '1','shop__items_id' => '1','photo' => '1632316032_870b83778c4174afe553.jpg','photo_order' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => '2','shop__items_id' => '1','photo' => '1632316033_90ab947ad17d334121bd.jpg','photo_order' => '2','created_at' => NULL,'updated_at' => NULL),
            array('id' => '3','shop__items_id' => '2','photo' => '1632316329_ebeb7f63d4b88e81b447.jpg','photo_order' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => '4','shop__items_id' => '3','photo' => '1632316498_c44a5502c63c1ab877fe.jpg','photo_order' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => '5','shop__items_id' => '4','photo' => '1632317545_bac512d3eaa83840fcab.jpg','photo_order' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => '6','shop__items_id' => '5','photo' => '1633626521_4c21cddc5da79879e4ed.jpg','photo_order' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => '7','shop__items_id' => '6','photo' => '1632333780_9d675e6c4239bb40b641.jpg','photo_order' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => '8','shop__items_id' => '7','photo' => '1632335104_1fcad9c65db1cb6e65a6.jpg','photo_order' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => '9','shop__items_id' => '7','photo' => '1632335104_db9f7f10740eb4af01e0.jpg','photo_order' => '2','created_at' => NULL,'updated_at' => NULL),
            array('id' => '10','shop__items_id' => '7','photo' => '1632335104_56eeb44cb26d30192812.jpg','photo_order' => '3','created_at' => NULL,'updated_at' => NULL),
            array('id' => '11','shop__items_id' => '7','photo' => '1632335104_3d45c36825129fa97930.jpg','photo_order' => '4','created_at' => NULL,'updated_at' => NULL),
            array('id' => '12','shop__items_id' => '7','photo' => '1632335104_4769a74f1803df9876c7.jpg','photo_order' => '5','created_at' => NULL,'updated_at' => NULL),
            array('id' => '13','shop__items_id' => '8','photo' => '1633620278_f20e6a7f7f3cd9066534.jpg','photo_order' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => '14','shop__items_id' => '9','photo' => '1632368475_9473110624cc9b58ef14.jpg','photo_order' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => '15','shop__items_id' => '10','photo' => '1632369856_d47c6700c5b3d072beaa.jpg','photo_order' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => '16','shop__items_id' => '10','photo' => '1632369857_5dc3b917054ae9282c4e.jpg','photo_order' => '2','created_at' => NULL,'updated_at' => NULL),
            array('id' => '17','shop__items_id' => '11','photo' => '1632369957_60bc38dd2a28aae44d23.jpg','photo_order' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => '18','shop__items_id' => '12','photo' => '1632369994_c0b0ce36cfbad9c812fd.jpg','photo_order' => '2','created_at' => NULL,'updated_at' => NULL),
        );

        /* `db_himatif`.`product__prices` */
        $product__prices = array(
            array('id' => '1','shop__items_id' => '1','price' => '105000','created_at' => NULL,'updated_at' => NULL),
            array('id' => '2','shop__items_id' => '1','price' => '125000','created_at' => NULL,'updated_at' => NULL),
            array('id' => '3','shop__items_id' => '2','price' => '80000','created_at' => NULL,'updated_at' => NULL),
            array('id' => '4','shop__items_id' => '2','price' => '100000','created_at' => NULL,'updated_at' => NULL),
            array('id' => '5','shop__items_id' => '3','price' => '80000','created_at' => NULL,'updated_at' => NULL),
            array('id' => '6','shop__items_id' => '3','price' => '100000','created_at' => NULL,'updated_at' => NULL),
            array('id' => '7','shop__items_id' => '4','price' => '85000','created_at' => NULL,'updated_at' => NULL),
            array('id' => '8','shop__items_id' => '4','price' => '105000','created_at' => NULL,'updated_at' => NULL),
            array('id' => '9','shop__items_id' => '5','price' => '10000','created_at' => NULL,'updated_at' => NULL),
            array('id' => '10','shop__items_id' => '6','price' => '55000','created_at' => NULL,'updated_at' => NULL),
            array('id' => '11','shop__items_id' => '7','price' => '35000','created_at' => NULL,'updated_at' => NULL),
            array('id' => '12','shop__items_id' => '7','price' => '65000','created_at' => NULL,'updated_at' => NULL),
            array('id' => '13','shop__items_id' => '8','price' => '16000','created_at' => NULL,'updated_at' => NULL),
            array('id' => '14','shop__items_id' => '9','price' => '60000','created_at' => NULL,'updated_at' => NULL),
            array('id' => '15','shop__items_id' => '10','price' => '25000','created_at' => NULL,'updated_at' => NULL),
            array('id' => '16','shop__items_id' => '11','price' => '20000','created_at' => NULL,'updated_at' => NULL),
            array('id' => '17','shop__items_id' => '12','price' => '20000','created_at' => NULL,'updated_at' => NULL),
        );

        /* `db_himatif`.`product__with__colors` */
        $product__with__colors = array(
            array('id' => '1','shop__items_id' => '1','product__colors_id' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => '2','shop__items_id' => '1','product__colors_id' => '2','created_at' => NULL,'updated_at' => NULL),
            array('id' => '3','shop__items_id' => '1','product__colors_id' => '3','created_at' => NULL,'updated_at' => NULL),
            array('id' => '4','shop__items_id' => '1','product__colors_id' => '4','created_at' => NULL,'updated_at' => NULL),
            array('id' => '5','shop__items_id' => '1','product__colors_id' => '5','created_at' => NULL,'updated_at' => NULL),
            array('id' => '6','shop__items_id' => '1','product__colors_id' => '6','created_at' => NULL,'updated_at' => NULL),
            array('id' => '7','shop__items_id' => '2','product__colors_id' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => '8','shop__items_id' => '2','product__colors_id' => '2','created_at' => NULL,'updated_at' => NULL),
            array('id' => '9','shop__items_id' => '2','product__colors_id' => '3','created_at' => NULL,'updated_at' => NULL),
            array('id' => '10','shop__items_id' => '2','product__colors_id' => '4','created_at' => NULL,'updated_at' => NULL),
            array('id' => '11','shop__items_id' => '2','product__colors_id' => '5','created_at' => NULL,'updated_at' => NULL),
            array('id' => '12','shop__items_id' => '2','product__colors_id' => '6','created_at' => NULL,'updated_at' => NULL),
            array('id' => '13','shop__items_id' => '3','product__colors_id' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => '14','shop__items_id' => '3','product__colors_id' => '2','created_at' => NULL,'updated_at' => NULL),
            array('id' => '15','shop__items_id' => '3','product__colors_id' => '3','created_at' => NULL,'updated_at' => NULL),
            array('id' => '16','shop__items_id' => '3','product__colors_id' => '4','created_at' => NULL,'updated_at' => NULL),
            array('id' => '17','shop__items_id' => '3','product__colors_id' => '5','created_at' => NULL,'updated_at' => NULL),
            array('id' => '18','shop__items_id' => '3','product__colors_id' => '6','created_at' => NULL,'updated_at' => NULL),
            array('id' => '19','shop__items_id' => '4','product__colors_id' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => '20','shop__items_id' => '4','product__colors_id' => '2','created_at' => NULL,'updated_at' => NULL),
            array('id' => '21','shop__items_id' => '4','product__colors_id' => '3','created_at' => NULL,'updated_at' => NULL),
            array('id' => '22','shop__items_id' => '4','product__colors_id' => '4','created_at' => NULL,'updated_at' => NULL),
            array('id' => '23','shop__items_id' => '4','product__colors_id' => '5','created_at' => NULL,'updated_at' => NULL),
            array('id' => '24','shop__items_id' => '4','product__colors_id' => '6','created_at' => NULL,'updated_at' => NULL),
        );

        /* `db_himatif`.`services` */
        $services = array(
            array('id' => '1','service' => 'Himatif Radio','link' => 'https://himatifusu.caster.fm/','created_at' => NULL,'updated_at' => NULL),
            array('id' => '2','service' => 'HI-Cast','link' => 'https://open.spotify.com/show/1CrRSdQ6oeRraSbREefapN?si=LC-X0p43RhCP8VRtWDqsTQ&dl_branch=1','created_at' => NULL,'updated_at' => NULL)
        );

        /* `db_himatif`.`shop__items` */
        $shop__items = array(
            array('id' => '1','item' => 'T-Shirt Himatif','slug' => 't-shirt-himatif','description' => '<p>Harga :</p>

            <ul>
                <li>Lengan Pendek Warna Putih : Rp. 105.000</li>
                <li>Lengan Pendek Berwarna : Rp. 110.000</li>
                <li>Lengan Pendek Warna Putih : Rp. 120.000</li>
                <li>Lengan Pendek Berwarna : Rp. 125.000</li>
            </ul>
            ','product__categories_id' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => '2','item' => 'T-Shirt Atif','slug' => 't-shirt-atif','description' => '<p>Harga :</p>

            <ul>
                <li>Lengan Pendek Warna Putih : Rp. 80.000</li>
                <li>Lengan Pendek Berwarna : Rp. 85.000</li>
                <li>Lengan Panjang Warna Putih : Rp. 95.000</li>
                <li>Lengan Panjang Berwarna : Rp. 100.000</li>
            </ul>
            ','product__categories_id' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => '3','item' => 'T-Shirt Bug Hunter','slug' => 't-shirt-bug-hunter','description' => '<p>Harga :</p>

            <ul>
                <li>Lengan Pendek Warna Putih : Rp. 80.000</li>
                <li>Lengan Pendek Berwarna : Rp. 85.000</li>
                <li>Lengan Panjang Warna Putih : Rp. 95.000</li>
                <li>Lengan Panjang Berwarna : Rp. 100.000</li>
            </ul>
            ','product__categories_id' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => '4','item' => 'T-Shirt Apache','slug' => 't-shirt-apache','description' => '<p>Harga :</p>

            <ul>
                <li>Lengan Pendek Warna Putih : Rp. 85.000</li>
                <li>Lengan Pendek Berwarna : Rp. 90.000</li>
                <li>Lengan Panjang Warna Putih : Rp. 100.000</li>
                <li>Lengan Panjang Berwarna : Rp. 105.000</li>
            </ul>
            ','product__categories_id' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => '5','item' => 'Teh tarik jelly 250ml','slug' => 'teh-tarik-jelly-250ml','description' => '<p>Buruan cobain teh tarik isian jelly, murah dan segar.</p>
            ','product__categories_id' => '2','created_at' => NULL,'updated_at' => NULL),
            array('id' => '6','item' => 'Selempang Wisuda','slug' => 'selempang-wisuda','description' => '<p>Wisuda belum lengkap kalau belum pakai selempang nih. Dan good news nya sekarang kamu bisa request selempang wisuda di himatifshop.</p>','product__categories_id' => '3','created_at' => NULL,'updated_at' => NULL),
            array('id' => '7','item' => 'Bouquet Wisuda','slug' => 'bouquet-wisuda','description' => '<p>Gaperlu bingung lagi buat nyari souvenir wisuda, karna sekarang himatifshop menyediakan berbagai jenis bouquet. And don\'t worry! Karna kalian juga bisa custom bouquet sesuai keinginan kalian.</p>
            <p>Harga :</p>
            <p>Bouquet Besar : Rp. 65.000</p>
            <p>Bouquet Kecil : Rp. 35.000 </p>','product__categories_id' => '3','created_at' => NULL,'updated_at' => NULL),
            array('id' => '8','item' => 'Teh tarik jelly 500ml','slug' => 'teh-tarik-jelly-500ml','description' => '<p>Buruan cobain teh tarik isian jelly, murah dan segar.</p>
            ','product__categories_id' => '2','created_at' => NULL,'updated_at' => NULL),
            array('id' => '9','item' => 'Kebab Frozen','slug' => 'kebab-frozen','description' => '<p>Bagi kalian yang pengen kebab buat stock dirumah disini juga ada loh kebab frozen, yang pastinya murah dan bikin kenyang.</p>
            <p>Terdapat dua varian rasa, kebab frozen pisang keju coklat lumer dan kebab frozen daging.</p>','product__categories_id' => '2','created_at' => NULL,'updated_at' => NULL),
            array('id' => '10','item' => 'Kebab Special','slug' => 'kebab-special','description' => '<p>Buruan cobain kebab isian lengkap, yang pastinya murah dan bikin kenyang.</p>','product__categories_id' => '2','created_at' => NULL,'updated_at' => NULL),
            array('id' => '11','item' => 'Kebab Daging','slug' => 'kebab-daging','description' => '<p>Buruan cobain kebab isian daging, yang pastinya murah dan bikin kenyang.</p>','product__categories_id' => '2','created_at' => NULL,'updated_at' => NULL),
            array('id' => '12','item' => 'Kebab Pisang Keju Coklat Lumer','slug' => 'kebab-pisang-keju-coklat-lumer','description' => '<p>Buruan cobain kebab isian lengkap pisang colat keju lumer, yang pastinya murah dan bikin kenyang.</p>','product__categories_id' => '2','created_at' => NULL,'updated_at' => NULL),
        );

        /* `db_himatif`.`social__media` */
        $social__media = array(
            array('id' => '1','social' => 'instagram','link' => 'https://www.instagram.com/himatifusu/','icon' => 'ri-instagram-line ri-lg','color' => 'radial-gradient(circle farthest-corner at 32% 106%,rgb(255, 225, 125) 0%,rgb(255, 205, 105) 10%,rgb(250, 145, 55) 28%,rgb(235, 65, 65) 42%,transparent 82%),linear-gradient(135deg, rgb(35, 75, 215) 12%, rgb(195, 60, 190) 58%)','created_at' => NULL,'updated_at' => NULL),
            array('id' => '2','social' => 'whatsapp','link' => 'https://api.whatsapp.com/send?phone=6289603924058','icon' => 'ri-whatsapp-line ri-lg','color' => '#25d366','created_at' => NULL,'updated_at' => NULL),
            array('id' => '3','social' => 'twitter','link' => 'https://twitter.com/HimatifUSU','icon' => 'ri-twitter-fill ri-lg','color' => '#1da1f2','created_at' => NULL,'updated_at' => NULL),
            array('id' => '4','social' => 'facebook','link' => 'https://www.facebook.com/usu.himatif/','icon' => 'ri-facebook-fill ri-lg','color' => '#3b5998','created_at' => NULL,'updated_at' => NULL),
            array('id' => '5','social' => 'youtube','link' => 'https://www.youtube.com/himatifUSU','icon' => 'ri-youtube-fill ri-lg','color' => '#ff0000','created_at' => NULL,'updated_at' => NULL)
        );

        /* `db_himatif`.`users` */
        $users = array(
            array('id' => '1','email' => 'webhimatif@gmail.com','username' => 'Admin','password' => '$2y$10$ASRLXhcXVyiLWlYYClcr4eVpBauKOYBZR9p6Uj1UVjjK7KQvlek0i','email_verified_at' => '2022-03-08 00:06:22','activation_hash' => NULL,'activation_status' => '1','activation_expires' => NULL,'reset_hash' => NULL,'reset_at' => NULL,'reset_expires' => NULL,'created_at' => NULL,'updated_at' => NULL),
            array('id' => '19','email' => 'hazenne7@gmail.com','username' => 'gaze','password' => '$2y$10$S5FPqSewy3B4eJhXfwVRcuB8iNhMlW1KdpUQfKv3UWecC/xR8KDyW','email_verified_at' => '2022-03-17 14:35:45','activation_hash' => NULL,'activation_status' => '1','activation_expires' => NULL,'reset_hash' => NULL,'reset_at' => NULL,'reset_expires' => NULL,'created_at' => '2022-03-17 14:35:23','updated_at' => '2022-03-17 14:35:45')
        );

        /* `db_himatif`.`u_m__contacts` */
        $u_m__contacts = array(
            array('id' => '1','social' => 'instagram','link' => 'https://www.instagram.com/himatifshop/','icon' => 'ri-instagram-line ri-lg','color' => 'radial-gradient(circle farthest-corner at 32% 106%,rgb(255, 225, 125) 0%,rgb(255, 205, 105) 10%,rgb(250, 145, 55) 28%,rgb(235, 65, 65) 42%,transparent 82%),linear-gradient(135deg, rgb(35, 75, 215) 12%, rgb(195, 60, 190) 58%)','created_at' => NULL,'updated_at' => NULL),
            array('id' => '2','social' => 'whatsapp','link' => 'https://api.whatsapp.com/send?phone=6288263370735&text=Halo,%20saya%20ingin%20order','icon' => 'ri-whatsapp-line ri-lg','color' => '#25d366','created_at' => NULL,'updated_at' => NULL),
            array('id' => '6','social' => 'line','link' => 'https://line.me/ti/p/~sheliathaya','icon' => 'ri-line-fill ri-lg','color' => '#00B900','created_at' => NULL,'updated_at' => NULL)
        );

        /* `db_himatif`.`visions` */
        $visions = array(
            array('id' => '1','vision' => 'Mewujudkan HIMATIF sebagai wadah dalam meningkatkan karakter, kebersamaan, sosial dan kreatifitas mahasiswa Teknologi Informasi Universitas Sumatera Utara (USU).','created_at' => NULL,'updated_at' => NULL)
        );

        /* `db_himatif`.`work__programs` */
        $work__programs = array(
            array('id' => '1','program' => 'Pelepasan Wisudawan/ti','description' => 'Memberikan kesan dan silaturahmi yang baik kepada para alumni ketika mereka sudah menyelesaikan perkuliahan di Teknologi Informasi.','division_id' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => '2','program' => 'Rapat Koordinasi Anggota','description' => 'Menyiapkan seluruh draft program kerja HIMATIF agar dapat terlaksana sesuai perencanaan.','division_id' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => '3','program' => 'Pengenalan Kehidupan Kampus Mahasiswa Baru Teknologi Informasi 2021','description' => 'Memberikan pembekalan tentang kampus kepada mahasiswa/i baru Teknologi Informasi sehingga mereka lebih siap untuk memulai perkuliahan.','division_id' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => '4','program' => 'Gathering Day 2021','description' => 'Membina rasa kekompakan dan kekeluargaan antar mahasiswa/i Teknologi Informasi dengan para alumni.','division_id' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => '5','program' => 'ITFest','description' => 'Kegiatan puncak HIMATIF yang merupakan rangkaian acara kompetisi IT dan acara puncak hiburan dalam menunjukkan totalitas kinerja pengurus HIMATIF di pemanfaatan sumber daya di Teknologi Informasi.','division_id' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => '6','program' => 'Bakti Sosial HIMATIF','description' => 'Kegiatan sosial dalam memberikan bantuan berupa sembako dan keperluan sehari-hari.','division_id' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => '7','program' => 'HIMATIF Collaboration','description' => 'Mempererat hubungan dan mendapatkan relasi antar organisasi lainnya di bidang IT.','division_id' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => '8','program' => 'Dies Natalis TI 2021 + Gathering Keluarga TI','description' => 'Kegiatan bagi pengurus untuk memperingati hari berdirinya HIMATIF sekaligus wadah keakraban antar seluruh mahasiswa Teknologi Informasi.','division_id' => '1','created_at' => NULL,'updated_at' => NULL),
            array('id' => '9','program' => 'Penjualan Baju HIMATIF','description' => 'Membuat baju HIMATIF dan velcro tape (sesuai tahun kepengurusan), sesuai data anggota himpunan. ','division_id' => '6','created_at' => NULL,'updated_at' => NULL),
            array('id' => '10','program' => 'Penjualan Souvenir Wisuda','description' => 'Menjual souvenir wisuda seperti bucket bunga atau makanan, slempang wisuda dan mozaik','division_id' => '6','created_at' => NULL,'updated_at' => NULL),
            array('id' => '11','program' => 'Penjualan makanan dan minuman','description' => 'Menjual makanan dan minuman dengan sistem PO dan Ready, serta join reseller dari mahasiswa/i Teknologi Informasi yang menjual makanan dan minuman (UMKM)','division_id' => '6','created_at' => NULL,'updated_at' => NULL),
            array('id' => '12','program' => 'HIMATIF Counter','description' => 'Menjual pulsa, token listrik, E-Wallet (OVO, Gopay, Dana dan Shopeepay), install ulang laptop dan Desain poster','division_id' => '6','created_at' => NULL,'updated_at' => NULL),
            array('id' => '13','program' => 'Penjualan Merchandise','description' => 'Menjual gelang, kaos, totebag, dan hoodie yang berhubungan dengan TI','division_id' => '6','created_at' => NULL,'updated_at' => NULL),
            array('id' => '14','program' => 'HIMATIF Shop','description' => 'Membuat dan mengelola akun Instagram khusus menjual Merchandise, makanan dan minuman yang disediakan oleh divisi Usaha Mandiri HIMATIF','division_id' => '6','created_at' => NULL,'updated_at' => NULL),
            array('id' => '15','program' => 'Website HIMATIF','description' => 'Pengembangan dan pemeliharaan website HIMATIF untuk menyalurkan informasi mengenai HIMATIF.','division_id' => '4','created_at' => NULL,'updated_at' => NULL),
            array('id' => '16','program' => 'Mini Competition','description' => 'Kompetisi per-angkatan untuk mahasiswa/i Teknologi Informasi di bidang lomba Competitive Programming dan Best Final Project.','division_id' => '4','created_at' => NULL,'updated_at' => NULL),
            array('id' => '17','program' => 'IT Lead','description' => 'Menangani pengembangan website ITFest dan hal-hal yang bersangkutan lainnya.','division_id' => '4','created_at' => NULL,'updated_at' => NULL),
            array('id' => '18','program' => 'Kelas Produktif','description' => 'Membuka wawasan mengenai bidang Teknologi Informasi dan diberikan materi yang dibutuhkan sehingga mahasiswa/i Teknologi Informasi diharapkan dapat mengikuti perlombaan di bidang Teknologi Informasi.','division_id' => '4','created_at' => NULL,'updated_at' => NULL),
            array('id' => '19','program' => 'HIMATIF Konseling','description' => 'Sebuah wadah bagi mahasiswa/i baru Teknologi Informasi untuk konsultasi dalam masalah materi perkuliahan dan tugas-tugas.','division_id' => '4','created_at' => NULL,'updated_at' => NULL),
            array('id' => '20','program' => 'Project of the Year','description' => 'Sebuah project based learning yang diharapkan dapat membantu mahasiswa/i Teknologi Informasi dalam mengeksplorasi bidang IT untuk memecahkan permasalahan yang ada di sekitarnya.','division_id' => '4','created_at' => NULL,'updated_at' => NULL),
            array('id' => '21','program' => 'HIMATIF Daily on Instagram','description' => 'Memberikan informasi yang menarik setiap harinya dengan tema-tema yang sudah ditentukan.','division_id' => '3','created_at' => NULL,'updated_at' => NULL),
            array('id' => '22','program' => 'Dokumentasi Kegiatan','description' => 'Mengabadikan kegiatan selama masa kepengurusan dalam bentuk foto dan video secara cetak maupun digital.','division_id' => '3','created_at' => NULL,'updated_at' => NULL),
            array('id' => '23','program' => 'Pengelolaan Sosial Media','description' => 'Mengendalikan dan mengurus akun media media social Himatif, diantaranya Instagram, Twitter, OA Whatsapp dan Youtube.','division_id' => '3','created_at' => NULL,'updated_at' => NULL),
            array('id' => '24','program' => 'Design Merchandise','description' => 'Membuat desain produk merchandise yang menarik.','division_id' => '3','created_at' => NULL,'updated_at' => NULL),
            array('id' => '25','program' => 'Himatif Podcast & Radio','description' => 'Memberikan informasi dan hiburan bagi mahasiswa/i Teknologi Informasi dalam bentuk siaran podcast dan siaran radio.','division_id' => '3','created_at' => NULL,'updated_at' => NULL),
            array('id' => '26','program' => 'Mystery Event','description' => 'Menyalurkan aspirasi mahasiswa dalam perencanaan kegiatan yang dapat bersifat akademik maupun non-akademik.','division_id' => '2','created_at' => NULL,'updated_at' => NULL),
            array('id' => '27','program' => 'Webinar','description' => 'Meningkatkan kualitas dan menambah pengalaman mahasiswa Teknologi Informasi dan mahasiswa yang ikut serta dalam webinar ini.','division_id' => '2','created_at' => NULL,'updated_at' => NULL),
            array('id' => '28','program' => 'Pelatihan kepemimpinan','description' => 'Mengajarkan dan memberikan bekal kepada calon pengurus HIMATIF tentang dasar-dasar organisasi termasuk kepemimpinan, kerjasama tim, dan juga wawasan tentang HIMATIF serta memberi pemahaman akan pentingnya kerjasama tim dan fungsi struktural organisasi.','division_id' => '2','created_at' => NULL,'updated_at' => NULL),
            array('id' => '29','program' => 'Campus Life dan Character Building','description' => 'Memberi pengetahuan agar mahasiswa lebih mengenal Teknologi Informasi.','division_id' => '2','created_at' => NULL,'updated_at' => NULL),
            array('id' => '30','program' => 'Form Feedback Program Kerja HIMATIF','description' => 'Mendapatkan informasi dari responden tentang hasil acara yang di buat HIMATIF, mengenai pandangan umum, lebih kurangnya acara, juga saran dan masukan acara kedepannya.','division_id' => '2','created_at' => NULL,'updated_at' => NULL),
            array('id' => '31','program' => 'Mahasiswa Berprestasi dan Sosialisasi Beasiswa','description' => 'Memberikan wadah kepada mahasiswa/i Teknologi Informasi yang memiliki prestasi dan ingin mendapatkan beasiswa.','division_id' => '2','created_at' => NULL,'updated_at' => NULL),
            array('id' => '32','program' => 'Kongkil','description' => 'Memberikan wadah bagi setiap mahasiswa Teknologi Informasi untuk sharing pengetahuan, ide dan pengalaman.','division_id' => '2','created_at' => NULL,'updated_at' => NULL),
            array('id' => '33','program' => 'HIMATIF Super League (HSL)','description' => 'Pertandingan liga futsal antar tim tiap angkatan.','division_id' => '5','created_at' => NULL,'updated_at' => NULL),
            array('id' => '34','program' => 'Creativitiy and Art Competition','description' => 'Kompetisi di bidang seni bagi mahasiswa/i Teknologi Informasi yang bertujuan untuk meningkatkan kreativitas mahasiswa/i Teknologi Informasi.','division_id' => '5','created_at' => NULL,'updated_at' => NULL),
            array('id' => '35','program' => 'Pekan Olahraga HIMATIF (POH)','description' => 'Ajang perlombaan olahraga yang mempertandingkan beberapa cabang olahraga dan esport yang bertujuan untuk membangkitkan sportifitas dan jiwa kompetitif seluruh mahasiswa/i Teknologi Informasi.','division_id' => '5','created_at' => NULL,'updated_at' => NULL),
            array('id' => '36','program' => 'ITphoria','description' => 'Acara gathering sambil bermain (rekreatif) untuk mempererat tali kekeluargaan mahasiswa/i Teknologi Informasi.','division_id' => '5','created_at' => NULL,'updated_at' => NULL),
            array('id' => '37','program' => 'IT ESport','description' => 'Perlombaan ESport yang dibuka untuk masyarakat umum guna meningkatkan kemampuan kerjasama, kekompakan, serta sportifitas dan menjadi wadah untuk berkompetisi.','division_id' => '5','created_at' => NULL,'updated_at' => NULL),
            array('id' => '38','program' => 'Fun & Fit','description' => 'Kegiatan berolahraga yang menyenangkan dan santai bersama keluarga besar Teknologi Informasi seperti futsal dan bulutangkis.','division_id' => '5','created_at' => NULL,'updated_at' => NULL),
            array('id' => '39','program' => 'Kobar','description' => 'Kegiatan kumpul-kumpul santai menikmati pertunjukan musik yang dibawakan oleh mahasiswa/i Teknologi Informasi.','division_id' => '5','created_at' => NULL,'updated_at' => NULL),
            array('id' => '40','program' => 'Infaq TI','description' => 'Infaq yang dilaksanakan satu kali dalam sebulan pada setiap kelas. Uang yang terkumpul dari program ini digunakan untuk tambahan dan kegiatan peduli masyarakat atau anak Yatim Piatu.','division_id' => '7','created_at' => NULL,'updated_at' => NULL),
            array('id' => '41','program' => 'Maulid Nabi','description' => 'Program kolaborasi dengan IMILKOM dan UKMI Al-Khuwarizmi dibawah naungan PEMA FASILKOM-TI dalam memperingati Maulid Nabi untuk menumbuhkan rasa cinta mahasiswa/I muslim TI kepada baginda Rasulullah SAW.','division_id' => '7','created_at' => NULL,'updated_at' => NULL),
            array('id' => '42','program' => 'Mading Mushalla/ Mading Online','description' => 'Memberikan informasi seputar Ilmu agama Islam kepada mahasiswa/i muslim Teknologi Informasi.','division_id' => '7','created_at' => NULL,'updated_at' => NULL),
            array('id' => '43','program' => 'Kajian Keislaman (KALAM)','description' => 'Kajian keislaman yang meliputi kajian mengenai Fiqih, Hadits dan Tafsir Quran yang menargetkan mahasiswa/i Teknologi Informasi muslim untuk meningkatkan ketaqwaan kepada Allah SWT.','division_id' => '7','created_at' => NULL,'updated_at' => NULL),
            array('id' => '44','program' => 'Penerimaan Mahasiswa Baru Muslim','description' => 'Kegiatan penyambutan mahasiswa/i muslim Teknologi Informasi agar sesama mahasiswa/i muslim lebih mengenal satu sama lain dan menjalin silahturahmi.','division_id' => '7','created_at' => NULL,'updated_at' => NULL),
            array('id' => '45','program' => 'Islamic Challenge','description' => 'Lomba desain poster dan video berdurasi 1 menit untuk mahasiswa/i muslim TI dengan tema yang telah disepakati.','division_id' => '7','created_at' => NULL,'updated_at' => NULL),
            array('id' => '46','program' => 'Perayaan Natal TI USU','description' => 'Memperingati kelahiran Yesus Kristus sang Juruselamat ke dunia dengan mengadakan Perayaan Natal.','division_id' => '8','created_at' => NULL,'updated_at' => NULL),
            array('id' => '47','program' => 'Christian Students of Technology Information Day (CSoIT-Day)','description' => 'Mengadakan acara penyambutan dan pengenalan mahasiswa/i baru dan mahasiswa/i aktif serta alumni yang kristen.','division_id' => '8','created_at' => NULL,'updated_at' => NULL),
            array('id' => '48','program' => 'Paskah TI USU','description' => 'Untuk merayakan kebangkitan Sang Juruselamat melawan maut.','division_id' => '8','created_at' => NULL,'updated_at' => NULL),
            array('id' => '49','program' => 'Kebaktian Teknologi Informasi','description' => 'Mengadakan kebaktian bulanan untuk kebutuhan rohani.','division_id' => '8','created_at' => NULL,'updated_at' => NULL),
            array('id' => '50','program' => 'Cso-ITalk','description' => 'Live session instagram bersama mahasiswa/i kristen Teknologi Informasi untuk diskusi mengenai isu-isu trend dan membahas menurut kristen bersama narasumber kristen TI.','division_id' => '8','created_at' => NULL,'updated_at' => NULL),
            array('id' => '51','program' => 'Kartu Ucapan','description' => 'Membuat kartu ucapan ulang tahun, wisuda dan lain-lain, serta penjangkauan sosial media CSoIT.','division_id' => '8','created_at' => NULL,'updated_at' => NULL),
            array('id' => '52','program' => 'Renungan','description' => 'Membuat renungan serta motivasi-motivasi di OA Line dan akun Instagram.','division_id' => '8','created_at' => NULL,'updated_at' => NULL),
            array('id' => '53','program' => 'Mini Quiz/ Mini Competition','description' => 'Mengadakan perlombaan antar mahasiswa/i Kristen Teknologi Informasi seperti memberikan soal-soal quiz mengenai pendalaman Alkitab dan kompetisi seperti cover lagu rohani dan lain sebagainya.','division_id' => '8','created_at' => NULL,'updated_at' => NULL),
            array('id' => '54','program' => 'Sharing','description' => 'Menentukan sebuah topik dan mengundang narasumber untuk menjawab pertanyaan mengenai topik yang sudah ditentukan.','division_id' => '9','created_at' => NULL,'updated_at' => NULL),
            array('id' => '55','program' => 'All About Buddhist','description' => 'Memposting informasi mengenai agama Buddha pada sosial media Instagram.','division_id' => '9','created_at' => NULL,'updated_at' => NULL),
            array('id' => '56','program' => 'Hari Raya Suci Agama Buddha','description' => 'Merayakan hari-hari besar agama Buddha yaitu Waisak, Asadha, Maghapuja, dan Kathina.','division_id' => '9','created_at' => NULL,'updated_at' => NULL),
            array('id' => '57','program' => 'Silahturahmi Imlek','description' => 'Acara keakraban dalam rangka perayaan imlek dengan bersilahturahmi ke rumah mahasiswa/i 
            Buddhis Teknologi Informasi.','division_id' => '9','created_at' => NULL,'updated_at' => NULL),
            array('id' => '58','program' => 'Makrab','description' => 'Acara mempertemukan mahasiswa/i baru Teknologi Informasi dengan senior sesama agama Buddha agar bisa saling mengenal satu sama lain.','division_id' => '9','created_at' => NULL,'updated_at' => NULL)
        );

        collect($positions)->each(function ($position) { Position::create($position); });
        collect($visions)->each(function ($vision) { Vision::create($vision); });
        collect($maintenance__infos)->each(function ($info) { Maintenance_Info::create($info); });
        collect($management__years)->each(function ($year) { Management_Year::create($year); });
        collect($missions)->each(function ($mission) { Mission::create($mission); });
        collect($histories)->each(function ($history) { History::create($history); });
        collect($users)->each(function ($user) { User::create($user); });
        collect($services)->each(function ($service) { Service::create($service); });
        collect($u_m__contacts)->each(function ($contact) { UM_Contact::create($contact); });
        collect($social__media)->each(function ($social) { Social_Media::create($social); });
        collect($product__categories)->each(function ($category) { Product_Category::create($category); });
        collect($shop__items)->each(function ($item) { Shop_Item::create($item); });
        collect($product__colors)->each(function ($color) { Product_Color::create($color); });
        collect($product__galleries)->each(function ($gallery) { Product_Gallery::create($gallery); });
        collect($product__prices)->each(function ($price) { Product_Price::create($price); });
        collect($product__with__colors)->each(function ($color) { Product_With_Color::create($color); });
        collect($divisions)->each(function ($division) { Division::create($division); });
        collect($work__programs)->each(function ($program) { Work_Program::create($program); });
        collect($commitees)->each(function ($commitee) { Commitee::create($commitee); });
        collect($posts)->each(function ($post) { Post::create($post); });
    }
}
