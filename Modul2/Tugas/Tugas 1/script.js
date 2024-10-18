let currentInput = "";
let operator = "";
let previousInput = "";
let expression = "";

const display = document.getElementById("display");
const expressionDisplay = document.getElementById("expression-display");
const buttons = document.querySelectorAll(".button");

buttons.forEach((button) => {
  button.addEventListener("click", () => {
    const buttonText = button.innerText;

    if (buttonText === "C") {
      clearAll();
    } else if (buttonText === "=") {
      calculate();
    } else if (buttonText === "±") {
      toggleSign();
    } else if (buttonText === "%") {
      handleModulus();
    } else {
      handleInput(buttonText);
    }
    adjustDisplaySize();
  });
});

document.addEventListener("keydown", (event) => {
  const key = event.key;

  if (event.shiftKey && key === "Enter") {
    clearAll();
    return;
  }

  const keyMappings = {
    0: "0",
    1: "1",
    2: "2",
    3: "3",
    4: "4",
    5: "5",
    6: "6",
    7: "7",
    8: "8",
    9: "9",
    ".": ".",
    "/": "÷",
    "*": "×",
    "-": "−",
    "+": "+",
    "=": "=",
    Enter: "=",
    Backspace: "Backspace",
    "%": "%",
  };

  if (keyMappings[key]) {
    if (key === "Backspace") {
      deleteLastInput();
    } else if (key === "%") {
      handleModulus();
    } else {
      const button = [...buttons].find((b) => b.innerText === keyMappings[key]);
      if (button) button.click();
    }
  }
});

function clearAll() {
  currentInput = "";
  operator = "";
  previousInput = "";
  expression = "";
  display.innerText = "0";
  expressionDisplay.innerText = "";
  display.style.transform = "scale(1)";
}

function deleteLastInput() {
  if (currentInput) {
    currentInput = currentInput.slice(0, -1);
    display.innerText = currentInput || "0";
  } else if (operator) {
    operator = "";
  } else if (previousInput) {
    previousInput = previousInput.slice(0, -1);
    expression = expression.slice(0, -1);
    expressionDisplay.innerText = expression;
    display.innerText = previousInput || "0";
  }
}

function handleInput(value) {
  // Cek jika value adalah operator
  if (["+", "-", "×", "÷"].includes(value)) {
    // Jika tidak ada input saat ini, tidak lakukan apa-apa
    if (currentInput === "") return;

    // Jika ada operator sebelumnya
    if (operator) {
      // Ganti operator yang sebelumnya dengan yang baru
      expression = expression.slice(0, -2); // Menghapus operator terakhir dari ekspresi
    } else {
      // Jika tidak ada operator sebelumnya, simpan input saat ini
      previousInput = currentInput;
    }

    // Set operator baru
    operator = value === "×" ? "*" : value === "÷" ? "/" : value;

    // Tambahkan input saat ini dan operator baru ke ekspresi
    expression += currentInput + " " + operator + " ";
    expressionDisplay.innerText = expression; // Tampilkan ekspresi
    currentInput = ""; // Kosongkan input saat ini
  } else {
    // Jika input bukan operator, tambahkan ke currentInput
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

function handleModulus() {
  if (currentInput === "" || previousInput === "") return;
  let result;
  const prev = parseFloat(previousInput);
  const current = parseFloat(currentInput);

  result = prev % current;

  expression += currentInput + " =";
  expressionDisplay.innerText = expression;
  currentInput = result.toString();
  operator = "";
  previousInput = "";
  display.innerText = currentInput;
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
    default:
      return;
  }

  expression += currentInput + " =";
  expressionDisplay.innerText = expression;
  currentInput = result.toString();
  operator = "";
  previousInput = "";
  display.innerText = currentInput;
}

function adjustDisplaySize() {
  const length = display.innerText.length;

  if (length > 10) {
    display.style.transform = "scale(0.6)";
  } else if (length > 6) {
    display.style.transform = "scale(0.8)";
  } else {
    display.style.transform = "scale(1)";
  }
}
