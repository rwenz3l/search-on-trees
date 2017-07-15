<?php
    $formatted = "";
    $output = array();
    $command = "";
    if (!empty($_POST['grep_pattern'])) {
        $case_sensitive = false;
        if (!empty($_POST['case_sensitive'])) {
            $case_sensitive = true;
        }
        $search_path = $_POST['search_path'];
        $command = "grep -r" . ($case_sensitive ? "" : "i") . "m 1000" . " " . escapeshellarg($_POST['grep_pattern']) . " " . $search_path . "";
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

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8">
        <title>XSearch</title>
        <style type="text/css" media="screen">
			#flex_parent {
			  display: flex;
			}
			#flex_left {
			  width: 220px;
			}
			#flex_right {
			  flex: 1;
			  /* Grow to rest of container */
			}
	        .filename {
	            font-family: Helvetica;
	            font-size: 9pt;
	        }
			#search {
				width: 700px;
				margin: 0 auto;
			}
			#form_alt_color {
				background-color: #FFF;
			}
			/* Basic Grey */
			.basic-grey {
			    margin-left:auto;
			    margin-right:auto;
			    background: #F7F7F7;
			    padding: 25px 15px 25px 10px;
			    font: 12px Georgia, "Times New Roman", Times, serif;
			    color: #888;
			    text-shadow: 1px 1px 1px #FFF;
			    border:1px solid #E4E4E4;
			}
			.basic-grey h1 {
			    font-size: 25px;
			    padding: 0px 0px 10px 40px;
			    display: block;
			    border-bottom:1px solid #E4E4E4;
			    margin: -10px -15px 30px -10px;;
			    color: #888;
			}
			.basic-grey h1>span {
			    display: block;
			    font-size: 11px;
			}
			.basic-grey label {
			    display: block;

			}
			.basic-grey input[type="text"], .basic-grey input[type="email"], .basic-grey textarea, .basic-grey select {
			    border: 1px solid #DADADA;
			    color: #888;
			    height: 30px;
			    margin-bottom: 16px;
			    margin-right: 6px;
			    margin-top: 2px;
			    outline: 0 none;
			    padding: 3px 3px 3px 5px;
			    width: 70%;
			    font-size: 12px;
			    line-height:15px;
			    box-shadow: inset 0px 1px 4px #ECECEC;
			    -moz-box-shadow: inset 0px 1px 4px #ECECEC;
			    -webkit-box-shadow: inset 0px 1px 4px #ECECEC;
			}
			.basic-grey input[type=submit] {
				padding:5px 15px;
				background:#ccc;
				border:0 none;
			    cursor:pointer;
			    -webkit-border-radius: 5px;
			}
		
			.basic-grey textarea{
			    padding: 5px 3px 3px 5px;
			}
			.basic-grey select {
			    background: #FFF no-repeat right;
			    background: #FFF no-repeat right);
			    appearance:none;
			    -webkit-appearance:none; 
			    -moz-appearance: none;
			    text-indent: 0.01px;
			    text-overflow: '';
			    width: 20%;
			    height: 35px;
			    line-height: 25px;
			}
			.basic-grey textarea{
			    height:100px;
			}
			.basic-grey .submit {
			    background: #E27575;
			    border: none;
			    padding: 10px 25px 10px 25px;
			    color: #FFF;
			    box-shadow: 1px 1px 5px #B6B6B6;
			    border-radius: 3px;
			    text-shadow: 1px 1px 1px #9E3F3F;
			    cursor: pointer;
			}
			.basic-grey .button:hover {
			    background: #CF7A7A
			}
        </style>
    </head>
    <body id="" onload="">
	<!-- Page Start -->
	<div class="basic-grey">
		<!-- Search Form Start -->
		<div id="search">
	        <form action="grep.php" method="post" accept-charset="utf-8" class="basic-grey" id="form_alt_color">
				<!-- 1.Row Start-->
				<div id="flex_parent">
					<div id="flex_left">
			            <label for="grep_pattern">Search: (RegEx)</label>
						<input type="text" name="grep_pattern" value="" id="grep_pattern" style="width: 200px">
					</div>
					<div id="flex_right">
						<label for="search_path"> in: </label>
			            <select name="search_path" id="search_path" style="width: 150px">
			                <option value="index/archive">Archive</option>
							<option value="index">Search All</option>
			            </select>
					</div>
				</div>
				<!-- 1.Row End-->
				<!-- 2.Row Start-->
				<div id="flex_parent">
					<div id="flex_left">
						<label for="case_sensitive" style="float: left; padding-right: 5px;">Case Sensitive:</label>
						<input type="checkbox" name="case_sensitive" value="1" id="case_sensitive" style="padding-right: 10px;">
					</div>
					<div id="flex_right">
						<input type="submit" value="Find!" style="width: 150px; background: white; border:1px solid #E4E4E4;">
					</div>
				</div>
				<!-- 2.Row End-->
	        </form>
		</div>
		<br><br>
		<!-- Search Form End -->
		<!-- Output Start -->
		<?php if (!empty($command)) { ?>
		    <code>Command: <?php echo htmlspecialchars($command); ?></code><br>
		    <code>I found: <?php echo count($output); ?></code> results.<br>
			----------------------------------------------------------------<br>
		    <?php echo $formatted; ?>
		    
		<?php } ?>
		</div>
		<!-- Page End -->
    </body>
</html>