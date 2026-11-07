const apiUrl = "http://192.168.18.20:3000/admins";

async function fetchData() {
    const loading = document.getElementById("loading");
    const error = document.getElementById("error");
    const container = document.getElementById("data-container");

    loading.textContent = "Sedang mengambil data...";
    error.textContent = "";
    container.innerHTML = "";

    try {
        const response = await fetch(apiUrl);

        if (!response.ok) {
            throw new Error("Gagal mengambil data");
        }

        const data = await response.json();

        data.forEach((user) => {
            container.innerHTML += `
                <div>
                    <h3>${user.name}</h3>
                    <p>${user.email}</p>
                </div>
            `;
        });

    } catch (err) {
        error.textContent = err.message;

    } finally {
        loading.textContent = "";
    }
}

fetchData();