document.getElementById('logout').addEventListener('click', (event) => {
    event.preventDefault(); // Impede o comportamento padrão do link
    Swal.fire({
        title: "Você deseja sair?",
        icon: "warning",
        showCancelButton: true,
        cancelButtonText: "Cancelar",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sim, sair",
        confirmButtonColor: "#4b3f35",
        backdrop: `rgba(0, 0, 0, 0.5)`
    }).then((result) => {
        if (result.isConfirmed) {
            fetch('logout.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        window.location.href = "index.php";
                    }
                })
                .catch(error => console.error('Erro:', error));
        }
    });
});
