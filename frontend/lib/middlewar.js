
if (localStorage.getItem('role') === 'admin') {
    window.location.replace = `http://localhost/blog/frontend/dashboard/`
}
else if (localStorage.getItem('role') === 'author') {
    window.location.href = `./`

}
else {
    window.location.replace = `http://localhost/blog/frontend/`

}