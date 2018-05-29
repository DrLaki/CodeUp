
document.addEventListener('DOMContentLoaded', ()=> {
    editor = CodeMirror(document.getElementById("codeeditor"), {
        value : "/*\nMode - CSS.\nType your code below\n*/",
        mode: "css",
        theme: "neo",
        lineNumbers: true
    });
})



function compile(type){
    var url = new URL(window.location.href);
    var url_parameters = new URLSearchParams(url.search.slice(1));
    var id = url_parameters.get("id");
    var code = editor.getValue();
    var language = "python";
    var xml_http_request = new XMLHttpRequest();
    xml_http_request.onreadystatechange = function() {
        if(xml_http_request.readyState == XMLHttpRequest.DONE){
            var message = xml_http_request.responseText;
            document.getElementById("message").innerHTML = message;
        }
    };
    var data_to_send = "id=" + id + "&type=" + type + "&language=" + language + "&code=" + code;
    xml_http_request.open("POST", "compile.php", true);
    xml_http_request.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
    xml_http_request.send(data_to_send);
}