<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Us</title>
  <link href='https://fonts.googleapis.com/css?family=Lato:400,100,300' rel='stylesheet' type='text/css'>
  <link href="https://fonts.googleapis.com/css?family=Oswald:200,400,700" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <link rel="stylesheet" href="styles.css">
</head>
<body>

<?php include_once 'header.php'; ?>

<section id="contactus" class="contactus-section">
  <div class="contactus-container">
    <h1 class="contactus-header">Contact Us</h1>
    
    <!-- Centered Contact Form -->
    <div class="contactus-form-container">
      <form id="contactus-form" class="form-horizontal" role="form" action="https://api.web3forms.com/submit" method="POST">
        <!-- Replace with your Access Key -->
        <input type="hidden" name="access_key" value="06049944-4119-4eda-8960-83387cb7fb46">

        <!-- Honeypot Spam Protection -->
        <input type="checkbox" name="botcheck" class="hidden" style="display: none;">

        <div class="form-group">
          <input type="text" class="form-control contactus-form-control" id="name" placeholder="Your Name" name="name" required>
        </div>
        <div class="form-group">
          <input type="email" class="form-control contactus-form-control" id="email" placeholder="Your Email" name="email" required>
        </div>
        <div class="form-group">
          <textarea class="form-control contactus-form-control" rows="5" placeholder="Your Message" name="message" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary contactus-send-button">Send Message</button>
        <div id="result"></div>
      </form>
    </div>

    <!-- Map and Contact Details Below Form -->
    <div class="contactus-info-container">
      <div class="contactus-map">
        <img src="img/map.png" alt="Our Location" class="contactus-map-image">
      </div>
      <div class="contactus-details">
        <p class="contactus-address"><i class="fa fa-map-marker"></i> 123 Main Street, Pitipana, Mahenwatta, Homagama</p>
        <p class="contactus-phone"><i class="fa fa-phone"></i> +94 11 255 25 25</p>
        <p class="contactus-email"><i class="fa fa-envelope"></i> <a href="mailto:vogueventures360@gmail.com">vogueventures360@gmail.com</a></p>
      </div>
    </div>
  </div>
</section>

<?php include_once 'footer.php'; ?>

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script>
<script>
document.getElementById('contactus-form').addEventListener('submit', function(e) {
  e.preventDefault();
  const form = e.target;
  const formData = new FormData(form);
  const object = Object.fromEntries(formData);
  const json = JSON.stringify(object);
  const result = document.getElementById('result');
  
  result.innerHTML = "Please wait...";

  fetch('https://api.web3forms.com/submit', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'Accept': 'application/json'
    },
    body: json
  })
  .then(async (response) => {
    let json = await response.json();
    if (response.status == 200) {
      result.innerHTML = "Form submitted successfully";
    } else {
      console.log(response);
      result.innerHTML = json.message;
    }
  })
  .catch(error => {
    console.log(error);
    result.innerHTML = "Something went wrong!";
  })
  .finally(() => {
    form.reset();
    setTimeout(() => {
      result.style.display = "none";
    }, 3000);
  });
});
</script>

</body>
</html>
