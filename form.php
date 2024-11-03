<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Validation with AJAX</title>
  <style>
    * {
      box-sizing: border-box;
    }
    
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .form-container {
      background-color: #fff;
      border-radius: 10px;
      padding: 30px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      max-width: 400px;
      width: 100%;
    }
    h3 {
      text-align: center;
    }

    h2 {
      text-align: center;
      color: #333;
    }

    label {
      display: block;
      margin-bottom: 10px;
      color: #555;
      font-weight: bold;
    }

    input[type="text"], input[type="email"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 16px;
    }

    input[type="text"]:focus, input[type="email"]:focus {
      border-color: #007bff;
    }

    .error {
      color: red;
      font-size: 14px;
      margin-bottom: 15px;
    }

    button[type="submit"] {
      width: 100%;
      background-color: #007bff;
      color: #fff;
      padding: 10px;
      border: none;
      border-radius: 5px;
      font-size: 16px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    button[type="submit"]:hover {
      background-color: #0056b3;
    }

    #message {
      margin-top: 20px;
      text-align: center;
      color: green;
      font-size: 18px;
    }
  </style>
</head>
<body>

  <div class="form-container">
    <h3>Group 11 - Exercise 5</h3>
    <h2>Form Validation with AJAX</h2>
    <form id="myForm" action="submit_form.php" method="POST">
      <label for="name">Name:</label>
      <input type="text" id="name" name="name" placeholder="Your Name" required>
      <span id="nameError" class="error"></span>

      <label for="email">Email:</label>
      <input type="email" id="email" name="email" placeholder="Your Email" required>
      <span id="emailError" class="error"></span>
      <label for="nickname">Nickname (max 8 characters):</label>
        <input type="text" id="nickname" name="nickname" placeholder="Your Nickname" maxlength="8" required>
        <span id="nicknameError" class="error"></span>

      <button type="submit">Submit</button>
    </form>

    <div id="message"></div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script>
    document.getElementById("myForm").addEventListener("submit", function(event) {
      event.preventDefault(); // Prevent the default form submission

      let name = document.getElementById("name").value;
      let email = document.getElementById("email").value;
      let nickname = document.getElementById("nickname").value;
      let isValid = true;

      document.getElementById("nameError").textContent = "";
      document.getElementById("emailError").textContent = "";
      document.getElementById("nicknameError").textContent = "";

      if (name === "") {
        document.getElementById("nameError").textContent = "Name is required.";
        isValid = false;
      }

      if (email === "") {
        document.getElementById("emailError").textContent = "Email is required.";
        isValid = false;
      }
       if (nickname === "") {
        document.getElementById("nicknameError").textContent = "Nickname is required.";
        isValid = false;
    } else if (nickname.length > 8) {
        document.getElementById("nicknameError").textContent = "Nickname should not be longer than 8 characters.";
        isValid = false;
    }

     
      if (isValid) {
        submitFormWithAjax();
      }
    });

    $("#myForm").submit(function(event) {
        event.preventDefault(); // Prevent form from submitting normally
 $.ajax({
            url: "submit_form.php",
            type: "POST",
            data: $(this).serialize(), // serialize form data
            success: function(response) {
                console.log(response); // Log the server response
                if (response.includes("Success!")) {
                    window.location.href = "team_profile.php"; // Redirect on success
                } else {
                    $("#message").html(response); // Display any errors
                }
            },
            error: function() {
                $("#message").html("An error occurred while submitting the form.");
            }
        });
});

     
  </script>

</body>
</html>
