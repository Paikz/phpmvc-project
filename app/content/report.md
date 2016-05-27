Report
====================================

Kmom01:
------------------------------------

**Vilken utvecklingsmiljö använder du?**

Jag sitter just nu på operativsystemet Windows 10 och programmerar med hjälp av texteditorn Atom som jag lärt mig tycka om då den rekommenderades i de föregående kurserna. För att se mina resultat lokalt så använder jag XAMPP - Apache och sedan laddar jag upp dem på studentservern med commandotolken cygwin. Det är exakt samma utvecklingsmiljö som jag använde i föregående kurser och den är väldigt familjär vilket var väldigt smidigt och känns tryggt.

**Är du bekant med ramverk sedan tidigare?**

Jag har ingen tidigare erfarenhet av ramverk men jag tyckte det gick bra ändå. Det kändes överväldigande från första början då man såg alla filer som man inte hade någon alls koll på. Några timmar in i guiden så märkte jag dock snabbt att ramverket hjälper en väldigt mycket genom smidiga funktioner och moduler vilket gör att jag inte behöver kunna allt i ramverket för att kunna arbeta med det. Det kommer nog tag ett tag, men jag är säker på att ramverket kommer sitta i skallen så småningom.

**Är du sedan tidigare bekant med de lite mer avancerade begrepp som introduceras?**

Både ja och nej. Guiden hjälper till med att förklara de flesta begreppen och jag känner igen det mesta sen tidigare kurser, dock var det några begrepp man fick kolla upp själv eller fundera över.

**Din uppfattning om Anax, och speciellt Anax-MVC?**

Jag kan se mig själv gilla det längre fram men nu i början känns det besvärligt. Det är många filer att hålla reda på och mycket man inte förstår sig på. Dock är det en stor skillnad på rader kod som skrivs i frontkontrollerna vilket känns smidigt. Att arbeta med vyer verkar coolt då man kan återanvända dem som templates. Exempelvis page.tpl.php används både i Home och Report routen. Att det mesta bakgrundsarbete redan är gjort är också skönt då man bara behöver veta vilka funktioner man ska använda för att göra vad man tänkt sig.

Jag tycker även att arbeta i markdown är grymt. Det är så lätt att skriva stora stycken, som den här rapporten. Man behöver inte bry sig om att hålla på med jobbiga taggar utan det är nästan helt ren text.

Kmom02:
------------------------------------

**Hur känns det att jobba med Composer?**

Composer kändes väldigt smidigt för att installera / hantera paket och moduler vi hämtar från packagist. Vi använde inte composer särskilt mycket detta kursmoment men det gav ändå en bra feeling för vad man skulle kunna använda det till och hur smidigt det är att importera en modul till sitt projekt utan några som helst problem. Nu när vi börjar komma in i stora projekt där vi inte skriver all vår egen kod så känns composer som ett bra komplement för att snabba upp processen utav det vi lånar.

**Vad tror du om de paket som finns i Packagist, är det något du kan tänka dig att använda och hittade du något spännande att inkludera i ditt ramverk?**

Packagist verkar vara en simpel plattform för att hitta moduler och paket man kanske inte har tid eller kunskap om att koda själv. Jag har sneglat lite på olika paket och det finns helt klart bra saker att hämta från packagist. Ett exempel kan vara en modul som hanterar formulär på ett smidigare och betydligt bättre sätt än vad ni har gjort hittils. Jag hade definitivt tagit hjälp av innehållet på packagist i framtiden för till exempel hobbyprojekt eller liknande. I detta kursmoment valde jag dock att hålla det simpelt och inkluderade bara comments i mitt ramverk.

**Hur var begreppen att förstå med klasser som kontroller som tjänster som dispatchas, fick du ihop allt?**

Det tog ett bra tag innan man förstod vad som försiggick i detta kursmomentet då jag från början var rätt lost i hur de olika klasserna kopplades ihop och kommunicerade med varandra. Det hjälpte att kika i CDIFactoryDefault vilket svarade på många frågor om hur strukturen av hela ramverket fungerar. Just dispatchen var lite klurig men jag fick till slut koll på hur routerna läggs upp. Det hjälpte verkligen att förstå hur man får med sig parametrar från formulär till comments-klasserna genom att följa "controller/action/params" när man skapar en url.

Hela kursmomentet bygger på förståelse och när man väl förstår hur ramverket fungerar så kan jag se anax-mvc som väldigt smidigt. Nu känner jag dock att det är svårt att hänga med. Förhoppningsvis blir det bättre senare.

