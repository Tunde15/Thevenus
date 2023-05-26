// HEADER PAGE | script to show area and street box in the header
  function showAreStrBox(){
    $(document).ready(function(){
    $('.area_talk').click(function(){
   $('#area_conv').show();
    });

    $('.str_talk').click(function(){
   $('#street_conv').show();
    });
    $('.close1').click(function(){
      $('#area_conv').hide();
    })
    $('.close2').click(function(){
      $('#street_conv').hide();
    })
  });
}

  // USER_PAGE.PHP PAGE |
   //Using ajax to create area table to database  
   function ucreateAreatbl(){
    $(document).ready(function(){ 
    $("#create_area_tbl").submit(function(stop_default){ 
    stop_default.preventDefault();
    var url     = $(this).attr("action");
    var data    = $(this).serialize();
    $.post(url, data, function(confirm){
    $("#show_area_tbl").html(confirm);
     });
     });
     });
    }
     //Using ajax to create street table to database
    function ucreateStrtbl(){
     $(document).ready(function(){ 
    $("#create_street_tbl").submit(function(stop_default){ 
    stop_default.preventDefault();
    var url     = $(this).attr("action");
    var data    = $(this).serialize();
    $.post(url, data, function(confirm){
    $("#show_area_tbl").html(confirm);
    });
    });
    });
  }
         //Script to show area messages with ajax
function ushowArea(){
         $(document).ready(function(){ 
    setInterval(function(){ display_show_area_chat(); }, 4000);
    function display_show_area_chat(){
        $.ajax({       
            url: 'ajax_area_form_get.php',
            type: 'POST',
            success: function(show_report){        
                if(show_report){          
                    $("#show_area_chats").html(show_report);
                }
            }    
        });   
    }
});
}
   //Script to show street messages with ajax
   function ushowStr(){
   $(document).ready(function(){ 
    setInterval(function(){ display_show_street_chat(); }, 2000);
    function display_show_street_chat(){
        $.ajax({       
            url: 'ajax_street_form_get.php',
            type: 'POST',
            success: function(show_report){        
                if(show_report){          
                    $("#show_street_chats").html(show_report);
                }
            }    
        });   
    }
});
   }

// ADMIN |
function showArea(){
$(document).ready(function(){ 
  setInterval(function(){ display_show_area_chat(); }, 4000);
  function display_show_area_chat(){
      $.ajax({       
          url: 'admin_ajax_area_form_get.php',
          type: 'POST',
          success: function(show_report){        
              if(show_report){          
                  $("#show_area_chats").html(show_report);
              }
          }    
      });   
  }
}); 
}

// GENERAL |
//script to show password
function showMypass(){
  var x = document.getElementById('pwd');
  if(x.type === "password"){
    x.type = "text";
  }
  else{
    x.type = "password";
  }
}
    // output profile pics for edit
      var loadFile = function(event){
      var image = document.getElementById('output');
      image.src = URL.createObjectURL(event.target.files[0]);
    };