
	<tr>
      <td width="10%" class="dataLabel">BJCP Judge ID:</td>
      <td colspan="2" class="data"><input name="brewerJudgeID" id="brewerJudgeID" type="text" size="10" value="<?php if ($action == "edit") echo $row_brewer['brewerJudgeID']; ?>" /></td>
	</tr>
	<tr>
      <td width="10%" class="dataLabel">Mead Judge Rank/Endorsement:</td>
      <td width="15%" class="data">Have you taken <strong>and passed</strong> the BJCP Mead Exam?</td>
      <td class="data">
      <input type="radio" name="brewerJudgeMead" value="Y" id="brewerJudgeMead_0"  <?php if (($action == "edit") && ($row_brewer['brewerJudgeMead'] == "Y")) echo "CHECKED"; ?> /> Yes<br /><input type="radio" name="brewerJudgeMead" value="N" id="brewerJudgeMead_1" <?php if (($action == "add") && ($go == "judge")) echo "CHECKED";  if (($action == "add") && ($go == "default")) echo "CHECKED"; if (($action == "edit") && ($row_brewer['brewerJudgeMead'] == "N")) echo "CHECKED"; elseif (($section == "register") && ($go == "judge")) echo "CHECKED"; ?>/> No</td>
    </tr>
    <tr>
      <td width="10%" class="dataLabel">Judge Rank:</td>
      <td class="data"><select name="brewerJudgeRank">
        <option value="Novice" <?php if (($action == "edit") && ($row_brewer['brewerJudgeRank'] == "Novice")) echo "SELECTED"; ?>>Non-BJCP - Novice</option>
        <option value="Professional Brewer" <?php if (($action == "edit") && ($row_brewer['brewerJudgeRank'] == "Professional Brewer")) echo "SELECTED"; ?>>Non-BJCP - Professional Brewer</option>
        <option value="Apprentice" <?php if (($action == "edit") && ($row_brewer['brewerJudgeRank'] == "Apprentice")) echo "SELECTED"; ?>>BJCP - Apprentice</option>
        <option value="Provisional" <?php if (($action == "edit") && ($row_brewer['brewerJudgeRank'] == "Provisional")) echo "SELECTED"; ?>>BJCP - Provisional</option>
        <option value="Recognized" <?php if (($action == "edit") && ($row_brewer['brewerJudgeRank'] == "Recognized")) echo "SELECTED"; ?>>BJCP - Recognized</option>
        <option value="Certified" <?php if (($action == "edit") && ($row_brewer['brewerJudgeRank'] == "Certified")) echo "SELECTED"; ?>>BJCP - Certified</option>
        <option value="National" <?php if (($action == "edit") && ($row_brewer['brewerJudgeRank'] == "National")) echo "SELECTED"; ?>>BJCP - National</option>
        <option value="Master" <?php if (($action == "edit") && ($row_brewer['brewerJudgeRank'] == "Master")) echo "SELECTED"; ?>>BJCP - Master</option>
        <option value="Grand Master" <?php if (($action == "edit") && ($row_brewer['brewerJudgeRank'] == "Grand Master")) echo "SELECTED"; ?>>BJCP - Grand Master</option>
        <option value="Honorary Master" <?php if (($action == "edit") && ($row_brewer['brewerJudgeRank'] == "Honorary Master")) echo "SELECTED"; ?>>BJCP - Honorary Master</option>
        <option value="Honorary Grand Master" <?php if (($action == "edit") && ($row_brewer['brewerJudgeRank'] == "Honorary Grand Master")) echo "SELECTED"; ?>>BJCP - Honorary Grand Master</option>
      </select>
      </td>
      <td class="data">&nbsp;</td> 
	</tr>
    <tr>
    	<td colspan="3">
        <ul>
          <li>The <em>Novice</em> rank is for those who haven't taken the BJCP Beer Judge Entrance Exam, and are <em>not</em> a professional brewer.</li>
          <li>The <em>Apprentice</em> rank is for those who have taken the BJCP Legacy Beer Exam, but did not pass one or more of the sections. This rank will be phased out in 2014.</li>
          <li>The <em>Provisional</em> rank is for those have taken the BJCP Beer Judge Entrance Exam, have passed, but have not yet taken the BJCP Beer Judging Exam.</li>
      	</ul>
        </td>
    </tr>
	<tr>
      <td width="10%" class="dataLabel">Preferred:</td>
      <td class="data" colspan="2">
      	<table class="dataTableCompact">
        	<tr>
            	<td colspan="3">Check all styles that you <em>prefer</em> to judge.<p><span class="required"><strong>For preferences ONLY.</strong> Leaving a style unchecked indicates that you are OK to judge it &ndash; there's no need to check all that your available to judge.</span></p></td>
            </tr>
        	<?php do { 	?>
            <tr>
            	<td width="1%"><input name="brewerJudgeLikes[]" type="checkbox" value="<?php echo $row_styles['id']; ?>" <?php $a = explode(",", $row_brewer['brewerJudgeLikes']); $b = $row_styles['id']; foreach ($a as $value) { if ($value == $b) echo "CHECKED"; } ?>></td>
                <td width="1%"><?php echo ltrim($row_styles['brewStyleGroup'], "0").$row_styles['brewStyleNum'].":"; ?></td>
                <td><?php echo $row_styles['brewStyle']; ?></td>
            </tr>
            <?php } while ($row_styles = mysql_fetch_assoc($styles)); ?>
        </table>
      </td>
	</tr>
	<tr>
      <td width="10%" class="dataLabel">Not Preferred:</td> 
      <td class="data" colspan="2">
      	<table class="dataTableCompact">
            <tr>
            	<td colspan="3">Check all styles that you <em>do not wish</em> to judge.<p><span class="required">There is no need to mark those styles for which you have entries; the system will not allow you to be assigned to any table  where you have entries.</span></p></td>
            </tr>
        	<?php do { ?>
            <tr>
            	<td width="1%"><input name="brewerJudgeDislikes[]" type="checkbox" value="<?php echo $row_styles2['id']; ?>" <?php $a = explode(",", $row_brewer['brewerJudgeDislikes']); $b = $row_styles2['id']; foreach ($a as $value) { if ($value == $b) echo "CHECKED"; } ?>></td>
                <td width="1%"><?php echo ltrim($row_styles2['brewStyleGroup'], "0").$row_styles2['brewStyleNum'].":"; ?></td>
                <td><?php echo $row_styles2['brewStyle']; ?></td>
            </tr>
            <?php } while ($row_styles2 = mysql_fetch_assoc($styles2)); ?>
        </table>
      </td>
	</tr>