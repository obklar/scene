<?php
// EXEMPLE
// <div class="pretime" id="time-4016035" data="1386525975" data-livestamp="1386525975">1050d 1h 14m 42s</div>

date_default_timezone_set("Europe/Paris");
function conv($SEC){
	if($SEC <= '60'){ #Inférieur à 1 Minute
		$SECON=$SEC;
		return "[PRE : ".$SECON."s]";
	}elseif($SEC <= '3600'){ #Inférieur à 1 Heurs
		$MINUT=floor($SEC/60);$reste=$SEC%60;$SECON=$reste%60;
		return "[PRE : ".$MINUT."m".$SECON."s]";
	}elseif($SEC <= '86400'){ #Inférieur à 1 jours
		$HEURS=floor($SEC/3600);$reste=$SEC%3600;$MINUT=floor($reste/60);$reste=$SEC%60;$SECON=$reste%60;
		return "[PRE : ".$HEURS."h".$MINUT."m".$SECON."s]";
	}elseif($SEC <= '31536000'){ #Inférieur à 1 année
		$JOURS=floor($SEC/86400);$reste=$SEC%86400;$HEURS=floor($reste/3600);$reste=$SEC%3600;$MINUT=floor($reste/60);$reste=$SEC%60;$SECON=$reste%60;
		return "[PRE : ".$JOURS."j".$HEURS."h".$MINUT."m".$SECON."s]";
	}elseif($SEC >= '31536000'){ #Inférieur à 1 année
		$ANNES=floor($SEC/31536000);$reste=$SEC%31536000;$JOURS=floor($reste/86400);$reste=$SEC%86400;$HEURS=floor($reste/3600);$reste=$SEC%3600;$MINUT=floor($reste/60);$reste=$SEC%60;$SECON=$reste%60;
		return "[PRE : ".$ANNES."y".$JOURS."j".$HEURS."h".$MINUT."m".$SECON."s]";
	}
}

$RLS = $argv[1];

$homepage = file_get_contents('https://www.predb.org/search/'.$RLS.'/all');
preg_match("/data-livestamp=\"([0-9]+)\"/i", $homepage, $out);

if (!empty($out[1])){
	#date format timestamp
	$TIME_PARSE = $out[1];

	$DIFF = (time() - $TIME_PARSE);
	echo conv($DIFF);
}else{
	echo '[PRE : NoFound]';
}
?>
