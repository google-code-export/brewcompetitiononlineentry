<?php if ($action != "print") { ?>
<p><span class="icon"><img src="images/printer.png"  border="0" alt="Print" /></span><a class="data thickbox" href="print.php?section=<?php echo $section; ?>&amp;action=print&amp;KeepThis=true&amp;TB_iframe=true&amp;height=450&amp;width=750" title="Print Rules">Print This Page</a></p>
<?php } ?>
<?php if (($row_contest_info['contestLogo'] != "") && (file_exists('user_images/'.$row_contest_info['contestLogo']))) { // display competition's logo if name present in DB and in the correct folder on the server ?>
<img src="user_images/<?php echo $row_contest_info['contestLogo']; ?>" width="<?php echo $row_prefs['prefsCompLogoSize']; ?>" align="right" hspace="3" vspace="3" alt="Competition Logo"/>
<?php } ?>
<?php echo $row_contest_info['contestRules']; ?>