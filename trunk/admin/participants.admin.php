<?php 

/**
 * Module:      participants.admin.php
 * Description: This module houses all participant (brewer) related functionality
 *              including viewing a participant list, add/edit/delete, 
 *              Also provids judging location related functions - add, edit, delete.
 *
 */
 
function date_created($uid,$date_format,$time_format,$timezone,$dbTable) {
	require(CONFIG.'config.php');
	if ($dbTable != "default") $dbTable = $dbTable; else $dbTable = $prefix."users";
	
	$result1 = mysql_query(sprintf("SHOW COLUMNS FROM %s LIKE 'userCreated'",$dbTable));
	$exists = (mysql_num_rows($result1))?TRUE:FALSE;
	
	if ($exists) {
	
		$query_user = sprintf("SELECT userCreated FROM %s WHERE id = '%s'",$dbTable,$uid);
		$user = mysql_query($query_user, $brewing) or die(mysql_error());
		$row_user = mysql_fetch_assoc($user);
		$totalRows_user = mysql_num_rows($user);
		
		if (($totalRows_user == 1) && ($row_user['userCreated'] != "")) {
			$result = getTimeZoneDateTime($timezone, strtotime($row_user['userCreated']), $date_format,  $time_format, "short", "date-time-no-gmt");
		}
		
		else $result = "&nbsp;";
	}
	else $result = "&nbsp;";
	return $result;
}

