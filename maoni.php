<!DOCTYPE html>
<html lang="en">
<head>
        <script defer src="js/solid.js"></script>
        <script defer src="js/fontawesome.js"></script>
        <script src="js/jquery.slim.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/jquery-3.2.1.slim.min.js"></script>
        <script type="text/javascript" src="js/main.js"></script>
        <script type="text/javascript" src="js/PSGC.js"></script>
        <script type="text/javascript" src="js/jquery.min.js"></script>

</head>
<body>

	<form action="maoni.php" method="post">
        <div class="form-group row">
            <label class="col-sm-2 label" style="font-size: 20px">Birth Date: </label>
            <div class="col-sm-6">
                <input type="date" class="form-control mr-sm-2" id="birthday" name="birthday" placeholder="Birth Date" max='<?php echo date("Y-m-d") ?>' required>
            </div>
            <label class="col-sm-1 label" style="font-size: 20px">Age: </label>
            <div class="col-sm-3">
                <input type="number" class="form-control mr-sm-2" id="age" placeholder="Age" disabled>
                <input type="number" class="form-control mr-sm-2" id="hidden_age" name="age" placeholder="Age" hidden>
            </div>
        </div>
        <button type="submit" name="save">GO !!!</button>
    </form>
	
</html>

<?php
    if(isset($_POST['save'])){
        $con = mysqli_connect("localhost", "root", "", "cpms");
        $bday = $_POST['birthday']; 
        $age = $_POST['age']; 

        echo $age;

        //echo $amount ."<br>". $id;
        //potang_ina($amount, $id);
    }


    function potang_ina($bday, $age){
        $con = mysqli_connect("localhost", "root", "", "cpms");
        $sqlquery="INSERT INTO birth (bday, age) VALUES ($bday, $age)}";
        //checking if the username is available in the table
        $result = mysqli_query($con,$sqlquery);
        
        if($result){
            echo "<script>alert('POTANG INA!')</script>";
        }else{
            echo "<script>alert('WA mn pod!')</script>";
        }

    }

?>
<script>
    function calculateage(dob) {
            var diff_ms = Date.now() - dob.getTime(); // Get difference in milliseconds
            var age_dt = new Date(diff_ms); // Create a new Date object representing the difference
            
            var years = age_dt.getUTCFullYear() - 1970; // Calculate the number of years
            var months = age_dt.getUTCMonth() + 1; // Get the number of months
            var days = age_dt.getUTCDate() - 1; // Get the number of days
            // console.log("Age: "+ years+ " years, "+ months + " months, and " + days + " days");
            if (years >= 0 && months > 11 && days > 0 ) {
                years += 1;
            }
            if (years < 0 ) {
                years = 0;
            }
            return years;
        }
        
        $(function () {
            $("#birthday").on("change", function () {
                var bd = $("#birthday").val();
                explodebd = bd.split("-");
                age = calculateage(new Date(explodebd[0],explodebd[1],explodebd[2]))
                
                var age1 = age.toString();

                document.getElementById("age").value = age1;
                document.getElementById("hidden_age").value = age1;
            }); 
        });
</script>