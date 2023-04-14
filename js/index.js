document.querySelectorAll("tbody > tr").forEach(row => {
    row.addEventListener('click', event => {
        if (row.classList.contains("clicked-row")) {
            row.classList.remove("clicked-row");
        }
        else {
            row.classList.add("clicked-row");
        }
    });
});