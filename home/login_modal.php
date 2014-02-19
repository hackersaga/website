 <div id="login_box" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <!-- header of the login box -->
                <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <div id="login_title"><h3 class="login_form">Sign in</h3></div>
                </div>
                <!-- Body of the login box -->
                <div id="loginBodysignin" class="modal-body form-horizontal">
                        <div id="inputForm">
                                <div class="control-group">
                                        <label class="control-label" for="inputEmail">Email</label>
                                        <div class="controls">
                                                <input type="email" name="email" id="inputEmail" placeholder="Email address"  autocomplete="on" class="normal_font">
                                        </div>
                                </div>
                                <div class="control-group">
                                        <label class="control-label" for="inputPassword">Password</label>
                                        <div class="controls">
                                                <input type="password" name="passwd" id="inputPassword" placeholder="Password" >
                                                
                                        </div>
                                </div>
                        </div>

                <div id="login_me" >
                        <div id="signin_error"></div>
                        <div id="signin_gif" class="hide"><img src="../img/ajax_loader.gif"></div>
                        <div id="button_sign_in" onclick="signin()"><img src="../img/item/sign_in_button.png" disabled></div>
                        <div id="new_user" onclick="loadsignup()">New user? Register here </div>
                </div>
                </div>
                <!-- footer element of the login box-->
                <div id="loginBodysignup" class="modal-body hide form-horizontal">

                        <div id="inputForm">
                                <div class="control-group">
                                        <label class="control-label" for="sinputName">First Name</label>
                                        <div class="controls">
                                                <input type="text" name="name" id="sinputfirstName" placeholder="First Name"  autocomplete="off" class="normal_font">
                                        </div>
                                </div>
                                <div class="control-group">
                                        <label class="control-label" for="sinputName">Last Name</label>
                                        <div class="controls">
                                                <input type="text" name="name" id="sinputlastName" placeholder="Last Name"  autocomplete="off" class="normal_font">
                                        </div>
                                </div>                                

                                <div class="control-group">
                                        <label class="control-label" for="sinputEmail">Email</label>
                                        <div class="controls">
                                                <input type="email" name="email" id="sinputEmail" placeholder="Email address"  autocomplete="on" class="normal_font">
                                        </div>
                                </div>
                                <div class="control-group">
                                        <label class="control-label" for="sinputPassword">Password</label>
                                        <div class="controls">
                                                <input type="password" name="passwd" id="sinputPassword" placeholder="Password" >
                                                
                                        </div>
                                </div>
                                <div class="control-group">
                                        <label class="control-label" for="sinputConfirmPassword">Confirm Password</label>
                                        <div class="controls">
                                                <input type="password" name="confirmPasswd" id="sinputConfirmPassword" placeholder="Confirm Password" >
                                                
                                        </div>
                                </div>
                                <div class="control-group">
                                        <label class="control-label" for="sinputGender">Gender</label>
                                        <div class="controls">
                                                <label class="radio" style="display:inline-block">
                                                     <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                                                     Female
                                                </label>
                                                <label class="radio"  style="display:inline-block">
                                                     <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                                                     Male
                                                </label>
                                        </div>
                                </div>
                        </div>
                <div id="login_me" >
                        <div id="signup_error"></div>
                        <div id="signup_gif" class="hide"><img src="../img/ajax_loader.gif"></div>
                        <div id="button_sign_up" onclick="signup()"><img src="../img/item/sign_up_button.png"></div>
                        <div id="old_user" onclick="loadsignin()">Already registered? Login here </div>
                </div>
                </div>
</div>
  
