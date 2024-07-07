const listImageElmenet = document.querySelector(".list-image");
const inputFoto = document.getElementById("foto");
const btnLanjut = document.querySelector(".btn-lanjut");
const inputNamaAlbum = document.querySelector('.nama-album')

inputNamaAlbum.addEventListener('input', () => {
    validasiAlbum();
});

let currentListImageSelected = 1;

const labelInput = document.querySelector(".intro-content-wrapper");
if (labelInput) {
    labelInput.ondragenter = function (event) {
        labelInput.style.borderStyle = "solid";
    };
    labelInput.ondragleave = function (event) {
        labelInput.style.borderStyle = "dashed";
    };
    labelInput.addEventListener("dragover", function (event) {
        event.preventDefault();
    });
    labelInput.addEventListener("drop", function (event) {
        event.preventDefault();
        labelInput.style.borderStyle = "dashed";

        document.querySelector(".editior").classList.remove("d-none");
        document.querySelector(".intro").classList.add("d-none");

        let files = event.dataTransfer.files;
        if (files.length > 10) {
            showAlert("Maksimal memasukan 10 media", "danger");
            return;
        }

        for (var i = 0; i < files.length; i++) {
            addImage(files[i]);
        }
    });
}

if (inputFoto) {
    inputFoto.addEventListener("change", (event) => {
        document.querySelector(".editior")?.classList.remove("d-none");
        document.querySelector(".intro")?.classList.add("d-none");

        for (let file of inputFoto.files) {
            if (listImageElmenet.children.length > 9) {
                showAlert("Maksimal memasukan 10 media", "danger");
                break;
            }
            addImage(file);
        }

        inputFoto.value = "";
    });
}

function showAlert(pesan, type) {
    const alertEl = document.querySelector(".alert");
    if (alertEl.classList.contains(".d-none")) {
        alertEl.innerHTML = pesan;
        alertEl.classList.add("bg-" + type);
        alertEl.classList.remove("d-none");
        setTimeout(() => {
            alertEl.classList.add("d-none");
        }, 1000 * 10);
    }
}

let i = 0;
function addImage(file) {
    // membuat file sebagai data transfer
    const dt = new DataTransfer();
    dt.items.add(file);

    // membuat blob dari file
    const blob = URL.createObjectURL(file);

    // membuat element list image
    const divCardImage = document.createElement("div");
    divCardImage.classList.add("card-image", "mb-3", "rounded-4", "is-invalid");
    divCardImage.innerHTML = `
        <img class="h-100 w-100 object-fit-cover rounded-4 p-1 image">
        <input class="judul focus opacity-0 position-absolute w-0 h-0" style="cursor: default" type="text" readonly name="judul[]">
        <input class="keterangan" type="text" name="keterangan[]" hidden>
        <input class="file-image" type="file" name="foto[]" hidden>
        <button type="btn" class="btn btn-danger btn-hapus"><i class="fa-solid fa-xmark"></i></button>
    `;

    defineInput(divCardImage, dt.files);

    defineImagePreview(divCardImage, blob);

    setListImagePreview(divCardImage, blob);

    defineBtnHapus(divCardImage, blob);

    listImageElmenet.append(divCardImage);
    
    divCardImage.click();
}

function defineElement() {
    for (let index = 0; index < listImageElmenet.children.length; index++) {
        defineImagePreview(listImageElmenet.children[index]);
        defineInput(listImageElmenet.children[index]);
        // defineBtnHapus(listImageElmenet.children[index]);
        if (!listImageElmenet.children[index].classList.contains('d-none')) {
            listImageElmenet.children[index].click();
        }
    }
}
defineElement();

function defineInput(templateElement, file) {
    const input = templateElement.querySelector(".file-image");
    if (file) {
        input.files = file;
    }

    input.onchange = (event) => {
        templateElement.querySelector(".image").src = URL.createObjectURL(event.target.files[0]);
        templateElement.click();
    }
}

function setListImagePreview(templateElement, blob) {
    const image = templateElement.querySelector(".image");
    image.src = blob;

    image.onload = () => {
        image.classList.add("show");
    };
}

