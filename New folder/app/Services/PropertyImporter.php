<?php

namespace App\Services;

use App\Models\Property;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PropertyImporter
{

    /*

      <root>
<kyero>
<feed_version>3</feed_version>
</kyero>
<property>
<id>3</id>
<date>2024-08-15 01:01:33</date>
<ref>GE-64567</ref>
<price>950000</price>
<currency>EUR</currency>
<price_freq>sale</price_freq>
<new_build>1</new_build>
<type>
<![CDATA[ Villa ]]>
</type>
<town>Finestrat</town>
<province>Alicante</province>
<location_detail>Sierra Cortina</location_detail>
<beds>3</beds>
<baths>3</baths>
<pool>1</pool>
<location>
<latitude>38.544854</latitude>
<longitude>-0.174604</longitude>
</location>
<energy_rating>
<consumption>B</consumption>
<emissions/>
</energy_rating>
<surface_area>
<built>262</built>
<plot>545</plot>
</surface_area>
<url>
<en>https://gold-estates.com/en/property/3/villa/new-build/spain/alicante/finestrat/sierra-cortina/</en>
<es>https://gold-estates.com/es/propiedad/3/villa/obra-nueva/espana/alicante/finestrat/sierra-cortina/</es>
<de>https://gold-estates.com/de/eigentum/3/villa/neue-gebaude/spanien/alicante/finestrat/sierra-cortina/</de>
<nl>https://gold-estates.com/nl/woning/3/villa/nieuwbouw/spanje/alicante/finestrat/sierra-cortina/</nl>
<fr>https://gold-estates.com/fr/propriete/3/villa/nouvelle-construction/espagne/alicante/finestrat/sierra-cortina/</fr>
<de>https://gold-estates.com/de/eigentum/3/villa/neue-gebaude/spanien/alicante/finestrat/sierra-cortina/</de>
</url>
<desc>
<en>
<![CDATA[ NEW BUILD VILLAS IN FINESTRAT New Build residential of 30 independent villas of avant-garde design in Sierra Cortina, Finestrat, in the heart of the Costa Blanca, a luxury development where you can enjoy a unique environment of tranquillity. Villas build over 2 floors, has 3 bedrooms, 3 bathrooms, guest toilet, open plan kitchen with lounge, build-in wardrobes, terraces, private garden with the pool and basement with the garage Residential located in the Sierra Cortina resort complex, ​next to two golf courses, theme parks, a large shopping centre and a few minutes from the beaches of Benidorm. Finestrat located in the Marina Baixa region of the Costa Blanca, close to neighbouring Benidorm and about 40 kilometres from the city of Alicante and the international airport. The village is situated on the mountainside of Puig Campana and offers beautiful views of the mountains, the coast and the Mediterranean Sea. ]]>
</en>
<es>
<![CDATA[ VILLAS DE OBRA NUEVA EN FINESTRAT Residencial de obra nueva de 30 villas independientes de diseño vanguardista en Sierra Cortina, Finestrat, en el corazón de la Costa Blanca, una urbanización de lujo donde podrá disfrutar de un entorno único de tranquilidad. Las villas, construidas en 2 plantas, disponen de 3 dormitorios, 3 baños, aseo, cocina americana con salón, armarios empotrados, terrazas, jardín privado con piscina y sótano con garaje. Residencial situado en el complejo turístico Sierra Cortina, junto a dos campos de golf, parques temáticos, un gran centro comercial y a pocos minutos de las playas de Benidorm. Finestrat situado en la comarca de la Marina Baixa de la Costa Blanca, cerca de la vecina Benidorm y a unos 40 kilómetros de la ciudad de Alicante y del aeropuerto internacional. El pueblo está situado en la ladera del Puig Campana y ofrece hermosas vistas de las montañas, la costa y el mar Mediterráneo. ]]>
</es>
<de>
<![CDATA[ NEU GEBAUTE VILLEN IN FINESTRAT Neubau von 30 unabhängigen Villen mit avantgardistischem Design in Sierra Cortina, Finestrat, im Herzen der Costa Blanca, eine luxuriöse Anlage, wo Sie eine einzigartige Umgebung der Ruhe genießen können. Villen über 2 Etagen gebaut, hat 3 Schlafzimmer, 3 Bäder, Gäste-WC, offene Küche mit Wohnzimmer, Einbauschränke, Terrassen, privater Garten mit dem Pool und Keller mit der Garage Wohnanlage in der Sierra Cortina Resort-Komplex, neben zwei Golfplätzen, Themenparks, ein großes Einkaufszentrum und ein paar Minuten von den Stränden von Benidorm. Finestrat liegt in der Region Marina Baixa an der Costa Blanca, in der Nähe des benachbarten Benidorm und etwa 40 Kilometer von der Stadt Alicante und dem internationalen Flughafen entfernt. Das Dorf liegt am Berghang des Puig Campana und bietet einen schönen Blick auf die Berge, die Küste und das Mittelmeer. ]]>
</de>
<nl>
<![CDATA[ NIEUWBOUW VILLA'S IN FINESTRAT Nieuwbouw residentieel van 30 onafhankelijke villa's van avant-garde ontwerp in Sierra Cortina, Finestrat, in het hart van de Costa Blanca, een luxe ontwikkeling waar u kunt genieten van een unieke omgeving van rust. Villa's gebouwd over 2 verdiepingen, heeft 3 slaapkamers, 3 badkamers, gastentoilet, open keuken met salon, ingebouwde kasten, terrassen, privé tuin met het zwembad en kelder met de garage. Residentieel gelegen in het Sierra Cortina resort complex, naast twee golfbanen, themaparken, een groot winkelcentrum en een paar minuten van de stranden van Benidorm. Finestrat ligt in de regio Marina Baixa van de Costa Blanca, dicht bij het naburige Benidorm en op ongeveer 40 kilometer van de stad Alicante en de internationale luchthaven. Het dorp ligt op de berghelling van Puig Campana en biedt een prachtig uitzicht op de bergen, de kust en de Middellandse Zee. ]]>
</nl>
<fr>
<![CDATA[ VILLAS DE NOUVELLE CONSTRUCTION À FINESTRAT Nouvelle construction résidentielle de 30 villas indépendantes de conception avant-gardiste à Sierra Cortina, Finestrat, au cœur de la Costa Blanca, un développement de luxe où vous pouvez profiter d'un environnement unique de tranquillité. Les villas sont construites sur 2 étages, avec 3 chambres à coucher, 3 salles de bains, des toilettes pour invités, une cuisine ouverte sur le salon, des armoires encastrées, des terrasses, un jardin privé avec une piscine et un sous-sol avec un garage. Résidence située dans le complexe touristique Sierra Cortina, à côté de deux terrains de golf, de parcs à thème, d'un grand centre commercial et à quelques minutes des plages de Benidorm. Finestrat est situé dans la région de Marina Baixa de la Costa Blanca, près de la ville voisine de Benidorm et à environ 40 kilomètres de la ville d'Alicante et de l'aéroport international. Le village est situé sur le flanc de la montagne de Puig Campana et offre de belles vues sur les montagnes, la côte et la mer Méditerranée. ]]>
</fr>
<da>
<![CDATA[ NYBYGGEDE VILLAER I FINESTRAT Nybyggeri af 30 uafhængige villaer i avantgarde design i Sierra Cortina, Finestrat, i hjertet af Costa Blanca, et luksusbyggeri, hvor du kan nyde et unikt miljø af ro og fred. Villaer bygget over 2 etager, har 3 soveværelser, 3 badeværelser, gæstetoilet, åbent køkken med stue, indbyggede garderobeskabe, terrasser, privat have med pool og kælder med garage Bolig beliggende i Sierra Cortina resort komplekset, ved siden af to golfbaner, forlystelsesparker, et stort indkøbscenter og et par minutter fra Benidorms strande Finestrat beliggende i Marina Baixa-regionen på Costa Blanca, tæt på naboområdet Benidorm og ca. 40 km fra byen Alicante og den internationale lufthavn. Landsbyen ligger på bjergsiden af Puig Campana og byder på en smuk udsigt over bjergene, kysten og Middelhavet. ]]>
</da>
<ru>
<![CDATA[ НОВЫЕ ВИЛЛЫ В ФИНЕСТРАТЕ Новый жилой комплекс из 30 независимых вилл авангардного дизайна в Сьерра Кортина, Финестрат, в самом сердце Коста Бланка, роскошный комплекс, где вы сможете насладиться уникальной атмосферой спокойствия. Виллы построены в 2 этажа, имеют 3 спальни, 3 ванные комнаты, гостевой туалет, кухню открытого плана с гостиной, встроенные шкафы, террасы, частный сад с бассейном и подвал с гаражом. Жилой комплекс расположен в курортном комплексе Sierra Cortina, рядом с двумя полями для гольфа, тематическими парками, большим торговым центром и в нескольких минутах от пляжей Бенидорма. Финестрат расположен в регионе Марина Байша на побережье Коста Бланка, недалеко от соседнего Бенидорма и примерно в 40 километрах от города Аликанте и международного аэропорта. Поселок расположен на склоне горы Пуиг Кампана, откуда открывается прекрасный вид на горы, побережье и Средиземное море. ]]>
</ru>
</desc>
<features>
<feature>Heating</feature>
<feature>Porch</feature>
<feature>Air conditioning pre-installation</feature>
<feature>Smoke outlet</feature>
<feature>Unfurnished</feature>
<feature>Solarium</feature>
<feature>Storage room</feature>
</features>
<images>
<image id="1">
<url>https://fotos15.apinmo.com/7515/17002610/12-1.jpg</url>
</image>
<image id="2">
<url>https://fotos15.apinmo.com/7515/17002610/12-2.jpg</url>
</image>
<image id="3">
<url>https://fotos15.apinmo.com/7515/17002610/12-3.jpg</url>
</image>
<image id="4">
<url>https://fotos15.apinmo.com/7515/17002610/12-4.jpg</url>
</image>
<image id="5">
<url>https://fotos15.apinmo.com/7515/17002610/12-5.jpg</url>
</image>
<image id="6">
<url>https://fotos15.apinmo.com/7515/17002610/12-6.jpg</url>
</image>
<image id="7">
<url>https://fotos15.apinmo.com/7515/17002610/12-7.jpg</url>
</image>
<image id="8">
<url>https://fotos15.apinmo.com/7515/17002610/12-8.jpg</url>
</image>
<image id="9">
<url>https://fotos15.apinmo.com/7515/17002610/12-9.jpg</url>
</image>
<image id="10">
<url>https://fotos15.apinmo.com/7515/17002610/12-10.jpg</url>
</image>
<image id="11">
<url>https://fotos15.apinmo.com/7515/17002610/12-11.jpg</url>
</image>
<image id="12">
<url>https://fotos15.apinmo.com/7515/17002610/12-12.jpg</url>
</image>
<image id="13">
<url>https://fotos15.apinmo.com/7515/17002610/12-13.jpg</url>
</image>
<image id="14">
<url>https://fotos15.apinmo.com/7515/17002610/12-14.jpg</url>
</image>
<image id="15">
<url>https://fotos15.apinmo.com/7515/17002610/12-15.jpg</url>
</image>
<image id="16">
<url>https://fotos15.apinmo.com/7515/17002610/12-16.jpg</url>
</image>
<image id="17">
<url>https://fotos15.apinmo.com/7515/17002610/12-17.jpg</url>
</image>
</images>
</property>

</root>

    */

    public function importLargeXML($filePath)
    {
        try {

            if (!file_exists($filePath)) {
                throw new \Exception("File not found: $filePath");
            }

            $reader = new \XMLReader();
            $reader->open($filePath);

            //die dump the file
            // dd($reader);

            // Begin a database transaction
            DB::beginTransaction();

            // Iterate through the XML
            while ($reader->read()) {
                if ($reader->nodeType == \XMLReader::ELEMENT && $reader->localName == 'property') {
                    $xmlString = $reader->readOuterXML();
                    $propertyData  = simplexml_load_string($xmlString, null, LIBXML_NOCDATA);
                    // $descriptions = json_decode(json_encode($xml), true);
                    // dd($xml->date);
                    // $propertyData = simplexml_load_string($xmlString);
                    $this->processProperty($propertyData);
                }
            }

            // Commit the transaction
            DB::commit();

            echo "Properties imported successfully!";

        } catch (\Exception $e) {

            DB::rollBack();
            Log::error('Error importing properties: ' . $e->getMessage());

            echo "Error importing properties: " . $e->getMessage();
        } finally {
            if (isset($reader) && $reader instanceof \XMLReader) {
                $reader->close();
            }
        }
    }

    protected function processProperty($propertyData)
    {

        try {
            // Create the property record
            $property = Property::create([
                'ref' => (string) $propertyData->ref,
                'type' => (string) $propertyData->type,
                'town' => (string) $propertyData->town,
                'province' => (string) $propertyData->province,
                'price' => (float) $propertyData->price,
                'currency' => (string) $propertyData->currency,
                'location_detail' => (string) $propertyData->location_detail,
                'status' => (string)1,
                'user_id' => (int) 2,
                'beds' => (int) $propertyData->beds,
                'baths' => (int) $propertyData->baths,
                'pool' => (bool) $propertyData->pool,

            ]);

            // Process images if any
            if (isset($propertyData->images)) {
                $images=json_decode(json_encode($propertyData->images), true);
                foreach ($images['image'] as $image) {
                    $this->processImage($property, (string) $image['url']);
                }
            }

            // Process features if any
            if (isset($propertyData->features)) {
                foreach ($propertyData->features->feature as $feature) {
                    $property->features()->create(['feature' => (string) $feature]);
                }
            }

            // Process URLs if any

       if (isset($propertyData->url)) {
        $propertyDataArray = json_decode(json_encode($propertyData), true);
            foreach ($propertyDataArray['url'] as $language => $url) {
                $arr = [
                    'language' => $language,
                    'url' => is_array($url) && count($url) > 1 ? $url[0] : $url,
                ];
                // dd($arr);
                $d = $property->urls()->create($arr);
            }
        }



            // Process descriptions if any
            if (isset($propertyData->desc)) {
                $propertyDataArray = json_decode(json_encode($propertyData->desc),true);
                foreach ($propertyDataArray as $language => $description) {
                    $desc=is_array($description) ? $description[0] ?? '' : $description;
                    preg_match('/\b[A-Z\s]+\b/', $desc, $matches);
                    $title = isset($matches[0]) ? trim($matches[0]) : '';
                    if ($title) {
                        $property->title = $title;
                    }
                    $property->descriptions()->create([
                        'language' => $language,
                        'description' => is_array($description) ? $description[0] ?? '' : $description,
                    ]);

                }
                $property->save();
            }



            // dd("fine till here");

            // Process energy rating if any
            if (isset($propertyData->energy_rating)) {
                // dd($propertyData->energy_rating);
                $property->energyRating()->create([
                    'consumption' => (string) $propertyData->energy_rating->consumption,
                    'emissions' => json_encode($propertyData->energy_rating->emissions),
                ]);
            }

            // Process surface area if any
            if (isset($propertyData->surface_area)) {

                $property->surfaceArea()->create([
                    'built' => (float) $propertyData->surface_area->built,
                    'plot' => (float) $propertyData->surface_area->plot,
                ]);
            }
            if (isset($propertyData->location)) {

                $property->location()->create([
                    'longitude' => (float) $propertyData->location->longitude,
                    'latitude' => (float) $propertyData->location->latitude,
                ]);
            }
        } catch (\Exception $e) {
            // Handle individual property errors
            Log::error('Error processing property: ' . $e->getMessage());
            throw $e; // Rethrow to trigger rollback
        }
    }

    protected function processImage(Property $property, $imagePath)
    {
        try {
            $property->images()->create(['url' => $imagePath]);
        } catch (\Exception $e) {
            Log::error('Error processing image: ' . $e->getMessage());
            throw $e; // Rethrow to trigger rollback
        }
    }

    protected function processUrl(Property $property, $language, $url)
{
    try {
        $property->urls()->create([
            'language' => $language,
            'url' => $url,
        ]);
    } catch (\Exception $e) {
        Log::error('Error processing URL: ' . $e->getMessage());
        throw $e; // Rethrow to trigger rollback
    }
}


}
