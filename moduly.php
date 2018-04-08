<?php
	$adres_serwera = '/lotto1';
    function naglowek(){
		global $adres_serwera;
        echo "<a href='". $adres_serwera ."'><img src='". $adres_serwera ."/image/GettyImages-109687781.jpg' alt='LOTTO'></a>";
    }

    function wyniki($adres, $css, $pozycja_w, $dane, $ilosc_p, $od, $do){
			global $adres_serwera;
			if ($od != "" && $do != ""){
				$ilosc_adres ="/$ilosc_p/$od,$do";
			}else if ($ilosc_p == 20){
				$ilosc_adres ="";
			} else {
				$ilosc_adres ="/$ilosc_p";
			}
			$plik = implode('', file($adres));
			$duzy_lotek = explode("\n",$plik);
			$duzy_lotek = array_reverse($duzy_lotek);

			if ($od != ""){
				$od = new DateTime($od);
				$do = new DateTime($do);
				$data_sort[] = "";
				for ($i=1; $i< count ($duzy_lotek); $i++){
					$szczegoly = (explode(" ",$duzy_lotek[$i]));
					$teraz = new DateTime($szczegoly[1]);
					if ($od <= $teraz && $do >= $teraz){
						$data_sort[] = $duzy_lotek[$i];
					}
				}


				$duzy_lotek = $data_sort;
			}
			$koniec = count ($duzy_lotek);
            $koniec = ceil($koniec/$ilosc_p);
			if ($pozycja_w > $koniec)
			{
				$pozycja_w = $koniec;
			}
            $pozycja = ($pozycja_w-1) * $ilosc_p;
            $ilosc = $pozycja+$ilosc_p;

            for ($i=$pozycja+1; $i<= $ilosc; $i++){
                if (count ($duzy_lotek)<= $i){
                    break;
                }
                $szczegoly = (explode(" ",$duzy_lotek[$i]));
                $liczby = (explode(",",$szczegoly[2]));
                print ("<div id='wyniki'>" . $szczegoly[1] . " nr. losowania " . $szczegoly[0] . "<div id='" . $css . "'>");
                foreach ($liczby as $s_liczby){
                    print ("<div id='liczba'>" . $s_liczby . "</div>");
                }
                print ("</div></div>");

            }
            echo "<div id='przyciski_nawigacji'>";
            if ($pozycja_w != 1){
                $pozycja_wn = $pozycja_w-1;
                echo "<div id='przycisk'><a href='". $adres_serwera ."/".$dane."/".$pozycja_wn.$ilosc_adres."'>Porzednia strona</a></div>";
            }


            if ($koniec < 7){
                echo "<div id='odstep'>";
                for ($i=1; $i <= $koniec; $i++){
                    if ($pozycja_w == $i){
                        echo " " . $i;
                    } else {
                        echo " <a href='". $adres_serwera ."/". $dane."/".$i.$ilosc_adres."'>". $i ."</a>";
                    }
                }
                echo "</div>";

            }
            else if($pozycja_w < 4){
                echo "<div id='odstep'>";
                for ($i=1; $i <= 4; $i++){
                    if ($pozycja_w == $i){
                        echo " " . $i;
                    } else {
                        echo " <a href='". $adres_serwera ."/". $dane."/".$i.$ilosc_adres."'>". $i ."</a>";
                    }
                }
                echo " ... <a href='". $adres_serwera ."/". $dane."/".$koniec.$ilosc_adres."'>". $koniec ."</a></div>";

            }
            else if($pozycja_w > $koniec-4){
                echo "<div id='odstep'><a href='". $adres_serwera ."/". $dane."/". 1 .$ilosc_adres."'>". 1 ."</a> ... ";
                for ($i=$koniec-4; $i <= $koniec; $i++){
                    if ($pozycja_w == $i){
                        echo " " . $i;;
                    } else {
                        echo " <a href='". $adres_serwera ."/". $dane."/".$i.$ilosc_adres."'>". $i ."</a>";
                    }
                }
                echo "</div>";
            }

            else{
                echo "<div id='odstep'>
                <a href='". $adres_serwera ."/". $dane."/". 1 ."'>". 1 .$ilosc_adres."</a>  ...
                <a href='". $adres_serwera ."/". $dane."/".($pozycja_w-1).$ilosc_adres."'>". ($pozycja_w-1) ."</a> ".$pozycja_w."
                <a href='". $adres_serwera ."/". $dane."/".($pozycja_w+1).$ilosc_adres."'>". ($pozycja_w+1) ."</a> ...
                <a href='". $adres_serwera ."/". $dane."/".$koniec."'>". $koniec ."</a></div>";
            }
            if ($pozycja_w < $koniec){
            echo "<div id='przycisk'><a href='". $adres_serwera ."/".$dane."/".($pozycja_w+1).$ilosc_adres."'>Następna strona</a></div></div>";
            }
            $pozycja_w+=1;
        }
    function linka($a, $b){
		global $adres_serwera;
        echo "<a href='". $adres_serwera ."/".$b."/".$a."'>". $a ."</a>";
    }
    function tytul($rodzaj,$dane){
      switch ($rodzaj){
        case 'lotto':
          echo "<div id='tytul'>Lotto - $dane</div>";
          break;
        case 'multimulti':
          echo "<div id='tytul'>Multi Multi - $dane</div>";
          break;
        case 'minilotto':
          echo "<div id='tytul'>Mini Lotto - $dane</div>";
          break;

      }
    }

    function menu(){
		global $adres_serwera;
        echo "<a href='". $adres_serwera ."/lotto'>Lotto</a>
                <a href='". $adres_serwera ."/multimulti'>Multi Multi</a>
                <a href='". $adres_serwera ."/minilotto'>Mini Lotto</a>";
    }

    function menu_pod($rodzaj){
		global $adres_serwera;
        echo "<div id='menu_pod'><a href='". $adres_serwera ."/$rodzaj'>Wyniki</a>
                <a href='". $adres_serwera ."/$rodzaj/ostatnio'>Ostatnie wylosowanie liczby</a>
                <a href='". $adres_serwera ."/$rodzaj/data'>Najczęściej losowane liczby danego dnia</a></div>";
    }
    function glowna(){
		global $adres_serwera;
        echo '<p><img id="raz" src="'. $adres_serwera .'/image/lotto.png" alt="lotto">Lotto (do 1975 Toto-Lotek, do 2009 Duży Lotek) – najstarsza, a zarazem najpopularniejsza w Polsce gra liczbowa organizowana przez Totalizator Sportowy. Pierwsze losowanie odbyło się 27 stycznia 1957. Polega na wytypowaniu wyników losowania 6 liczb z zakresu od 1 do 49.</p>
        <p><img src="'. $adres_serwera .'/image/multimulti.png" alt="multi multi">Multi Multi (do 14 czerwca 2009 Multi Lotek) – polska gra liczbowa, polegająca na wytypowaniu od 1 do 10 liczb oraz ustaleniu wybranej przez siebie wielokrotności (od 1 do 10 razy) stawki podstawowej zakładu. Wytypowane liczby są następnie porównywane z wylosowanymi przez maszynę losującą. Losowanie odbywa się dwa razy dziennie.</p>
        <p><img src="'. $adres_serwera .'/image/minilotto.png" alt="mini lotto">Mini Lotto (do 8 października 2009 Express Lotek) – gra liczbowa prowadzona przez Totalizator Sportowy. W zakładach prostych gracz typuje 5 z 42 liczb[a], możliwe jest również zawieranie zakładów systemowych w których gracz może wytypować od 6 do 12 liczb. Jeden zakład prosty Mini Lotto kosztuje 1 zł. (+ 0,25 zł. dopłaty na rozwój kultury fizycznej oraz wspieranie kultury narodowej).</p>';
    }
    function data_losowanie_dzialania($adres, $data){
      for ($i=0; $i < 81 ; $i++) {
        $tab_liczby[] = 0;

      }
      $data = (explode("-",$data));
      $plik = implode('', file($adres));
      $duzy_lotek = explode("\n",$plik);
      $duzy_lotek = array_reverse($duzy_lotek);
      for ($i=1; $i< count ($duzy_lotek); $i++){
        $szczegoly = (explode(" ",$duzy_lotek[$i]));
        $data_los = (explode(".",$szczegoly[1]));
        $liczby_los = (explode(",",$szczegoly[2]));
        if ($data[0] == $data_los[0] && $data[1] == $data_los[1]){
          foreach ($liczby_los as $l) {
            $tab_liczby[(int) ($l)]++;
          }
        }

      }
      foreach ($tab_liczby as $key => $value) {
        if ($value > 0){
          echo "<div id='liczba_data'>Liczba: $key ilość wylosowania: $value </div>";
        }
      }
    }
    function data_losowanie($rodzaj, $data){
      switch ($rodzaj){
        case 'lotto':
          data_losowanie_dzialania($GLOBALS['adres_lotto'], $data);
          break;
        case 'multimulti':
          data_losowanie_dzialania($GLOBALS['adres_mutimulti'], $data);
          break;
        case 'minilotto':
          data_losowanie_dzialania($GLOBALS['adres_minilotto'], $data);
          break;

      }

    }

    function ostatnie_wylosowanie_liczby_petal($ilosc, $adres, $rodzaj){
	  global $adres_serwera;
      $plik = implode('', file($adres));
      $duzy_lotek = explode("\n",$plik);
      $duzy_lotek = array_reverse($duzy_lotek);
      echo "<div id = 'zestaw_liczb'>";
      for ($i=1; $i<=$ilosc; $i++){
        echo "<div id='liczba_ost'><div id='liczba'><a href='". $adres_serwera ."/$rodzaj/ostatnio/$i'>$i</a></div><div id='dane'>:  ";
        for ($j=1; $j< count ($duzy_lotek); $j++){
          $liczby = explode(" ",$duzy_lotek[$j]);
          $liczby = explode(",",$liczby[2]);
          for ($x=0; $x< count ($liczby); $x++){
            if ($i==$liczby[$x]){
              echo ($j - 1)."</div></div>";
              $j = count ($duzy_lotek)+1;
            }
          }

        }
      }
      echo "</div>";
    }

    function ostatnie_wylosowanie_liczby($rodzaj){
      switch ($_GET['page']){
        case 'lotto':
            ostatnie_wylosowanie_liczby_petal(49, $GLOBALS['adres_lotto'], $rodzaj);
            break;
        case 'multimulti':
            ostatnie_wylosowanie_liczby_petal(80, $GLOBALS['adres_mutimulti'], $rodzaj);
            break;
        case 'minilotto':
            ostatnie_wylosowanie_liczby_petal(42, $GLOBALS['adres_minilotto'], $rodzaj);
            break;
      }
    }
    function liczba_historia_szczegoly($adres, $rodzaj, $liczba){
      $plik = implode('', file($adres));
      $duzy_lotek = explode("\n",$plik);
      $duzy_lotek = array_reverse($duzy_lotek);
      $w=0;
      $liczba = (int) ($liczba);
      for ($j=1; $j< count ($duzy_lotek); $j++){
        $w++;
        $liczby = explode(" ",$duzy_lotek[$j]);
        $liczby = explode(",",$liczby[2]);

        for ($x=0; $x< count ($liczby); $x++){
          if ($liczba == $liczby[$x]){
            $tab_w[] = $w-1;
            $w = 0;
          }
        }

      }

      echo "<div id = 'dane_przerwa'>Najdłuższa przerwa: " . max($tab_w) . "</div>";
      $tab_najwiecej[0]=0;
      foreach ($tab_w as $wynik){
        if(array_key_exists($wynik, $tab_najwiecej)){
          $tab_najwiecej[$wynik]++;
        } else {
          $tab_najwiecej[$wynik] = 1;
        }
      }
      echo "<div id = 'dane_przerwa'>Długość przerwy a ilość jej wystąpień:";
      foreach ($tab_najwiecej as $klucz => $wynik){
        echo " ($klucz): $wynik,";
      }
      echo "</div><div id = 'dane_przerwa'>Występowanie przerwy od najnowszej do najstarszej: ";
      foreach ($tab_w as $wynik) {
        echo ($wynik)."  ";
      }
      echo "</div>";
    }
    function liczba_historia($rodzaj, $liczba){
      switch ($rodzaj){
        case 'lotto':
            liczba_historia_szczegoly($GLOBALS['adres_lotto'], $rodzaj, $liczba);
            break;
        case 'multimulti':
            liczba_historia_szczegoly($GLOBALS['adres_mutimulti'], $rodzaj, $liczba);
            break;
        case 'minilotto':
            liczba_historia_szczegoly($GLOBALS['adres_minilotto'], $rodzaj, $liczba);
            break;
          }
    }
    function stopka(){
        echo '© 2018 Mariusz Wajlant ';
    }
	function pasek(){
		echo '<div id="pasek"><form action="" method="post">
				Data Od: <input type="text" id="datepicker" name="od"> Do: <input type="text" id="datepicker1" name="do">
				Ilość wyników: <select name="ilo">
					<option>20</option>
					<option>40</option>
					<option>60</option>
					<option>80</option>
					<option>100</option>
				</select>
				<input type="submit" value="Pokaż" />
			</form></div>';

	}

  function wybrana_data(){
    echo '<div id="pasek"><form action="" method="post">
				Data <input type="text" id="datlos" name="datalos">
				<input type="submit" value="Pokaż" />
			</form></div>';
  }


?>
