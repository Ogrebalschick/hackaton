const button = document.getElementById("getTasks");
// button.addEventListener("click", () => {
  axios.get("http://localhost:8080/tasks").then(function (response) {
    response.data.forEach((task) => {
      const div = document.createElement("div");
      div.className = "task";
      const id = document.createElement("p");
      id.innerText = "id: " + task.id;

      const usernames = document.createElement("p");
      usernames.innerText = "usernames: " + task.usernames;

      const tags = document.createElement("p");
      tags.innerText = "tags: " + task.tags;

      const description = document.createElement("p");
      description.innerText = "description: " + task.description;

      const done = document.createElement("p");
      done.innerText = "done: " + task.done;

      const deadline = document.createElement("p");
      deadline.innerText = "deadline: " + task.deadline;

      const author = document.createElement("p");
      author.innerText = "author: " + task.author;

      div.appendChild(id);
      div.appendChild(usernames);
      div.appendChild(done);
      div.appendChild(tags);
      div.appendChild(description);
      div.appendChild(deadline);
      div.appendChild(author);
      document.getElementById("tasks__div").appendChild(div);
    });
  });
// });

const form = document.getElementById("create-task");

const form2 = document.getElementById("delete-task");

// const createTask = document.getElementById("createTask");
// createTask.addEventListener("click", () => {
//   if (form.style.display == "block") {
//     form.style.display = "none";
//   } else {
//     form.style.display = "block";
//   }
// });

// const deleteTask = document.getElementById("deleteTask");
// deleteTask.addEventListener("click", () => {
//   if (form2.style.display == "block") {
//     form2.style.display = "none";
//   } else {
//     form2.style.display = "block";
//   }
// });

form.addEventListener("submit", (event) => {
  event.preventDefault();
  let usernames = form.elements["usernames"].value;
  let tags = form.elements["tags"].value;
  let done =
    form.elements["done"].value === "true" ||
    form.elements["done"].value === "True";
  let deadline = form.elements["deadline"].value;
  let author = form.elements["author"].value;
  axios
    .post("http://localhost:8080/create", {
      usernames,
      tags,
      done,
      deadline,
      author,
    })
    .then(function (response) {
      console.log(response);
    });
});
form2.addEventListener("submit", (event) => {
  event.preventDefault();
  let id = form2.elements["id"].value;
  axios.post("http://localhost:8080/delete", {
    id,
  });
});
