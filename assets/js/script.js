$(document).ready(function() {
    // for register
    $('#registerForm').on('submit', function(e){
        e.preventDefault();

        $('#message-area').html('');

        const username = $('#username').val().trim();
        const email = $('#email').val().trim();
        const password = $('#password').val();
        const confirm_password = $('#confirm_password').val();

        if(!username || !email || !password || !confirm_password){
            displayMessage('Please enter all the input fields', 'danger');
            return;
        }

        if(password !== confirm_password){
            displayMessage('Password an confirm password do not match', 'danger');
            return;
        }

        if(password.length < 8){
            displayMessage('Password must be at least 8 characters long', 'danger');
            return;
        }

        const formData = {
            username,
            email,
            password,
            confirm_password
        }


        $.ajax({
            type: 'POST',
            url: 'api/register.php',
            data: formData,
            dataType: 'json',
            success(response){
                if(response.status === 'success'){
                    displayMessage(response.message, 'success');
                    $('#registerForm')[0].reset();
                }else{
                    displayMessage(response.message, 'danger');
                }
            },
            error(xhr, status, error){
                 console.error('AJAX Error: ', status, error, xhr.responseText);
                 displayMessage('An error occurred while sending data: ' + error + ' please check your console', 'danger');
                  
            }
        })

    })

    // section Login
    $('#loginForm').on('submit', function(e){
        e.preventDefault();

        $('#login-message-area').html('');

        let username = $('#username').val().trim();
        let password = $('#password').val();

        if(!username || !password){
            displayLoginMessage('Please Enter your username and password', 'danger');
            return;
        }   

        let formData = {
            username,
            password
        }

        $.ajax({
            type: 'POST',
            url: 'api/login.php',
            data: formData,
            dataType: 'json',
            success(response){
                if(response.status === 'success'){
                    displayLoginMessage(response.message, 'success');
                    if(response.redirect_url){
                        setTimeout(function(){
                            window.location.href = response.redirect_url;
                        }, 1500);
                    }
                }else{
                    displayLoginMessage(response.message, 'danger');

                }
            },
            error(xhr, status, error){
                console.error('AJAX error: ', status, error, xhr.responseText);
                displayLoginMessage('An error occurred while sending data', error, 'danger');
            }
        })

    })



    // Section Logout
    $('#logoutButton').on('click', function(e){
        e.preventDefault();

        $.ajax({
            type: 'POST',
            url: 'api/logout.php',
            dataType: 'json',
            success(response){
                if(response.status === 'success'){
                    window.location.href = 'login.html';
                } 
            },
            error(xhr, status, error){
                console.error('AJAX logout error', status, error, xhr.responseText);
            }
        })
    })




//  function message-area
    function displayMessage(message, type){
        $('#message-area').html(
            `<div class='alert alert-${type} alert-dismissible fade show' role='alert'>
                ${message}
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>`
        )
    }


// function login-message-area

   function displayLoginMessage(message, type){
        $('#login-message-area').html(
            `<div class='alert alert-${type} alert-dismissible fade show' role='alert'>
                ${message}
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>`
        )
    }


})