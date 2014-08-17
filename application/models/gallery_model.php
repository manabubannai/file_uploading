<?php
class Gallery_model extends CI_Model{

	var $gallery_path;

	// URLバージョンのギャラリーパスを取得
	var $gallery_path_url;

	function Gallery_model(){
		parent::__construct();

		// realpathとは
		// realpath() は、入力 path のシンボリックリンクをすべて展開し、正規化した絶対パスを返します。

		// APPPATHとは
		// CodeIgniterのApplicationフォルダの階層を指します
		$this->gallery_path = realpath(APPPATH. "../images");

		$this->gallery_path_url = base_url(). "images/";
	}

	function do_upload(){
		$config = array(
			// ファイルのアップロード制限
			"allowed_types"=>"jpg|jpeg|gif|png",

			// ファイルのアップロード先を決める
			"upload_path"=>$this->gallery_path,

			// 3MB以上の画像は受け付けない
			"max_size" => 3000
		);

		// 第2引数で条件を受け取ることができます。
		$this->load->library("upload", $config);
		$this->upload->do_upload();

		// アップロードライブラリを読み込み、$image_dataに格納
		$image_data = $this->upload->data();

		// アップロードライブラリで生成された$image_dataから、
		// 以下のようにアップロードファイルのパスを取得できる
		$config = array(
			"source_image"=> $image_data["full_path"],
			"new_image" =>$this->gallery_path . "/thumbs",

			// リサイズされるときや、固定の値を指定したとき、もとの画像のアスペクト比を維持するかどうかを指定する
			"maintain_ratio"=>true,
			"width"=>150,
			"height"=>100
		);

		// イメージライブラリは次のように引数をとります。
		// 引数はライブラリ読み込み前に定義しておきます。
		$this->load->library("image_lib", $config);
		$this->image_lib->resize();
	}

	// imagesフォルダのコンテンツを読み込む機能
	function get_images(){

		// scandirでは、指定したパスのディレクトリの内容を配列で取得できる
		$files = scandir($this->gallery_path);

		// array_diffでは配列の差分を計算します
		$files=array_diff($files, array(".", "..", "thumbs"));

		// まずはarrayを実行
		$images = array();

		// 実行済のarrayにforeachで値を挿入していく
		foreach($files as $file){
			$images[]= array(

				// URLバージョンのギャラリーパスを利用
				"url" =>$this->gallery_path_url . $file,
				"thumb_url" =>$this->gallery_path_url."thumbs/".$file
			);
		}
		return $images;
	}

}












