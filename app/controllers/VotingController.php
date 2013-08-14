<?php
class VotingController extends ED_Controller
{
    public function showAll($data = NULL)
    {
       $res = $this->load->model(array('Vote', 'Vote'), 'getAllActiveVotings');
	   foreach($res as $row){
			$temp[$row['heading']] = $this->load->model(array('Vote', 'Vote'), 'getIdeasOfVoting',$row['id']);
	   }

       if (isset($res))
       {
           $this->load->view(array('VotingView', 'VotingView'), 'show', array( $res,$temp));
        }
    }
    public function show($i = NULL)
    {
		if($i!=NULL){
			$res = $this->load->model(array('Vote', 'Vote'), 'getVotingById', $i[0]);
			$dat = new DateTime();
			if($res[0]['isactive']==0 ){
				throw new Exception();
			}
			$temp[$res[0]['heading']] = $this->load->model(array('Vote', 'Vote'), 'getIdeasOfVoting',$i[0]);

       if (isset($res))
       {
           $this->load->view(array('VotingView', 'VotingView'), 'show', array( $res,$temp));
        }
	}
    }
    public function showResultAll($i = NULL)
    {
       $res = $this->load->model(array('Vote', 'Vote'), 'getAllActiveVotings');
	   foreach($res as $row){
			$temp[$row['heading']] = $this->load->model(array('Vote', 'Vote'), 'getIdeasOfVoting',$row['id']);
	   }

       if (isset($res))
       {
           $this->load->view(array('VotingView', 'VotingView'), 'showResult', array( $res,$temp));
        }
	}

    public function showResult($i = NULL)
    {
		if($i!=NULL){
			$res = $this->load->model(array('Vote', 'Vote'), 'getVotingById', $i[0]);
			$temp[$res[0]['heading']] = $this->load->model(array('Vote', 'Vote'), 'getIdeasOfVoting',$i[0]);

       if (isset($res))
       {
           $this->load->view(array('VotingView', 'VotingView'), 'showResult', array( $res,$temp));
        }
		}
    }
    public function update($i = NULL)
    {
		if($i!=NULL){
			$click = $this->input->post('idea',true);
			$res = $this->load->model(array('Vote', 'Vote'), 'getVotingById', $i[0]);
			if($res[0]['type']==0){
				$res = $this->load->model( array('Vote', 'Vote'), 'increaseIdeaUnknown' ,$click );
			}else if($res[0]['type']==1){
				$res = $this->load->model( array('Vote', 'Vote'), 'increaseIdeaCoockie' ,array($click,$i[0]) );
			}else{
				$res = $this->load->model( array('Vote', 'Vote'), 'increaseIdeaUser' ,array($click,$i[0]) );
			}
			if($res){
				header("Location: ".getBaseUrl(array('VotingController','showResult',$i[0])));
			}else{
				echo 'impossible';
			}		
		}
	}
    public function newVote($i = NULL)
    {
		if($i==NULL){
       $this->load->view(array('VotingView', 'VotingView'), 'newVote',4);
	   }else{
       $this->load->view(array('VotingView', 'VotingView'), 'newVote',$i[0]);
	   }
    }
	public function updateVote()
	{
			$res = $this->load->model(array('Vote', 'Vote'), 'addVoting');
			if($res){
				header("Location: ".getBaseUrl(array('VotingController','show',$res)));
			}else{
				echo 'impossible';
			}
	}
	}
?>