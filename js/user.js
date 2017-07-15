$(function() {
  var timer;
  $("#search_input").keyup(function() {
    clearTimeout(timer);
    var ms = 2000; // milliseconds
    var val = this.value;
    timer = setTimeout(function() {
      search(val);
    }, ms);
  });
});

function search(){
    console.log("called");
    var data = document.getElementById("search_input").value;
    if(data.length <= 3){
    	return;
    }
    $.ajax({
        type: 'post',
        data: { 'grep_pattern': data,
        		'search_path' : 'index' },
        url: 'grep.php',
        success: function (response) {
            // We get the element having id of display_info and put the response inside it
            $( '#search_result' ).html(response);
        }
    });
}