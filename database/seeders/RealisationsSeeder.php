<?php

namespace Database\Seeders;

use App\Models\Realisation;
use App\Models\Categorie;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RealisationsSeeder extends Seeder
{
    public function run(): void
    {
        // Vérifiez que les catégories existent
        if (Categorie::count() === 0) {
            $this->call(CategoriesSeeder::class);
        }

        $realisations = [
            [
                'title' => 'Rebranding Total Energies',
                'slug' => 'rebranding-total-energies',
                'client' => 'Total Energies',
                'sector' => 'Énergie',
                'country' => 'Bénin',
                'type' => 'Branding Complet',
                'completion_date' => '2024-06-15',
                'summary' => 'Refonte complète de l\'identité visuelle pour le marché africain avec une approche moderne et durable.',
                'description' => 'Nous avons travaillé avec Total Energies pour redéfinir leur identité visuelle sur le marché béninois. Le projet incluait la création d\'un nouveau logo, une charte graphique complète, et des supports de communication adaptés aux réalités locales.',
                'context' => 'Total souhaitait moderniser son image pour mieux cibler la jeune génération tout en conservant son héritage de confiance.',
                'solution' => 'Création d\'une identité visuelle dynamique intégrant des éléments culturels béninois avec une approche écologique.',
                'results' => 'Augmentation de 40% de la reconnaissance de marque auprès des 18-35 ans en 3 mois.',
                'client_testimony' => 'KOTAVA a parfaitement saisi notre vision et l\'a transformée en une identité forte et contemporaine.',
                'image' => 'https://images.unsplash.com/photo-1634942537034-2531766767d1?w=800&auto=format&fit=crop',
                'published' => 1,
                'statut' => 'publié',
                'featured' => 1,
                'categorie_id' => 1, // Branding
                'media' => json_encode([
                    'https://images.unsplash.com/photo-1634942537034-2531766767d1?w=800&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1561070791-2526d30994b5?w-800&auto=format&fit=crop',
                ]),
            ],
            [
                'title' => 'Site E-commerce AgroTech',
                'slug' => 'site-ecommerce-agrotech',
                'client' => 'AgroTech Solutions',
                'sector' => 'Agriculture',
                'country' => 'Côte d\'Ivoire',
                'type' => 'Site E-commerce',
                'completion_date' => '2024-08-20',
                'summary' => 'Plateforme e-commerce pour produits agricoles avec intégration de paiements mobiles locaux.',
                'description' => 'Développement d\'une plateforme e-commerce complète permettant aux agriculteurs ivoiriens de vendre leurs produits directement aux consommateurs. Intégration des paiements Orange Money et MTN Mobile Money.',
                'context' => 'AgroTech Solutions souhaitait digitaliser la vente de produits agricoles pour réduire les intermédiaires.',
                'solution' => 'Création d\'un marketplace sécurisé avec catalogue produit, système de commande et livraison, et intégration des paiements mobiles.',
                'results' => 'Plus de 500 vendeurs inscrits en 2 mois, avec un chiffre d\'affaires de 50M FCFA le premier mois.',
                'client_testimony' => 'La plateforme a révolutionné notre business modèle. Simple, efficace et parfaitement adaptée à notre marché.',
                'image' => 'https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=800&auto=format&fit=crop',
                'published' => 1,
                'statut' => 'publié',
                'featured' => 1,
                'categorie_id' => 2, // Web & Digital
                'media' => json_encode([
                    'https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=800&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=800&auto=format&fit=crop',
                ]),
            ],
            [
                'title' => 'Campagne Instagram BeniPlus',
                'slug' => 'campagne-instagram-benoplus',
                'client' => 'BeniPlus',
                'sector' => 'Distribution',
                'country' => 'Bénin',
                'type' => 'Campagne Social Media',
                'completion_date' => '2024-09-10',
                'summary' => 'Stratégie de contenu et publicité ciblée sur Instagram pour augmenter l\'engagement et les ventes.',
                'description' => 'Gestion complète de la présence Instagram de BeniPlus avec création de contenu quotidien, stories interactives, et campagnes publicitaires ciblées. Utilisation d\'influenceurs locaux pour amplifier la portée.',
                'context' => 'BeniPlus souhaitait augmenter sa visibilité digitale auprès des jeunes consommateurs urbains.',
                'solution' => 'Stratégie de contenu 360° incluant création visuelle, planning éditorial, publicité sponsorisée et collaboration avec influenceurs.',
                'results' => 'Augmentation de 300% des followers en 2 mois, engagement moyen de 8% (vs 2% auparavant).',
                'client_testimony' => 'Les résultats dépassent nos attentes. KOTAVA a parfaitement compris notre audience.',
                'image' => 'https://images.unsplash.com/photo-1611262588024-d12430b98920?w=800&auto=format&fit=crop',
                'published' => 1,
                'statut' => 'publié',
                'featured' => 0,
                'categorie_id' => 3, // Social Media
                'media' => json_encode([
                    'https://images.unsplash.com/photo-1611262588024-d12430b98920?w=800&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1611605698323-b1e99cfd37ea?w=800&auto=format&fit=crop',
                ]),
            ],
            [
                'title' => 'Film Corporate TechStart Africa',
                'slug' => 'film-corporate-techstart-africa',
                'client' => 'TechStart Africa',
                'sector' => 'Technologie',
                'country' => 'Afrique du Sud',
                'type' => 'Production Vidéo',
                'completion_date' => '2024-10-05',
                'summary' => 'Film corporate présentant la vision et les réalisations de cette startup tech africaine.',
                'description' => 'Production d\'un film corporate de 5 minutes incluant interviews des fondateurs, séquences en motion design, et tournage dans les bureaux de Johannesburg. Le film a été utilisé pour les investisseurs et les salons internationaux.',
                'context' => 'TechStart Africa avait besoin d\'un support vidéo professionnel pour attirer des investisseurs étrangers.',
                'solution' => 'Production d\'un film haute qualité avec storytelling fort, mettant en avant l\'innovation et l\'impact social.',
                'results' => 'Le film a été présenté à 3 salons internationaux et a aidé à lever 2M$ d\'investissement.',
                'client_testimony' => 'Le film capture parfaitement notre essence et notre ambition. Un outil formidable pour notre croissance.',
                'image' => 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=800&auto=format&fit=crop',
                'published' => 1,
                'statut' => 'publié',
                'featured' => 1,
                'categorie_id' => 4, // Production Vidéo
                'media' => json_encode([
                    'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=800&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1593359677879-a4bb92f829d1?w=800&auto=format&fit=crop',
                ]),
            ],
            [
                'title' => 'Identité Visuelle AfroMode',
                'slug' => 'identite-visuelle-afromode',
                'client' => 'AfroMode',
                'sector' => 'Mode',
                'country' => 'Sénégal',
                'type' => 'Branding & Packaging',
                'completion_date' => '2024-07-30',
                'summary' => 'Création d\'une identité visuelle complète pour une marque de mode africaine contemporaine.',
                'description' => 'Développement d\'une identité de marque complète incluant logo, typographie, palette couleur, et design packaging. L\'identité intègre des motifs traditionnels africains réinterprétés de manière moderne.',
                'context' => 'AfroMode lançait sa première collection et avait besoin d\'une identité forte pour se démarquer.',
                'solution' => 'Création d\'un univers visuel cohérent qui célèbre l\'héritage africain avec une esthétique contemporaine.',
                'results' => 'La marque a été immédiatement reconnue comme premium, avec une couverture médiatique importante.',
                'client_testimony' => 'KOTAVA a donné vie à notre vision avec une créativité et une expertise remarquables.',
                'image' => 'https://images.unsplash.com/photo-1490481651871-ab68de25d43d?w=800&auto=format&fit=crop',
                'published' => 1,
                'statut' => 'publié',
                'featured' => 0,
                'categorie_id' => 1, // Branding
                'media' => json_encode([
                    'https://images.unsplash.com/photo-1490481651871-ab68de25d43d?w=800&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1523381210434-271e8be1f52b?w=800&auto=format&fit=crop',
                ]),
            ],
            [
                'title' => 'Application Mobile Santé',
                'slug' => 'application-mobile-sante',
                'client' => 'HealthConnect',
                'sector' => 'Santé',
                'country' => 'Ghana',
                'type' => 'Application Mobile',
                'completion_date' => '2024-11-15',
                'summary' => 'Développement d\'une application mobile pour la prise de rendez-vous médicaux en zone rurale.',
                'description' => 'Création d\'une application iOS et Android permettant aux patients des zones rurales du Ghana de prendre rendez-vous avec des médecins, recevoir des rappels, et accéder à des informations santé.',
                'context' => 'HealthConnect voulait améliorer l\'accès aux soins dans les zones mal desservies.',
                'solution' => 'Application intuitive fonctionnant avec une connexion internet limitée, avec interface multilingue.',
                'results' => '10 000 utilisateurs en 3 mois, avec une réduction de 60% des rendez-vous manqués.',
                'client_testimony' => 'L\'application a eu un impact tangible sur l\'accès aux soins. Un projet qui a du sens.',
                'image' => 'https://images.unsplash.com/photo-1559757148-5c350d0d3c56?w=800&auto=format&fit=crop',
                'published' => 1,
                'statut' => 'publié',
                'featured' => 0,
                'categorie_id' => 2, // Web & Digital
                'media' => json_encode([
                    'https://images.unsplash.com/photo-1559757148-5c350d0d3c56?w=800&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1581094794329-c8112a89af12?w=800&auto=format&fit=crop',
                ]),
            ],
        ];

        foreach ($realisations as $realisation) {
            Realisation::create($realisation);
        }

        $this->command->info('✅ 6 réalisations de test créées avec succès !');
        $this->command->info('👁️  Accédez à http://localhost:8000/portfolio pour voir votre portfolio');
    }
}
