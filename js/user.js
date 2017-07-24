$(function() {
  var timer;
  $("#search_input").keyup(function() {
    clearTimeout(timer);
    var ms = 2000; // milliseconds
    var val = this.value;
    timer = setTimeout(function() {
      search();
    }, ms);
  });
});

function search(){
    var pattern = document.getElementById("search_input").value;
    var path = "index/" + document.getElementById("index_selector").value;
    if(pattern.length <= 3){
    	return;
    }
    console.log("Called with pattern: " + pattern + ", path = " + path);
    $.ajax({
        type: 'post',
        data: { 'grep_pattern': pattern,
        		'search_path' : path },
        url: 'include/grep.php',
        success: function (response) {
            // We get the element having id of display_info and put the response inside it
            $( '#search_result' ).html(response);
        }
    });
}