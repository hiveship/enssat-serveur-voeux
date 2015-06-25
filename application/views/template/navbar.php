
<nav class="navbar navbar-default">
	<div class="navbar-inner">

		<div class="container-fluid">

			<div class="navbar-header">
				<a id="enssat" class="navbar-brand"
					href="<?php echo site_url("enseignants/cours_de/".$this->session->userdata('me')['login']);?>">ENSSAT</a>
			</div>
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
				<?php if ($this->session->userdata('me')['administrateur']) {?>
									<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"
						role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cogs"></i>
							Administration<span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="<?php echo site_url("admin/cours");?>">Gestion des cours</a></li>
							<li role="separator" class="divider"></li>
							<li><a href="<?php echo site_url("admin/decharges");?>">Gestion des décharges</a></li>
						</ul></li>
						<?php }?>
					<li><a
						href="<?php echo site_url("enseignants/cours_de/".$this->session->userdata('me')['login']);?>"
						value="mescours"><i class="fa fa-calendar-o"></i> Mes Cours</a></li>
					<li><a href="<?php echo site_url("cours");?>" value="cours"><i class="fa fa-university"></i>
							Voeux</a></li>
											<?php if ($this->session->userdata('me')['administrateur']) {?>
											<li><a href="<?php echo site_url("admin/enseignants");?>" value="enseignants"><i
							class="fa fa-male"></i> Enseignants</a></li>
							<?php } else {?>
									<li><a href="<?php echo site_url("enseignants");?>" value="enseignants"><i
							class="fa fa-male"></i> Enseignants</a></li>
							<?php }?>

				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a value="moncompte" href="<?php echo site_url("enseignants/edit") ?>"><i
							class="fa fa-user"></i> Mon Compte (<?php echo $this->session->userdata('me')['login']?>)</a></li>
					<li><a href="<?php echo site_url('logout') ?>" value="deconnexion"><i class="fa fa-power-off"></i>
							Déconnexion</a></li>
				</ul>
			</div>
		</div>
	</div>
</nav>

