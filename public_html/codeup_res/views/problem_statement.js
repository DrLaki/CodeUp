
document.addEventListener('DOMContentLoaded', ()=> {
    editor = CodeMirror(document.getElementById("codeeditor"), {
        value : "# Mode:Python\n# Type your code bellow.",
        mode: {name: "python", version: 3},
        theme: "neo",
        lineNumbers: true
    });
})


/**
 * [compile is JavaScript function that uses ajax to send data to our compile.php page]
 * @param  {[string]} type [is code submited or ran]
 * @return {[void]}
 */
function compile(type){
    var url = new URL(window.location.href);
    var url_parameters = new URLSearchParams(url.search.slice(1));
    var id = url_parameters.get("id");
    var code = encodeURI(editor.getValue());
    code = code.split("+").join("%2B");
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
