<?php

use yii\db\Migration;

class m170125_092557_sample_data_categories_products_insertion extends Migration
{
    public function up()
    {
 /* -------------- insertion table categorie ------------------------------------------------ */

        $this->insert('categorie', [
            'id_categorie' => 1,
            'nom' => 'Liqueurs',
            'type' => 'boisson',
                ]
        );
        $this->insert('categorie', [
            'id_categorie' => 2,
            'nom' => 'Bières',
            'type' => 'boisson',
                ]
        );
        $this->insert('categorie', [
            'id_categorie' => 3,
            'nom' => 'Boissons Chaudes',
            'type' => 'boisson',
                ]
        );
        $this->insert('categorie', [
            'id_categorie' => 4,
            'nom' => 'Boissons Energétiques',
            'type' => 'boisson',
                ]
        );
        $this->insert('categorie', [
            'id_categorie' => 5,
            'nom' => 'Boissons Gazeuses',
            'type' => 'boisson',
                ]
        );
        $this->insert('categorie', [
            'id_categorie' => 6,
            'nom' => 'Champagnes',
            'type' => 'boisson',
                ]
        );
        $this->insert('categorie', [
            'id_categorie' => 7,
            'nom' => 'Cocktails(Avec Alcool)',
            'type' => 'boisson',
                ]
        );
        $this->insert('categorie', [
            'id_categorie' => 8,
            'nom' => 'Boissons Froides',
            'type' => 'boisson',
                ]
        );
        $this->insert('categorie', [
            'id_categorie' => 9,
            'nom' => 'Vins',
            'type' => 'boisson',
                ]
        );
        $this->insert('categorie', [
            'id_categorie' => 10,
            'nom' => 'Cuisine',
            'type' => 'repas',
                ]
        );
        $this->insert('categorie', [
            'id_categorie' => 11,
            'nom' => 'Tabac',
            'type' => 'tabac',
                ]
        );
        $this->insert('categorie', [
            'id_categorie' => 12,
            'nom' => 'Whisky',
            'type' => 'boisson',
                ]
        );
        $this->insert('categorie', [
            'id_categorie' => 13,
            'nom' => 'Cocktails(Sans Alcool)',
            'type' => 'boisson',
                ]
        );
        $this->insert('categorie', [
            'id_categorie' => 14,
            'nom' => 'Cocktails (Eteki)',
            'type' => 'boisson',
                ]
        );
        $this->insert('categorie', [
            'id_categorie' => 15,
            'nom' => 'Rhum',
            'type' => 'boisson',
                ]
        );
        $this->insert('categorie', [
            'id_categorie' => 16,
            'nom' => 'Vodka',
            'type' => 'boisson',
                ]
        );
        $this->insert('categorie', [
            'id_categorie' => 17,
            'nom' => 'Cognac',
            'type' => 'boisson',
                ]
        );


        /* -------------- insertion table photo ------------------------------------------------ */

        $this->insert('photo', [
            'id_photo' => 2,
            'nom' => 'beaufort_light.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 3,
            'nom' => '33_export.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 4,
            'nom' => 'castel.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 5,
            'nom' => 'heineken.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 6,
            'nom' => 'budweiser.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 7,
            'nom' => 'mahou.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 8,
            'nom' => 'guinness.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 9,
            'nom' => 'tango.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 10,
            'nom' => 'tangui.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 11,
            'nom' => 'menthe_a_eau.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 12,
            'nom' => 'grenadine_a_eau.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 13,
            'nom' => 'jus_ananas.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 14,
            'nom' => 'jus_orange.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 15,
            'nom' => 'jus_corossol.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 17,
            'nom' => 'jus_tomate.jpg',
                ]
        );

        $this->insert('photo', [
            'id_photo' => 18,
            'nom' => 'perier_pm.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 19,
            'nom' => 'diabolo.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 20,
            'nom' => 'menthe_au_lait.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 21,
            'nom' => 'cafe.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 22,
            'nom' => 'the.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 23,
            'nom' => 'top_soda.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 24,
            'nom' => 'coca_cola.gif',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 25,
            'nom' => 'coca_light.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 26,
            'nom' => 'coca_zero.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 27,
            'nom' => 'sprite.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 28,
            'nom' => 'fanta.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 29,
            'nom' => 'schweppes_soda.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 30,
            'nom' => 'schweppes_tonic.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 31,
            'nom' => 'orangina.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 32,
            'nom' => 'smirnoff_ice_black.jpg',
                ]
        );       
        $this->insert('photo', [
            'id_photo' => 34,
            'nom' => 'eteki.png',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 35,
            'nom' => 'red_bull.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 36,
            'nom' => 'malta_guinness.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 37,
            'nom' => 'blue_curacao.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 38,
            'nom' => 'get_27.png',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 39,
            'nom' => 'get_31.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 40,
            'nom' => 'marie_brizard.Jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 41,
            'nom' => 'pastis_51.gif',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 42,
            'nom' => 'ricard.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 43,
            'nom' => 'gin_gordon.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 44,
            'nom' => 'gin_beefeater.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 45,
            'nom' => 'martini_blanc.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 46,
            'nom' => 'martini_dry.jpeg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 47,
            'nom' => 'martini_rose.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 48,
            'nom' => 'martini_rouge.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 49,
            'nom' => 'baileys.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 50,
            'nom' => 'malibu.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 51,
            'nom' => 'tequila_blanc.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 52,
            'nom' => 'campari.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 53,
            'nom' => 'cointreau.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 54,
            'nom' => 'gin_tanqueray.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 55,
            'nom' => 'porto_blanc.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 56,
            'nom' => 'porto_rouge.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 57,
            'nom' => 'ballantines.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 58,
            'nom' => 'ballantines_brazil.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 59,
            'nom' => 'ballantines_12_years.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 60,
            'nom' => 'chivas_12_years.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 61,
            'nom' => 'chivas_18_years.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 62,
            'nom' => 'chivas_royal_salute.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 63,
            'nom' => 'glenfiddich_12_years.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 64,
            'nom' => 'glenfiddich_18_years.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 65,
            'nom' => 'jack_daniels.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 66,
            'nom' => 'jack_daniels_honey.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 67,
            'nom' => 'j&b.jpg',
                ]
        );
        
        $this->insert('photo', [
            'id_photo' => 69,
            'nom' => 'jw_red_label.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 70,
            'nom' => 'jw_black_label.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 71,
            'nom' => 'jw_double_black_label.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 72,
            'nom' => 'jw_gold_reserve_label.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 73,
            'nom' => 'jw_platinium.jpg',
                ]
        );
        
        $this->insert('photo', [
            'id_photo' => 75,
            'nom' => 'jw_blue_label.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 76,
            'nom' => 'bacardi.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 77,
            'nom' => 'havana_3_years.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 78,
            'nom' => 'havana_7_years.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 79,
            'nom' => 'absolut.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 80,
            'nom' => 'absolut_aromatise.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 81,
            'nom' => 'smirnoff_red.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 82,
            'nom' => 'ciroc.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 83,
            'nom' => 'armagnac.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 84,
            'nom' => 'grand_marnier.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 85,
            'nom' => 'remy_martin.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 86,
            'nom' => 'taittinger_37_5_cl.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 87,
            'nom' => 'taittinger.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 88,
            'nom' => 'moet_brut.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 89,
            'nom' => 'moet_nectar.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 90,
            'nom' => 'veuve_cliquot.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 91,
            'nom' => 'ruinart_blanc.png',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 92,
            'nom' => 'dom_perignon.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 93,
            'nom' => 'champagne_cristal.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 94,
            'nom' => 'merlot.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 95,
            'nom' => 'medoc.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 96,
            'nom' => 'cabernet_sauvignon_cavior.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 97,
            'nom' => 'haut_medoc.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 98,
            'nom' => 'chardonnay.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 99,
            'nom' => 'sauvignon.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 100,
            'nom' => 'chardonnay_sweet_cavior.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 101,
            'nom' => 'cote_de_provence.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 102,
            'nom' => 'prosecco.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 103,
            'nom' => 'jp_chenet.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 104,
            'nom' => 'chicha.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 105,
            'nom' => 'portion_de_frites.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 106,
            'nom' => 'demi_poulet_frites.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 107,
            'nom' => 'quart_poulet_frites.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 108,
            'nom' => 'poulet_frites.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 109,
            'nom' => 'frites_de_plantain.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 110,
            'nom' => 'brochettes_de_viande.jpeg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 111,
            'nom' => 'americano.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 112,
            'nom' => 'caipirinha.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 113,
            'nom' => 'margarita.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 114,
            'nom' => 'pina_colada.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 115,
            'nom' => 'tequila_sunrise.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 116,
            'nom' => 'mojito.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 117,
            'nom' => 'b_52.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 118,
            'nom' => 'cosmopolitan.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 119,
            'nom' => 'daiquiri.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 120,
            'nom' => 'manhattan.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 121,
            'nom' => 'martini_cocktail.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 122,
            'nom' => 'negroni.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 123,
            'nom' => 'long_island_ice_tea.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 124,
            'nom' => 'mexican_ice_tea.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 125,
            'nom' => 'black_white.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 126,
            'nom' => 'florida.jpg',
                ]
        );
        $this->insert('photo', [
            'id_photo' => 127,
            'nom' => 'virgin_mojito.jpg',
                ]
        );
		$this->insert('photo', [
            'id_photo' => 128,
            'nom' => 'cahaca.jpg',
                ]
        );
		$this->insert('photo', [
            'id_photo' => 129,
            'nom' => 'kalhua.jpg',
                ]
        );
        /* -------------- insertion table produit ------------------------------------------------ */

        $this->insert('produit', [
            'id_produit' => 1,
            'id_categorie' => 2,
            'id_photo' => 2,
            'nom' => 'beaufort light',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 2,
            'id_categorie' => 2,
            'id_photo' => 3,
            'nom' => '33 export',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 3,
            'id_categorie' => 2,
            'id_photo' => 4,
            'nom' => 'castel',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 4,
            'id_categorie' => 2,
            'id_photo' => 5,
            'nom' => 'heineken',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 5,
            'id_categorie' => 2,
            'id_photo' => 6,
            'nom' => 'budweiser',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 6,
            'id_categorie' => 2,
            'id_photo' => 7,
            'nom' => 'mahou',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 7,
            'id_categorie' => 2,
            'id_photo' => 8,
            'nom' => 'guinness',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 8,
            'id_categorie' => 2,
            'id_photo' => 9,
            'nom' => 'tango',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 9,
            'id_categorie' => 8,
            'id_photo' => 10,
            'nom' => 'tangui pm',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 10,
            'id_categorie' => 8,
            'id_photo' => 11,
            'nom' => 'menthe a eau',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 11,
            'id_categorie' => 8,
            'id_photo' => 12,
            'nom' => 'grenadine a eau',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 12,
            'id_categorie' => 8,
            'id_photo' => 13,
            'nom' => 'jus ananas',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 13,
            'id_categorie' => 8,
            'id_photo' => 14,
            'nom' => 'jus orange',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 14,
            'id_categorie' => 8,
            'id_photo' => 15,
            'nom' => 'jus corossol',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 15,
            'id_categorie' => 8,
            'id_photo' => 17,
            'nom' => 'jus tomate',
                ]
        );

        $this->insert('produit', [
            'id_produit' => 16,
            'id_categorie' => 8,
            'id_photo' => 18,
            'nom' => 'perier pm',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 17,
            'id_categorie' => 8,
            'id_photo' => 19,
            'nom' => 'diabolo',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 18,
            'id_categorie' => 8,
            'id_photo' => 20,
            'nom' => 'menthe au lait',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 19,
            'id_categorie' => 3,
            'id_photo' => 21,
            'nom' => 'cafe',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 20,
            'id_categorie' => 3,
            'id_photo' => 22,
            'nom' => 'the',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 21,
            'id_categorie' => 5,
            'id_photo' => 23,
            'nom' => 'top soda',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 22,
            'id_categorie' => 5,
            'id_photo' => 24,
            'nom' => 'coca cola pm',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 23,
            'id_categorie' => 5,
            'id_photo' => 24,
            'nom' => 'coca cola gm',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 24,
            'id_categorie' => 5,
            'id_photo' => 25,
            'nom' => 'coca light',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 25,
            'id_categorie' => 5,
            'id_photo' => 26,
            'nom' => 'coca zero',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 26,
            'id_categorie' => 5,
            'id_photo' => 27,
            'nom' => 'sprite',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 27,
            'id_categorie' => 5,
            'id_photo' => 28,
            'nom' => 'fanta',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 28,
            'id_categorie' => 5,
            'id_photo' => 29,
            'nom' => 'schweppes soda',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 29,
            'id_categorie' => 5,
            'id_photo' => 30,
            'nom' => 'schweppes tonic',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 30,
            'id_categorie' => 5,
            'id_photo' => 31,
            'nom' => 'orangina',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 31,
            'id_categorie' => 5,
            'id_photo' => 32,
            'nom' => 'smirnoff ice black',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 32,
            'id_categorie' => 4,
            'id_photo' => 34,
            'nom' => 'eteki classique',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 33,
            'id_categorie' => 4,
            'id_photo' => 34,
            'nom' => 'eteki wildberry',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 34,
            'id_categorie' => 4,
            'id_photo' => 35,
            'nom' => 'red bull',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 35,
            'id_categorie' => 4,
            'id_photo' => 36,
            'nom' => 'malta guinness',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 36,
            'id_categorie' => 1,
            'id_photo' => 37,
            'nom' => 'blue curacao',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 37,
            'id_categorie' => 1,
            'id_photo' => 38,
            'nom' => 'get 27',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 38,
            'id_categorie' => 1,
            'id_photo' => 39,
            'nom' => 'get 31',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 39,
            'id_categorie' => 1,
            'id_photo' => 40,
            'nom' => 'marie brizard',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 40,
            'id_categorie' => 1,
            'id_photo' => 41,
            'nom' => 'pastis 51',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 41,
            'id_categorie' => 1,
            'id_photo' => 42,
            'nom' => 'ricard',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 42,
            'id_categorie' => 1,
            'id_photo' => 43,
            'nom' => 'gin gordon',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 43,
            'id_categorie' => 1,
            'id_photo' => 44,
            'nom' => 'gin beefeater',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 44,
            'id_categorie' => 1,
            'id_photo' => 45,
            'nom' => 'martini blanc',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 45,
            'id_categorie' => 1,
            'id_photo' => 46,
            'nom' => 'martini dry',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 46,
            'id_categorie' => 1,
            'id_photo' => 47,
            'nom' => 'martini rose',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 47,
            'id_categorie' => 1,
            'id_photo' => 48,
            'nom' => 'martini rouge',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 48,
            'id_categorie' => 1,
            'id_photo' => 49,
            'nom' => 'baileys',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 49,
            'id_categorie' => 1,
            'id_photo' => 50,
            'nom' => 'malibu',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 50,
            'id_categorie' => 1,
            'id_photo' => 51,
            'nom' => 'tequila blanc',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 51,
            'id_categorie' => 1,
            'id_photo' => 52,
            'nom' => 'campari',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 52,
            'id_categorie' => 1,
            'id_photo' => 53,
            'nom' => 'cointreau',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 53,
            'id_categorie' => 1,
            'id_photo' => 54,
            'nom' => 'gin tanqueray',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 54,
            'id_categorie' => 1,
            'id_photo' => 55,
            'nom' => 'porto blanc',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 55,
            'id_categorie' => 1,
            'id_photo' => 56,
            'nom' => 'porto rouge',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 56,
            'id_categorie' => 12,
            'id_photo' => 57,
            'nom' => 'ballantines',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 57,
            'id_categorie' => 12,
            'id_photo' => 58,
            'nom' => 'ballantines brazil',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 58,
            'id_categorie' => 12,
            'id_photo' => 59,
            'nom' => 'ballantines 12 years',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 59,
            'id_categorie' => 12,
            'id_photo' => 60,
            'nom' => 'chivas 12 years',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 60,
            'id_categorie' => 12,
            'id_photo' => 61,
            'nom' => 'chivas 18 years.jpg',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 61,
            'id_categorie' => 12,
            'id_photo' => 62,
            'nom' => 'chivas royal salute',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 62,
            'id_categorie' => 12,
            'id_photo' => 63,
            'nom' => 'glenfiddich 12 years',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 63,
            'id_categorie' => 12,
            'id_photo' => 64,
            'nom' => 'glenfiddich 18 years',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 64,
            'id_categorie' => 12,
            'id_photo' => 65,
            'nom' => 'jack daniels',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 65,
            'id_categorie' => 12,
            'id_photo' => 66,
            'nom' => 'jack daniels honey',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 66,
            'id_categorie' => 12,
            'id_photo' => 67,
            'nom' => 'j&b',
                ]
        );

        $this->insert('produit', [
            'id_produit' => 67,
            'id_categorie' => 12,
            'id_photo' => 69,
            'nom' => 'jw red label',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 68,
            'id_categorie' => 12,
            'id_photo' => 70,
            'nom' => 'jw black label',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 69,
            'id_categorie' => 12,
            'id_photo' => 71,
            'nom' => 'jw double black label',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 70,
            'id_categorie' => 12,
            'id_photo' => 72,
            'nom' => 'jw gold reserve label',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 71,
            'id_categorie' => 12,
            'id_photo' => 73,
            'nom' => 'jw platinium',
                ]
        );
        
        $this->insert('produit', [
            'id_produit' => 73,
            'id_categorie' => 12,
            'id_photo' => 75,
            'nom' => 'jw blue label',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 74,
            'id_categorie' => 15,
            'id_photo' => 76,
            'nom' => 'bacardi',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 75,
            'id_categorie' => 15,
            'id_photo' => 77,
            'nom' => 'havana 3 years',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 76,
            'id_categorie' => 15,
            'id_photo' => 78,
            'nom' => 'havana 7 years',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 77,
            'id_categorie' => 16,
            'id_photo' => 79,
            'nom' => 'absolut',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 78,
            'id_categorie' => 16,
            'id_photo' => 80,
            'nom' => 'absolut aromatise',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 79,
            'id_categorie' => 16,
            'id_photo' => 81,
            'nom' => 'smirnoff red',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 80,
            'id_categorie' => 16,
            'id_photo' => 82,
            'nom' => 'ciroc',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 81,
            'id_categorie' => 17,
            'id_photo' => 83,
            'nom' => 'armagnac',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 82,
            'id_categorie' => 17,
            'id_photo' => 84,
            'nom' => 'grand marnier',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 83,
            'id_categorie' => 17,
            'id_photo' => 85,
            'nom' => 'remy martin',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 84,
            'id_categorie' => 6,
            'id_photo' => 86,
            'nom' => 'taittinger 37.5 cl',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 85,
            'id_categorie' => 6,
            'id_photo' => 87,
            'nom' => 'taittinger',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 86,
            'id_categorie' => 6,
            'id_photo' => 88,
            'nom' => 'moet brut',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 87,
            'id_categorie' => 6,
            'id_photo' => 89,
            'nom' => 'moet nectar',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 88,
            'id_categorie' => 6,
            'id_photo' => 90,
            'nom' => 'veuve cliquot',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 89,
            'id_categorie' => 6,
            'id_photo' => 91,
            'nom' => 'ruinart blanc',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 90,
            'id_categorie' => 6,
            'id_photo' => 92,
            'nom' => 'dom perignon',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 91,
            'id_categorie' => 6,
            'id_photo' => 93,
            'nom' => 'champagne cristal',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 92,
            'id_categorie' => 9,
            'id_photo' => 94,
            'nom' => 'merlot',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 93,
            'id_categorie' => 9,
            'id_photo' => 95,
            'nom' => 'medoc',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 94,
            'id_categorie' => 9,
            'id_photo' => 96,
            'nom' => 'cabernet sauvignon cavior',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 95,
            'id_categorie' => 9,
            'id_photo' => 97,
            'nom' => 'haut medoc',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 96,
            'id_categorie' => 9,
            'id_photo' => 98,
            'nom' => 'chardonnay',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 97,
            'id_categorie' => 9,
            'id_photo' => 99,
            'nom' => 'sauvignon',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 98,
            'id_categorie' => 9,
            'id_photo' => 100,
            'nom' => 'chardonnay sweet cavior',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 99,
            'id_categorie' => 9,
            'id_photo' => 101,
            'nom' => 'cote de provence',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 100,
            'id_categorie' => 9,
            'id_photo' => 102,
            'nom' => 'prosecco',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 101,
            'id_categorie' => 9,
            'id_photo' => 103,
            'nom' => 'jp chenet',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 102,
            'id_categorie' => 11,
            'id_photo' => 104,
            'nom' => 'chicha',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 103,
            'id_categorie' => 10,
            'id_photo' => 105,
            'nom' => 'portion de frites',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 104,
            'id_categorie' => 10,
            'id_photo' => 106,
            'nom' => 'demi poulet frites',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 105,
            'id_categorie' => 10,
            'id_photo' => 107,
            'nom' => 'quart poulet frites',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 106,
            'id_categorie' => 10,
            'id_photo' => 108,
            'nom' => 'poulet frites',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 107,
            'id_categorie' => 10,
            'id_photo' => 109,
            'nom' => 'frites de plantain',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 108,
            'id_categorie' => 10,
            'id_photo' => 110,
            'nom' => 'brochettes de viande',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 109,
            'id_categorie' => 7,
            'id_photo' => 111,
            'nom' => 'americano',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 110,
            'id_categorie' => 7,
            'id_photo' => 112,
            'nom' => 'caipirinha',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 111,
            'id_categorie' => 7,
            'id_photo' => 113,
            'nom' => 'marguarita',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 112,
            'id_categorie' => 7,
            'id_photo' => 114,
            'nom' => 'pina colada',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 113,
            'id_categorie' => 7,
            'id_photo' => 115,
            'nom' => 'tequila sunrise',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 114,
            'id_categorie' => 7,
            'id_photo' => 116,
            'nom' => 'mojito',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 115,
            'id_categorie' => 7,
            'id_photo' => 117,
            'nom' => 'b 52',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 116,
            'id_categorie' => 7,
            'id_photo' => 118,
            'nom' => 'cosmoplitan',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 117,
            'id_categorie' => 7,
            'id_photo' => 119,
            'nom' => 'daiquiri',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 118,
            'id_categorie' => 7,
            'id_photo' => 120,
            'nom' => 'manhattan',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 119,
            'id_categorie' => 7,
            'id_photo' => 121,
            'nom' => 'martini cocktail',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 120,
            'id_categorie' => 7,
            'id_photo' => 122,
            'nom' => 'negroni',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 121,
            'id_categorie' => 7,
            'id_photo' => 123,
            'nom' => 'long island ice tea',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 122,
            'id_categorie' => 7,
            'id_photo' => 124,
            'nom' => 'mexican ice tea',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 123,
            'id_categorie' => 13,
            'id_photo' => 125,
            'nom' => 'black white',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 124,
            'id_categorie' => 13,
            'id_photo' => 126,
            'nom' => 'florida',
                ]
        );
        $this->insert('produit', [
            'id_produit' => 125,
            'id_categorie' => 13,
            'id_photo' => 127,
            'nom' => 'virgin mojito',
                ]
        );
		$this->insert('produit', [
            'id_produit' => 126,
            'id_categorie' => 8,
            'id_photo' => 14,
            'nom' => 'jus pamplemousse',
                ]
        );
		$this->insert('produit', [
            'id_produit' => 127,
            'id_categorie' => 1,
            'id_photo' => 128,
            'nom' => 'cahaca',
                ]
        );
		$this->insert('produit', [
            'id_produit' => 128,
            'id_categorie' => 1,
            'id_photo' => 129,
            'nom' => 'kalhua',
                ]
        );
		
    }


    public function down() {
        $this->delete("{{%categorie}}");
        $this->delete("{{%produit}}");
    }
}
