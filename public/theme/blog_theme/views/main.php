<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Bloggers Green</title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <link href= "<?php echo 'public/theme/' . \framework\Framework::$params['theme']; ?>/css/default.css" rel="stylesheet" type="text/css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    </head>
    <body>
        <div id="content">
            <div>
                <h1>Bloggersgreen</h1>
                <h2>Free CSS Template</h2>
                <h1><?php echo \framework\FlashMessages::getMess('flashmessage'); ?>  </h1>
            </div>
            <div id="menu">
                <ul>
                    <li><a href="index">Home</a></li>
                    <li><a href="about">About us</a></li>     
                    <?php if (isset($_SESSION[md5(KEY)])) { ?>
                        <li><a href="adduser">Add Users</a></li>
                        <li><a href="addcomment">Add Comment</a></li>
                        <li><a href="logout">Logout</a></li>
                        <li><a href="userlist">Users</a></li>
                    <?php } else { ?> 
                        <li><a href="login">Login</a></li>
                    <?php } ?>
                </ul>
            </div>
            <div class="content">
                <?php echo $content; ?>
                <div id="right">

                </div>
            </div>           
            <div>
                <p>&nbsp;</p>
            </div>
            <div id="right2">
                <h2>Recent Updates</h2>
                <p><strong>[06/09/2006]</strong> Etiam odio mi, suscipit et, rhoncus ac, lacinia, nisl. Aliquam gravida massa eu arcu. <a href="#">More&#8230;</a></p>
                <p><strong>[06/06/2006]</strong> Fusce mollis tristique sem. Sed eu eros imperdiet eros interdum blandit. Vivamus sagittis bibendum erat. Curabitur malesuada. <a href="#">More&#8230;</a></p>
                <p><strong>[06/03/2006]</strong> Nunc pellentesque. Sed vestibulum blandit nisl. Quisque elementum convallis purus. Suspendisse potenti. Donec nulla est, laoreet quis, pellentesque in. <a href="#">More&#8230;</a></p>
            </div>
            <div id="footer">
                <p>Copyright &copy; 2006 Sitename.com. Designed by <a href="http://www.freecsstemplates.org" class="link1">Free CSS Templates</a></p>
            </div>
        </div>
    </body>
    <script>
        $(document).one('ready', function () {
            $.ajax({
                method: 'GET',
                url: "comentarii",
                dataType: "html",
                success: function ($date) {
                    $('#right').html($date);
                }
            });
        });
    </script> 
</html>