**Hittade du svagheter i koden som följde med phpmvc/comment? Kunde du förbättra något?**

Såhär på rak arm skulle jag inte kunna se någon uppenbar förbättring eller svaghet. Dock tycker jag att det är svårt att veta vilka filer som ska ligga i ramverkets mapp eller om det ska ligga utanför, i en egen webroot. Jag antar att det är personligt hur man vill ha det, men just nu blir det för många olika platser vi har filer på och det blir jobbigt i längden att hitta sökvägarna. Jag ska försöka att fixa till sökvägarna i senare kursmoment så att det jag jobbar med ligger utanför ramverkets mapp.

Kmom03:
------------------------------------

**Vad tycker du om CSS-ramverk i allmänhet och vilka tidigare erfarenheter har du av dem?**

När jag provade på webbutveckling på gymnasiet så använde jag mig smått av bootstrap för att få en enkel struktur på mina sidor. Det är verkligen de enda erfarenheterna jag har inom CSS-ramverk. Nu fick jag dock en mycket bättre introduktion till dem och jag tycker att det var väldigt smidigt och jag ser definitivt fördelen med att använda dem. Font-awesome var väldigt enkelt att implementera och det var lätt att välja ikoner på deras hemsida och sedan skräddarsy dem till mina behov. Semantic grid var lite klurigare men även den funkade väldigt bra. Att göra ett tema baserat på en grid är en väldigt bra ide och jag tycker nästan att vi borde gjort det tidigare i programmet.

**Vad tycker du om LESS, lessphp och Semantic.gs?**

Less är sjukt smidigt och öppnade upp en helt ny värld när det kommer till styling. Styling blir nästan som vanlig programmering nu när man kan ha variabler och återanvända kod med funktioner. Speciellt lessphp var väldigt smidigt då vi bara använder style.less för att importera alla less-filer i en och sedan kompilera den med hjälp av lessphp till en enda css fil. Upplägget var simpelt och lättförståeligt. Semantic.gs funkade på samma sätt i och med att vi bara inkluderade den i style.less och sedan var vi fria att stylea våra regioner med the semantic grid. Väldigt enkelt.

**Vad tycker du om gridbaserad layout, vertikalt och horisontellt?**

När man väl har det up and running så är det väldigt smidigt att lägga till och ta bort innehåll och regioner från sidan. Rutnätet ger ett professionellt utseende när det kommer till symmetri och läsbarhet. Det är väldigt skönt för ögat att kolla på en hemsida som implementerat ett rutnät. Det vertikala rutnätet ger symmetri och det horisontella ger en bra läsbarhet i och med det magiska avståndet mellan allt vi ritar ut.

**Har du några kommentarer om Font Awesome, Bootstrap, Normalize?**

Svarade på detta i första frågan. Normalize kan jag inte säga så mycket om då man inte direkt ser någon märkbar skillnad.

**Beskriv ditt tema, hur tänkte du när du gjorde det, gjorde du några utsvävningar?**

Mitt tema håller sig för det mesta till guiden då jag verkligen inte har tid till att leka runt för mycket med stylen. Hade jag haft lite mer tid så hade jag definitivt fixat till responsiviteten på sidan och sedan svävat ut med lite mer intressant design istället för vit bakgrund och tråkig font. Guiden gjorde dock ett bra jobb med att fixa till ett komplett tema och jag känner att det är väldigt lätt att ändra saker i det till senare. Så jag känner att stylea projektet lite senare kommer bli en rolig utmaning.

**Antog du utmaningen som extra uppgift?**

Då jag hade mycket att komma ikapp med så hann jag inte med att ladda upp det på github. Det kändes som att man var tvungen att tänka till och ändra rätt mycket för att få temat självständigt, vilket jag hade velat ha vilket är varför jag skippade uppgiften. Att restriktera temat till ett speciellt ramverk kändes inte så lovande. Jag tyckte dock att det hade tagit för mycket tid att klura ut hur jag hade gjort det vilket ledde till att jag skippade denna uppgift.


Kmom04:
------------------------------------

**Vad tycker du om formulärhantering som visas i kursmomentet?**

Formulärhanteringen i detta kursmoment tyckte jag var oerhört användbart. Nu när vi jobbar med väldigt tydliga MVC strukturer så tyckte jag att formulärhanteringen funkade väldigt bra i kommentarkontrollern och användarkontrollern. Det är lätt att skapa och skräddarsy alla formulär man vill ha och det är väldigt smidigt att göra det utan html och en egen fil.

**Vad tycker du om databashanteringen som visas, föredrar du kanske traditionell SQL?**

