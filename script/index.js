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

// const search = document.querySelector("input[name='search']");

// if (false)
//     search.addEventListener('keypress', (event) => {
//         const keyword = event.target.value;
//         const datalist = document.getElementById('hints');
//         fetch(`api/search-hint.php?search=${keyword}`, {method: 'GET'})
//             .then(response => {
//                 response.json().then(json => {
//                     json.forEach(element => {
//                         // const option = document.createElement('OPTION');
//                         // option.value = element;
//                         // datalist.append(option);
//                     });
//                 });
//             }).catch(err => {
//                 console.log(err);
//             });
//     });
