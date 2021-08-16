<?php
error_reporting(0);
function gTranslate($from, $to, $text) {
	$text = str_replace("\n", "\\\\n", $text);
	$form = ["f.req" => '[[["MkEWBc","[[\"'.$text.'\",\"'.$from.'\",\"'.$to.'\",true],[null]]",null,"generic"]]]'];
	$header = array('Content-Type: application/x-www-form-urlencoded');
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, "https://translate.google.cn/_/TranslateWebserverUi/data/batchexecute?rpcids=MkEWBc&f.sid=-6729934847070071743&bl=boq_translate-webserver_20210811.13_p0&hl=zh-CN&soc-app=1&soc-platform=1&soc-device=1&_reqid=560071&rt=c");
	curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
	curl_setopt($curl, CURLOPT_POST, 1);
	curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($form));
	curl_setopt($curl, CURLOPT_TIMEOUT, 10);
	curl_setopt($curl, CURLOPT_HEADER, 0);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
	$result = curl_exec($curl);
	if (curl_errno($curl)) {
		echo json_encode(array("isOk" => "err"));
		return;
	}
	curl_close($curl);
	$output = "";
	$result = json_decode(json_decode(explode("\n", $result)[3], true)[0][2])[1][0][0][5];
	for ($i = 0; $i < count($result); $i += 2) {
		$output .= $result[$i][0];
		if ($i != count($result) - 1) {
			$output .= "\n";
		}
	}
	return $output;
}
$pText = $_GET["text"];
$i18n = ["ar","be","bg","ca","cs","da","de","el","en","es","et","fi","fr","hr","hu","is","it","iw","ja","ko","lt","lv","mk","nl","no","pl","pt","ro","ru","sh","sk","sl","sq","sr","sv","th","tr","uk","zh"];
$pNewLang = $_GET["lang"];
for ($i = 0; $i < $_GET["force"]; $i += 1) {
	$pOldLang = $pNewLang;
	$pNewLang = $i18n[rand(0, 38)];
	$pText = gTranslate($pOldLang, $pNewLang, $pText);
}
$pText = gTranslate($pNewLang, $_GET["lang"], $pText);
echo json_encode(array("isOk" => "ok", "lang" => $_GET["lang"], "text" => $pText));
?>
