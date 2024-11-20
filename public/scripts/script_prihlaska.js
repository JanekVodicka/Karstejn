function toggleTextInput() {
    const radio = document.getElementById('Jine');
    const pole_jine = document.getElementById('input-text-jine');

    if (radio.checked) {
        pole_jine.disabled = false;
        console.log("Ahoj")
    } else {
        pole_jine.disabled = true;
    }
}