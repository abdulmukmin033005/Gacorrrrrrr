// DATA BARANG
const products = [
    {
        id: 1,
        name: "Nike Air Sneakers",
        category: "Fashion",
        condition: "Sangat Baik",
        description: "Sepatu original, jarang digunakan dan masih sangat bagus.",
        location: "Malang",
        rating: "4.9",
        owner: "Andi",
        avatar: "A",
        time: "2 jam lalu",
        icon: "👟",
        color: "bg-blue-50",
        wanted: "Tas atau laptop"
    },
    {
        id: 2,
        name: "Laptop ASUS",
        category: "Elektronik",
        condition: "Baik",
        description: "Laptop untuk kuliah dan pekerjaan sehari-hari.",
        location: "Malang",
        rating: "4.8",
        owner: "Budi",
        avatar: "B",
        time: "4 jam lalu",
        icon: "💻",
        color: "bg-purple-50",
        wanted: "Smartphone"
    },
    {
        id: 3,
        name: "Tas Kuliah",
        category: "Fashion",
        condition: "Baik",
        description: "Tas dengan banyak ruang, cocok untuk mahasiswa.",
        location: "Bandung",
        rating: "4.7",
        owner: "Citra",
        avatar: "C",
        time: "1 hari lalu",
        icon: "🎒",
        color: "bg-orange-50",
        wanted: "Sepatu"
    },
    {
        id: 4,
        name: "Controller PS5",
        category: "Hobi",
        condition: "Sangat Baik",
        description: "Controller masih berfungsi dengan sangat baik.",
        location: "Surabaya",
        rating: "5.0",
        owner: "Dimas",
        avatar: "D",
        time: "1 hari lalu",
        icon: "🎮",
        color: "bg-green-50",
        wanted: "Headset gaming"
    }
];

const productGrid = document.getElementById("product-grid");
const searchForm = document.getElementById("search-form");
const searchInput = document.getElementById("search-input");
const categoryFilter = document.getElementById("category-filter");
const locationFilter = document.getElementById("location-filter");
const searchResult = document.getElementById("search-result");

const favoriteItems = new Set();
let selectedCategory = "";
let activeProduct = null;

// RENDER KARTU BARANG
function renderProducts() {
    const keyword = searchInput.value.trim().toLowerCase();
    const category = selectedCategory || categoryFilter.value;
    const location = locationFilter.value;

    const filteredProducts = products.filter((product) => {
        const matchesKeyword =
            product.name.toLowerCase().includes(keyword) ||
            product.description.toLowerCase().includes(keyword) ||
            product.category.toLowerCase().includes(keyword);

        const matchesCategory = !category || product.category === category;
        const matchesLocation = !location || product.location === location;

        return matchesKeyword && matchesCategory && matchesLocation;
    });

    searchResult.textContent =
        `Menampilkan ${filteredProducts.length} barang`;

    if (filteredProducts.length === 0) {
        productGrid.innerHTML = `
            <div class="col-span-full rounded-2xl border border-dashed border-slate-300 p-12 text-center">
                <div class="mb-3 text-5xl">🔎</div>
                <h3 class="text-xl font-bold">Barang tidak ditemukan</h3>
                <p class="mt-2 text-slate-500">Coba kata kunci atau kategori lainnya.</p>
            </div>
        `;
        return;
    }

    productGrid.innerHTML = filteredProducts.map((product) => `
        <article class="overflow-hidden rounded-2xl border border-slate-200 bg-white transition duration-200 hover:-translate-y-1 hover:shadow-xl">
            <div class="relative grid min-h-47.5 place-items-center ${product.color}">
                <span class="absolute left-3 top-3 rounded-full bg-white px-3 py-1 text-xs font-extrabold text-green-700">
                    ${product.condition}
                </span>

                <button
                    class="favorite-button absolute right-3 top-3 grid h-9 w-9 place-items-center rounded-full bg-white text-xl"
                    data-id="${product.id}"
                    aria-label="Tambah ${product.name} ke favorit"
                    aria-pressed="${favoriteItems.has(product.id)}"
                >${favoriteItems.has(product.id) ? "♥" : "♡"}</button>

                <div class="text-7xl">${product.icon}</div>
            </div>

            <div class="p-5">
                <span class="text-xs font-extrabold text-blue-700">${product.category}</span>
                <h3 class="my-1 text-lg font-bold">${product.name}</h3>
                <p class="min-h-12 text-sm text-slate-500">${product.description}</p>

                <div class="my-4 flex justify-between gap-2 text-xs text-slate-500">
                    <span>📍 ${product.location}</span>
                    <span>★ ${product.rating}</span>
                </div>

                <div class="flex items-center justify-between gap-2">
                    <div class="flex items-center gap-2">
                        <div class="grid h-8 w-8 place-items-center rounded-full bg-blue-100 font-bold">${product.avatar}</div>
                        <div>
                            <strong class="block text-sm">${product.owner}</strong>
                            <small class="text-xs text-slate-400">${product.time}</small>
                        </div>
                    </div>
                    <button class="barter-button rounded-lg bg-blue-700 px-3 py-2 text-sm font-bold text-white hover:bg-blue-800" data-id="${product.id}">
                        Barter
                    </button>
                </div>
            </div>
        </article>
    `).join("");
}

