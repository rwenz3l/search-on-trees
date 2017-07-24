<?php
    $formatted = "";
    $output = array();
    $command = "";
    if (!empty($_POST['grep_pattern'])) {
        $case_sensitive = false;
        if (!empty($_POST['case_sensitive'])) {
            $case_sensitive = true;
        }
        $search_path = "../" . $_POST['search_path'];
        $command = "grep -r" . ($case_sensitive ? "" : "i") . "m 5000" . " " . escapeshellarg($_POST['grep_pattern']) . " " . $search_path . " | sed 's/^.*log://'";
        $result = -1;
        $return_code = -1;
        $result = exec($command, $output, $return_code);
        foreach($output as $line) {
            $grep_parts = explode(":", $line, 3); // split into three parts
            $filepath = $grep_parts[0];
            $lineno = $grep_parts[1];
            $matched_line = $grep_parts[2];

	// Formatted Output
	$formatted .= "<span class=\"path_component\"><span class=\"filename\">" . htmlspecialchars($filepath) . ":" . $lineno . "</span><br>";
        }
    }
?>
<!-- Output Start -->
<?php if (!empty($command)) { ?>
    <code>Command: <?php echo htmlspecialchars($command); ?></code><br>
    <code>Results Limited to: 5000, Found: <?php echo count($output); ?></code><br>
	----------------------------------------------------------------<br>
    <?php echo $formatted; ?>
    
<?php } ?>