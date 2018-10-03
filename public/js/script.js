var link_id=0;
var page_size=2;

function  baixarLinks(link_id){
    var url='/ajax_links?link_id='+link_id+'&page_size='+page_size;
    $.get(url, function(links, status){
        exibirLinks(links);
    });
}

function downPage(){
    link_id=link_id+page_size;
    baixarLinks(link_id);
}

function exibirLinks(links){
    var i=0;
    var text='';
    while (links[i]) {
        text +='<li>'+links[i].title+'</li>';
        i++;
    }
    $('#links').html(text);
}

function upPage(){
    link_id=link_id-page_size;
    baixarLinks(link_id);
}

$(function(){
    link_id=2;
    baixarLinks(link_id);
});
