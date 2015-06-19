
</body>
<footer>

	<script
		src="<?php echo base_url("assets/js/tests/gremlins.min.js"); ?>"></script>

	<script>
	//decommenter pour lacher la horde
	
	
	//$("a[href='<?php echo site_url('logout') ?>']").attr('href', '#')
	gremlins.createHorde()
	  .gremlin(gremlins.species.formFiller())
	  .gremlin(gremlins.species.clicker().clickTypes(['click']))
	  //.unleash();
	</script>

</footer>
</html>