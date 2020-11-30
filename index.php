<?PHP
if(isset($_COOKIE['saveddm'])) {
    $default1=$_COOKIE['saveddm'];
} else {
    $default1 = '';
}
if(isset($_COOKIE['savedarea1']) && isset($_COOKIE['savedarea2'])) {
    $default2a=$_COOKIE['savedarea1'];
    $default2b=$_COOKIE['savedarea2'];
}else {
    $default2a='area1';
    $default2b='area2';
}
$darkmodetoggle='';
$unitoggle='';
$unicookie='off';

if(isset($_POST['dm'])) {
    $default1='dark-mode';
    if(isset($_COOKIE['unii'])) {
        if($_COOKIE['unii'] == 'off') {
            $default2a='area1NEW';
            $default2b='area2NEW';
            $default1='dark-mode';
        }
        if($_COOKIE['unii'] =='on') {
            $default2a='area1';
            $default2b='area2';
            $default1='dark-mode';
        }
    }
    if(isset($_COOKIE['darkmodetoggle'])){
        if($_COOKIE['darkmodetoggle']=='dark-mode') {
            $default1='';
        } else {
            $default1 = 'dark-mode';
        }
    }

    setcookie("darkmodetoggle",$default1,0);
}
elseif(isset($_POST['uni'])){
    $default2a='area1NEW';
    $default2b='area2NEW';
    if(isset($_COOKIE['unitoggle']) && !empty($_COOKIE['unitoggle'])){
        if($_COOKIE['unitoggle']=='area1') {
            $default2a='area1NEW';
            $default2b='area2NEW';
        }
        if($_COOKIE['unitoggle']=='area1NEW') {
            $default2a='area1';
            $default2b='area2';
            $unicookie='on';
        }
    }
    if(isset($_COOKIE['darkmodetoggle'])) {
        if($_COOKIE['darkmodetoggle']=='dark-mode') {
            $default1='dark-mode';
        }
        if($_COOKIE['darkmodetoggle']=='') {
            $default1='';
        }
    }

    setcookie("unii",$unicookie,0);
    setcookie("unitoggle",$default2a,0);
}
else
    error_log("aw shit here we go again",0);

setcookie("saveddm",$default1,time()+10*365*24*60*60);
setcookie("savedarea1",$default2a,time()+10*365*24*60*60);
setcookie("savedarea2",$default2b,time()+10*365*24*60*60);

echo "<html>

<title>
    Danny Doan's Page
</title>
<head>
    <link href=assign3.css rel=stylesheet type=text/css />
</head>
<body id='a' class='$default1'>
<table>
    <tr>
        <td><h1 text-align='left' vertical-align='top'>Danny Doan</h1></td>
        <td class='pichelp'><img src = 'images/roadrunner.png' alt='UTSA' width = '300px' align='right'></td>
    </tr>
</table>
<hr style='margin-bottom: 20px'>
<table id='a' class='center'>
    <tr>
        <td class='$default2a'><h3 style='text-align:center' class='p'>Menu</h3> <hr> <ul> <li> <a href='https://github.com/dannydoan43'>GitHub</a></li> <li>Courses</li> <li><a href='https://www.utsa.edu/'>UTSA</a></li> </ul>
        <td class='p mid'>About Me <br> <img src='images/roadrunner.png' alt='oops' class='f picture'><p class='stretch'>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut a sapien facilisis diam efficitur pretium. Duis auctor eleifend libero. Phasellus felis enim, ullamcorper eget dolor eu, lacinia rutrum nibh. In felis magna, consequat nec hendrerit vel, laoreet vel libero. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. In porttitor faucibus odio quis rhoncus.</p> <p class='stretch'>Praesent scelerisque efficitur imperdiet. In consequat in tortor vitae aliquam. Donec a iaculis lacus. Nam mattis scelerisque fermentum. Integer augue mi, posuere vel nisi et, fermentum ullamcorper tortor. Cras auctor fermentum massa, sit amet faucibus libero dignissim sed. Sed lectus eros, sodales nec pharetra quis, iaculis a velit. In odio quam, congue eu ipsum eu, auctor pulvinar lacus. Quisque et mattis est. Nulla diam justo, rutrum vitae leo id, tristique iaculis diam.</p>

        </td>
        <td class='$default2b'><a href='./courses.php' class='p'><h4>Enrolled Courses</h4></a> <hr> <ol> <li>CS4413</li> <li>CS4683</li> <li>CS3733</li> </ol> <br> <h4>Theme Toggles</h4><hr> <form action='index.php' method='POST'> <input type='submit' class='button' value = 'UTSA Theme' name='uni' /> </form> <form action='index.php' method='POST'> <input type='submit' class='button' value = 'Dark Mode' name='dm' /> </form></td>
    </tr>
</table>
<table width='100%'>
    <tr>
        <td class='footer'>Copyright 2020, Danny Doan</td>
    </tr>
</table>
</body>
</html>";
