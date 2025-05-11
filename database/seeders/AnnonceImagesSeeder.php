<?php

namespace Database\Seeders;

use App\Models\AnnounceImage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AnnonceImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
$images = [
    ['chemin' => 'storage/annonces/samsung-a55-5g-20250509110608-90Cg5e.jpg', 'announce_id' => 1, 'created_at' => '2025-05-09 10:06:08', 'updated_at' => '2025-05-09 10:06:08'],
    ['chemin' => 'storage/annonces/samsung-a55-5g-20250509110608-bJijcG.jpg', 'announce_id' => 1, 'created_at' => '2025-05-09 10:06:08', 'updated_at' => '2025-05-09 10:06:08'],
    ['chemin' => 'storage/annonces/tapis-de-course-matrix-t5x-black-20250509114709-nQdZQW.jpg', 'announce_id' => 2, 'created_at' => '2025-05-09 10:47:09', 'updated_at' => '2025-05-09 10:47:09'],
    ['chemin' => 'storage/annonces/tapis-de-course-matrix-t5x-black-20250509114709-xwsXy2.jpg', 'announce_id' => 2, 'created_at' => '2025-05-09 10:47:09', 'updated_at' => '2025-05-09 10:47:09'],
    ['chemin' => 'storage/annonces/tapis-de-course-matrix-t5x-black-20250509114709-jv5crg.jpg', 'announce_id' => 2, 'created_at' => '2025-05-09 10:47:09', 'updated_at' => '2025-05-09 10:47:09'],
    ['chemin' => 'storage/annonces/macbook-pro-14-m2-max-32go1to-20250509115138-LhY5zw.jpg', 'announce_id' => 3, 'created_at' => '2025-05-09 10:51:38', 'updated_at' => '2025-05-09 10:51:38'],
    ['chemin' => 'storage/annonces/macbook-pro-14-m2-max-32go1to-20250509115138-RDiEst.jpg', 'announce_id' => 3, 'created_at' => '2025-05-09 10:51:38', 'updated_at' => '2025-05-09 10:51:38'],
    ['chemin' => 'storage/annonces/cozy-studio-a-vendre-ferme-breton-20250509144832-tB2LBu.jpg', 'announce_id' => 4, 'created_at' => '2025-05-09 13:48:32', 'updated_at' => '2025-05-09 13:48:32'],
    ['chemin' => 'storage/annonces/cozy-studio-a-vendre-ferme-breton-20250509144832-hwHlJj.jpg', 'announce_id' => 4, 'created_at' => '2025-05-09 13:48:32', 'updated_at' => '2025-05-09 13:48:32'],
    ['chemin' => 'storage/annonces/rockrider-st-120-20250509150012-2ZZDOs.jpg', 'announce_id' => 5, 'created_at' => '2025-05-09 14:00:12', 'updated_at' => '2025-05-09 14:00:12'],
    ['chemin' => 'storage/annonces/rockrider-st-120-20250509150012-tS3CsK.jpg', 'announce_id' => 5, 'created_at' => '2025-05-09 14:00:12', 'updated_at' => '2025-05-09 14:00:12'],
    ['chemin' => 'storage/annonces/yamaha-mt-09-sp-20250509150714-Vcntsi.jpg', 'announce_id' => 6, 'created_at' => '2025-05-09 14:07:14', 'updated_at' => '2025-05-09 14:07:14'],
    ['chemin' => 'storage/annonces/yamaha-mt-09-sp-20250509150714-4uTU4m.jpg', 'announce_id' => 6, 'created_at' => '2025-05-09 14:07:15', 'updated_at' => '2025-05-09 14:07:15'],
    ['chemin' => 'storage/annonces/electromenager-a-vendre-20250509151043-oFHMsb.jpg', 'announce_id' => 7, 'created_at' => '2025-05-09 14:10:43', 'updated_at' => '2025-05-09 14:10:43'],
    ['chemin' => 'storage/annonces/electromenager-a-vendre-20250509151043-3N6Njl.jpg', 'announce_id' => 7, 'created_at' => '2025-05-09 14:10:43', 'updated_at' => '2025-05-09 14:10:43'],
    ['chemin' => 'storage/annonces/protein-mass-tech-430g-20250509153209-yIbqmB.jpg', 'announce_id' => 8, 'created_at' => '2025-05-09 14:32:09', 'updated_at' => '2025-05-09 14:32:09'],
    ['chemin' => 'storage/annonces/mercedes-benz-classe-c-w205-amg-line-c-220-20250509185840-bjj9t3.jpg', 'announce_id' => 9, 'created_at' => '2025-05-09 17:58:40', 'updated_at' => '2025-05-09 17:58:40'],
    ['chemin' => 'storage/annonces/mercedes-benz-classe-c-w205-amg-line-c-220-20250509185840-FowqxW.jpg', 'announce_id' => 9, 'created_at' => '2025-05-09 17:58:40', 'updated_at' => '2025-05-09 17:58:40'],
    ['chemin' => 'storage/annonces/iphone-14-pro-max-256gb-20250509190232-hHw5vD.jpg', 'announce_id' => 10, 'created_at' => '2025-05-09 18:02:32', 'updated_at' => '2025-05-09 18:02:32'],
    ['chemin' => 'storage/annonces/mercedes-benz-250-diesel-automatique-1992-20250510160709-Ft95nR.jpg', 'announce_id' => 11, 'created_at' => '2025-05-10 15:07:09', 'updated_at' => '2025-05-10 15:07:09'],
];

foreach ($images as $image) {

    AnnounceImage::create($image);

}

    }
}
