const handleUploadImageChange = function(event) {
    const file = event.target.files[0];
    const label = document.querySelector("label[for='image']");
    if (file) {
        label.innerHTML = file.name;
    }
}

document.getElementById('categoryId').addEventListener('change', (event) => {
    if (event.target.value === 'new') {
        document.getElementById('categoryName').style.display = 'block';
    } else {
        document.getElementById('categoryName').style.display = 'none';
    }
});