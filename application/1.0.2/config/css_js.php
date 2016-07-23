<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$config['css'] = array(
	// Bootstrap 3.3.5
	base_url("assets").'/bootstrap/css/bootstrap.min.css',
	
	// Font Awesome
	'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css',
	// Ionicons
	'https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css',
	
	// Theme style
	base_url("assets").'/dist/css/AdminLTE.min.css',
	// AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load.
	base_url("assets").'/dist/css/skins/_all-skins.min.css',
	
	
	#PLUGINS
	//Bootstrap Slider
	base_url("assets").'/plugins/bootstrap-slider/slider.css',
	
	// bootstrap wysihtml5 - text editor
	base_url("assets").'/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css',
	
	// Chart js
	//base_url("assets")
	
	//ckeditor
	base_url("assets").'/plugins/ckeditor/contents.css',
	
	//colorpicker
	base_url("assets").'/plugins/colorpicker/bootstrap-colorpicker.min.css',
	
	//datatables
	base_url("assets").'/plugins/datatables/dataTables.bootstrap.css',
	
	// Date Picker
	base_url("assets").'/plugins/datepicker/datepicker3.css',
	
	// Daterange picker
	base_url("assets").'/plugins/daterangepicker/daterangepicker-bs3.css',
	
	
	#// Fastclick
	
	// File Input
	base_url("assets").'/plugins/fileinput/css/fileinput.min.css',
	
	#// Flot
	
	// Full Calendar
	base_url("assets").'/plugins/fullcalendar/fullcalendar.min.css',
	base_url("assets").'/plugins/fullcalendar/fullcalendar.print.css',
	
	#// Gmaps
	
	// ICheck
	base_url("assets").'/plugins/iCheck/flat/blue.css',
	
	#// Input Mask
	
	// Ion Slider
	base_url("assets").'/plugins/ionslider/ion.rangeSlider.css',
	
	#// Jquery
	
	#// JqueryUI

	// jvectormap
	base_url("assets").'/plugins/jvectormap/jquery-jvectormap-1.2.2.css',
	
	#// Knob
		
	// Morris chart
	base_url("assets").'/plugins/morris/morris.css',
	
	// Pace
	base_url("assets").'/plugins/pace/pace.min.css',
	
	// Select2 
	base_url("assets").'/plugins/select2/select2.min.css',
	
	#// Slim Scroll
	
	#// Spark Line
	
	// Time Picker
	base_url("assets").'/plugins/timepicker/bootstrap-timepicker.min.css',
	//Setting menu
	base_url("assets").'/dist/css/setting_menu.css',
	//Bootsrap-Select
	base_url("assets").'/plugins/bootsrap-select/css/bootstrap-select.min.css',
    );

$config['js'] = array(
	// Bootstrap 3.3.5
	base_url('assets')."/bootstrap/js/bootstrap.min.js",
	
	#// Font Awesome
	
	#// Ionicons
	
	
	// AdminLTE
	// AdminLTE App
	base_url('assets')."/dist/js/app.min.js",
	// AdminLTE dashboard demo (This is only for demo purposes)
	base_url('assets')."/dist/js/pages/dashboard.js",
	// AdminLTE for demo purposes
	base_url('assets')."/dist/js/demo.js",
	
	
	#PLUGINS
	//Bootstrap Slider
	base_url('assets')."/plugins/bootstrap-slider/bootstrap-slider.js",
	
	// Bootstrap WYSIHTML5
	base_url('assets')."/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js",
	
	#// Chart js
	
	//ckeditor
	"https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js",
	
	//colorpicker
	base_url('assets')."/plugins/colorpicker/bootstrap-colorpicker.min.js",
	
	//datatables
	base_url('assets')."/plugins/datatables/jquery.dataTables.min.js",
	base_url('assets')."/plugins/datatables/dataTables.bootstrap.min.js",
	
	// datepicker
	base_url('assets')."/plugins/datepicker/bootstrap-datepicker.js",
	
	// daterangepicker
	"https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js",
	base_url('assets')."/plugins/daterangepicker/daterangepicker.js",
	
	// FastClick
	base_url('assets')."/plugins/fastclick/fastclick.js",
	
	// File Input
	base_url('assets')."/plugins/fileinput/js/fileinput.min.js",
	
	// Flot
	
	// Full Calendar
	base_url('assets')."/plugins/fullcalendar/fullcalendar.min.js",
	
	// Gmaps
	base_url('assets')."/plugins/gmaps/gmaps.min.js",
		
	// ICheck
	base_url('assets')."/plugins/iCheck/icheck.min.js",
	
	// Input Mask
	base_url('assets')."/plugins/input-mask/jquery.inputmask.js",
	base_url('assets')."/plugins/input-mask/jquery.inputmask.date.extensions.js",
	base_url('assets')."/plugins/input-mask/jquery.inputmask.extensions.js",

	// Ion Slider
	base_url('assets')."/plugins/ionslider/ion.rangeSlider.min.js",
	
	// jQuery 2.2.0
	base_url('assets')."/plugins/jQuery/jQuery-2.2.0.min.js",
	
	// jQuery UI 1.11.4
	"https://code.jquery.com/ui/1.11.4/jquery-ui.min.js",
	
	// jvectormap
	base_url('assets')."/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js",
	base_url('assets')."/plugins/jvectormap/jquery-jvectormap-world-mill-en.js",
	
	// jQuery Knob Chart
	base_url('assets')."/plugins/knob/jquery.knob.js",
		
	// Morris.js charts
	"https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js",
	base_url('assets')."/plugins/morris/morris.min.js",
	
	// Pace
	base_url('assets')."/plugins/pace/pace.min.js",
	
	// Select2 
	base_url('assets')."/plugins/select2/select2.full.min.js",
	
	// Slimscroll
	base_url('assets')."/plugins/slimScroll/jquery.slimscroll.min.js",
	
	// Sparkline
	base_url('assets')."/plugins/sparkline/jquery.sparkline.min.js",
	
	// Time Picker
	
	base_url('assets')."/plugins/timepicker/bootstrap-timepicker.min.js",
	//Bootsrap-Select
	base_url("assets").'/plugins/bootsrap-select/js/bootstrap-select.min.js',
	
    );