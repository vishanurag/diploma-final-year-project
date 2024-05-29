<!-- Footer-Section -->
<div class="bg-light">
  <div class="container-fluid paper-cut-look bg-black text-light rounded pt-5 pb-3">
    <div class="py-md-5 my-md-5"></div>
    <footer class="w-100 d-flex flex-column flex-md-row justify-content-evenly align-items-center gap-5">
      <div class="footer-left">
        <div class="brand-info">
          <div class="brand-main-logo-icons flex-column d-flex align-items-start justify-content-evenly gap-3">
          <img src="./src/assets/images/di-ai-gen-logo.png" alt="" class="img header-logo">
          <div class="">
          <h1 class="h1 lobster-regular">
            DiAIGen...
          </h1>
          <p class="orbitron-simple">An AI Based Website Builder.</p>
          </div>
          </div>
          <div class="social-accounts d-flex w-25 align-items-center justify-content-start gap-3">
            <a href="https://github.com/vishanurag/" target="_blank" class="social-acc-links btn rounded-circle bg-light w-25 p-0 d-flex align-items-center justify-content-center" id="github">
              <img src="./src/assets/images/github.jpeg" class="w-100 rounded-circle" alt="Links">
            </a>
            <a href="https://linkedin.com/in/anuragvishwakarma/" target="_blank" class="social-acc-links btn rounded-circle bg-light w-25 p-0 d-flex align-items-center justify-content-center" id="email">
              <img src="./src/assets/images/linkedin.webp" class="w-100 rounded-circle" alt="Links">
            </a>
            <a href="mailto:21brac0401@polygwalior.ac.in" target="_blank" class="social-acc-links btn rounded-circle bg-light w-25 p-0 d-flex align-items-center justify-content-center" id="linkedin">
              <img src="./src/assets/images/gmail.png" class="w-100 rounded-circle" alt="Links">
            </a>
          </div>
        </div>
      </div>
      <div class="footer-mid">
        <h2 class="h2 orbitron-simple">
          Important Links
        </h2>
        <div class="all-important-links">
          <a href="./#About-Us" class="nav-link">About Us</a>
          <a href="./#Our-Services" class="nav-link">Our Services</a>
          <a href="" class="nav-link">Pricing</a>
          <a href="" class="nav-link">Generate Website</a>
          <a href="" class="nav-link">Polygwalior</a>
        </div>
      </div>
      <div class="footer-right">
        <h2 class="h2 orbitron-simple">
          Get In Touch
        </h2>
        <div class="d-flex flex-column justify-content-center align-items-center">
          <div class="input-boxes d-flex flex-column justify-content-center gap-2">
            <label for="name-box">
              <input type="text" id="name-box" class="form-control" placeholder="Your Name" >
            </label>
            <label for="name-box">
              <input type="email" id="email-box" class="form-control" placeholder="user@email.com" >
            </label>
            <label for="message-box">
              <textarea type="text" id="message-box" class="form-control" placeholder="Your Message here..." ></textarea>
            </label>
          </div>
          <span id="footer-form-result" class="py-2"></span>
          <button  class="btn btn-primary align-self-start my-3 mx-1" id="footer-form-submit-btn" onclick="submitFormAjax()">Submit</button>
        </div>
      </div>
    </footer>
    <p class="small text-center mt-5 pt-2">
      This website is a project build by Anurag Vishwakarma, Anuj Gupta & Aditya Bisht as a Final Year Project in Department of Computer Science & Engineering with the guidence of Dr. Saurabh Khare.
    </p>
  </div>
</div>


<script>
  let footerFormRes = document.getElementById('footer-form-result');
  let footerFormName = document.getElementById('name-box');
  let footerFormEmail = document.getElementById('email-box');
  let footerFormMessage = document.getElementById('message-box');

  const submitFormAjax = ()=> {
    if(footerFormMessage.value == '' || footerFormEmail.value == '' || footerFormName.value == '') {
      footerFormRes.innerHTML = '<span class="text-danger">All the field must be filled properly...</span>';
      return;
    }
    footerFormRes.innerHTML = `<img width='50' height='50' src='./src/assets/animations/loading.gif'>`;
    
    let xhttp = new XMLHttpRequest();
    xhttp.open('POST', './get-in-touch.php', true);
    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhttp.send(`name=${footerFormName.value}&email=${footerFormEmail.value}&message=${footerFormMessage.value}&which=get-in-touch`);
    xhttp.onreadystatechange = ()=> {
      if (xhttp.readyState == 4 && xhttp.status == 200) {
        footerFormRes.innerHTML = `${xhttp.responseText}`;
      }
    }
  }
</script>
<!-- Footer-Section -->