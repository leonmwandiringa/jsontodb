<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>

    </head>
    <body>
    <div class="resulthtml" style="display: none;"></div>

	<script src="./public/assets/js/jquery-3.2.1.min.js"></script>
    <script>
        jQuery(document).ready(function(){
            "use strict";
            var localeIns, xhr, fetchAsyncUrl = "localhost/dealswithgold/fetch", insertUrl = "localhost/dealswithgold/insert", htmlResult, htmlLooper, barText1, localeTopContent = {}, localeBottomContent = {}, objInsert, insertXhr;
            var localesObj = {
                ar-ae:"ar-ae",
                ar-sa:"ar-sa",
                cs-cz:"cs-cz",
                da-dk:"da-dk",
                de-at:"de-at",
                de-ch:"de-ch",
                de-de:"de-de",
                el-gr:"el-gr",
                en-ae:"en-ae",
                en-au:"en-au",
                en-ca:"en-ca",
                en-gb:"en-gb",
                en-hk:"en-hk",
                en-ie:"en-ie",
                en-in:"en-in",
                en-nz:"en-nz",
                en-sg:"en-sg",
                en-us:"en-us",
                en-za:"en-za",
                es-ar:"es-ar",
                es-cl:"es-cl",
                es-co:"es-co",
                es-es:"es-es",
                es-mx:"es-mx",
                fi-fi:"fi-fi",
                fr-be:"fr-be",
                fr-ca:"fr-ca",
                fr-ch:"fr-ch",
                fr-fr:"fr-fr",
                he-il:"he-il",
                hu-hu:"hu-hu",
                it-it:"it-it",
                ja-jp:"ja-jp",
                ko-kr:"ko-kr",
                nb-no:"nb-no",
                nl-be:"nl-be",
                nl-nl:"nl-nl",
                pl-pl:"pl-pl",
                pt-br:"pt-br",
                pt-pt:"pt-pt",
                ru-ru:"ru-ru",
                sk-sk:"sk-sk",
                sv-se:"sv-se",
                tr-tr:"tr-tr",
                zh-cn:"zh-cn",
                zh-hk:"zh-hk",
                zh-tw:"zh-tw"
            };
            //run all the locales
            function runAllLocales(){

                for(htmlLooper in localesObj){

                    runFetch(localesObj[htmlLooper]);

                }

            }

            //fetch the current page's html content
            function runFetch(localeIns){

                xhr = new XMLHttpRequest();

                xhr.open("POST", fetchAsyncUrl, true);

                xhr.setRequestHeader("Content-type","application/x-www-formurlencoded");

                xhr.onload = function(){

                    if(this.status == 200){

                        htmlResult = this.repsonseText;

                        getFields(htmlResult, localeIns);
                                                
                    }

                }

                xhr.send("locale="+localeIns);

            }
            //go through the dom content
            function getFields(htmlResult, localeIns){
                
                $(".resulthtml").append(htmlResult);
                barText1 = $(".resulthtml #ContentBlockList_1 .m-area-heading h2").text();
                //if existent grab name
                if($(".resulthtml #ContentBlockList_2 .m-area-heading h2")){
                    barText2 = $(".resulthtml #ContentBlockList_2 .m-area-heading h2").text();
                }
                var eachTopGame = $(".resulthtml #ContentBlockList_1 .m-product-placement-item");
                var eachBottomGame = $(".resulthtml #ContentBlockList_2 .m-product-placement-item");
                //create obkect heads
                localeTopContent.locale =  localeIns;
                localeBottomContent.locale = localeIns;

                //loop through xbox one games
                eachTopGame.each(function(){

                    localeTopContent.locale.gameConsole = barText1;
                    localeTopContent.locale.gamelink = $(this).find("a").attr("href");
                    localeTopContent.locale.gamearialabel = $(this).find("a").attr("aria-label");
                    localeTopContent.locale.gamedataclickname = $(this).find("a").attr("data-clickname");
                    localeTopContent.locale.gameimagesrc = $(this).find("a picture img").attr("src");
                    localeTopContent.locale.gameimagalt = $(this).find("a picture img").attr("alt");
                    localeTopContent.locale.gamename = $(this).find("a h3").text();
                    localeTopContent.locale.gamediscount = $(this).find("a h3 + span").text();

                });
                //loop throgh xbox 360 games
                eachBottomGame.each(function(){

                    localeBottomContent.locale.gameConsole = barText2;
                    localeBottomContent.locale.gamelink = $(this).find("a").attr("href");
                    localeBottomContent.locale.gamearialabel = $(this).find("a").attr("aria-label");
                    localeBottomContent.locale.gamedataclickname = $(this).find("a").attr("data-clickname");
                    localeBottomContent.locale.gameimagesrc = $(this).find("a picture img").attr("src");
                    localeBottomContent.locale.gameimagalt = $(this).find("a picture img").attr("alt");
                    localeBottomContent.locale.gamename = $(this).find("a h3").text();
                    localeBottomContent.locale.gamediscount = $(this).find("a h3 + span").text();

                });
                //insert the content in the db
                dbInsert(localeIns, localeTopContent);
                dbInsert(localeIns, localeBottomContent);

            }

            function dbInsert(localeIns, objInsert){

                insertXhr = new XMLHttpRequest();
                insertXhr.open("POST", insertUrl, true);
                insertXhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");

                insertXhr.onload = function(){

                    if(this.status == 200){

                        console.log("inserted");

                    }

                }

                inserXhr.send("locale="+localeIns+"&pagedata="+JSON.stringify(objInsert));

            }

        })
    </script>

    </body>
</html>