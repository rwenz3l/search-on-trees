<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8">
        <title>Search on Trees</title>
        <link href="css/style.css" rel="stylesheet">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <script src="js/jquery.min.js"></script>
	    <script src="js/user.js"></script>
    </head>
    <body>
	<div class="center" style="width: 600px;">
        <div class="form-group">
            <input id="search_input"
                   type="text"
                   class="form-control"
                   style="width: 100%;"
                   placeholder="RegEx">
        </div>
    Search in: <select id="index_selector" name="index" onchange="search()">
        <option value="">All</option>
    <?php
        foreach (new DirectoryIterator('index/') as $index) {
            if($index->isDot()) continue;
            if(! $index->isFile()){
                $path = $index->getFilename();
                echo('<option value=' . $path . '>' . $path . '</option>');
            }
        }
    ?>
    </select>
    <br/>
    <a href="include/list_index.php">List Index</a>
    </div>
    <hr/>
    <div id="search_result" style="padding: 50px;"></div>
    </body>
</html>