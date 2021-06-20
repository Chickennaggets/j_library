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

function reg(){
    document.getElementById("fform").submit();
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

    function changesel(){
        var ddl = document.getElementById("selactype");
        var selectedValue = ddl.options[ddl.selectedIndex].value;

        if (selectedValue == "guest")
        {
            document.getElementById("count_downloads").hidden=false;
        }
        else{
            document.getElementById("count_downloads").hidden=true;
        }
    }


    function checkform(){

    var login = false;
    var password = false;
    var regulamin = false;

        if(document.getElementById("regLogin").value.length > 4){
            document.getElementById("regLogin").className = "form-control is-valid";
            login = true;
        }
        else{
            document.getElementById("regLogin").className = "form-control is-invalid";
            login = false;
        }

    var pass1 = document.getElementById("has1").value;
    var pass2 = document.getElementById("has2").value;

        if(pass1 == pass2 && pass1.length>=6){
            document.getElementById("has1").className = "form-control is-valid";
            document.getElementById("has2").className = "form-control is-valid";
            password = true;
        }
        else{
            document.getElementById("has1").className = "form-control is-invalid";
            document.getElementById("has2").className = "form-control is-invalid";
            password = false;
        }



        if(login, password){
            if(document.getElementById('checkRegulamin').checked){
                document.getElementById('btn_login').disabled = false;
            }
            else{
                document.getElementById('btn_login').disabled = true;
            }
        }
    }
