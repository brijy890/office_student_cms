

//Ajax call

$(document).ready(function(){

    $.ajax({
    type: "get",
    url: "../admin/view.php?q=2",
    dataType: "html",                 
    success: function(data) {
    $("#data").html(data);
    }

    });
});


  function showUser(str){

    $.ajax({
    type: "get",
    url: "../admin/view.php?q="+str,
    dataType: "html",                 
    success: function(data) {
    $("#data").html(data);
    }

    });
  }


  // function showUser(str){

  //   $.ajax({
  //   type: "post",
  //   url: "../admin/view.php","str",
  //   dataType: "html",                 
  //   success: function(data) {
  //   $("#txtHint").html(data);
  //   }

  //   });
  // }
    