<script>
(function($) {

    $.fn.unicornblast = function(options) {
		//defaults in da house
		var settings = {
			start : 'click',
			numberOfFlyBys : 6,
			delayTime: 5000
		}
		
		// If options exist, lets merge them with our default settings
		var options = $.extend(settings,options);
		
		return this.each(function() {
			var animationRunning = false;
			var audioSupported = false;
			var content = '<img id="bigRainbow" style="display: none" src="<?php echo base_url('assets/images/unicorn/rainbow.gif')?>" />';
			content += '<img id="flyingUnicorn0" class="flyingUnicorn" style="display: none" src="<?php echo base_url('assets/images/unicorn/flyingUnicorn0.gif')?>" />';
			content += '<img id="flyingUnicorn1" class="flyingUnicorn" style="display: none" src="<?php echo base_url('assets/images/unicorn/flyingUnicorn1.gif')?>" />';
			content += '<img id="flyingUnicorn2" class="flyingUnicorn" style="display: none" src="<?php echo base_url('assets/images/unicorn/flyingUnicorn2.gif')?>" />';
			content += '<img id="flyingUnicorn3" class="flyingUnicorn" style="display: none" src="<?php echo base_url('assets/images/unicorn/flyingUnicorn3.gif')?>" />';

			audioSupported = true;
			content+= '<audio id="chimeSound0" preload="auto"><source src="<?php echo base_url('assets/sounds/unicorn/chime1.mp3')?>"/><source src="<?php echo base_url('assets/sounds/unicorn/chime1.ogg')?>" /></audio>';
			content+= '<audio id="chimeSound1" preload="auto"><source src="<?php echo base_url('assets/sounds/unicorn/chime2.mp3')?>"/><source src="<?php echo base_url('assets/sounds/unicorn/chime2.ogg')?>" /></audio>';
			content+= '<audio id="chimeSound2" preload="auto"><source src="<?php echo base_url('assets/sounds/unicorn/chime3.mp3')?>"/><source src="<?php echo base_url('assets/sounds/unicorn/chime3.ogg')?>" /></audio>';
			content+= '<audio id="contraSound" preload="auto" loop><source src="<?php echo base_url('assets/sounds/unicorn/contra.mp3')?>"/><source src="<?php echo base_url('assets/sounds/unicorn/contra.ogg')?>" /></audio>';

			//Add rainbow, unicorns, and sounds to page only if they do not already exist
			if($('#bigRainbow').size() == 0){
				$('body').append(content);
			}
		
			//Start logic
			if(options.start == 'click'){
				$(this).bind('click', function(e){
					if(animationRunning == false){
						start();
					}
					e.preventDefault();
				});
			}
			//Show unicorns
			var rainbow;
			var rHeight;
			var windowWidth;
			var windowHeight
			var flyByCount = 0;
			var entrySideCount = 0;
			var entrySide = ['left','top','right','bottom'];
			
			function start(){
				animationRunning = true;
				flyByCount = 0;
				windowWidth = $(window).width();
				windowHeight = $(window).height();

				//Set rainbow size and css as window size may have changed
				rainbow = $("#bigRainbow").attr('width',windowWidth / 1.2);
				rHeight = rainbow.height();
				var rWidth = rainbow.width();
				
				rainbow.css({
					"position":"fixed",
					"bottom":  "-"+rHeight+"px",
					"left" : (windowWidth / 2) - (rWidth / 2),
					"display" : "block",
					opacity: 0.0
				})
				
				//Play sound
				if(audioSupported){
					document.getElementById('chimeSound1').play();
				}
								
				//Raise the rainbow!!!
				rainbow.animate({
					bottom: "0px",
					opacity: 1.0
				}, 1800, function() {
					// Rainbow raise complete. Summon the unicorns!!!
					flyUnicorn();
				});
			}
		
			function flyUnicorn(){
				var entryPoint;
				var exitPoint;
				var unicornId = 'flyingUnicorn' + Math.floor(Math.random() * 4);
				var unicornImg = $("#"+unicornId);
				
				if(entrySide[entrySideCount] == 'left' || entrySide[entrySideCount] == 'right'){
					entryPoint = Math.floor(Math.random() * windowHeight);
					exitPoint = windowHeight - entryPoint;
				}else{
					entryPoint = Math.floor(Math.random() * windowWidth);
					exitPoint = windowWidth - entryPoint;
				}
				
				if(entrySide[entrySideCount] == 'left'){
					playRandomSound();
					unicornImg.css({
						"position":"fixed",
						"top":  entryPoint+"px",
						"left": "-"+unicornImg.width()+"px",
						"display" : "block"
					}).animate({
						"left":  windowWidth+"px",
						"top":  exitPoint-unicornImg.height()+"px",
					},2000,function(){
						checkComplete();
					});
				}else if(entrySide[entrySideCount] == 'right'){
					playRandomSound();
					unicornImg.css({
						"position":"fixed",
						"top":  entryPoint+"px",
						"left": windowWidth+"px",
						"display" : "block"
					}).animate({
						"left": "-"+unicornImg.width()+"px",
						"top":  exitPoint-unicornImg.height()+"px",
					},2000,function(){
						checkComplete();
					});
				}else if(entrySide[entrySideCount] == 'top'){
					playRandomSound();
					unicornImg.css({
						"position":"fixed",
						"top": "-"+unicornImg.height()+"px",
						"left": entryPoint+"px",
						"display" : "block"
					}).animate({
						"left":  exitPoint-unicornImg.width()+"px",
						"top":  windowHeight+"px",
					},2000,function(){
						checkComplete();
					});
				}else if(entrySide[entrySideCount] == 'bottom'){
					playRandomSound();
					unicornImg.css({
						"position":"fixed",
						"top": windowHeight+"px",
						"left": entryPoint+"px",
						"display" : "block"
					}).animate({
						"left":  exitPoint-unicornImg.width()+"px",
						"top": "-"+unicornImg.height()+"px",
					},2000,function(){
						checkComplete();
					});
				}
				
				entrySideCount++;
				if(entrySideCount == 4){
					entrySideCount = 0;
				}
				
				//Increment fly by count
				flyByCount++;
			}
			
			function playRandomSound(){
				if(audioSupported){
					var soundId = 'chimeSound' + Math.floor(Math.random() * 3);
					document.getElementById(soundId).play();
				}
			}
			
			var volCount = 0;
			function lowerVolume(){
				var audio = document.getElementById('contraSound');
				audio.volume = audio.volume - 0.05;
				volCount++;
				
				if(volCount == 19){
					document.getElementById('contraSound').pause();
					document.getElementById('contraSound').currentTime = 0;
					document.getElementById('contraSound').volume = 1;
					volCount = 0;
				}
			}
			
			function checkComplete(){
				if(flyByCount != options.numberOfFlyBys){
					//Keep flying!!!
					flyUnicorn();
				}else{
					//Hide all the unicors
					$(".flyingUnicorn").hide();
				
					//Fade out contra music
					if(audioSupported){
						for(i = 0; i < 19; i++){
							setTimeout(lowerVolume,100 * i);
						}
					}
					
					//Hide the rainbow
					rainbow.animate({
						"bottom":  "-"+rHeight+"px",
						opacity: 0.0
					}, 2000,function(){
						animationRunning = false;
						//Stop contra sound
						if(audioSupported){
							document.getElementById('contraSound').pause();
							document.getElementById('contraSound').currentTime = 0;
						}
					});
				}
			}
		});
    }
})(jQuery);

$(window).load(function() {
     $("#enssat").unicornblast();
}); // Active la petite annimation 'licorne' lors du click sur le bouton 'ENSSAT' });
</script>
