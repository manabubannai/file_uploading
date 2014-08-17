<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gallery extends CI_Controller {
	function index(){

		// Gallery_modelはまだ未作成なので、これから作成していきます。
		$this->load->model("Gallery_model");

		// アップロード情報がPOSTされたかどうかで条件分岐
		if($this->input->post("upload")){

			// Gallery_modelのモデルないにある、do_uploadファンクションはまだ未作成なので、これから作成していきます。
			$this->Gallery_model->do_upload();
		}

		// galleryのビューを読み込む

		// get_imagesファンクションはまだ未完成なので、これから作っていきます
		$data["images"] = $this->Gallery_model->get_images();
		$this->load->view("gallery", $data);
	}

}