function judge_steward_availability($input) {
	$a = explode(",",$input);
	arsort($a);
	$return = "<table class='dataTableCompact'>";
	foreach ($a as $value) {
	if ($value != "") {
		$b = substr($value, 2);
		$c = substr($value, 0, 1);
			if ($c == "Y") {
			require(CONFIG.'config.php');
			require(DB.'common.db.php');
			$query_location = sprintf("SELECT * FROM %s WHERE id='%s'", $prefix."judging_locations", $b);
			$location = mysql_query($query_location, $brewing) or die(mysql_error());
			$row_location = mysql_fetch_assoc($location);
			//$return .= $query_location."<br />";
			$return .= "<tr>";
			$return .= "<td class='data'>".$row_location['judgingLocName']."</td>";
			$return .= "<td class='data'>".getTimeZoneDateTime($row_prefs['prefsTimeZone'], $row_location['judgingDate'], $row_prefs['prefsDateFormat'],  $row_prefs['prefsTimeFormat'], "short", "date-time-no-gmt")."</td>";
			$return .= "</tr>";
			}
		}
	}
	$return .= "</table>";
	return $return;
}
if ($action != "print") { 
	if (($dbTable == "default") && ($totalRows_participant_count > $row_prefs['prefsRecordLimit']))	{ 
			echo "<div class='info'>The DataTables recordset paging limit of ".$row_prefs['prefsRecordLimit']." has been surpassed. Filtering and sorting capabilites are only available for this set of ".$row_prefs['prefsRecordPaging']." participants.<br />To adjust this setting, <a href='index.php?section=admin&amp;go=preferences'>change your installation's DataTables Record Threshold</a> (under the &ldquo;Performance&rdquo; heading in preferences) to a number <em>greater</em> than the total number of participants ($totalRows_participant_count).</div>";
	}
}
?>
<h2><?php 
if ($filter == "judges") echo "Available Judges"; 
elseif ($filter == "stewards") echo "Available Stewards";
elseif ($filter == "assignJudges") echo "Assigned Judges"; 
elseif ($filter == "assignStewards") echo "Assigned Stewards"; 
elseif ($action == "add") echo "Add Participant"; 
else echo "Participants"; 
if ($dbTable != "default") echo ": ".get_suffix($dbTable); ?></h2>
<?php if ($action != "print") { ?>
<div class="adminSubNavContainer">
  	<span class="adminSubNav">
		<span class="icon"><img src="<?php echo $base_url; ?>/images/arrow_left.png" alt="Back"></span><a href="<?php echo $base_url; ?>/index.php?section=admin">Back to Admin Dashboard</a>
    </span>
  	<?php if ($action != "add") { ?>
  	<?php if ($dbTable != "default") { ?>
 	<span class="adminSubNav">
		<span class="icon"><img src="<?php echo $base_url; ?>/images/arrow_left.png" alt="Back"></span><a href="<?php echo $base_url; ?>/index.php?section=admin&amp;go=archive">Back to Archives</a>
  	</span>
	<?php } ?>
    <?php if ($dbTable == "default") { ?>
  	<span class="adminSubNav">
		<span class="icon"><img src="<?php echo $base_url; ?>/images/user_add.png"  /></span><a href="<?php echo $base_url; ?>/index.php?section=admin&amp;go=entrant&amp;action=register">Add a Participant</a>
    </span>
    <span class="adminSubNav">
		<span class="icon"><img src="<?php echo $base_url; ?>/images/page.png" /></span>
  			<div class="menuBar"><a class="menuButton" href="#" onclick="#" onmouseover="buttonMouseover(event, 'views');">View...</a></div>
  			<div id="views" class="menu" onmouseover="menuMouseover(event)">
  				<a class="menuItem" href="<?php echo $base_url; ?>/index.php?section=admin&amp;go=participants">All Participants</a>
  				<a class="menuItem" href="<?php echo $base_url; ?>/index.php?section=admin&amp;go=participants&amp;filter=judges">Available Judges</a>
  				<a class="menuItem" href="<?php echo $base_url; ?>/index.php?section=admin&amp;go=participants&amp;filter=stewards">Available Stewards</a>
        		<a class="menuItem" href="<?php echo $base_url; ?>/index.php?section=admin&amp;go=participants&amp;filter=assignJudges">Assigned Judges</a>
        		<a class="menuItem" href="<?php echo $base_url; ?>/index.php?section=admin&amp;go=participants&amp;filter=assignStewards">Assigned Stewards</a>
  			</div>
  	</span>
    <span class="adminSubNav">
		<span class="icon"><img src="<?php echo $base_url; ?>/images/printer.png" /></span>
  			<div class="menuBar"><a class="menuButton" href="#" onclick="#" onmouseover="buttonMouseover(event, 'printMenu_participants');">Print <em>This</em> List</a></div>
  			<div id="printMenu_participants" class="menu" onmouseover="menuMouseover(event)">
  				<a id="modal_window_link" class="menuItem" href="<?php echo $base_url; ?>/output/print.php?<?php echo $_SERVER['QUERY_STRING']; ?>&amp;action=print&amp;view=default&amp;psort=brewer_name">By Last Name</a>
                <?php if (($filter == "judges") || ($filter == "stewards")) { ?>
  				<a id="modal_window_link" class="menuItem" href="<?php echo $base_url; ?>/output/print.php?<?php echo $_SERVER['QUERY_STRING']; ?>&amp;action=print&amp;view=default&amp;psort=club">By Club</a>
                <?php } if (($filter == "judges") || ($filter == "assignJudges")) { ?>
                <a id="modal_window_link" class="menuItem" href="<?php echo $base_url; ?>/output/print.php?<?php echo $_SERVER['QUERY_STRING']; ?>&amp;action=print&amp;view=default&amp;psort=judge_id">By Judge ID</a>
				<a id="modal_window_link" class="menuItem" href="<?php echo $base_url; ?>/output/print.php?<?php echo $_SERVER['QUERY_STRING']; ?>&amp;action=print&amp;view=default&amp;psort=judge_rank">By Judge Rank</a>
				<?php } ?>
            </div>
  	</span>
  	<span class="adminSubNav">
		<?php if (($totalRows_participant_count > $row_prefs['prefsRecordLimit']) && ($filter == "default")) { ?>
  		<span class="icon"><img src="<?php echo $base_url; ?>/images/printer.png" /></span>
  			<div class="menuBar"><a class="menuButton" href="#" onclick="#" onmouseover="buttonMouseover(event, 'printMenu_participants_all');">Print <em>All</em></a></div>
  			<div id="printMenu_participants_all" class="menu" onmouseover="menuMouseover(event)">
  				<a id="modal_window_link" class="menuItem" href="<?php echo $base_url; ?>/output/print.php?<?php echo $_SERVER['QUERY_STRING']; ?>&amp;action=print&amp;view=all&amp;psort=brewer_name">By Last Name</a>
  				<a id="modal_window_link" class="menuItem" href="<?php echo $base_url; ?>/output/print.php?<?php echo $_SERVER['QUERY_STRING']; ?>&amp;action=print&amp;view=all&amp;psort=club">By Club</a>
            </div>
    </span>
    <span class="adminSubNav">
        <?php } if ($filter != "default") { ?>
        <span class="icon"><img src="<?php echo $base_url; ?>/images/printer.png" /></span>
  			<div class="menuBar"><a class="menuButton" href="#" onclick="#" onmouseover="buttonMouseover(event, 'printMenu_participants_all');">Print <em>All</em></a></div>
  			<div id="printMenu_participants_all" class="menu" onmouseover="menuMouseover(event)">
  				<a id="modal_window_link" class="menuItem" href="<?php echo $base_url; ?>/output/print.php?<?php echo $_SERVER['QUERY_STRING']; ?>&amp;action=print&amp;view=all&amp;psort=brewer_name">By Last Name</a>
  				<a id="modal_window_link" class="menuItem" href="<?php echo $base_url; ?>/output/print.php?<?php echo $_SERVER['QUERY_STRING']; ?>&amp;action=print&amp;view=all&amp;psort=club">By Club</a>
  				<?php if ($filter == "judges") { ?>
                <a id="modal_window_link" class="menuItem" href="<?php echo $base_url; ?>/output/print.php?<?php echo $_SERVER['QUERY_STRING']; ?>&amp;action=print&amp;view=all&amp;psort=judge_id">By Judge ID</a>
				<a id="modal_window_link" class="menuItem" href="<?php echo $base_url; ?>/output/print.php?<?php echo $_SERVER['QUERY_STRING']; ?>&amp;action=print&amp;view=all&amp;psort=judge_rank">By Judge Rank</a>
				<?php } ?>
            </div>
  			<?php } else echo "&nbsp;"; ?>
  	</span>
	<?php } // end 1.2 ?>
</div>
<div class="adminSubNavContainer">
	<?php if (($action != "add") && ($dbTable == "default")) { // 2  ?>
 	<span class="adminSubNav">
		<span class="icon"><img src="<?php echo $base_url; ?>/images/user_edit.png"  /></span><a href="<?php echo $base_url; ?>/index.php?section=admin&amp;action=assign&amp;go=judging&amp;filter=judges">Assign Judges</a>
 	</span>
    <span class="adminSubNav">
		<span class="icon"><img src="<?php echo $base_url; ?>/images/user_edit.png"  /></span><a href="<?php echo $base_url; ?>/index.php?section=admin&amp;action=assign&amp;go=judging&amp;filter=stewards">Assign Stewards</a>
 	</span>
    <span class="adminSubNav">
    	<span class="icon"><img src="<?php echo $base_url; ?>/images/user_edit.png"  /></span><a href="<?php echo $base_url; ?>/index.php?section=admin&amp;action=assign&amp;go=judging&amp;filter=staff">Assign Staff</a>
 	</span>
    <?php if ($totalRows_tables > 1) { ?>
    <span class="adminSubNav">
		<span class="icon"><img src="<?php echo $base_url; ?>/images/user_edit.png"  /></span><a href="<?php echo $base_url; ?>/index.php?section=admin&amp;action=assign&amp;go=judging_tables">Assign Judges/Stewards to Tables</a>
	</span>
	<?php }  ?>
 <?php } // end 2 ?>
</div>
<?php } 
}
if (($action == "default") || ($action == "print")) { 
if ($totalRows_participant_count > 0) { 
	if ($action != "print") { ?>
	<?php 
		if ($totalRows_participant_count > $row_prefs['prefsRecordLimit']) {
		$of = $start + $totalRows_brewer;
		echo "<div id=\"sortable_info\" class=\"dataTables_info\">Showing ".$start_display." to ".$of." of ".$totalRows_participant_count." entries</div>";
		}
	?>
	<link href="<?php echo $base_url; ?>/css/sorting.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" language="javascript">
	 $(document).ready(function() {
		$('#sortable').dataTable( {
		<?php if ($totalRows_participant_count <= $row_prefs['prefsRecordLimit']) { ?>
		"bPaginate" : true,
		"sPaginationType" : "full_numbers",
		"bLengthChange" : false,
		"iDisplayLength" : <?php echo round($row_prefs['prefsRecordPaging']); ?>,
		"sDom": 'ifrtip',
		"bStateSave" : false,
		<?php } else { ?>
		"bPaginate" : false,
		"sDom": 'rt',
		"bStateSave" : false,
		"bLengthChange" : false,
		<?php } ?>
		"aaSorting": [[0,'asc']],
		"bProcessing" : true,
		
		<?php if ($filter == "default") { ?>
		"aoColumns": [
				null,
				null,
				{ "asSorting": [  ] },
				null,
				{ "asSorting": [  ] },
				{ "asSorting": [  ] },
				null,
				null<?php if ($dbTable == "default") { ?>, 
				{ "asSorting": [  ] }
				<?php } ?>
			]
		<?php } ?>
		
		<?php if ($filter == "judges") { ?>
		"aoColumns": [
				null,
				null,
				{ "asSorting": [  ] },
				null,
				null,
				null,
				null,
				{ "asSorting": [  ] }
			]
		<?php } ?>
		
		
		<?php if ($filter == "stewards") { ?>
		"aoColumns": [
				null,
				null,
				{ "asSorting": [  ] },
				null,
				null,
				{ "asSorting": [  ] }
			]
		<?php } ?>
		
		
		<?php if (($filter == "assignJudges") || ($filter == "assignStewards")) { ?>
		"aoColumns": [
				null,
				null,
				{ "asSorting": [  ] },
				null,
				null,
				{ "asSorting": [  ] }
			]
		<?php } ?>
		} );
	} );
	</script>
   <?php } ?>
   <?php if ($action == "print") { ?>
   <script type="text/javascript" language="javascript">
	 $(document).ready(function() {
		$('#sortable').dataTable( {
			"bPaginate" : false,
			"sDom": 'rt',
			"bStateSave" : false,
			"bLengthChange" : false,
			<?php if ($psort == "judge_rank") { ?>"aaSorting": [[5,'asc']],<?php } ?>
			<?php if ($psort == "judge_id") { ?>"aaSorting": [[4,'asc']],<?php } ?>
			<?php if ($psort == "club") { ?>"aaSorting": [[3,'asc']],<?php } ?>
			<?php if ($psort == "default") { ?>"aaSorting": [[0,'asc']],<?php } ?>
			"bProcessing" : false,
			
		<?php if ($filter == "default") { ?>
			"aoColumns": [
				null,
				null,
				{ "asSorting": [  ] },
				null,
				null,
				null,
				null,
				null
			]
		<?php } ?>
		
		<?php if (($filter == "judges") || ($filter == "assignJudges")) { ?>
		"aoColumns": [
				null,
				null,
				{ "asSorting": [  ] },
				null,
				null,
				null,
				null
			]
		<?php } ?>
		
		
		<?php if ($filter == "stewards") { ?>
		"aoColumns": [
				null,
				null,
				{ "asSorting": [  ] },
				null,
				null

			]
		<?php } ?>
		
		
		<?php if ($filter == "assignStewards") { ?>
		"aoColumns": [
				null,
				null,
				{ "asSorting": [  ] },
				null,
				null
			]
		<?php } ?>
			} );
		} );
	</script>
   <?php } ?>
<table class="dataTable" id="sortable">
<thead>
  <tr>
    <th class="dataHeading bdr1B">Last</th>
    <th class="dataHeading bdr1B">First</th>
    <th class="dataHeading bdr1B">Info</th>
    <th class="dataHeading bdr1B"><?php if (($totalRows_judging > 0) && (($filter == "judges") || ($filter == "assignJudges") || ($filter == "stewards") || ($filter == "assignStewards"))) echo "Location(s) Available"; else echo "Club"; ?></th>
  <?php if ($filter == "default") { ?>
    <th class="dataHeading bdr1B">Steward?</th>
    <th class="dataHeading bdr1B">Judge?</th>
    <th class="dataHeading bdr1B">Assigned As</th>
  <?php } if ($filter != "default") { ?>
    <?php if (($filter == "judges") || ($filter == "assignJudges")) { ?>
    <th class="dataHeading bdr1B">ID</th>
    <th class="dataHeading bdr1B">Rank</th>
    <?php } }?>
    <th class="dataHeading bdr1B">Date Created</th>
  <?php if (($action != "print") && ($dbTable == "default")) { ?>
    <th class="dataHeading bdr1B">Actions</th>
  <?php } ?>
  </tr>
</thead>
<tbody>
<?php do { 
    if ($row_brewer['brewerAssignment'] == "J") $query_judging2 = sprintf("SELECT * FROM $judging_locations_db_table WHERE id='%s'", $row_brewer['brewerJudgeAssignedLocation']);
	if ($row_brewer['brewerAssignment'] == "S") $query_judging2 = sprintf("SELECT * FROM $judging_locations_db_table WHERE id='%s'", $row_brewer['brewerStewardAssignedLocation']);
	$judging2 = mysql_query($query_judging2, $brewing) or die(mysql_error());
	$row_judging2 = mysql_fetch_assoc($judging2);
	
	$query_user1 = sprintf("SELECT id,userLevel FROM $users_db_table WHERE user_name = '%s'", $row_brewer['brewerEmail']);
	$user1 = mysql_query($query_user1, $brewing) or die(mysql_error());
	$row_user1 = mysql_fetch_assoc($user1);
	
	if (($filter == "judges") || ($filter == "assignJudges")) $locations = $row_brewer['brewerJudgeLocation'];
	if (($filter == "stewards") || ($filter == "assignStewards")) $locations = $row_brewer['brewerStewardLocation'];
?>
  <tr>
    <td class="dataList<?php if ($action == "print") echo " bdr1B"; ?>"><?php echo $row_brewer['brewerLastName']; ?></td>
    <td class="dataList<?php if ($action == "print") echo " bdr1B"; ?>"><?php echo $row_brewer['brewerFirstName']; ?></td>
    <td class="dataList<?php if ($action == "print") echo " bdr1B"; ?>"><a href="mailto:<?php echo $row_brewer['brewerEmail']; ?>?Subject=<?php if ($filter == "judges") echo "Judging at ".$row_contest_info['contestName']; elseif ($filter == "stewards") echo "Stewarding at ".$row_contest_info['contestName']; else echo $row_contest_info['contestName'];  ?>"><?php echo $row_brewer['brewerEmail']; ?></a><br /><?php if ($row_brewer['brewerPhone1'] != "") echo $row_brewer['brewerPhone1']." (1)<br>";  if ($row_brewer['brewerPhone2'] != "") echo $row_brewer['brewerPhone2']." (2)"; ?></td>
    <td class="dataList<?php if ($action == "print") echo " bdr1B"; ?>"><?php if (($totalRows_judging > 0) && (($filter == "judges") || ($filter == "assignJudges") || ($filter == "stewards") || ($filter == "assignStewards"))) echo judge_steward_availability($locations); else echo $row_brewer['brewerClubs']; ?></td>
  	<?php if ($filter == "default") { ?>
    	<td class="dataList<?php if ($action == "print") echo " bdr1B"; ?>"><?php if ($row_brewer['brewerSteward'] == "Y") { if ($action == "print")echo "X"; else echo "<img src='".$base_url."/images/tick.png'>"; } if ($row_brewer['brewerSteward'] == "N") {  if ($action == "print") echo ""; else echo "<img src='".$base_url."/images/cross.png'>"; } ?></td>
    	<td class="dataList<?php if ($action == "print") echo " bdr1B"; ?>"><?php if ($row_brewer['brewerJudge'] == "Y") { if ($action == "print")echo "X"; else echo "<img src='".$base_url."/images/tick.png'>"; } if ($row_brewer['brewerJudge'] == "N") {  if ($action == "print") echo ""; else echo "<img src='".$base_url."/images/cross.png'>"; } ?></td>
    	<td class="dataList<?php if ($action == "print") echo " bdr1B"; ?>"><?php echo brewer_assignment($row_brewer['brewerAssignment'], "1"); ?></td>
  	<?php } ?>
		
		</td>
	<?php if ($filter != "default") { ?>
    	<?php if (($filter == "judges") || ($filter == "assignJudges")) { ?>
    	<td class="dataList<?php if ($action == "print") echo " bdr1B"; ?>"><?php echo $row_brewer['brewerJudgeID']; ?></td>
    	<td class="dataList<?php if ($action == "print") echo " bdr1B"; ?>"><?php echo bjcp_rank($row_brewer['brewerJudgeRank'],1); if ($row_brewer['brewerJudgeMead'] == "Y") { echo "<br />"; if ($action != "print") echo "<span class='icon'><img src='".$base_url."/images/star.png' alt='' title='Certified Mead Judge'></span>"; echo "Certified Mead Judge"; } ?></td>
	  	<?php } 
	}?>
    <td class="dataList<?php if ($action == "print") echo " bdr1B"; ?>"><?php echo date_created($row_brewer['uid'],$row_prefs['prefsDateFormat'],$row_prefs['prefsTimeFormat'],$row_prefs['prefsTimeZone'],$dbTable); ?></td>
 <?php  if (($action != "print") && ($dbTable == "default")) { ?>
    <td class="dataList" nowrap="nowrap"><span class="icon"><a href="<?php echo $base_url; ?>/index.php?section=brew&amp;go=entries&amp;filter=<?php echo $row_brewer['uid']; ?>&amp;action=add"><img src="<?php echo $base_url; ?>/images/book_add.png"  border="0" alt="Add an entry for <?php echo $row_brewer['brewerLastName'].", ".$row_brewer['brewerFirstName']; ?>" title="Add an entry for <?php echo $row_brewer['brewerLastName'].", ".$row_brewer['brewerFirstName']; ?>"></a></span><span class="icon"><a href="<?php echo $base_url; ?>/index.php?section=brewer&amp;go=admin&amp;filter=<?php echo $row_brewer['uid']; ?>&amp;action=edit&amp;id=<?php echo $row_brewer['id']; ?>"><img src="<?php echo $base_url; ?>/images/pencil.png"  border="0" alt="Edit <?php echo $row_brewer['brewerLastName'].", ".$row_brewer['brewerFirstName']; ?>" title="Edit <?php echo $row_brewer['brewerLastName'].", ".$row_brewer['brewerFirstName']; ?>"></a></span><?php if ($row_user['userLevel'] == "0") { ?><span class="icon"><a href="<?php echo $base_url; ?>/index.php?section=admin&amp;go=make_admin&amp;username=<?php echo urlencode($row_brewer['brewerEmail']);?>"><img src="<?php echo $base_url; ?>/images/<?php if ($row_user1['userLevel'] <= "1") echo "lock_open.png"; else echo "lock_edit.png"; ?>" border="0" alt="Change <?php echo $row_brewer['brewerLastName'].", ".$row_brewer['brewerFirstName']; ?>'s User Level" title="Change <?php echo $row_brewer['brewerLastName'].", ".$row_brewer['brewerFirstName']; ?>'s User Level"></a></span><?php } ?><?php if (($row_brewer['brewerAssignment'] == "J")) { ?><span class="icon"><a href="<?php echo $base_url; ?>/output/labels.php?section=admin&amp;go=participants&amp;action=judging_labels&amp;id=<?php echo $row_brewer['id']; ?>"><img src="<?php echo $base_url; ?>/images/page_white_acrobat.png"  border="0" alt="Download judging labels for <?php echo $row_brewer['brewerLastName'].", ".$row_brewer['brewerFirstName']; ?>" title="Download judging labels for <?php echo $row_brewer['brewerLastName'].", ".$row_brewer['brewerFirstName']; ?>"></a></span><?php } ?><span class="icon"><?php if ($row_brewer['brewerEmail'] == $_SESSION['loginUsername']) echo "&nbsp;"; else { ?><a href="javascript:DelWithCon('includes/process.inc.php?section=<?php echo $section; ?>&amp;go=<?php echo $go; ?>&amp;dbTable=<?php echo $brewer_db_table; ?>&amp;action=delete&amp;uid=<?php echo $row_brewer['uid'];?>','id',<?php echo $row_brewer['id']; ?>,'Are you sure you want to delete the participant <?php echo $row_brewer['brewerLastName'].", ".$row_brewer['brewerFirstName']; ?>?\nALL entries for this participant WILL BE DELETED as well.\nThis cannot be undone.');"><img src="<?php echo $base_url; ?>/images/bin_closed.png"  border="0" alt="Delete <?php echo $row_brewer['brewerLastName'].", ".$row_brewer['brewerFirstName']; ?>" title="Delete <?php echo $row_brewer['brewerLastName'].", ".$row_brewer['brewerFirstName']; ?>"></a><?php } ?></span>
    </td> 
  <?php } ?> 
  </tr>
<?php } while ($row_brewer = mysql_fetch_assoc($brewer)); ?>
</tbody>
</table>
<?php if ($action != "print") {  
	if ($totalRows_participant_count >= $row_prefs['prefsRecordLimit']) { 
	if (($filter == "default") && ($bid == "default")) $total_paginate = $totalRows_participant_count;
	else $total_paginate = $totalRows_brewer;
	paginate($display, $pg, $total_paginate);
	}
}
?>
<?php } if ($totalRows_brewer == 0) { ?>

<?php 
if ($filter == "default") echo "<div class='error'>There are no participants yet.</div>"; 
if (($filter == "judges") || ($filter == "assignJudges")) echo "<div class='error'>There are no judges available yet.</div>"; 
if (($filter == "stewards") || ($filter == "assignStewards"))  echo "<div class='error'>There are no stewards available yet.</div>"; 
}
} // end if ($action == "default")

