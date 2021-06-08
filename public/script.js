function m_srch(){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            document.getElementById("demo").innerHTML = this.responseText;
        }
    };
    var word = document.getElementById("sz_text").value;
    var filt = document.getElementById("filters").value
    xhttp.open("GET", "?section=songs&action=search&parameter="+filt+"&word="+word+"&ajax", true);
    xhttp.send();
}

function checkpasswords(){
    var ha1 = document.getElementById("has1").value;
    var ha2 = document.getElementById("has2").value;

    if(ha1==ha2 && ha1!="" && ha2!=""){
        document.getElementById("has1").className = "ok-haslo";
        document.getElementById("has2").className = "ok-haslo";
        return 1;
    }
    else if(ha1!=ha2 && ha1!="" && ha2!=""){
        document.getElementById("has1").className = "bad-haslo";
        document.getElementById("has2").className = "bad-haslo";
        return 0;
    }
    else{
        return 0;
    }
}

function reg(){
    var log = document.getElementById("log").value;
    if(checkpasswords()==1 && log!=""){
        document.getElementById("fform").submit();
    }
    else if(checkpasswords()==0){
        document.getElementById("has1").className = "bad-haslo";
        document.getElementById("has2").className = "bad-haslo";
        alert("Proszę sprawdzić hasła");

    }
    else if(log==""){
        alert("Proszę wpisać login");
    }
}

function u_srch(){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            document.getElementById("demo").innerHTML = this.responseText;
        }
    };
    var word = document.getElementById("sz_text").value;
    var filt = document.getElementById("filters").value
    xhttp.open("GET", "?section=users&action=show&parameter="+filt+"&word="+word+"&ajax", true);
    xhttp.send();
}


    var smoothJumpUp = function() {
        if (document.body.scrollTop > 0 || document.documentElement.scrollTop > 0) {
            window.scrollBy(0,-50);
            setTimeout(smoothJumpUp, 5);
        }
    }

    window.onscroll = function() {
        var scrolled = window.pageYOffset || document.documentElement.scrollTop;
        if (scrolled > 600) {
            document.getElementById('upbutton').style.display = 'block';
        } else {
            document.getElementById('upbutton').style.display = 'none';
        }
    }
    function log_out(){
        return confirm('Napewno chcesz wylogować się ?');
    }
