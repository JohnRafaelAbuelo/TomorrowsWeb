<?php include('includes/session.php')?> 
<?php include('includes/config.php')?> 

<?php // calling delete note function and adding delete note message 
if (isset($_GET['delete'])) {
  $delete = $_GET['delete'];
  $sql = "DELETE FROM notes where note_id = ".$delete;
  $result = mysqli_query($conn, $sql);
  if ($result) {
    echo "<script>alert('Note removed Successfully');</script>";
      echo "<script type='text/javascript'> document.location = 'notebook.php'; </script>";
    
  }
}
// adding function for submitting and adding notes
 if(isset($_POST['submit'])){
        
        $title=mysqli_real_escape_string($conn,$_POST['title']);
        $note=mysqli_real_escape_string($conn,$_POST['note']);

        date_default_timezone_set("Africa/Accra");
        $time_now = date("h:i:sa");

        // make sql query
        $query = "INSERT INTO notes(user_id,title,note,time_in) VALUES('$session_id','$title','$note','$time_now')";

        if(mysqli_query($conn, $query)){
          echo "<script>alert('Note Added Successfully');</script>";

        }else{
            //failure
            echo 'query error: '. mysqli_error($conn);
        }

    }


     $query = "SELECT note_id,title,note,time_in FROM notes WHERE user_id = \"$session_id\" ";

    if(mysqli_query($conn, $query)){

        // get the query result
        $result = mysqli_query($conn, $query);

        // fetch result in array format
        $notesArray= mysqli_fetch_all($result , MYSQLI_ASSOC);

        // print_r($notesArray);

    }else{
        //failure message
        echo 'query error: '. mysqli_error($conn);
    }
?>


<!DOCTYPE html> <!-- creating html -->
<html lang="en" class="app">
<head> <!-- html head -->
  <meta charset="utf-8" />
  <title>Academate</title> 
  <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
  <!--linking css files-->
  <link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
  <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="css/app.css" type="text/css" />
 
