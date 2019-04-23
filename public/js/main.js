const articles = document.getElementById('table');
//The id of the table is "table"
if (articles) {
    articles.addEventListener('click',(e)=> {
        //If class is btn-danger
if(e.target.className === 'btn btn-danger erase-article')
{
    if(confirm('Delete item from database?')){
//If it is confirmet we target the data id from index.html.twig

        const id = e.target.getAttribute('data-id');
        alert("Article "+id+" deleted from Database");
//Delete route is called
        fetch(`/article/delete/${id}`, {
            method: 'DELETE'
        }).then(res => window.location.reload());
    }
}
   
});
}

//Create delete route
