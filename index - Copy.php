<?php
session_start();
include("header.php");
?>
    <div class="slider_top">
      <div class="header_text">
        <div class="gallery">
          <div id="slider">
            <ul>
              <li> <img src="images/simple_img_1.jpg" alt="screen 1" width="960" height="323" border="0" class="screen"  /> </li>
              <li> <img src="images/simple_img_2.jpg" alt="screen 1" width="960" height="323" border="0" class="screen"  /> </li>
              <li> <img src="images/simple_img_3.jpg" alt="screen 1" width="960" height="323" border="0" class="screen"  /> </li>
            </ul>
          </div>
        </div>
        <div class="clr"></div>
      </div>
    </div>
    <div class="clr"></div>
    <div class="body_resize">
        <div class="blog">
          <h2>Web Development</h2>
          <img src="images/top_img_1.gif" alt="picture" width="59" height="59" />
          <p>Fusce vehicula dignissim ligula. <br />
            Vestibulum sit amet neque eu neque suscipit consequat quis vel risus. </p>
          <p><a href="#">&gt;&gt; More information</a></p>
        </div>
        <div class="blog">
          <h2>Quality Products</h2>
          <img src="images/top_img_2.gif" alt="picture" width="59" height="59" />
          <p>Fusce vehicula dignissim ligula. <br />
            Vestibulum sit amet neque eu neque suscipit consequat quis vel risus. </p>
          <p><a href="#">&gt;&gt; More information</a></p>
        </div>
        <div class="blog">
          <h2>Best Business System</h2>
          <img src="images/top_img_3.gif" alt="picture" width="59" height="59" />
          <p>Fusce vehicula dignissim ligula. <br />
            Vestibulum sit amet neque eu neque suscipit consequat quis vel risus. </p>
          <p><a href="#">&gt;&gt; More information</a></p>
        </div>
        <div class="clr"></div>
              <div class="body">
        <div class="right">
          <h2 class="what">Administrator login</h2>
          <img src="images/test_1.gif" alt="picture" width="62" height="62" />
          <p>&quot;Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur ?&quot;</p>
          <p><strong>by: John S., businessman</strong></p>
          <div class="bg"></div>
</div>
         <div class="right">
          <h2 class="News">Teachers login</h2>
          <p><span><strong>14 / April / 09</strong></span><br />
           Listuem Names ligula a blandit ornare, ligula a quis bibendum. <a href="#">&gt;&gt;</a></p>
          <p><span><strong>14 / April / 09</strong></span><br />
           Listuem Names ligula a bla</p>
         </div>
         <div class="right">
          <h2 class="Welco"> Students login</h2>
          <div class="clr"></div>
          <p><strong>Please enter User name and password. </strong><br />
			<table>
			  <tr>
			    <th>Username</th>
			    <td><input type=text id="username" name="username" class="text" /></td>
		      </tr>
			  <tr>
			    <th>Password</th>
			    <td><input type="password" id="password" name="password" class="text" /></td>
		      </tr>
			  <tr>
			    <th colspan="2">&nbsp;<input type="submit" id="submit" name="submit" class="text" value="Login" /></th>
		      </tr>
	       </table>
			</p>
</div>
        <div class="clr"></div>
      </div>
    </div>
<?php
include("footer.php");
?>