// PENCARIAN
searchForm.addEventListener("submit", (event) => {
    event.preventDefault();
    selectedCategory = "";
    updateCategoryButtons();
    renderProducts();
});

searchInput.addEventListener("input", renderProducts);
categoryFilter.addEventListener("change", () => {
    selectedCategory = "";
    updateCategoryButtons();
    renderProducts();
});
locationFilter.addEventListener("change", renderProducts);

// FILTER KATEGORI
document.getElementById("categories").addEventListener("click", (event) => {
    const button = event.target.closest("[data-category]");
    if (!button) return;

    selectedCategory = button.dataset.category;
    categoryFilter.value = selectedCategory;
    updateCategoryButtons();
    renderProducts();
});

function updateCategoryButtons() {
    document.querySelectorAll(".category-button").forEach((button) => {
        const active = button.dataset.category === selectedCategory;

        button.classList.toggle("bg-blue-700", active);
        button.classList.toggle("text-white", active);
        button.classList.toggle("border-blue-700", active);
        button.classList.toggle("border-slate-200", !active);
    });
}

// FAVORIT DAN TOMBOL BARTER
productGrid.addEventListener("click", (event) => {
    const favoriteButton = event.target.closest(".favorite-button");

    if (favoriteButton) {
        const id = Number(favoriteButton.dataset.id);

        if (favoriteItems.has(id)) {
            favoriteItems.delete(id);
        } else {
            favoriteItems.add(id);
        }

        renderProducts();
        return;
    }

    const barterButton = event.target.closest(".barter-button");

    if (barterButton) {
        const id = Number(barterButton.dataset.id);
        activeProduct = products.find((product) => product.id === id);

        document.getElementById("modal-product").textContent =
            `Barang yang ingin kamu tukarkan: ${activeProduct.name}`;

        document.getElementById("barter-message").textContent = "";

        const modal = document.getElementById("barter-modal");
        modal.classList.remove("hidden");
        modal.classList.add("flex");
        document.getElementById("barter-name").focus();
    }
});

// TAMPILKAN FAVORIT
document.getElementById("favorite-nav").addEventListener("click", () => {
    const favoritesOnly = favoriteItems.size > 0;

    if (!favoritesOnly) {
        alert("Kamu belum memiliki barang favorit.");
        return;
    }

    const keyword = searchInput.value;
    const category = selectedCategory;
    const location = locationFilter.value;

    productGrid.innerHTML = products
        .filter((product) => favoriteItems.has(product.id))
        .map((product) => `
            <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="text-5xl">${product.icon}</div>
                <h3 class="mt-3 text-lg font-bold">${product.name}</h3>
                <p class="text-sm text-slate-500">${product.category} · ${product.location}</p>
                <button class="favorite-button mt-4 rounded-lg bg-blue-700 px-4 py-2 text-white" data-id="${product.id}">
                    Hapus Favorit ♥
                </button>
            </article>
        `).join("");

    searchResult.textContent = `Menampilkan ${favoriteItems.size} barang favorit`;

    searchInput.value = keyword;
    selectedCategory = category;
    locationFilter.value = location;
});

