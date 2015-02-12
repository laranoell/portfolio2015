<?php error_reporting(~0); ini_set('display_errors', 1);
  $errors = array();
  $success = false;
  $email ='';
  $message = '';
  $budget = '';
  $time = '';
  if(isset($_POST['check'])) {
    $message .= "  Client has:";
    foreach ($_POST['check'] as $has) {
      $message .= ' ' . $has . ' ';
    }
  }
  if(isset($_POST['time'])){
    $time = $_POST['time'];
    $message .= ' Target Launch: ' . $_POST['time'];
  }
  if(isset($_POST['budget'])){
   $budget = $_POST['budget'];
   $message .= ' Target Budget: ' . $_POST['budget']; 
  }
  if( isset( $_POST[ 'email' ] ) ) {
    $email = strip_tags( $_POST[ 'email' ] );
    // store error messages if the email is invalid or the message is too short.
    if( !filter_var( $email, FILTER_VALIDATE_EMAIL ) ){
      $errors[ 'email' ] = '<div class="error-msg">*check your email address</div>';
    } 
    if( isset( $_POST[ 'message' ] ) ) {
      $message  .= ' Message: ' . strip_tags( $_POST[ 'message' ] );
      if( strlen( $_POST[ 'message' ] ) < 3 ){
        $errors[ 'message' ] = '<div class="error-msg">*write me something.</div>';
      }
      if( count( $errors ) < 1 ){ 
        //send email
        $to       = 'lara.noell@gmail.com';
        $subject  = 'Portfolio - Message';
        $headers = 'From: <' . $email . ">\r\n" .
               'Reply-To: <' . $email . ">\r\n" .
               'X-Mailer: PHP/' . phpversion();
        
        mail( $to, $subject, $message, $headers );
        $success = true;
      }
    }
  }
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Lara Noell">
  <title>Developer | Lara Noell</title>
  <link href="http://laranoell.com/" rel="canonical">  
  <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body id="portfolio">
  <!--[if lte IE 9]>
      <div class="wrap"><h4>You're using an unsupported browser, for a better experience update your browser</h4></div>
  <![endif]-->
  <div id="home">
    <nav class="navbar" id="navbar">
      <a href="#welcome" class="navtab" id="navtab">
        <h1 class="logo">l.noell</h1>
      </a>
      <ul>
        <li><a class="navlink" href="#work-ex" >Work</a></li>
        <li><a class="navlink" href="#tools" >Tools</a></li>
        <li><a class="navlink" href="#contact">Hello</a></li>
      </ul>
    </nav>  
    <header class="intro">
      <div class="wrap">
        <h2>I build websites.</h2>  
        <h3>You can find me in Toronto where I like to cycle, sketch, <br>scribble notes and code responsive Wordpress sites like these:</h3>
      </div>
    </header>
    <section class="work-ex" id="work-ex">
      <h2>My Work</h2>
      <div class="wrap">
        <ul class="projects">
          <li class="project york">
            <a href="http://science.yorku.ca/"  target="_blank">
              <div class="overlay">
                <h3 class="p-title">York U Sci<span class="emphasis"></span></h3>
                <h4 class="role">Full Stack Developer</h4>
              </div>
              <div class="shots">
                <img src="images/york_desktop_small.jpg" alt="ftb desktop img" class="desktop shot">
                <img src="images/york_mobile_small.jpg" alt="ftb mobile img" class="mobile shot">
              </div> 
            </a>
          </li>
          <li class="project tel">
            <a href="http://www.theexchangelab.com/" target="_blank">
              <div class="overlay">
                <h3 class="p-title">T.E.L<span class="emphasis"></span></h3>
                <h4 class="role">Lead Developer</h4>
              </div>
              <div class="shots">
                <img src="images/tel_desktop_small.jpg" alt="ftb desktop img" class="desktop shot">
                <img src="images/tel_mobile_small.jpg" alt="ftb mobile img" class="mobile shot">
              </div>
            </a>
          </li>
          <li class="project clio">
            <a href="http://www.goclio.com/" target="_blank">
              <div class="overlay">
                <h3 class="p-title">Clio<span class="emphasis"></span></h3>
                <h4 class="role">Jr. Front End Developer</h4>
              </div>
              <div class="shots">
                <img src="images/clio_desktop_small.jpg" alt="ftb desktop img" class="desktop shot">
                <img src="images/clio_mobile_small.jpg" alt="ftb mobile img" class="mobile shot">
              </div>
            </a>
          </li>
        </ul>
      </div>
    </section> 
    <section class="tools" id="tools">
      <div class="wrap">
        <h2 class="tools-title"><span>Some of my favourite Tools.</span></h2>
        <img src="images/larahead.png" alt="An illustration of the Languages and tools I know and use">
        <ul class="lang-etc">
          <li><h4>HTML</h4></li>
          <li><h4>CSS</h4></li>
          <li><h4>Javasript</h4></li>
          <li><h4>PHP</h4></li>
          <li><h4>MySQL</h4></li>
          <li><h4>Angular</h4></li>
          <li><h4>JQuery</h4></li>
          <li><h4>Sass</h4></li>
          <li><h4>Bourbon</h4></li>
          <li><h4>Neat</h4></li>
          <li><h4>Gulp</h4></li>
          <li><h4>Git</h4></li>
          <li><h4>WP</h4></li>
          <li><h4>Sublime</h4></li>
          <li><h4>Illustrator</h4></li>
        </ul>
      </div>
    </section>
    <div class="callout" id="contact">
      <div class="wrap">
        <h2 class="call"><span>Want to say hello?</span></h2>
        <div class="answer">
          <ul class="social">
            <li class="linkedin"><a href="https://www.linkedin.com/pub/lara-noell/39/176/b24"><i class="fa fa-linkedin"></i></a></li>
            <li class="twitter"><a href="https://twitter.com/jezebler"><i class="fa fa-twitter"></i></a></li>
            <li class="github"><a href="https://github.com/laranoell"><i class="fa fa-github"></i></a></li>
            <li class="codepen"><a href=""><i class="fa fa-codepen"></i></a></li>
          </ul>
          <a href="mailto:lara.noell@gmail.com" target="_blank" class="email">mail@laranoell.com<span class="emphasis"></span></a>
        </div>
      </div>
    </div>
    <footer class="contact">
      <div class="dropdown wrap">
        <?php if( !$success ): ?>
        <?php if(isset($errors['email'])){echo $errors['email'];} ?>
        <form class="newsite-form" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>#contact">
          <div class="col">
            <label for="email" class="">Please provide a valid email address</label>
            <input placeholder="*Email" type="email" id="email" name="email" value="<?php if(isset($_POST['email'])) {echo htmlspecialchars($_POST['email']); } ?>" <?php if (isset($errors[ 'email' ])) { echo 'class="error"';} ?> required/>
          </div>
          <div class="col">
            <label for="budget" class="">Optionally select a target budget from the following ranges:</label>
            <select  name="budget" id="budget" >
              <option value="" disabled <?php if( $budget == "" ){ echo 'selected'; }?>>Target Budget ↓ </option>
              <option value="3to5" <?php if( $budget == "3to5" ){ echo 'selected'; }?> >$3,000 — $5,000</option>
              <option value="5to7" <?php if( $budget == "5to7" ){ echo 'selected'; }?>>$5,000 — $7,000</option>
              <option value="7to10" <?php if( $budget == "7to10" ){ echo 'selected'; }?>>$7,000 — $10,000</option>
              <option value="10plus" <?php if( $budget == "10plus" ){ echo 'selected'; }?>>$10,000+</option>
              <option value="unsure" <?php if( $budget == "unsure" ){ echo 'selected'; }?>>Not Sure</option>
            </select>
          </div>
          <div class="col">
            <label  for="time">Optionally select a target budget from the following ranges:</label>
            <select name="time" id="time" >
              <option value="" disabled <?php if( $time == "" ){ echo 'selected'; }?>>Target Deadline ↓ </option>
              <option value="asap" <?php if( $time == "asap" ){ echo 'selected'; }?>>Asap</option>
              <option value="2to4" <?php if( $time == "2to4" ){ echo 'selected'; }?>>2 to 4 months</option>
              <option value="4to6" <?php if( $time == "4to6" ){ echo 'selected'; }?>>4 to 6 months</option>
              <option value="6to12" <?php if( $time == "6to12" ){ echo 'selected'; }?>>6 to 12 months</option>
              <option value="unsure" <?php if( $time == "unsure" ){ echo 'selected'; }?>>Not sure</option>
            </select>
          </div>
          <label for="message">Please write a message about yourself and what you're looking for</label>
          <?php if(isset($errors['message'])){echo $errors['message'];} ?>
          <textarea placeholder="*Message" name="message" id="message" rows="8" <?php if (isset($errors[ 'message' ])) { echo 'class="error"';} ?>><?php if(isset($_POST['message'])) {echo htmlspecialchars($_POST['message']); } ?></textarea>
          <div class="left">
            <label for="photos" class="checks-label">Check if you have any or all of the following: </label>
            <ul class="check-grp" id="check-grp">
              <li>
                <label for="design">
                  <input type="checkbox" id="design" name="check[1]" value="design" <?php if(isset($_POST['check'][1])){echo 'checked';}?>><span>Design</span>            
                </label>
              </li>
              <li>
                <label for="brand">
                  <input type="checkbox" id="brand" name="check[2]" value="brand" <?php if(isset($_POST['check'][2])){echo 'checked';}?>><span>Brand</span>
                </label>
              </li>
              <li>
                <label for="logo">
                  <input type="checkbox" id="logo" name="check[3]" value="logo" <?php if(isset($_POST['check'][3])){echo 'checked';}?>><span>Logo</span>
                </label>
              </li>
              <li>
                <label for="photos">
                  <input type="checkbox" id="photos" name="check[4]" value="photos" <?php if(isset($_POST['check'][4])){echo 'checked';}?> ><span>Pics</span>
                </label>
              </li>
              <li>
                <label for="copy">
                  <input type="checkbox" id="copy" name="check[5]" value="copy" <?php if(isset($_POST['check'][5])){echo 'checked';}?>><span>Copy</span>
                </label>
              </li>
            </ul>
          </div>
          <div class="right">
            <input type="submit" value="Send  →">
          </div>
        </form>
        <?php else: ?>
          <h2 id="successMsg">Success, your message was sent! Nice to meet you.</h2>     
        <?php endif; ?>
      </div>
    </footer>
  </div>
  <script src="js/script.js"></script>
  <script type="text/javascript">

    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-40275482-1']);
    _gaq.push(['_setDomainName', 'laranoell.com']);
    _gaq.push(['_trackPageview']);

    (function() {
      var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
      ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
      var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();

  </script>
  <script async src="http://www.google-analytics.com/ga.js"></script>
  
</body>
</html> 