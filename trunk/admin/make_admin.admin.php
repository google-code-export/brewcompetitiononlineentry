<form action="includes/process.inc.php?section=<?php echo $section; ?>&amp;action=edit&amp;dbTable=users&amp;go=make_admin" name="form1" method="post">
<div class="error">Grant users admin access with caution. Admin users are able to add, edit, and delete any information in the database.</div>
<table>
<tr>
  <td class="dataList" nowrap="nowrap"><span class="icon"><img src="images/arrow_left.png" alt="Back"></span><a class="data" href="index.php?section=admin">Back to Admin</a></td>
  <td class="data">&nbsp;</td>
</tr>
<tr>
  <td class="dataHeading">Update User Level For:</td>
  <td class="data"><?php echo $row_brewer['brewerFirstName']." ".$row_brewer['brewerLastName']; ?></td>
</tr>
<tr>
  <td class="dataHeading">User Level:</td>
  <td class="data">
  <select name="userLevel">
  <option value="2" <?php if ($row_user_level['userLevel'] == "2") echo "SELECTED"; ?>>Participant</option>
  <option value="1" <?php if ($row_user_level['userLevel'] == "1") echo "SELECTED"; ?>>Admin</option>
  </select>  
  </td>
<tr>
  <td>&nbsp;</td>
  <td class="data"><input name="Submit" type="submit" class="button" value="Submit"></td>
</table>
<input type="hidden" name="user_name" value="<?php echo $username; ?>">
</form>
