<?php
session_start();
include("header.php");
?>
    <div class="slider_top2">
<h2>Services</h2>
<p>“It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.Content here, content here', making it look like readable English.”<br />
  <a href="#">by: John S., businessman</a></p>
    </div>
    <div class="clr"></div>
    <div class="body_resize">
              <div class="body">
              <div class="left">
              <h2 class="cont">        Contact Company</h2>
              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. <br />
                Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took <br />
                a galley of type and scrambled it to make a type specimen book. </p>
                <div class="bg"></div>
      <form action="contact.php" method="post" id="contactform">
          <ol>
            <li>
              <label for="name">First Name <span class="red">*</span></label>
              <input id="name" name="name" class="text" />
            </li>
            <li>
              <label for="email">Your email <span class="red">*</span></label>
              <input id="email" name="email" class="text" />
            </li>
            <li>
              <label for="company">Company</label>
              <input id="company" name="company" class="text" />
            </li>
            <li>
              <label for="subject">Subject</label>
              <input id="subject" name="subject" class="text" />
            </li>
            <li>
              <label for="message">Message <span class="red">*</span></label>
              <textarea id="message" name="message" rows="6" cols="50"></textarea>
            </li>
            <li class="buttons">
              <input type="image" name="imageField" id="imageField" src="images/send.gif" />
            </li>
          </ol>
        </form>
              </div>
        
         <div class="right">
          <h2 class="News">Details Contact</h2>
            <p><span><strong>Address: </strong></span>        Sample Road, Greenvalley<br />
            <span><strong>Telephone:</strong></span>     +123-1234-5678<br />
            <span><strong>FAX:</strong></span>                +458-4578<br />
            <span><strong>Others:</strong></span>          +301 - 0125 - 01258<br />
          <span> <strong>E-mail:</strong></span>             mail@yoursitename.com</p>
          <div class="bg"></div>
          <img src="images/map.jpg" alt="picture" width="270" height="194" /></div>
         
        <div class="clr"></div>
      </div>
    </div>
<?php
include("footer.php");
?>