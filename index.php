<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOTTO</title>
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="/lotto1/css/style.css">
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

	<script>
	  ( function( factory ) {
		if ( typeof define === "function" && define.amd ) {

			// AMD. Register as an anonymous module.
			define( [ "../widgets/datepicker" ], factory );
		} else {

			// Browser globals
			factory( jQuery.datepicker );
		}
	}( function( datepicker ) {

	datepicker.regional.pl = {
		closeText: "Zamknij",
		prevText: "&#x3C;Poprzedni",
		nextText: "Następny&#x3E;",
		currentText: "Dziś",
		monthNames: [ "Styczeń","Luty","Marzec","Kwiecień","Maj","Czerwiec",
		"Lipiec","Sierpień","Wrzesień","Październik","Listopad","Grudzień" ],
		monthNamesShort: [ "Sty","Lu","Mar","Kw","Maj","Cze",
		"Lip","Sie","Wrz","Pa","Lis","Gru" ],
		dayNames: [ "Niedziela","Poniedziałek","Wtorek","Środa","Czwartek","Piątek","Sobota" ],
		dayNamesShort: [ "Nie","Pn","Wt","Śr","Czw","Pt","So" ],
		dayNamesMin: [ "N","Pn","Wt","Śr","Cz","Pt","So" ],
		weekHeader: "Tydz",
		dateFormat: "dd-mm-yy",
		maxDate: "+0d",
		firstDay: 1,
		isRTL: false,
		showMonthAfterYear: false,
		yearSuffix: "" };
	datepicker.setDefaults( datepicker.regional.pl );

	return datepicker.regional.pl;

	} ) );
		  $(function() {
			$( "#datepicker" ).datepicker();
		  });
		  $(function() {
			$( "#datepicker1" ).datepicker();
		  });
      $(function() {
			$( "#datlos" ).datepicker({maxDate: "+1y"});

		  });
	 </script>
</head>

<body>
    <?php
        include ('moduly.php');
        $adres_lotto = 'http://www.mbnet.com.pl/dl.txt';
        $adres_mutimulti = 'http://www.mbnet.com.pl/ml.txt';
        $adres_minilotto = 'http://www.mbnet.com.pl/el.txt';
    ?>
    <div id="wrapper">
        <header>
            <?php
                naglowek();
            ?>
        </header>
        <section>
            <nav>
                <?php
                menu();
                ?>
            </nav>
            <article>
                <?php
					$od = "";
					$do = "";
					if (isset($_GET['data'])){
						$data = (explode(",",$_GET['data']));
						$od = $data[0];
						$do = $data[1];
					}
					if (isset($_POST['ilo'])){
						$ilo = $_POST['ilo'];
						if ($_POST['od']!=='' && $_POST['do']!==''){
							$od = $_POST['od'];
							$do = $_POST['do'];
						}
					}
					else if (isset($_GET['ilo'])){
						$ilo = $_GET['ilo'];
					} else {
						$ilo = 20;
					}
                    if (isset($_GET['str'])){
                        $strona = $_GET['str'];
                        if ($strona == ""){
                            $strona =1;
                        }
                    }
                    if (isset($_GET['podstrona'])){
                        menu_pod($_GET['page']);
                        if ($_GET['podstrona'] == 'ostatnio'){

                          if (isset($_GET['liczba'])){
                            tytul($_GET['page'], 'przerwy w losowaniu liczby: '.$_GET['liczba']);
                            liczba_historia($_GET['page'], $_GET['liczba']);
                          } else {
                            tytul($_GET['page'], 'ostatnie wylosowanie liczb');
                            ostatnie_wylosowanie_liczby($_GET['page']);
                          }
                      }
                      elseif ($_GET['podstrona'] == 'data') {
                        if (isset($_POST['datalos']) && ($_POST['datalos'])!=''){
                          $data_s = (explode("-",$_POST['datalos']));
                          tytul($_GET['page'], "najczęściej losowane liczby dnia: " . ($data_s[0]) . "-" . ($data_s[1]));
                          wybrana_data();
                          data_losowanie($_GET['page'], $_POST['datalos']);
                        } else {
                          tytul($_GET['page'], 'najczęściej losowane liczby danego dnia');
                          wybrana_data();
                        }
                      }
                    }
                    else if (isset($_GET['page'])){

                       switch ($_GET['page']){
                            case 'lotto':
                                menu_pod('lotto');
                                pasek();
                                tytul('lotto', 'wyniki');
                                wyniki($adres_lotto, 'liczby-lotto', $strona, 'lotto', $ilo, $od, $do);
                                break;
                            case 'multimulti':
                                menu_pod('multimulti');
                                pasek();
                                tytul('multimulti', 'wyniki');
                                wyniki($adres_mutimulti, 'liczby-multi', $strona, 'multimulti', $ilo, $od, $do);
                                break;
                            case 'minilotto':

                                menu_pod('minilotto');
                                pasek();
                                tytul('minilotto', 'wyniki');
                                wyniki($adres_minilotto, 'liczby-lotto', $strona, 'minilotto', $ilo, $od, $do);
                                break;
                       }
                   } else {
                      glowna();
                   }
                ?>
            </article>
        </section>
        <footer>
            <?php
                stopka();
            ?>
        </footer>
    </div>

</body>
<script src="/lotto1/java/javascript.js"></script>
</html>
