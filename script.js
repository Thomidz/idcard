const root = document.querySelector(".root");

// Menambahkan header
const headerHTML = `
    <div class="header">
        <h3>Tugas-2 Praktikum Pemrograman Web</h3>
    </div>
`;

const formHTML = `
<div class="form-container">
  <div class="card" style="width: 30rem;">
    <div class="card-body">
      <div class="container mt-5">
        <h3 class="text-center">ID CARD USU</h3>
        <form id="FORMIDCARD" class="mt-4">
          <div class="mb-3">
            <label for="Nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="Nama" placeholder="Masukkan Nama Panggilan" required>
          </div>
          <div class="mb-3">
            <label for="NIM" class="form-label">NIM</label>
            <input type="text" class="form-control" id="NIM" placeholder="Masukkan NIM" required>
          </div>
          <div class="mb-3">
            <label for="JURUSAN" class="form-label">JURUSAN</label>
            <input type="text" class="form-control" id="JURUSAN" placeholder="Masukkan Jurusan" required>
          </div>
          <div class="mb-3">
            <label for="Gambar" class="form-label">Upload Foto ID CARD</label>
            <input type="file" class="form-control" id="Gambar" accept="image/*" required>
          </div>
          <div class="mt-5 d-flex justify-content-center">
            <button type="submit" class="btn btn-primary">MAKE ID CARD</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="id-card-container"></div>
</div>
`;

// Menyusun HTML di dalam root
root.innerHTML = headerHTML + formHTML;

// Event listener untuk form submission
document.getElementById("FORMIDCARD").addEventListener("submit", function (event) {
    event.preventDefault();
    
    const Nama = document.getElementById("Nama").value;
    const NIM = document.getElementById("NIM").value;
    const JURUSAN = document.getElementById("JURUSAN").value;
    
    const Gambar = document.getElementById("Gambar");
    let imageSrc = "https://via.placeholder.com/200"; 
    if (Gambar.files && Gambar.files[0]) {
      const reader = new FileReader();
      reader.onload = function (e) {
        imageSrc = e.target.result;
        displayIDCard(Nama, NIM, JURUSAN, imageSrc);
      };
      reader.readAsDataURL(Gambar.files[0]);
    } else {
      displayIDCard(Nama, NIM, JURUSAN, imageSrc); 
    }
});

function displayIDCard(Nama, NIM, JURUSAN, imageSrc) {
    console.log({ Nama, NIM, JURUSAN, imageSrc });
    const idCardContainer = document.querySelector(".id-card-container");

    const idCard = `
      <div class="id-card">
      <div class="id-cardhead">ID CARD</div>
      <img src="${imageSrc}" alt="Profile Picture" class="profile-pic">
      <div class="Nama">${Nama}</div>
      <div class="NIM">(${NIM})</div>
      <div class="class">${JURUSAN}</div>
      <div class="USU">UNIVERSITAS SUMATERA UTARA</div>
      </div>
    `;

    idCardContainer.innerHTML = idCard;
}
