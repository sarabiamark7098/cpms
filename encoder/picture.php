<?php
include('../php/class.user.php');
$user = new User();

$id = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : null;
if ($id) {
    $img = $user->getClientImage($id);
    $client = $user->getClientData($id);

    $middlenameInitial = !empty($client['middlename']) ? $client['middlename'][0] . "." : "";
    $name = trim("{$client['firstname']} $middlenameInitial {$client['lastname']} {$client['extraname']}");
} else {
    die("No client ID provided.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Cache-Control" content="no-cache">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/png" href="../images/icons/ciu.ico"/>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/font-awesome.min.css">    
    <link rel="stylesheet" href="../css/table.responsive.css">
    <link rel="stylesheet" href="../style5.css">
    <script defer src="../js/solid.js"></script>
    <script defer src="../js/fontawesome.js"></script>
    <script src="../js/jquery-3.2.1.slim.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../js/jquery.min.js"></script>

    <style>
        #camera {
            width: 100%;
            height: 350px;
        }
        .col-centered {
            float: none;
            margin: 0 auto;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark" style="position: fixed; width: 100%; z-index:100; background: #6d7fcc;">
    <a href="home.php"><img src="../images/dswd-logo_final.png" alt="DSWD Logo" width="200" height="55"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
        <span class="navbar-toggler-icon"></span>
    </button>
</nav>

<div class="container">
    <br><br><br><br>
    <div class="row text-center">
        <div class="col-md-4">
            <video id="camera" autoplay playsinline class="border border-info" width="100%" height="350"></video>
            <canvas id="snapshot" style="display: none;"></canvas><br>
            <h3>Client's Name: <?php echo $name ?></h3>
        </div>

        <div class="col-md-2" style="margin:15px">
            <br>
            <?php if ($img != "../images/noAvatar.png"): ?>
                <div class="row"><button id="re_take" class="btn btn-warning btn-block"><i class="fa fa-camera"></i> Re-Take</button></div><br>
                <div class="row"><button id="done" class="btn btn-success btn-block"><i class="fa fa-check"></i> Done</button></div>
            <?php else: ?>
                <div class="row"><button id="take_snapshots" class="btn btn-warning btn-block"><i class="fa fa-camera"></i> Take Snapshot</button></div>
            <?php endif; ?>
        </div>

        <div class="col-md-5">
            <img class="border border-success" id="image" src="<?php echo $img ?>" width="100%" height="350px">
        </div>
    </div><br>
</div>

<script src="../js/jpeg_camera_with_dependencies.min.js"></script>
<script>
    let video = document.getElementById('camera');
    let canvas = document.getElementById('snapshot');

    // Start the camera
    navigator.mediaDevices.getUserMedia({ video: true })
    .then(stream => {
        video.srcObject = stream;
    })
    .catch(err => {
        alert("Camera not accessible: " + err.message);
    });

    // Function to upload the snapshot
    function uploadSnapshot(doValue = 0) {
        // Set canvas dimensions to match the video
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        // Draw the current frame from the video onto the canvas
        canvas.getContext('2d').drawImage(video, 0, 0);

        // Convert the canvas image to a Base64-encoded PNG
        const imageData = canvas.toDataURL('../clientImages/png');
        // Send the image data to the server via AJAX
        $.ajax({
            type: 'POST',
            url: 'upload_photo.php',
            data: {
                image: imageData,
                id: '<?php echo $_GET["id"]; ?>',
                do: doValue
            },
            success: function(response) {
                console.log('Upload success:', response);
                alert('Photo uploaded successfully!');
                location.reload();
            },
            error: function(error) {
                console.error('Upload failed:', error);
                alert('Upload failed: ' + error);
            }
        });
    }

    // Event listeners
    document.getElementById('take_snapshots')?.addEventListener('click', () => uploadSnapshot(0));
    document.getElementById('re_take')?.addEventListener('click', () => uploadSnapshot(1));
    document.getElementById('done')?.addEventListener('click', () => {
        alert('Client Successfully Saved!');
        window.location.href = "home.php";
    });
</script>
</body>
</html>
