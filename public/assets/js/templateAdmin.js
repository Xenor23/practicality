document.getElementById('darkModeButton').addEventListener('click', function() {
    document.body.classList.toggle('dark-mode');
    if (document.body.classList.contains('dark-mode')) {
        localStorage.setItem('theme', 'dark');
    } else {
        localStorage.setItem('theme', 'light');
    }
});

// Vérifier la préférence de l'utilisateur au chargement de la page
if (localStorage.getItem('theme') === 'dark') {
    document.body.classList.add('dark-mode');
}