function defineImagePreview(templateElement, blob) {
    const image = templateElement.querySelector(".image");

    templateElement.onclick = () => {
        document.querySelector(".preview-image").src = image.src;

        for (let index = 0; index < listImageElmenet.children.length; index++) {
            listImageElmenet.children[index].classList.remove("active");
        }
        templateElement.classList.add("active");

        let current = 0;
        for (let index = 0; index < listImageElmenet.children.length; index++) {
            if (
                !listImageElmenet.children[index].classList.contains("active")
            ) {
                current++;
            } else {
                break;
            }
        }
        currentListImageSelected = listImageElmenet.children.length - current;

        document.querySelector(".btn-hapus-preview").onclick = () => {
            templateElement.querySelector(".btn-hapus").click();
        };

        document.querySelector(".btn-ubah-preview").onclick = () => {
            templateElement.querySelector(".file-image").click();
        };

        document.getElementById("judul").focus();

        document.getElementById("keterangan").value =
            templateElement.querySelector(".keterangan").value;
        document.getElementById("judul").value =
            templateElement.querySelector(".judul").value;

        document.getElementById("judul").oninput = () => {
            templateElement.querySelector(".judul").value =
                document.getElementById("judul").value;

            if (document.getElementById("judul").value == "") {
                templateElement.classList.remove("is-valid");
            } else {
                templateElement.classList.add("is-valid");
            }

            validasiAlbum();
        };

        document.getElementById("keterangan").oninput = () => {
            templateElement.querySelector(".keterangan").value =
                document.getElementById("keterangan").value;
        };
        validasiAlbum();
    };

    document
        .querySelector(".preview-image-wrapper .preview-image")
        .classList.remove("d-none");
    document
        .querySelector(".preview-image-wrapper .empty-preview")
        .classList.add("d-none");
}

function defineBtnHapus(templateElement, blob) {
    const btnHapus = templateElement.querySelector(".btn-hapus");
    btnHapus.onclick = (e) => {
        e.stopPropagation();
        templateElement.remove();

        URL.revokeObjectURL(blob);
        validasiAlbum();

        if (listImageElmenet.children.length == 0) {
            document.getElementById("keterangan").value = "";
            document.getElementById("judul").value = "";

            document
                .querySelector(".preview-image-wrapper .preview-image")
                .classList.add("d-none");
            document
                .querySelector(".preview-image-wrapper .empty-preview")
                .classList.remove("d-none");
            return;
        }
        listImageElmenet.children[listImageElmenet.children.length - 1].click();
    };

    return btnHapus;
}

const btnPaginationSebelum = document.querySelector(".btn-pagination.sebelum");
const btnPaginationSesudah = document.querySelector(".btn-pagination.sesudah");
btnPaginationSebelum.addEventListener("click", () => {
    if (currentListImageSelected > 1) {
        currentListImageSelected--;
    }
    tampilTerpilih();
});

btnPaginationSesudah.addEventListener("click", () => {
    if (currentListImageSelected < listImageElmenet.children.length) {
        currentListImageSelected++;
    }
    tampilTerpilih();
});

function tampilTerpilih() {
    let reverse = listImageElmenet.children.length - currentListImageSelected;
    const element = listImageElmenet.children[reverse];

    element?.click();
    element?.querySelector(".focus").focus();
    document.getElementById("judul").focus();
}

function validasiAlbum() {
    const listImageLength = listImageElmenet.children.length;

    if (listImageLength > 0 && inputNamaAlbum.value != '') {
        btnLanjut.removeAttribute("disabled");
    } else {
        btnLanjut.setAttribute("disabled", true);
    }

    return listImageLength > 0 && inputNamaAlbum.value != '';
}

document.querySelector(".btn-submit").addEventListener("click", () => {
    const btnSubmit = document.querySelector(".btn-submit");
    btnSubmit.setAttribute("disabled", true);
    btnSubmit.querySelector("i").style.opacity = 1;
    btnSubmit.querySelector("i").style.width = "fit-content";

    const modalAlbumElement = document.getElementById("modal-album");
    const modalAlbum = new bootstrap.Modal(modalAlbumElement);

    if (!validasiAlbum()) {
        modalAlbum.hide();

        for (let index = 0; index < listImageElmenet.children.length; index++) {
            const child = listImageElmenet.children[index];
            if (child.querySelector(".judul").value != "") {
                child.click();
                element.querySelector(".focus").focus();
                break;
            }
        }

        showAlert("Harap isi semua kolom judul pada gambar yang dimasukan");
    }

    const input = modalAlbumElement.querySelectorAll(".form-control");

    let valid = 0;
    input.forEach((element) => {
        if (element.value == "") {
            element.classList.add("is-invalid");
            element.classList.remove("is-valid");
        } else {
            element.classList.remove("is-invalid");
            element.classList.add("is-valid");
            valid++;
        }
    });

    if (valid == input.length && validasiAlbum()) {
        document.querySelector(".form-post").submit();
        return;
    }

    btnSubmit.querySelector("i").style.opacity = 0;
    btnSubmit.querySelector("i").style.width = "0";
    btnSubmit.removeAttribute("disabled", true);
});
