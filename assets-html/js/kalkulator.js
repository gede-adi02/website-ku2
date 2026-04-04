let displayValue = "";

function appendToDisplay(value) {
    displayValue += value;
    document.getElementById("display-screen").innerText = displayValue;
}

function clearDisplay() {
    displayValue = "";
    document.getElementById("display-screen").innerText = "0";
}

function deleteLast() {
    displayValue = displayValue.slice(0, -1);
    document.getElementById("display-screen").innerText = displayValue || "0";
}

function calculateResult() {
    try {
        const result = eval(displayValue);
        document.getElementById("display-screen").innerText = result;
        displayValue = result.toString();
    } catch (error) {
        alert("Input tidak valid!");
        clearDisplay();
    }
}

document.addEventListener('keydown', function(event) {
    const key = event.key;

    if (key === '(' || key === ')') {
        appendToDisplay(key);
    }
    else if (!isNaN(key) && event.shiftKey === false && key !== ' ') {
        appendToDisplay(key);
    }
    else if (key === '+' || key === '-' || key === '*' || key === '/') {
        appendToDisplay(key);
    }
    else if (key === 'Enter') {
        event.preventDefault();
        calculateResult();
    }
    else if (key === 'Backspace') {
        deleteLast();
    }
    else if (key === 'Delete' || key.toLowerCase() === 'c') {
        clearDisplay();
    }
});