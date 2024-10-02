let infoModal = document.getElementById("info-modal");
let infoModalContent = document.getElementById("info-modal-content");

const info = (qrcode, address, url) => {
    
    infoModalContent.innerHTML = `
        <div class="delete-modal-header">
            <span onclick="closeInfoModal()" class="delete-close" id="delete-close">&times;</span>
            <h2>Show Info</h2>
        </div>
        <div style="display: flex;gap: 30px;">
            <img src="${qrcode}" alt="qr code" style="width: 30%">
            <div class="details-items-under">
                <span style="font-weight: bold;">Address : </span>
                <p style="word-break: break-word;"> ${address} </p>
            </div>
        </div>
        <div class="form-btn-wrapper" style="padding: 15px; gap: 10px;">
            <a  target="_blank" href="${url}" class="simple-btn">Status</a>
        </div>  
    `;
    infoModal.style.display = "block";
}

function closeInfoModal() {
    infoModal.style.display = "none";
}

window.onclick = function(event) {
    if (event.target == infoModal) {
        infoModal.style.display = "none";
    }
}