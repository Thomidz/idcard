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

            // 1. Tampilkan ID Card
            displayIDCard(Nama, NIM, JURUSAN, imageSrc);

            // 2. Simpan ke database
            const formData = new FormData();
            formData.append("nama", Nama);
            formData.append("jurusan", JURUSAN);
            formData.append("foto", imageSrc);

            fetch("save_history.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.text())
            .then(data => console.log("Riwayat berhasil disimpan:", data))
            .catch(error => console.error("Error:", error));
        };

        reader.readAsDataURL(Gambar.files[0]);
    }
});

function displayIDCard(Nama, NIM, JURUSAN, imageSrc) {
    const idCardContainer = document.querySelector(".id-card-container");

    idCardContainer.innerHTML = `
        <div class="id-card border p-3 text-center shadow"
             style="width: 300px; border-radius: 15px; background: white;">
          <div class="fw-bold border-bottom mb-2 pb-1">ID CARD USU</div>
          <img src="${imageSrc}" class="img-thumbnail mb-2"
               style="width: 150px; height: 180px; object-fit: cover;">
          <div class="fw-bold text-uppercase">${Nama}</div>
          <div class="text-muted small">${NIM}</div>
          <div class="fw-semibold">${JURUSAN}</div>
          <div class="mt-3 text-primary fw-bold" style="font-size: 0.8rem;">
            UNIVERSITAS SUMATERA UTARA
          </div>
        </div>
    `;
}