</head>
<!--website main body-->
<body style="background-color: #292828; background-image: url('background.png'); background-size: auto; font-family: helvetica">
  <section class="vbox">

  <!--creating website header-->
    <header style="background-color: #181818;" class="bg-dark dk header navbar navbar-fixed-top-xs">
      <div style="background-color: #181818;" class="navbar-header aside-md">
        <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen,open" data-target="#nav,html">
          <i class="fa fa-bars"></i>
        </a>
        <a href="#" style="color: white" class="navbar-brand" data-toggle="fullscreen">AcadeMate</a>
        <a class="btn btn-link visible-xs" data-toggle="dropdown" data-target=".nav-user">
          <i class="fa fa-cog"></i>
        </a>
      </div>

      <!--creating user logout dropdown-->
      <ul class="nav navbar-nav navbar-right m-n hidden-xs nav-user">
        <li class="dropdown">
          <?php $query= mysqli_query($conn,"select * from register where user_ID = '$session_id'")or die(mysqli_error());
                $row = mysqli_fetch_array($query);
            ?>

          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <span class="thumb-sm avatar pull-left">
              <img src="images/profile.jpg">
            </span>
            <?php echo $row['fullName']; ?> <b class="caret"></b>
          </a>
          <ul class="dropdown-menu animated fadeInRight">
            <span class="arrow top"></span>
            <li class="divider"></li>
            <li>
              <a href="logout.php" data-toggle="ajaxModal" >Logout</a>
            </li>
          </ul>
        </li>
      </ul>      
    </header>
    <section>
      <section class="hbox stretch">
        <!-- creating aside nav bar for menu -->
        <aside style="background-color: #181818;" class="bg-dark lter aside-md hidden-print" id="nav">          
          <section class="vbox">
            <section class="w-f scrollable">
              <div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="5px" data-color="#333333">
                
                <!-- nav sidebar -->
                <nav style="background-color: #DBD5B5;" class="nav-primary hidden-xs">
                  <ul class="nav">
                    <li  class="active">
                      <a href="notebook.php" class="active">
                        
                          <b class="bg-info"></b>
                        </i>
                        <span style ="color: black;">Notes</span>
                      </a>
                    </li>
                  </ul>
                </nav>
                <nav style="background-color: #2B9EB3;" class="nav-primary hidden-xs">
                  <ul class="nav">
                    <li  class="active">
                       <a href="https://www.youtube.com/" target="_blank"class="active">
                        
                          <b class="bg-info"></b>
                        </i>
                        <span style ="color: black;">Youtube</span>
                      </a>
                    </li>
                  </ul>
                </nav>
                <nav style="background-color: #FCAB10;" class="nav-primary hidden-xs">
                  <ul class="nav">
                    <li  class="active">
                      <a href="https://www.quora.com/" target="_blank"class="active">
                        
                          <b class="bg-info"></b>
                        </i>
                        <span style ="color: black;">Quora</span>
                      </a>
                    </li>
                  </ul>
                </nav>
                <nav style="background-color: #F8333C;" class="nav-primary hidden-xs">
                  <ul class="nav">
                    <li  class="active">
                      <a href="https://www.wikipidea.org/" target="_blank"class="active">
                        
                          <b class="bg-info"></b>
                        </i>
                        <span style ="color: black;">Wikipedia</span>
                      </a>
                    </li>
                  </ul>
                </nav>
                <nav style="background-color: #44AF69;" class="nav-primary hidden-xs">
                  <ul class="nav">
                    <li  class="active">
                      <a href="https://www.chegg.com/" target="_blank"class="active">
                        
                          <b class="bg-info"></b>
                        </i>
                        <span style ="color: black;">Chegg</span>
                      </a>
                    </li>
                  </ul>
                </nav>
               
              </div>
            </section>


            <!--creating footer for sidebar-->
            <footer style="background-color: #181818;"class="footer lt hidden-xs b-t b-dark">
              <div id="invite" class="dropup">                
                <section class="dropdown-menu on aside-md m-l-n">
                  <section class="panel bg-white">
                    <header class="panel-heading b-b b-light">
                      <?php $query= mysqli_query($conn,"select * from register where user_ID = '$session_id'")or die(mysqli_error());
                        $row = mysqli_fetch_array($query);
                      ?>
                      <?php echo $row['fullName']; ?> <i class="fa fa-circle text-success"></i>
                    </header>
                    
                  </section>
                </section>
              </div>
              <a style="background-color: #292828;"href="#nav" data-toggle="class:nav-xs" class="pull-right btn btn-sm btn-dark btn-icon">
                <i class="fa fa-angle-left text"></i>
                <i class="fa fa-angle-right text-active"></i>
              </a>
              <div class="btn-group hidden-nav-xs">
                
              </div>
            </footer>
          </section>
        </aside>

        <!-- creating add note system -->
        <section id="content">
          <section class="hbox stretch">
                  <aside style="background-image: url('background2.png'); background-size: cover" style="background-color: #292828;"class="aside-lg bg-light lter b-r">
                    <div style="background-color: #292828; margin: 10px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.9);"class="wrapper">
                      <h4 class="m-t-none">Add Note</h4>
                      <form method="POST">
                        <div class="form-group">
                          <label>Title</label>
                          <input style="background-color: #292828;"name="title" type="text" placeholder="Title" class="input-sm form-control">
                        </div>
                        <div class="form-group">
                          <label>Note</label>
                          <textarea style="background-color: #292828;"name="note" class="form-control" rows="8" data-minwords="8" data-required="true" placeholder="Take a Note ......"></textarea>
                        </div>
                        <div class="m-t-lg"><button class="button-17" name="submit" type="submit">Add Entry</button></div>
                      </form>
                    </div>
                    
                </aside>

                <!--creating section where notes are displayed-->
                <aside class="bg-white">
                  <section class="vbox">
                    <header class="header bg-light bg-gradient">
                      <ul class="nav nav-tabs nav-white">
                        <li class="active"><a href="#activity" data-toggle="tab"><h4 style = "text-transform:uppercase;"><b>My Notes</b></h4></a></li>
                      </ul>
                    </header>
                    <section class="scrollable">
                      <div class="tab-content">
                        <div class="tab-pane active" id="activity">
                          <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
                            <li></li>
                            <?php foreach($notesArray as $note){ ?>
                            <li class="list-group-item">
                                <div class="btn-group pull-right">
                                    <a href="edit_notebook.php?edit=<?php echo $note['note_id'];?>"><button type="button" class="btn btn-sm btn-default" title="Show"><i class="fa fa-eye"></i></button></a>
                                    <a href="notebook.php?delete=<?php echo $note['note_id'];?>"><button style="background-color: #F8333C;"type="button" class="btn btn-sm btn-default" title="Remove"><i class="fa fa-trash-o bg-danger"></i></button></a>
                                  </div>
                                <h3 style = "text-transform:uppercase;"><b><?php echo $note['title'] ?></b></h3>
                                <p><?php echo substr($note['note'], 0, 200)?></p>
                                <small class="block text-muted text-info"><i class="fa fa-clock-o text-info"></i> <?php echo $note['time_in'] ?></small>
                                <?php } ?>
                            </li>
                          </ul>
                        </div>
                        <div class="tab-pane" id="events">
                          <div class="text-center wrapper">
                            <i class="fa fa-spinner fa fa-spin fa fa-large"></i>
                          </div>
                        </div>
                        <div class="tab-pane" id="interaction">
                          <div class="text-center wrapper">
                            <i class="fa fa-spinner fa fa-spin fa fa-large"></i>
                          </div>
                        </div>
                      </div>
                    </section>
                  </section>
                </aside>
                <aside class="col-lg-4 b-l">
                  <section class="vbox">
                    <section class="scrollable">

                    <!--adding note tile-->
                      <div class="wrapper">
                        <section class="panel panel-default">
                          <?php
                             $get_note = mysqli_query($conn,"select * from notes WHERE user_id = \"$session_id\" LIMIT 1") or die(mysqli_error());
                             while ($row = mysqli_fetch_array($get_note)) {
                             $id = $row['note_id'];
                                 ?>
                          <h4 style = "text-transform:uppercase;" class="font-thin padder"><b><?php echo $row['title']; ?></b></h4>
                          <ul class="list-group">
                            <li class="list-group-item">
                                <p><?php echo $row['note']; ?> </p>
                            </li>
                          </ul>
                          <?php } ?> 
                        </section>

                        <!-- adding spotify tile-->
                        <section >
                          <div>
                          <iframe style="border-radius:12px;box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.9);" src="https://open.spotify.com/embed/playlist/37i9dQZF1E4yVfD4M4LwFh?utm_source=generator&theme=0" width="100%" height="352" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>

                          </div>
                          <div>
                         


