const productGrid = document.getElementById('productGrid');
const resultInfo = document.getElementById('resultInfo');
const searchInput = document.getElementById('searchInput');
const categoryFilter = document.getElementById('categoryFilter');
const locationFilter = document.getElementById('locationFilter');
const form = document.getElementById('barangForm');
const formMessage = document.getElementById('formMessage');

let products = [];

const defaultProducts = [
  {
    id: 1,
    name: 'Nike Air Sneakers',
    category: 'Fashion',
    condition: 'Sangat Baik',
    description: 'Sepatu original, jarang dipakai dan masih terlihat baru.',
    location: 'Malang',
    rating: '4.9',
    owner: 'Andi',
    avatar: 'A',
    time: '2 jam lalu',
    icon: '👟',
    color: '#dbeafe',
    wanted: 'Tas atau laptop',
  },
  {
    id: 2,
    name: 'Laptop ASUS',
    category: 'Elektronik',
    condition: 'Baik',
    description: 'Laptop untuk mahasiswa dan pekerjaan ringan, kondisi masih bagus.',
    location: 'Bandung',
    rating: '4.8',
    owner: 'Budi',
    avatar: 'B',
    time: '4 jam lalu',
    icon: '💻',
    color: '#ede9fe',
    wanted: 'Smartphone',
  },
  {
    id: 3,
    name: 'Tas Kuliah',
    category: 'Fashion',
    condition: 'Baik',
    description: 'Tas dengan kapasitas besar, cocok untuk kebutuhan harian.',
    location: 'Surabaya',
    rating: '4.7',
    owner: 'Citra',
    avatar: 'C',
    time: '1 hari lalu',
    icon: '🎒',
    color: '#ffedd5',
    wanted: 'Sepatu',
  },
  {
    id: 4,
    name: 'Controller PS5',
    category: 'Hobi',
    condition: 'Sangat Baik',
    description: 'Controller masih berfungsi dengan baik dan sering digunakan.',
    location: 'Jakarta',
    rating: '5.0',
    owner: 'Dimas',
    avatar: 'D',
    time: '2 hari lalu',
    icon: '🎮',
    color: '#dcfce7',
    wanted: 'Headset gaming',
  },
  {
    id: 5,
    name: 'Buku Pemrograman',
    category: 'Buku',
    condition: 'Layak Pakai',
    description: 'Buku baru setengah, lengkap dengan contoh program.',
    location: 'Malang',
    rating: '4.6',
    owner: 'Eka',
    avatar: 'E',
    time: '3 hari lalu',
    icon: '📚',
    color: '#fef3c7',
    wanted: 'Buku lainnya',
  },
  {
    id: 6,
    name: 'Raket Badminton',
    category: 'Olahraga',
    condition: 'Baik',
    description: 'Raket ringan dan nyaman digunakan untuk latihan harian.',
    location: 'Bandung',
    rating: '4.8',
    owner: 'Fani',
    avatar: 'F',
    time: '5 hari lalu',
    icon: '🏸',
    color: '#e0f2fe',
    wanted: 'Sepatu olahraga',
  },
];

let favorites = new Set();

function getFilteredProducts() {
  const keyword = searchInput.value.trim().toLowerCase();
  const category = categoryFilter.value;
  const location = locationFilter.value;

  return products.filter((product) => {
    const matchesKeyword =
      product.name.toLowerCase().includes(keyword) ||
      product.description.toLowerCase().includes(keyword) ||
      product.category.toLowerCase().includes(keyword);

    const matchesCategory = !category || product.category === category;
    const matchesLocation = !location || product.location === location;

    return matchesKeyword && matchesCategory && matchesLocation;
  });
}

function renderProducts() {
  const filtered = getFilteredProducts();
  resultInfo.textContent = `Menampilkan ${filtered.length} barang`;

  if (!filtered.length) {
    productGrid.innerHTML = `
      <div class="product-card" style="grid-column: 1 / -1; padding: 32px; text-align: center;">
        <h3>Barang tidak ditemukan</h3>
        <p style="margin-top: 8px; color: #64748b;">Coba kata kunci atau filter lain.</p>
      </div>
    `;
    return;
  }

  productGrid.innerHTML = filtered
    .map(
      (product) => `
        <article class="product-card">
          <div class="product-visual" style="background: ${product.color};">
            <span class="product-badge">${product.condition}</span>
            <button class="favorite-btn" data-id="${product.id}" aria-label="Favorit ${product.name}">
              ${favorites.has(product.id) ? '♥' : '♡'}
            </button>
            <span>${product.icon}</span>
          </div>

          <div class="product-body">
            <div class="product-category">${product.category}</div>
            <h3>${product.name}</h3>
            <p>${product.description}</p>

            <div class="meta-row">
              <span>📍 ${product.location}</span>
              <span>⭐ ${product.rating}</span>
            </div>

            <div class="card-footer">
              <div class="owner-wrap">
                <div class="owner-avatar">${product.avatar}</div>
                <div>
                  <strong>${product.owner}</strong>
                  <small>${product.time}</small>
                </div>
              </div>
              <button class="barter-btn" data-id="${product.id}">Barter</button>
            </div>
          </div>
        </article>
      `
    )
    .join('');
}

async function loadProducts() {
  try {
    const response = await fetch('db.json');
    if (!response.ok) {
      throw new Error('Gagal mengambil data');
    }

    const data = await response.json();
    products = data;
    renderProducts();
  } catch (error) {
    products = defaultProducts;
    renderProducts();
  }
}

searchInput.addEventListener('input', renderProducts);
categoryFilter.addEventListener('change', renderProducts);
locationFilter.addEventListener('change', renderProducts);

productGrid.addEventListener('click', (event) => {
  const favoriteButton = event.target.closest('.favorite-btn');
  if (favoriteButton) {
    const id = Number(favoriteButton.dataset.id);
    if (favorites.has(id)) {
      favorites.delete(id);
    } else {
      favorites.add(id);
    }
    renderProducts();
    return;
  }

  const barterButton = event.target.closest('.barter-btn');
  if (barterButton) {
    const id = Number(barterButton.dataset.id);
    const product = products.find((item) => item.id === id);

    if (product) {
      alert(`Kamu ingin menukarkan barang dengan: ${product.name}\nTawaran: ${product.wanted}`);
    }
  }
});

form.addEventListener('submit', (event) => {
  event.preventDefault();

  const formData = new FormData(form);
  const newItem = {
    id: Date.now(),
    name: formData.get('namaBarang').trim(),
    category: formData.get('kategori').trim(),
    condition: formData.get('kondisi').trim(),
    description: formData.get('deskripsi').trim(),
    location: formData.get('lokasi').trim(),
    wanted: formData.get('tawaran').trim(),
    rating: '4.8',
    owner: 'Saya',
    avatar: 'S',
    time: 'baru saja',
    icon: '📦',
    color: '#ecfccb',
  };

  products.unshift(newItem);
  form.reset();
  formMessage.textContent = 'Barang berhasil ditambahkan!';
  renderProducts();
});

loadProducts();
