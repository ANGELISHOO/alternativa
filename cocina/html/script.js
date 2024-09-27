document.addEventListener("keyup", (e) => {
    if (e.target.matches("#buscador")) {
        const inputText = e.target.value.trim();
        if (inputText !== "") {
            const xhr = new XMLHttpRequest();
            xhr.open("GET", `search.php?q=${inputText}`, true);
            xhr.onload = function () {
                if (xhr.status === 200) {
                    const listaUsuarios = document.getElementById("listaUsuarios");
                    listaUsuarios.innerHTML = xhr.responseText;
                } else {
                    console.error("Error al buscar en la base de datos");
                }
            };
            xhr.send();
        } else {
            const listaUsuarios = document.getElementById("listaUsuarios");
            listaUsuarios.innerHTML = "";
        }
    }
});