Jag tycker helt klart att det är lättare att överskåda sql koden genom det traditionella sättet men det gick lika bra att skriva sql kod på sättet vi gjorde detta kursmoment. Det är svårare att göra fel och de flesta funktionerna man kan tänkas behöva finns redan klara att använda.

**Gjorde du några vägval, eller extra saker, när du utvecklade basklassen för modeller?**

Nej jag tyckte att basmodellen vi kodade ihop i guiden räckte mer än väl för de uppgifterna vi skulle utföra. Det enda jag la till är en till funktion som hittar ett specifikt element från databasen med hjälp av id istället för att hitta alla.

**Beskriv vilka vägval du gjorde och hur du valde att implementera kommentarer i databasen.**

Jag följde MVC strukturen väldigt enkelt och jag gjorde på exakt samma sett i users som i comments. Mina comments fungerar som så att jag börjar med att jag initierar ett commentobjekt som ärver utav databasmodellen för att kunna kommunicera med databasen. Sedan samlar jag koden i kontrollern och har flera funktioner för de olika sakerna man ska kunna göra med varje user. Exempel kan vara att redigera, ta bort och aktivera. Formulärsvyn skapas i addAction och själva kommentarerna visas med viewAction vyn.

Jag valde just den här vägen eftersom att jag tyckte att det var väldigt enkelt att förstå. Man har en modell med grunderna för kommunikation av databasen samt en frontkontroller där man skapar formulär och vyer i funktioner och sedan används frontkontrollern i index-filen. Det blir inte för många filer och de blir inte överdrivet stora i detta stadiet.

Det var ett klurigt kursmoment och det tog väldigt lång tid att få till allt rätt men när man väl var klar så tyckte jag att jag så mycket mer förståelse generellt för hela ramverket och hur det fungerar.


Kmom05:
------------------------------------

**Var hittade du inspiration till ditt val av modul och var hittade du kodbasen som du använde?**

Helt ärligt så tog jag något jag tyckte skulle gå snabbt och smärtfritt men ändå utmana mig inom det jag är lite sämre på. Så att göra en klass för tabeller utmanade mig att göra en generell klass som man kan använda till att lätt skapa  tabeller med innehåll från databaser eller vad man nu vill. Vi har tidigare gjort en liknande klass som hette samma sak i kursen oophp. Dock tyckte jag inte att den koden var särskilt bra så jag gjorde istället min egen och testade mig fram sakta men säkert. Klassen blev varken stor eller avancerad men jag tycker ändå att den gör vad den ska riktigt bra och jag är nöjd med det.

**Hur gick det att utveckla modulen och integrera i ditt ramverk?**

Att utveckla den var inte så svårt egentligen. Det svåraste var att man var tvungen att måla upp en bild och ett flöde i huvudet innan man satte igång med kodandet. Inte bara måste man tänka på hur man ska skriva själva klassen, utan även hur man ska lätt kunna använda den i olika sammanhang. Att integrera modulen i mitt ramverk var lätt, för mig. Att integrera den med en clean installation av Anax var mycket lurigare då jag varken hade tillgång till databasklasserna eller liknande. Till slut blev testfilen väldigt simpel och liten men jag visar lite mer avancerat på min egen sida på studentservern hur man kan använda klassen ihop med databaser.

**Hur gick det att publicera paketet på Packagist?**

Att publicera på packagist gick väldigt snabbt. Det enda jag behövde göra var att skapa min egen composer.json som såg ut på ungefär samma sätt som mos. Sedan var det bara att lägga upp modulen på github och länka med packagist. De förklarade väldigt bra hur man länkar paketen samt autouppdaterar packagist med github med hjälp av webhooks.Det enda jag störde mig lite på var att när jag pushade ut nya saker på min github så tog det väldigt lång tid för packagist att uppdatera, vilket ledde till mycket dötid. Den manuella uppdateringsknappen på dess hemsida verkar inte funka så bra.

**Hur gick det att skriva dokumentationen och testa att modulen fungerade tillsammans med Anax MVC?**

Att skriva dokumentationen var simpelt. Det var i princip bara att skriva dem stegen jag själv tog för att installera modulen med en clean install av Anax. Sedan la jag även till hur man skapar tabeller med klasser. Att testa modulen med Anax var dock väldigt krångligt. Det är så mycket man har gjort i sitt eget Anax som man tar för givet. Exempel på detta är alla databasklasser vi har lagt till. Det slutade med att jag skapade en så enkel tabell som möjligt i en testfil för att visa hur man gör en tabell.