if ($action == "add")  { 
	if ($filter == "default") { ?>
<script type="text/javascript" src="<?php echo $base_url; ?>/js_includes/email_check.js"></script>
<script type="text/javascript" src="<?php echo $base_url; ?>/js_includes/username_check.js" ></script>
<script type="text/javascript">
pic1 = new Image(16, 16); 
pic1.src = "<?php echo $base_url; ?>/images/loader.gif";

$(document).ready(function(){

$("#user_name").change(function() { 

var usr = $("#user_name").val();

if(usr.length >= 3)
{
$("#status").html('<span class="icon"><img src="<?php echo $base_url; ?>/images/loader.gif" align="absmiddle"><span>Checking availability...');

    $.ajax({  
    type: "POST",  
    url: "includes/username.inc.php",  
    data: "user_name="+ usr,  
    success: function(msg){  
   
   $("#status").ajaxComplete(function(event, request, settings){ 

	if(msg == 'OK')
	{ 
        $("#user_name").removeClass('object_error'); // if necessary
		$("#user_name").addClass("object_ok");
		$(this).html('<span class="icon"><img src="<?php echo $base_url; ?>/images/tick.png" align="absmiddle"></span><span style="color:green;">Email address not in use.</span>');
	}  
	else  
	{  
		$("#user_name").removeClass('object_ok'); // if necessary
		$("#user_name").addClass("object_error");
		$(this).html(msg);
	}  
   
   });

 } 
   
  }); 

}
else
	{
	$("#status").html('<font color="red">The username should have at least <strong>3</strong> characters.</font>');
	$("#user_name").removeClass('object_ok'); // if necessary
	$("#user_name").addClass("object_error");
	}

});

});

//-->
</script>
<form action="<?php echo $base_url; ?>/includes/process.inc.php?action=add&amp;dbTable=<?php echo $users_db_table; ?>&amp;section=<?php echo $section; ?>&amp;go=<?php echo $go; ?>" method="POST" name="form1" id="form1" onSubmit="return CheckRequiredFields()">
<table>
	<tr>
    	<td class="dataLabel">Email Address:</td>
    	<td class="data"><input name="user_name" id="user_name" type="text" class="submit" size="40" onkeyup="twitter.updateUrl(this.value)" onchange="AjaxFunction(this.value);" value="<?php if ($msg == "4") echo $_COOKIE['user_name']; ?>"><div id="msg_email">Email Format:</div><div id="status"></div></td>
        <td class="data" id="inf_email"><span class="required">Required</span></td>
  	</tr>
  	<tr>
    	<td class="dataLabel">Password:</td>
    	<td class="data"><input name="password" id="password" type="password" class="submit" size="25"></td>
        <td class="data"><span class="required">Required</span></td>
  	</tr>

  	<tr>
    	<td class="dataLabel">&nbsp;</td>
    	<td class="data"><input type="submit" class="button" value="Register"></td> 
        <td class="data">&nbsp;</td>
  	</tr>
</table>
<input type="hidden" name="userLevel" value="2" />
<input type="hidden" name="relocate" value="<?php echo relocate($_SERVER['HTTP_REFERER'],"default",$msg,$id); ?>">
</form>
</div>
<?php } 
if ($filter == "info") { 
if (($action == "add") || (($action == "edit") && (($_SESSION["loginUsername"] == $row_brewer['brewerEmail'])) || ($row_user['userLevel'] <= "1")))  { ?>
<form action="<?php echo $base_url; ?>/includes/process.inc.php?section=<?php echo "admin&amp;go=".$go."&amp;filter=".$filter; ?>&amp;action=<?php echo $action; ?>&amp;dbTable=<?php echo $brewer_db_table; ?>" method="POST" name="form1" id="form1" onSubmit="return CheckRequiredFields()">
<table class="dataTable">
<tr>
      <td class="dataLabel" width="5%">Email:</td>
      <td class="data" width="20%"><?php echo $username; ?></td>
      <td class="data">&nbsp;</td>
</tr>
<tr>
      <td class="dataLabel" width="5%">First Name:</td>
      <td class="data" width="20%"><input type="text" id="brewerFirstName" name="brewerFirstName" value="<?php if ($action == "edit") echo $row_brewer['brewerFirstName']; ?>" size="32" maxlength="20"></td>
      <td class="data"><span class="required">Required</span></td>
</tr>
<tr>
      <td class="dataLabel">Last Name:</td>
      <td class="data"><input type="text" name="brewerLastName" value="<?php if ($action == "edit") echo $row_brewer['brewerLastName']; ?>" size="32"></td>
      <td class="data"><span class="required">Required</span></td>
</tr>
<tr>
      <td class="dataLabel">Street Address:</td>
      <td class="data"><input type="text" name="brewerAddress" value="<?php if ($action == "edit") echo $row_brewer['brewerAddress']; ?>" size="32"></td>
      <td class="data"><span class="required">Required</span></td>
</tr>
<tr>
      <td class="dataLabel">City:</td>
      <td class="data"><input type="text" name="brewerCity" value="<?php if ($action == "edit") echo $row_brewer['brewerCity']; ?>" size="32"></td>
      <td class="data"><span class="required">Required</span></td>
</tr>
<tr>
      <td class="dataLabel">State/Country:</td>
      <td class="data"><input type="text" name="brewerState" value="<?php if ($action == "edit") echo $row_brewer['brewerState']; ?>" size="32"></td>
      <td class="data"><span class="required">Required</span></td>
</tr>
<tr>
      <td class="dataLabel">Zip/Postal Code:</td>
      <td class="data"><input type="text" name="brewerZip" value="<?php if ($action == "edit") echo $row_brewer['brewerZip']; ?>" size="32"></td>
      <td class="data"><span class="required">Required</span></td>
</tr>
<tr>
      <td class="dataLabel">Phone 1:</td>
      <td class="data"><input type="text" name="brewerPhone1" value="<?php if ($action == "edit") echo $row_brewer['brewerPhone1']; ?>" size="32"></td>
      <td class="data"><span class="required">Required</span></td>
</tr>
<tr>
      <td class="dataLabel">Phone 2:</td>
      <td class="data"><input type="text" name="brewerPhone2" value="<?php if ($action == "edit") echo $row_brewer['brewerPhone2']; ?>" size="32"></td>
      <td class="data">&nbsp;</td>
</tr>
<tr>
      <td class="dataLabel">Club Name (if appropriate):</td>
      <td class="data"><input type="text" name="brewerClubs" value="<?php if ($action == "edit") echo $row_brewer['brewerClubs']; ?>" size="32" maxlength="200"></td>
      <td class="data">&nbsp;</td>
</tr>
<tr>
	  <td>&nbsp;</td>
      <td colspan="2" class="data"><input name="submit" type="submit" class="button" value="Submit Brewer Information" /></td>
    </tr>
</table>
<input name="brewerEmail" type="hidden" value="<?php echo $username; ?>" />
<input name="uid" type="hidden" value="<?php echo $row_user_level['id']; ?>" />
<input name="brewerJudge" type="hidden" value="N" />
<input name="brewerSteward" type="hidden" value="N" />
</form>
<?php 
	  }  
   }
} 
?>