<?php 
$this->load->view('t/general/head_view');
$this->load->view('t/general/body_single_view');
?>

<div class="container">
				
	<?php $this->load->view('t/auth/general_view'); ?>
	
	<?php $this->load->view('t/auth/menu_navigation_view'); ?>
	
	<?php 
	if (!empty($question)){
		$count_question = $question['count_answered'] + 1;
		if ($count_question <= 30){
	?>
	<div class="container formed" id="slider-carousel">
		<legend>Questions <small><b>No: <span id="count-question"><?php echo $count_question; ?></span></b> / 30</small></legend>
		<div class="btn-group" style="position:absolute;top:40px;right:30px;">
			<button class="btn btn-mini btn-action" id="navNext">Next</button>
		</div>
		<div class="questions" id="slider">
			<?php 
			$question_id = $question['question']->question_id;
			$score = $question['question']->score;
			$score_edit = str_replace("/:/", "", $question['question']->score);
			$answer_id = explode("/:/", $question['question']->answer_id);
			?>
			<div class="tk-slide question" id="question" data-ref="<?php echo $score_edit; ?>" data-uid-ref="<?php echo sha1(SALT . $score_edit); ?>" data-qid="<?php echo $question_id; ?>" data-uid-qid="<?php echo sha1(SALT . $question_id); ?>">
				<p><?php echo ucfirst($question['question']->question); ?></p>
				<div class="btn-group" id="btn-opt" data-toggle="buttons-radio">
					<?php foreach(explode("/:/", $question['question']->answer) as $i => $opt){ 
					list($title, $detail) = explode("|", $opt);
					?>
					<button class="btn" data-title="<?php echo ucfirst($detail); ?>" data-aid="<?php echo $answer_id[$i]; ?>" data-ref-aid="<?php echo sha1(SALT . $answer_id[$i]); ?>"><?php echo ucfirst($title); ?></button>
					<?php } ?>
				</div>
				<label class="checkbox" >
					<input type="checkbox" id="ask-mate" value="1"> <span data-title="How your mate respond ?" data-content="We will compare your answers with your mate.">Ask to your mate.</span>
				</label>
			</div>
		</div>
	</div>
	<?php
		}else{
	?>
		<div class="container formed" id="slider-carousel">
			<h2>Yeah, Great to you !.</h2>
			<p>We've already saved your results.</p>
			<form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>c/process_questions">	
				<fieldset>
					<div class="form-actions">
						<input type="hidden" name="code" value="<?php echo $code; ?>" />
						<input type="hidden" name="key" value="<?php echo $key; ?>" />
						<button type="submit" class="btn btn-warning" value="1" name="btn_submit">Next</button>
					</div>
				</fieldset>
			</form>
		</div>
	<?php
		}
	}
	?>
	
</div>

<div id="modal-message" class="modal hide fade in" style="display: hide; ">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">x</button>
		<h3>Warning</h3>
	</div>
	<div class="modal-body">
		<p>Something error. We fix soon again.</p>
	</div>
  </div>

<?php
$this->load->view('t/general/footer_single_view');
$this->load->view('t/general/footer_view');
?>