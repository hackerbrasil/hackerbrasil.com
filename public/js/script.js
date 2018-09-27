function setLinks(links){
    var i = 0;
    var text = "";
    for (;links[i];) {
        var link=links[i];
        text +='<li id="'+link.id+'">'+link.title+'</li>';
        i++;
    }
    $('#links').append(  text );
}

$(function(){
    var links=[
        {'id':'1','title':'Um'},
        {'id':'2','title':'Dois'},
        {'id':'3','title':'Três'},
        {'id':'4','title':'Quatro'},
        {'id':'5','title':'Cinco'}
    ];
    setLinks(links);
});
