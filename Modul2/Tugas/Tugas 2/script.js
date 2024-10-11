const todoInput = document.getElementById("todoInput");
const addButton = document.getElementById("addButton");
const todoList = document.getElementById("todoList");

// Function to create a todo item
function createTodoItem(task) {
  const todoItem = document.createElement("div");
  todoItem.className = "todo-item";

  const taskText = document.createElement("span");
  taskText.innerText = task;

  const editButton = document.createElement("button");
  editButton.innerHTML = '<i class="fas fa-edit"></i>';
  editButton.onclick = () => editTask(todoItem, taskText);

  const deleteButton = document.createElement("button");
  deleteButton.innerHTML = '<i class="fas fa-trash-alt"></i>';
  deleteButton.onclick = () => todoItem.remove();

  todoItem.appendChild(taskText);
  todoItem.appendChild(editButton);
  todoItem.appendChild(deleteButton);
  todoList.appendChild(todoItem);
}

// Function to handle adding a new task
const addTask = () => {
  const task = todoInput.value.trim();
  if (task) {
    createTodoItem(task);
    todoInput.value = "";
  } else {
    alert("Please enter a task!");
  }
};

// Event listener for Add button
addButton.onclick = addTask;

// Event listener for Enter key press
todoInput.addEventListener("keypress", (event) => {
  if (event.key === "Enter") {
    addTask();
  }
});

// Function to edit an existing task
function editTask(todoItem, taskText) {
  const newTask = prompt("Edit your task:", taskText.innerText);
  if (newTask !== null && newTask.trim() !== "") {
    taskText.innerText = newTask;
  }
}
