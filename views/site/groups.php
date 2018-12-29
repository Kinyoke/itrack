<?php
	use yii\helpers\Html;
	use yii\widgets\ActiveForm;

	$this->registerCssFile("/vendors/fontawesome-free-5.4.2-web/css/all.css");
	$this->registerCssFile("/css/main.css");
?>

<!-- GROUP NAME
GROUP DESCRIPTION
AMOUNT TO BE RISED
MOBILE NO -->

<link rel="stylesheet" type="text/css" href="/assets/fontawesome-free-5.4.2-web/css/all.css">

<link rel="stylesheet" type="text/css" href="/assets/main.css">

<link rel="stylesheet" type="text/css" href="/assets/responsive.css">



<div class="section-loader row">
	
	<div class="status-loader">

		<div class="status-loader loader-pane">
			<div id="status-progress"></div>
		</div>
	
		<div class="step-number-pane">
		
			<div class="step-number step-number-one">

				<svg class="svg" width="100" height="100" style="border-radius: 100%;">
  					<circle r="25" cx="50" cy="50" fill="white" stroke-dasharray="157" stroke-dashoffset="0"/>
  					<circle id="active-step" r="25" cx="50" cy="50" fill="transparent" stroke-dasharray="157" stroke-dashoffset="0"/>
  					<text x="43" y="57" class="step-number">1</text>
				</svg>
			</div> 

	    	<div class="step-number step-number-two">
	    		<svg class="svg" width="100" height="100" style="border-radius: 100%;">
  					<circle r="25" cx="50" cy="50" fill="white" stroke-dasharray="157" stroke-dashoffset="0"/>
  					<circle class="bar" r="25" cx="50" cy="50" fill="transparent" stroke-dasharray="157" stroke-dashoffset="0"/>
  					<text x="43" y="57" class="step-number">2</text>
				</svg>
	    	</div>

			<div class="step-number step-number-three">
				<svg class="svg" width="100" height="100" style="border-radius: 100%;">
  					<circle r="25" cx="50" cy="50" fill="white" stroke-dasharray="157" stroke-dashoffset="0"/>
  					<circle class="bar" r="25" cx="50" cy="50" fill="transparent" stroke-dasharray="157" stroke-dashoffset="0"/>
  					<text x="43" y="57" class="step-number">3</text>
				</svg>
			</div>

		</div>

	</div>

</div>


<div class="section-content row" id="section-content-active">

	<div class="group-container" style="margin-top: 100px;">

		<div class="create-group-pane">
			
			<h3>Start a fund riser</h3>
			

			<label for="m_number">Mobile number:</label>
			<input type="mobile" name="amountbid" class="form-control" id="m_number" placeholder="Enter your mobile number">

			<label for="u-id">Personal ID:</label>
			<input type="text" name="user_id" class="form-control" id="u_id" placeholder="Enter your national or passport ID">
	
			<button type="button" class="btn btn-info" id="userinf-btn">create group</button>

			<!-- <label id="login-prompt">Having a group account ? <a href="#">Login</a></label> -->

		</div>
	</div>

</div>


<div class="section-content row">

	<div class="group-container">

		<div class="create-group-pane">
			
			<h3>Start a fund riser</h3>
			
			<label for="amountX">Amount to be rised:</label>
			<input type="text" name="amountbid" class="form-control" id="amountX" placeholder="Enter amount eg: 30000">

			<label for="groupName">Group name:</label>
			<input type="text" name="groupName" class="form-control" id="groupName" placeholder="Orphanex global family">

			<label for="calender">Fundrising timeline:</label>
			<input type="date" name="calender" class="form-control" id="calender">

			<label for="groupDescription">Group description:</label>
			<textarea class="form-control"></textarea>

			<input type="checkbox" name="accept" class="form-input" id="accept">
			<label for="accept" style="margin-top: 10px;">Accept <a href="#">privacy policy</a> and terms</label>
	
			<button type="button" class="btn btn-info" id="cgroup-btn">create group</button>

			<!-- <label id="login-prompt">Having a group account ? <a href="#">Login</a></label> -->

		</div>
	</div>

</div>


<div class="section-content row">

	<div class="group-container" style="margin-top: 180px;">

		<div class="create-group-pane">
			
			<!-- <label for="amountX">Verify account:</label> -->
			<input type="text" name="amountbid" class="form-control" id="amountX" placeholder="Enter verification code eg: M-38JE43" required>
	
			<button type="button" class="btn btn-info" id="next-btn">next</button>

			<!-- <label id="login-prompt">Having a group account ? <a href="#">Login</a></label> -->

		</div>
	</div>

</div>




<div class="section-content row">

	<div class="group-container" style="margin-top: 150px;">

		<div class="create-group-pane">
			
			<div class="successful-group-c" id="success-icon"><i class="fa fa-check-circle"></i></div>

			<label for="success-icon" id="succ-msg">Group created successfully</label>

		</div>
	</div>

</div>


<script src="/js/animation.js"></script>
