$(document).ready(function() {
    $("#register").click(function() {
        var name = $("#name").val();
        var password = $("#password").val();
        if (name == '' ||  password == '') {
            alert("Please fill all fields.");
        } 
        else {
            $.ajax({
                url: 'http://localhost/GuviProject/php/register.php',
                type: 'POST',
                data: {
                    name: name,
                    password: password
                },
                success: function(data) {
                    alert(data.message);
                    if(data.success){
                        window.location.href = 'login.html';
                    }
                },
                error: function() {
                    alert('Error submitting form.');
                }
            });
        }
    });
});