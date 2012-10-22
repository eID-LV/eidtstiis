<?php

/*
 * parbaudam browseri
 * ja nav atlauts browseris atgriezam error
 * ja ne atgriezam false
 */
 
function check_browser() {
	$browser = get_browser(null, true);
	$error_text = "";

	if ($browser['ismobiledevice'] == '1') {
		$error = '<div class="alert"><strong>Kļūda!</strong> Pārbaude nav iespējama, izmantojot mobilo ierīci.</div>';
		return $error;
	}
	
	if ($browser["browser"] == "Firefox"){
		$error = '<div class="alert"><strong>Kļūda!</strong> Pārbaude nav iespējama, izmantojot Firefox pārlūkprogrammu.</div>';
		return $error;		
	}

	
	if ($browser["browser"] == "Opera"){
		$error = '<div class="alert"><strong>Kļūda!</strong> Pārbaude nav iespējama, izmantojot Opera pārlūkprogrammu.</div>';
		return $error;		
	}


	return false;
}

/*
 * funkcija smartkartes usera nolasisanai
 */
function get_smartcard_user(){
		
		$smartcard_user = array();
		
		//[CERT_SUBJECT] => C=LV, CN=VARDS UZVARDS, SN=UZVARDS, G=VARDS, SERIALNUMBER=110571-11820
	
		if (!isset($_SERVER['CERT_SUBJECT'])) {
			$smartcard_user['fullname'] = "";
			$smartcard_user['firstname'] = "";
			$smartcard_user['lastname']  = "";
			$smartcard_user['serial'] = "";
		} else {
			
			$CERT_SUBJECT_SPLIT = explode(",", $_SERVER['CERT_SUBJECT']);	
			
			//te protams vajag savadaku apstradi ar parbaudem, bet demonstracijai deres
			if (count($CERT_SUBJECT_SPLIT) >=5) {
			
				//pilns vards
				$CN = explode("=", $CERT_SUBJECT_SPLIT[1]);	
				$smartcard_user['fullname'] = $CN[1];
			
				//uzvards
				$SN = explode("=", $CERT_SUBJECT_SPLIT[2]);	
				$smartcard_user['lastname']  = $SN[1];
				
				//vards
				$G = explode("=", $CERT_SUBJECT_SPLIT[3]);
				$smartcard_user['firstname'] = $G[1];
				
				//personas kods
				$SERIALNUMBER = explode("=", $CERT_SUBJECT_SPLIT[4]);
				$smartcard_user['serial'] = $SERIALNUMBER[1];				
				
				
			} else {
				$smartcard_user['fullname'] = "";
				$smartcard_user['firstname'] = "";
				$smartcard_user['lastname']  = "";
				$smartcard_user['serial'] = "";
			}
		}

		
		//sertifikata deriguma terminas IIS gadijuma nav
		/*
		if (!isset($_SERVER['SSL_CLIENT_V_END'])){
			 $smartcard_user['SSL_CLIENT_V_END'] = $_SERVER['SSL_CLIENT_V_END'];
		} else {
			 $smartcard_user['SSL_CLIENT_V_END'] = "";
		}
		*/
		
		return $smartcard_user;
	}



?>