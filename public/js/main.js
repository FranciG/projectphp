const articles = document.getElementById('table');
//The id of the table is "table"
if (articles) {
    articles.addEventListener('click',(e)=> {
if(e.target.className === 'btn btn-danger erase-article')
{
    if(confirm('Delete item from database?')){

        const id = e.target.getAttribute('data-id');
        alert("Article "+id+" deleted from Database");

        fetch(`/article/delete/${id}`, {
            method: 'DELETE'
        }).then(res => window.location.reload());
    }
}
   
});
}

//Create delete route
