const root = document.querySelector(".root");

const headerHTML = `
    <div class="header text-center py-3">
        <h3>Tugas-2 Praktikum Pemrograman Web</h3>
    </div>
`;

const formHTML = `
<div class="form-container d-flex flex-column align-items-center mt-4">
  <div class="card" style="width: 30rem;">
    <div class="card-body">
        <h3 class="text-center">ID CARD USU</h3>
        <form id="FORMIDCARD" class="mt-4">
          <div class="mb-3">
            <label for="Nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="Nama" placeholder="Nama Lengkap" required>
          </div>
          <div class="mb-3">
            <label for="NIM" class="form-label">NIM</label>
            <input type="text" class="form-control" id="NIM" placeholder="Nomor Induk Mahasiswa" required>
          </div>
          <div class="mb-3">
            <label for="JURUSAN" class="form-label">JURUSAN</label>
            <input type="text" class="form-control" id="JURUSAN" placeholder="Program Studi" required>
          </div>
          <div class="mb-3">
            <label for="Gambar" class="form-label">Upload Foto</label>
            <input type="file" class="form-control" id="Gambar" accept="image/*" required>
          </div>
          <div class="mt-4 d-flex justify-content-center">
            <button type="submit" class="btn btn-primary w-100">MAKE ID CARD</button>
          </div>
        </form>
    </div>
  </div>
  <div class="id-card-container mt-5"></div>
</div>
`;

root.innerHTML = headerHTML + formHTML;

document.getElementById("FORMIDCARD").addEventListener("submit", function (event) {
    event.preventDefault();
    
    const Nama = document.getElementById("Nama").value;
    const NIM = document.getElementById("NIM").value;
    const JURUSAN = document.getElementById("JURUSAN").value;
    const Gambar = document.getElementById("Gambar");

    if (Gambar.files && Gambar.files[0]) {
        const reader = new FileReader();
        reader.onload = function (e) {
            const imageSrc = e.target.result;
            
            // 1. Tampilkan ID Card di halaman
            displayIDCard(Nama, NIM, JURUSAN, imageSrc);

            // 2. Kirim data ke database via Fetch API
            const formData = new FormData();
            formData.append('nama', Nama);
            formData.append('jurusan', JURUSAN);
            formData.append('foto', imageSrc); // Mengirim base64 image

            fetch('save_history.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                console.log("Riwayat berhasil disimpan:", data);
            })
            .catch(error => console.error("Error:", error));
        };
        reader.readAsDataURL(Gambar.files[0]);
    }
});

function displayIDCard(Nama, NIM, JURUSAN, imageSrc) {
    const idCardContainer = document.querySelector(".id-card-container");
    const idCard = `
      <div class="id-card border p-3 text-center shadow" style="width: 300px; border-radius: 15px; background: white;">
        <div class="fw-bold border-bottom mb-2 pb-1">ID CARD USU</div>
        <img src="${imageSrc}" alt="Profile" class="profile-pic img-thumbnail mb-2" style="width: 150px; height: 180px; object-fit: cover;">
        <div class="Nama fw-bold text-uppercase">${Nama}</div>
        <div class="NIM text-muted small">${NIM}</div>
        <div class="class fw-semibold">${JURUSAN}</div>
        <div class="USU mt-3 text-primary fw-bold" style="font-size: 0.8rem;">UNIVERSITAS SUMATERA UTARA</div>
      </div>
    `;
    idCardContainer.innerHTML = idCard;
}