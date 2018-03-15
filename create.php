<?php
// Include config file
require_once 'config.php';
 
// Define variables and initialize with empty values
$name = $address = $salary = "";
$name_err = $address_err = $salary_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate name
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Please enter a name.";
    } elseif(!filter_var(trim($_POST["name"]), FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z'-.\s ]+$/")))){
        $name_err = 'Please enter a valid name.';
    } else{
        $name = $input_name;
    }
    
    // Validate eventdate
    $input_eventdate = trim($_POST["eventdate"]);
    if(empty($input_eventdate)){
        $eventdate_err = 'Please enter a date(DD/MM/YYYY)';     
    } else{
        $eventdate = $input_eventdate;
    }
    
    // Validate description
    $input_description = trim($_POST["description"]);
    if(empty($input_description)){
        $description_err = 'Please enter a description.';     
    } else{
        $description = $input_description;
    }
    
    // Validate street
    $input_street = trim($_POST["street"]);
    if(empty($input_street)){
        $street_err = 'Please enter a street.';     
    } else{
        $street = $input_street;
    }
    
    // Validate zipcode
    $input_zipcode = trim($_POST["zipcode"]);
    if(empty($input_zipcode)){
        $zipcode_err = 'Please enter a zipcode.';     
    } else{
        $zipcode = $input_zipcode;
    }
    
    // Validate city
    $input_city = trim($_POST["city"]);
    if(empty($input_city)){
        $city_err = 'Please enter a city.';     
    } else{
        $city = $input_city;
    }
    
    // Validate email
    $input_email = trim($_POST["email"]);
    if(empty($input_email)){
        $email_err = 'Please enter an email address.';     
    } else{
        $email = $input_email;
    }
    
    // Validate phone
    $input_phone = trim($_POST["phone"]);
    if(empty($input_phone)){
        $phone_err = 'Please enter a phone number.';     
    } else{
        $phone = $input_phone;
    }
    
    // Validate image
    $input_image = trim($_POST["image"]);
    if(empty($input_image)){
        $image_err = 'Please enter an image.';     
    } else{
        $image = $input_image;
    }
    
    // Validate capacity
    $input_capacity = trim($_POST["capacity"]);
    if(empty($input_capacity)){
        $capacity_err = 'Please enter a capacity.';     
    } else{
        $capacity = $input_capacity;
    }
    
    // Validate address
    $input_type = trim($_POST["type"]);
    if(empty($input_type)){
        $type_err = 'Please enter a type.';     
    } else{
        $type = $input_type;
    }
    
    // Validate URL
    $input_URL = trim($_POST["URL"]);
    if(empty($input_URL)){
        $URL_err = 'Please enter an URL.';     
    } else{
        $URL = $input_URL;
    }
    
  
    // Check input errors before inserting in database
    if(empty($name_err) && empty($eventdate_err) && empty($description_err) && empty($street_err) && empty($zipcode_err) && empty($city_err) && empty($email_err) && empty($phone_err) && empty($image_err) && empty($capacity_err) && empty($type_err) && empty($URL_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO events (name, eventdate, description, streeet, zipcode, city, email, phone, image, capacity, type, URL) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_name, $param_eventdate, $param_description, $param_street, $param_zipcode, $param_city, $param_email, $param_phone, $param_image, $param_capacity, $param_type, $param_URL);
            
            // Set parameters
            $param_name = $name;
            $param_eventdate = $eventdate;
            $param_description = $description;
            $param_street = $street;
            $param_zipcode = $zipcode;
            $param_city = $city;
             $param_email = $email;
            $param_phone = $phone;
            $param_image = $image;
             $param_capacity = $capacity;
            $param_type = $type;
            $param_URL = $URL;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Create Event</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
        <style type="text/css">
            .wrapper {
                width: 500px;
                margin: 0 auto;
            }

        </style>
    </head>

    <body>
        <div class="wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="page-header">
                            <h2>Create Event</h2>
                        </div>
                        <p>Please fill this form and submit to add events to the database.</p>
                        <form action="<?php echo htmlspecialchars($_SERVER[" PHP_SELF "]); ?>" method="post">
                            <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                                <span class="help-block"><?php echo $name_err;?></span>
                            </div>
                            <div class="form-group <?php echo (!empty($eventdate_err)) ? 'has-error' : ''; ?>">
                                <label>Eventdate</label>
                                <input type="text" name="eventdate" class="form-control" value="<?php echo $eventdate; ?>">
                                <span class="help-block"><?php echo $eventdate_err;?></span>
                            </div>

                            <div class="form-group <?php echo (!empty($description_err)) ? 'has-error' : ''; ?>">
                                <label>Description</label>
                                <input type="text" name="description" class="form-control" value="<?php echo $description; ?>">
                                <span class="help-block"><?php echo $description_err;?></span>
                            </div>
                            <div class="form-group <?php echo (!empty($street_err)) ? 'has-error' : ''; ?>">
                                <label>Street</label>
                                <input type="text" name="street" class="form-control" value="<?php echo $street; ?>">
                                <span class="help-block"><?php echo $street_err;?></span>
                            </div>
                            <div class="form-group <?php echo (!empty($zipcoe_err)) ? 'has-error' : ''; ?>">
                                <label>Zipcode</label>
                                <textarea name="zipcode" class="form-control"><?php echo $zipcode; ?></textarea>
                                <span class="help-block"><?php echo $zipcode_err;?></span>
                            </div>
                            <div class="form-group <?php echo (!empty($city_err)) ? 'has-error' : ''; ?>">
                                <label>City</label>
                                <input type="text" name="city" class="form-control" value="<?php echo $city; ?>">
                                <span class="help-block"><?php echo $city_err;?></span>
                            </div>
                            <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                                <label>Email</label>
                                <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
                                <span class="help-block"><?php echo $email_err;?></span>
                            </div>
                            <div class="form-group <?php echo (!empty($phone_err)) ? 'has-error' : ''; ?>">
                                <label>Phone</label>
                                <textarea name="phone" class="form-control"><?php echo $phone; ?></textarea>
                                <span class="help-block"><?php echo $phone_err;?></span>
                            </div>
                            <div class="form-group <?php echo (!empty($image_err)) ? 'has-error' : ''; ?>">
                                <label>Image</label>
                                <input type="text" name="image" class="form-control" value="<?php echo $image; ?>">
                                <span class="help-block"><?php echo $image_err;?></span>
                            </div>
                            <div class="form-group <?php echo (!empty($capacity_err)) ? 'has-error' : ''; ?>">
                                <label>Capacity</label>
                                <input type="text" name="capacity" class="form-control" value="<?php echo $capacity; ?>">
                                <span class="help-block"><?php echo $capacity_err;?></span>
                            </div>
                            <div class="form-group <?php echo (!empty($type_err)) ? 'has-error' : ''; ?>">
                                <label>Type</label>
                                <textarea name="type" class="form-control"><?php echo $type; ?></textarea>
                                <span class="help-block"><?php echo $type_err;?></span>
                            </div>
                            <div class="form-group <?php echo (!empty($URL_err)) ? 'has-error' : ''; ?>">
                                <label>URL</label>
                                <input type="text" name="URL" class="form-control" value="<?php echo $URL; ?>">
                                <span class="help-block"><?php echo $URL_err;?></span>
                            </div>
                            <input type="submit" class="btn btn-primary" value="Submit">
                            <a href="index.php" class="btn btn-default">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>

    </html>
