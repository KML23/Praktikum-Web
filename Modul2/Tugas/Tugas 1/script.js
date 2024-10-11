let currentInput = "";
let operator = "";
let previousInput = "";

const display = document.getElementById("display");
const buttons = document.querySelectorAll(".button");

buttons.forEach((button) => {
  button.addEventListener("click", () => {
    const buttonText = button.innerText;

    if (buttonText === "AC") {
      clearAll();
    } else if (buttonText === "=") {
      calculate();
    } else if (buttonText === "±") {
      toggleSign();
    } else {
      handleInput(buttonText);
    }
  });
});

function clearAll() {
  currentInput = "";
  operator = "";
  previousInput = "";
  display.innerText = "0";
}

function handleInput(value) {
  if (["+", "-", "×", "÷", "%", "±", "**"].includes(value)) {
    if (currentInput === "") return; // Ignore if no input
    if (previousInput !== "") {
      calculate();
    }
    operator =
      value === "×" ? "*" : value === "÷" ? "/" : value === "%" ? "%" : value;
    previousInput = currentInput;
    currentInput = "";
  } else {
    currentInput += value;
    display.innerText = currentInput;
  }
}

function toggleSign() {
  if (currentInput) {
    currentInput = (parseFloat(currentInput) * -1).toString();
    display.innerText = currentInput;
  }
}

function calculate() {
  if (currentInput === "" || previousInput === "") return;
  let result;
  const prev = parseFloat(previousInput);
  const current = parseFloat(currentInput);

  switch (operator) {
    case "+":
      result = prev + current;
      break;
    case "-":
      result = prev - current;
      break;
    case "*":
      result = prev * current;
      break;
    case "/":
      result = prev / current;
      break;
    case "%":
      result = prev % current;
      break;
    case "**":
      result = Math.pow(prev, current);
      break;
    default:
      return;
  }
  currentInput = result.toString();
  operator = "";
  previousInput = "";
  display.innerText = currentInput;
}
