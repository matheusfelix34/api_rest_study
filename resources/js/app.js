require('./bootstrap');
window.$ = window.jQuery = require('jquery');




$('#register-button-profile').click(function() {
   
    var first_name1 = document.getElementById("first_name").value;
    var last_name1 = document.getElementById("last_name").value;
    var dob1 = document.getElementById("dob").value;
    var gender1 = document.getElementById("gender").value;
    
    if (first_name1 === '' || last_name1 === '' || dob1 === '' || document.getElementById("gender").selectedIndex === -1) {
      alert('Please fill in all required fields.');
      return;
    }
  
    
    $.ajax({
        url: "/api/cad_profile",
        method: 'POST',
        dataType: "json",
        data: {  first_name: first_name1, last_name:last_name1 , dob:dob1, gender:gender1 },
        success: function (data) {
            alert("Profile created successfully.");

            var form = document.getElementById("profile-form");

  
  for (var i = 0; i < form.elements.length; i++) {
    var element = form.elements[i];

   
   
      element.value = "";
    
  }
        }
    });
});


$('#register-button-report').click(function() {
   
  var title1 = document.getElementById("title").value;
  var description1 = document.getElementById("description").value;
  var profiles_input = document.getElementById("profiles");

  if (title1 === '' || description1 === '' || profiles_input.selectedIndex === -1) {
    alert('Please fill in all required fields.');
    return;
  }

  var profiles_array = [];
    for (var option of document.getElementById('profiles').options)
    {
        if (option.selected) {
          profiles_array.push(option.value);
        }
    }
   
 

 
  
  $.ajax({
      url: "/api/cad_report",
      method: 'POST',
      dataType: "json",
      data: {  title: title1, description:description1, profiles:profiles_array},
      success: function (data) {
       
        if (data>0) {
          alert("Profile created successfully.");
         
         


          var form = document.getElementById("report-form");

  
          for (var i = 0; i < form.elements.length; i++) {
            var element = form.elements[i];
        
           
           
             
              element.value = "";
            
          }




        }else{
          alert("sorry, but it was not possible to register the report, try again or contact the responsible system.");
          
        }

        

      }
  });
});

$(document).ready(function() {
    setTimeout(function() {
      $('.alert-success').fadeOut('slow');
      $('.alert-danger').fadeOut('slow');
    }, 3000); 
  });
