<html>
    <head>
        <title>Multi Step Registration</title>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/style.css">

        <!--<script src="http://code.jquery.com/jquery-1.10.2.js"></script>-->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

        

    </head>
    <body>

        <ul id="signup-step">
            <li id="personal" class="active">1</li>
            <li id="password">2</li>
            <li id="contact">3</li>
        </ul>

        <?php
        if (isset($success)) {
            echo '<div>'.$success.'</div>';
        }

        
        ?>
        <form name="frmRegistration" id="signup-form" action="<?=base_url('UserController/add')?>" method="post">

        <div id="personal-field">
            <label>Company Name</label><span id="name-error" class="signup-error"></span>
            <div><input type="text" name="name" id="name" class="demoInputBox"/></div>
            <label>Email</label><span id="email-error" class="signup-error"></span>
            <div><input type="text" name="email" id="email" class="demoInputBox" /></div>
            <label>No. of Employees</label><span id="employees-error" class="signup-error"></span>
            <div>
            	<input type="number" name="employees" id="employees" class="demoInputBox" />
            </div>
            <label>Location</label><span id="location-error" class="signup-error"></span>
            <div>
                <select name="location" id="location" class="demoInputBox">
                	<option value="">--Select Location---</option>
                	<?php if(!empty($cities)){ foreach ($cities as $u) { ?>
	                    <option value="<?=$u->id?>"><?=$u->city?></option>
	                <?php } } ?>            
                </select>
            </div>
            <label>Average age of Employees</label>
            <span id="average_age-error" class="signup-error"></span>
            <div>
                <select name="average_age" id="average_age" class="demoInputBox">
                    <option>--Select--</option>
                    <option value="19-24 Years">19-24 Years</option>
                    <option value="25-34 Years">25-34 Years</option> 
                    <option value="35-44 Years">35-44 Years</option>
                    <option value=">45 Years">&gt;45 Years</option> 
                </select>
            </div>
            <label><b>Coverage For</b></label><span id="coverage-error" class="signup-error"></span>
            <div><input type="radio" id="emp" name="coverage" value="1">
				<label>Employee Only</label><br>
				<input type="radio" id="spouse" name="coverage" value="2">
				<label >Employee, Spouse & Children</label><br>
				<input type="radio" id="parents" name="coverage" value="3">
				<label >Employee, Spouse, Children & Parents</label>
			</div>
        </div>

        <div id="password-field" style="display:none;">
            <label>Investment</label><span id="invest-error" class="signup-error"></span>
            <div><input type="radio" id="1_Lacs" name="invest" value="100000">
				<label>1 Lacs</label><br>
				<input type="radio" id="3_Lacs" name="invest" value="300000">
				<label>3 Lacs</label><br>
				<input type="radio" id="5_Lacs" name="invest" value="500000">
				<label>5 Lacs</label>
			</div>
        </div>

        <div id="contact-field" style="display:none;">
            <label>Contact No</label><span id="phone-error" class="signup-error"></span>
            <div><input type="number" name="phone" id="phone" class="demoInputBox" /></div>
        </div>

        <div>
            <input class="btnAction" type="button" name="back" id="back" value="Back" style="display:none;">
            <input class="btnAction" type="button" name="next" id="next" value="Next" >
            <input class="btnAction" type="submit" name="submit" id="finish" value="Submit" style="display:none;">
        </div>
        </form>

    </body>

    <script>
            function validate() {
                var output = true;
                $(".signup-error").html('');

                if ($("#personal-field").css('display') != 'none') {
                    if (!($("#name").val())) {
                        output = false;
                        $("#name-error").html("Please enter Company Name..!");
                    }

                    if (!($("#email").val())) {
                        output = false;
                        $("#email-error").html("Please enter Email..!");
                    }

                    if (!$("#email").val().match(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/)) {
                        $("#email-error").html("Invalid Email..!");
                        output = false;
                    }

                    if (!($("#employees").val())) {
                        output = false;
                        $("#employees-error").html("Please enter number of employees..!");
                    }

                    if (!($("#location").val())) {
                        output = false;
                        $("#location-error").html("Please select location..!");
                    }

                    if ($("#average_age").val()== '--Select--') {
                        output = false;
                        $("#average_age-error").html("Please select Average age..!");
                    }

                    if ($("input[name='coverage']:checked").val() == 'undefined') {
                        output = false;
                        $("#coverage-error").html("Please select coverage for..!");
                    }


                    
                }

                if ($("#password-field").css('display') != 'none') {
                    if ($("input[name='invest']:checked").val() == 'undefined') {
                        output = false;
                        $("#invest-error").html("Please select investment ..!");
                    }
                   
                }

                if ($("#contact-field").css('display') != 'none') {
                    if (!($("#phone").val())) {
                        output = false;
                        $("#phone-error").html("Phone required!");
                    }
                }

                return output;
            }

            $(document).ready(function () {
                $("#next").click(function () {
                    var output = validate();
                    if (output === true) {
                        var current = $(".active");
                        var next = $(".active").next("li");
                        if (next.length > 0) {
                            $("#" + current.attr("id") + "-field").hide();
                            $("#" + next.attr("id") + "-field").show();
                            $("#back").show();
                            $("#finish").hide();
                            $(".active").removeClass("active");
                            next.addClass("active");
                            if ($(".active").attr("id") == $("li").last().attr("id")) {
                                $("#next").hide();
                                $("#finish").show();
                            }
                        }
                    }
                });


                $("#back").click(function () {
                    var current = $(".active");
                    var prev = $(".active").prev("li");
                    if (prev.length > 0) {
                        $("#" + current.attr("id") + "-field").hide();
                        $("#" + prev.attr("id") + "-field").show();
                        $("#next").show();
                        $("#finish").hide();
                        $(".active").removeClass("active");
                        prev.addClass("active");
                        if ($(".active").attr("id") == $("li").first().attr("id")) {
                            $("#back").hide();
                        }
                    }
                });

                $("input#finish").click(function (e) {
                    var output = validate();
                    var current = $(".active");

                    if (output === true) {
                    	var no_of_employees = $("#employees").val();
                    	var rate = (1.5 * 10) / 1000;
                    	var sum_of_assured = $("input[name='invest']:checked").val();
                    	var Premium_Logic = sum_of_assured * no_of_employees * rate;
                    	alert('Premium :' + Premium_Logic);		
                        return true;
                    } else {
                        //prevent refresh
                        e.preventDefault();
                        $("#" + current.attr("id") + "-field").show();
                        $("#back").show();
                        $("#finish").show();
                    }
                });
            });
        </script>
</html>