<!--adding quote generator tile-->
  
    <div class="wrapper"style="width: 400px; margin: 0 auto">
      <div class="container"style=" width: 80%; background-color: #F7EFE3; padding: 40px 40px;  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.9);  margin: 0 auto;  border-radius: 8px;
          text-align: center;color: #fdd8d8;line-height: 2;  font-size: 16px; ">
        <p id="quote"style="font-family: times new roman; color: #301506">
          Lorem ipsum dolor, sit amet consectetur adipisicing elit. Voluptas,
          magni.
        </p>
        <h3 style="font-family: times new roman; font-size: 18px; color: #301506" id="author">Lorem, ipsum.</h3>
        <button style="background-color: #ffffff;border: none;  padding: 15px 45px;  border-radius: 5px;  font-size: 16px;
          font-weight: 600;
          color: #301506; cursor: pointer;"id="btn">Get Quote</button>
      </div>
    </div>
    <!-- Script -->
    <script src="script.js"></script>


                          </div>

                          <!--adding calendar tile-->
                          <div style="box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.9); margin: 10px">
                          <iframe src="https://calendar.google.com/calendar/embed?height=500&wkst=1&ctz=Asia%2FDubai&bgcolor=%23292828&src=am9obnJhZmFlbDEyMTdAZ21haWwuY29t&src=Y2xhc3Nyb29tMTA4MDg5MjA0NzIwOTY0Mjc2NDgwQGdyb3VwLmNhbGVuZGFyLmdvb2dsZS5jb20&src=Y2xhc3Nyb29tMTA3MTIwMDE2ODc4MDcxMzAxOTI5QGdyb3VwLmNhbGVuZGFyLmdvb2dsZS5jb20&src=Y2xhc3Nyb29tMTE3NDUyMzA2NTc1OTk4Mjg2ODgyQGdyb3VwLmNhbGVuZGFyLmdvb2dsZS5jb20&src=Y2xhc3Nyb29tMTAwMzc4OTE3MzY2MDY4NDE4NzE2QGdyb3VwLmNhbGVuZGFyLmdvb2dsZS5jb20&src=Y2xhc3Nyb29tMTA3NjcwNTM5MjUxMDY2MDcwODEyQGdyb3VwLmNhbGVuZGFyLmdvb2dsZS5jb20&src=Y2xhc3Nyb29tMTE0MDEyNDAzMzI5MzI5NTM0NjE5QGdyb3VwLmNhbGVuZGFyLmdvb2dsZS5jb20&src=Y2xhc3Nyb29tMTAyNDU0MDY0Nzk2MDEwNDc4OTY1QGdyb3VwLmNhbGVuZGFyLmdvb2dsZS5jb20&src=Y2xhc3Nyb29tMTA1NDY0OTYyOTA2MTIxODE4MTE4QGdyb3VwLmNhbGVuZGFyLmdvb2dsZS5jb20&src=Y2xhc3Nyb29tMTA1MjU4MjYzMDUyMjE0Mjk3MTQyQGdyb3VwLmNhbGVuZGFyLmdvb2dsZS5jb20&src=Y2xhc3Nyb29tMTAyMDcyNjc1MzY1NjE1OTIzMzk0QGdyb3VwLmNhbGVuZGFyLmdvb2dsZS5jb20&src=YWRkcmVzc2Jvb2sjY29udGFjdHNAZ3JvdXAudi5jYWxlbmRhci5nb29nbGUuY29t&src=Y2xhc3Nyb29tMTAzODc0NzkxOTQ3ODA5Mjk2OTYwQGdyb3VwLmNhbGVuZGFyLmdvb2dsZS5jb20&src=Y2xhc3Nyb29tMTE3MzExMDc4MDQ2MTI4NTgzODc2QGdyb3VwLmNhbGVuZGFyLmdvb2dsZS5jb20&src=Y2xhc3Nyb29tMTAzMDM0MDI3Nzg0NjY0NDM1NjE0QGdyb3VwLmNhbGVuZGFyLmdvb2dsZS5jb20&src=Y2xhc3Nyb29tMTEyMDI0MTQwMjk2MzYwMzY5MjY3QGdyb3VwLmNhbGVuZGFyLmdvb2dsZS5jb20&src=Y2xhc3Nyb29tMTA5MjYwMTc2OTM4NzUzMjA3MTc2QGdyb3VwLmNhbGVuZGFyLmdvb2dsZS5jb20&src=Y2xhc3Nyb29tMTAxNTkxMzk5NjEzMTg1MjIxMDUyQGdyb3VwLmNhbGVuZGFyLmdvb2dsZS5jb20&src=ZW4uYWUjaG9saWRheUBncm91cC52LmNhbGVuZGFyLmdvb2dsZS5jb20&src=Y2xhc3Nyb29tMTA2ODIwODc5Mzk5MjI3MTY1ODg1QGdyb3VwLmNhbGVuZGFyLmdvb2dsZS5jb20&src=Y2xhc3Nyb29tMTA2NjMxOTYwOTkzMjYwODU3NDkxQGdyb3VwLmNhbGVuZGFyLmdvb2dsZS5jb20&src=Y2xhc3Nyb29tMTE0NDk3MzkyNDM1Mzk1Nzg3ODA2QGdyb3VwLmNhbGVuZGFyLmdvb2dsZS5jb20&src=Y2xhc3Nyb29tMTE1NTQ2NDkzMDgwNDAwNzM5NDc4QGdyb3VwLmNhbGVuZGFyLmdvb2dsZS5jb20&src=Y2xhc3Nyb29tMTA3MzcxNDk1NzUzNjMxMTc2MDg2QGdyb3VwLmNhbGVuZGFyLmdvb2dsZS5jb20&color=%23039BE5&color=%23202124&color=%237627bb&color=%23202124&color=%23137333&color=%230047a8&color=%230047a8&color=%237627bb&color=%230047a8&color=%233e2723&color=%23174ea6&color=%2333B679&color=%230047a8&color=%237627bb&color=%233e2723&color=%23174ea6&color=%23263238&color=%23004d40&color=%230B8043&color=%230047a8&color=%23202124&color=%230047a8&color=%23202124&color=%230047a8" style="border:solid 1px #777; " width="500" height="500" frameborder="0" scrolling="no"></iframe>
                          </div>
                        
                          </section>
                      </div>
                    </section>
                  </section>              
                </aside>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
      </section>
    </section>
  </section>

  <style>
