<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>500 Sunucu Hatası</title>
		<style>
			body {
				font-family: sans-serif;
				font-size: 15px;
			}

			h2 {
				font-size: 160%;
			}
		</style>
	</head>
	<body>
		<h2>500 Sunucu Hatası</h2>
		<hr>

		<?php if (GELISTIRME_MODU): ?>
			<p>Mesaj: <strong><?=$e->getMessage()?></strong></p>
			<p>Dosya: <strong><?=$e->getFile()?></strong></p>
			<p>Satır: <strong><?=$e->getLine()?></strong></p>

			<hr>
			<p>Belirtiler:</p>
			<pre><?=$e->getTraceAsString()?></pre>
			<hr>
		<?php else: ?>
			<p>Bir uygulama hatası meydana geldi</p>
		<?php endif ?>
	</body>
</html>
