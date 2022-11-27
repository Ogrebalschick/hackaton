<?php
$title="TIMEMANAGER"; 
require __DIR__ . '/header.php';
require "db.php";
?>


    
    <div class="hello">
    <?php if(isset($_SESSION['logged_user'])) : ?>
      <div class="hello__hover">
       <p class="hello__text">Hello, <?php echo $_SESSION['logged_user']->name; ?>!</br></p>
      <a href="logout.php" class="exit__btn">Exit</a>
      </div>
    </div>

<div class="wrapper">
    <div class="tab">
      <!-- <button id="getTasks">Get Tasks</button> -->
      <button class="tablinks" onclick="openCity(event, 'Tasks')" id="defaultOpen">Tasks</button>
      <button class="tablinks" onclick="openCity(event, 'Create')">Create task</button>
      <button class="tablinks" onclick="openCity(event, 'Delete')">Delete task</button>
    </div>
    <div class="tabs__open">
    <div id="Tasks" class="tabcontent">
      <div id="tasks__div">

      </div>
    </div>
    
    <div id="Create" class="tabcontent">
      <form id="create-task">
        <label>Usernames:</label>
        <input
          type="text"
          id="usernames"
          name="usernames"
          placeholder="John"
        />
  
        <label>Tags:</label>
        <input type="text" id="tags" name="tags" placeholder="IT" />
  
        <label>Dedcription:</label>
        <input 
          type="text" 
          id="description" 
          name="description" 
          placeholder="Finish writing the song" 
        />

        <label>Done:</label>
        <input
          type="text"
          id="done"
          name="done"
          placeholder="false"
        />
  
        <label>Deadline:</label>
        <input class="deadline"
          type="text"
          id="deadline"
          name="deadline"
          placeholder="30.11.22"
        />
        <script>
  $( function() {
    $( ".deadline" ).datepicker();
  } );
  </script>
        <label>Author:</label>
        <input
          type="text"
          id="author"
          name="author"
          placeholder="John"
        />
  
        <button type="submit" value="Submit" class="create__btn">Create Task</button>
      </form>
    </div>
    <script>
      $('.Deadline').bind('keyup change', function()
    {
    var error = false;

    var value = $(this).val().split('.');
    if (value.length != 3 || !(value[0] && value[1] && value[2].length == 4))
        {
        error = 'Invalid value';
        }
    else
        {
        var date = new Date(value[2] + '-' + value[1] + '-' + value[0]);

        if (isNaN(date.getTime()))
            error = 'Invalid date';
        else if (parseInt(value[0]) != date.getDate())
            error = 'Unexpected day of month';
        else if (parseInt(value[1]) != date.getMonth() + 1)
            error = 'Unexpected month';
        else
            {
            var rValueYear = value[2].toString().split('').reverse().join('');
            var rDateYear = date.getFullYear().toString().split('').reverse().join('');
            if (rValueYear.length > rDateYear.length || rDateYear.indexOf(rValueYear) !== 0)
                error = 'Ambiguous year';
            }
        }

    if (error)
        {
        alert(error);
        //return false;
        }
    });
    </script>
    <div id="Delete" class="tabcontent">
     <form id="delete-task">
      <label>Id:</label>
      <input type="text" id="id" name="id" placeholder="*********" />

      <button type="submit" value="Submit">Delete Task</button>
    </form>
    </div>
  </div>



<script>
   function openCity(evt, cityName) {
      var i, tabcontent, tablinks;
      tabcontent = document.getElementsByClassName("tabcontent");
      for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
      }
      tablinks = document.getElementsByClassName("tablinks");
      for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
      }
      document.getElementById(cityName).style.display = "block";
      evt.currentTarget.className += " active";
    }
    
    document.getElementById("defaultOpen").click();
</script>
</div>
    <script type="module" src="./index.js"></script>
    <script src="./node_modules/axios/dist/axios.min.js"></script>

    
<?php else : ?>
      <h1>Register now and control your tasks better than your competitors! </h1>
      <div class="hello__page_buttons">
<a href="login.php">Log in</a><br>
<a href="signup.php">Registration</a>
</div>
<?php endif; ?>

<?php require __DIR__ . '/footer.php'; ?>