.button-17 {
  align-items: center;
  appearance: none;
  background-color: #fff;
  border-radius: 24px;
  border-style: none;
  box-shadow: rgba(0, 0, 0, .2) 0 3px 5px -1px,rgba(0, 0, 0, .14) 0 6px 10px 0,rgba(0, 0, 0, .12) 0 1px 18px 0;
  box-sizing: border-box;
  color: #3c4043;
  cursor: pointer;
  display: inline-flex;
  fill: currentcolor;
  font-family: "Google Sans",Roboto,Arial,sans-serif;
  font-size: 14px;
  font-weight: 500;
  height: 48px;
  justify-content: center;
  letter-spacing: .25px;
  line-height: normal;
  max-width: 100%;
  overflow: visible;
  padding: 2px 24px;
  position: relative;
  text-align: center;
  text-transform: none;
  transition: box-shadow 280ms cubic-bezier(.4, 0, .2, 1),opacity 15ms linear 30ms,transform 270ms cubic-bezier(0, 0, .2, 1) 0ms;
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
  width: auto;
  will-change: transform,opacity;
  z-index: 0;
}

.button-17:hover {
  background: #929292;
  color: black;
}

.button-17:active {
  box-shadow: 0 4px 4px 0 rgb(60 64 67 / 30%), 0 8px 12px 6px rgb(60 64 67 / 15%);
  outline: none;
}

