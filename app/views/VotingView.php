<?php
class VotingView extends ED_View
{
    public function show($data = NULL)
    {
        if ($data != NULL)
        {
            $res = $data[0];
			$idea = $data[1];
			foreach($res as $row){
				echo '<form action="'.getBaseUrl(array('VotingController','update',$row['id'])).'" method="post">';
				echo $row['heading'].'<br>'.$row['question'].'<br>';

				foreach($idea[$row['heading']] as $col){
					echo '<input type="radio" name="idea" value="'.
							$col['id'].'">'.$col['text'].'<br>';
				}
				echo '<input type="submit" value="submit">';
				echo '</form>';
			}
        }
    }
    public function showResult($data = NULL)
    {
        if ($data != NULL)
        {
            $res = $data[0];
			$idea = $data[1];
			foreach($res as $row){
				echo $row['heading'].'<br>'.$row['question'].'<br>';

				foreach($idea[$row['heading']] as $col){
					echo  $col['text'].'=>'.$col['number'];
					echo "<br>";
				}
			}
        }
    }
    public function newVote($data = NULL)
    {		
				echo '<form action="'.getBaseUrl(array('VotingController','updateVote')).'" method="post">';
				echo 'heading :'.'<input Type="text" name="heading">';
				echo 'startTime :'.'<input Type="text" name="start">';
				echo 'endTime :'.'<input Type="text" name="end">';
				echo 'question : '.'<textarea name="question">Enter text here...</textarea> ';
				for($i=0;$i<$data;$i++){
					echo 'text :'.'<input Type="text" name="text[]">';					
				}
				echo '<input type="submit" value="submit">';
				echo '</form>';
			
    }
}
?>