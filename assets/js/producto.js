let readFile = input => {
    if (input.files.length > 0) {
        let haveActive = false;
        let previewZone = document.getElementById('file-preview-zone');
        previewZone.innerHTML = '';
        for (const iterator of input.files) {
            let reader = new FileReader();
            reader.onload = e => {
                let filePreview = document.createElement('img');
                filePreview.className = 'd-block w-100';
                //  filePreview.id = 'file-preview';
                filePreview.src = e.target.result;
                // previewZone.appendChild(filePreview);
                let content = '';
                if (!haveActive) {
                    content = `<div class="carousel-item active"><img src="${e.target.result}" class="d-block w-100" alt="..."></div>`;
                    haveActive = true;
                } else
                    content = `<div class="carousel-item"><img src="${e.target.result}" class="d-block w-100" alt="..."></div>`;
                previewZone.insertAdjacentHTML('beforeend', content);
            }
            reader.readAsDataURL(iterator);
        }
    }
}

let fileUpload = document.getElementById('file-upload');

fileUpload.onchange = e =>
    readFile(e.srcElement)