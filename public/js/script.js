var link_id=0;

function  baixarLinks(link_id,page_size){
    var url='/ajax/links?link_id='+link_id+'&page_size=2';
    $.get(url, function(data, status){
        alert("Data: " + data + "\nStatus: " + status);
    });
}

function downPage(){
    alert(link_id);
    link_id=1;
}

function upPage(){
    alert(link_id);
}


function setLinkId(link_id){

}
