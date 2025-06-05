document.getElementById('searchInput').addEventListener('input', () => filterData());
document.getElementById('typeSelect').addEventListener('change', () => filterData());
document.getElementById('animalBtn').addEventListener('click', () => {
    document.getElementById('searchInput').value = '';
    document.getElementById('typeSelect').value = '';
    filterData(true);
});

function filterData(animal = false) {
    const search = document.getElementById('searchInput').value;
    const type = document.getElementById('typeSelect').value;

    let query = [];
    if (animal) {
        query.push('animal=1');
    } else {
        if (search) query.push(`search=${encodeURIComponent(search)}`);
        if (type) query.push(`type=${encodeURIComponent(type)}`);
    }

    fetch(`filter.php?${query.join('&')}`)
        .then(res => res.text())
        .then(data => {
            document.getElementById('listingContainer').innerHTML = data;
        })
        .catch(err => console.error('Filter fetch error:', err));
}

