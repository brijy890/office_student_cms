

//Ajax call

// $(document).ready(function(){

//     var page = 1;
//     $.ajax({
//       type: "get",
//       url: "../admin/view-2.php?q=2&page="+page,
//       dataType: "html",                 
//       success: function(data) {
//       $("#data").html(data);
//       }

//     });
//   });


function showUser(str){
    console.log(str);

    var page = 2;
    $.ajax({
    type: "post",
    url: "../admin/view-2.php?q="+str+"&page="+page,
    dataType: "html",                 
    success: function(data) {
    $("#data").html(data);
    }

    });

    $("#page").click(function(){
      console.log("clicked");
    });

  }


  var activePage = $("#activePage");
  // console.log(activePage);
  $(activePage).click(function(){
  
    console.log("clicked");
  });


  // $(document).ready(function(){

  //   $("#page").click(function(){
  //     console.log("clicked");
  //   });

    // var user = $("#user").val();
    // console.log(user);
    // var page = $("#page");
    // var pageValue = $("#page").val();
    // $(page).click(function(){
    //   console.log(pageValue);
    //   $.ajax({
    //     type: "post",
    //     url: "../admin/view-2.php?q="+user+"&page="+pageValue,
    //     dataType: "html",                 
    //     success: function(data) {
    //     $("#data").html(data);
    //     }

    //   });

    // });
  // });
// $(document).ready(function(){

//   function showUser(str){

//     $.ajax({
//     type: "get",
//     url: "../admin/view.php?q="+str,
//     dataType: "html",                 
//     success: function(data) {
//     $("#data").html(data);
//     }

//     });
//   }

// });

  

  
    
