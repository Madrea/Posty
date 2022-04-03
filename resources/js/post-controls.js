function myFunction(id) {
    console.log("comment-div" + id);
    var x = document.getElementById("comment-divvvvv" + id);
    if(x.style.display === '')
    {
        x.style.display = "none";
    }
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}
