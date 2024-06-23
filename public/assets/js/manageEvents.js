const container = document.getElementById('container');
const createEventBtn = document.getElementById('createEvent');
const editEventBtn = document.getElementById('editEvent');

createEventBtn.addEventListener('click', () => {
    container.classList.add("active");
});

editEventBtn.addEventListener('click', () => {
    container.classList.remove("active");
});