<link rel="stylesheet"href="style/style.css"/>
<body>
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <?php
	//the first line mysql:write your host name and in dbname write your dbname,root=> your mysql username and then password
$db = new PDO("mysql:host=localhost;dbname=comment", "root" ,"");
?>    
<form action='index.php' method='post'>
<h3 style='margin-left:25%;'>Write Your comment here</h3><br />
<input type='name' name='name' placeholder='Write your name'style='margin-left:30%;'/><br /><br />
<input type='email' name='email' placeholder='Write your email'style='margin-left:30%;'/><br /><br />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Begin emoji-picker Stylesheets -->
    <link href="lib/css/emoji.css" rel="stylesheet">
    <!-- End emoji-picker Stylesheets -->
<div class="container">
          <div class="text-left"> 
            <p class="lead emoji-picker-container">
              <textarea name="comment" class="form-control textarea-control" rows="10
			  "cols="40" placeholder="Write your comment here...." data-emojiable="true" data-emoji-input="unicode"></textarea>
            </p>
          </div>
        </div>
<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <!-- Begin emoji-picker JavaScript -->
    <script src="lib/js/config.js"></script>
    <script src="lib/js/util.js"></script>
    <script src="lib/js/jquery.emojiarea.js"></script>
    <script src="lib/js/emoji-picker.js"></script>
    <!-- End emoji-picker JavaScript -->
    <script>
      $(function() {
        // Initializes and creates emoji set from sprite sheet
        window.emojiPicker = new EmojiPicker({
          emojiable_selector: '[data-emojiable=true]',
          assetsPath: 'lib/img',
          popupButtonClasses: 'fa fa-smile-o'
        });
        // Finds all elements with `emojiable_selector` and converts them to rich emoji input fields
        // You may want to delay this step if you have dynamically created input fields that appear later in the loading process
        // It can be called as many times as necessary; previously converted input fields will not be converted again
        window.emojiPicker.discover();
      });
    </script><input type='submit' name='submit' value='post'class='btn btn-primary'style='margin-left:80%;'/>
</form>
<?php
if(isset($_POST['submit'])){
	$name = $_POST['name'];
	$email = $_POST['email'];
	$comment = $_POST['comment'];
	$create = $db->prepare("INSERT INTO comment SET name=?,email=?,comment=?");
	$create->execute([$name,$email,$comment]);
}
?>
<hr />
<?php
$show = $db->prepare("Select * From comment");
$show->execute();
while($row = $show->fetchObject()){
	$id = $row->id;
	$name = $row->name;
	$email = $row->email;
	$comment = $row->comment;
	$time = $row->time;
?>
<h5><?php echo $name; ?>  <i><?php echo $time;?></i></h5>
<p><i><?php echo $email; ?></i></p>
<p><?php echo $comment; ?></p><hr />
<?php } ?>
</body>
