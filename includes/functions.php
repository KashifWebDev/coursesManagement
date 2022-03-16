<?php


function signUp(){
    return '
    <div class="w-100 pe-2 mt-2 d-flex flex-column align-items-center justify-content-center">


        <div class="card mb-3">

            <div class="card-body text-dark">

                <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                    <p class="text-center small">Please sign up to get the course subscription...</p>
                </div>

                <form class="row g-3 needs-validation" novalidate="" method="post" action="register.php">
                
                    <div class="col-md-6">
                      <div class="form-floating">
                        <input type="text" class="form-control" id="floatingEmail" placeholder="Name" name="firstName">
                        <label for="floatingEmail">Your Name</label>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-floating">
                        <input type="text" class="form-control" id="floatingEmail" placeholder="Email" name="email">
                        <label for="floatingEmail">Email</label>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-floating">
                        <input type="text" class="form-control" id="floatingEmail" placeholder="Username" name="username">
                        <label for="floatingEmail">Username</label>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-floating">
                        <input type="password" class="form-control" id="floatingEmail" placeholder="Password" name="password">
                        <label for="floatingEmail">Password</label>
                      </div>
                    </div>
                    <input type="hidden" name="options" value="Student">
                    
                    <div class="col-md-6">
                        <button class="btn btn-primary w-100" type="submit" name="signUp" id="submitBtn">Create Account</button>
                    </div>
                    <div class="col-md-6 d-flex justify-content-center align-items-center">
                        <p class="small mb-0">Already have an account? <a href="./">Log in</a></p>
                    </div>
                </form>

            </div>
        </div>

    </div>
';
}

function paypal($course){
    $price = $course["price"];
    $a = '
    <div class="w-100 mt-5 d-flex flex-column align-items-center justify-content-center">


        <div class="card mb-3">

            <div class="card-body text-dark">

                <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Buy Course in '.$price.'$</h5>
                    <p class="text-center small">Please buy this course to proceed...</p>
                </div>
                

                <form >
                
                        <div class="form-floating mb-3">
                          <input type="text" class="form-control" id="PaypalEmail" placeholder="Enter Email">
                          <label for="PaypalEmail">Email</label>
                        </div>
                    <div class="col-md-12">
                        <div id="paypal-button-container"></div>
                    </div>
                </form>

            </div>
        </div>

    </div>
';

    return $a;
}

function PasswordProtected(){
    return '
    <div class="w-100 mt-5 d-flex flex-column align-items-center justify-content-center">
        <div class="card mb-3">
            <div class="card-body text-dark">
                <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">
                    <i class="bi bi-key-fill me-2"></i> Password Protected
</h5>
                    <p class="text-center small">Please enter password to unlock...</p>
                    <form action="" method="post">
                        <div class="form-floating mb-3">
                          <input type="password" class="form-control" id="floatingPassword"
                           placeholder="Password" name="coursePassValue">
                          <label for="floatingPassword">Password</label>
                        </div>
                        <div class="col-md-12">
                            <button class="btn btn-outline-dark w-100"
                            type="submit" name="unlockCourse_Pass">
                            <i class="bi bi-shield-lock me-2"></i>
                            Unlock
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
';
}

function loadPaypalScripts($api, $price, $courseID){
    $a = "";
    if(isset($api) && !empty($api)){
        $a .= '<script src="https://www.paypal.com/sdk/js?client-id='.$api.'&currency=CAD&disable-funding=credit,card"></script>';
    }else{
        $a .= '<script src="https://www.paypal.com/sdk/js?client-id=AUV9WUKaXyoFG7UN6rgBt-NKkSJWJHUxKSxbfq6g97mJglHj8rrOcSJJHgvGOgaVQ-dARLQOKm0cBuQ3&currency=CAD&disable-funding=credit,card"></script>';
    }

    $a .= "
    <script>
    var price = parseFloat(".$price.");
    var courseID = parseInt(".$courseID.")
    var userEmail;
      paypal.Buttons({
      
        onInit: function(data, actions) {
            actions.disable();

            document.querySelector('#PaypalEmail')
                .addEventListener('change', function(event) {

                    var val = $.trim(event.target.value);

                    if (val) {
                        actions.enable();
                    } else {
                        actions.disable();
                    }
                });

        },
        onClick: function() {

            var val = $.trim($('#PaypalEmail').val());

            if (!val) {
                alert('Please enter the email');
            }
            userEmail = val;
        },

        // Sets up the transaction when a payment button is clicked
        createOrder: function(data, actions) {
          return actions.order.create({
            purchase_units: [{
              amount: {
                value: price // Can reference variables or functions. Example: `value: document.getElementById('...').value`
              }
            }]
          });
        },

        // Finalize the transaction after payer approval
        onApprove: function(data, actions) {
          return actions.order.capture().then(function(orderData) {
            // Successful capture! For dev/demo purposes:
//                console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                console.log(JSON.stringify(orderData));
                var transaction = orderData.purchase_units[0].payments.captures[0];

                $.ajax({
                    url: 'api/payment.php',
                    type: 'POST',
                    data: jQuery.param(
                        { courseID: courseID,
                        email : userEmail,
                        response : JSON.stringify(orderData)
                        }
                      ) ,
                    contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
                    success: function (response) {
                        if(response=='yes'){
                        alert('Payment was successfull');
                        window.location.reload();
//                        window.location.href ='course-123?done';
                        }
                        
                    },
                    error: function () {
                        alert('error');
                    }
                });  
                
            // When ready to go live, remove the alert and show a success message within this page. For example:
            // var element = document.getElementById('paypal-button-container');
            // element.innerHTML = '';
            // element.innerHTML = '<h3>Thank you for your payment!</h3>';
            // Or go to another URL:  actions.redirect('thank_you.html');
          });
        }
      }).render('#paypal-button-container');

    </script>";

    return $a;
}

function limit_text($text, $limit) {
    if (str_word_count($text, 0) > $limit) {
        $words = str_word_count($text, 2);
        $pos   = array_keys($words);
        $text  = substr($text, 0, $pos[$limit]);
        $text .= '<button type="button" class="bg-transparent border-0 text-primary" data-bs-toggle="modal" data-bs-target="#aboutInstructorTextModal">....Read More</button>';
    }
    return $text;
}
?>