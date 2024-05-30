<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <style>
        body {
            background-color: beige;
            font-family: Arial, sans-serif;
        }

        .container {
            border-radius: 10px;
            padding: 20px;
            margin: 50px auto;
            max-width: 800px;
        }

        .profile-picture {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .profile-picture img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #682773;
            margin-top: 20px;
        }

        .profile-details {
            padding: 20px;
        }

        .labels {
            font-size: 14px;
            font-weight: bold;
            color: #682773;
            margin-bottom: 5px;
        }

        .form-control {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #ccc;
            width: 100%;
            box-sizing: border-box;
        }

        .profile-button {
            background: #03C04A;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .profile-button:hover {
            background: #234F1E;
        }

        .experience {
            font-size: 18px;
            font-weight: bold;
            color: #682773;
            margin-bottom: 15px;
        }

        .add-experience {
            background: #682773;
            color: #fff;
            border: solid 1px #682773;
            border-radius: 5px;
            padding: 8px 15px;
            cursor: pointer;
            transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
        }

        .add-experience:hover {
            background: #BA68C8;
            border-color: #BA68C8;
            color: #fff;
        }
    </style>
</head>
<body>
<?php include '../Layout/studentHeader.php'; ?>

    <div class="container rounded">
        <div class="row">
            <div class="col-md-3 border-right profile-picture">
            <?php
                // Display the profile picture if 'student_image' exists
                if(isset($row['student_image'])) {
                    echo '<img src="upload/' . $_SESSION['student_image'] . '" alt="Profile Picture">';
                } else {
                    echo "Profile Picture Not Available";
                }
            ?>                
            </div>
            <div class="col-md-5 border-right profile-details">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Profile Settings</h4>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6">
                        <label class="labels">Username</label>
                        <input type="text" class="form-control" placeholder="First Name" value="">
                    </div>
                    <div class="col-md-6">
                        <label class="labels">Password</label>
                        <input type="password" class="form-control" placeholder="Surname" value="">
                    </div>
                    <div class="col-md-6">
                        <label class="labels">Email</label>
                        <input type="email" class="form-control" placeholder="Surname" value="">
                    </div>
                    <div class="col-md-6">
                        <label class="labels">Age</label>
                        <input type="text" class="form-control" placeholder="Surname" value="">
                    </div>
                    <div class="col-md-6">
                        <label class="labels">Phone Number</label>
                        <input type="text" class="form-control" placeholder="Surname" value="">
                    </div>
                    <div class="col-md-6">
                        <label class="labels">Gender</label>
                        <input type="radio" id="male" name="Gender" value="Male" required>
                        <label for="male">Male</label>
                        <input type="radio" id="female" name="Gender" value="Female" required>
                        <label for="female">Female</label>
                    </div><br>
                    <div class="col-md-6">
                        <label class="labels">Birthdate</label>
                        <input type="date" class="form-control" placeholder="Surname" value="">
                    </div>
                </var>
                </div>
                <!-- More input fields -->
                <div class="mt-5 text-center">
                    <button class="profile-button" type="button">Save Profile</button>
                </div>
            </div>
            
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('.profile-button').addEventListener('click', function() {
                // Get form inputs
                var username = document.querySelector('#username').value;
                var password = document.querySelector('#password').value;
                var email = document.querySelector('#email').value;
                var age = document.querySelector('#age').value;
                var phone = document.querySelector('#phone').value;
                var gender = document.querySelector('input[name="Gender"]:checked');
                var birthdate = document.querySelector('#birthdate').value;

                // Validation
                if (username.trim() === '') {
                    alert('Please enter your username.');
                    return;
                }
                if (password.trim() === '') {
                    alert('Please enter your password.');
                    return;
                }
                if (email.trim() === '') {
                    alert('Please enter your email.');
                    return;
                }
                if (age.trim() === '') {
                    alert('Please enter your age.');
                    return;
                }
                if (phone.trim() === '') {
                    alert('Please enter your phone number.');
                    return;
                }
                if (!gender) {
                    alert('Please select your gender.');
                    return;
                }
                if (birthdate.trim() === '') {
                    alert('Please enter your birthdate.');
                    return;
                }

                // If all validations pass, submit the form
                alert('Form submitted successfully!');
                // You can add code here to submit the form to the server
            });
        });
    </script>
    <?php include '../Layout/allUserFooter.php'; ?>

</body>
</html>



