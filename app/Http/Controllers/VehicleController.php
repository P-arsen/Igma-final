<?php

namespace App\Http\Controllers;

use App\Entity\Region;
use App\Models\Carbrand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class VehicleController extends Controller
{
    public function fetchVehicles()
    {

        $cities = [

            [
                'name_am' => 'Արմավիր',
                'name_ru' => 'Армавир',
                'name_en' => 'Armavir',
            ],
            [
                'name_am' => 'Էջմիածին',
                'name_ru' => 'Эчмиадзин',
                'name_en' => 'Ejmiatsin',
            ],
            [
                'name_am' => 'Արգավանդ',
                'name_ru' => 'Аргаван',
                'name_en' => 'Argavand',
            ],
            [
                'name_am' => 'Այգեկ',
                'name_ru' => 'Айгек',
                'name_en' => 'Aygek',
            ],
            [
                'name_am' => 'Բաղրամյան',
                'name_ru' => 'Баграмян',
                'name_en' => 'Baghramyan',
            ],
            [
                'name_am' => 'Մերձավան',
                'name_ru' => 'Мрдзаван',
                'name_en' => 'Mrdzavan',
            ],
            [
                'name_am' => 'Մեծամոր',
                'name_ru' => 'Мецамор',
                'name_en' => 'Metsamor',
            ],
            [
                'name_am' => 'Մրգաշատ',
                'name_ru' => 'Мргашат',
                'name_en' => 'Mrgashat',
            ],
            [
                'name_am' => 'Մուսալեռ',
                'name_ru' => 'Мусалар',
                'name_en' => 'Musaler',
            ],
            [
                'name_am' => 'Նալբանդյան',
                'name_ru' => 'Налбандян',
                'name_en' => 'Nalbandyan',
            ],
            [
                'name_am' => 'Փարաքար',
                'name_ru' => 'Паракар',
                'name_en' => 'Parakar',
            ],
            [
                'name_am' => 'Պտղունք',
                'name_ru' => 'Птхунк',
                'name_en' => 'Ptghunk',
            ],
            [
                'name_am' => 'Թաիրով',
                'name_ru' => 'Тайров',
                'name_en' => 'Tairrov',
            ],
            [
                'name_am' => 'Աղավնատուն',
                'name_ru' => 'Ахавнатун',
                'name_en' => 'Aghavnatun',
            ],
            [
                'name_am' => 'Ակնալիճ',
                'name_ru' => 'Акналич',
                'name_en' => 'Aknalich',
            ],
            [
                'name_am' => 'Ալաշկերտ',
                'name_ru' => 'Алашкерт',
                'name_en' => 'Alashkert',
            ],
            [
                'name_am' => 'Ամասիա',
                'name_ru' => 'Амасия',
                'name_en' => 'Amasia',
            ],
            [
                'name_am' => 'Ամբերդ',
                'name_ru' => 'Амберд',
                'name_en' => 'Amberd',
            ],
            [
                'name_am' => 'Ապագա',
                'name_ru' => 'Апага',
                'name_en' => 'Apaga',
            ],
            [
                'name_am' => 'Արագած',
                'name_ru' => 'Арагац',
                'name_en' => 'Aragats',
            ],
            [
                'name_am' => 'Արաքս',
                'name_ru' => 'Аракс',
                'name_en' => 'Araks',
            ],
            [
                'name_am' => 'Արաքս (Սարդարապատ)',
                'name_ru' => 'Аракс (Сардарапат)',
                'name_en' => 'Araks (Sardarapat)',
            ],
            [
                'name_am' => 'Առատաշեն',
                'name_ru' => 'Араташен',
                'name_en' => 'Aratashen',
            ],
            [
                'name_am' => 'Արազափ',
                'name_ru' => 'Аразап',
                'name_en' => 'Arazap',
            ],
            [
                'name_am' => 'Արևաշատ',
                'name_ru' => 'Аревшат',
                'name_en' => 'Arevshat',
            ],
            [
                'name_am' => 'Արևիկ',
                'name_ru' => 'Аревик',
                'name_en' => 'Arevik',
            ],
            [
                'name_am' => 'Արշալույս',
                'name_ru' => 'Аршалуйс',
                'name_en' => 'Arshaluyts',
            ],
            [
                'name_am' => 'Արտամետ',
                'name_ru' => 'Артамет',
                'name_en' => 'Artamet',
            ],
            [
                'name_am' => 'Արտաշար',
                'name_ru' => 'Арташар',
                'name_en' => 'Artashar',
            ],
            [
                'name_am' => 'Այգեշատ',
                'name_ru' => 'Айгешат',
                'name_en' => 'Aigeshat',
            ],
            [
                'name_am' => 'Այգևան',
                'name_ru' => 'Айгеван',
                'name_en' => 'Aigevan',
            ],
            [
                'name_am' => 'Բամբակաշատ',
                'name_ru' => 'Бамбакшад',
                'name_en' => 'Bambakashat',
            ],
            [
                'name_am' => 'Դալարիկ',
                'name_ru' => 'Даларак',
                'name_en' => 'Dalarik',
            ],
            [
                'name_am' => 'Դաշտ',
                'name_ru' => 'Дашт',
                'name_en' => 'Dasht',
            ],
            [
                'name_am' => 'Դողս',
                'name_ru' => 'Догс',
                'name_en' => 'Doghs',
            ],
            [
                'name_am' => 'Գայ',
                'name_ru' => 'Гай',
                'name_en' => 'Gay',
            ],
            [
                'name_am' => 'Գեղակերտ',
                'name_ru' => 'Гегакерт',
                'name_en' => 'Geghakert',
            ],
            [
                'name_am' => 'Գետաշեն',
                'name_ru' => 'Геташен',
                'name_en' => 'Getashen',
            ],
            [
                'name_am' => 'Գրիբոյեդով',
                'name_ru' => 'Грибоедов',
                'name_en' => 'Griboedov',
            ],
            [
                'name_am' => 'Հացիկ',
                'name_ru' => 'Хацик',
                'name_en' => 'Hacik',
            ],
            [
                'name_am' => 'Հայկաշեն',
                'name_ru' => 'Хайкашен',
                'name_en' => 'Haykashen',
            ],
            [
                'name_am' => 'Հայկավան',
                'name_ru' => 'Хайкаван',
                'name_en' => 'Haykavan',
            ],
            [
                'name_am' => 'Հայթաղ',
                'name_ru' => 'Хайтаҳ',
                'name_en' => 'Haytagh',
            ],
            [
                'name_am' => 'Հովտամեջ',
                'name_ru' => 'Говтамедж',
                'name_en' => 'Hovtamej',
            ],
            [
                'name_am' => 'Հուշակերտ',
                'name_ru' => 'Хушакерт',
                'name_en' => 'Hushakert',
            ],
            [
                'name_am' => 'Ջանֆիդա',
                'name_ru' => 'Джанфида',
                'name_en' => 'Janfida',
            ],
            [
                'name_am' => 'Ջրառատ',
                'name_ru' => 'Джрарат',
                'name_en' => 'Jrarat',
            ],
            [
                'name_am' => 'Քարակերտ',
                'name_ru' => 'Каракерт',
                'name_en' => 'Karakert',
            ],
            [
                'name_am' => 'Խանջյան',
                'name_ru' => 'Ханджан',
                'name_en' => 'Khanjyan',
            ],
            [
                'name_am' => 'Լենուղի',
                'name_ru' => 'Ленуги',
                'name_en' => 'Lenughi',
            ],
            [
                'name_am' => 'Լեռնագոգ',
                'name_ru' => 'Лернагог',
                'name_en' => 'Lernagog',
            ],
            [
                'name_am' => 'ՄեծԱրև',
                'name_ru' => 'МедзАрев',
                'name_en' => 'MedzArev',
            ],
            [
                'name_am' => 'Մեծ Շեն',
                'name_ru' => 'Медз Шен',
                'name_en' => 'Medz Shen',
            ],
            [
                'name_am' => 'Մյասնիկյան',
                'name_ru' => 'Мясникян',
                'name_en' => 'Myasnikyan',
            ],
            [
                'name_am' => 'Նոր Արմավիր',
                'name_ru' => 'Нор Армавир',
                'name_en' => 'Nor Armavir',
            ],
            [
                'name_am' => 'Նոր Արտագերս',
                'name_ru' => 'Нор Артагерьс',
                'name_en' => 'Nor Artagers',
            ],
            [
                'name_am' => 'Նոր Կեսարիա',
                'name_ru' => 'Нор Кесария',
                'name_en' => 'Nor Kesarie',
            ],
            [
                'name_am' => 'Նորակերտ',
                'name_ru' => 'Норакерт',
                'name_en' => 'Norakert',
            ],
            [
                'name_am' => 'Նորապատ',
                'name_ru' => 'Норапарт',
                'name_en' => 'Norapert',
            ],
            [
                'name_am' => 'Նորավան',
                'name_ru' => 'Нораван',
                'name_en' => 'Noravan',
            ],
            [
                'name_am' => 'Փշատավան',
                'name_ru' => 'Пшатаван',
                'name_en' => 'Pshatavan',
            ],
            [
                'name_am' => 'Սարդարապատ',
                'name_ru' => 'Сардарапат',
                'name_en' => 'Sardarapat',
            ],
            [
                'name_am' => 'Շահումյան',
                'name_ru' => 'Шахумян',
                'name_en' => 'Shahumyan',
            ],
            [
                'name_am' => 'Շենավան',
                'name_ru' => 'Шенаван',
                'name_en' => 'Shenavan',
            ],
            [
                'name_am' => 'Շենիկ',
                'name_ru' => 'Шеник',
                'name_en' => 'Shenik',
            ],
            [
                'name_am' => 'Տանձուտ',
                'name_ru' => 'Тандзут',
                'name_en' => 'Tandzut',
            ],
            [
                'name_am' => 'Տարոնիկ',
                'name_ru' => 'Таронник',
                'name_en' => 'Taronik',
            ],
            [
                'name_am' => 'Ծաղկալանջ',
                'name_ru' => 'Цагкаланж',
                'name_en' => 'Tsaghkalanj',
            ],
            [
                'name_am' => 'Ծիածան',
                'name_ru' => 'Циадан',
                'name_en' => 'Tsian',
            ],
            [
                'name_am' => 'Վանանդ',
                'name_ru' => 'Вананд',
                'name_en' => 'Vanand',
            ],
            [
                'name_am' => 'Վարդանաշեն',
                'name_ru' => 'Варданашен',
                'name_en' => 'Vardanashen',
            ],
            [
                'name_am' => 'Ոսկեհատ',
                'name_ru' => 'Оскехат',
                'name_en' => 'Voskehate',
            ],
            [
                'name_am' => 'Եղեգնուտ',
                'name_ru' => 'Ехегнут',
                'name_en' => 'Yeghenut',
            ],
            [
                'name_am' => 'Երասխահուն',
                'name_ru' => 'Ерасахахун',
                'name_en' => 'Erasxahun',
            ],
            [
                'name_am' => 'Երվանդաշատ',
                'name_ru' => 'Ервандашад',
                'name_en' => 'Yervandashat',
            ],
            [
                'name_am' => 'Զարթոնք',
                'name_ru' => 'Зартонк',
                'name_en' => 'Zartonq',
            ],
        ];
$id = 13;
// Example of using foreach to iterate over the array
        foreach ($cities as $city) {
            $add = new Region();
            $add->name_am   =   $city['name_am'];
            $add->name_ru   =   $city['name_ru'];
            $add->name_en   =   $city['name_en'];
            $add->slug   =   $city['name_en'];
            $add->parent_id =   $id;
            $add->save();
        }

//        $carBrands = [
//            "Brabus",
//            "Brilliance",
//            "Bugatti",
//            "Buick",
//            "BYD",
//            "Byvin",
//            "Cadillac",
//            "Chana",
//            "Changan",
//            "ChangFeng",
//            "Changhe",
//            "Chery",
//            "CheryExeed",
//            "Chevrolet",
//            "Chrysler",
//            "Citroen",
//            "Dacia",
//            "Dadi",
//            "Daewoo",
//            "Daihatsu",
//            "Daimler",
//            "Datsun",
//            "DeLorean",
//            "Denza",
//            "Derways",
//            "De Tomaso",
//            "DFSK",
//            "Dodge",
//            "DongFeng",
//            "Doninvest",
//            "DS",
//            "DW Hower",
//            "Efini",
//            "ErAZ",
//            "Farizon",
//            "FAW",
//            "Feifan",
//            "Ferrari",
//            "Fiat",
//            "Fisker",
//            "Ford",
//            "Forthing",
//            "Foton",
//            "Fuqi",
//            "GAC",
//            "GAZ (ГАЗ)",
//            "Geely",
//            "Genesis",
//            "Geo",
//            "GMC",
//            "Gonow",
//            "Great Wall",
//            "Groz",
//            "Hafei",
//            "Haima",
//            "Haval",
//            "Hawtai",
//            "Hindustan",
//            "HiPhi",
//            "Holden",
//            "Honda",
//            "Hongqi",
//            "Hongxing",
//            "Hozon",
//            "Huanghai",
//            "Hummer",
//            "Hyundai",
//            "IM Motors",
//            "Infiniti",
//            "Iran Khodro",
//            "Isuzu",
//            "IZH (ИЖ)",
//            "JAC",
//            "Jaguar",
//            "Jeep",
//            "Jensen",
//            "Jetour",
//            "Jiangnan",
//            "Jinbei",
//            "JMC",
//            "Karry",
//            "Kawei Auto",
//            "Kia",
//            "Lamborghini",
//            "Lancia",
//            "Land Rover",
//            "Landwind",
//            "Leapmotor",
//            "Lexus",
//            "Lifan",
//            "Lincoln",
//            "LiXiang",
//            "Logem",
//            "Lotus",
//            "LuAZ (ЛуАЗ)",
//            "Lucid",
//            "Luxgen",
//            "Mahindra",
//            "Maruti",
//            "Maserati",
//            "Maxus",
//            "Maybach",
//            "Mazda",
//            "McLaren",
//            "Mercedes-Benz",
//            "Mercury",
//            "MG",
//            "Microcar",
//            "Micro Mobility Systems",
//            "MINI",
//            "Mitsubishi",
//            "Morgan",
//            "Morris",
//            "Moskvich (Москвич)",
//            "Nio",
//            "Nissan",
//            "Nysa",
//            "OKA",
//            "Oldsmobile",
//            "Omoda",
//            "Opel",
//            "ORA",
//            "Pagani",
//            "Perodua",
//            "Peugeot",
//            "Plymouth",
//            "Polar Stone (Jishi)",
//            "Polestar",
//            "Pontiac",
//            "Porsche",
//            "Proton",
//            "Qiyuan",
//            "Qoros",
//            "RAM",
//            "Ravon",
//            "Renault",
//            "Renault Samsung",
//            "Rivian",
//            "Roewe",
//            "Rolls-Royce",
//            "Rover",
//            "Saab",
//            "Saipa",
//            "Saturn",
//            "Scion",
//            "Seat",
//            "Sena Motors",
//            "Shanghai Maple",
//            "Shifeng",
//            "ShuangHuan",
//            "Skoda",
//            "Skywell",
//            "SMA",
//            "Smart",
//            "SMZ",
//            "Soueast",
//            "SsangYong",
//            "Subaru",
//            "Suzuki",
//            "TagAZ",
//            "Talbot",
//            "Tata",
//            "Tatra",
//            "Tazzari",
//            "Tesla",
//            "Think",
//            "Tianma",
//            "Tianye",
//            "Tofas",
//            "Toyota",
//            "Trabant",
//            "Triumph",
//            "UAZ (УАЗ)",
//            "Vauxhall",
//            "VAZ (Lada)",
//            "VinFast",
//            "Volkswagen",
//            "Volvo",
//            "Voyah",
//            "Wartburg",
//            "Weltmeister",
//            "WEY",
//            "Willys",
//            "Wuling"
//        ];
//die();
//        foreach ($carBrands as $carBrand)
//        {
//            $add    =   new Carbrand();
//            $add->name  =   $carBrand;
//            $add->save();
//        }
        return "OK";
    }
}
