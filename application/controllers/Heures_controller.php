<?php

abstract class Heures_controller
{

	public function convert ( $heures, $type )
	{
		switch ( $type ) {
			case "CM" :
				return $heures * COEF_CM;
			case "TD" :
				return $heures * COEF_TD;
			case "TP" :
				return $heures * COEF_TP;
			case "DS" :
				return $heures * COEF_DS;
			default :
				return $heures;
		}
	}

}
?>