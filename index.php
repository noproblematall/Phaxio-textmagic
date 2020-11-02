<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <!--[if lt IE 9]><script src="../assets/flashcanvas.js"></script><![endif]-->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="./jquery-ui-1.12.1.custom/jquery-ui.min.css">
    <link rel="stylesheet" href="./jquery-ui-1.12.1.custom/jquery-ui.theme.min.css">
    <link rel="stylesheet" href="./css/jquery.signaturepad.css">
    <link rel="stylesheet" href="./css/custom.css">
    <title>Send Fax</title>
</head>
<body>
    <div class="info">
        <h1>Ready to Fax?</h1>        
    </div>
    
    <form class="steps" accept-charset="UTF-8" enctype="multipart/form-data" novalidate="">
        <ul id="progressbar">
            <li class="active">Contact Information</li>
            <li>Child Information</li>
            <li>Driver License</li>
            <li>Signature</li>
            <li>Review</li>
        </ul>
    
    
    
        <!-- USER INFORMATION FIELD SET -->
        <fieldset>
            <h2 class="fs-title">Your Contact Information</h2>
            <h3 class="fs-subtitle">We just need some basic information to send a fax.</h3>

            <!-- Begin What's Your Full Name Field -->
            <div class="hs_fullname field hs-form-field">    
                <label for="fullname">Your Complete Full Name *</label>    
                <input id="fullname" name="fullname" required="required"
                    type="text" value="" placeholder="Your Full Name" data-rule-required="true"
                    data-msg-required="Please include your full name">
                <span class="error1" style="display: none;">
                    <i class="error-log fa fa-exclamation-triangle"></i>
                </span>
            </div>
            <!-- End What's Your Full Name Field -->
    
            <!-- Begin Your street Field -->
            <div class="hs_street field hs-form-field">    
                <label for="street">Street Address *</label>    
                <input id="street" name="street" required="required" type="text"
                    value="" placeholder="Street Address" data-rule-required="true"
                    data-msg-required="Please enter a valid street address.">
                <span class="error1" style="display: none;">
                    <i class="error-log fa fa-exclamation-triangle"></i>
                </span>
            </div>
            <!-- End Your street Field -->
    
            <!-- Begin City Field -->
            <div class="hs_city field hs-form-field">    
                <label for="city">City *</label>    
                <input id="city" class="form-text hs-input"
                    name="city" required="required" size="60" maxlength="128"
                    type="text" value="" placeholder="City" data-rule-required="true"
                    data-msg-required="Please enter a valid city">
                <span class="error1" style="display: none;">
                    <i class="error-log fa fa-exclamation-triangle"></i>
                </span>
            </div>    
            <!-- End City Field -->

            <!-- Begin State Field -->
            <div class="hs_state field hs-form-field">
                <label for="state">State *</label>    
                <input id="state" class="form-text hs-input"
                    name="state" required="required"
                    type="text" value="" placeholder="State" data-rule-required="true"
                    data-msg-required="Please enter a valid state">
                <span class="error1" style="display: none;">
                    <i class="error-log fa fa-exclamation-triangle"></i>
                </span>
            </div>
            <!-- End State Field -->

            <!-- Begin ZIP Code Field -->
            <div class="hs_zip_code field hs-form-field">
                <label for="zip_code">ZIP Code *</label>    
                <input id="zip_code" class="form-text hs-input"
                    name="zip_code" required="required"
                    type="text" value="" placeholder="ZIP Code" data-rule-required="true"
                    data-msg-required="Please enter a valid zip code">
                <span class="error1" style="display: none;">
                    <i class="error-log fa fa-exclamation-triangle"></i>
                </span>
            </div>    
            <!-- End ZIP Code Field -->

            <!-- Begin Cell Phone Field -->
            <div class="hs_phone field hs-form-field">
                <label for="phone">Cell Phone *</label>    
                <input id="phone" class="form-text hs-input"
                    name="phone" required="required"
                    type="text" value="" placeholder="Numbers Only" data-rule-required="true"
                    data-msg-required="Please enter a valid phone">
                <span class="error1" style="display: none;">
                    <i class="error-log fa fa-exclamation-triangle"></i>
                </span>
            </div>
            <!-- End Cell Phone Field -->
            <div class="button-wrapper">
                <input type="button" id="reset_1" name="reset" class="reset action-button" value="Reset" />
                <input type="button" data-page="1" name="next" class="next action-button" value="Next" />
            </div>
        </fieldset>    
    
        <!-- Child/Children Information FIELD SET -->
        <fieldset>
            <h2 class="fs-title">Child/Children Information</h2>
            <h3 class="fs-subtitle">How many do you have children?</h3>
            <div class="form-item-wrapper">
                <!-- Begin First Child Full Name Field -->
                <div class="form-item child_name">
                    <label for="child_full_name">Child Name *</label>
                    <input id="child_full_name" class="form-text hs-input"
                        name="child_full_name" required="required" type="text"
                        value="" placeholder="" data-rule-required="true" data-msg-required="Requierd field">
                    <span class="error1" style="display: none;">
                        <i class="error-log fa fa-exclamation-triangle"></i>
                    </span>
                </div>
                <!-- End First Child Full Name Field -->

                <!-- Begin First Child Birthday Field -->
                <div class="form-item">    
                    <label for="child_birthday">Date Of Birth *</label>
                    <input id="child_birthday" class="datepicker form-text hs-input"
                        name="child_birthday" required="required" type="text"
                        value="" placeholder="" data-rule-required="true" data-msg-required="Requierd field">
                    <span class="error1" style="display: none;">
                        <i class="error-log fa fa-exclamation-triangle"></i>
                    </span>
                </div>                
                <!-- End First Child Birthday Field -->
            </div>
            <div class="new_child">
                    
            </div>
            <div class="button-wrapper">
                <input type="button" id="reset_2" name="reset" class="reset action-button" value="Reset" />
                <input type="button" name="add_another" class="add_another action-button" value="Add" />
            </div>

            <div class="button-wrapper">
                <input type="button" data-page="2" name="previous" class="previous action-button" value="Previous" />                
                <input type="button" data-page="2" name="next" class="next action-button" value="Next" />
            </div>
            
        </fieldset>    
    
        <!-- Driver License FIELD SET -->
        <fieldset>
            <h2 class="fs-title">Driver License Information</h2>
            <h3 class="fs-subtitle">Please upload driver license</h3>
            <div class="image_wrapper">
                <img src="" alt="Driver Licence" id="driver_lience">
            </div>
            <div class="custom-file">
                <input type="file" class="custom-file-input" data-rule-required="true" data-msg-required="Please upload the driver license" capture="camera" id="customFile" accept=".jpg,.png">
                <span class="error1" style="display: none;">
                    <i class="error-log fa fa-exclamation-triangle"></i>
                </span>
            </div>            
            <div class="button-wrapper">
                <input type="button" data-page="3" name="previous" class="previous action-button" value="Previous" />
                <input type="button" data-page="3" name="next" class="next action-button" value="Next" />
            </div>
        </fieldset>    
    
        <!-- Signature FIELD SET -->
        <fieldset>
            <h2 class="fs-title">Signature Information</h2>
            <h3 class="fs-subtitle">Please draw your signature.</h3>
            <div class="sigPad">
                <div class="sig sigWrapper">
                    <canvas class="pad" width="198" height="55"></canvas>
                    <input type="hidden" name="output" id="pad_data" class="output" data-rule-required="true" data-msg-required="Please draw your signature">
                    <span class="pad_error error1" style="display: none;">
                        Please draw your signature
                    </span>
                </div>
                <div class="clearButton"><a href="#clear">Clear</a></div>
            </div>
            <div class="button-wrapper">
                <input type="button" data-page="4" name="previous" class="previous action-button" value="Previous" />
                <input type="button" data-page="4" name="next" class="next action-button final-button" value="Next" />
            </div>
        </fieldset>    
    
        <!-- Review FIELD SET -->
        <fieldset>
            <h2 class="fs-title">Review</h2>
            <h3 class="fs-subtitle">Here is what you will fax</h3>

            <p class="head_title">I am writing to demand to review the DHS file of my children.<br />My name is:</p>
            <div class="review">
                <label>Name:</label>
                <p class="review_name"></p>
                <label>Address:</label>
                <p class="review_street"></p>
                <label>City: </label>
                <p class="review_city"></p>
                <label>State: </label>
                <p class="review_state"></p>
                <label>ZIP Code</label>
                <p class="review_code"></p>
                <label>Cell Phone</label>
                <p class="review_phone"></p>                
            </div>

            <p class="head_title">The child/children whose file I wish to review is/are:</p>
            <div class="review">
                <div class="form-item-wrapper">
                    <div class="form-item">
                        <label>Child Name: </label>
                    </div>
                    <div class="form-item">
                        <label>Date Of Birth: </label>
                    </div>
                </div>
                <div class="child_review">

                </div>
            </div>

            <p class="head_title">I demand the right to review their files within ten business days.<br />My identification is as follows:</p>
            <div class="review">
                <div class="image_wrapper">
                    <img src="" class="review_driver" alt="Driver Lience">
                </div>
            </div>

            <p class="head_title">My signature:</p>
            <div class="review">
                <div class="review_sigPad">
                    <canvas class="pad" id="pad" width="198" height="55"></canvas>                        
                </div>
            </div>

            <div class="review_accept">
                <input type="checkbox" id="accept" name="accept" value="Accept">
                <label for="accept">Check here to confirm that you are a real person and that you accept the terms and conditions of this website.</label>
            </div>
            <div class="g-recaptcha" data-sitekey="6LedEdwZAAAAAGGhr9lk2nA3hB_hkLNtYIRs8aTk"></div>
            <input type="hidden" name="driver_lience" id="driver_lience_hidden">
            <input type="hidden" name="signature_img" id="signature_img">
            <input type="hidden" name="number" id="number">
            <div class="button-wrapper">
                <input type="button" id="final_previous" data-page="5" name="previous" class="previous action-button" value="Previous" />
                <input id="submit" class="hs-button primary large action-button" type="button" value="Submit">
            </div>
        </fieldset>
    
        <fieldset>
            <h2 class="fs-title">It's on the way!</h2>
            <h3 class="fs-subtitle">Thank you for trying out our fax tool.</h3>
            <div class="text-center">
                <a id="back" href="#" class="hs-button primary large" type="button">Return to website</a>            
            </div>
        </fieldset>
    
    <script src="./js/jquery_2_13.min.js"></script>
    <script src="./jquery-ui-1.12.1.custom/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.js"></script>
    <script src="./js/jquery.signaturepad.min.js"></script>
    <script src="./js/cleave.min.js"></script>
    <script src="./js/phone-type-formatter.us.js"></script>
    <script>
        $(document).ready(function() {
          $('.sigPad').signaturePad({drawOnly:true});
        });
      </script>
    <script src="./js/json2.min.js"></script>
    <script src="./js/custom.js"></script>
</body>
</html>