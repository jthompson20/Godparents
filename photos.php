<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>A Letter to My Godparents</title>

<?php include('inc/head.php'); ?>

</head>

<body>

	<?php include('inc/navbar.php'); ?>
		
	<?php include('inc/sidebar.php'); ?>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-12 col-lg-offset-2 main">					
		
		<div class="row">
			<div class="col-md-8">
			
				<div class="panel panel-default chat">
					<div class="panel-heading" id="accordion"><svg class="glyph stroked landscape"><use xlink:href="#stroked-landscape"></use></svg> Downloadable Photos</div>
					<div class="panel-body">
						
						<div class="row">

							<?php
							$files 	= array();
							$dir = "img/photos";
							$dh  = opendir($dir);
							while (false !== ($filename = readdir($dh))) {
							    $files[] = $filename;
							}
							$photos =	preg_grep ('/\.PNG$/i', $files);
							?>

							<?php foreach ($photos AS $photo): ?>

								<div class="col-xs-12 col-lg-4">
									<img class="img-responsive" src="img/photos/<?php echo $photo; ?>" />
								</div>

							<?php endforeach; ?>

						</div>

					</div>
					

				</div>
				
			</div><!--/.col-->
	
		</div><!--/.row-->
	
	</div><!--/.main-->

	<?php include('inc/foot.php'); ?>

</body>

</html>
