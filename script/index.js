const category = document.getElementById('categoryId');

if (category) 
    category.addEventListener('change', (event) => {
        if (event.target.value === 'new') {
            document.getElementById('categoryName').style.display = 'block';
        } else {
            document.getElementById('categoryName').style.display = 'none';
        }
    });

const search = document.querySelector("input[name='search']");

if (search)
    search.addEventListener('change', (event) => {
        let keyword = event.target.value;
        fetch(`api/search-hint.php?search=${keyword}`, {method: 'GET'})
            .then(response => {
                response.json().then(json => {
                    console.log(json);
                });
            }).catch(err => {
                console.log(err);
            });
    });
