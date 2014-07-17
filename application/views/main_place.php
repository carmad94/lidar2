<!-- Small boxes (Stat box) -->

<?php
	$count = 1;
	foreach($topics as $topic)
	{
		if($count == 1)
		{
			echo "<div class='row'>";
		}
		$segment = preg_replace('/\s+/', '', $topic['name']);
		$segment = strtolower($segment);
		echo "
				<div class='col-lg-3 col-xs-6'>
        		<!-- small box -->
     				 <div class='small-box bg-yellow'>
      				    <div class='inner'>
              				<h3>".
                  				$topic['count']
              				."</h3>
             				 <p>".
              				    $topic['name']
              				."</p>
						</div>
          				<div class='icon'>
							<i class='ion ion-".$topic['ion']."'></i>
          				</div>
						<a href='".site_url("place/".$segment)."' class='small-box-footer'>
              				More info <i class='fa fa-arrow-circle-right'></i>
         				</a>
      				</div>
  				</div>";

		if($count == 4)
		{
			echo "</div>";
			$count = 0;
		}
		$count++;
	}
?>
