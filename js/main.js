

//Ajax call


// function showUser(str) {
// 	console.log(str);
//   if (str == '') {
//     document.getElementById("txtHint").innerHTML="here";
//     return;
//   }
//   if (window.XMLHttpRequest) {
//     // code for IE7+, Firefox, Chrome, Opera, Safari
//     xmlhttp=new XMLHttpRequest();
//   } else { // code for IE6, IE5
//     xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
//   }
//   xmlhttp.onreadystatechange=function() {
//     if (this.readyState==4 && this.status==200) {
//       document.getElementById("txtHint").innerHTML=this.responseText;
//     }
//   }
//   xmlhttp.open("GET","../admin/view.php?q="+str,true);
//   xmlhttp.send();
// }

  function showUser(str){

    $.ajax({
    type: "get",
    url: "../admin/view.php?q="+str,
    dataType: "html",                 
    success: function(data) {
    $("#txtHint").html(data);
    }

    });
  }
    
