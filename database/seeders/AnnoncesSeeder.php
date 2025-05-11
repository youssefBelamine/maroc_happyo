<?php

namespace Database\Seeders;

use App\Models\Announce;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AnnoncesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        

        $annonces = [
            [
                'tel' => '0611223345',
                'prix' => 2500,
                'titre_annonce' => 'SAMSUNG A55 5G',
                'texte_annonce' => "SAMSUNG A55 5G\nRAM : 8 GB\nROM : 128 GB\nCOULEUR : Bleu marine\nPRIX : 2500 DH",
                'secteur_id' => 20,
                'categorie_id' => 7,
                'user_id' => 2,
                'created_at' => '2025-05-09 10:06:08',
                'updated_at' => '2025-05-09 10:06:08',
            ],
            [
                'tel' => '0611223345',
                'prix' => 23000,
                'titre_annonce' => 'Tapis de course Matrix T5x black',
                'texte_annonce' => "Bonjour,\nJe mets en vente des tapis de course de la marque matrix t5x importer occasion avec garantie 1 an",
                'secteur_id' => 1,
                'categorie_id' => 11,
                'user_id' => 2,
                'created_at' => '2025-05-09 10:47:09',
                'updated_at' => '2025-05-09 10:47:09',
            ],
            [
                'tel' => '0611223345',
                'prix' => 16503,
                'titre_annonce' => 'MacBook Pro 14 M2 Max 32Go1To',
                'texte_annonce' => "MacBook Pro 14 M2 Max\n32Gb Ram\n1To SSD Stockage\nCycle 390\n32cor",
                'secteur_id' => 21,
                'categorie_id' => 8,
                'user_id' => 2,
                'created_at' => '2025-05-09 10:51:38',
                'updated_at' => '2025-05-09 10:51:38',
            ],
            [
                'tel' => '0611223345',
                'prix' => 950000,
                'titre_annonce' => 'Cozy studio a vendre ferme breton',
                'texte_annonce' => "Nous mettons en vente un cozy studio dans un immeuble propre de 45m cuisine séparée au 2 eme etage avec ascenseur garage cuisine équipée disponible pour visiter",
                'secteur_id' => 3,
                'categorie_id' => 16,
                'user_id' => 2,
                'created_at' => '2025-05-09 13:48:32',
                'updated_at' => '2025-05-09 13:48:32',
            ],
            [
                'tel' => '0611223345',
                'prix' => 2200,
                'titre_annonce' => 'Rockrider st 120',
                'texte_annonce' => 'pikala n9iya libghaha mrhba',
                'secteur_id' => 22,
                'categorie_id' => 15,
                'user_id' => 2,
                'created_at' => '2025-05-09 14:00:12',
                'updated_at' => '2025-05-09 14:00:12',
            ],
            [
                'tel' => '0611223345',
                'prix' => 144500,
                'titre_annonce' => 'YAMAHA MT 09 SP',
                'texte_annonce' => 'MT 09 SP MODEL 2022 DOUAN 2025',
                'secteur_id' => 91,
                'categorie_id' => 14,
                'user_id' => 2,
                'created_at' => '2025-05-09 14:07:14',
                'updated_at' => '2025-05-09 14:07:14',
            ],
            [
                'tel' => '0611223345',
                'prix' => 4000,
                'titre_annonce' => 'Électroménager à vendre',
                'texte_annonce' => "Vente trois articles en très bon état:\n- lave linge LG séchant 13/8 kg: 5000 DHS\n- lave vaisselle Whirlpool 12 couverts: 4000 DHS\n- cuisinière Whirlpool quatre feux et four: 2500 DHS",
                'secteur_id' => 21,
                'categorie_id' => 9,
                'user_id' => 2,
                'created_at' => '2025-05-09 14:10:43',
                'updated_at' => '2025-05-09 14:10:43',
            ],
            [
                'tel' => '0611223345',
                'prix' => 220,
                'titre_annonce' => 'protein mass tech 430g',
                'texte_annonce' => "430g من أفضل أنواع البروتين mass tech\nأفضل مكمل غذائي بأفضل ثمن\nالمرجو التواصل معي لشراء أو الإستفسارات.",
                'secteur_id' => 76,
                'categorie_id' => 12,
                'user_id' => 2,
                'created_at' => '2025-05-09 14:32:09',
                'updated_at' => '2025-05-09 14:32:09',
            ],
            [
                'tel' => '0611223345',
                'prix' => 320000,
                'titre_annonce' => 'Mercedes Benz classe c W205 AMG line c 220',
                'texte_annonce' => 'mercedes Benz classe c W205 AMG line c 220 Importé neuf kilométrage 130 000km modèle 2015 immatriculation RABAT H1',
                'secteur_id' => 88,
                'categorie_id' => 13,
                'user_id' => 2,
                'created_at' => '2025-05-09 17:58:40',
                'updated_at' => '2025-05-09 17:58:40',
            ],
            [
                'tel' => '0611223345',
                'prix' => 8500,
                'titre_annonce' => 'iPhone 14 pro max 256gb',
                'texte_annonce' => "iPhone 14 pro max très neuf avec boite et accessoires\n\nCouleur black , téléphone acheté neuf, aucune fissure ou rayures",
                'secteur_id' => 77,
                'categorie_id' => 7,
                'user_id' => 2,
                'created_at' => '2025-05-09 18:02:32',
                'updated_at' => '2025-05-09 18:02:32',
            ],
            [
                'tel' => '0611223345',
                'prix' => 60000,
                'titre_annonce' => 'Mercedes-Benz 250 Diesel Automatique 1992',
                'texte_annonce' => 'Mercedes Benz 250 Diesel premier main Dédouanée 2010 original très belle peinture jamais reçu dans les bon état',
                'secteur_id' => 81,
                'categorie_id' => 13,
                'user_id' => 2,
                'created_at' => '2025-05-10 15:07:08',
                'updated_at' => '2025-05-10 15:07:08',
            ],
        ];
        
        $newAnnonces = array_map(function ($annonce) {
            $annonce['user_id'] = "".rand(1, 10);
            return $annonce;
        }, $annonces);
        

        foreach ($newAnnonces as $annonce) {
            Announce::create($annonce);
        }
        
    }
}
