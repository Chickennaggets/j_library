function m_srch(){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            document.getElementById("demo").innerHTML = this.responseText;
        }
    };
    var word = document.getElementById("sz_text").value;
    var filt = document.getElementById("filters").value
    xhttp.open("GET", "?action=zap1&parameter="+filt+"&word="+word, true);
    xhttp.send();
}