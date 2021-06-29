<!-- Keegan Verwey -->
<!-- 19004753 -->
<?php
session_start();
ob_start();
?>
<html>
    <head>
        <title>Extreme Diving Registration</title>
         <!-- (Stackpath.bootstrapcdn.com. 2021) -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link href="stylesheet.css?v=<?php echo time(); ?>" type="text/css" rel="stylesheet" />
        <!-- (Ajax.googleapis.com. 2021) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <!-- (Stackpath.bootstrapcdn.com. 2021) -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    </head>

    <!-- Responsive registration page HTML -->
    <body class = "bgd_img_reg">
        <div class = "body">
            <form action = "registration.php" method = "post">    
            <div class="row-spacing-reg"></div> 
                <div class="container">
                    <h1>BECOME A SHOPPER</h1>
                    <p>Please fill in this form to create an account.</p>

                    <label for="txtFName"><b>First Name:</b></label>
                    <!-- Sticky Form -->
                    <input class="input_fields" name = "txtFName" type = "text" placeholder = "Please enter name"
                    value="<?php if (isset($_POST['txtFName'])) echo $_POST['txtFName']; ?>"/>

                    <label for="txtLName"><b>Last Name:</b></label>
                    <!-- Sticky Form -->
                    <input class="input_fields" name = "txtLName" type = "text" placeholder = "Please enter surname"
                    value="<?php if (isset($_POST['txtLName'])) echo $_POST['txtLName']; ?>"/>

                    <label for="txtAddressLine"><b>Address Line:</b></label>
                    <!-- Sticky Form -->
                    <input class="input_fields" name = "txtAddressLine" type = "text" placeholder = "Please enter address"
                    value="<?php if (isset($_POST['txtAddressLine'])) echo $_POST['txtAddressLine']; ?>"/>

                    <label for="txtState"><b>State:</b></label>
                    <!-- Sticky Form -->
                    <input class="input_fields" name = "txtState" type = "text" placeholder = "Please enter state"
                    value="<?php if (isset($_POST['txtState'])) echo $_POST['txtState']; ?>"/>

                    <label for="txtPostal"><b>Postal Code:</b></label>
                    <!-- Sticky Form -->
                    <input class="input_fields" name = "txtPostal" type = "text" placeholder = "Please enter postal code"
                    value="<?php if (isset($_POST['txtPostal'])) echo $_POST['txtPostal']; ?>"/>

                    <!-- (html-code-generator.com. 2021.) -->
                    <label for="country"><b>Country:</b></label>
                    <select id="country" name="country" class="input_fields" style="color:grey">
                    <option>Select country</option>
                    <option value="Afghanistan">Afghanistan</option>
                    <option value="Aland Islands">Aland Islands</option>
                    <option value="Albania">Albania</option>
                    <option value="Algeria">Algeria</option>
                    <option value="American Samoa">American Samoa</option>
                    <option value="Andorra">Andorra</option>
                    <option value="Angola">Angola</option>
                    <option value="Anguilla">Anguilla</option>
                    <option value="Antarctica">Antarctica</option>
                    <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                    <option value="Argentina">Argentina</option>
                    <option value="Armenia">Armenia</option>
                    <option value="Aruba">Aruba</option>
                    <option value="Australia">Australia</option>
                    <option value="Austria">Austria</option>
                    <option value="Azerbaijan">Azerbaijan</option>
                    <option value="Bahamas">Bahamas</option>
                    <option value="Bahrain">Bahrain</option>
                    <option value="Bangladesh">Bangladesh</option>
                    <option value="Barbados">Barbados</option>
                    <option value="Belarus">Belarus</option>
                    <option value="Belgium">Belgium</option>
                    <option value="Belize">Belize</option>
                    <option value="Benin">Benin</option>
                    <option value="Bermuda">Bermuda</option>
                    <option value="Bhutan">Bhutan</option>
                    <option value="Bolivia">Bolivia</option>
                    <option value="Bonaire, Sint Eustatius and Saba">Bonaire, Sint Eustatius and Saba</option>
                    <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                    <option value="Botswana">Botswana</option>
                    <option value="Bouvet Island">Bouvet Island</option>
                    <option value="Brazil">Brazil</option>
                    <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                    <option value="Brunei Darussalam">Brunei Darussalam</option>
                    <option value="Bulgaria">Bulgaria</option>
                    <option value="Burkina Faso">Burkina Faso</option>
                    <option value="Burundi">Burundi</option>
                    <option value="Cambodia">Cambodia</option>
                    <option value="Cameroon">Cameroon</option>
                    <option value="Canada">Canada</option>
                    <option value="Cape Verde">Cape Verde</option>
                    <option value="Cayman Islands">Cayman Islands</option>
                    <option value="Central African Republic">Central African Republic</option>
                    <option value="Chad">Chad</option>
                    <option value="Chile">Chile</option>
                    <option value="China">China</option>
                    <option value="Christmas Island">Christmas Island</option>
                    <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                    <option value="Colombia">Colombia</option>
                    <option value="Comoros">Comoros</option>
                    <option value="Congo">Congo</option>
                    <option value="Congo, Democratic Republic of the Congo">Congo, Democratic Republic of the Congo</option>
                    <option value="Cook Islands">Cook Islands</option>
                    <option value="Costa Rica">Costa Rica</option>
                    <option value="Cote D'Ivoire">Cote D'Ivoire</option>
                    <option value="Croatia">Croatia</option>
                    <option value="Cuba">Cuba</option>
                    <option value="Curacao">Curacao</option>
                    <option value="Cyprus">Cyprus</option>
                    <option value="Czech Republic">Czech Republic</option>
                    <option value="Denmark">Denmark</option>
                    <option value="Djibouti">Djibouti</option>
                    <option value="Dominica">Dominica</option>
                    <option value="Dominican Republic">Dominican Republic</option>
                    <option value="Ecuador">Ecuador</option>
                    <option value="Egypt">Egypt</option>
                    <option value="El Salvador">El Salvador</option>
                    <option value="Equatorial Guinea">Equatorial Guinea</option>
                    <option value="Eritrea">Eritrea</option>
                    <option value="Estonia">Estonia</option>
                    <option value="Ethiopia">Ethiopia</option>
                    <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                    <option value="Faroe Islands">Faroe Islands</option>
                    <option value="Fiji">Fiji</option>
                    <option value="Finland">Finland</option>
                    <option value="France">France</option>
                    <option value="French Guiana">French Guiana</option>
                    <option value="French Polynesia">French Polynesia</option>
                    <option value="French Southern Territories">French Southern Territories</option>
                    <option value="Gabon">Gabon</option>
                    <option value="Gambia">Gambia</option>
                    <option value="Georgia">Georgia</option>
                    <option value="Germany">Germany</option>
                    <option value="Ghana">Ghana</option>
                    <option value="Gibraltar">Gibraltar</option>
                    <option value="Greece">Greece</option>
                    <option value="Greenland">Greenland</option>
                    <option value="Grenada">Grenada</option>
                    <option value="Guadeloupe">Guadeloupe</option>
                    <option value="Guam">Guam</option>
                    <option value="Guatemala">Guatemala</option>
                    <option value="Guernsey">Guernsey</option>
                    <option value="Guinea">Guinea</option>
                    <option value="Guinea-Bissau">Guinea-Bissau</option>
                    <option value="Guyana">Guyana</option>
                    <option value="Haiti">Haiti</option>
                    <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
                    <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                    <option value="Honduras">Honduras</option>
                    <option value="Hong Kong">Hong Kong</option>
                    <option value="Hungary">Hungary</option>
                    <option value="Iceland">Iceland</option>
                    <option value="India">India</option>
                    <option value="Indonesia">Indonesia</option>
                    <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                    <option value="Iraq">Iraq</option>
                    <option value="Ireland">Ireland</option>
                    <option value="Isle of Man">Isle of Man</option>
                    <option value="Israel">Israel</option>
                    <option value="Italy">Italy</option>
                    <option value="Jamaica">Jamaica</option>
                    <option value="Japan">Japan</option>
                    <option value="Jersey">Jersey</option>
                    <option value="Jordan">Jordan</option>
                    <option value="Kazakhstan">Kazakhstan</option>
                    <option value="Kenya">Kenya</option>
                    <option value="Kiribati">Kiribati</option>
                    <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
                    <option value="Korea, Republic of">Korea, Republic of</option>
                    <option value="Kosovo">Kosovo</option>
                    <option value="Kuwait">Kuwait</option>
                    <option value="Kyrgyzstan">Kyrgyzstan</option>
                    <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                    <option value="Latvia">Latvia</option>
                    <option value="Lebanon">Lebanon</option>
                    <option value="Lesotho">Lesotho</option>
                    <option value="Liberia">Liberia</option>
                    <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                    <option value="Liechtenstein">Liechtenstein</option>
                    <option value="Lithuania">Lithuania</option>
                    <option value="Luxembourg">Luxembourg</option>
                    <option value="Macao">Macao</option>
                    <option value="Macedonia, the Former Yugoslav Republic of">Macedonia, the Former Yugoslav Republic of</option>
                    <option value="Madagascar">Madagascar</option>
                    <option value="Malawi">Malawi</option>
                    <option value="Malaysia">Malaysia</option>
                    <option value="Maldives">Maldives</option>
                    <option value="Mali">Mali</option>
                    <option value="Malta">Malta</option>
                    <option value="Marshall Islands">Marshall Islands</option>
                    <option value="Martinique">Martinique</option>
                    <option value="Mauritania">Mauritania</option>
                    <option value="Mauritius">Mauritius</option>
                    <option value="Mayotte">Mayotte</option>
                    <option value="Mexico">Mexico</option>
                    <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                    <option value="Moldova, Republic of">Moldova, Republic of</option>
                    <option value="Monaco">Monaco</option>
                    <option value="Mongolia">Mongolia</option>
                    <option value="Montenegro">Montenegro</option>
                    <option value="Montserrat">Montserrat</option>
                    <option value="Morocco">Morocco</option>
                    <option value="Mozambique">Mozambique</option>
                    <option value="Myanmar">Myanmar</option>
                    <option value="Namibia">Namibia</option>
                    <option value="Nauru">Nauru</option>
                    <option value="Nepal">Nepal</option>
                    <option value="Netherlands">Netherlands</option>
                    <option value="Netherlands Antilles">Netherlands Antilles</option>
                    <option value="New Caledonia">New Caledonia</option>
                    <option value="New Zealand">New Zealand</option>
                    <option value="Nicaragua">Nicaragua</option>
                    <option value="Niger">Niger</option>
                    <option value="Nigeria">Nigeria</option>
                    <option value="Niue">Niue</option>
                    <option value="Norfolk Island">Norfolk Island</option>
                    <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                    <option value="Norway">Norway</option>
                    <option value="Oman">Oman</option>
                    <option value="Pakistan">Pakistan</option>
                    <option value="Palau">Palau</option>
                    <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                    <option value="Panama">Panama</option>
                    <option value="Papua New Guinea">Papua New Guinea</option>
                    <option value="Paraguay">Paraguay</option>
                    <option value="Peru">Peru</option>
                    <option value="Philippines">Philippines</option>
                    <option value="Pitcairn">Pitcairn</option>
                    <option value="Poland">Poland</option>
                    <option value="Portugal">Portugal</option>
                    <option value="Puerto Rico">Puerto Rico</option>
                    <option value="Qatar">Qatar</option>
                    <option value="Reunion">Reunion</option>
                    <option value="Romania">Romania</option>
                    <option value="Russian Federation">Russian Federation</option>
                    <option value="Rwanda">Rwanda</option>
                    <option value="Saint Barthelemy">Saint Barthelemy</option>
                    <option value="Saint Helena">Saint Helena</option>
                    <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                    <option value="Saint Lucia">Saint Lucia</option>
                    <option value="Saint Martin">Saint Martin</option>
                    <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                    <option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
                    <option value="Samoa">Samoa</option>
                    <option value="San Marino">San Marino</option>
                    <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                    <option value="Saudi Arabia">Saudi Arabia</option>
                    <option value="Senegal">Senegal</option>
                    <option value="Serbia">Serbia</option>
                    <option value="Serbia and Montenegro">Serbia and Montenegro</option>
                    <option value="Seychelles">Seychelles</option>
                    <option value="Sierra Leone">Sierra Leone</option>
                    <option value="Singapore">Singapore</option>
                    <option value="Sint Maarten">Sint Maarten</option>
                    <option value="Slovakia">Slovakia</option>
                    <option value="Slovenia">Slovenia</option>
                    <option value="Solomon Islands">Solomon Islands</option>
                    <option value="Somalia">Somalia</option>
                    <option value="South Africa">South Africa</option>
                    <option value="South Georgia and the South Sandwich Islands">South Georgia and the South Sandwich Islands</option>
                    <option value="South Sudan">South Sudan</option>
                    <option value="Spain">Spain</option>
                    <option value="Sri Lanka">Sri Lanka</option>
                    <option value="Sudan">Sudan</option>
                    <option value="Suriname">Suriname</option>
                    <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                    <option value="Swaziland">Swaziland</option>
                    <option value="Sweden">Sweden</option>
                    <option value="Switzerland">Switzerland</option>
                    <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                    <option value="Taiwan, Province of China">Taiwan, Province of China</option>
                    <option value="Tajikistan">Tajikistan</option>
                    <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                    <option value="Thailand">Thailand</option>
                    <option value="Timor-Leste">Timor-Leste</option>
                    <option value="Togo">Togo</option>
                    <option value="Tokelau">Tokelau</option>
                    <option value="Tonga">Tonga</option>
                    <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                    <option value="Tunisia">Tunisia</option>
                    <option value="Turkey">Turkey</option>
                    <option value="Turkmenistan">Turkmenistan</option>
                    <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                    <option value="Tuvalu">Tuvalu</option>
                    <option value="Uganda">Uganda</option>
                    <option value="Ukraine">Ukraine</option>
                    <option value="United Arab Emirates">United Arab Emirates</option>
                    <option value="United Kingdom">United Kingdom</option>
                    <option value="United States">United States</option>
                    <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                    <option value="Uruguay">Uruguay</option>
                    <option value="Uzbekistan">Uzbekistan</option>
                    <option value="Vanuatu">Vanuatu</option>
                    <option value="Venezuela">Venezuela</option>
                    <option value="Viet Nam">Viet Nam</option>
                    <option value="Virgin Islands, British">Virgin Islands, British</option>
                    <option value="Virgin Islands, U.s.">Virgin Islands, U.s.</option>
                    <option value="Wallis and Futuna">Wallis and Futuna</option>
                    <option value="Western Sahara">Western Sahara</option>
                    <option value="Yemen">Yemen</option>
                    <option value="Zambia">Zambia</option>
                    <option value="Zimbabwe">Zimbabwe</option>
                    </select>

                    <label for="txtEmail"><b>Email:</b></label>
                    <!-- Sticky Form -->
                    <input class="input_fields" name = "txtEmail" type = "text" placeholder = "Please enter email"
                    value="<?php if (isset($_POST['txtEmail'])) echo $_POST['txtEmail']; ?>"/>

                    <label for="psw-txtPassword"><b>Password:</b></label>
                    <!-- Sticky Form -->
                    <input class="input_fields" name = "txtPassword" type = "password" placeholder = "Please enter password"
                    value="<?php if (isset($_POST['txtPassword'])) echo $_POST['txtPassword']; ?>"/>

                    <p>By creating an account you agree to all the <button style="vertical-align:baseline; padding:0px" type="submit" name="btnShowPrivacyPolicy" class="btn btn-link">Terms & Privacy</button> statements of Extreme Diving.</p>

                    <div class="form-group row">
                        <div class="col-sm-12">
                            <button type="submit" name = "btnRegister" class="btn_login-signup col-sm-3">SUBMIT</button>
                            <!-- (W3schools.com. 2021.) -->
                            <button type="submit" name = "btnCancel" class="btn_cancel col-sm-3" style="margin-left:90px">CANCEL</button>
                            <button type="submit" name = "btnBackToLogin" class="btn_back col-sm-3" style="margin-left:90px">GO TO LOGIN</button>
                        </div>
                    </div>        
                    <button type="submit" name = "btnBackToLanding" class="btn_back col-sm-12">BACK TO HOME</button>     
                </div> 
                <div class="row-spacing-reg"></div>                 
            </form>
        </div>
    </body>
