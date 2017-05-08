<?php

function convertYTLinkToEmbed($youtube_link) {
	return preg_replace(
		"/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
		"www.youtube.com/embed/$2",
    $youtube_link
	);
}


function uploadImage () {

	// Setzt $isBannerMoved (den Indikator, ob die Datei verschoben wurde oder nicht) auf false (nicht verschoben).
	$isImageMoved = false;

	// Wenn $_FILES["Profilbanner"]["tmp_name"] gesetzt ist,
	if ($_FILES["Image-Link"]["tmp_name"]) {

		// wird der temporäre Dateiname unter dem die Datei auf dem Server gespeichert wurde, gespeichert,
		$temp_file = $_FILES["Image-Link"]["tmp_name"];

		// wird ein Dateipfand-Separator in $dir_seperator gespeichert,
		$dir_seperator = DIRECTORY_SEPARATOR;

		// wird der gewünschte Dateiname aus $username und dem Dateiformat ".jpg" zusammengesetzt und in $banner_name gespeichert und
		$image_name = _alphanumToken();

		$image_name_extension = $image_name . ".jpg";

		// wird der gewünschte Dateipfad, unter dem die Datei auf dem Server gespeichert wurde, in der Variablen $path gespeichert.
		$path = "image_uploads" . $dir_seperator . $image_name_extension;

		// Wenn außerdem, die Datei erfolgreich zum gewünschten Pfad verschoben wurde,
		if (move_uploaded_file($temp_file, $path)) {

			// wird $isBannerMoved (der Indikator, ob die Datei verschoben wurde oder nicht) auf true (verschoben) gesetzt.
			$isImageMoved = true;

			$resultArray = [];

			$resultArray["isImageMoved"] = $isImageMoved;

			$resultArray["image_name"] = $image_name;

		 }

	 }

	 // Es wird $isBannerMoved (der Indikator, ob die Datei verschoben wurde oder nicht) zurückgegeben.
	 return $resultArray;

}

 ?>
