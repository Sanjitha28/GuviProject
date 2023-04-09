$(document).ready(function() {
  $("#login").click(function() {
      var name = $("#name").val();
      var password = $("#password").val();
      if (name == '' || password == '') {
         alert("Please fill all fields.");
      }
      else {
          $.ajax({
          url: 'http://localhost/GuviProject/php/login.php',
          type: 'POST',
          data: {
          name: name,
          password: password
      },
      dataType: 'json',
      success: function(data) {
          if (data.success) {
            
          localStorage.setItem('userid', data.userid);
          localStorage.setItem('username', data.username);
          window.location.href = 'profile.html';
          } else {
          alert(data.message);
          }
      },
      error: function() {
      alert('Error submitting form.');
      }
      });
      }
  });
});