</html>

<?php
//Establishing DB Connection
require_once("DBConn.php");
//Calling DBScriptExecution Class
$db_handle = new DBScriptExecution();

    if (isset($_POST['btnCancel']))
    {
        //Refresh Page
        header("Location: registration.php?");
        exit;
    }

    if (isset($_POST['btnBackToLanding']))
    {
        //Routing to landing screen
        header("Location: landingPage.php?");
        exit;
    }

    if (isset($_POST['btnShowPrivacyPolicy']))
    {
        //Routing to landing screen
        header("Location: privacy.php?");
        exit;
    }

    if (isset($_POST['btnBackToLogin']))
    {
        //Routing to login(index) screen
        header("Location: index.php?");
        exit;
    }

    if (isset($_POST['btnRegister']))
    {
        $FName = $_POST['txtFName'];
        $LName = $_POST['txtLName'];
        $email = $_POST['txtEmail'];
        $password = $_POST['txtPassword'];

        $address = $_POST['txtAddressLine'];
        $state = $_POST['txtState'];
        $postal = $_POST['txtPostal'];
        $country = $_POST['country'];

        global $completedAddress;
        $completedAddress .= $address;
        $completedAddress .= " ";
        $completedAddress .= $state;
        $completedAddress .= " ";
        $completedAddress .= $postal;
        $completedAddress .= " ";
        $completedAddress .= $country;


        //Converting user password input to MD5 hash
        $md5RegPassword = md5($password);

        //Email validation
        if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $email))
        {
            $modalTitle = "Email Validation Message";
            $modalBody = "Please ensure that you enter a valid email.";
            echo '<script type="text/javascript">
            $(document).ready(function(){
                $("#validationModal").modal("show");
            });
            </script>';   
        }
        else{
            //When all inputs filled
            if(!empty($FName) && !empty($LName) && !empty($email) && !empty($password) && !empty($address) && !empty($state) && !empty($postal) && !empty($country))
            {
                //Inserting user inputs into the Database
                $sql = "INSERT INTO tbl_User (FName, LName, Email, IsAdmin, DeliveryAddress, Password)
                VALUES ('$FName', '$LName', '$email', 0, '$completedAddress', '$md5RegPassword')";

                echo $completedAddress;
                echo $sql;

                if (!empty($sql))
                {
                    //If succeeds, route to login(index) page
                    $db_handle ->executeInsert($sql);
                    header("Location: index.php?");
                    exit;
                }
                //Fail safe code catch
                else {
                    $modalTitle = "Registration Error";
                    $modalBody = "Error Registering New User.";
                    echo '<script type="text/javascript">
                    $(document).ready(function(){
                        $("#validationModal").modal("show");
                    });
                    </script>';   
                }  
                    
            }
            //If inputs not all filled in, call modal popup and set pop data
            else if(empty($FName) || empty($LName) || empty($email) || empty($password) || empty($address) || empty($state) || empty($postal) || empty($country)) {
                $modalTitle = "Validation Message";
                $modalBody = "Please fill in all fields.";
                echo '<script type="text/javascript">
                $(document).ready(function(){
                    $("#validationModal").modal("show");
                });
                </script>';            
            }   
        }
     
    }    
?>

<!-- Responsive Bootstrap Modal HTML -->
<!-- (Stackpath.bootstrapcdn.com. 2021) -->
<html>
    <div class="modal" id="validationModal">
        <div class="modal-dialog">
            <div class="modal-content">
               <div class="modal-header modal_background">
                    <h5 class="modal-title"><?php echo $modalTitle?></h5>
                    <button type="button" class="close exit_modal" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img class="shopping_cart_icon" src="https://www.freeiconspng.com/uploads/orange-error-icon-0.png" alt="Please Sign In" /></a></td>  
                    <p style="text-align:center"><?php echo $modalBody?></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</html>

