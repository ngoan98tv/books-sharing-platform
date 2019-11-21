const category = document.getElementById('categoryId');

if (category) 
    category.addEventListener('change', (event) => {
        if (event.target.value === 'new') {
            document.getElementById('categoryName').style.display = 'block';
        } else {
            document.getElementById('categoryName').style.display = 'none';
        }
    });

const inputImg = document.getElementById('inputImage');

if (inputImg) {
    inputImg.addEventListener('change', (event) => {
        document.getElementById('previewImg').src = window.URL.createObjectURL(event.target.files[0]);
    });
}