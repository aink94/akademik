	<!-- JS COnfig -->
	<?=put_js()?>
	<script type="text/javascript" src="<?=base_url('assets')?>/plugins/pnotify/pnotify.js"></script>
	<script type="text/javascript" src="<?=base_url('assets')?>/plugins/pnotify/pnotify.buttons.js"></script>
	<script type="text/javascript" src="<?=base_url('assets')?>/plugins/pnotify/pnotify.animate.js"></script>
	
	<script type="text/javascript" src="<?=base_url('assets')?>/plugins/pnotify/pnotify.confirm.js"></script>
	<script type="text/javascript" src="<?=base_url('assets')?>/plugins/pnotify/pnotify.nonblock.js"></script>
    <script type="text/javascript" src="<?=base_url('assets')?>/plugins/pnotify/pnotify.mobile.js"></script>
	<script type="text/javascript" src="<?=base_url('assets')?>/plugins/pnotify/pnotify.desktop.js"></script>
    <script type="text/javascript" src="<?=base_url('assets')?>/plugins/pnotify/pnotify.history.js"></script>
	<script type="text/javascript" src="<?=base_url('assets')?>/plugins/pnotify/pnotify.callbacks.js"></script>
    <script type="text/javascript" src="<?=base_url('assets')?>/plugins/pnotify/pnotify.reference.js"></script>
	<?=$js?>
	
	<script type="text/javascript">
		var stack_bottomright = {"dir1": "up", "dir2": "left", "firstpos1": 25, "firstpos2": 25};
		function show_stack_bottomright(type, vartitle, varteks) {
		    var opts = {
		        title: vartitle,
		        text: varteks,
		        type: type,
		        addclass: "stack-bottomright",
		        stack: stack_bottomright
		    };
		    new PNotify(opts);
		}
	</script>
	<?=pnotif()?>
	</body>
</html>