<?php

class DefaultController extends Controller
{
	public function actionApilogin()
	{
		header("Access-Control-Allow-Origin: *");

		if(isset($_POST['username'], $_POST['password']))
			{
			  	Yii::import('application.modules.user.models.*');
			  	$model=new UserLogin;
				// collect user input data

				//$model->attributes=$_POST['UserLogin'];
			  	$model->username = $_POST['username'];
			  	$model->password = $_POST['password'];

				// validate user input and redirect to previous page if valid
				if($model->validate()) {
					$this->lastViset();

					$sql = "SELECT id FROM kolekin_user_users WHERE username LIKE '".$_POST['username']."'";
					$namauser = Yii::app()->db->createCommand($sql)->queryRow();
						
					$result = array('status'=>$namauser['id']);
					die(htmlspecialchars(json_encode($result), ENT_NOQUOTES));
				}else{
					$result = array('status'=>0);
					die(htmlspecialchars(json_encode($result), ENT_NOQUOTES));
				}
			}
	}

	/*$_POST['record_user_id']
	$_POST['record_form_id']
	$_POST['record_json_data']
	$_POST['latitude'] 
	$_POST['longitude']
	$_POST['created_at']
	$_POST['last_update']
	$_FILE['nama_file']*/

	public function actionApiinput()
	{
		header("Access-Control-Allow-Origin: *");

		//Yii::import('application.modules.kolekin.models.*')

		$modelrecord = new record;
		$modelrecordfoto = new recordfoto;

		if(isset($_POST['record_user_id'], $_POST['record_form_id'], $_POST['record_json_data'], $_POST['latitude'], $_POST['longitude'])){

			$modelrecord->record_user_id = $_POST['record_user_id'];
			$modelrecord->record_form_id = $_POST['record_form_id'];
			$modelrecord->record_json_data = $_POST['record_json_data'];
			$modelrecord->latitude = $_POST['latitude'];
			$modelrecord->longitude = $_POST['longitude'];
			$modelrecord->create_at = date("Y-m-d H:i:s");
			
			if($modelrecord->save()/* || isset($_FILE)*/){

				/*foreach ($_FILE as $key => $value) {

					$modelrecordfoto->record_id = $modelrecord->id;	
					$modelrecordfoto->foto = $key;

					$simpan = $modelrecordfoto->save;
				}*/

				$result = array('status'=>1);
				die(htmlspecialchars(json_encode($result), ENT_NOQUOTES));

			}else{
				$psn = "Data gagal dimasuka";
				$result = array('status'=>0,'pesan'=>$psn);
				die(htmlspecialchars(json_encode($result), ENT_NOQUOTES));
			}

			$result = array('status'=>1);
			die(htmlspecialchars(json_encode($result), ENT_NOQUOTES));

		}else{
			$psn = "Ada form yang masih kosong";
			$result = array('status'=>0,'pesan'=>$psn);
			die(htmlspecialchars(json_encode($result), ENT_NOQUOTES));
		}

		//print_r($_POST);
	}

	public function actionApites()
	{

		if(isset($_GET['tes']))
		{
		  	echo $_GET['tes'];
		}
	}

	public function actionIndex()
	{
		$this->render('index');
	}

	private function lastViset() {
		Yii::import('application.modules.user.models.*');
		$lastVisit = User::model()->notsafe()->findByPk(Yii::app()->user->id);
		$lastVisit->lastvisit = time();
		$lastVisit->save();
	}
}