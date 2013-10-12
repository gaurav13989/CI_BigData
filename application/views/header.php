<!DOCTYPE html>
<html>
<head>
	<title>Big Data Project</title>
	<style type="text/css">
		#uploadBox, #deleteBox {
			padding: 10px;
			border: 1px solid black;
			margin: 10px;
		}
		.cell {
			padding: 10px;
			border: 1px solid black;
			float: left;
			min-width: 128px;
			min-height: 27px;
			margin-right: -1px;
			margin-bottom: -1px;
		}
		#deleteBox {
			
		}
		.clear {
			clear: both;
		}
		.record {
			text-align: center;
		}
	</style>
	<script type="text/javascript" src="/CI_BigData/public/jquery.min.js"></script>
	<script type="text/javascript">
		$(function(){

			$('.deleteBtn').click(function(){
				var c = confirm('Are your sure you want to delete the file?');
				if(c == true)
				{
					window.location = "/CI_BigData/index.php/data_load/delete/"+$(this).parent().prev().html();
				}
			});

		});
	</script>
</head>
<body>