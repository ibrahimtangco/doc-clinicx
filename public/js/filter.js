// JavaScript to toggle visibility of filter options
    const filterButton = document.getElementById('filterButton');
    const filterOptions = document.getElementById('filterOptions');
    const filterItems = document.querySelectorAll('#filter-item');


    filterButton.addEventListener('click', () => {
        filterOptions.classList.toggle('hidden');
    });

    // Close the options if clicked outside
    document.addEventListener('click', (event) => {
        const target = event.target;
        if (!target.closest('.relative')) {
            filterOptions.classList.add('hidden');
        }
    });

    filterItems.forEach(item => {
        item.addEventListener('click', () => {
                filterButton.innerHTML = item.innerHTML;
                filterOptions.classList.toggle('hidden');

        })
    });
