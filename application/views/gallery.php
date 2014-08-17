<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>ギャラリー</title>
</head>
<body>

<div id="gallery">
	<?php	if(isset($images) && count($images)):
	 // フォルダ内に画像がある場合は以下を実行
		foreach($images as $image):
	?>
		<div class="tumbs">
			<a href="<?php echo $image["url"]; ?>">
				<img src="<?php echo $image["thumb_url"]; ?>">
			</a>
		</div>
	<?php endforeach; ?>

	<?php else: ?>
		<div id="blank_gallery">画像をアップロードしてください</div>
	<?php endif;?>

</div>

<div id="upload">
<?php
	// galleryに情報がPOSTされる
	echo form_open_multipart("gallery");

	// ファイルアップロードクラスを利用します。
	// デフォルトのファイルアップロード名は『userfile』なので、これを利用すると便利です。
	echo form_upload("userfile");

	echo form_submit("upload", "アップロード");
	echo form_close();
?>
</div>

</body>
</html>