.button-17:focus {
  outline: none;
  border: 2px solid #4285f4;
}

.button-17:not(:disabled) {
  box-shadow: rgba(60, 64, 67, .3) 0 1px 3px 0, rgba(60, 64, 67, .15) 0 4px 8px 3px;
}

.button-17:not(:disabled):hover {
  box-shadow: rgba(60, 64, 67, .3) 0 2px 3px 0, rgba(60, 64, 67, .15) 0 6px 10px 4px;
}

.button-17:not(:disabled):focus {
  box-shadow: rgba(60, 64, 67, .3) 0 1px 3px 0, rgba(60, 64, 67, .15) 0 4px 8px 3px;
}

.button-17:not(:disabled):active {
  box-shadow: rgba(60, 64, 67, .3) 0 4px 4px 0, rgba(60, 64, 67, .15) 0 8px 12px 6px;
}

.button-17:disabled {
  box-shadow: rgba(60, 64, 67, .3) 0 1px 3px 0, rgba(60, 64, 67, .15) 0 4px 8px 3px;
}
  </style>

  <script src="js/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="js/bootstrap.js"></script>
  <!-- App -->
  <script src="js/app.js"></script>
  <script src="js/app.plugin.js"></script>
  <script src="js/slimscroll/jquery.slimscroll.min.js"></script>
  <script src="js/libs/underscore-min.js"></script>
<script src="js/libs/backbone-min.js"></script>
<script src="js/libs/backbone.localStorage-min.js"></script>  
<script src="js/libs/moment.min.js"></script>
<!-- Notes -->
<script src="js/apps/notes.js"></script>



</body>
</html>