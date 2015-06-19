
</body>
<footer>

	<script
		src="<?php echo base_url("assets/js/tests/gremlins.min.js"); ?>"></script>

	<script>
	gremlins.createHorde()
	  .gremlin(gremlins.species.formFiller())
	  .gremlin(gremlins.species.clicker().clickTypes(['click']))
	  .gremlin(gremlins.species.scroller())
	  //.unleash();
	</script>

</footer>
</html>