**Gjorde du extrauppgiften? Beskriv i så fall hur du tänkte och vilket resultat du fick.**

Jag gjorde inte extrauppgiften.

Kmom06:
------------------------------------

**Var du bekant med några av dessa tekniker innan du började med kursmomentet?**

Jag har sett de olika badges överst i olika github repos README men jag har aldrig förstått riktigt vad de var till för än att indikera på att ett repo var validerat. Så allt i detta kursmomentet var helt nytt för mig. PHPUnit, Travis, Scrutinizer, allt var nytt. Och det var väl bra i och för sig då man lärde sig mycket på det. Det fick upp mina ögon för enhetstestning och hur viktigt det faktiskt är att validera sin kod.

**Hur gick det att göra testfall med PHPUnit?**

PHPUnit var lite svårt att installera, men med hjälp av dbwebbs forumposter så lyckades jag till slut. Jag lyckades tanka ner det med composer in i min Anax vendor mapp och sedan var jag tvungen att använda kommandot phpunit.bat varje gång för att få det att fungera.

Testfallen var inte så svåra att greppa för just min modul då min modul är väldigt simpel i sig. Jag har bara en funktion som returnerar en sträng med html så det var inte så svårt att göra ett testfall för det. Dock kan jag tänka mig att det tar betydligt längre tid om man försöker göra testfall för tex hela Anax-MVC. Därför tror jag att det är bra att göra enhetstestning under tiden som man kodar, och inte när man kodat klart allt.

**Hur gick det att integrera med Travis?**

Att integrera med Travis var väldigt enkelt. Det var bara att logga in med sitt github-konto och sedan välja sitt repo som man vill länka. En webhook skapas automatiskt och varje gång man pushar upp något så uppdaterades Travis av sig själv. Det gick felfritt, även om jag kan tycka att Travis arbetar väldigt segt. Man var tvungen att vänta länge på sina commits som i vissa fall bara ändrade några rader i sin README.mk. Jag gillar dock Travis. Man får enkla meddelanden om man har förstört något i sin build och får tips på hur man fixar det.

**Hur gick det att integrera med Scrutinizer?**

Scrutinizer gick lika felfritt som Travis. Dock kan jag tycka att det var lite buggigt när det skulle uppdatera sig tillsammans med Travis. Det var flera gånger jag hade fixat issues i min kod som jag trodde skulle ge högre rating och coverage men som inte gjorde något alls. Ibland fanns issues även kvar även om jag hade fixat dem. Jag fick till slut ta bort mitt repo från Scrutinizer och sedan länka det igen för att allt skulle uppdateras som det skulle. Till slut fick jag fram rätt Code coverage och rating.

Integrationen var dock väldigt simpel som sagt. Bara att logga in med sitt github-konto och sedan söka och lägga till ett av sina repon. Sedan fixar Scrutinizer allt själv tillsammans med Travis. Att skriva sina YML filer var väldigt enkelt. Jag använde samma filer som mos mer eller mindre.

**Hur känns det att jobba med dessa verktyg, krångligt, bekvämt, tryggt? Kan du tänka dig att fortsätta använda dem?**

Om jag sitter och kodar så hade jag nog faktiskt inte använt dem eftersom jag hade tyckt att de var en distrahering. Dock skulle jag kunna tänka mig att använda dem verktygen efter jag har kodat klart en klass för att validera den. Travis fungerar dock automatiskt så det hade jag faktiskt kunna tänka mig använda under tiden som jag utvecklar något.

Att använda dem var inte riktigt krångligt eller svårt, dock var det inte bekvämt. När man utvecklar mindre moduler känns det inte riktigt lönt enligt mig att använda enhetstestning. Jag föredrar hellre att bara koda och sen testa om det funkar. Jag fattar dock att det inte håller i längden med större moduler och projekt så det var helt klart bra att vi fick lära oss enhetstestning.

**Gjorde du extrauppgiften? Beskriv i så fall hur du tänkte och vilket resultat du fick.**

Jag fick 97% Code coverage och 9.14 Rating i Scrutinizer. Min code coverage är jag nöjd med då min klass är helt testad. Det enda som inte blev testat var ett return-statement i autoloadern och jag vet inte riktigt hur man ska inkludera den i testningen. Jag tycker att 97% var ett bra ställe att stanna på.

Min rating i Scrutinizer var lite konstig eftersom jag fixade alla issues i min klass. Jag trodde jag skulle få högre men tydligen gillar inte Scrutinizer att jag använder if och for-each satser. Jag nöjer mig med över 9 i rating dock.


Project:
------------------------------------

Report of project
