<?php
/**
 * @author Leon 
 * @uses help out in providing rom getters for provided locales
 * @return mutable locale string
 * 
 */
    namespace DealsWithGold\Helpers;

    class LocalesHelper{

        protected static $_locales = [
            
            "ar-ae"=>"ar-ae",
            "ar-sa"=>"ar-sa",
            "cs-cz"=>"cs-cz",
            "da-dk"=>"da-dk",
            "de-at"=>"de-at",
            "de-ch"=>"de-ch",
            "de-de"=>"de-de",
            "el-gr"=>"el-gr",
            "en-ae"=>"en-ae",
            "en-au"=>"en-au",
            "en-ca"=>"en-ca",
            "en-gb"=>"en-gb",
            "en-hk"=>"en-hk",
            "en-ie"=>"en-ie",
            "en-in"=>"en-in",
            "en-nz"=>"en-nz",
            "en-sg"=>"en-sg",
            "en-us"=>"en-us",
            "en-za"=>"en-za",
            "es-ar"=>"es-ar",
            "es-cl"=>"es-cl",
            "es-co"=>"es-co",
            "es-es"=>"es-es",
            "es-mx"=>"es-mx",
            "fi-fi"=>"fi-fi",
            "fr-be"=>"fr-be",
            "fr-ca"=>"fr-ca",
            "fr-ch"=>"fr-ch",
            "fr-fr"=>"fr-fr",
            "he-il"=>"he-il",
            "hu-hu"=>"hu-hu",
            "it-it"=>"it-it",
            "ja-jp"=>"ja-jp",
            "ko-kr"=>"ko-kr",
            "nb-no"=>"nb-no",
            "nl-be"=>"nl-be",
            "nl-nl"=>"nl-nl",
            "pl-pl"=>"pl-pl",
            "pt-br"=>"pt-br",
            "pt-pt"=>"pt-pt",
            "ru-ru"=>"ru-ru",
            "sk-sk"=>"sk-sk",
            "sv-se"=>"sv-se",
            "tr-tr"=>"tr-tr",
            "zh-cn"=>"zh-cn",
            "zh-hk"=>"zh-hk",
            "zh-tw"=>"zh-tw"

        ];

        public static function getLocales(){

            return self::$_locales;

        }

        public static function getSingleLocale($locale){

            return self::$_locales[$locale];
        }

    }


?>