// FORM TAMBAH BARANG
document.getElementById("add-form").addEventListener("submit", (event) => {
    event.preventDefault();

    const name = document.getElementById("item-name").value.trim();
    const category = document.getElementById("item-category").value;
    const condition = document.getElementById("item-condition").value;
    const location = document.getElementById("item-location").value;
    const description = document.getElementById("item-description").value.trim();
    const wanted = document.getElementById("item-wanted").value.trim();
    const message = document.getElementById("form-message");

    if (!name || !category || !condition || !location || !description || !wanted) {
        message.textContent = "Semua kolom wajib diisi.";
        message.className = "text-sm text-red-600";
        return;
    }

    const newProduct = {
        id: Date.now(),
        name,
        category,
        condition,
        description,
        location,
        rating: "Baru",
        owner: "Kamu",
        avatar: "K",
        time: "Baru saja",
        icon: getCategoryIcon(category),
        color: "bg-blue-50",
        wanted
    };

    products.unshift(newProduct);

    event.target.reset();
    selectedCategory = "";
    searchInput.value = "";
    categoryFilter.value = "";
    locationFilter.value = "";

    updateCategoryButtons();
    renderProducts();

    message.textContent = "Barang berhasil ditambahkan ke daftar!";
    message.className = "text-sm font-semibold text-green-700";

    document.getElementById("barang").scrollIntoView({ behavior: "smooth" });
});

function getCategoryIcon(category) {
    const icons = {
        Elektronik: "💻",
        Fashion: "👕",
        Olahraga: "⚽",
        Buku: "📚",
        Hobi: "🎮"
    };

    return icons[category] || "📦";
}

// MODAL BARTER
const barterModal = document.getElementById("barter-modal");

function closeBarterModal() {
    barterModal.classList.add("hidden");
    barterModal.classList.remove("flex");
    activeProduct = null;
}

document.getElementById("modal-close").addEventListener("click", closeBarterModal);

barterModal.addEventListener("click", (event) => {
    if (event.target === barterModal) {
        closeBarterModal();
    }
});

document.addEventListener("keydown", (event) => {
    if (event.key === "Escape") closeBarterModal();
});

document.getElementById("barter-form").addEventListener("submit", (event) => {
    event.preventDefault();

    if (!activeProduct) return;

    const name = document.getElementById("barter-name").value.trim();
    const offer = document.getElementById("barter-offer").value.trim();
    const message = document.getElementById("barter-message");

    if (!name || !offer) {
        message.textContent = "Nama dan barang yang ditawarkan wajib diisi.";
        message.className = "text-sm text-red-600";
        return;
    }

    message.textContent =
        `Pengajuan barter untuk ${activeProduct.name} berhasil dibuat pada demo ini.`;
    message.className = "text-sm font-semibold text-green-700";

    event.target.reset();
});

// NAVBAR MOBILE
const menuToggle = document.getElementById("menu-toggle");
const navMenu = document.getElementById("nav-menu");

menuToggle.addEventListener("click", () => {
    const isHidden = navMenu.classList.toggle("max-[700px]:hidden");
    menuToggle.setAttribute("aria-expanded", String(!isHidden));
    menuToggle.textContent = isHidden ? "☰" : "×";
});

navMenu.querySelectorAll("a").forEach((link) => {
    link.addEventListener("click", () => {
        navMenu.classList.add("max-[700px]:hidden");
        menuToggle.setAttribute("aria-expanded", "false");
        menuToggle.textContent = "☰";
    });
});

// TOMBOL MASUK DEMO
document.getElementById("login-button").addEventListener("click", () => {
    alert("Fitur masuk belum terhubung ke sistem autentikasi.");
});

// TAMPILKAN DATA AWAL
renderProducts();