<?php
$title="TIMEMANAGER"; // название формы
require __DIR__ . '/header.php'; // подключаем шапку проекта
require "db.php"; // подключаем файл для соединения с БД
?>

<div class="hello__page">
  <div class="title">
    <h1>Register now and control your tasks better than your colleagues! </h1>
  </div>
  <div class="hello">
    <?php if(isset($_SESSION['logged_user'])) : ?>
      Hello, <?php echo $_SESSION['logged_user']->name; ?>!</br>
    <a href="logout.php">Exit</a>
  </div>
</div>
<div class="wrapper">
    <div class="tab">
      <!-- <button id="getTasks">Get Tasks</button> -->
      <button class="tablinks" onclick="openCity(event, 'London')" id="defaultOpen">Tasks</button>
      <button class="tablinks" onclick="openCity(event, 'Paris')">Create task</button>
      <button class="tablinks" onclick="openCity(event, 'Tokyo')">Delete task</button>
    </div>
    <div class="tabs__open">
    <div id="London" class="tabcontent">
      <div id="tasks__div">

      </div>
    </div>
    
    <div id="Paris" class="tabcontent">
      <form id="create-task">
        <label>Usernames:</label><br />
        <input
          type="text"
          id="usernames"
          name="usernames"
          placeholder="John"
        /><br />
  
        <label>Tags:</label><br />
        <input type="text" id="tags" name="tags" placeholder="IT" /><br /><br />
  
        <label>Done:</label><br />
        <input
          type="text"
          id="done"
          name="done"
          placeholder="false"
        /><br /><br />
  
        <label>Deadline:</label><br />
        <input
          type="text"
          id="deadline"
          name="deadline"
          placeholder="30.11.22"
        /><br /><br />
  
        <label>Author:</label><br />
        <input
          type="text"
          id="author"
          name="author"
          placeholder="John"
        /><br /><br />
  
        <button type="submit" value="Submit">Create Task</button>
      </form>
    </div>
    
    <div id="Tokyo" class="tabcontent">
     <form id="delete-task">
      <label>Id:</label><br />
      <input type="text" id="id" name="id" placeholder="John" /><br />

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
    
    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
</script>
</div>
    <script type="module" src="./index.js"></script>
    <script src="./node_modules/axios/dist/axios.min.js"></script>

<?php else : ?>

<!-- Если пользователь не авторизован выведет ссылки на авторизацию и регистрацию -->
<a href="login.php">Log in</a><br>
<a href="signup.php">Registration</a>
<?php endif; ?>

<?php require __DIR__ . '/footer.php'; ?> <!-- Подключаем подвал проекта -->