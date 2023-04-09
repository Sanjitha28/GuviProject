$(document).ready(function () {
	let userid = localStorage.getItem("userid");
	if (userid == null) {
	  alert('Please login to view your profile.');
	  location.href = "login.html";
	}
	$.ajax({
	  url: "http://localhost/GuviProject/php/profile.php",
	  type: "POST",
	  data: {
		functionName: "fetching",
		userid: userid,
	  },
	  async: true,
	  dataType: "json",
	  success: function (res) {
		if (res.success) {

			function age(str) {
			  let arr = str.split("-");
			  let year = parseInt(arr[2]);
			  return 2023 - year;
			}
  
			$("#userid").val(res.userid);
			$("#name").val(res.name);
			$("#email").val(res.email);
			$("#phno").val(res.phno);
			$("#dob").val(res.dob);
			$("#age").val(age(res.dob));
		  }
		  else{
			alert(res.message);
		  }
	  },
	});
	$("#logout").click(function(){
		localStorage.removeItem("userid");
		localStorage.removeItem("username")
		location.href="login.html";
	})
	$("#update").click(function (e) {
	  e.preventDefault();
	  let userid = localStorage.getItem("userid");
	  let name = $("#name").val();
	  let email = $("#email").val();
	  let phno = $("#phno").val();
	  let dob = $("#dob").val();
	  $.ajax({
		url: "http://localhost/GuviProject/php/profile.php",
		type: "POST",
		data: {
		  functionName: "update",
		  userid: userid,
		  name: name,
		  email: email,
		  phno: phno,
		  dob: dob,
		},
		async: true,
		success: function (res) {
		  console.log(res);
		  alert("Updated successfully");
		  location.href = "index.html";
		},
	  });
	});
  });





 