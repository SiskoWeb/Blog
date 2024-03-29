const API_FILTER_URL = 'http://localhost/blog/backend/filter.php';
// const IMG_BASE_URL = 'http://localhost/blog/backend/';

const searchInput = document.getElementById('search_input');
const searchBar = document.getElementById('searchBar');
let closeSearch = document.getElementById('closeSearch')
const resultSearch = document.getElementById('result_Search');
let resultLength = document.getElementById('resultLength')

let searching_Loading = document.getElementById('searching_Loading')



// create new funtion with concept debounce wait a hel secound before
//excute functin
const onSearchDebounced = debounce(onLoadSearch, 2000);
searchInput.addEventListener('input', onSearchDebounced);




closeSearch.addEventListener('click', function () {
    searchBar.classList.add("hidden")
})


async function onLoadSearch() {
    searching_Loading.classList.remove('hidden')
    console.log('onsearch')
    try {
        const routePromise = await fetch(`${API_FILTER_URL}?action=search&word=${searchInput.value}`);
        const data = await routePromise.json();
        console.log(data)
        resultLength.textContent = data.length
        if (data.length > 0) {


            searching_Loading.classList.add('hidden')
            resultSearch.innerHTML = '';
            data.forEach(item => builderResultSearch(item));

        } else {
            searching_Loading.classList.add('hidden')

            resultSearch.innerHTML = `    <li class=" px-2 py-1 border-b-2 border-gray-100 flex justify-start items-center gap-x-1 cursor-pointer hover:bg-yellow-50 hover:text-gray-900">
            <p>No Posts Aviable</p>
        </li>`
        }
    } catch (error) {
        console.error("Error fetching posts:", error);
    }
}

function builderResultSearch(item) {
    const li = document.createElement('li')


    li.innerHTML = ` <a  href="post.php?post_id=${item.post_id}" class="px-2 py-1 border-b-2 border-gray-100 flex justify-start items-center gap-x-1 cursor-pointer hover:bg-[#0085DB]/50 hover:text-gray-900">
    <img class="max-h-5 max-w-5 rounded-full" src="${IMG_BASE_URL}${item.image}">
    <p class="truncate">${item.title}</p></a>`

    resultSearch.appendChild(li)

}
