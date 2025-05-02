<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Ville;
use App\Models\Secteur;
use App\Models\Categorie;
use App\Models\ChampsCat;
use App\Models\OptionChamp;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Moroccan cities and secteurs
        $moroccanCities = [
            'Casablanca' => ['Maarif', 'Anfa', 'Ain Chock', 'Sidi Bernoussi', 'Hay Hassani', 'Ben M\'sik',
                'Sidi Moumen', 'Ain Sebaa', 'Al Fida', 'Mers Sultan', 'Sbata', 'Sidi Othmane',
                'Moulay Rachid', 'Oulfa', 'Hay Mohammadi', 'Errahma', 'Tamaris', 'Dar Bouazza'],
            'Rabat' => ['Agdal-Ryad', 'Yacoub El Mansour', 'Hassan', 'Souissi', 'El Youssoufia', 'Touarga',
                'Hay Nahda', 'Hay Riad', 'Hay Al Fath', 'Akkari', 'L\'Ocean', 'Takaddoum', 'Salé Annexe'],
            'Salé' => ['Tabriquet', 'Bettana', 'Sidi Moussa', 'Laayayda', 'Hssaine', 'Hay Salam',
                'Hay Inbiaat', 'Hay Essalam', 'Bouknadel', 'Sidi Bouknadel', 'Sala Al Jadida'],
            'Marrakech' => ['Medina', 'Gueliz', 'Menara', 'Sidi Youssef Ben Ali', 'Annakhil', 'Daoudiate',
                'Chrifia', 'Massira', 'Azli', 'Bab Doukkala', 'Targa', 'Samih', 'Ait Ourir'],
            'Fes' => ['aouinat hajjaj', 'Fes El Bali', 'Fes Jdid', 'Agdal', 'Sais', 'Zouagha', 'Dar Dbibegh', 'Jnane Sbile',
                'Mont Fleuri', 'Laymoune', 'Oued Fes', 'Bensouda', 'Ain Kadous', 'Ras El Ma'],
            'Tangier' => ['Marshan', 'Iberia', 'Malabata', 'Charf', 'Beni Makada', 'Ziaten', 'Dradeb', 'Casabarata',
                'Tanja Balia', 'Gzenaya', 'Achakar', 'Souani', 'Mesnana', 'Mghogha'],
            'Agadir' => ['Talborjt', 'Hay Mohammadi', 'Dakhla', 'Anza', 'Bensergao', 'Tilila', 'Tikiouine',
                'Amsernat', 'Cité Suisse', 'Founty', 'Quartier Industriel', 'Aghroud', 'Inezgane'],
            'Oujda' => ['Ville Nouvelle', 'Sidi Yahya', 'El Qods', 'Hay Al Amal', 'Hay Al Jadid',
                'Beni Oukil', 'Hay Al Andalous', 'Hay Isly', 'Sidi Ziane', 'Sidi Maafa'],
            'Meknes' => ['Hamria', 'Medina', 'Marjane', 'Sidi Bouzekri', 'Touarga', 'Ouislane',
                'Bassatine', 'Ain Slougui', 'Toulal', 'Zitouna', 'Ain Choubik'],
            'Kenitra' => ['Maamora', 'Ouled Oujih', 'Bir Rami', 'La Ville Haute', 'Mehdia',
                'Hay Salam', 'Hay Oulad M\'barek', 'Hay Saknia', 'Hay Wifak', 'Hay Massira'],
            'Tetouan' => ['Medina', 'Martil', 'Fnideq', 'Azla', 'M\'diq', 'Souani', 'Dar Akouba',
                'Sania', 'Oued Laou', 'Aouinat El Mellouk', 'Beni Harchen'],
            'Mohammedia' => ['Hay Al Alia', 'Hay Al Amal', 'Hay Al Wafa', 'Sablettes',
                'La Siesta', 'Al Massira', 'Mimosas', 'Errahma', 'Lotissement Najah'],
            'El Jadida' => ['Centre Ville', 'Hay Essalam', 'Hay El Hana', 'Sidi Bouzid', 'Hay Mazagan',
                'Hay El Baraka', 'Derb Ghalef', 'Doukkala', 'Hay Ennakhil', 'Hay Massira'],
            'Nador' => ['Selouane', 'Beni Ansar', 'Zaio', 'Al Aroui', 'Bouarfa', 'Ihaddaden',
                'Tiztoutine', 'Midar', 'Beni Chiker', 'Zeghanghane'],
            'Settat' => ['Hay Al Amal', 'Hay Ennakhil', 'Hay Salam', 'Hay Massira', 'Oulad Sghir',
                'Hay Belair', 'Hay Ennasr', 'Sidi Hajjaj', 'Kasbat Ben Ahmed', 'Hay Slaoui'],
            'Beni Mellal' => ['Hay Al Massira', 'Hay El Qods', 'Hay Ennakhil', 'Hay Salam', 'Hay Al Fath',
                'Dar Bouazza', 'Hay Azhar', 'Oulad Yaich', 'Hay Mghila', 'Bouqroum'],
        ];
        foreach ($moroccanCities as $villeName => $secteurs) {
            $ville = Ville::create(['ville' => $villeName]);
            foreach ($secteurs as $secteur) {
                Secteur::create(['secteur' => $secteur, 'ville_id' => $ville->id]);
            }
        }

        /*
        |--------------------------------------------------------------------------
        | 2. Seed Categories and Subcategories
        |--------------------------------------------------------------------------
        */
        $market       = Categorie::create(['name' => 'Market']);
        $vehicules    = Categorie::create(['name' => 'Véhicules']);
        $immobilier   = Categorie::create(['name' => 'Immobilier']);

        $informatique = Categorie::create(['name' => 'Tech et Multimédia', 'parent_id' => $market->id]);
        $maisonJardin = Categorie::create(['name' => 'Maison et Jardin', 'parent_id' => $market->id]);
        $bienEtre     = Categorie::create(['name' => 'Santé & Sport', 'parent_id' => $market->id]);

        $phones       = Categorie::create(['name' => 'Téléphone', 'parent_id' => $informatique->id]);
        $ordinateurs  = Categorie::create(['name' => 'Ordinateurs portables', 'parent_id' => $informatique->id]);
        $Electromenager = Categorie::create(['name' => 'Electroménager', 'parent_id' => $maisonJardin->id]);
        $Decoration = Categorie::create(['name' => 'Décoration', 'parent_id' => $maisonJardin->id]);
        $equipement   = Categorie::create(['name' => 'Equipement Sportif', 'parent_id' => $bienEtre->id]);
        $supplement   = Categorie::create(['name' => 'Complément Alimentaires', 'parent_id' => $bienEtre->id]);

        $voiture      = Categorie::create(['name' => 'Voitures', 'parent_id' => $vehicules->id]);
        $moto         = Categorie::create(['name' => 'Motos', 'parent_id' => $vehicules->id]);
        $velo         = Categorie::create(['name' => 'Vélos', 'parent_id' => $vehicules->id]);
        $appart       = Categorie::create(['name' => 'Appartement', 'parent_id' => $immobilier->id]);
        $maison       = Categorie::create(['name' => 'Maison', 'parent_id' => $immobilier->id]);

        /*
        |--------------------------------------------------------------------------
        | 3. Define Common Field Options
        |--------------------------------------------------------------------------
        */
        $commonStates = ['Neuf', 'Excellent', 'Très bon', 'Bon', 'Moyen', 'Endommagé', 'Pour pièces'];

        /*
        |--------------------------------------------------------------------------
        | 4. Helper function for Field Seeding
        |--------------------------------------------------------------------------
        */
        $seedFields = function (int $catId, array $fields) {
            foreach ($fields as $field) {
                $champ = ChampsCat::create([
                    'categorie_id' => $catId,
                    'nom'          => Str::snake($field['name']),
                    'label'        => $field['label'],
                    'type'         => $field['type'],
                    'obligatoire'  => $field['required'],
                ]);

                if (!empty($field['options'])) {
                    foreach ($field['options'] as $opt) {
                        OptionChamp::create([
                            'champs_cat_id' => $champ->id,
                            'valeur'        => Str::slug($opt, '_'),
                            'etiquette'     => $opt,
                        ]);
                    }
                }
            }
        };

        /*
        |--------------------------------------------------------------------------
        | 5. Seed Specific Fields for Certain Categories
        |--------------------------------------------------------------------------
        */

        // Fields for Phones
        $seedFields($phones->id, [
            ['name'=>'marque_telephone','label'=>'Choisissez la marque du téléphone','type'=>'select','required'=>true,'options'=>["Samsung","Apple","Xiaomi","Huawei","OPPO","vivo","realme","OnePlus","Motorola","Tecno","Infinix","Google","Nokia","Sony","Asus","ZTE","Lenovo","Honor","itel","Meizu"]],
            ['name'=>'capacite_stockage','label'=>'Choisissez la capacité de stockage','type'=>'radio','required'=>true,'options'=>["32GB","64GB","128GB","256GB","512GB","1TB"]],
        ]);

        // fields for computers
        $seedFields($ordinateurs->id, [
            ['name'=>'marque_pc','label'=>'Choisissez la marque de lordinateur','type'=>'select','required'=>true,'options'=>["Apple","Dell","HP","Lenovo","Asus","Acer","MSI","Razer","Microsoft","Samsung","Huawei","LG","Toshiba","Sony","Panasonic","Alienware","Gigabyte","Google","Xiaomi","Fujitsu"]],
        ]);
        
        // Shared fields (prix, titre_annonce, texte_annonce)

        // foreach ([$Electromenager, $equipement, $supplement, $ordinateurs, $phones, $voiture, $moto, $velo] as $cat){
        //     $seedFields($cat->id, [
        //         ['name'=>'prix','label'=>'Prix','type'=>'number','required'=>true,'options'=>[]],
        //         ['name'=>'titre_annonce','label'=>'Titre de l\'annonce','type'=>'text','required'=>true,'options'=>[]],
        //         ['name'=>'texte_annonce','label'=>'Texte de l\'annonce','type'=>'textarea','required'=>false,'options'=>[]],
        //     ]);
        // }

         // Shared "etat" field
        foreach ([$Electromenager, $equipement, $ordinateurs, $phones, $moto, $voiture] as $cat) {
            $seedFields($cat->id, [
                ['name'=>'etat','label'=>'État','type'=>'radio','required'=>true,'options'=>$commonStates],
            ]);
        }
        
        /*
        |--------------------------------------------------------------------------
        | 6. Prepare Future Data for Vehicles (In Progress)
        |--------------------------------------------------------------------------
        */

        $car_brands = ["Toyota","Volkswagen","Ford","Honda","Nissan","Chevrolet","Hyundai","Kia","Mazda","Subaru","Peugeot","Renault","Fiat","Dacia","Citroën","Opel","Mercedes-Benz","BMW","Audi"];
        
        $vehicule_models = [];
        for ($year=date('Y'); $year>=1980; $year--) {
            $vehicule_models[] = $year===1980 ? "$year ou plus ancien" : (string)$year;
        }
        $kilometrage_intervales = [];
        $step=5000;
        for ($i=0; $i<=450000; $i+=$step) {
            if ($i>=100000) $step=10000;
            if ($i>=200000) $step=50000;
            $max=($i+$step-1);
            $kilometrage_intervales[] = $i===450000 ? "Plus de " . ($i+$step) : "$i - $max";
        }
        $Puissance_fiscales = [];
        for ($i=4; $i<=41; $i++) {
            $Puissance_fiscales[] = $i===41 ? "Plus de $i CV" : "$i CV";
        }

        $Types_de_carburant = ["Essence","Diesel","Electrique","LPG","Hybride"];

        $Boite_de_vitesses = ["Automatique","Manuelle"];

        $vehicule_origine = ['Dédouanée','Pas encore dédouanée','WW au Maroc','Importée neuve'];

        $seedFields($voiture->id, [
            ['name'=>'marque','label'=>'Marque','type'=>'select','required'=>true,'options'=>$car_brands],
            ['name'=>Str::snake('modele'),'label'=>'Modèle','type'=>'select','required'=>true,'options'=>$vehicule_models],
            ['name'=>"kilometrage",'label'=>'Kilométrage','type'=>'select','required'=>true,'options'=>$kilometrage_intervales],
            ['name'=>"puissance_fiscale",'label'=>'Puissance fiscale','type'=>'select','required'=>true,'options'=>$Puissance_fiscales],
            ['name'=>"type_carburant",'label'=>'Type de carburant','type'=>'select','required'=>true,'options'=>$Types_de_carburant],
            ['name'=>"boite_vitesses",'label'=>'Boîte de vitesses','type'=>'select','required'=>true,'options'=>$Boite_de_vitesses],
            ['name'=>"origine",'label'=>'Origine','type'=>'radio','required'=>true,'options'=>$vehicule_origine],
        ]);

        $seedFields($moto->id, [
            ['name'=>Str::snake('modele'),'label'=>'Modèle','type'=>'select','required'=>true,'options'=>$vehicule_models],
            ['name'=>"kilometrage",'label'=>'Kilométrage','type'=>'select','required'=>true,'options'=>$kilometrage_intervales],
            ['name'=>"cylindree",'label'=>'Cylindrée','type'=>'number','required'=>true,'options'=>[]],
            ['name'=>Str::snake('Hauteur de selle'),'label'=>'Hauteur de selle','type'=>'number','required'=>true,'options'=>[]],
            ['name'=>"origine",'label'=>'Origine','type'=>'radio','required'=>true,'options'=>$vehicule_origine],
        ]);

        $age_du_bien = ["Moins de 1 an","1-5 ans","6-10 ans","10-20 ans","Plus de 20 ans"];
        $Condition = ["Neuf", "Bon état", "à rénover"];
        foreach ([$maison, $appart] as $cat) {
            $seedFields($cat->id, [
                ['name'=>Str::snake('chambres'),'label'=>'Chambres','type'=>'number','required'=>true,'options'=>[]],
                ['name'=>Str::snake('salons'),'label'=>'Salons','type'=>'number','required'=>true,'options'=>[]],
                ['name'=>Str::snake('Salle de bain'),'label'=>'Salle de bain','type'=>'number','required'=>true,'options'=>[]],
                ['name'=>Str::snake('Nombre_etage'),'label'=>'Nombre d\'étage','type'=>'number','required'=>true,'options'=>[]],
                ['name'=>Str::snake('Surface'),'label'=>'Surface en m2','type'=>'number','required'=>true,'options'=>[]],
                ['name'=>Str::snake('age du bien'),'label'=>'Âge du bien','type'=>'radio','required'=>true,'options'=>$age_du_bien],
                ['name'=>Str::snake('Condition'),'label'=>'Condition','type'=>'radio','required'=>true,'options'=>$Condition],
            ]);
        }

        $seedFields($maison->id, [
            ['name'=>Str::snake('Nombre_etage'),'label'=>'Nombre d\'étage','type'=>'number','required'=>true,'options'=>[]],
        ]);

        $seedFields($appart->id, [
            ['name'=>Str::snake('etage'),'label'=>'Étage','type'=>'number','required'=>true,'options'=>[]],
        ]);
        $this->call([
            UsersSeeder::class
        ]);
    }
}
