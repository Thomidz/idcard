document.addEventListener("DOMContentLoaded", function () {

    const form = document.getElementById("FORMIDCARD");
    const btnPdf = document.getElementById("btnPdf");

    if (!form) {
        console.error("FORMIDCARD tidak ditemukan!");
        return;
    }

    form.addEventListener("submit", function (event) {
        event.preventDefault();

        const Nama = document.getElementById("Nama").value;
        const NIM = document.getElementById("NIM").value;
        const JURUSAN = document.getElementById("JURUSAN").value;
        const Gambar = document.getElementById("Gambar");

        if (!Gambar.files || !Gambar.files[0]) {
            alert("Silakan upload foto!");
            return;
        }

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
            .then(res => res.text())
            .then(data => console.log("Tersimpan:", data))
            .catch(err => console.error(err));
        };

        reader.readAsDataURL(Gambar.files[0]);
    });

function displayIDCard(Nama, NIM, JURUSAN, imageSrc) {
    const container = document.querySelector(".id-card-container");

    container.innerHTML = `
        <div id="cardToPrint"
             class="id-card shadow text-white position-relative"
             style="
                width:300px;
                height:420px;
                border-radius:15px;
                background-image:url('assets/bgid.png');
                background-size:cover;
                background-position:center;
                overflow:hidden;
             ">

            <!-- Overlay agar teks jelas -->
            <div style="
                position:absolute;
                inset:0;
                background:rgba(0,0,0,0.3);
                z-index:1;
            "></div>

            <!-- CONTENT -->
            <div style="position:relative; z-index:2;" class="h-100 p-3 text-center">

                <div class="fw-bold mb-2 border-bottom pb-1">
                    ID CARD USU
                </div>

                <img src="${imageSrc}"
                     class="img-thumbnail mb-2"
                     style="
                        width:130px;
                        height:160px;
                        object-fit:cover;
                        border-radius:10px;
                     ">

                <div class="fw-bold text-uppercase">${Nama}</div>
                <div class="small">${NIM}</div>
                <div class="fw-semibold">${JURUSAN}</div>

                <div class="mt-auto fw-bold"
                     style="font-size:0.75rem; margin-top:15px;">
                    UNIVERSITAS SUMATERA UTARA
                </div>

            </div>
        </div>
    `;

    // tampilkan tombol PDF
    const btnPdf = document.getElementById("btnPdf");
    if (btnPdf) btnPdf.classList.remove("d-none");
}

    // ===== SAVE PDF =====
    if (btnPdf) {
        btnPdf.addEventListener("click", function () {
            const element = document.getElementById("cardToPrint");

            if (!element) {
                alert("ID Card belum dibuat!");
                return;
            }

            html2pdf().set({
                margin: 0.3,
                filename: "ID-Card-USU.pdf",
                image: { type: "jpeg", quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: "in", format: "a4", orientation: "portrait" }
            }).from(element).save();
        });
    }

});
