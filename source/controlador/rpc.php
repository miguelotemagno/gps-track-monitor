<?php

	$action = $_POST['action'];
	switch($action) {
	
	case 'startCalendar':
		$month = $_POST['month'];
		$year = $_POST['year'];
		
		if(($month == 0) || ($year == 0)) {
			$thisDate = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
		} else {
			$thisDate = mktime(0, 0, 0, $month, 1, $year);
		}
		
		echo '<div style="margin-bottom: 3px;">
					<form name="changeCalendarDate">
						<select id="ccMonth" onChange="startCalendar($F(\'ccMonth\'), $F(\'ccYear\'))">';
						
						for($i=1; $i<=12; $i++)
						{
							$monthMaker = mktime(0, 0, 0, $i, 1, 2009);
							if($month > 0) {
								if($month == $i) {
									$sel = 'selected';
								} else {
									$sel = '';
								}
							} else {
								if(date("m", $thisDate) == $i) {
									$sel = 'selected';
								} else {
									$sel = '';
								}
							}

							echo '<option value="'. $i .'" '. $sel .'>'. date("F", $monthMaker) .'</option>';
						}
						
				echo '</select>
						&nbsp;
						<select id="ccYear" onChange="startCalendar($F(\'ccMonth\'), $F(\'ccYear\'))">';
						
						$yStart = 2009;
						$yEnd = ($yStart + 4);
						for($i=$yStart; $i<$yEnd; $i++)
						{
							if($year > 0) {
								if($year == $i) {
									$sel = 'selected';
								} else {
									$sel = '';
								}
							} else {
								if(date("Y", $thisDate) == $i) {
									$sel = 'selected';
								} else {
									$sel = '';
								}
							}
							echo '<option value="'. $i .'" '. $sel .'>'. $i .'</option>';
						}
						
				echo '</select>
					</form>
				</div>';
		
		// Display the week days.
		echo '<div class="calendarFloat" style="text-align: center; background-color: #f0f2ff;"><span style="position: relative; top: 4px;">Lun</span></div>
				<div class="calendarFloat" style="text-align: center; background-color: #f0f2ff;"><span style="position: relative; top: 4px;">Mar</span></div>
				<div class="calendarFloat" style="text-align: center; background-color: #f0f2ff;"><span style="position: relative; top: 4px;">Mier</span></div>
				<div class="calendarFloat" style="text-align: center; background-color: #f0f2ff;"><span style="position: relative; top: 4px;">Juev</span></div>
				<div class="calendarFloat" style="text-align: center; background-color: #f0f2ff;"><span style="position: relative; top: 4px;">Vier</span></div>
				<div class="calendarFloat" style="text-align: center; background-color: #CCC;"><span style="position: relative; top: 4px;">Sab</span></div>
				<div class="calendarFloat" style="text-align: center; background-color: #CCC;"><span style="position: relative; top: 4px;">Dom</span></div>';
				
		// Show the calendar.
		for($i=0; $i<date("t", $thisDate); $i++)
		{
			$thisDay = ($i + 1);
			if(($month == 0) || ($year == 0)) {
				$finalDate = mktime(0, 0, 0, date("m"), $thisDay, date("Y"));
				$today = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
				$fdf = mktime(0, 0, 0, date("m"), 1, date("Y"));
				$month = date("m");
				$year = date("Y");
			} else {
				$finalDate = mktime(0, 0, 0, $month, $thisDay, $year);
				$fdf = mktime(0, 0, 0, $month, 1, $year);
			}
			
			
			// Skip some cells to take into account for the weekdays.
			if($i == 0) {
				$firstDay = date("w", $fdf);
				$skip = ($firstDay - 1);
				if($skip < 0) { $skip = 6; }
				
				for($s=0; $s<$skip; $s++)
				{
					echo '<div class="calendarFloat" style="border: 1px solid #FFF;">&nbsp;</div>';
				}
			}
							
			// Make the weekends a darker colour.
			if((date("w", $finalDate) == 0) || (date("w", $finalDate) == 6)) {
				$bgColor = '#CCC';
			} else {
				$bgColor = '#f0f2ff';
			}
			
			// <span style="position: relative; top: '. $tTop .'; left: 1px;">'. $thisDay .'</span>
			
			// Display the day.
			echo '<div class="calendarFloat" id="calendarDay_'. $thisDay .'" style="background-color: '. $bgColor .'; cursor: pointer;" 
									onMouseOver="highlightCalendarCell(\'calendarDay_'. $thisDay .'\')"
									onMouseOut="resetCalendarCell(\'calendarDay_'. $thisDay .'\')">
						<span style="position: relative; top: '. $tTop .'; left: 1px;">'. $thisDay .'</span>
					</div>';
		}
		break;
		
		default:
		
			echo 'Whoops.';
			break;
	}

?>