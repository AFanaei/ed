<?php
class Vote extends ED_Model
{
    public function getAllActiveVotings()
    {
		$date = new DateTime();
		$res = $this->pdo->query('SELECT * FROM voting WHERE isactive=1 AND startTime< NOW() AND endTime> NOW()');
		$i=0;
		foreach($res as $row){
		$rows[$i]=$row;
		$i++;
}
		return $rows;
    }
	public function getIdeasOfVoting($id)
	{
		$res = $this->pdo->query('SELECT * FROM idea WHERE id_voting='.$id);
		$i=0;
		foreach($res as $row){
		$rows[$i]=$row;
		$i++;
	}
		return $rows;
	}
	public function getVotingById($id){
		$res = $this->pdo->query('SELECT * FROM voting WHERE id='.$id);
		$i=0;
		foreach($res as $row){
		$rows[$i]=$row;
		$i++;
	}
		return $rows;
	
	}
	public function increaseIdeaUnknown($i){
		$sql = 'UPDATE idea SET number=(number+1) WHERE id = '.$i;
		$res = $this->pdo->exec($sql);
		return $res;
	}
	public function increaseIdeaCoockie($arr){
		$click=$arr[0];
		$i=$arr[1];
		if($this->cookie->get('rayaVoted'.$i)==false){
		//if(!isset($_COOKIE['rayaVoted'.$i])){
		//setcookie('rayaVoted'.$i, $click, 0, "", "", false, false);
		$this->cookie->create('rayaVoted'.$i, $click);
		$sql = 'UPDATE idea SET number=(number+1) WHERE id = '.$click;
		$res = $this->pdo->exec($sql);
		$i=0;
		return $res;
		}
		return 'you voted before';
	}
	public function increaseIdeaUser($arr){
		$click=$arr[0];
		$i=$arr[1];	
		$sql = 'UPDATE idea SET number=(number+1) WHERE id = '.$click;
		$res = $this->pdo->exec($sql);
		$i=0;
		return $res;
	}

	public function addVoting(){
		$head = $this->input->post('heading',true);
		$question = $this->input->post('question',true);
		$texts = $this->input->post('text',true);
		$start =$this->input->post('start',true);
		$end =$this->input->post('end',true);
		$startT= new \DateTime($start);
		$endT=new \DateTime($end);
//		$texts = $_POST['text'];
//		var_dump( $texts);
		$sql = "INSERT INTO voting (id, isactive, type, startTime, endTime, heading, question) ".
			   "VALUES (NULL, 1, 0, '".$startT->format('Y-m-d H:i:s')."', '".$endT->format('Y-m-d H:i:s')."', '".$head."' , '".$question."' )";
		$res = $this->pdo->exec($sql);
		if($res!=1){
			return $res;
		}
		$sql = "select LAST_INSERT_ID()";
		$res = $this->pdo->query($sql);
		foreach($res as $row){
			$id =  $row[0];
		}
		foreach($texts as $text){
			$sql = "INSERT INTO idea (id, id_voting, number, text) ".
			   "VALUES (NULL, ".$id." ,  0 , '".$text."' )";
			$res = $this->pdo->exec($sql);
		}
		return $id;
	}
}
?>